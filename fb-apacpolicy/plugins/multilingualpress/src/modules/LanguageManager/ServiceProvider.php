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

namespace Inpsyde\MultilingualPress\Module\LanguageManager;

use Inpsyde\MultilingualPress\Asset\AssetFactory;
use Inpsyde\MultilingualPress\Database\Table\LanguagesTable;
use Inpsyde\MultilingualPress\Framework\Admin\SettingsPage;
use Inpsyde\MultilingualPress\Framework\Api\Languages;
use Inpsyde\MultilingualPress\Framework\Asset\AssetManager;
use Inpsyde\MultilingualPress\Framework\Factory\LanguageFactory;
use Inpsyde\MultilingualPress\Framework\Factory\NonceFactory;
use Inpsyde\MultilingualPress\Framework\Http\ServerRequest;
use Inpsyde\MultilingualPress\Framework\Module\Module;
use Inpsyde\MultilingualPress\Framework\Module\ModuleManager;
use Inpsyde\MultilingualPress\Framework\Module\ModuleServiceProvider;
use Inpsyde\MultilingualPress\Framework\Service\Container;

/**
 * Class ServiceProvider
 */
final class ServiceProvider implements ModuleServiceProvider
{
    const MODULE_ID = 'language-manager';

    /**
     * @inheritdoc
     */
    public function registerModule(ModuleManager $moduleManager): bool
    {
        return $moduleManager->register(
            new Module(
                self::MODULE_ID,
                [
                    'description' => __(
                        'Enable Language Manager to include custom languages or override existing ones.',
                        'multilingualpress'
                    ),
                    'name' => __('Language Manager', 'multilingualpress'),
                    'active' => true,
                ]
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function activateModule(Container $container)
    {
        $languageManagerPage = SettingsPage::withParent(
            SettingsPage::ADMIN_NETWORK,
            SettingsPage::PARENT_MULTILINGUALPRESS,
            __('Language Manager', 'multilingualpress'),
            __('Language Manager', 'multilingualpress'),
            'manage_network_options',
            'language-manager',
            $container[PageView::class]
        );

        add_action(
            'admin_post_' . RequestHandler::ACTION,
            [$container[RequestHandler::class], 'handlePostRequest']
        );
        add_action('plugins_loaded', [$languageManagerPage, 'register'], 10);

        $this->enqueueAssets($container);
    }

    /**
     * @inheritdoc
     *
     * phpcs:disable Inpsyde.CodeQuality.FunctionLength.TooLong
     */
    public function register(Container $container)
    {
        // phpcs:enable

        $container->addService(
            Db::class,
            function (Container $container): Db {
                return new Db(
                    $container[\wpdb::class],
                    $container[Languages::class],
                    $container[LanguagesTable::class]
                );
            }
        );

        $container->addService(
            TableFormView::class,
            function (Container $container): TableFormView {
                return new TableFormView(
                    $container[Db::class],
                    $container[LanguageInstaller::class]
                );
            }
        );

        $container->addService(
            PageView::class,
            function (Container $container): PageView {
                return new PageView(
                    $container[NonceFactory::class]->create(['save_language_manager']),
                    $container[ServerRequest::class],
                    $container[TableFormView::class]
                );
            }
        );

        $container->addService(
            LanguageInstaller::class,
            function (): LanguageInstaller {
                return new LanguageInstaller();
            }
        );

        $container->addService(
            RequestHandler::class,
            function (Container $container): RequestHandler {
                return new RequestHandler(
                    new Updater(
                        new Db(
                            $container[\wpdb::class],
                            $container[Languages::class],
                            $container[LanguagesTable::class]
                        ),
                        $container[LanguagesTable::class],
                        $container[LanguageFactory::class],
                        $container[LanguageInstaller::class]
                    ),
                    $container[ServerRequest::class],
                    $container[NonceFactory::class]->create(['save_language_manager'])
                );
            }
        );
    }

    /**
     * @param Container $container
     */
    private function enqueueAssets(Container $container)
    {
        global $pagenow;

        if (!$this->isMultilingualPressSettingsPage($pagenow)) {
            return;
        }

        $assetFactory = $container[AssetFactory::class];
        $container[AssetManager::class]
            ->registerStyle(
                $assetFactory->createInternalStyle(
                    'multilingualpress-language-manager',
                    'language-manager.css'
                )
            )
            ->registerScript(
                $assetFactory->createInternalScript(
                    'multilingualpress-language-manager',
                    'language-manager.js',
                    ['jquery-ui-autocomplete']
                )
            );

        $container[AssetManager::class]->enqueueStyle('multilingualpress-language-manager');
        $container[AssetManager::class]->enqueueScriptWithData(
            'multilingualpress-language-manager',
            'languageManager',
            [
                'newLanguageButtonLabel' => esc_html__('New Language', 'multilingualpress'),
                'languageDeleteTableHeadLabel' => esc_html__('Delete', 'multilingualpress'),
                'languageUndoDeleteButtonLabel' => esc_html__(
                    'Undo Delete',
                    'multilingualpress'
                ),
                'languageDeleteButtonLabel' => esc_html__(
                    'Delete Language',
                    'multilingualpress'
                ),
            ]
        );
    }

    /**
     * @param string $currentPage
     * @return bool
     */
    private function isMultilingualPressSettingsPage(string $currentPage): bool
    {
        $adminPage = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
        $isAdminPage = 'admin.php' === $currentPage;
        $isAllowedPage = $adminPage === self::MODULE_ID;

        return $isAllowedPage and $isAdminPage;
    }
}
