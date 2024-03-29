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

namespace Inpsyde\MultilingualPress\TranslationUi\Post\Field;

use Inpsyde\MultilingualPress\TranslationUi\MetaboxFieldsHelper;
use Inpsyde\MultilingualPress\TranslationUi\Post\Ajax\Search;
use Inpsyde\MultilingualPress\TranslationUi\Post\RelationshipContext;
use Inpsyde\MultilingualPress\TranslationUi\Post\MetaboxFields;

use function Inpsyde\MultilingualPress\siteLocaleName;

class Relation
{
    const VALUES = [
        MetaboxFields::FIELD_RELATION_NEW,
        MetaboxFields::FIELD_RELATION_EXISTING,
        MetaboxFields::FIELD_RELATION_REMOVE,
        MetaboxFields::FIELD_RELATION_LEAVE,
    ];

    /**
     * @param $value
     * @return string
     *
     * phpcs:disable Inpsyde.CodeQuality.ArgumentTypeDeclaration
     */
    public static function sanitize($value): string
    {
        // phpcs:enable

        if (!is_scalar($value) || in_array((string)$value, self::VALUES, true)) {
            return MetaboxFields::FIELD_RELATION_LEAVE;
        }

        return (string)$value;
    }

    /**
     * @param MetaboxFieldsHelper $helper
     * @param RelationshipContext $context
     */
    public function __invoke(MetaboxFieldsHelper $helper, RelationshipContext $context)
    {
        $language = siteLocaleName($context->remoteSiteId());

        $currently = __('Currently not connected.', 'multilingualpress');
        $currentlyMarkupFormat = '<strong>%s</strong>';
        if ($context->hasRemotePost()) {
            // translators: 1 is the post title, 2 the post status, 3 the post date
            $format = __('Currently connected with "%1$s" (%2$s - %3$s)', 'multilingualpress');
            $post = $context->remotePost();
            $currently = sprintf(
                $format,
                get_the_title($post),
                get_post_status_object($post->post_status)->label,
                $post->post_date
            );

            $currentlyMarkupFormat = '<div class="currently-connected">%s</div>';
        }

        ?>
        <tr class="main-row">
            <td>
                <?= sprintf($currentlyMarkupFormat, esc_html($currently)) ?>
                <?php
                $hasRemotePost = $context->hasRemotePost();
                $this->leaveConnectionField($helper, $hasRemotePost, $context);
                if ($hasRemotePost) {
                    $this->removeConnectionField($helper, $language);
                }
                if (!$hasRemotePost) {
                    $this->newPostField($helper, $language, $context);
                }
                $this->existingPostField($helper, $language, $context);
                ?>
            </td>
        </tr>
        <?php
        $this->searchRow($helper);
        $this->buttonRow();
    }

    /**
     * @param MetaboxFieldsHelper $helper
     * @param string $key
     * @return string[]
     */
    private function idAndName(MetaboxFieldsHelper $helper, string $key): array
    {
        $base = MetaboxFields::FIELD_RELATION;
        $id = $helper->fieldId("{$base}-{$key}");
        $name = $helper->fieldName($base);

        return [$id, $name];
    }

    /**
     * @param MetaboxFieldsHelper $helper
     * @param string $language
     * @param RelationshipContext $context
     */
    private function newPostField(
        MetaboxFieldsHelper $helper,
        string $language,
        RelationshipContext $context
    ) {

        $key = MetaboxFields::FIELD_RELATION_NEW;
        list($id, $name) = $this->idAndName($helper, $key);

        ?>
        <p>
            <label for="<?= esc_attr($id) ?>">
                <input
                    type="radio"
                    id="<?= esc_attr($id) ?>"
                    value="<?= esc_attr($key) ?>"
                    name="<?= esc_attr($name) ?>">
                <?php

                $postTypeObject = get_post_type_object($context->sourcePost()->post_type);
                $postTypeSingularName = $postTypeObject->labels->singular_name ?: 'post';

                // translators: 1 is the post type, 2 the language name
                $format = __(
                    'Create a new %1$s, and use it as translation in %2$s.',
                    'multilingualpress'
                );
                print esc_html(sprintf($format, $postTypeSingularName, $language))
                ?>
            </label>
        </p>
        <?php
    }

    /**
     * @param MetaboxFieldsHelper $helper
     * @param string $language
     * @param RelationshipContext $context
     */
    private function existingPostField(
        MetaboxFieldsHelper $helper,
        string $language,
        RelationshipContext $context
    ) {

        $key = MetaboxFields::FIELD_RELATION_EXISTING;
        list($id, $name) = $this->idAndName($helper, $key);

        ?>
        <p>
            <label for="<?= esc_attr($id) ?>">
                <input
                    type="radio"
                    id="<?= esc_attr($id) ?>"
                    value="<?= esc_attr($key) ?>"
                    name="<?= esc_attr($name) ?>">
                <?php

                $postTypeObject = get_post_type_object($context->sourcePost()->post_type);
                $postTypeSingularName = $postTypeObject->labels->singular_name ?: 'post';

                // translators: 1 is the post type, 2 the language name
                $format = __(
                    'Select an existing %1$s to be used as translation in %2$s.',
                    'multilingualpress'
                );
                print esc_html(sprintf($format, $postTypeSingularName, $language));
                ?>
            </label>
        </p>
        <?php
    }

    /**
     * @param MetaboxFieldsHelper $helper
     * @param string $language
     */
    private function removeConnectionField(MetaboxFieldsHelper $helper, string $language)
    {
        $key = MetaboxFields::FIELD_RELATION_REMOVE;
        list($id, $name) = $this->idAndName($helper, $key);

        ?>
        <p>
            <label for="<?= esc_attr($id) ?>">
                <input
                    type="radio"
                    id="<?= esc_attr($id) ?>"
                    value="<?= esc_attr($key) ?>"
                    name="<?= esc_attr($name) ?>">
                <?php
                // translators: %s is the language name
                $format = __(
                    'Remove connection (don\'t translate in %s).',
                    'multilingualpress'
                );
                print esc_html(sprintf($format, $language))
                ?>
            </label>
        </p>
        <?php
    }

    /**
     * @param MetaboxFieldsHelper $helper
     * @param bool $hasRemotePost
     * @param RelationshipContext $context
     */
    private function leaveConnectionField(
        MetaboxFieldsHelper $helper,
        bool $hasRemotePost,
        RelationshipContext $context
    ) {

        $value = $hasRemotePost
            ? MetaboxFields::FIELD_RELATION_LEAVE
            : MetaboxFields::FIELD_RELATION_NOTHING;

        list($id, $name) = $this->idAndName($helper, $value);

        $postTypeObject = get_post_type_object($context->sourcePost()->post_type);
        $postTypeSingularName = $postTypeObject->labels->singular_name ?: 'post';
        // translators: %s is the post type
        $labelFormat = __('Do not change connected %s.', 'multilingualpress');

        $label = $hasRemotePost
            ? sprintf($labelFormat, $postTypeSingularName)
            : __('Keep not connected.', 'multilingualpress');

        ?>
        <p>
            <label for="<?= esc_attr($id) ?>">
                <input
                    type="radio"
                    id="<?= esc_attr($id) ?>"
                    value="<?= esc_attr($value) ?>"
                    name="<?= esc_attr($name) ?>"
                    checked>
                <?= esc_html($label) ?>
            </label>
        </p>
        <?php
    }

    /**
     * @param MetaboxFieldsHelper $helper
     * @return void
     */
    private function searchRow(MetaboxFieldsHelper $helper)
    {
        $name = $helper->fieldName(MetaboxFields::FIELD_RELATION_SEARCH);
        $inputId = $helper->fieldId(MetaboxFields::FIELD_RELATION_SEARCH);
        $resultsId = $helper->fieldId('search-results');
        $placeholder = __('Start typing to search...', 'multilingualpress');
        ?>
        <tr class="search-input-row" style="display: none">
            <td>
                <input
                    id="<?= esc_attr($inputId) ?>"
                    type="text"
                    class="regular-text"
                    data-results="#<?= esc_attr($resultsId) ?>"
                    data-action="<?= esc_attr(Search::ACTION) ?>"
                    placeholder="<?= esc_attr($placeholder) ?>"
                    aria-label="<?= esc_attr__('Search', 'multilingualpress') ?>">
            </td>
        </tr>
        <tr>
            <td id="<?= esc_attr($resultsId) ?>" class="search-results" style="display: none">
                <table class="widefat striped">
                    <tbody>
                    <tr class="search-results-row" style="display: none">
                        <td>
                            <label>
                                <input
                                    type="radio"
                                    name="<?= esc_attr($name) ?>"
                                    value="0"
                                    aria-label="">
                                <span></span>
                            </label>
                        </td>
                    </tr>
                    <tr class="search-results-none" style="display: none">
                        <td>
                            <?php
                            esc_html_e(
                                'No posts found matching search.',
                                'multilingualpress'
                            );
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <?php
    }

    /**
     * @return void
     */
    private function buttonRow()
    {
        ?>
        <tr>
            <td>
                <button
                    style="display:none;"
                    class="button-primary update-relationship">
                    <?php esc_html_e('Update now', 'multilingualpress') ?>
                </button>
            </td>
        </tr>
        <?php
    }
}
