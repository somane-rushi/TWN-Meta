<?php
/**
 * Block Manager for Startup Garage
 *
 * @author    Tom Hoad <tom.hoad@teamrehab>
 * @link      http://beta.rehab
 * @copyright 2018 Rehab
 *
 * @wordpress-plugin
 * Plugin Name:        Startup Garage - Block Manager
 * Plugin URI:         startupgarage.fb.com
 * Description:        Manage page blocks for Startup Garage
 * Version:            0.1.0
 * Author:             Tom Hoad
 * Author URI:         http://beta.rehab
 * Text Domain:        fb-block-manager
 * Domain Path:        /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class SGBlockManager {

	public function __construct() {
		$this->setup();
	}

	public function setup() {
		add_action( 'fm_post_page', array( $this, 'get_block_types' ) );
	}

	/**
	 * get_block_types - Sets up the FieldManager fields for the available predefined page blocks
	 *
	 * @return $bm, a main field manager group consisting of fieldmanager subgroups (the blocks)
	 */

	public function get_block_types() {

		$allowed_types = array(
			'video_and_text',
			'left_text_with_links',
			'left_text_with_bullets',
			'blue_text_with_bullets',
			'quotes',
			'heading_with_text',
			'heading_with_button',
			'logo_carousel',
			'video_image_carousel',
			'image_link_grid',
			'link_cards',
		);

		$block_colours = array(
			'white' => 'White',
			'grey' => 'Light Grey',
		);

		$block_colours_blues = array(
			'lightblue' => 'Light Blue',
			'darkblue' => 'Dark Blue',
		);

		$bm = new Fieldmanager_Group(
			[
				'name'           => 'blocks',
				'label'          => __( 'Block', 'fb-block-manager' ),
				'limit'          => 0,
				'sortable'       => 1,
				'add_more_label' => __( 'Add Page Block', 'fb-block-manager' ),
				'group_is_empty' => function ( $values ) {
					return empty( $values['block_type'] );
				},
			]
		);

		$block_select = new Fieldmanager_Select(
			__( 'Block Type', 'fb-block-manager' ), [
				'name' => 'block_type',
			]
		);

		$bm->add_child( $block_select );

		$blocks = [];

		foreach ( $allowed_types as $type ) {
			switch ( $type ) {
				case 'video_and_text':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'     => 'video_and_text',
							'label'    => __( 'Video and Text', 'fb-block-manager' ),
							'children' => [
								'colour' => new Fieldmanager_Select(
									[
										'name' => 'colour',
										'label' => __( 'Block Colour', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => $block_colours,
									]
								),
								'alignment' => new Fieldmanager_Select(
									[
										'name' => 'alignment',
										'label' => __( 'Alignment', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Image/Video on Left',
											'right' => 'Image/Video on Right',
										],
									]
								),
								'background_position' => new Fieldmanager_Select(
									[
										'name' => 'background_position',
										'label' => __( 'Background Position', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Background on Left',
											'right' => 'Background on Right',
										],
									]
								),
								'heading' => new Fieldmanager_RichTextArea(
									__( 'Heading', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'body' => new Fieldmanager_TextArea(
									__( 'Body', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'button_text' => new Fieldmanager_TextField(
									__( 'Button Text', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'button_url' => new Fieldmanager_Link(
									__( 'Button URL', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'video_url' => new Fieldmanager_Link(
									[
										'label' => __( 'Video URL', 'fb-block-manager' ),
										'description' => __( 'Vimeo or Facebook. If set, will override Image', 'fb-block-manager' ),
									]
								),
								'image' => new Fieldmanager_Media(
									__( 'Image', 'fb-block-manager' )
								),
							],
						]
					);
					break;
				case 'left_text_with_links':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'           => 'left_text_with_links',
							'label'    => __( 'Left Text with Links', 'fb-block-manager' ),
							'children'       => [
								'colour' => new Fieldmanager_Select(
									[
										'name' => 'colour',
										'label' => __( 'Block Colour', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => $block_colours,
									]
								),
								'heading' => new Fieldmanager_RichTextArea(
									__( 'Heading', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'body' => new Fieldmanager_RichTextArea(
									__( 'Body', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'links' => new Fieldmanager_Group( [
									'limit'              => 4,
									'add_more_label'     => __( 'Add another link', 'fb-block-manager' ),
									'sortable'           => true,
									'extra_elements'     => 0,
									'children'       => array(
										'link' => new Fieldmanager_Group( [
											'label'          => __( 'Link', 'fb-block-manager' ),
											'children'       => array_filter([
												'link_text' => new Fieldmanager_TextField(
													__( 'Link Text', 'fb-block-manager' )
												),
												'link_attribute' => new Fieldmanager_TextField(
													__( 'Link Attribute', 'fb-block-manager' )
												),
												'link_image' => new Fieldmanager_Media(
													__( 'Link Image', 'fb-block-manager' )
												),
												'button_text' => new Fieldmanager_TextField(
													__( 'Button Text', 'fb-block-manager' )
												),
												'button_url' => new Fieldmanager_Link(
													__( 'Button URL', 'fb-block-manager' )
												),
											]),
										] ),
									),
								] ),
							],
						]
					);
					break;
				case 'left_text_with_bullets':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'           => 'left_text_with_bullets',
							'label'    => __( 'Left Text with Bullets', 'fb-block-manager' ),
							'children'       => [
								'colour' => new Fieldmanager_Select(
									[
										'name' => 'colour',
										'label' => __( 'Block Colour', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => $block_colours,
									]
								),
								'background_position' => new Fieldmanager_Select(
									[
										'name' => 'background_position',
										'label' => __( 'Background Position', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Background on Left',
											'right' => 'Background on Right',
										],
									]
								),
								'heading' => new Fieldmanager_RichTextArea(
									__( 'Heading', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'body' => new Fieldmanager_RichTextArea(
									__( 'Body', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'bullets' => new Fieldmanager_Group( [
									'limit'              => 3,
									'add_more_label'     => __( 'Add another bullet', 'fb-block-manager' ),
									'sortable'           => true,
									'extra_elements'     => 0,
									'children'       => array(
										'bullet' => new Fieldmanager_Group( [
											'label'          => __( 'Bullet', 'fb-block-manager' ),
											'children'       => [
												'bullet_text' => new Fieldmanager_TextField(
													__( 'Bullet Text', 'fb-block-manager' )
												),
												'bullet_icon' => new Fieldmanager_Media(
													__( 'Bullet Icon', 'fb-block-manager' )
												),
											],
										] ),
									),
								] ),
							],
						]
					);
					break;
				case 'blue_text_with_bullets':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'           => 'blue_text_with_bullets',
							'label'    => __( 'Blue Text with Bullets', 'fb-block-manager' ),
							'children'       => [
								'heading' => new Fieldmanager_RichTextArea(
									__( 'Heading', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
									]
								),
								'background_position' => new Fieldmanager_Select(
									[
										'name' => 'background_position',
										'label' => __( 'Background Position', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Background on Left',
											'right' => 'Background on Right',
										],
									]
								),
								'subheading' => new Fieldmanager_TextArea(
									__( 'Subheading', 'fb-block-manager' )
								),
								'body' => new Fieldmanager_TextArea(
									__( 'Body', 'fb-block-manager' )
								),
								'bullets' => new Fieldmanager_Group( [
									'limit'              => 3,
									'add_more_label'     => __( 'Add another bullet', 'fb-block-manager' ),
									'sortable'           => true,
									'extra_elements'     => 0,
									'children'       => array(
										'bullet' => new Fieldmanager_Group( [
											'label'          => __( 'Bullet', 'fb-block-manager' ),
											'children'       => [
												'bullet_heading' => new Fieldmanager_TextField(
													__( 'Bullet Heading', 'fb-block-manager' )
												),
												'bullet_text' => new Fieldmanager_TextField(
													__( 'Bullet Text', 'fb-block-manager' )
												),
											],
										] ),
									),
								] ),
							],
						]
					);
					break;
				case 'quotes':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'           => 'quotes',
							'label'    => __( 'Quotes', 'fb-block-manager' ),
							'children'       => [
								'heading' => new Fieldmanager_RichTextArea(
									__( 'Heading', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'quotes' => new Fieldmanager_Group( [
									'limit'              => 6,
									'add_more_label'     => __( 'Add another quote', 'fb-block-manager' ),
									'sortable'           => true,
									'group_is_empty' => function ( $values ) {
										return empty( $values['quote'] );
									},
									'extra_elements'     => 0,
									'children'       => array(
										'quote' => new Fieldmanager_Group( [
											'group_is_empty' => function ( $values ) {
												return empty( $values['quote_body'] );
											},
											'label'          => __( 'Quote', 'fb-block-manager' ),
											'extra_elements'     => 0,
											'children'       => [
												'quote_body' => new Fieldmanager_TextArea(
													__( 'Quote Body', 'fb-block-manager' )
												),
												'quote_quotee' => new Fieldmanager_TextField(
													__( 'Quotee', 'fb-block-manager' )
												),
												'quote_quotee_title' => new Fieldmanager_TextField(
													__( 'Quotee Job Title ', 'fb-block-manager' )
												),
												'quote_quotee_image' => new Fieldmanager_Media( [
													'label' => __( 'Quotee Image', 'fb-block-manager' ),
													'description' => __( 'Upload a square image!', 'fb-block-manager' ),
												]),
											],
										] ),
									),
								] ),
							],
						]
					);
					break;
				case 'heading_with_text':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'     => 'heading_with_text',
							'label'    => __( 'Heading with Text', 'fb-block-manager' ),
							'children' => [
								'colour' => new Fieldmanager_Select(
									[
										'name' => 'colour',
										'label' => __( 'Block Colour', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => $block_colours,
									]
								),
								'background_position' => new Fieldmanager_Select(
									[
										'name' => 'background_position',
										'label' => __( 'Background Position', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Background on Left',
											'right' => 'Background on Right',
										],
									]
								),
								'heading_one' => new Fieldmanager_RichTextArea(
									__( 'Heading One', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'heading_two' => new Fieldmanager_RichTextArea(
									__( 'Heading Two', 'fb-block-manager' )
								),
								'heading_three' => new Fieldmanager_RichTextArea(
									__( 'Heading Three', 'fb-block-manager' )
								),
								'subheading' => new Fieldmanager_TextField(
									__( 'Subheading', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'body' => new Fieldmanager_TextArea(
									__( 'Body', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
							],
						]
					);
					break;
				case 'heading_with_button':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'     => 'heading_with_button',
							'label'    => __( 'Heading with Button', 'fb-block-manager' ),
							'children' => [
								'heading' => new Fieldmanager_RichTextArea(
									__( 'Heading', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'subheading' => new Fieldmanager_TextField(
									__( 'Subheading', 'fb-block-manager' )
								),
								'background_position' => new Fieldmanager_Select(
									[
										'name' => 'background_position',
										'label' => __( 'Background Position', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Background on Left',
											'right' => 'Background on Right',
										],
									]
								),
								'button_text' => new Fieldmanager_TextField(
									__( 'Button Text', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'button_link' => new Fieldmanager_Link(
									__( 'Button Link', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
							],
						]
					);
					break;
				case 'logo_carousel':
					$blocks[] = new Fieldmanager_Group(
						[
							'name' => 'logo_carousel',
							'label' => __( 'Logo Carousel', 'fb-block-manager' ),
							'children' => [
								'logos' => new Fieldmanager_Group( [
									'limit'              => 16,
									'add_more_label'     => __( 'Add another logo', 'fb-block-manager' ),
									'sortable'           => true,
									'children'       => array(
										'logo' => new Fieldmanager_Group( [
											'group_is_empty' => function ( $values ) {
												return empty( $values['logo_image'] );
											},
											'extra_elements'     => 0,
											'label'          => __( 'Logo Image', 'fb-block-manager' ),
											'children'       => [
												'logo_image' => new Fieldmanager_Media(
													__( 'Logo Image', 'fb-block-manager' )
												),
											],
										] ),
									),
								] ),
							],
						]
					);
					break;
				case 'video_image_carousel':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'           => 'video_image_carousel',
							'label'    => __( 'Video/Image Carousel', 'fb-block-manager' ),
							'children'       => [
								'colour' => new Fieldmanager_Select(
									[
										'name' => 'colour',
										'label' => __( 'Block Colour', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => $block_colours_blues,
									]
								),
								'background_position' => new Fieldmanager_Select(
									[
										'name' => 'background_position',
										'label' => __( 'Background Position', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Background on Left',
											'right' => 'Background on Right',
										],
									]
								),
								'heading' => new Fieldmanager_RichTextArea(
									__( 'Heading', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'carousel_items' => new Fieldmanager_Group( [
									'limit'              => 5,
									'add_more_label'     => __( 'Add another carousel item', 'fb-block-manager' ),
									'sortable'           => true,
									'extra_elements'     => 0,
									'group_is_empty' => function ( $values ) {
										return empty( $values['carousel_item'] );
									},
									'children'       => array(
										'carousel_item' => new Fieldmanager_Group( [
											'extra_elements'     => 0,
											'group_is_empty' => function ( $values ) {
												return empty( $values['carousel_body'] );
											},
											'label'          => __( 'Carousel Item', 'fb-block-manager' ),
											'children'       => [
												'carousel_subheading' => new Fieldmanager_TextField(
													__( 'Carousel Heading', 'fb-block-manager' )
												),
												'carousel_heading' => new Fieldmanager_TextField(
													__( 'Carousel Subheading', 'fb-block-manager' )
												),
												'carousel_main_image' => new Fieldmanager_Media(
													[
														'label' => __( 'Carousel Image', 'fb-block-manager' ),
														'description' => __( 'If set, will override Carousel Heading', 'fb-block-manager' ),
													]
												),
												'carousel_body' => new Fieldmanager_TextArea(
													__( 'Carousel Body', 'fb-block-manager' )
												),
												'carousel_facebook_video' => new Fieldmanager_Link(
													[
														'label' => __( 'Video URL', 'fb-block-manager' ),
														'description' => __( 'Vimeo or Facebook. If set, will override Carousel Image', 'fb-block-manager' ),
													]
												),
												'carousel_image' => new Fieldmanager_Media(
													__( 'Carousel Small Image', 'fb-block-manager' )
												),
												'carousel_links' => new Fieldmanager_Group( [
													'limit'              => 4,
													'add_more_label'     => __( 'Add another link', 'fb-block-manager' ),
													'children'       => array(
														'carousel_item_link' => new Fieldmanager_Group( [
															'extra_elements'     => 0,
															'group_is_empty' => function ( $values ) {
																return empty( $values['carousel_item_link_text'] );
															},
															'label'          => __( 'Link', 'fb-block-manager' ),
															'children'       => [
																'carousel_item_link_text' => new Fieldmanager_TextField(
																	__( 'Link Text', 'fb-block-manager' )
																),
																'carousel_item_link_url' => new Fieldmanager_Link(
																	__( 'Link URL', 'fb-block-manager' )
																),
															],
														] ),
													),
												] ),
											],
										] ),
									),
								] ),
							],
						]
					);
					break;
				case 'image_link_grid':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'           => 'image_link_grid',
							'label'    => __( 'Image Link Grid', 'fb-block-manager' ),
							'children'       => [
								'heading' => new Fieldmanager_RichTextArea(
									__( 'Heading', 'fb-block-manager' ), [
										'editor_settings' => array(
											'media_buttons' => false,
										),
									]
								),
								'grid_items' => new Fieldmanager_Group( [
									'limit'              => 30,
									'add_more_label'     => __( 'Add another grid item', 'fb-block-manager' ),
									'sortable'           => true,
									'children'       => array(
										'grid_item' => new Fieldmanager_Group( [
											'label'          => __( 'Grid Item', 'fb-block-manager' ),
											'group_is_empty' => function ( $values ) {
												return empty( $values['grid_image'] );
											},
											'collapsible' 		 => true,
											'children'       => [
												'grid_image' => new Fieldmanager_Media(
													__( 'Grid Image', 'fb-block-manager' )
												),
												'logo' => new Fieldmanager_Media(
													__( 'Logo', 'fb-block-manager' )
												),
												'sector' => new Fieldmanager_TextField(
													__( 'Sector', 'fb-block-manager' )
												),
												'body' => new Fieldmanager_TextArea(
													__( 'Body', 'fb-block-manager' )
												),
												'video_url' => new Fieldmanager_Link(
													[
														'label' => __( 'Video URL', 'fb-block-manager' ),
														'description' => __( 'Vimeo or Facebook. If set, will override Carousel Image', 'fb-block-manager' ),
													]
												),
												'image' => new Fieldmanager_Media(
													__( 'Image', 'fb-block-manager' )
												),
												'links' => new Fieldmanager_Group( [
													'limit'              => 4,
													'add_more_label'     => __( 'Add another link', 'fb-block-manager' ),
													'collapsible' 		 => true,
													'children'       => array(
														'link' => new Fieldmanager_Group( [
															'label'          => __( 'Link', 'fb-block-manager' ),
															'collapsible' 		 => true,
															'group_is_empty' => function ( $values ) {
																return empty( $values['link_text'] );
															},
															'children'       => [
																'link_text' => new Fieldmanager_TextField(
																	__( 'Link Text', 'fb-block-manager' )
																),
																'link_url' => new Fieldmanager_Link(
																	__( 'Link URL', 'fb-block-manager' )
																),
															],
														] ),
													),
												] ),
											],
										] ),
									),
								] ),
							],
						]
					);
					break;
				case 'link_cards':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'           => 'link_cards',
							'label'    => __( 'Link Cards', 'fb-block-manager' ),
							'children'       => [
								'button_text' => new Fieldmanager_TextField(
									__( 'Button Text', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'button_link' => new Fieldmanager_Select(
									[
										'name' => 'button_link',
										'label' => __( 'Link to page', 'fb-block-manager' ),
										'datasource' => new Fieldmanager_Datasource_Post( array(
											'query_args' => array(
												'post_type' => 'page',
												'numberposts' => 30,
											),
										) ),
									]
								),
								'background_position' => new Fieldmanager_Select(
									[
										'name' => 'background_position',
										'label' => __( 'Background Position', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Background on Left',
											'right' => 'Background on Right',
										],
									]
								),
								'card_items' => new Fieldmanager_Group( [
									'limit'              => 4,
									'add_more_label'     => __( 'Add another link card', 'fb-block-manager' ),
									'sortable'           => true,
									'children'       => array(
										'card' => new Fieldmanager_Group( [
											'label'          => __( 'Link Card', 'fb-block-manager' ),
											'extra_elements'     => 0,
											'group_is_empty' => function ( $values ) {
												return empty( $values['link_text'] );
											},
											'children'       => [
												'link_text' => new Fieldmanager_TextField(
													__( 'Card Text', 'fb-block-manager' )
												),
												'link_page' => new Fieldmanager_Select(
													[
														'name' => 'link_page',
														'label' => __( 'Link to page', 'fb-block-manager' ),
														'datasource' => new Fieldmanager_Datasource_Post( array(
															'query_args' => array(
																'post_type' => 'page',
																'numberposts' => 30,
															),
														) ),
													]
												),
												'link_image' => new Fieldmanager_Media(
													__( 'Link Image', 'fb-block-manager' )
												),
											],
										] ),
									),
								] ),
							],
						]
					);
					break;
			}
		}

		foreach ( $blocks as $flexfield ) {
			$block_select->add_options(
				[
					$flexfield->name => $flexfield->label,
				]
			);
			$flexfield->display_if = [
				'src'   => 'block_type',
				'value' => $flexfield->name,
			];
			$bm->add_child( $flexfield );
		}

		$bm->add_meta_box( __( 'Page Blocks', 'fb-block-manager' ), 'page' );

		return $bm;
	}

	/**
	 * render_blocks - Render the blocks on the page
	 *
	 * @param $id - the page id from WordPress
	 * @return The block HTML partial from within the theme, with block data passed to it
	 */

	public function render_blocks( $id ) {

		$block_meta = get_post_meta( $id, 'blocks' );

		foreach ( $block_meta as $blocks ) {

			$block_id = 1;

			foreach ( $blocks as $block ) {
				if ( ! isset( $block['block_type'] ) || '' === $block['block_type'] ) {
					continue;
				}

				switch ( $block['block_type'] ) {
					case 'video_and_text':
						$colour = $block['video_and_text']['colour'];
						$alignment = $block['video_and_text']['alignment'];
						$background_position = $block['video_and_text']['background_position'];
						$heading = $block['video_and_text']['heading'];
						$body = $block['video_and_text']['body'];
						$button_text = $block['video_and_text']['button_text'];
						$button_url = $block['video_and_text']['button_url'];
						$video_url = $block['video_and_text']['video_url'];

						$video_embed = wpcom_vip_wp_oembed_get( $block['video_and_text']['video_url'], array( 'width' => '1000' ) );

						//check if vimeo
						$parsed_url = wp_parse_url( $block['video_and_text']['video_url'] );

						if ( isset( $parsed_url['host'] ) && 'vimeo.com' === $parsed_url['host'] ) {
							//add playsinline option to vimeo videos
							$video_embed = str_replace( '<iframe', '<iframe playsinline="0" width="100%"', $video_embed );
						}

						$image = $block['video_and_text']['image'];

						include( locate_template( 'blocks/video-and-text.php' ) );
						break;

					case 'left_text_with_links':
						$colour = $block['left_text_with_links']['colour'];
						$heading = $block['left_text_with_links']['heading'];
						$body = $block['left_text_with_links']['body'];
						$links = [];

						// Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['left_text_with_links']['links'] as $link ) {
							if ( isset( $link['link'] ) && '' !== $link['link']['link_text'] ) {
								$links[] = $link;
							}
						}

						include( locate_template( 'blocks/left-text-with-links.php' ) );
						break;

					case 'left_text_with_bullets':
						$colour = $block['left_text_with_bullets']['colour'];
						$heading = $block['left_text_with_bullets']['heading'];
						$body = $block['left_text_with_bullets']['body'];
						$background_position = $block['left_text_with_bullets']['background_position'];
						$bullets = [];

						// Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['left_text_with_bullets']['bullets'] as $bullet ) {
							if ( isset( $bullet['bullet']['bullet_text'] ) && '' !== $bullet['bullet']['bullet_text'] ) {
								$bullets[] = $bullet;
							}
						}

						include( locate_template( 'blocks/left-text-with-bullets.php' ) );
						break;

					case 'blue_text_with_bullets':
						$heading = $block['blue_text_with_bullets']['heading'];
						$subheading = $block['blue_text_with_bullets']['subheading'];
						$body = $block['blue_text_with_bullets']['body'];
						$background_position = $block['blue_text_with_bullets']['background_position'];
						$bullets = [];

						// Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['blue_text_with_bullets']['bullets'] as $bullet ) {
							$bullets[] = $bullet;
						}

						include( locate_template( 'blocks/blue-text-with-bullets.php' ) );
						break;

					case 'quotes':
						$heading = $block['quotes']['heading'];
						$quotes = [];

						// Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['quotes']['quotes'] as $quote ) {
							if ( isset( $quote['quote']['quote_body'] ) && '' !== $quote['quote']['quote_body'] ) {
								$quotes[] = $quote;
							}
						}

						include( locate_template( 'blocks/quotes.php' ) );
						break;

					case 'heading_with_text':
						$colour = $block['heading_with_text']['colour'];
						$heading_one = $block['heading_with_text']['heading_one'];
						$heading_two = $block['heading_with_text']['heading_two'];
						$heading_three = $block['heading_with_text']['heading_three'];
						$subheading = $block['heading_with_text']['subheading'];
						$body = $block['heading_with_text']['body'];
						$background_position = $block['heading_with_text']['background_position'];

						include( locate_template( 'blocks/heading-with-text.php' ) );
						break;

					case 'heading_with_button':
						$heading = $block['heading_with_button']['heading'];
						$subheading = $block['heading_with_button']['subheading'];
						$button_text = $block['heading_with_button']['button_text'];
						$button_link = $block['heading_with_button']['button_link'];
						$background_position = $block['heading_with_button']['background_position'];

						include( locate_template( 'blocks/heading-with-button.php' ) );
						break;

					case 'logo_carousel':
						$logos = [];

						// Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['logo_carousel']['logos'] as $logo ) {
							if ( isset( $logo['logo']['logo_image'] ) && '' !== $logo['logo']['logo_image'] ) {
								$logos[] = $logo;
							}
						}

						include( locate_template( 'blocks/logo-carousel.php' ) );
						break;

					case 'video_image_carousel':
						$heading = $block['video_image_carousel']['heading'];
						$colour = $block['video_image_carousel']['colour'];
						$background_position = $block['video_image_carousel']['background_position'];

						$carousel_items = [];

						// Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['video_image_carousel']['carousel_items'] as $carousel_item ) {
							$carousel_item['carousel_item']['video_embed'] = wpcom_vip_wp_oembed_get( $carousel_item['carousel_item']['carousel_facebook_video'], array( 'width' => '1000' ) );

							//check if vimeo
							$parsed_url = wp_parse_url( $carousel_item['carousel_item']['carousel_facebook_video'] );

							if ( isset( $parsed_url['host'] ) && 'vimeo.com' === $parsed_url['host'] ) {
								//add playsinline option to vimeo videos
								$carousel_item['carousel_item']['video_embed'] = str_replace( '<iframe', '<iframe playsinline="0" width="100%"', $video_embed );
							}

							if ( isset( $carousel_item['carousel_item']['carousel_body'] ) && '' !== $carousel_item['carousel_item']['carousel_body'] ) {
								$carousel_items[] = $carousel_item['carousel_item'];
							}
						}

						include( locate_template( 'blocks/video-image-carousel.php' ) );
						break;

					case 'image_link_grid':
						$heading = $block['image_link_grid']['heading'];
						$grid_items = [];

						foreach ( $block['image_link_grid']['grid_items'] as $grid_item ) {

							$grid_item['grid_item']['cleaned_links'] = [];

							$grid_item['grid_item']['video_embed'] = wpcom_vip_wp_oembed_get( $grid_item['grid_item']['video_url'], array( 'width' => '1000' ) );

							//check if vimeo
							$parsed_url = wp_parse_url( $grid_item['grid_item']['video_url'] );

							if ( isset( $parsed_url['host'] ) && 'vimeo.com' === $parsed_url['host'] ) {
								//add playsinline option to vimeo videos
								$grid_item['grid_item']['video_embed'] = str_replace( '<iframe', '<iframe playsinline="0" width="100%"', $video_embed );
							}

							// Ignore any empty links
							foreach ( $grid_item['grid_item']['links'] as $links ) {
								if ( isset( $links['link'] ) && '' !== $links['link']['link_text'] ) {
									$grid_item['grid_item']['cleaned_links'][] = $links['link'];
								}
							};

							// Ignore any empty grid items
							if ( isset( $grid_item['grid_item']['grid_image'] ) && '' !== $grid_item['grid_item']['grid_image'] ) {
								$grid_items[] = $grid_item;
							}
						}

						include( locate_template( 'blocks/image-link-grid.php' ) );
						break;
					case 'link_cards':
						$button_text = $block['link_cards']['button_text'];
						$button_link = $block['link_cards']['button_link'];
						$background_position = $block['link_cards']['background_position'];

						$link_cards = [];

						// Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['link_cards']['card_items'] as $link_card ) {
							if ( isset( $link_card['card'] ) && '' !== $link_card['card']['link_text'] ) {
								$link_cards[] = $link_card['card'];
							}
						}

						include( locate_template( 'blocks/link-cards.php' ) );
						break;
				}

				$block_id++;
			}
		}
	}
}

add_filter( 'fm_element_markup_end_colour', function ( $out ) {
	$out = str_replace( '<option value="">&nbsp;</option>', '', $out );
	return $out;
}, 10, 1);

$block_manager = new SGBlockManager();