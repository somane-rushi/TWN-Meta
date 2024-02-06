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

namespace Inpsyde\MultilingualPress\Core;

use function Inpsyde\MultilingualPress\currentSiteLocale;
use function Inpsyde\MultilingualPress\siteLocaleName;
use function Inpsyde\MultilingualPress\assignedLanguageNames;
use function Inpsyde\MultilingualPress\siteLanguageTag;
use Inpsyde\MultilingualPress\Framework\Database\Exception\NonexistentTable;
use Inpsyde\MultilingualPress\Core\Admin\PostTypeSlugsSettingsRepository;
use Inpsyde\MultilingualPress\Core\Admin\SiteSettingsRepository;
use Inpsyde\MultilingualPress\Core\License\Activator as LicenseActivator;
use Inpsyde\MultilingualPress\Core\License\Updater as LicenseUpdater;
use Inpsyde\MultilingualPress\Framework\Cache\Server\Facade;
use Inpsyde\MultilingualPress\Framework\Admin\PersistentAdminNotices;
use Inpsyde\MultilingualPress\Framework\Admin\EditSiteTab;
use Inpsyde\MultilingualPress\Framework\Admin\SettingsPage;
use Inpsyde\MultilingualPress\Framework\Admin\SettingsPageTab;
use Inpsyde\MultilingualPress\Framework\Admin\SettingsPageTabData;
use Inpsyde\MultilingualPress\Framework\Admin\SitesListTableColumn;
use Inpsyde\MultilingualPress\Framework\Api\ContentRelations;
use Inpsyde\MultilingualPress\Framework\Api\SiteRelations;
use Inpsyde\MultilingualPress\Framework\Api\Translations;
use Inpsyde\MultilingualPress\Framework\Asset\AssetManager;
use Inpsyde\MultilingualPress\Framework\BasePathAdapter;
use Inpsyde\MultilingualPress\Framework\Cache\Server\Server;
use Inpsyde\MultilingualPress\Framework\Http\PhpServerRequest;
use Inpsyde\MultilingualPress\Framework\Http\RequestGlobalsManipulator;
use Inpsyde\MultilingualPress\Framework\Http\ServerRequest;
use Inpsyde\MultilingualPress\Framework\PluginProperties;
use Inpsyde\MultilingualPress\Framework\Setting\Site\SiteSettingMultiView;
use Inpsyde\MultilingualPress\Framework\Setting\Site\SiteSettingsSectionView;
use Inpsyde\MultilingualPress\Framework\Factory\NonceFactory;
use Inpsyde\MultilingualPress\Framework\Module\ModuleManager;
use Inpsyde\MultilingualPress\Framework\Service\Container;
use Inpsyde\MultilingualPress\Framework\Service\BootstrappableServiceProvider;
use Inpsyde\MultilingualPress\Framework\WordpressContext;
use Inpsyde\MultilingualPress\Core\Admin\PostTypeSlugSetting;
use Inpsyde\MultilingualPress\Core\Admin\PostTypeSlugsSettingsSectionView;
use Inpsyde\MultilingualPress\Translator\PostTranslator;
use Inpsyde\MultilingualPress\Attachment;
use function Inpsyde\MultilingualPress\wpHookProxy;

/**
 * Service provider for all Core objects.
 *
 * phpcs:disable Inpsyde.CodeQuality.FunctionLength.TooLong
 */
final class ServiceProvider implements BootstrappableServiceProvider
{
    const FILTER_PLUGIN_LOCALE = 'plugin_locale';

    /**
     * @inheritdoc
     */
    public function register(Container $container)
    {
        $this->registerCore($container);
        $this->registerAdmin($container);
        $this->registerFrontend($container);
    }

    /**
     * @param Container $container
     */
    private function registerCore(Container $container)
    {
        $container->addService(
            BasePathAdapter::class,
            function (): BasePathAdapter {
                return new BasePathAdapter();
            }
        );

        $container->addService(
            SiteDataDeletor::class,
            function (Container $container): SiteDataDeletor {
                return new SiteDataDeletor(
                    $container[ContentRelations::class],
                    $container[SiteRelations::class],
                    $container[Admin\SiteSettingsRepository::class]
                );
            }
        );

        $container->share(
            RequestGlobalsManipulator::class,
            function (): RequestGlobalsManipulator {
                return new RequestGlobalsManipulator(
                    RequestGlobalsManipulator::METHOD_POST
                );
            }
        );

        $container->share(
            Locations::class,
            function (Container $container): Locations {

                $properties = $container[PluginProperties::class];
                $pluginPath = rtrim($properties->dirPath(), '/');
                $pluginUrl = rtrim($properties->dirUrl(), '/');
                $assetsPath = "{$pluginPath}/public";
                $assetsUrl = "{$pluginUrl}/public";

                $locations = new Locations();

                return $locations
                    ->add('plugin', $pluginPath, $pluginUrl)
                    ->add('css', "{$assetsPath}/css", "{$assetsUrl}/css")
                    ->add('js', "{$assetsPath}/js", "{$assetsUrl}/js");
            }
        );

        $container->share(
            PostTypeRepository::class,
            function (): PostTypeRepository {
                return new PostTypeRepository();
            }
        );

        $container->share(
            ServerRequest::class,
            function (): ServerRequest {
                return new PhpServerRequest();
            }
        );

        $container->share(
            TaxonomyRepository::class,
            function (): TaxonomyRepository {
                return new TaxonomyRepository();
            }
        );

        $container->addService(
            LicenseActivator::class,
            function (): LicenseActivator {
                return new LicenseActivator();
            }
        );

        $container->share(
            WordpressContext::class,
            function (): WordpressContext {
                return new WordpressContext();
            }
        );

        $container->share(
            Entity\ActivePostTypes::class,
            function (): Entity\ActivePostTypes {
                return new Entity\ActivePostTypes();
            }
        );

        $container->share(
            Entity\ActiveTaxonomies::class,
            function (): Entity\ActiveTaxonomies {
                return new Entity\ActiveTaxonomies();
            }
        );

        $container->share(
            LicenseUpdater::class,
            function (Container $container): LicenseUpdater {
                return new LicenseUpdater(
                    $container[PluginProperties::class],
                    $container[ServerRequest::class]
                );
            }
        );

        $container->share(
            Attachment\Copier::class,
            function (Container $container): Attachment\Copier {
                return new Attachment\Copier(
                    $container[\wpdb::class]
                );
            }
        );
    }

    /**
     * @param Container $container
     */
    private function registerAdmin(Container $container)
    {
        $container->share(
            PersistentAdminNotices::class,
            function (): PersistentAdminNotices {
                return new PersistentAdminNotices();
            }
        );

        $container->share(
            ModuleManager::class,
            function (): ModuleManager {
                return new ModuleManager(ModuleManager::OPTION);
            }
        );

        $container->addService(
            ModuleDeactivator::class,
            function (Container $container): ModuleDeactivator {
                return new ModuleDeactivator($container[ModuleManager::class]);
            }
        );

        $container->addService(
            Admin\SettingsPageTabsBuilder::class,
            function (Container $container): Admin\SettingsPageTabsBuilder {

                $tabBuilder = new Admin\SettingsPageTabsBuilder();
                $tabBuilder
                    ->addTabDataAndView(
                        new SettingsPageTabData(
                            'modules',
                            __('Modules', 'multilingualpress'),
                            'modules'
                        ),
                        new Admin\ModuleSettingsTabView(
                            $container[ModuleManager::class],
                            $container[NonceFactory::class]->create(['save_module_settings'])
                        )
                    )
                    ->addTabDataAndView(
                        new SettingsPageTabData(
                            'post-types',
                            __('Translatable Post Types', 'multilingualpress'),
                            'post-types'
                        ),
                        new Admin\PostTypeSettingsTabView(
                            $container[PostTypeRepository::class],
                            $container[NonceFactory::class]->create(['update_post_type_settings'])
                        )
                    )
                    ->addTabDataAndView(
                        new SettingsPageTabData(
                            'taxonomies',
                            __('Translatable Taxonomies', 'multilingualpress'),
                            'taxonomies'
                        ),
                        new Admin\TaxonomySettingsTabView(
                            $container[TaxonomyRepository::class],
                            $container[NonceFactory::class]->create(['update_taxonomy_settings'])
                        )
                    );

                if (defined('MULTILINGUALPRESS_NEEDS_LICENSE') && MULTILINGUALPRESS_NEEDS_LICENSE) {
                    $tabBuilder->addTabDataAndView(
                        new SettingsPageTabData(
                            'license',
                            __('License', 'multilingualpress'),
                            'license'
                        ),
                        new Admin\LicenseSettingsTabView(
                            $container[LicenseActivator::class],
                            $container[NonceFactory::class]->create(['update_license_settings'])
                        )
                    );
                }

                return $tabBuilder;
            }
        );

        /* ---------------------------------------------------------------------------
           Plugin Settings
           ------------------------------------------------------------------------ */

        $container->addService(
            Admin\PluginSettingsPageView::class,
            function (Container $container): Admin\PluginSettingsPageView {
                return new Admin\PluginSettingsPageView(
                    $container[NonceFactory::class]->create(['save_plugin_settings']),
                    $container[ServerRequest::class],
                    $container[Admin\SettingsPageTabsBuilder::class]->build()
                );
            }
        );

        $container->addService(
            Admin\PluginSettingsUpdater::class,
            function (Container $container): Admin\PluginSettingsUpdater {
                return new Admin\PluginSettingsUpdater(
                    $container[NonceFactory::class]->create(['save_plugin_settings']),
                    $container[ServerRequest::class]
                );
            }
        );

        /* ---------------------------------------------------------------------------
           Language Settings
           ------------------------------------------------------------------------ */

        $container->share(
            Admin\LanguagesAjaxSearch::class,
            function (Container $container): Admin\LanguagesAjaxSearch {
                return new Admin\LanguagesAjaxSearch($container[ServerRequest::class]);
            }
        );

        $container->addService(
            Admin\LanguageSiteSetting::class,
            function (): Admin\LanguageSiteSetting {
                return new Admin\LanguageSiteSetting();
            }
        );

        /* ---------------------------------------------------------------------------
           Site Settings
           ------------------------------------------------------------------------ */

        $container->share(
            Admin\SiteSettingsRepository::class,
            function (Container $container): Admin\SiteSettingsRepository {
                return new Admin\SiteSettingsRepository(
                    $container[SiteRelations::class],
                    new Facade(
                        $container[Server::class],
                        Admin\SiteSettingsRepository::class
                    )
                );
            }
        );

        $container->addService(
            Admin\NewSiteSettings::class,
            function (Container $container): Admin\NewSiteSettings {
                return new Admin\NewSiteSettings(
                    SiteSettingMultiView::fromViewModels(
                        [
                            $container[Admin\LanguageSiteSetting::class],
                            $container[Admin\RelationshipsSiteSetting::class],
                        ]
                    ),
                    $container[AssetManager::class]
                );
            }
        );

        $container->addService(
            Admin\RelationshipsSiteSetting::class,
            function (Container $container): Admin\RelationshipsSiteSetting {
                return new Admin\RelationshipsSiteSetting(
                    $container[Admin\SiteSettingsRepository::class],
                    $container[SiteRelations::class]
                );
            }
        );

        $container->addService(
            Admin\XDefaultSiteSetting::class,
            function (Container $container): Admin\XDefaultSiteSetting {
                return new Admin\XDefaultSiteSetting(
                    $container[SiteRelations::class],
                    $container[Admin\SiteSettingsRepository::class]
                );
            }
        );

        $container->addService(
            Admin\SiteSettings::class,
            function (Container $container): Admin\SiteSettings {
                return new Admin\SiteSettings(
                    SiteSettingMultiView::fromViewModels(
                        [
                            $container[Admin\LanguageSiteSetting::class],
                            $container[Admin\RelationshipsSiteSetting::class],
                            $container[Admin\XDefaultSiteSetting::class],
                        ]
                    ),
                    $container[AssetManager::class]
                );
            }
        );

        $container->addService(
            Admin\SiteSettingsTabView::class,
            function (Container $container): Admin\SiteSettingsTabView {
                return new Admin\SiteSettingsTabView(
                    new SettingsPageTabData(
                        'multilingualpress-site-settings',
                        __('MultilingualPress', 'multilingualpress'),
                        'multilingualpress-site-settings',
                        'manage_sites'
                    ),
                    new SiteSettingsSectionView($container[Admin\SiteSettings::class]),
                    $container[ServerRequest::class],
                    $container[NonceFactory::class]->create(['save_site_settings'])
                );
            }
        );

        $container->addService(
            Admin\SiteSettingsUpdater::class,
            function (Container $container): Admin\SiteSettingsUpdater {
                return new Admin\SiteSettingsUpdater(
                    $container[Admin\SiteSettingsRepository::class],
                    $container[ServerRequest::class]
                );
            }
        );

        $container->addService(
            Admin\SiteSettingsUpdateRequestHandler::class,
            function (Container $container): Admin\SiteSettingsUpdateRequestHandler {
                return new Admin\SiteSettingsUpdateRequestHandler(
                    $container[Admin\SiteSettingsUpdater::class],
                    $container[ServerRequest::class],
                    $container[NonceFactory::class]->create(['save_site_settings'])
                );
            }
        );

        /* ---------------------------------------------------------------------------
           Post Type Slugs Site Settings
           ------------------------------------------------------------------------ */

        $container->share(
            Admin\PostTypeSlugsSettingsRepository::class,
            function (): Admin\PostTypeSlugsSettingsRepository {
                return new Admin\PostTypeSlugsSettingsRepository();
            }
        );

        $container->addService(
            Admin\PostTypeSettingsUpdater::class,
            function (Container $container): Admin\PostTypeSettingsUpdater {
                return new Admin\PostTypeSettingsUpdater(
                    $container[PostTypeRepository::class],
                    $container[NonceFactory::class]->create(['update_post_type_settings'])
                );
            }
        );

        $container->addService(
            Admin\PostTypeSlugsSettingsUpdater::class,
            function (Container $container): Admin\PostTypeSlugsSettingsUpdater {
                return new Admin\PostTypeSlugsSettingsUpdater(
                    $container[Admin\PostTypeSlugsSettingsRepository::class],
                    $container[ServerRequest::class]
                );
            }
        );

        $container->addService(
            Admin\PostTypeSlugsSettingsUpdateRequestHandler::class,
            function (Container $container): Admin\PostTypeSlugsSettingsUpdateRequestHandler {
                return new Admin\PostTypeSlugsSettingsUpdateRequestHandler(
                    $container[Admin\PostTypeSlugsSettingsUpdater::class],
                    $container[ServerRequest::class],
                    $container[NonceFactory::class]->create(['save_post_type_slugs_site_settings'])
                );
            }
        );

        $container->addService(
            Admin\TaxonomySettingsUpdater::class,
            function (Container $container): Admin\TaxonomySettingsUpdater {
                return new Admin\TaxonomySettingsUpdater(
                    $container[TaxonomyRepository::class],
                    $container[NonceFactory::class]->create(['update_taxonomy_settings'])
                );
            }
        );

        /* ---------------------------------------------------------------------------
           License Settings
           ------------------------------------------------------------------------ */

        if (defined('MULTILINGUALPRESS_NEEDS_LICENSE') && MULTILINGUALPRESS_NEEDS_LICENSE) {
            $container->addService(
                Admin\LicenseSettingsUpdater::class,
                function (Container $container): Admin\LicenseSettingsUpdater {
                    return new Admin\LicenseSettingsUpdater(
                        $container[LicenseActivator::class],
                        $container[NonceFactory::class]->create(['update_license_settings'])
                    );
                }
            );
        }
    }

    /**
     * @param Container $container
     */
    private function registerFrontend(Container $container)
    {
        $container->share(
            Frontend\AlternateLanguages::class,
            function (Container $container): Frontend\AlternateLanguages {
                return new Frontend\AlternateLanguages($container[Translations::class]);
            }
        );

        $container->addService(
            Frontend\AltLanguageController::class,
            function (): Frontend\AltLanguageController {
                return new Frontend\AltLanguageController();
            }
        );

        $container->addService(
            Frontend\AltLanguageHtmlLinkTagRenderer::class,
            function (Container $container): Frontend\AltLanguageHtmlLinkTagRenderer {
                return new Frontend\AltLanguageHtmlLinkTagRenderer(
                    $container[Frontend\AlternateLanguages::class],
                    $container[SiteSettingsRepository::class]
                );
            }
        );

        $container->addService(
            Frontend\AltLanguageHttpHeaderRenderer::class,
            function (Container $container): Frontend\AltLanguageHttpHeaderRenderer {
                return new Frontend\AltLanguageHttpHeaderRenderer(
                    $container[Frontend\AlternateLanguages::class]
                );
            }
        );

        $container->addService(
            Frontend\PostTypeLinkUrlFilter::class,
            function (Container $container): Frontend\PostTypeLinkUrlFilter {
                return new Frontend\PostTypeLinkUrlFilter($container[PostTypeRepository::class]);
            }
        );
    }

    /**
     * @inheritdoc
     */
    public function bootstrap(Container $container)
    {
        $this->bootstrapCore($container);

        if (is_admin()) {
            $this->bootstrapAdmin($container);
            is_network_admin() and $this->bootstrapNetworkAdmin($container);

            return;
        }

        $this->bootstrapFrontEnd($container);
    }

    /**
     * @param Container $container
     */
    private function bootstrapCore(Container $container)
    {
        $container[ServerRequest::class]->bodyValue(''); // Ensure Super Globals

        $this->loadTextDomain($container);

        $siteDataDeletor = $container[SiteDataDeletor::class];
        add_action('delete_blog', wpHookProxy([$siteDataDeletor, 'deleteSiteData']));

        add_filter(
            Entity\ActivePostTypes::FILTER_ACTIVE_POST_TYPES,
            function (array $postTypes) use ($container): array {
                return array_merge(
                    $postTypes,
                    $container[PostTypeRepository::class]->supportedPostTypes()
                );
            }
        );

        add_filter(
            Entity\ActiveTaxonomies::FILTER_ACTIVE_TAXONOMIES,
            function (array $taxonomies) use ($container): array {
                return array_merge(
                    $taxonomies,
                    $container[TaxonomyRepository::class]->supportedTaxonomies()
                );
            }
        );

        $licenseUpdater = $container[LicenseUpdater::class];
        add_filter(
            'pre_set_site_transient_update_plugins',
            wpHookProxy([$licenseUpdater, 'updateCheck'])
        );

        add_filter('plugins_api', [$container[LicenseUpdater::class], 'pluginInformation']);

        add_action(
            'deactivate_woocommerce/woocommerce.php',
            [$container[ModuleDeactivator::class], 'deactivateWooCommerce']
        );
    }

    /**
     * @param Container $container
     */
    private function bootstrapAdmin(Container $container)
    {
        $container[PersistentAdminNotices::class]->init();

        global $pagenow;
        $allowedPages = ['post.php', 'post-new.php', 'nav-menus.php', 'term.php', 'plugins.php'];
        if (in_array($pagenow, $allowedPages, true)) {
            $container[AssetManager::class]->enqueueScript('multilingualpress-admin');
        }

        add_action(
            'admin_post_' . Admin\PluginSettingsUpdater::ACTION,
            [$container[Admin\PluginSettingsUpdater::class], 'updateSettings']
        );

        add_action(
            'admin_post_' . Admin\SiteSettingsUpdateRequestHandler::ACTION,
            [$container[Admin\SiteSettingsUpdateRequestHandler::class], 'handlePostRequest']
        );
        add_action(
            'admin_post_' . Admin\PostTypeSlugsSettingsUpdateRequestHandler::ACTION,
            [
                $container[Admin\PostTypeSlugsSettingsUpdateRequestHandler::class],
                'handlePostRequest',
            ]
        );

        add_action(
            Admin\PluginSettingsUpdater::ACTION_UPDATE_PLUGIN_SETTINGS,
            [
                new Admin\ModuleSettingsUpdater(
                    $container[ModuleManager::class],
                    $container[NonceFactory::class]->create(['save_module_settings'])
                ),
                'updateSettings',
            ]
        );

        add_action(
            Admin\PluginSettingsUpdater::ACTION_UPDATE_PLUGIN_SETTINGS,
            [$container[Admin\PostTypeSettingsUpdater::class], 'updateSettings']
        );

        add_action(
            Admin\PluginSettingsUpdater::ACTION_UPDATE_PLUGIN_SETTINGS,
            [$container[Admin\TaxonomySettingsUpdater::class], 'updateSettings']
        );

        if (defined('MULTILINGUALPRESS_NEEDS_LICENSE') && MULTILINGUALPRESS_NEEDS_LICENSE) {
            add_action(
                Admin\PluginSettingsUpdater::ACTION_UPDATE_PLUGIN_SETTINGS,
                [$container[Admin\LicenseSettingsUpdater::class], 'updateSettings']
            );
        }

        add_action(
            'wp_ajax_' . Admin\LanguagesAjaxSearch::ACTION,
            [$container[Admin\LanguagesAjaxSearch::class], 'handle']
        );
    }

    /**
     * @param Container $container
     */
    // phpcs:disable Inpsyde.CodeQuality.FunctionLength.TooLong
    private function bootstrapNetworkAdmin(Container $container)
    {
        global $pagenow;

        $this->bootstrapSettingsPages($container);

        $editSiteTab = new EditSiteTab(
            new SettingsPageTab(
                new SettingsPageTabData(
                    'multilingualpress-site-settings',
                    __('MultilingualPress', 'multilingualpress'),
                    'multilingualpress-site-settings',
                    'manage_sites'
                ),
                $container[Admin\SiteSettingsTabView::class]
            )
        );
        $editSiteTab->register();

        add_action('init', function () use ($container) {
            if (!is_network_admin()) {
                return;
            }

            $editPostTypeSlugsSiteTab = new EditSiteTab(
                new SettingsPageTab(
                    new SettingsPageTabData(
                        'multilingualpress-post-type-slugs',
                        __('Post Type Slugs', 'multilingualpress'),
                        'multilingualpress-post-type-slugs',
                        'manage_sites'
                    ),
                    new Admin\PostTypeSlugsSettingsTabView(
                        new SettingsPageTabData(
                            'multilingualpress-post-type-slugs',
                            __('Post Type Slugs', 'multilingualpress'),
                            'multilingualpress-post-type-slugs',
                            'manage_sites'
                        ),
                        new PostTypeSlugsSettingsSectionView(new Admin\SiteSettings(
                            SiteSettingMultiView::fromViewModels(
                                $this->postTypeSlugSiteSettings($container)
                            ),
                            $container[AssetManager::class]
                        )),
                        $container[ServerRequest::class],
                        $container[NonceFactory::class]->create(['save_post_type_slugs_site_settings'])
                    )
                )
            );
            $editPostTypeSlugsSiteTab->register();
        }, PHP_INT_MAX);

        $newSiteSettings = $container[Admin\NewSiteSettings::class];

        add_action(
            'network_site_new_form',
            function () use ($newSiteSettings) {
                (new SiteSettingsSectionView($newSiteSettings))->render();
            }
        );

        $siteSettingsUpdater = $container[Admin\SiteSettingsUpdater::class];
        add_action('wpmu_new_blog', wpHookProxy([$siteSettingsUpdater, 'defineInitialSettings']));

        if (in_array($pagenow, ['site-new.php', 'sites.php'], true)
            || $this->isMultilingualPressSettingsPage($pagenow)
        ) {
            $container[AssetManager::class]->enqueueStyle('multilingualpress-admin');
        }

        if ($pagenow !== 'sites.php') {
            return;
        }

        $siteLanguageColumn = new SitesListTableColumn(
            'multilingualpress.site_language',
            __('Site Language', 'multilingualpress'),
            function (string $column, int $siteId): string {
                $language = siteLocaleName($siteId) ?: __('none', 'multilingualpress');
                return sprintf(
                    '<div class="mlp-site-language">%s</div>',
                    esc_html($language)
                );
            }
        );
        $siteLanguageColumn->register();

        $relationshipColumn = new SitesListTableColumn(
            'multilingualpress.relationships',
            __('Relationships', 'multilingualpress'),
            function (string $column, int $siteId): string {
                switch_to_blog($siteId);
                $sites = assignedLanguageNames(true, false);
                restore_current_blog();
                unset($sites[$siteId]);
                if (!$sites) {
                    return __('none', 'multilingualpress');
                }

                return sprintf(
                    '<div class="mlp-site-relations">%s</div>',
                    implode('<br>', array_map('esc_html', $sites))
                );
            }
        );
        $relationshipColumn->register();
        // phpcs:enable
    }

    /**
     * @param Container $container
     *
     * phpcs:disable Generic.Metrics.NestingLevel.TooHigh
     */
    private function bootstrapFrontEnd(Container $container)
    {
        // phpcs:enable

        $altLanguageController = $container[Frontend\AltLanguageController::class];
        $altLanguageController->registerRenderer(
            $container[Frontend\AltLanguageHtmlLinkTagRenderer::class],
            'wp_head'
        );
        $altLanguageController->registerRenderer(
            $container[Frontend\AltLanguageHttpHeaderRenderer::class],
            'template_redirect',
            11
        );

        add_filter(
            'language_attributes',
            wpHookProxy(function (string $attributes): string {
                $siteLanguage = siteLanguageTag();
                if (!$siteLanguage) {
                    return $attributes;
                }

                return preg_replace(
                    '/(lang=[\"\'])' . get_bloginfo('language') . '([\"\'])/',
                    '$1' . $siteLanguage . '$2',
                    $attributes
                );
            })
        );

        add_filter('locale', function ($locale) {
            try {
                $locale = currentSiteLocale();
            } catch (NonexistentTable $exc) {
                // Do nothing. This happen when the plugin is installed the first time.
            }

            return $locale;
        });

        $urlFilter = $container[Frontend\PostTypeLinkUrlFilter::class];
        add_action(PostTranslator::ACTION_GENERATE_PERMALINK, [$urlFilter, 'enable']);
        add_action(PostTranslator::ACTION_GENERATED_PERMALINK, [$urlFilter, 'disable']);
    }

    /**
     * Prevents collision if MLP v2 is installed and wp-content folder contains a mo file for v2.
     *
     * @param Container $container
     */
    private function loadTextDomain(Container $container)
    {
        $properties = $container[PluginProperties::class];
        $domain = $properties->textDomain();

        $locale = apply_filters(
            self::FILTER_PLUGIN_LOCALE,
            is_admin() ? get_user_locale() : get_locale(),
            $domain
        );

        $domainPath = untrailingslashit($container[PluginProperties::class]->textDomainPath());
        $dirname = basename($properties->dirPath()) . '/';
        $mofile = $dirname . ltrim($domainPath, '\\/') . "/{$domain}-{$locale}.mo";

        load_textdomain($domain, trailingslashit(WP_PLUGIN_DIR) . $mofile);
    }

    /**
     * Build the Post Type Slug Site Setting.
     *
     * @param Container $container
     * @return array
     */
    private function postTypeSlugSiteSettings(Container $container): array
    {
        $postTypesSlugsSettings = [];
        $allAvailablePostTypes = $container[PostTypeRepository::class]->allAvailablePostTypes();
        unset(
            $allAvailablePostTypes['post'],
            $allAvailablePostTypes['page'],
            $allAvailablePostTypes['product']
        );

        foreach ($allAvailablePostTypes as $postType) {
            $postTypesSlugsSettings[] = new PostTypeSlugSetting(
                $container[PostTypeSlugsSettingsRepository::class],
                $container[PostTypeRepository::class],
                $postType
            );
        }

        return $postTypesSlugsSettings;
    }

    /**
     * @param Container $container
     */
    private function bootstrapSettingsPages(Container $container)
    {
        $properties = $container[PluginProperties::class];
        $multilingualPressPage = new SettingsPage(
            SettingsPage::ADMIN_NETWORK,
            __('MultilingualPress', 'multilingualpress'),
            __('MultilingualPress', 'multilingualpress'),
            'manage_network_options',
            'multilingualpress',
            $container[Admin\PluginSettingsPageView::class],
            untrailingslashit($properties->dirUrl()) . '/resources/images/mlp-admin-icon.png'
        );
        $settingsPage = new SettingsPage(
            SettingsPage::ADMIN_NETWORK,
            __('MultilingualPress', 'multilingualpress'),
            __('Settings', 'multilingualpress'),
            'manage_network_options',
            'multilingualpress',
            $container[Admin\PluginSettingsPageView::class]
        );

        add_action('plugins_loaded', [$multilingualPressPage, 'register'], 8);

        add_filter(
            'network_admin_plugin_action_links_' . $properties->basename(),
            wpHookProxy(function (array $links) use ($settingsPage) : array {
                // phpcs:enable
                $url = $settingsPage->url();
                $label = esc_html__('Settings', 'multilingualpress');

                return array_merge(
                    $links,
                    ['settings' => sprintf('<a href="%s">%s</a>', esc_url($url), $label)]
                );
            })
        );

        add_action('admin_enqueue_scripts', function () {
            // phpcs:disable Inpsyde.CodeQuality.VariablesName.SnakeCaseVar
            // phpcs:disable Inpsyde.CodeQuality.LineLength.TooLong
            $custom_css = '#adminmenu .toplevel_page_multilingualpress .wp-menu-image img { padding: 6px 0 0 0; width: 74%;}';
            wp_add_inline_style('dashicons', $custom_css);
            // phpcs:enable
        });
    }

    /**
     * @param string $currentPage
     * @return bool
     */
    private function isMultilingualPressSettingsPage(string $currentPage): bool
    {
        $adminPage = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
        $isAdminPage = 'admin.php' === $currentPage;
        $isAllowedPage = $adminPage === 'multilingualpress';

        return $isAllowedPage and $isAdminPage;
    }
}
