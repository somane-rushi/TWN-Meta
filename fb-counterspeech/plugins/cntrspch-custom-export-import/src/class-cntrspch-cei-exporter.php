<?php

/**
 * Class to handle the exporting of content.
 */
class CNTRSPCH_CEI_Exporter {

	/**
	 * Stores the request array (generally $_POST)
	 * @var array
	 */
	private $request;

	/**
	 * Stores instance of Shortcode Parser class
	 * @var CNTRSPCH_CEI_Shortcode_Parser
	 */
	private $parser;

	/**
	 * Stores instance of PO String class
	 * @var CNTRSPCH_CEI_PO_Strings
	 */
	private $po_strings;
	
	/**
	 * Stores custom fields to parse.
	 * @var array
	 */
	private $filter_array;
	
	/**
	 * Execute the exporter
	 * @param  array $request
	 */
	public function run( $request ) {
		
		// set request data
		$this->request = $request;
		
		
		// export from site, may not need option
		if ( isset( $this->request['site'] ) ) {
			// switch to language blog
			switch_to_blog( $this->request['site'] );
			$theme = wp_get_theme();
		}
		
		// init helper classes
		$this->parser 	  = new CNTRSPCH_CEI_Shortcode_Parser;
		$this->po_strings = new CNTRSPCH_CEI_PO_Strings;
		$this->filter_array = new CNTRSPCH_CEI_filter;
		
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<wp>';
		
		if ( !empty( $this->request['ids'] ) ) {
			$ids = explode( ',', $this->request['ids'] );
			$this->ids( $ids );
		} else {
			$this->query();
		}
		
		// check if region terms should be exported
		if ( isset( $this->request['include_regions'] ) && $this->request['include_regions'] == 'yes' ) {
			$this->regions();
		}
		
		// check if resource language terms should be exported
		if ( isset( $this->request['include_resource'] ) && $this->request['include_resource'] == 'yes' ) {
			$this->resource_languages();
		}
		
		// check if global lables should be exported
		// these are located in settings -> Sitewide lables and in functions.php
		if ( isset( $this->request['include_globals'] ) && $this->request['include_globals'] == 'yes' ) {
			$this->globals();
		}
		
		// TODO: remove if not used anymore
		// this is from original version
		if ( !empty( $this->request['po_strings'] ) ) {
			$this->po_strings->set( $this->request['po_strings'] );
		}
		
		// TODO: remove if not used anymore
		// this is from original version
		if ( isset( $this->request['include_po'] ) && $this->request['include_po'] == 'yes' ) {
			$this->po();
		}
		echo '</wp>';
	}

	/**
	 * Gets post/pages by id's
	 * @param  array $ids
	 */
	private function ids( $ids ) {

		$args = array(
			'post__in'  	 => $ids,
			'post_type' 	 => 'any',
			'post_status'    => 'any',
			'posts_per_page' => count( $ids ),
			'suppress_filters' => false
		);

		$posts = get_posts( $args );

		$this->output( $posts );
	}

	/**
	 * Gets post/pages using a query
	 * depending on $request
	 */
	private function query() {

		$args = array(
			'post_type' 	   => 'any',
			// we have no way of knowing how many posts will be in this site eventually but we're confident that that number will never be a problem since this is just and XML importer/exporter, as in, it will never be in the tens of thousands even
			'posts_per_page'   => -1,
			'orderby'		   => 'post_type',
			//'post_status'		   => 'any',
			'suppress_filters' => false
		);

		$fields = array(
			'type' 		 => 'post_type',
			'status' 	 => 'post_status',
			'author' 	 => 'author',
		);

		foreach ( $fields as $field => $arg_name ) {
			$args = $this->set_arg_from_request( $field, $arg_name, $args );
		}

		if ( isset( $this->request['start_date'] ) && isset( $this->request['end_date'] ) ) {
			$args['date_query'] = array(
				array(
					'after'     => $this->request['start_date'],
					'before'    => $this->request['end_date'],
					'inclusive' => true,
				),
			);
		}

		$posts = get_posts( $args );
		
		$this->output( $posts );
	}

	/**
	 * Sets array[element] based on request[key]
	 * @param string $name
	 * @param string $arg_name
	 * @param array $args
	 */
	private function set_arg_from_request( $name, $arg_name, $args ) {
		if ( isset( $this->request[$name] ) && $this->request[$name] !== 0 ) {
			$args[$arg_name] = $this->request[$name];
		}
		return $args;
	}

	/**
	 * Outputs Regions Terms as XML
	 * terms are located in Countries -> Regions in wp-admin
	 */
	private function regions() {
		// get 'cntrspch_region' terms
		$menus = get_terms( 'cntrspch_region', array( 'hide_empty' => false ) );
		// build tag for each term 
		foreach (   $menus as $menu ) {
			$term_id = esc_attr( $menu->term_id );
			$term_order = get_term_meta($term_id, 'order', true );
			echo '<wp-obj wp_region_id="' . $term_id . '" wp_type="region" wp_region_order="' . esc_attr($term_order) .'">';
			echo '<wp-region-slug translate="false">' . esc_attr( $menu->slug ) . '</wp-region-slug>';
			echo '<wp-region-name translate="true">' . esc_attr( $menu->name ) . '</wp-region-name>';
			echo '<wp-region-description translate="true">' . term_description((string) $term_id, 'cntrspch_region') . '</wp-region-description>';
			echo '</wp-obj>';
		}
	}
	
	/**
	 * Outputs Resource Languages Terms as XML
	 * terms are located in Resources -> Resource Languages in wp-admin
	 */
	private function resource_languages() {
		// get 'cntrspch_resource_language' terms
		$menus = get_terms( 'cntrspch_resource_language', array( 'hide_empty' => false ) );
		// build tag for each term 
		foreach ( $menus as $menu ) {
			$term_id = esc_attr( $menu->term_id );
			$term_order = get_term_meta($term_id, 'order', true );
			echo '<wp-obj wp_resource_language_id="' . esc_attr( $term_id ) . '" wp_type="resource_language">';
			echo '<wp-resource-language-slug translate="false">' . esc_attr( $menu->slug ) . '</wp-resource-language-slug>';
			echo '<wp-resource-language-name translate="true">' . esc_attr( $menu->name ) . '</wp-resource-language-name>';
			echo '<wp-resource-language-description translate="true">' . term_description((string) $term_id, 'cntrspch_resource_language') . '</wp-resource-language-description>';
			echo '</wp-obj>';
		}
	}
	
	/**
	 * Outputs Sitewide Labels as XML
	 * located in Settings -> Sitewide Lables in wp-admin
	 * @see functions.php - they are defined there
	 */
	private function globals() {
		echo '<wp-obj wp_option_name="cntrspch_label_counterspeech" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="true">' . esc_attr(get_option('cntrspch_label_counterspeech')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_label_locations" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="true">' . esc_attr(get_option('cntrspch_label_locations')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_label_initiatives" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="true">' . esc_attr(get_option('cntrspch_label_initiatives')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_label_privacy" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="true">' . esc_attr(get_option('cntrspch_label_privacy')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_link_privacy" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="false">' . esc_attr(get_option('cntrspch_link_privacy')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_label_terms" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="true">' . esc_attr(get_option('cntrspch_label_terms')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_link_terms" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="false">' . esc_attr(get_option('cntrspch_link_terms')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_label_cookies" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="true">' . esc_attr(get_option('cntrspch_label_cookies')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_link_cookies" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="false">' . esc_attr(get_option('cntrspch_link_cookies')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_label_help" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="true">' . esc_attr(get_option('cntrspch_label_help')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
		echo '<wp-obj wp_option_name="cntrspch_link_help" wp_type="option">';
		echo '<wp-label-counterspeach-value translate="false">' . esc_attr(get_option('cntrspch_link_help')) . '</wp-label-counterspeach-value>';
		echo '</wp-obj>';
	}

	/**
	 * Outputs PO Strings as XML
	 * TODO: Should no longer be used - remove
	 */
	private function po() {
		$strings = explode( PHP_EOL, $this->po_strings->get() );

		echo '<wp-obj wp_type="po">';
		foreach ( $strings as $string ) {
			echo '<wp-po-item>';
			echo '<wp-po-item-original>' 	. $this->filter( $string ) . '</wp-po-item-original>';		// WPCS: XSS ok.
			echo '<wp-po-item-translated>' 	. $this->filter( $string ) . '</wp-po-item-translated>';	// WPCS: XSS ok.
			echo '</wp-po-item>';
		}
		echo '</wp-obj>';
	}

	/**
	 * Outputs Custom Fields
	 * @param  string $post_id
	 */
	private function custom_fields( $post_id ) {
		$fields = $this->filter_array->customFieldsArray();
		foreach ( $fields as $name => $info ) {
			$data = get_post_meta( $post_id, $name, true );
			if( isset( $data ) && !empty( $data ) ){
				echo '<wp-custom-field wp_type="'. esc_attr( $name ) . '">';
				
				if ( isset( $info['parent'] ) ) {
					echo '<' . esc_attr( $info['parent'] ) . '>';
				}
				if ( !empty( $info['structure'] ) ) {
					$this->prepare_parse_for_cf( $data, $info['structure'], $info['tag'] );
				} else {
					// check if it is a non-traslatible field
					if(in_array($info['tag'], $this->filter_array->noTranslateFieldsArray())) {
						echo '<' . esc_attr( $info['tag'] ) . ' translate="false">';
					} else {
						echo '<' . esc_attr( $info['tag'] ) . ' translate="true">';
					}
					// parse shortcode in contact form - shortcode not supported elsewhere in new site
					if($info['tag'] == 'wp-config-contact-contact-form') {
						echo $this->parser->to_xml($this->filter( $data )); // WPCS: XSS ok.
					} else {
						echo $this->filter( $data );	// WPCS: XSS ok.
					}
					echo '</' . esc_attr( $info['tag'] ) . '>';
				}
				
				if ( isset( $info['parent'] ) ) {
					echo '</' . esc_attr( $info['parent'] ) . '>';
				}

				echo '</wp-custom-field>';
			}
		}
	}

	/**
	 * Prepare to parse Custom Fields data
	 * @param  array $data
	 * @param  array $structure
	 */
	private function prepare_parse_for_cf( $data, $structure, $tag ) {

		if ( !is_array( $data ) ) {
			return;
		}

		if ( $this->has_string_keys( $data ) ) {
			echo '<' . esc_attr( $tag ) . '>';
			$this->parse_cf( $data, $structure );
			echo '</' . esc_attr( $tag ) . '>';
		} else {
			foreach ( $data as $entry ) {
				echo '<' . esc_attr( $tag ) . '>';
				$this->parse_cf( $entry, $structure );
				echo '</' . esc_attr( $tag ) . '>';
			}
		}
	}

	/**
	 * Parse Custom Fields data
	 * @param  array $data
	 * @param  array $structure
	 */
	private function parse_cf( $data, $structure ) {
		foreach ( $data as $key => $value ) {
			if ( isset( $structure[$key] ) ) {
				$child = $structure[$key];
				
				// check if mobile coutries or array
				if ( !is_array( $value ) || (string)$key === 'mobile_countries') {
					// check whether to add translate tag
					if(in_array($child, $this->filter_array->noTranslateFieldsArray())) {
						echo '<' . esc_attr( $child ) . ' translate="false">' . $this->filter( $value ) . '</' . esc_attr( $child ) .'>';	// WPCS: XSS ok.
					} else {
						echo '<' . esc_attr( $child ) . ' translate="true">' . $this->filter( $value ) . '</' . esc_attr( $child ) .'>';	// WPCS: XSS ok.
					}
				} else {
					if ( isset( $structure[$key]['parent'] ) ) {
						if(in_array($structure[$key]['parent'], $this->filter_array->noTranslateFieldsArray())) {
							echo '<' . esc_attr( $structure[$key]['parent'] ) . ' wp_type="'. esc_attr( $key ) . '" translate="false">';
						} else {
							echo '<' . esc_attr( $structure[$key]['parent'] ) . ' wp_type="'. esc_attr( $key ) . '">';
						}
					}
					
					$this->prepare_parse_for_cf( $value, $structure[$key]['structure'], $structure[$key]['tag'] );

					if ( isset( $structure[$key]['parent'] ) ) {
						echo '</' . esc_attr( $structure[$key]['parent'] ) . '>';
					}
				}
			}
		}
	}

	/**
	 * Checks if array is assoc
	 * @param  array $array
	 */
	private function has_string_keys( $array ) {
		return count( array_filter( array_keys( $array ), 'is_string' ) ) > 0;
	}

	/**
	 * Outputs Posts/Pages as XML
	 * @param  array $posts
	 */
	private function output( $posts ) {

		foreach ( $posts as $post ) {
			if($post->post_type !== 'post'){
				echo '<wp-obj wp_post_id="' . esc_attr( $post->ID ) . '" wp_type="' . esc_attr( $post->post_type ) . '"  wp_post_status="' . esc_attr( $post->post_status ) . '" wp_menu_order="' . esc_attr($post->menu_order) . '" wp_post_name="' . esc_attr( $post->post_name ) . '">';
				echo '<wp-post-title translate="true">' . esc_attr( $post->post_title ) . '</wp-post-title>';
				echo '<wp-post-content>';
				echo $this->parser->to_xml( $this->filter( $post->post_content ) );	// WPCS: XSS ok.
				echo '</wp-post-content>';
				echo '<wp-custom-fields>';
				$this->custom_fields( $post->ID );
				echo '<wp-custom-field>';
				echo '<wp-excerpt>';
				echo $this->filter( get_post_field( 'post_excerpt', $post->ID ) );	// WPCS: XSS ok.
				echo '</wp-excerpt>';
				echo '</wp-custom-field>';
				echo '</wp-custom-fields>';
				echo '</wp-obj>';
			}
		}
	}

	/**
	 * Filter content before inserting it into XML
	 * @param  string $string
	 * @return string
	 */

	private function filter( $string ) {
		$string = str_replace( '&quot;', '@quot;@', $string );
		if(is_array($string)) {
			$string = html_entity_decode( serialize($string) );
		} else {
			$string = html_entity_decode( $string );
		}
		
		$string = str_replace( '&', '&amp;', $string );
		$string = str_replace( '@quot;@', '&quot;', $string );

		return $string;
	}

}
