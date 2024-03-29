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

use Inpsyde\MultilingualPress\Cache\NavMenuItemsSerializer;
use Inpsyde\MultilingualPress\Framework\Api\Translations;
use Inpsyde\MultilingualPress\Framework\Cache\Server\Facade;
use Inpsyde\MultilingualPress\Framework\Cache\Server\ItemLogic;
use Inpsyde\MultilingualPress\Framework\Cache\Server\Server;
use Inpsyde\MultilingualPress\Framework\Factory\NonceFactory;
use Inpsyde\MultilingualPress\Framework\Asset\AssetManager;
use Inpsyde\MultilingualPress\Framework\Http\ServerRequest;
use Inpsyde\MultilingualPress\Framework\Service\BootstrappableServiceProvider;
use Inpsyde\MultilingualPress\Framework\Service\Container;
use Inpsyde\MultilingualPress\Framework\Service\IntegrationServiceProvider;
use function Inpsyde\MultilingualPress\wpHookProxy;

final class ServiceProvider implements BootstrappableServiceProvider, IntegrationServiceProvider
{
    const NONCE_ACTION = 'add_languages_to_nav_menu';

    /**
     * @inheritdoc
     */
    public function register(Container $container)
    {
        $container->addService(
            AjaxHandler::class,
            function (Container $container): AjaxHandler {
                return new AjaxHandler(
                    $container[NonceFactory::class]->create([self::NONCE_ACTION]),
                    $container[ItemRepository::class],
                    $container[ServerRequest::class]
                );
            }
        );

        $container->addService(
            ItemDeletor::class,
            function (Container $container): ItemDeletor {
                return new ItemDeletor($container[\wpdb::class]);
            }
        );

        $container->addService(
            ItemFilter::class,
            function (Container $container): ItemFilter {
                return new ItemFilter(
                    $container[Translations::class],
                    $container[ItemRepository::class],
                    new Facade($container[Server::class], ItemFilter::class)
                );
            }
        );

        $container->addService(
            LanguagesMetaboxView::class,
            function (Container $container): LanguagesMetaboxView {
                $nonce = $container[NonceFactory::class]->create([self::NONCE_ACTION]);
                return new LanguagesMetaboxView($nonce);
            }
        );

        $container->share(
            ItemRepository::class,
            function (): ItemRepository {
                return new ItemRepository();
            }
        );
    }

    /**
     * @inheritdoc
     */
    public function integrate(Container $container)
    {
        if (!is_admin()) {
            $this->integrateCache($container);
        }
    }

    /**
     * @inheritdoc
     */
    public function bootstrap(Container $container)
    {
        $itemDeletor = $container[ItemDeletor::class];
        add_action('delete_blog', wpHookProxy([$itemDeletor, 'deleteItemsForDeletedSite']));

        if (is_admin()) {
            $this->bootstrapAdmin($container);

            return;
        }

        $itemFilter = $container[ItemFilter::class];
        add_filter('wp_nav_menu_objects', wpHookProxy([$itemFilter, 'filterItems']), PHP_INT_MAX);
    }

    /**
     * @param Container $container
     */
    private function bootstrapAdmin(Container $container)
    {
        $assetManager = $container[AssetManager::class];
        $metaboxView = $container[LanguagesMetaboxView::class];
        $nonce = $container[NonceFactory::class]->create([self::NONCE_ACTION]);

        add_action(
            'load-nav-menus.php',
            function () use ($assetManager, $nonce) {
                $assetManager->enqueueScriptWithData(
                    'multilingualpress-admin',
                    'mlpNavMenusSettings',
                    [
                        'action' => AjaxHandler::ACTION,
                        'metaBoxId' => 'mlp-languages',
                        'nonce' => (string)$nonce,
                        'nonceName' => $nonce->action(),
                    ]
                );
                $assetManager->enqueueStyle('multilingualpress-admin');
            }
        );

        add_action(
            'admin_init',
            function () use ($metaboxView) {
                add_meta_box(
                    'mlp-languages',
                    esc_html__('Languages', 'multilingualpress'),
                    [$metaboxView, 'render'],
                    'nav-menus',
                    'side',
                    'low'
                );
            }
        );

        add_action(
            'wp_ajax_' . AjaxHandler::ACTION,
            [$container[AjaxHandler::class], 'handle']
        );

        $itemRepository = $container[ItemRepository::class];

        add_filter(
            'wp_setup_nav_menu_item',
            function ($item) use ($itemRepository) {
                if ($itemRepository->siteIdOfMenuItem((int)($item->ID ?? 0))) {
                    $item->type_label = esc_html__(
                        'Language',
                        'multilingualpress'
                    );
                }

                return $item;
            }
        );
    }

    /**
     * @param Container $container
     */
    private function integrateCache(Container $container)
    {
        $itemFilter = $container[ItemFilter::class];
        $itemFilterCacheLogic =
            (new ItemLogic(ItemFilter::class, ItemFilter::ITEMS_FILTER_CACHE_KEY))
                ->generateKeyWith(
                    function (string $key, array $postArrays): string {
                        $url = parse_url(add_query_arg([]), PHP_URL_PATH);
                        // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize
                        $key .= substr(md5(serialize(array_keys($postArrays)) . $url), -12, 10);
                        return $key;
                    }
                )
                ->updateWith(
                    function (array $postArrays) use ($itemFilter): array {

                        $postArrays = array_values($postArrays);
                        $serializer = NavMenuItemsSerializer::fromSerialized(...$postArrays);
                        $filtered = $itemFilter->filterItems($serializer->unserialize());

                        return NavMenuItemsSerializer::fromWpPostItems(...$filtered)->serialize();
                    }
                );

        $container[Server::class]->register($itemFilterCacheLogic);
    }
}
