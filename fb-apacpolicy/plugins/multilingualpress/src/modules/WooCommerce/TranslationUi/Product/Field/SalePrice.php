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

namespace Inpsyde\MultilingualPress\Module\WooCommerce\TranslationUi\Product\Field;

use Inpsyde\MultilingualPress\Module\WooCommerce\TranslationUi\Product\MetaboxFields;
use Inpsyde\MultilingualPress\TranslationUi\MetaboxFieldsHelper;
use Inpsyde\MultilingualPress\TranslationUi\Post\RelationshipContext;

/**
 * MultilingualPress Product Sale Price Field
 */
class SalePrice
{
    /**
     * Render the Product Sale Price Field.
     *
     * @param MetaboxFieldsHelper $helper
     * @param RelationshipContext $relationshipContext
     * @return mixed|void
     */
    public function __invoke(MetaboxFieldsHelper $helper, RelationshipContext $relationshipContext)
    {
        $key = MetaboxFields::FIELD_SALE_PRICE;
        $value = $this->value($relationshipContext);

        // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
        ?>
        <div class="options_group show_if_simple show_if_external">
            <p class="form-field <?= $key ?>_field">
                <label for="<?= esc_attr($helper->fieldId($key)) ?>">
                    <?= esc_html_x(
                        'Sale Price',
                        'WooCommerce Product Field',
                        'multilingualpress'
                    ) ?>
                </label>
                <input
                    type="text"
                    class="wc_input_price"
                    name="<?= esc_attr($helper->fieldName($key)) ?>"
                    id="<?= esc_attr($helper->fieldId($key)) ?>"
                    value="<?= esc_attr($value) ?>"
                />
            </p>
        </div>
        <?php
        // phpcs:enabled
    }

    /**
     * Retrieve the value for the input field.
     *
     * @param RelationshipContext $relationshipContext
     * @return string
     */
    private function value(RelationshipContext $relationshipContext): string
    {
        $product = wc_get_product($relationshipContext->remotePostId());
        $value = '';
        if (method_exists($product, 'get_sale_price')) {
            $value = $product->get_sale_price();
        }

        return $value;
    }
}
