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

namespace Inpsyde\MultilingualPress\Module\WooCommerce\TranslationUi\Product;

use Inpsyde\MultilingualPress\Attachment;
use Inpsyde\MultilingualPress\Core\Entity\ActivePostTypes;
use Inpsyde\MultilingualPress\Framework\Admin\AdminNotice;
use Inpsyde\MultilingualPress\Framework\Admin\Metabox;
use Inpsyde\MultilingualPress\Framework\Admin\PersistentAdminNotices;
use Inpsyde\MultilingualPress\Framework\Api\ContentRelations;
use Inpsyde\MultilingualPress\Framework\Http\Request;
use Inpsyde\MultilingualPress\TranslationUi\MetaboxFieldsHelper;
use Inpsyde\MultilingualPress\TranslationUi\Post;

/**
 * Class MetaboxAction
 * @package Inpsyde\MultilingualPress\Module\WooCommerce\TranslationUi\Product
 */
final class MetaboxAction implements Metabox\Action
{
    const RELATIONSHIP_TYPE = 'post';
    const POST_TYPE = 'product';
    const DEFAULT_PRODUCT_TYPE = 'simple';

    const PRODUCT_TYPE_TAXONOMY_NAME = 'product_type';
    const PRODUCT_TYPE_FIELD_NAME = 'product-type';
    const PRODUCT_GALLERY_META_KEY = 'product_image_gallery';
    // phpcs:disable Inpsyde.CodeQuality.LineLength.TooLong
    const ACTION_METABOX_BEFORE_UPDATE_REMOTE_PRODUCT = 'multilingualpress.metabox_before_update_remote_product';
    const ACTION_METABOX_AFTER_UPDATE_REMOTE_PRODUCT = 'multilingualpress.metabox_before_update_remote_product';
    // phpcs:enable

    /**
     * @var array
     */
    private static $calledCount = [];

    /**
     * @var ContentRelations
     */
    private $contentRelations;

    /**
     * @var Post\SourcePostSaveContext
     */
    private $sourcePostContext;

    /**
     * @var ActivePostTypes
     */
    private $postTypes;

    /**
     * @var Post\RelationshipContext
     */
    private $postRelationshipContext;

    /**
     * @var MetaboxFieldsHelper
     */
    private $fieldsHelper;

    /**
     * @var MetaboxFields
     */
    private $metaboxFields;

    /**
     * @var Attachment\Copier
     */
    private $attachmentCopier;

    private $notice;

    /**
     * MetaboxAction constructor
     *
     * @param Post\RelationshipContext $postRelationshipContext
     * @param ActivePostTypes $postTypes
     * @param ContentRelations $contentRelations
     * @param Attachment\Copier $attachmentCopier
     * @param MetaboxFields $metaboxFields
     * @param PersistentAdminNotices $notice
     */
    public function __construct(
        Post\RelationshipContext $postRelationshipContext,
        ActivePostTypes $postTypes,
        ContentRelations $contentRelations,
        Attachment\Copier $attachmentCopier,
        MetaboxFields $metaboxFields,
        PersistentAdminNotices $notice
    ) {

        $this->postRelationshipContext = $postRelationshipContext;
        $this->postTypes = $postTypes;
        $this->contentRelations = $contentRelations;
        $this->fieldsHelper = new MetaboxFieldsHelper($postRelationshipContext->remoteSiteId());
        $this->attachmentCopier = $attachmentCopier;
        $this->metaboxFields = $metaboxFields;
        $this->notice = $notice;
    }

    /**
     * @inheritdoc
     */
    public function save(Request $request, PersistentAdminNotices $notices): bool
    {
        if (!$this->isValidSaveRequest($this->sourceContext($request))) {
            return false;
        }

        $relationshipHelper = new ProductRelationSaveHelper($request, $this->contentRelations);

        return $this->doSaveOperation($request, $relationshipHelper, $notices);
    }

    /**
     * Do the operation necessary to store the data for the current product.
     *
     * @param Request $request
     * @param ProductRelationSaveHelper $relationshipHelper
     * @param PersistentAdminNotices $notices
     * @return bool
     *
     * phpcs:disable Inpsyde.CodeQuality.FunctionLength.TooLong
     */
    private function doSaveOperation(
        Request $request,
        ProductRelationSaveHelper $relationshipHelper,
        PersistentAdminNotices $notices
    ): bool {

        // phpcs:enable

        $sourceProductVariations = [];
        $sourceSiteId = $this->postRelationshipContext->sourceSiteId();
        $sourceProductId = $this->postRelationshipContext->sourcePostId();
        $remoteSiteId = $this->postRelationshipContext->remoteSiteId();

        if ($sourceSiteId === $remoteSiteId || !$this->postRelationshipContext->hasRemotePost()) {
            return true;
        }

        switch_to_blog($sourceSiteId);
        /** @var \WC_Product $sourceProduct */
        $sourceProduct = wc_get_product($this->postRelationshipContext->sourcePost());
        if ($sourceProduct instanceof \WC_Product_Variable) {
            $sourceProductVariations = $this->variationProducts($sourceProduct);
        }
        restore_current_blog();

        $values = $this->allFieldsValues($request);
        $overrideProductType = $this->maybeOverrideProductType($values);

        $remoteProduct = $relationshipHelper->remoteProduct(
            $sourceSiteId,
            $sourceProductId,
            $remoteSiteId,
            $overrideProductType
        );

        if (!$remoteProduct) {
            return true;
        }
        if (!current_user_can('edit_product', $remoteProduct->get_id())) {
            return false;
        }

        $overrideVariations = $values[MetaboxFields::FIELD_OVERRIDE_VARIATIONS] ?? false;
        $overrideAttributes = $values[MetaboxFields::FIELD_OVERRIDE_ATTRIBUTES] ?? false;
        if ($overrideVariations || $overrideAttributes) {
            $this->setRemoteProductAttributes(
                $sourceProduct,
                $remoteProduct,
                $relationshipHelper
            );
        }

        $sku = $values[MetaboxFields::FIELD_SKU] ?? '';
        $sku and $this->maybeSetSku($remoteProduct, $sku);

        $overrideDownloadableFiles = $values[MetaboxFields::FIELD_OVERRIDE_DOWNLOADABLE_FILES] ?? false;
        $overrideDownloadableFiles and $this->maybeSetDownloadableFiles(
            $sourceProduct,
            $remoteProduct
        );

        $this->maybeSetProductUrlAndButtonText(
            $remoteProduct,
            $values[MetaboxFields::FIELD_PRODUCT_URL] ?? '',
            $values[MetaboxFields::FIELD_PRODUCT_URL_BUTTON_TEXT] ?? ''
        );

        $regularPrice = $values[MetaboxFields::FIELD_REGULAR_PRICE] ?? '';
        $regularPrice and $remoteProduct->set_regular_price($regularPrice);

        $salePrice = $values[MetaboxFields::FIELD_SALE_PRICE] ?? '';
        $salePrice and $remoteProduct->set_sale_price($salePrice);

        $productShortDescription = $values[MetaboxFields::FIELD_PRODUCT_SHORT_DESCRIPTION] ?? '';
        $productShortDescription and $remoteProduct->set_short_description($productShortDescription);

        $purchaseNote = $values[MetaboxFields::FIELD_PURCHASE_NOTE] ?? '';
        $purchaseNote and $remoteProduct->set_purchase_note($purchaseNote);

        $overrideProductGallery = $values[MetaboxFields::FIELD_OVERRIDE_PRODUCT_GALLERY] ?? false;
        $overrideProductGallery and $this->setProductGalleryIds(
            $remoteProduct,
            $sourceSiteId,
            $remoteSiteId,
            $request
        );

        $overrideGroupedProducts = $values[MetaboxFields::FIELD_GROUPED_PRODUCTS] ?? false;
        $overrideGroupedProducts and $this->maybeSetGroupedProducts(
            $relationshipHelper,
            $sourceProduct,
            $remoteProduct
        );

        $overrideUpsellsProducts = $values[MetaboxFields::FIELD_UPSELLS_PRODUCTS] ?? false;
        $overrideUpsellsProducts and $this->maybeSetUpsellsProducts(
            $relationshipHelper,
            $sourceProduct,
            $remoteProduct
        );

        $overrideCrossellsProducts = $values[MetaboxFields::FIELD_CROSSELLS_PRODUCTS] ?? false;
        $overrideCrossellsProducts and $this->maybeSetCrossellsProducts(
            $relationshipHelper,
            $sourceProduct,
            $remoteProduct
        );

        /**
         * Performs an action before the product has been updated
         *
         * @param Post\RelationshipContext $relationshipContext
         * @param \WC_Product $remoteProduct
         * @param \WC_Product $sourceProduct
         */
        do_action(
            self::ACTION_METABOX_BEFORE_UPDATE_REMOTE_PRODUCT,
            $this->postRelationshipContext,
            $remoteProduct,
            $sourceProduct
        );

        $updated = $remoteProduct->save();

        /**
         * Performs an action after the product has been updated
         *
         * @param Post\RelationshipContext $relationshipContext
         * @param \WC_Product $remoteProduct
         * @param \WC_Product $sourceProduct
         */
        do_action(
            self::ACTION_METABOX_AFTER_UPDATE_REMOTE_PRODUCT,
            $this->postRelationshipContext,
            $remoteProduct,
            $sourceProduct
        );

        if (!$updated) {
            $message = __(
                'Error updating products data. Something went wrong.',
                'multilingualpress'
            );
            $notices->add(AdminNotice::error($message));

            return false;
        }

        if ($overrideVariations) {
            $this->saveRemoteProductVariations(
                $remoteProduct,
                $sourceProductVariations,
                $relationshipHelper
            );
        }

        if ($overrideProductGallery) {
            $this->attachGalleryImagesToProduct($remoteProduct);
        }

        return true;
    }

    /**
     * Set the sku for the remote product
     * If a product with the same sku exists, set an admin notice to inform the user
     *
     * @param string $sku
     * @param \WC_Product $remoteProduct
     */
    private function maybeSetSku(\WC_Product $remoteProduct, string $sku)
    {
        try {
            $sku and $remoteProduct->set_sku($sku);
        } catch (\WC_Data_Exception $exc) {
            $message = sprintf(
                '%s Anyhow, your products are connected, remember to set the correct sku for the remote product.',
                $exc->getMessage()
            );
            $adminNotice = AdminNotice::error($message);
            $adminNotice->makeDismissible();
            $this->notice->add($adminNotice, 'product');
        }
    }

    /**
     * Set grouped products to remote site by retrieve the related products
     * by the source one.
     *
     * @param ProductRelationSaveHelper $relationshipHelper
     * @param \WC_Product $sourceProduct
     * @param \WC_Product $remoteProduct
     * @return bool
     */
    private function maybeSetGroupedProducts(
        ProductRelationSaveHelper $relationshipHelper,
        \WC_Product $sourceProduct,
        \WC_Product $remoteProduct
    ): bool {

        if (!$sourceProduct instanceof \WC_Product_Grouped
            || !$remoteProduct instanceof \WC_Product_Grouped
        ) {
            return false;
        }

        $sourceGroupedProductIds = $sourceProduct->get_children('edit');
        if (!$sourceGroupedProductIds) {
            return false;
        }

        $sourceSiteId = $this->postRelationshipContext->sourceSiteId();
        $remoteSiteId = $this->postRelationshipContext->remoteSiteId();
        $remoteGroupedProducts = $relationshipHelper->relatedProductsForSiteId(
            $sourceSiteId,
            $remoteSiteId,
            $sourceGroupedProductIds
        );

        if (!$remoteGroupedProducts) {
            return false;
        }

        $remoteProduct->set_children($remoteGroupedProducts);

        return true;
    }

    /**
     * Set the upsells products for the remote product
     *
     * @param ProductRelationSaveHelper $relationshipHelper
     * @param \WC_Product $sourceProduct
     * @param \WC_Product $remoteProduct
     * @return bool
     */
    private function maybeSetUpsellsProducts(
        ProductRelationSaveHelper $relationshipHelper,
        \WC_Product $sourceProduct,
        \WC_Product $remoteProduct
    ): bool {

        $sourceUpsellsProductIds = $sourceProduct->get_upsell_ids('edit');
        if (!$sourceUpsellsProductIds) {
            return false;
        }

        $sourceSiteId = $this->postRelationshipContext->sourceSiteId();
        $remoteSiteId = $this->postRelationshipContext->remoteSiteId();
        $remoteUpsellsProducts = $relationshipHelper->relatedProductsForSiteId(
            $sourceSiteId,
            $remoteSiteId,
            $sourceUpsellsProductIds
        );

        if (!$remoteUpsellsProducts) {
            return false;
        }

        $remoteProduct->set_upsell_ids($remoteUpsellsProducts);

        return true;
    }

    /**
     * Set the cross sells product for the remote product by retrieve the related products
     * by the source one.
     *
     * @param ProductRelationSaveHelper $relationshipHelper
     * @param \WC_Product $sourceProduct
     * @param \WC_Product $remoteProduct
     * @return bool
     */
    private function maybeSetCrossellsProducts(
        ProductRelationSaveHelper $relationshipHelper,
        \WC_Product $sourceProduct,
        \WC_Product $remoteProduct
    ): bool {

        $sourceCrossellsProductIds = $sourceProduct->get_cross_sell_ids('edit');
        if (!$sourceCrossellsProductIds) {
            return false;
        }

        $sourceSiteId = $this->postRelationshipContext->sourceSiteId();
        $remoteSiteId = $this->postRelationshipContext->remoteSiteId();
        $remoteUpsellsProducts = $relationshipHelper->relatedProductsForSiteId(
            $sourceSiteId,
            $remoteSiteId,
            $sourceCrossellsProductIds
        );

        if (!$remoteUpsellsProducts) {
            return false;
        }

        $remoteProduct->set_cross_sell_ids($remoteUpsellsProducts);

        return true;
    }

    /**
     * Set Product Gallery Ids
     *
     * @param \WC_Product $remoteProduct
     * @param int $sourceSiteId
     * @param int $remoteSiteId
     * @param Request $request
     * @return bool
     */
    private function setProductGalleryIds(
        \WC_Product $remoteProduct,
        int $sourceSiteId,
        int $remoteSiteId,
        Request $request
    ): bool {

        $productAttachmentIds = (string)$request->bodyValue(
            self::PRODUCT_GALLERY_META_KEY,
            INPUT_POST,
            FILTER_SANITIZE_STRING
        );

        $productAttachmentIds = explode(',', $productAttachmentIds);
        if (!$productAttachmentIds) {
            return false;
        }

        switch_to_blog($sourceSiteId);
        $remoteAttachmentIds = $this->attachmentCopier->copyById(
            $sourceSiteId,
            $remoteSiteId,
            $productAttachmentIds
        );
        restore_current_blog();

        if (!$remoteAttachmentIds) {
            return false;
        }

        $remoteProduct->set_gallery_image_ids($remoteAttachmentIds);

        return true;
    }

    /**
     * Attach Product Gallery Images to their own product
     *
     * @param \WC_Product $product
     */
    private function attachGalleryImagesToProduct(\WC_Product $product)
    {
        $attachmentIds = array_map('intval', $product->get_gallery_image_ids('edit'));
        $attachmentIds = array_filter($attachmentIds, function (int $id): bool {
            return $id > 0;
        });
        $attachmentIds = array_filter($attachmentIds);

        foreach ($attachmentIds as $attachmentId) {
            wp_update_post([
                'ID' => $attachmentId,
                'post_parent' => $product->get_id(),
            ]);
        }
    }

    /**
     * Set Product Url and Button text if product type is an external one
     *
     * @param \WC_Product $remoteProduct
     * @param string $url
     * @param string $buttonText
     * @return bool
     */
    private function maybeSetProductUrlAndButtonText(
        \WC_Product $remoteProduct,
        string $url,
        string $buttonText
    ): bool {

        if (!$url
            || !$buttonText
            || !$remoteProduct instanceof \WC_Product_External
        ) {
            return false;
        }

        $remoteProduct->set_product_url($url);
        $remoteProduct->set_button_text($buttonText);

        return true;
    }

    /**
     * Set the remote product attributes
     *
     * @param \WC_Product $sourceProduct
     * @param \WC_Product $remoteProduct
     * @param ProductRelationSaveHelper $relationshipHelper
     * @return bool
     */
    private function setRemoteProductAttributes(
        \WC_Product $sourceProduct,
        \WC_Product $remoteProduct,
        ProductRelationSaveHelper $relationshipHelper
    ): bool {

        $attributes = $sourceProduct->get_attributes('edit');

        if (!$attributes) {
            return true;
        }

        $remoteAttributeTerms = $this->duplicateAttributes(
            $relationshipHelper,
            $this->postRelationshipContext,
            $sourceProduct
        );

        $remoteProduct->set_attributes(array_merge(
            $sourceProduct->get_attributes(),
            $remoteAttributeTerms
        ));

        return true;
    }

    /**
     * Store the remote product variations.
     *
     * @param \WC_Product $remoteProduct
     * @param array $sourceVariations
     * @param ProductRelationSaveHelper $relationshipHelper
     * @return bool
     */
    private function saveRemoteProductVariations(
        \WC_Product $remoteProduct,
        array $sourceVariations,
        ProductRelationSaveHelper $relationshipHelper
    ): bool {

        /** @var \WC_Product_Variable_Data_Store_CPT $variableDataStore */
        $variableDataStore = \WC_Data_Store::load('product-variable');
        $variableDataStore->delete_variations($remoteProduct->get_id());

        if (!$remoteProduct instanceof \WC_Product_Variable) {
            return false;
        }

        if (!$sourceVariations) {
            return true;
        }

        /** @var \WC_Product_Variation $sourceVariation */
        foreach ($sourceVariations as $sourceVariation) {
            $remoteAttributeTerms = $relationshipHelper->relatedAttributeTerms(
                $this->postRelationshipContext,
                $sourceVariation
            );

            $remoteVariation = $this->cloneVariationWithRemoteTerms(
                $relationshipHelper,
                $sourceVariation,
                $remoteAttributeTerms,
                $remoteProduct
            );

            $remoteVariation->save();
        }

        return true;
    }

    /**
     * Retrieve the variations products.
     *
     * @param \WC_Product_Variable $product
     * @return array
     */
    private function variationProducts(\WC_Product_Variable $product): array
    {
        $variations = [];
        foreach ($product->get_children() as $childId) {
            $variation = wc_get_product($childId);
            if (!$variation || !$variation instanceof \WC_Product_Variation) {
                continue;
            }
            $variations[] = $variation;
        }
        $variations = array_filter($variations);

        return $variations;
    }

    /**
     * Duplicate attributes and create taxonomy and terms into the remote site if needed.
     *
     * @param ProductRelationSaveHelper $helper
     * @param Post\RelationshipContext $context
     * @param \WC_Product $product
     * @return array
     */
    private function duplicateAttributes(
        ProductRelationSaveHelper $helper,
        Post\RelationshipContext $context,
        \WC_Product $product
    ): array {

        $attributes = $product->get_attributes();
        $targetAttributes = [];

        if (!$attributes) {
            return [];
        }

        $attributes = $helper->filterProductAttributesTerms($attributes);

        /** @var \WC_Product_Attribute $attribute */
        foreach ($attributes as $taxonomyName => $attribute) {
            $termsIds = $attribute->get_data()['options'];

            $targetAttributesTermsIds = $helper->mayRelateTerms(
                $termsIds,
                $context->sourceSiteId(),
                $context->remoteSiteId(),
                $taxonomyName
            );

            $targetAttributes[$taxonomyName] = $this->duplicateProductAttributeWithCustomOptions(
                $attribute,
                $targetAttributesTermsIds
            );
        }

        return $targetAttributes;
    }

    /**
     * Clone source variations by setting up custom attribute terms.
     *
     * @param ProductRelationSaveHelper $helper
     * @param \WC_Product_Variation $sourceVariation
     * @param array $remoteAttributeTerms
     * @param \WC_Product $remoteProduct
     * @return \WC_Product_Variation
     */
    private function cloneVariationWithRemoteTerms(
        ProductRelationSaveHelper $helper,
        \WC_Product_Variation $sourceVariation,
        array $remoteAttributeTerms,
        \WC_Product $remoteProduct
    ): \WC_Product_Variation {

        $remoteVariation = new \WC_Product_Variation();
        $sourceVariationAttributes = $helper->filterProductCustomAttributes(
            $sourceVariation->get_attributes('edit')
        );

        $remoteVariation->set_parent_id($remoteProduct->get_id());
        $remoteVariation->set_attributes(array_merge(
            $sourceVariationAttributes,
            $remoteAttributeTerms
        ));
        $remoteVariation->set_props([
            'description' => $sourceVariation->get_description('edit'),
            'status' => $sourceVariation->get_status('edit'),
            'menu_order' => $sourceVariation->get_menu_order('edit'),
            'date_on_sale_from' => $sourceVariation->get_date_on_sale_from('edit'),
            'date_on_sale_to' => $sourceVariation->get_date_on_sale_to('edit'),
            'manage_stock' => $sourceVariation->get_manage_stock('edit'),
            'virtual' => $sourceVariation->get_virtual('edit'),
            'downloads' => $sourceVariation->get_downloads('edit'),
            'downloadable' => $sourceVariation->get_downloadable('edit'),
            'download_limit' => $sourceVariation->get_download_limit('edit'),
            'download_expiry' => $sourceVariation->get_download_expiry('edit'),
            'backorders' => $sourceVariation->get_backorders('edit'),
            'sku' => $sourceVariation->get_sku('edit'),
            'stock_quantity' => $sourceVariation->get_stock_quantity('edit'),
            'weight' => $sourceVariation->get_weight('edit'),
            'length' => $sourceVariation->get_length('edit'),
            'width' => $sourceVariation->get_width('edit'),
            'height' => $sourceVariation->get_height('edit'),
            'tax_class' => $sourceVariation->get_tax_class('edit'),
        ]);

        $remoteVariation->set_price($sourceVariation->get_regular_price('edit'));
        if ($sourceVariation->is_on_sale('edit')) {
            $remoteVariation->set_price($sourceVariation->get_sale_price('edit'));
        }

        return $remoteVariation;
    }

    /**
     * Clone Product Attribute.
     *
     * @param \WC_Product_Attribute $sourceAttribute
     * @param array $options
     * @return \WC_Product_Attribute
     */
    private function duplicateProductAttributeWithCustomOptions(
        \WC_Product_Attribute $sourceAttribute,
        array $options
    ): \WC_Product_Attribute {

        $taxonomyName = $sourceAttribute->get_name();
        $id = wc_attribute_taxonomy_id_by_name($taxonomyName);

        $productAttribute = new \WC_Product_Attribute();

        $productAttribute->set_id($id);
        $productAttribute->set_name($taxonomyName);
        $productAttribute->set_options($options);
        $productAttribute->set_visible($sourceAttribute->get_visible());
        $productAttribute->set_position($sourceAttribute->get_position());
        $productAttribute->set_variation($sourceAttribute->get_variation());

        return $productAttribute;
    }

    /**
     * Set downloadable files if the product is downloadable
     *
     * @param \WC_Product $sourceProduct
     * @param \WC_Product $remoteProduct
     * @return bool
     */
    private function maybeSetDownloadableFiles(
        \WC_Product $sourceProduct,
        \WC_Product $remoteProduct
    ): bool {

        $downloads = $sourceProduct->get_downloads();
        if (!$downloads || !$sourceProduct->is_downloadable()) {
            return false;
        }

        $remoteProduct->set_downloadable(true);
        $remoteProduct->set_downloads($downloads);

        return true;
    }

    /**
     * Check if the current request should be processed by save().
     *
     * @param Post\SourcePostSaveContext $context
     * @return bool
     */
    private function isValidSaveRequest(Post\SourcePostSaveContext $context): bool
    {
        $site = $this->postRelationshipContext->remoteSiteId();
        array_key_exists($site, self::$calledCount) or self::$calledCount[$site] = 0;

        // For auto-drafts, 'save_post' is called twice, resulting in doubled drafts for translations.
        self::$calledCount[$site]++;

        return
            self::POST_TYPE === $context->postType()
            && $context->postStatus()
            && ($context->postStatus() !== 'auto-draft' || self::$calledCount[$site] === 1);
    }

    /**
     * Retrieve the source context for current post type
     *
     * @param Request $request
     * @return Post\SourcePostSaveContext
     */
    private function sourceContext(Request $request): Post\SourcePostSaveContext
    {
        if ($this->sourcePostContext) {
            return $this->sourcePostContext;
        }

        switch_to_blog($this->postRelationshipContext->sourceSiteId());
        $this->sourcePostContext = new Post\SourcePostSaveContext(
            $this->postRelationshipContext->sourcePost(),
            $this->postTypes,
            $request
        );
        restore_current_blog();

        return $this->sourcePostContext;
    }

    /**
     * Grab all fields from the tab
     *
     * @param Request $request
     * @return array
     */
    private function allFieldsValues(Request $request): array
    {
        $fields = [];
        $allTabs = $this->metaboxFields->allFieldsTabs();
        /** @var MetaboxTab $tab */
        foreach ($allTabs as $tab) {
            $fields += $this->tabFieldsValues($tab, $request);
        }

        return $fields;
    }

    /**
     * Retrieves all field values
     *
     * @param MetaboxTab $tab
     * @param Request $request
     * @return array
     */
    private function tabFieldsValues(MetaboxTab $tab, Request $request): array
    {
        $fields = [];
        if (!$tab->enabled($this->postRelationshipContext)) {
            return $fields;
        }

        $tabFields = $tab->fields();
        /** @var Post\MetaboxField $field */
        foreach ($tabFields as $field) {
            if ($field->enabled($this->postRelationshipContext)) {
                $fields[$field->key()] = $field->requestValue($request, $this->fieldsHelper);
            }
        }

        return $fields;
    }

    /**
     * May be the product type have to be the same
     *
     * @param array $values
     * @return bool
     */
    private function maybeOverrideProductType(array $values): bool
    {
        $overrideProductType = (bool)($values[MetaboxFields::FIELD_OVERRIDE_PRODUCT_TYPE] ?? false);

        if (!$overrideProductType) {
            $overrideProductType = FieldsAwareOfProductType::needSameProductType($values);
        }

        return $overrideProductType;
    }
}
