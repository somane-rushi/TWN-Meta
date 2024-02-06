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

namespace Inpsyde\MultilingualPress\Module\WooCommerce;

use Inpsyde\MultilingualPress\Asset\AssetFactory;
use Inpsyde\MultilingualPress\Core\Entity\ActivePostTypes;
use Inpsyde\MultilingualPress\Core\TaxonomyRepository;
use Inpsyde\MultilingualPress\Framework\Admin\PersistentAdminNotices;
use Inpsyde\MultilingualPress\Framework\Api\ContentRelations;
use Inpsyde\MultilingualPress\Framework\Api\SiteRelations;
use Inpsyde\MultilingualPress\Framework\Asset\AssetManager;
use Inpsyde\MultilingualPress\Framework\Factory\UrlFactory;
use Inpsyde\MultilingualPress\Framework\Http\Request;
use Inpsyde\MultilingualPress\Framework\Module\Module;
use Inpsyde\MultilingualPress\Framework\Module\ModuleManager;
use Inpsyde\MultilingualPress\Framework\Module\ModuleServiceProvider;
use Inpsyde\MultilingualPress\Framework\Service\Container;
use Inpsyde\MultilingualPress\TranslationUi\Term\RelationshipPermission;
use Inpsyde\MultilingualPress\Translator\PostTranslator;
use Inpsyde\MultilingualPress\Translator\PostTypeTranslator;
use Inpsyde\MultilingualPress\Translator\TermTranslator;
use Inpsyde\MultilingualPress\TranslationUi\Post;
use Inpsyde\MultilingualPress\Module\WooCommerce\TranslationUi\Product;
use Inpsyde\MultilingualPress\Attachment;

/**
 * Class ServiceProvider
 */
class ServiceProvider implements ModuleServiceProvider
{
    const MODULE_ID = 'woocommerce';

    /**
     * @inheritdoc
     */
    public function registerModule(ModuleManager $moduleManager): bool
    {
        $disabledDescription = '';
        $description = __(
            'Enable WooCommerce Support for MultilingualPress.',
            'multilingualpress'
        );

        if (!$this->isWooCommerceActive()) {
            $disabledDescription = __(
                'The module can be activated only if WooCommerce is active at least in the main site.',
                'multilingualpress'
            );
        }

        return $moduleManager->register(
            new Module(
                self::MODULE_ID,
                [
                    'description' => "{$description} {$disabledDescription}",
                    'name' => __('WooCommerce', 'multilingualpress'),
                    'active' => true,
                    'disabled' => !$this->isWooCommerceActive(),
                ]
            )
        );
    }

    /**
     * @inheritdoc
     *
     * phpcs:disable Inpsyde.CodeQuality.FunctionLength.TooLong
     */
    public function register(Container $container)
    {
        // phpcs:enable

        if (!$this->isWooCommerceActive()) {
            return;
        }

        $container->addService(
            PermalinkStructure::class,
            function (): PermalinkStructure {
                return new PermalinkStructure();
            }
        );

        $container->addService(
            AttributesRelationship::class,
            function () use ($container): AttributesRelationship {
                return new AttributesRelationship(
                    $container[TaxonomyRepository::class],
                    $container[SiteRelations::class],
                    $container[\wpdb::class]
                );
            }
        );

        $container->addService(
            ArchiveProducts::class,
            function (): ArchiveProducts {
                return new ArchiveProducts();
            }
        );

        $container->addService(
            AvailableTaxonomiesAttributes::class,
            function (): AvailableTaxonomiesAttributes {
                return new AvailableTaxonomiesAttributes();
            }
        );

        $container->addService(
            AttributeTermTranslateUrl::class,
            function (Container $container): AttributeTermTranslateUrl {
                return new AttributeTermTranslateUrl(
                    $container[\wpdb::class],
                    $container[UrlFactory::class]
                );
            }
        );
    }

    /**
     * @inheritdoc
     */
    public function activateModule(Container $container)
    {
        if (!$this->isWooCommerceActive()) {
            return;
        }

        $attributeTermTranslateUrl = $container[AttributeTermTranslateUrl::class];
        $attributesRelationship = $container[AttributesRelationship::class];

        $this->assets($container);
        $this->activateBasePermalinkStructures($container);
        $this->activateProductMetaboxes($container);
        $this->removeAttributeTaxonomiesFieldsFromPostMetabox();

        add_filter(
            PostTypeTranslator::FILTER_POST_TYPE_PERMALINK,
            [$container[ArchiveProducts::class], 'shopArchiveUrl'],
            10,
            3
        );

        add_filter(
            TermTranslator::FILTER_TRANSLATION,
            [$attributeTermTranslateUrl, 'termLinkByTaxonomyId'],
            10,
            4
        );
        add_action('setup_theme', function () use ($attributeTermTranslateUrl) {
            global $wp_rewrite;
            $attributeTermTranslateUrl->ensureWpRewrite($wp_rewrite);
        });

        add_filter(
            TaxonomyRepository::FILTER_ALL_AVAILABLE_TAXONOMIES,
            [$container[AvailableTaxonomiesAttributes::class], 'removeAttributes']
        );

        add_action(
            'edit_tag_form_pre',
            [$attributesRelationship, 'createAttributeRelation']
        );

        $attributesHookNames = ['woocommerce_attribute_added', 'woocommerce_attribute_updated'];
        array_walk($attributesHookNames, function (string $hookName) use ($attributesRelationship) {
            add_action($hookName, [$attributesRelationship, 'addSupportForAttribute'], 10, 2);
        });
    }

    /**
     * @param Container $container
     */
    private function activateBasePermalinkStructures(Container $container)
    {
        $permalinkStructure = $container[PermalinkStructure::class];
        $postTranslator = $container[PostTranslator::class];
        $termTranslator = $container[TermTranslator::class];

        $postTranslator->registerBaseStructureCallback(
            'product',
            [$permalinkStructure, 'baseforProduct']
        );
        $termTranslator->registerBaseStructureCallback(
            'product_cat',
            [$permalinkStructure, 'forProductCategory']
        );
        $termTranslator->registerBaseStructureCallback(
            'product_tag',
            [$permalinkStructure, 'forProductTag']
        );

        $attributeTaxonomies = wc_get_attribute_taxonomies();
        $attributeTaxonomies and array_walk(
            $attributeTaxonomies,
            function (\stdClass $attribute) use ($termTranslator, $permalinkStructure) {
                $taxonomySlug = 'pa_' . sanitize_key($attribute->attribute_name);
                $termTranslator->registerBaseStructureCallback(
                    $taxonomySlug,
                    [$permalinkStructure, 'forProductAttribute']
                );
            }
        );
    }

    /**
     * Add Metaboxes for Product
     *
     * @param Container $container
     *
     * phpcs:disable Inpsyde.CodeQuality.FunctionLength.TooLong
     * phpcs:disable Generic.Metrics.NestingLevel.TooHigh
     */
    private function activateProductMetaboxes(Container $container)
    {
        // phpcs:enable

        $wooCommerceMetaboxFields = new Product\WooCommerceMetaboxFields();
        $panelView = new Product\PanelView(
            new Product\SettingView(
                'general',
                ...$wooCommerceMetaboxFields->generalSettingFields()
            ),
            new Product\SettingView(
                'inventory',
                ...$wooCommerceMetaboxFields->inventorySettingFields()
            ),
            new Product\SettingView(
                'advanced',
                ...$wooCommerceMetaboxFields->advancedSettingFields()
            )
        );
        $metaboxActivator = new ProductMetaboxesBehaviorActivator(
            new Product\MetaboxFields($wooCommerceMetaboxFields),
            $panelView,
            $container[ActivePostTypes::class],
            $container[ContentRelations::class],
            $container[Attachment\Copier::class],
            $container[PersistentAdminNotices::class]
        );

        add_filter(
            Post\Metabox::HOOK_PREFIX . 'tabs',
            [$metaboxActivator, 'setupMetaboxFields'],
            10,
            2
        );

        add_action(
            Product\MetaboxTab::ACTION_BEFORE_METABOX_UI_PANEL,
            [$metaboxActivator, 'renderPanels'],
            20,
            2
        );

        add_action(
            Post\MetaboxAction::ACTION_METABOX_AFTER_RELATE_POSTS,
            [$metaboxActivator, 'saveMetaboxes'],
            10,
            3
        );
    }

    /**
     * Do not add the attributes taxonomies to the list of translatable taxonomies.
     * Them are handled differently within the Product Tab.
     */
    private function removeAttributeTaxonomiesFieldsFromPostMetabox()
    {
        $removeAttributeTaxonomiesNameCallback = function (array $taxonomiesSlugs): array {
            $attributeTaxonomies = wc_get_attribute_taxonomy_names();
            foreach ($attributeTaxonomies as $taxonomyName) {
                unset($taxonomiesSlugs[$taxonomyName]);
            }

            return $taxonomiesSlugs;
        };

        add_filter(
            Post\Field\TaxonomySlugs::FILTER_FIELD_TAXONOMY_SLUGS,
            $removeAttributeTaxonomiesNameCallback
        );
        add_filter(
            Post\MetaboxAction::FILTER_TAXONOMIES_SLUGS_BEFORE_REMOVE,
            $removeAttributeTaxonomiesNameCallback
        );
        add_filter(
            Post\MetaboxFields::FILTER_TAXONOMIES_AND_TERMS_OF,
            function ($taxonomiesSlugs) {
                $attributeTaxonomies = wc_get_attribute_taxonomy_names();
                $taxonomiesSlugs = array_filter(
                    $taxonomiesSlugs,
                    function (string $taxonomySlug) use ($attributeTaxonomies): bool {
                        return !\in_array($taxonomySlug, $attributeTaxonomies, true);
                    }
                );
                return $taxonomiesSlugs;
            }
        );
    }

    /**
     * Setup assets for WooCommerce
     *
     * @param Container $container
     */
    private function assets(Container $container)
    {
        global $pagenow;

        if (!$this->isEditProductPage($pagenow)) {
            return;
        }

        $assetFactory = $container[AssetFactory::class];
        $container[AssetManager::class]
            ->registerStyle(
                $assetFactory->createInternalStyle(
                    'multilingualpress-woocommerce-admin',
                    'woocommerce-admin.css'
                )
            )
            ->registerScript(
                $assetFactory->createInternalScript(
                    'multilingualpress-woocommerce-admin',
                    'woocommerce-admin.js',
                    ['jquery']
                )
            );

        $container[AssetManager::class]->enqueueStyle('multilingualpress-woocommerce-admin');
        $container[AssetManager::class]->enqueueScript('multilingualpress-woocommerce-admin');
    }

    /**
     * @return bool
     */
    private function isWooCommerceActive(): bool
    {
        return \function_exists('wc');
    }

    /**
     * Check if the current admin edit page is for post type product
     *
     * @param string $currentPage
     * @return bool
     */
    private function isEditProductPage(string $currentPage): bool
    {
        $postId = (int)filter_input(INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT);
        $isAllowedPage = \in_array($currentPage, ['post.php', 'post-new.php'], true);

        $requestPostType = (string)filter_input(INPUT_GET, 'post_type', FILTER_SANITIZE_STRING);
        $requestPostType = $requestPostType ?: get_post_type($postId);

        return $isAllowedPage && 'product' === $requestPostType;
    }
}
