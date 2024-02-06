<?php
/**
 * Block Manager for Startup Garage
 *
 * @author    Tom Hoad <tom.hoad@teamrehab>
 * @link      http://beta.rehab
 * @copyright 2018 Rehab
 *
 * @wordpress-plugin
 * Plugin Name:        Startup Garage - Block Manager 2019
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

class SGBlockManager2019 {

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
			'page_hero',
			'video_image_and_text',
			'text_block',
			'heading_and_links'
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
				'collapsible'    => 1,
				'collapsed'    	 => 1,
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
				case 'page_hero':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'  		=> 'page_hero',
							'label'    	=> __( 'Page Hero', 'fb-block-manager' ),
							'children'  => [
								'background_color' => new Fieldmanager_Colorpicker(
									__( 'Background Color', 'fb-block-manager' ), [
									]
								),
								'text_color' => new Fieldmanager_Colorpicker(
									__( 'Text Color', 'fb-block-manager' ), [
									]
								),
								'heading' 	=> new Fieldmanager_TextField(
									__( 'Hero Heading', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'body' => new Fieldmanager_TextArea(
									__( 'Hero copy', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'mobile_image' => new Fieldmanager_Media(
									__( 'Mobile Image', 'fb-block-manager' )
								),
								'desktop_image' => new Fieldmanager_Media(
									__( 'Desktop Image', 'fb-block-manager' )
								),
							]
							
						]
					);
					break;
				case 'video_image_and_text':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'     => 'video_image_and_text',
							'label'    => __( 'Video/ Image and Text', 'fb-block-manager' ),
							'children' => [
								'background_color' => new Fieldmanager_Colorpicker(
									__( 'Background Color', 'fb-block-manager' ), [
									]
								),
								'text_color' => new Fieldmanager_Colorpicker(
									__( 'Text Color', 'fb-block-manager' ), [
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
								'heading' => new Fieldmanager_TextField(
									__( 'Heading', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'body' => new Fieldmanager_RichTextArea(
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
								'block_images' => new Fieldmanager_Group(
									[
									'name' => 'block_images',
										'label' => __( 'Block Images', 'fb-block-manager' ),
										'children' => [
											'images' => new Fieldmanager_Group( [
												'limit'              => 5,
												'add_more_label'     => __( 'Add another Image', 'fb-block-manager' ),
												'sortable'           => true,
												'children'       => array(
													'image' => new Fieldmanager_Group( [
														'group_is_empty' => function ( $values ) {
															return empty( $values['image_image'] );
														},
														'extra_elements'     => 0,
														'label'          => __( 'Image', 'fb-block-manager' ),
														'children'       => [
															'image_image' => new Fieldmanager_Media(
																__( 'Image', 'fb-block-manager' )
															),
														],
													] ),
												),
											] ),
										],
									]
								),
							]
						]
					);

								break;
							
				case 'text_block':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'     => 'text_block',
							'label'    => __( 'Text Block', 'fb-block-manager' ),
							'children' => [
								'background_color' => new Fieldmanager_Colorpicker(
									__( 'Background Color', 'fb-block-manager' ), [
									]
								),
								'text_color' => new Fieldmanager_Colorpicker(
									__( 'Text Color', 'fb-block-manager' ), [
									]
								),
								'alignment' => new Fieldmanager_Select(
									[
										'name' => 'alignment',
										'label' => __( 'Alignment', 'fb-block-manager' ),
										'first_empty' => false,
										'options' => [
											'left'  => 'Text content on Left',
											'right' => 'Text content on Right',
										],
									]
								),
								'heading' => new Fieldmanager_TextField(
									__( 'Heading', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'body' => new Fieldmanager_RichTextArea(
									__( 'Body', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => false,
										],
									]
								),
								'button_text' => new Fieldmanager_TextField(
									__( 'Button Text', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => false,
										],
									]
								),
								'button_url' => new Fieldmanager_Link(
									__( 'Button URL', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => false,
										],
									]
								),
								'links' => new Fieldmanager_Group( [
										'limit'              => 10,
										'add_more_label'     => __( 'Add link', 'fb-block-manager' ),
										'sortable'           => true,
										'extra_elements'     => 0,
										'children'       => array(
											'link' => new Fieldmanager_Group( [
												'label'          => __( 'Link', 'fb-block-manager' ),
												'collapsible'    => 1,
												'collapsed'    => 1,
												'children'       => array_filter([
													'link_text' => new Fieldmanager_TextField(
														__( 'Link Text', 'fb-block-manager' )
													),
													'link_url' => new Fieldmanager_TextField(
														__( 'Link URL', 'fb-block-manager' )
													),
													'link_image' => new Fieldmanager_Media(
														__( 'Link PDF', 'fb-block-manager' )
													),
													'link_attribute' => new Fieldmanager_Select(
														[
															'name' => 'link_attribute',
															'label'=> __('Link Attribute'),
															'first_empty' => true,
															'options' => [
																'_blank'
															]
														]
													),
												]),
											] ),
										),
									]
								),
							 
							],
						]
					);
					break;
				case 'heading_and_links':
					$blocks[] = new Fieldmanager_Group(
						[
							'name'     => 'heading_and_links',
							'label'    => __( 'Heading and Links Block', 'fb-block-manager' ),
							'children' => [
								'background_color' => new Fieldmanager_Colorpicker(
									__( 'Background Color', 'fb-block-manager' ), [
									]
								),
								'text_color' => new Fieldmanager_Colorpicker(
									__( 'Text Color', 'fb-block-manager' ), [
									]
								),
								'heading' => new Fieldmanager_TextField(
									__( 'Heading', 'fb-block-manager' ), [
										'validation_rules' => [
											'required' => true,
										],
									]
								),
								'links' => new Fieldmanager_Group( [
									'limit'              => 10,
									'add_more_label'     => __( 'Add link', 'fb-block-manager' ),
									'sortable'           => true,
									'extra_elements'     => 0,
									'children'       => array(
										'link' => new Fieldmanager_Group( [
											'label'          => __( 'Link', 'fb-block-manager' ),
											'collapsible'    => 1,
											'collapsed'    => 1,
											'children'       => array_filter([
												'link_text' => new Fieldmanager_TextField(
													__( 'Link Text', 'fb-block-manager' )
												),
												'link_url' => new Fieldmanager_TextField(
													__( 'Link URL', 'fb-block-manager' )
												),
												'link_image' => new Fieldmanager_Media(
													__( 'Link PDF', 'fb-block-manager' )
												),
												'link_attribute' => new Fieldmanager_Select(
													[
														'name' => 'link_attribute',
														'label'=> __('Link Attribute'),
														'first_empty' => true,
														'options' => [
															'_blank'
														]
													]
												),
											]),
										] ),
									),
								]
							),
						
						],
					]
				);

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

					case 'page_hero':
						$heading = $block['page_hero']['heading'];
						$body = $block['page_hero']['body'];
						$mobile_image = $block['page_hero']['mobile_image'];
						$desktop_image = $block['page_hero']['desktop_image'];
						$background_color = $block['page_hero']['background_color'];
						$text_color = $block['page_hero']['text_color'];
						include( locate_template( 'blocks/page-hero.php' ) );
						break;
						
					case 'video_image_and_text':
						$alignment = $block['video_image_and_text']['alignment'];
						$heading = $block['video_image_and_text']['heading'];
						$body = $block['video_image_and_text']['body'];
						$button_text = $block['video_image_and_text']['button_text'];
						$button_url = $block['video_image_and_text']['button_url'];
						$video_url = $block['video_image_and_text']['video_url'];
						
						$background_color = $block['video_image_and_text']['background_color'];
						$text_color = $block['video_image_and_text']['text_color'];
						
						$video_embed = wpcom_vip_wp_oembed_get( $block['video_image_and_text']['video_url'], array( 'width' => '1280','height'=>'1024' ) );
						//check if vimeo
						$parsed_url = wp_parse_url( $block['video_image_and_text']['video_url'] );
						if ( isset( $parsed_url['host'] ) && 'vimeo.com' === $parsed_url['host'] ) {
							//add playsinline option to vimeo videos
							$video_embed = str_replace( '<iframe', '<iframe playsinline="0" width="100%"', $video_embed );
						}
			
						$images = [];
						// Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['video_image_and_text']['block_images']['images'] as $image ) {
							if ( isset( $image['image']['image_image'] ) && '' !== $image['image']['image_image'] ) {
								$images[] = $image;
							}
						}
						include( locate_template( 'blocks/video-image-and-text.php' ) );
						break;

					case 'text_block':
						$alignment = $block['text_block']['alignment'];
						$heading = $block['text_block']['heading'];
						$body = $block['text_block']['body'];
						$button_text = $block['text_block']['button_text'];
						$button_url = $block['text_block']['button_url'];
						$background_color = $block['text_block']['background_color'];
						$text_color = $block['text_block']['text_color'];
						
						$links = [];

						//Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['text_block']['links'] as $link ) {
							if ( isset( $link['link'] ) && '' !== $link['link']['link_text'] ) {
								$links[] = $link;
							}
						}
						include( locate_template( 'blocks/text-block.php' ) );
						break;

					case 'heading_and_links':
						$heading = $block['heading_and_links']['heading'];
						$body = $block['heading_and_links']['body'];
						$background_color = $block['heading_and_links']['background_color'];
						$text_color = $block['heading_and_links']['text_color'];
						
						$links = [];
						//Ignore any empty fields, Fieldmanager seems to like adding these...
						foreach ( $block['heading_and_links']['links'] as $link ) {
							if ( isset( $link['link'] ) && '' !== $link['link']['link_text'] ) {
								$links[] = $link;
							}
						}
						include( locate_template( 'blocks/heading-and-links.php' ) );
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

$block_manager = new SGBlockManager2019();
