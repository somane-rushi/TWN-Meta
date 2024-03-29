<?php # -*- coding: utf-8 -*-
/*
 * This file is part of the MultilingualPress package.
 *
 * (c) Inpsyde GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Inpsyde\MultilingualPress\NavMenu;

use Inpsyde\MultilingualPress\Framework\Cache\Exception;
use Inpsyde\MultilingualPress\Cache\NavMenuItemsSerializer;
use Inpsyde\MultilingualPress\Framework\Api\Translations;
use Inpsyde\MultilingualPress\Framework\Api\Translation;
use Inpsyde\MultilingualPress\Framework\Api\TranslationSearchArgs;
use Inpsyde\MultilingualPress\Framework\Cache\Server\Facade;
use Inpsyde\MultilingualPress\Framework\WordpressContext;

use function Inpsyde\MultilingualPress\siteExists;

/**
 * Filters nav menu items and passes the proper URL.
 */
class ItemFilter
{
    const ITEMS_FILTER_CACHE_KEY = 'filter_items';
    const ACTION_PREPARE_ITEM = 'multilingualpress.prepare_nav_menu_item';

    /**
     * @var ItemRepository
     */
    private $repository;

    /**
     * @var Translations
     */
    private $translations;

    /**
     * @var Facade
     */
    private $cache;

    /**
     * @param Translations $translations
     * @param ItemRepository $repository
     * @param Facade $cache
     */
    public function __construct(
        Translations $translations,
        ItemRepository $repository,
        Facade $cache
    ) {

        $this->translations = $translations;
        $this->repository = $repository;
        $this->cache = $cache;
    }

    /**
     * Filters the nav menu items.
     *
     * @param \WP_Post[] $items
     * @return \WP_Post[]
     * @throws Exception\NotRegisteredCacheItem
     * @throws Exception\InvalidCacheArgument
     * @throws Exception\InvalidCacheDriver
     */
    public function filterItems(array $items): array
    {
        if (empty($items)) {
            return [];
        }

        $cached = $this->filterItemsCache($items);
        if (!empty($cached)) {
            return $cached;
        }

        $context = new WordpressContext();
        $args = TranslationSearchArgs::forContext($context)
            ->forSiteId(get_current_blog_id())
            ->includeBase();

        $translations = $this->translations->searchTranslations($args);

        $filtered = [];
        foreach ($items as $key => $item) {
            if ($this->maybeDeleteObsoleteItem($item)) {
                continue;
            }

            if ($translations) {
                $this->prepareItem($item, $translations);
            }

            $filtered[$key] = $item;
        }

        return $filtered;
    }

    /**
     * Delete given post if its remote site ID does not exist anymore.
     *
     * @param \WP_Post $item
     * @return bool
     */
    private function maybeDeleteObsoleteItem(\WP_Post $item): bool
    {
        $siteId = $this->repository->siteIdOfMenuItem((int)$item->ID);
        if (!$siteId) {
            return false;
        }

        if (siteExists($siteId)) {
            return false;
        }

        wp_delete_post($item->ID);

        return true;
    }

    /**
     * Assigns the remote URL and fires an action hook.
     *
     * @param \WP_Post $item
     * @param Translation[] $translations
     * @return bool
     */
    private function prepareItem(\WP_Post $item, array $translations): bool
    {
        $siteId = $this->repository->siteIdOfMenuItem((int)$item->ID);
        if (!$siteId) {
            return false;
        }

        /** @noinspection MissingIssetImplementationInspection */
        if (!isset($item->classes)) {
            $item->classes = [];
        }

        if (get_current_blog_id() === $siteId
            && !in_array('mlp-current-language-item', $item->classes, true)
        ) {
            $item->classes[] = 'mlp-current-language-item';
        }

        list($url, $translation) = $this->itemDetails($translations, $siteId);

        /** This filter is documented in Translation.php */
        /** @noinspection PhpUndefinedFieldInspection */
        $item->url = apply_filters(
            Translation::FILTER_URL,
            $url,
            $siteId,
            0,
            $translation
        );

        /**
         * Fires right before a nav menu item is sent to the walker.
         *
         * @param \WP_Post $item
         * @param Translation $translation
         */
        do_action(self::ACTION_PREPARE_ITEM, $item, $translation);

        return true;
    }

    /**
     * Returns the remote URL and the translation object for the according item.
     *
     * @param Translation[] $translations
     * @param int $siteId
     * @return array
     */
    private function itemDetails(array $translations, int $siteId): array
    {
        if (empty($translations[$siteId])) {
            return [
                get_home_url($siteId, '/'),
                new Translation(),
            ];
        }

        $translation = $translations[$siteId];

        return [
            $translation->remoteUrl() ?: get_home_url($siteId, '/'),
            $translation,
        ];
    }

    /**
     * @param array $navItems
     * @return array
     * @throws Exception\NotRegisteredCacheItem
     * @throws Exception\InvalidCacheArgument
     * @throws Exception\InvalidCacheDriver
     */
    private function filterItemsCache(array $navItems): array
    {
        if (is_admin()) {
            return [];
        }

        $cached = $this->cache->claim(
            self::ITEMS_FILTER_CACHE_KEY,
            NavMenuItemsSerializer::fromWpPostItems(...$navItems)->serialize()
        );

        if (is_array($cached) && $cached) {
            $postArrays = array_values(array_filter($cached, 'is_array'));

            return NavMenuItemsSerializer::fromSerialized(...$postArrays)->unserialize();
        }

        return [];
    }
}
