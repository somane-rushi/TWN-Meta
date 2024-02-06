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

namespace Inpsyde\MultilingualPress\Translator;

use Inpsyde\MultilingualPress\Core\TaxonomyRepository;
use Inpsyde\MultilingualPress\Framework\Api\Translation;
use Inpsyde\MultilingualPress\Framework\Api\TranslationSearchArgs;
use Inpsyde\MultilingualPress\Framework\Factory\UrlFactory;
use Inpsyde\MultilingualPress\Framework\Translator\Translator;

/**
 * Translator implementation for terms.
 */
final class TermTranslator implements Translator
{
    const FILTER_TAXONOMY_LIST = 'multilingualpress.term_translator_taxonomy_list';
    const FILTER_TRANSLATION = 'multilingualpress.filter_term_translation';

    /**
     * @var UrlFactory
     */
    private $urlFactory;

    /**
     * @var \WP_Rewrite
     */
    private $wpRewrite;

    private $taxonomyRepository;

    /**
     * @var array
     */
    private $customBase = [];

    /**
     * @param UrlFactory $urlFactory
     */
    public function __construct(TaxonomyRepository $taxonomyRepository, UrlFactory $urlFactory)
    {
        $this->taxonomyRepository = $taxonomyRepository;
        $this->urlFactory = $urlFactory;
    }

    /**
     * @inheritdoc
     */
    public function translationFor(int $siteId, TranslationSearchArgs $args): Translation
    {
        $translation = new Translation();

        if (!$args->contentId() || !$this->ensureWpRewrite()) {
            return $translation;
        }

        /**
         * Filter Translation bypassing the translation
         *
         * @param bool false True to by pass
         * @param Translation $translation
         * @param int $siteId
         * @param TranslationSearchArgs $args
         */
        $filteredTranslation = apply_filters(
            self::FILTER_TRANSLATION,
            false,
            $translation,
            $siteId,
            $args
        );

        if ($filteredTranslation) {
            return $translation;
        }

        switch_to_blog($siteId);
        list($remoteTitle, $remoteUrl) = $this->translationData($args->contentId());
        restore_current_blog();

        $remoteTitle and $translation = $translation->withRemoteTitle($remoteTitle);
        $remoteUrl and $translation = $translation->withRemoteUrl($remoteUrl);

        return $translation;
    }

    /**
     * @param \WP_Rewrite|null $wp_rewrite
     * @return bool
     */
    public function ensureWpRewrite(\WP_Rewrite $wp_rewrite = null): bool
    {
        if ($this->wpRewrite && !$wp_rewrite) {
            return true;
        }

        if (!$wp_rewrite && empty($GLOBALS['wp_rewrite'])) {
            return false;
        }

        $this->wpRewrite = $wp_rewrite ?: $GLOBALS['wp_rewrite'];

        return true;
    }

    /**
     * @param string $key
     * @param callable $function
     */
    public function registerBaseStructureCallback(string $key, callable $function)
    {
        $this->customBase[$key] = $function;
    }

    /**
     * Returns the translation data for the given term taxonomy ID.
     *
     * @param int $termTaxonomyId
     * @return array
     */
    private function translationData(int $termTaxonomyId): array
    {
        $term = $this->termByTermTaxonomyId($termTaxonomyId);
        if (!$term) {
            return ['', null];
        }

        $isAdmin = is_admin();

        if ($isAdmin && current_user_can('edit_terms', $term['taxonomy'])) {
            $editUrl = get_edit_term_link((int)$term['term_id'], (string)$term['taxonomy']);

            return [
                $term['name'],
                $this->urlFactory->create([$editUrl]),
            ];
        }

        if ($isAdmin) {
            return [$term['name'], null];
        }

        $publicUrl = $this->publicUrl((int)$term['term_id'], (string)$term['taxonomy']);

        return [
            $term['name'],
            $this->urlFactory->create([$publicUrl]),
        ];
    }

    /**
     * Returns term data according to the given term taxonomy ID.
     *
     * @param int $termTaxonomyId
     * @return array
     */
    private function termByTermTaxonomyId(int $termTaxonomyId): array
    {
        return get_term_by('term_taxonomy_id', $termTaxonomyId, '', ARRAY_A);
    }

    /**
     * Prepares the taxonomy base before the URL is fetched.
     *
     * @param int $termId
     * @param string $taxonomySlug
     * @return string
     */
    private function publicUrl(int $termId, string $taxonomySlug): string
    {
        $this->fixTermBase($taxonomySlug);

        $url = get_term_link($termId, $taxonomySlug);
        if (is_wp_error($url)) {
            $url = '';
        }

        return (string)$url;
    }

    /**
     * Updates the global WordPress rewrite instance if it is wrong.
     *
     * @param string $taxonomySlug
     * @return void
     */
    private function fixTermBase(string $taxonomySlug)
    {
        $struct = (string)get_option('permalink_structure', '');
        $expected = $this->expectedBase($taxonomySlug);

        if (!$struct) {
            $expected = '';
        }

        if ($struct && !$expected) {
            $expected = get_taxonomy($taxonomySlug)->rewrite['slug'];
        }

        $this->ensurePermastruct($struct);
        $this->updateRewritePermastruct($taxonomySlug, $expected);
    }

    /**
     * Finds a custom taxonomy base.
     *
     * @param string $taxonomySlug
     * @return string
     */
    private function expectedBase(string $taxonomySlug): string
    {
        if (!$this->taxonomyRepository->isTaxonomyActive($taxonomySlug)) {
            return '';
        }

        if (in_array($taxonomySlug, array_keys($this->customBase), true)) {
            $translated = $this->customBase[$taxonomySlug]($taxonomySlug);
            return $this->composeBase(sanitize_text_field($translated), $taxonomySlug);
        }

        $option = (string)get_option($this->taxonomy($taxonomySlug), '');
        if (!$option) {
            $option = $taxonomySlug;
        }

        return $this->composeBase($option, $taxonomySlug);
    }

    /**
     * @param string $translated
     * @param string $taxonomySlug
     * @return string
     */
    private function composeBase(string $translated, string $taxonomySlug): string
    {
        return untrailingslashit($translated) . '/%' . $taxonomySlug . '%';
    }

    /**
     * Updates the global WordPress rewrite instance for the given custom taxonomy.
     *
     * @param string $taxonomy
     * @param string $struct
     */
    private function updateRewritePermastruct(string $taxonomy, string $struct)
    {
        $this->wpRewrite->extra_permastructs[$taxonomy]['struct'] = $struct;
    }

    /**
     * @param string $struct
     */
    private function ensurePermastruct(string $struct)
    {
        $this->wpRewrite->permalink_structure = $struct;
    }

    /**
     * @param string $taxonomySlug
     * @return string
     */
    private function taxonomy(string $taxonomySlug): string
    {
        $taxonomies = [
            'category' => 'category_base',
            'post_tag' => 'tag_base',
        ];

        $taxonomy = $taxonomies[$taxonomySlug] ?? '';

        return $taxonomy;
    }
}
