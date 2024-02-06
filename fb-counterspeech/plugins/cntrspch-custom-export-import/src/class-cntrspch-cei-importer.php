<?php

/**
 * Class to handle the importing of content.
 */
class CNTRSPCH_CEI_Importer {

	/**
	 * Store the XML content to import
	 * @var SimpleXMLElement
	 */
	private $content;

	/**
	 * Store the XML array that needs to be iterated over for content to import
	 * @var SimpleXMLElement
	 */
	 private $contentArray;

	/**
	 * Stores instance of Shortcode Parser class
	 * @var CNTRSPCH_CEI_Shortcode_Parser
	 */
	private $parser;

	/**
	 * Stores site id where the content came from.
	 * @var string
	 */
	private $original_site;

	/**
	 * Stores site id where content is going too.
	 * @var string
	 */
	private $target_site;

	/**
	 * Stores instance of Mlp_Content_Relations
	 * The MultilingualPress class for handling relationships
	 * between posts.
	 * @var Mlp_Content_Relations
	 */
	private $mlp_content_relations;

	/**
	 * Stores messages to output to the user.
	 * @var array
	 */
	private $output;
	
	/**
	 * Stores custom fields to parse.
	 * @var array
	 */
	private $filter_array;

	/**
	 * Execute the importer
	 * @param  string $content
	 * @param  array $request
	 * @return array
	 */
	public function run( $content, $request ) {

		global $wpdb;

		$this->mlp_content_relations = new Mlp_Content_Relations(
			$wpdb,
			new Mlp_Site_Relations( $wpdb, 'mlp_site_relations' ),
			new Mlp_Db_Table_Name( $wpdb->base_prefix . 'multilingual_linked',  new Mlp_Db_Table_List( $wpdb ) )
		);

		$this->original_site = $request['site'];
		$this->switch_to_original_site();

		$theme = wp_get_theme();
		require_once $theme->get_template_directory() . '/functions.php';

		$this->parser  = new CNTRSPCH_CEI_Shortcode_Parser;
		$this->filter_array = new CNTRSPCH_CEI_filter;

		libxml_use_internal_errors( true );

		$this->content = simplexml_load_string( $content );

		if ( ! $this->content ) {
			$this->output['xml'] = libxml_get_errors();

			return $this->output;
		}

		$this->set_target_site( $this->content['locale'] );

		$posts = array();
		$menus = array();

		if( isset( $this->content->{'obj'}->{'container'}->{'wp'}->{'wp-obj'} ) ) {
			$this->contentArray = $this->content->{'obj'}->{'container'}->{'wp'}->{'wp-obj'};
		} else {
			$this->contentArray = $this->content->{'wp-obj'};
		}

		foreach ( $this->contentArray as $key => $obj ) {

			if ( (string)$obj['wp_type'] === 'post' ||  (string)$obj['wp_type'] === 'page' || (string)$obj['wp_type'] === 'io_story' || (string)$obj['wp_type'] === 'cntrspch_resource' || (string)$obj['wp_type'] === 'cntrspch_partner' || (string)$obj['wp_type'] === 'cntrspch_gi' || (string)$obj['wp_type'] === 'cntrspch_country' || (string)$obj['wp_type'] === 'cntrspch_campaign' || (string)$obj['wp_type'] === 'attachment') {
				$posts[] = array(
					'original_id' => (string) $obj['wp_post_id'],
          			'id'          => (isset( $request['rewrite_ids'] ) && $request['rewrite_ids']==='on')?(string) $obj['wp_post_id']:0,
					'type'		  => (string) $obj['wp_type'],
					'title'		  => (string) $obj->{'wp-post-title'},
          			'status'	  => (isset( $request['all_draft'] ) && $request['all_draft']==='on')?'draft':(string) $obj['wp_post_status'],
					'content'	  => $obj->{'wp-post-content'}->asXML(),
					'custom'	  => $this->get_custom_fields( $obj ),
					'excerpt'	  => (string) $this->get_excerpt( $obj ),
					'menu_order'  => (string) $obj['wp_menu_order'],
					'post_name'  => (string) $obj['wp_post_name'],
				);


			} 
			elseif ( (string)$obj['wp_type'] === 'region' ) {
						
				$regions[] = array(
					'region_id' 		=> (string) $obj['wp_region_id'],
					'region_slug' 	=> (string) $obj->{'wp-region-slug'},
					'region_name' 	=> (string) $obj->{'wp-region-name'},
					'region_description' => (string) $obj->{'wp-region-description'},
					'region_order' => (string) $obj['wp_region_order'],
				);
			
			}
			elseif ( (string)$obj['wp_type'] === 'resource_language' ) {
				$menu_items = array();
				
				$resource_languages[] = array(
					'resource_language_id' 		=> (string) $obj['wp_resource_language_id'],
					'resource_language_slug' 	=> (string) $obj->{'wp-resource-language-slug'},
					'resource_language_name' 	=> (string) $obj->{'wp-resource-language-name'},
					'resource_language_description' => (string) $obj->{'wp-resource-language-description'},
					'resource_language_order' => (string) $obj['wp_resource_language_order'],
				);
			}
			
			elseif ( (string)$obj['wp_type'] === 'option' ) {
				
				$options[] = array(
					'option_name' 		=> (string) $obj['wp_option_name'],
					'option_value' 	=> (string) $obj->{'wp-label-counterspeach-value'},
				);
			
			}
		}

		$this->posts( $posts );
		$this->regions( $regions );
		$this->resource_languages($resource_languages);
		$this->global_options($options);

		return $this->output;
	}

	/**
	 * Import posts
	 * @param  array $posts
	 */
	private function posts( $posts ) {

		foreach ( $posts as $post ) {

			$this->switch_to_original_site();

			$current_post = get_post( $post['original_id'],  ARRAY_A );
			$id 		  = $this->get_related_post_id( $post['original_id'] );

			$this->switch_to_target_site();


			if($current_post['ID'])
				$id=$post['id'];


			$current_post['ID'] 		  = (int) $id;
			$current_post['import_id'] 	  = $post['id'];
			$current_post['post_title']   = $post['title'];
			$current_post['post_type']    = $post['type'];
			$current_post['post_status']  = $post['status'];
			$current_post['post_content'] = $post['content'];
			$current_post['post_excerpt'] = $post['excerpt'];
			$current_post['menu_order']   = $post['menu_order'];
			$current_post['post_name']   = $post['post_name'];
			
			unset(
				$current_post['post_content_filtered'],
				$current_post['guid']
			);

			$post_id = wp_insert_post( $current_post, true );

			if ( is_wp_error( $post_id ) ) {
				$this->output['posts'][] = array(
					'description' => 'Error importing Post/Page ' . $post['original_id'] . ': ' . $post_id->get_error_message(),
					'type'	  	  => 'error',
				);
				continue;
			}

			$this->output['posts'][] = array(
				'description' => 'Success importing Post/Page ' . $post['original_id'] . ' into ' . $post_id,
				'type'	  	  => 'success',
			);
			
			foreach ( $post['custom'] as $key => $cf ) {
				// check if the val is a string encoded array
				// this is required for meta box field type
				// TODO: Figure out solve for nested arrays
				if ((string)$key === 'contact_contact_form') {
					// takes xml string as input
					$cf_parsed = $this->parser->from_xml($cf->asXML());
					update_post_meta( $post_id, $key, $cf_parsed);
				} elseif ((string)$key === 'home_map') {
					$cf['mobile_countries'] = unserialize($cf['mobile_countries']);
					update_post_meta( $post_id, $key, $cf );
				} elseif ((string)$key === 'country_resource' || (string)$key === "country_partner" || (string)$key === "mobile_countries" || (string)$key === "country_sibling_gi" || (string)$key === "gi_partner" || (string)$key === 'home_initiatives' || (string)$key === 'gi_featured_campaigns') {
					update_post_meta( $post_id, $key, unserialize($cf) );
				} else {
					update_post_meta( $post_id, $key, $cf );
				}
			}
			$this->switch_to_original_site();
			if ( $id == 0 ) {
				$this->mlp_content_relations->set_relation(
					$this->original_site,
					$this->target_site,
					$post['original_id'],
					$post_id,
					'post'
				);
			}

		}
	}

	/**
	 * Import Regions
	 * @param  array $regions
	 */
	private function regions( $regions ) {

		$this->switch_to_target_site();
		
		foreach ( $regions as $region ) {

			$this->switch_to_target_site();
			
			$this->output['menus'][] = array(
				'description' => 'Success importing term ' . $region['region_name'],
				'type'	  	  => 'success',
			);
			
			// get required term data
			$term_name = $region['region_name'];
			$term_slug = $region['region_slug'];
			$term_description = $region['region_description'];
			$term_order = $region['region_order'];
			
			// check if term already exists
			// update term if exists
			// insert term if new
			$prev_term_exists = term_exists($term_slug, 'cntrspch_region');
			if ($prev_term_exists !== 0 && $prev_term_exists !== null) {
				$prev_term = get_term_by('slug', $term_slug, 'cntrspch_region');
				$prev_term_id = (int) $prev_term->term_id;
				wp_update_term( 
					$prev_term_id, 
					'cntrspch_region', 
					array(
						'name' => $term_name,
						'description'=> $term_description,
					)
				);
			} else {
				wp_insert_term(
					$term_name, // the term 
					'cntrspch_region', // the taxonomy
					array(
						'description'=> $term_description,
						'slug' => $term_slug,
					)
				);
			}
			
			// set the order of the terms
			// this is required to show in menus
			$new_term = get_term_by('slug', $term_slug, 'cntrspch_region');
			$new_term_id = $new_term->term_id;
			update_term_meta($new_term_id, 'order', $term_order);
		}
	}
	
	
		/**
		 * Import Resource Languages
		 * @param  array $resource
		 */
		private function resource_languages( $resources ) {

			$this->switch_to_target_site();

			foreach ( $resources as $resource ) {

				$this->switch_to_target_site();
				
				$this->output['menus'][] = array(
					'description' => 'Success importing term ' . $resource['resource_language_name'],
					'type'	  	  => 'success',
				);
				
				// get term data
				$term_name = $resource['resource_language_name'];
				$term_slug = $resource['resource_language_slug'];
				$term_description = $resource['resource_language_description'];
				
				// check if term already exists
				// update term if exists
				// insert term if new
				$prev_term_exists = term_exists($term_slug, 'cntrspch_resource_language');
				if ($prev_term_exists !== 0 && $prev_term_exists !== null) {
				  $prev_term = get_term_by('slug', $term_slug, 'cntrspch_resource_language');
					$prev_term_id = (int) $prev_term->term_id;
					wp_update_term( 
						$prev_term_id,
						'cntrspch_resource_language', 
						array(
							'name' => $term_name,
							'description'=> $term_description,
						) 
					);
				} else {
					wp_insert_term(
						$term_name, // the term 
						'cntrspch_resource_language', // the taxonomy
						array(
							'description'=> $term_description,
							'slug' => $term_slug,
						)
					);
				}
			}
		}
		
	/**
	 * Import Global Options - these are the lables located on the site under
	 * settings -> Sitewide Lables
	 * @param  array $menus
	 */
	private function global_options( $options ) {

		$this->switch_to_target_site();

		foreach ( $options as $option ) {

			$this->switch_to_target_site();
			
			$this->output['menus'][] = array(
				'description' => 'Success importing options ' . $option['option_name'],
				'type'	  	  => 'success',
			);
			
			$option_name = $option['option_name'];
			$option_value = $option['option_value'];
			
			update_option( $option_name, $option_value);
		}
	}
		
		
	/**
	 * Get custom fields for a post an returns them as an array.
	 * @param  SimpleXMLElement $obj
	 * @return array
	 */
	private function get_custom_fields( $obj ) {

		$custom_fields = $this->filter_array->customFieldsArray();
		$sorted_fields = array();
		if ( $obj->{'wp-custom-fields'}->{'wp-custom-field'} ) {

			foreach ( $obj->{'wp-custom-fields'}->{'wp-custom-field'} as $field ) {
				
				$type = (string) $field['wp_type'];
				if ( isset( $custom_fields[$type] ) ) {
					if ( isset( $custom_fields[$type]['parent'] ) && empty( $custom_fields[$type]['structure'] ) ) {
						if((string)$type === 'contact_contact_form') {
							$sorted_fields[$type] = $field->{$custom_fields[$type]['parent']}->{$custom_fields[$type]['tag']}->children();
						} else {
							$sorted_fields[$type] = (string) $field->{$custom_fields[$type]['parent']}->{$custom_fields[$type]['tag']};
						}
					} else {
						$current 			  = $custom_fields[$type];
						$sorted_fields[$type] = $this->parse_xml_custom_fields( $current, $field );
					}
				}
			}
		}

		return $sorted_fields;
	}

	/**
	 * Parse XMl for Custom Fields
	 * @param  array $current
	 * @param  SimpleXMLElement $field
	 * @return array
	 */
	private function parse_xml_custom_fields( $current, $field ) {

		$sorted_fields = array();
		$count 	 	   = 0;

		foreach ($field->children() as $children) {
			if ( $children->getName() == $current['tag'] ) { 
				foreach ($children->children() as $grandchildren) {
					$gc_name = (string) $grandchildren->getName();
					
					if ( $gc_key = array_search( $gc_name, $current['structure'] ) ) {
						
						$value = (string) $grandchildren;
						if ( (string)$gc_key === 'content' || (string)$gc_key === 'text' ) {
							$value = $this->strip_xml_tag( $grandchildren->asXML(), $gc_name );
						}
						if( $current['repeater'] ) {
							$sorted_fields[$count][$gc_key] = $value;
						} else {
							$sorted_fields[$gc_key] = $value;
						}

					} else {
						$gc_type = (string) $grandchildren['wp_type'];
						if ( isset( $current['structure'][$gc_type] ) ) {
							$gc_current = $current['structure'][$gc_type];
							if( $current['repeater'] ) {
								$sorted_fields[$count][$gc_type] = $this->parse_xml_custom_fields( $gc_current, $grandchildren );
							} else {
								// check if group is nested in another group
								// prevents an invalid array index
								if(isset($current['inner']) && $current['inner']) {
									$sorted_fields[$gc_type] = $this->parse_xml_custom_fields( $gc_current, $grandchildren );
								} else {
									$sorted_fields[$gc_key][$gc_type] = $this->parse_xml_custom_fields( $gc_current, $grandchildren );
								}
							}
						}
					}
				}
				$count++;
			}
		}

		return $sorted_fields;
	}

	/**
	 * Get excerpt for a post
	 * @param  SimpleXMLElement $obj
	 * @return string
	 */
	private function get_excerpt( $obj ) {
		$result = $obj->xpath('wp-custom-fields/wp-custom-field/wp-excerpt');
		if ( isset( $result[0] ) ) {
			return (string) $result[0];
		}
		return '';
	}

	/**
	 * Get content for a post while stripping its custom fields
	 * @param  SimpleXMLElement $obj
	 * @return string
	 */
	private function get_content( $obj ) {
		$content = (string) $this->strip_xml_tag( $obj->asXML(), 'wp-obj' );
		return preg_replace( '/<wp-custom-fields>(.*?)<\/wp-custom-fields>/s', '', $content );
	}

	/**
	 * Returns the id of post for the target site.
	 * @param  string|int $id
	 * @return string|int
	 */
	private function get_related_post_id( $id ) {

		$ids = mlp_get_linked_elements( $id );

		if ( isset( $ids[ $this->target_site ] ) ) {
			return $ids[ $this->target_site ];
		}

		return 0;
	}

	/**
	 * Correct orginial site to target site
	 * e.g. domain.com/en/my-post becomes domain.com/fr/my-post
	 * @param  string $url
	 * @return string
	 */
	private function correct_site_urls( $url ) {

		$protocols 			  = array( 'http://', 'https://' );
		$site_url  			  = str_replace( $protocols, '', get_site_url() );
		$original_site_prefix = mlp_get_blog_language( $this->original_site );
		$target_site_prefix   = mlp_get_blog_language( $this->target_site );

		return str_replace( $site_url . $original_site_prefix . '/', $site_url . $target_site_prefix . '/', $url );
	}

	/**
	 * Strips opening and closing tag of a string.
	 * @param  string $string
	 * @param  string $tag_name
	 * @return string
	 */
	private function strip_xml_tag( $string, $tag_name ) {
		$string = preg_replace( '/<('. $tag_name .') [^>]*>/', '', $string );
		$string = str_replace( '<'. $tag_name .'>', '', $string );
		$string = str_replace( '</'. $tag_name .'>', '', $string );
		return $string;
	}

	/**
	 * Switches site/blog to original site (where content came from)
	 */
	private function switch_to_original_site() {
		switch_to_blog( $this->original_site );
	}

	/**
	 * Switches site/blog to target site (where content going too)
	 */
	private function switch_to_target_site() {
		switch_to_blog( $this->target_site );
	}

	/**
	 * Sets 'target_site' from the locale found in the import file.
	 * @param string $locale
	 */
	private function set_target_site( $locale ) {

		$languages 	     = mlp_get_available_languages( true );
		$target_language = substr( $locale, 0, 2 );

		foreach( $languages as $site => $language ) {
			if ( stripos( $language, $target_language ) === 0 ) {
				$this->target_site = $site;
				break;
			}
		}

	}

}
