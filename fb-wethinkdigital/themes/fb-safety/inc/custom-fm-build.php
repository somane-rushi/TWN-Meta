<?php
/**
 * Custom FIELD MANAGER BUILD
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class FieldManagerCustomBuild {

  public function __construct() {
    $this->cfm_setup();
  }

  protected function cfm_setup() {
    fm_register_submenu_page( 'global_fields', 'themes.php', 'Global Theme Options' );
    add_action( 'edit_form_after_title', array( $this, 'my_edit_form_after_title' ) );
    add_action( 'fm_submenu_global_fields', array( $this, 'global__fields' ) );
    add_action( 'fm_post_module', array( $this, 'module__fields_individual' ) );
    add_action( 'fm_post_module', array( $this, 'module__fields_main_top' ) );
    add_action( 'fm_post_module', array( $this, 'module__fields_lessons' ) );
    add_action( 'fm_post_module', array( $this, 'module__fields_main_bot' ) );
    add_action( 'fm_post_lesson', array( $this, 'lesson__fields_individual' ) );
    add_action( 'fm_post_page', array( $this, 'page__fields' ) );
    add_action( 'fm_post_video', array( $this, 'video__fields' ) );
  }

  /**
   * Set up the my_after_title context
   *
   * @return void
   */
  public function my_edit_form_after_title() {
    global $post, $wp_meta_boxes;
    do_meta_boxes( get_current_screen(), 'my_after_title', $post );
    unset( $wp_meta_boxes['post']['my_after_title'] );
  }

  /**
   * Return all published custom post type Module
   *
   * @return array
   */
  protected function get_all_cpt_modules() {
    $modules_array = array();
    $modules_query = new WP_Query( 
      array( 
        'post_type'           => 'module', 
        'post_status'         => 'publish', 
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
        'post_parent'         => 0,
        'posts_per_page'      => 50 
      ) 
    );
    if ( $modules_query->have_posts() ) {
      while ( $modules_query->have_posts() ) {
        $modules_query->the_post(); 
        $ID    = get_the_ID();
        $title = get_the_title();
        $modules_array[sanitize_key($ID)] = sanitize_text_field($title);
      }
    }
    wp_reset_postdata();
    ksort($modules_array);
    return $modules_array;
  }

  /**
   * Return child pages for a module
   *
   * @param integer $post_id
   * @return array
   */
  protected function get_module_child_pages($post_id) {
    $child_array = array();
    $child_query = new WP_Query( 
      array(  
        'post_type'           => 'module', 
        'post_status'         => 'publish', 
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
        'post_parent'         => $post_id, 
        'posts_per_page'      => 10 
      ) 
    );
    if ( $child_query->have_posts() ) {
      while ( $child_query->have_posts() ) {
        $child_query->the_post(); 
        $ID    = get_the_ID();
        $title = get_the_title();
        $child_array[sanitize_key($ID)] = sanitize_text_field($title) . ' (for ' . sanitize_text_field( get_the_title($post_id) ) . ')';
      }
    }
    wp_reset_postdata();
    ksort($child_array);
    return $child_array;
  }

  /**
   * Return all published custom post type Lesson
   *
   * @param @associated_id Optional ID of associated Module
   *
   * @return array
   */
  protected function get_all_cpt_lessons($associated_id='') {
    $lessons_array = array();
    $args = array( 
      'post_type'           => 'lesson', 
      'post_status'         => 'publish', 
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
      'posts_per_page'      => 99 
    );
    if ( ! empty($associated_id) ) {
      $args['meta_query'] = array(
        array(
            'key'     => 'module_id',
            'value'   => array( $associated_id ),
            'compare' => 'IN',
        ),
      );      
    }
    $lessons_query = new WP_Query( $args );
    if ( $lessons_query->have_posts() ) {
      while ( $lessons_query->have_posts() ) {
        $lessons_query->the_post(); 
        $ID    = get_the_ID();
        $title = get_the_title();
        $lessons_array[sanitize_key($ID)] = sanitize_text_field($title);
      }
    }
    wp_reset_postdata();
    ksort($lessons_array);
    return $lessons_array;
  }

  /**
   * Return all Lessons associated with all Modules
   *
   * @return array
   */
  protected function get_all_lessons() {
    $lessons_array = array();
    $lessons = $this->get_all_cpt_lessons();
    foreach ($lessons as $k => $v) {
      $module_id         = intval( get_post_meta($k, 'module_id', true) );
      $module_title      = get_the_title($module_id);
      $module_key        = sanitize_key($module_title);
      $lessons_array[$module_key . '__' . $k] = sanitize_text_field($module_title . ': ' . $v);
    }
    ksort($lessons_array);
    return $lessons_array;
  }

  /**
   * Return all published custom post type Video
   *
   * @return array
   */
  protected function get_all_cpt_videos() {
    $array = array();
    $query = new WP_Query( 
      array( 
        'post_type'           => 'video', 
        'post_status'         => 'publish', 
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
        'post_parent'         => 0,
        'posts_per_page'      => 99 
      ) 
    );
    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
        $query->the_post(); 
        $ID    = get_the_ID();
        $title = get_the_title();
        $array[sanitize_key($ID)] = sanitize_text_field($title);
      }
    }
    wp_reset_postdata();
    return $array;
  }

  /**
   * Reusable array, basic colors
   *
   * @return array
   */
  public function colors_basic_arr() {
    return array(
      'black'  => 'Black',
      'blue'   => 'Blue',
      'green'  => 'Green',
      'grey'   => 'Grey',
      'indigo' => 'Indigo',
      'navy'   => 'Navy',
      'orange' => 'Orange',
      'purple' => 'Purple',
      'red'    => 'Red',
      'teal'   => 'Teal',
      'white'  => 'White',
      'yellow' => 'Yellow'
    );
  }

  /**
   * Reusable array, advanced colors
   *
   * @return array
   */
  public function colors_advanced_arr() {
    return array(
      'black'        => 'Black',
      'blue-deep'    => 'Blue (Deep)',
      'blue-core'    => 'Blue (Core)',
      'blue-pale'    => 'Blue (Pale)',
      'blue-light'   => 'Blue (Light)',
      'green-deep'   => 'Green (Deep)',
      'green-core'   => 'Green (Core)',
      'green-pale'   => 'Green (Pale)',
      'green-light'  => 'Green (Light)',
      'grey-dark'    => 'Grey (Dark)',
      'grey-medium'  => 'Grey (Medium)',
      'grey-light'   => 'Grey (Light)',
      'indigo-deep'  => 'Indigo (Deep)',
      'indigo-pale'  => 'Indigo (Pale)',
      'indigo-light' => 'Indigo (Light)',
      'navy-deep'    => 'Navy (Deep)',
      'navy-core'    => 'Navy (Core)',
      'navy-pale'    => 'Navy (Pale)',
      'navy-light'   => 'Navy (Light)',
      'orange-deep'  => 'Orange (Deep)',
      'orange-core'  => 'Orange (Core)',
      'orange-pale'  => 'Orange (Pale)',
      'orange-light' => 'Orange (Light)',
      'purple-deep'  => 'Purple (Deep)',
      'purple-pale'  => 'Purple (Pale)',
      'purple-light' => 'Purple (Light)',
      'red-deep'     => 'Red (Deep)',
      'red-core'     => 'Red (Core)',
      'red-pale'     => 'Red (Pale)',
      'red-light'    => 'Red (Light)',
      'teal-deep'    => 'Teal (Deep)',
      'teal-pale'    => 'Teal (Pale)',
      'teal-light'   => 'Teal (Light)',
      'teal-light'   => 'Teal (Light)',
      'white'        => 'White',
      'yellow-pale'  => 'Yellow (Pale)',
      'yellow-light' => 'Yellow (Light)'
    );
  }

  /**
   * Reusable array, background colors
   *
   * @return array
   */
  public function bgcolors_arr() {
    return array(
      'black'        => 'Black',
      'blue-pale'    => 'Blue (Pale)',
      'blue-light'   => 'Blue (Light)',
      'green-pale'   => 'Green (Pale)',
      'green-light'  => 'Green (Light)',
      'grey-light'   => 'Grey (Light)',
      'grey-medium'  => 'Grey (Medium)',
      'indigo-pale'  => 'Indigo (Pale)',
      'indigo-light' => 'Indigo (Light)',
      'navy-pale'    => 'Navy (Pale)',
      'navy-light'   => 'Navy (Light)',
      'orange-pale'  => 'Orange (Pale)',
      'orange-light' => 'Orange (Light)',
      'purple-pale'  => 'Purple (Pale)',
      'purple-light' => 'Purple (Light)',
      'red-pale'     => 'Red (Pale)',
      'red-light'    => 'Red (Light)',
      'teal-pale'    => 'Teal (Pale)',
      'teal-light'   => 'Teal (Light)',
      'white'        => 'White',
      'yellow-pale'  => 'Yellow (Pale)',
      'yellow-light' => 'Yellow (Light)'
    );
  }

  /**
   * Reusable array, positioning
   *
   * @return array
   */
  public function positioning_arr() {
    return array(
      'left'  => 'Left',
      'right' => 'Right'
    );
  }

  /**
   * Reusable array, resource types
   *
   * @return array
   */
  public function resource_types() {
    return array(
      'educator_copy'          => 'Educator Copy',
      'student_handout'        => 'Student Handout',
      'supplementary_resource' => 'Supplementary Resource'
    );
  }

  /**
   * Random large number
   *
   * @return integer
   */
  public function generate_rand_num() {
    return intval( wp_rand(11111,99999999999999) );
  }

  /**
   * array of integers
   *
   * @return array
   */
  public function generate_array_of_numbers() {
    return array_combine( range(1,30), range(1,30) );
  }

  /**
   * Sets up the FieldManager fields for GLOBAL SITE SETTINGS
   *
   * @return $fmg, a main field manager group consisting of fieldmanager subgroups
   */
  public function global__fields() {

    $fmg = new Fieldmanager_Group( array(
      'name'     => 'global_fields',
      'children' => array(
        'text_404' => new Fieldmanager_TextField( array(
            'label'       => __( '404 Page Text', 'fbsafety' ),
            'description' => __( 'Text that will be displayed on the 404 page.', 'fbsafety' )
        ) ),
        'image_404' => new Fieldmanager_Media( array(
          'label'       => __( '404 Page Hero Image', 'fbsafety' ),
          'description' => __( 'Image that will be displayed on the 404 page.', 'fbsafety' ),
        ) ),
        'autocomplete_toggle' => new Fieldmanager_Checkbox( array(
          'label'       => __( 'Turn on autocomplete for search?', 'fbsafety' ),
          'description' => __( 'Check this box to activate autocomplete for search terms.', 'fbsafety' ),
        ) ),
        'autocomplete_search_terms' =>  new Fieldmanager_TextArea( array(
          'label'       => __( 'Autocomplete Search Terms', 'fbsafety' ),
          'description' => __( 'Enter terms, separated by commas.', 'fbsafety' ),
          'display_if'  => array( 'src' => 'autocomplete_toggle', 'value' => '1' ),
        ) ),
        'default_search_title' => new Fieldmanager_TextField( array(
            'label'       => __( 'Default Search Title', 'fbsafety' ),
            'description' => __( 'Will be used in the v2 search section throughout the site.', 'fbsafety' )
        ) ),
        'default_search_term' => new Fieldmanager_TextField( array(
            'label'       => __( 'Default Search Term', 'fbsafety' ),
            'description' => __( 'Will be used in all variations of search boxes throughout the site.', 'fbsafety' )
        ) ),
        'no_search_results_message' => new Fieldmanager_RichTextArea( array(
            'label'       => __( 'Default Message for No Search Results', 'fbsafety' ),
            'description' => __( 'Will be used when search results produce no results throughout the site.', 'fbsafety' )
        ) ),
        'finished_module_text' => new Fieldmanager_TextField( array(
            'label'       => __( 'Finished Module Default Text', 'fbsafety' ),
            'description' => __( 'This text will be displayed in a banner on the resources page for a module.', 'fbsafety' )
        ) ),
        'fl_custom_title' => new Fieldmanager_TextField( array(
            'label'       => __( 'Custom Title for the Featured Lessons Slider', 'fbsafety' ),
            'description' => __( 'This will be used in the Featured Lessons Slider throughout the site. If this is left blank, the title will default to display "Featured". ', 'fbsafety' )
        ) ),
        'the_lessons' => new Fieldmanager_Checkboxes( array(
            'label'       => __( 'Default Lessons to feature in the Featured Lessons Slider', 'fbsafety' ),
            'description' => __( 'These will be used in the Featured Lessons Slider throughout the site.', 'fbsafety' ),
            'options'     => $this->get_all_lessons()
        ) ),
        'quicklinks' => new Fieldmanager_Group( array(
            'label'       => __( 'Default Quick Links for Search', 'fbsafety' ),
            'description' => __( 'Define up to 6 quick links to be displayed by default with search forms on the site.', 'fbsafety' ),
            'children'      => array(
              'link1' => new Fieldmanager_Select( array(
                'label'       => __( 'Module Quick Link 1', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_all_cpt_modules(),
              ) ),
              'link2' => new Fieldmanager_Select( array(
                'label'       => __( 'Module Quick Link 2', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_all_cpt_modules(),
              ) ),
              'link3' => new Fieldmanager_Select( array(
                'label'       => __( 'Module Quick Link 3', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_all_cpt_modules(),
              ) ),
              'link4' => new Fieldmanager_Select( array(
                'label'       => __( 'Module Quick Link 4', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_all_cpt_modules(),
              ) ),
              'link5' => new Fieldmanager_Select( array(
                'label'       => __( 'Module Quick Link 5', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_all_cpt_modules(),
              ) ),
              'link6' => new Fieldmanager_Select( array(
                'label'       => __( 'Module Quick Link 6', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_all_cpt_modules(),
              ) ),
            ),
        ) ),
      ), 
    ) );

    $fmg->activate_submenu_page();

    return $fmg;     

  }

  /**
   * Sets up the PAGEFIELDS FieldManager fields for ALL PAGES
   *
   * @return $fmg, a main field manager group consisting of fieldmanager subgroups
   */
  public function page__fields() {

    $name     = 'Page Fields';
    $lower    = 'pagefields';
    $singular = 'pagefields';

    $fmg = new Fieldmanager_Group(
      [
        'name'           => $lower,
        'label'          => __( $name, 'fbsafety' ),
        'limit'          => 0,
        'sortable'       => 1,
        'collapsible'    => 1,
        'collapsed'      => 1,
        'add_more_label' => __( 'Add another section', 'fbsafety' ),
        'group_is_empty' => function ( $values ) {
          return empty( $values['which_subgroup'] );
        },
      ]
    );

    $the_select = new Fieldmanager_Select(
      __( 'Select Type', 'fbsafety' ), [
        'name' => 'which_subgroup',
      ]
    );

    $fmg->add_child( $the_select );

    $allowed_types = array(
      'all_modules',
      'breadcrumbs',
      'committee_slider',
      'faq_questions',
      'glossary_terms',
      'featured_lessons',
      'featured_lessons_grid',
      'featured_module',
      'hero_section',
      'hero_section_basic',
      'main_page_content',
      'page_content_collapsable',
      'partners_section',
      'site_search',
      'site_search_full',
      'two_col_text_all',
      'two_col_text_img',
      'two_col_cta_img',
      'three_col_text',
      'video_archive'
    );

    $fullgroup = [];

    foreach ( $allowed_types as $type ) {
      switch ( $type ) {

        case 'all_modules':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'all_modules',
        'label'    => __( 'All Modules', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
          'title' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Title', 'fbsafety' ),
            'description' => __( 'Title for this section.', 'fbsafety' ),
            ) ),
          'description' =>  new Fieldmanager_TextArea( array(
            'label'       => __( 'Description', 'fbsafety' ),
            'description' => __( 'Descrption for this section.', 'fbsafety' ),
            ) ),
          ), 
        ) );
        break;

        case 'breadcrumbs':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'breadcrumbs',
        'label'    => __( 'Breadcrumbs', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          ), 
        ) );
        break;

        case 'committee_slider':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'committee_slider',
        'label'    => __( 'Committee Slider', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          'bg_color' => new Fieldmanager_Select( array(
                'label'       => __( 'Background Color', 'fbsafety' ),
                'description' => __( 'Background color of this section. Note: Will default to Green if left empty.', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->bgcolors_arr()
          ) ),
          'title' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Title', 'fbsafety' ),
            'description' => __( 'Title for this section.', 'fbsafety' ),
          ) ),
          'description' =>  new Fieldmanager_TextArea( array(
            'label'       => __( 'Description', 'fbsafety' ),
            'description' => __( 'Description of this section.', 'fbsafety' ),
          ) ),
          'slider' => new Fieldmanager_Group( array(
              'limit'          => 50,
              'add_more_label' => __( 'Add Person', 'fbsafety' ),
              'sortable'       => true,
              'extra_elements' => 0,
              'group_is_empty' => function ( $values ) {
                  return empty( $values['a_person'] );
              },
              'children'       => array(
                'a_person' => new Fieldmanager_Group( array(
                  'extra_elements' => 0,
                  'group_is_empty' => function ( $values ) {
                    return empty( $values['name'] );
                  },
                  'label'    => __( 'Person', 'fbsafety' ),
                  'children' => array(
                    'name' => new Fieldmanager_TextField( array(
                      'label'       => __( 'Name', 'fbsafety' ),
                      'description' => __( 'Name of person to be featured.', 'fbsafety' ),
                    ) ),
                    'title' => new Fieldmanager_TextArea( array(
                      'label'       => __( 'Title', 'fbsafety' ),
                      'description' => __( 'Title of the person featured.', 'fbsafety' ),
                    ) ),
                    'description' =>  new Fieldmanager_RichTextArea( array(
                      'label'       => __( 'Description', 'fbsafety' ),
                      'description' => __( 'Description of the person featured.', 'fbsafety' ),
                    ) ),
                    'image' => new Fieldmanager_Media( array(
                      'label'       => __( 'Image', 'fbsafety' ),
                      'description' => __( 'Image of the person featured.', 'fbsafety' ),
                    ) ),
                  ),
                ) ),
              ),
          ) ),
          ), 
        ) );
        break;

        case 'faq_questions':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'faq_questions',
        'label'    => __( 'FAQ Questions', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          'title' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Title', 'fbsafety' ),
            'description' => __( 'The title for this section.', 'fbsafety' ),
          ) ),
          'divider_toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display a divider above the title?', 'fbsafety' ),
            'description' => __( 'Check this box to display a divider above the title.', 'fbsafety' ),
          ) ),
          'content' => new Fieldmanager_Group( array(
              'limit'          => 50,
              'add_more_label' => __( 'Add a Question', 'fbsafety' ),
              'sortable'       => true,
              'extra_elements' => 0,
              'group_is_empty' => function ( $values ) {
                  return empty( $values['a_question'] );
              },
              'children'       => array(
                'a_question' => new Fieldmanager_Group( array(
                  'extra_elements' => 0,
                  'group_is_empty' => function ( $values ) {
                    return empty( $values['question'] );
                  },
                  'label'    => __( 'A Question', 'fbsafety' ),
                  'children' => array(
                    'question' => new Fieldmanager_TextArea( array(
                      'label'       => __( 'Question', 'fbsafety' ),
                    ) ),
                    'answer' => new Fieldmanager_RichTextArea( array(
                      'label'       => __( 'Answer', 'fbsafety' ),
                    ) ),
                  ),
                ) ),
              ),
          ) ),
          ), 
        ) );
        break;

        case 'featured_lessons_grid':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'featured_lessons_grid',
        'label'    => __( 'Featured Lessons (Grid)', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          'custom_title' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Custom Title', 'fbsafety' ),
            'description' => __( 'Note: If this is left blank, the title will default to "Featured Lessons"', 'fbsafety' ),
            ) ),
          'the_lessons' => new Fieldmanager_Checkboxes( array(
              'label'       => __( 'Select Lessons to Feature', 'fbsafety' ),
              'description' => __( 'Note: A total of 3 lessons will be displayed. If more than 3 are selected here, the 3 displaying will be rotated on every page load.', 'fbsafety' ),
              'options'     => $this->get_all_lessons()
            ) ),
          ), 
        ) );
        break;

        case 'featured_lessons':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'featured_lessons',
        'label'    => __( 'Featured Lessons (Slider)', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          'custom_title' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Custom Title', 'fbsafety' ),
            'description' => __( 'Note: If this is left blank, the title will default to what is set in Global Theme Options.', 'fbsafety' ),
            ) ),
          'custom_toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Make custom selections to feature for this page only?', 'fbsafety' ),
            'description' => __( 'This is optional. If this is left unchecked, Featured Lessons defined in Theme Settings will be used by default.', 'fbsafety' ),
          ) ),
          'the_lessons' => new Fieldmanager_Checkboxes( array(
              'label'       => __( 'Select Custom Lessons to Feature', 'fbsafety' ),
              'description' => __( 'An unlimited number of lessons can be selected here.', 'fbsafety' ),
              'display_if'  => array( 'src' => 'custom_toggle', 'value' => '1' ),
              'options'     => $this->get_all_lessons()
          ) ),
          ), 
        ) );
        break;

        case 'featured_module':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'featured_module',
          'label'    => __( 'Featured Module', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
            'module_id' => new Fieldmanager_Select( array(
                'label'       => __( 'Featured Module', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_all_cpt_modules(),
                'description' => __( 'Select which module should be featured.', 'fbsafety' ),
            ) ),
            'bg_color' => new Fieldmanager_Select( array(
                  'label'       => __( 'Background Color', 'fbsafety' ),
                  'description' => __( 'Background color of this section.', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->bgcolors_arr()
            ) ),
            'btn_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display a button with link?', 'fbsafety' ),
              'description' => __( 'Check to display a button linked to the chosen featured module.', 'fbsafety' ),
            ) ),
            'btn_group' => new Fieldmanager_Group( array(
              'label'       => __( 'Button Details', 'fbsafety' ),
              'display_if'  => array( 'src' => 'btn_toggle', 'value' => '1' ),
              'children' => array(
                'btn_text' => new Fieldmanager_Textfield( array(
                  'label'       => __( 'Button Text', 'fbsafety' ),
                  'description' => __( 'This will default to "View the Module" if left empty.', 'fbsafety' ),
                ) ),
              )
            ) ),
            'show_lessons_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display associated lessons?', 'fbsafety' ),
              'description' => __( 'Check this box to display lessons associated with the selected module in this section.', 'fbsafety' ),
            ) ),
          ), 
        ) );
        break;

        case 'glossary_terms':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'glossary_terms',
        'label'    => __( 'Glossary Terms', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          'title' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Title', 'fbsafety' ),
            'description' => __( 'The title for this section.', 'fbsafety' ),
          ) ),
          'divider_toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display a divider above the title?', 'fbsafety' ),
            'description' => __( 'Check this box to display a divider above the title.', 'fbsafety' ),
          ) ),
          'content' => new Fieldmanager_Group( array(
              'limit'          => 50,
              'add_more_label' => __( 'Add a Term', 'fbsafety' ),
              'sortable'       => true,
              'extra_elements' => 0,
              'group_is_empty' => function ( $values ) {
                  return empty( $values['a_term'] );
              },
              'children'       => array(
                'a_term' => new Fieldmanager_Group( array(
                  'extra_elements' => 0,
                  'group_is_empty' => function ( $values ) {
                    return empty( $values['term'] );
                  },
                  'label'    => __( 'A Term', 'fbsafety' ),
                  'children' => array(
                    'term' => new Fieldmanager_TextArea( array(
                      'label'       => __( 'Term', 'fbsafety' ),
                    ) ),
                    'definition' => new Fieldmanager_RichTextArea( array(
                      'label'       => __( 'Definition', 'fbsafety' ),
                    ) ),
                  ),
                ) ),
              ),
          ) ),
          ), 
        ) );
        break;

        case 'hero_section':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'           => 'hero_section',
          'label'          => __( 'Hero (With Image)', 'fbsafety' ),
          'description'    => __( 'This is a standard Hero Section with an image.', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
            'image' => new Fieldmanager_Media( array(
              'label'       => __( 'Hero Image (Desktop)', 'fbsafety' ),
              'description' => __( 'Specify the hero image to be used.', 'fbsafety' ),
            ) ),
            'image_mob' => new Fieldmanager_Media( array(
              'label'       => __( 'Hero Image (Mobile)', 'fbsafety' ),
              'description' => __( 'Note: Image above (desktop) will be used for all devices if this is left empty.', 'fbsafety' ),
            ) ),
            'lighter_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Is this a lighter image?', 'fbsafety' ),
              'description' => __( 'Check this box if this is a lighter image. This will turn the navigation on top of the image darker.', 'fbsafety' ),
            ) ),
            'title' =>  new Fieldmanager_TextField( array(
              'label'       => __( 'Hero Title', 'fbsafety' ),
              'description' => __( 'The main hero title (H1).', 'fbsafety' ),
            ) ),
            'subtitle' =>  new Fieldmanager_TextArea( array(
              'label'       => __( 'Hero Subtitle', 'fbsafety' ),
              'description' => __( 'Note: Leave empty for no subtitle.', 'fbsafety' ),
            ) ),
            'text_color' => new Fieldmanager_Select( array(
                'label'       => __( 'Hero Text Color', 'fbsafety' ),
                'description' => __( 'Note: This will default to White if left empty.', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->colors_advanced_arr()
            ) ),
          ), 
        ) );
        break;

        case 'hero_section_basic':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'hero_section_basic',
          'label'    => __( 'Hero Basic (No Image)', 'fbsafety' ),
          'description'    => __( 'This is a basic Hero Section without an image (only a block of color).', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
            'title' =>  new Fieldmanager_TextField( array(
              'label'       => __( 'Hero Title', 'fbsafety' ),
              'description' => __( 'The main hero title (H1).', 'fbsafety' ),
            ) ),
            'bg_color' => new Fieldmanager_Select( array(
                'label'       => __( 'Hero Background Color', 'fbsafety' ),
                'description' => __( 'Note: This is required.', 'fbsafety' ),
                'first_empty' => true,
                'validation_rules' => array(
                  'required' => true,
                ),
                'options'     => $this->bgcolors_arr()
            ) ),
          ), 
        ) );
        break;

        case 'main_page_content':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'main_page_content',
          'label'    => __( 'Main Content Section', 'fbsafety' ),
          'description'    => __( 'This will display the main body content section from this page. Use the "Main Body Content" editor below to update.', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => 'Display this section?',
              'description' => 'Check this box to display this section.'
            ) ),
            'main_text' =>  new Fieldmanager_RichTextArea( array(
              'label'       => __( 'Main Body Content', 'fbsafety' ),
              'description' => __( 'The body content to be displayed in this section.', 'fbsafety' ),
            ) ),
          ), 
        ) );
        break;

        case 'page_content_collapsable':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'page_content_collapsable',
          'label'    => __( 'Page Content (Collapsable)', 'fbsafety' ),
          'description'    => __( 'This will display a body content section that can be collapsed via accordion.', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => 'Display this section?',
              'description' => 'Check this box to display this section.'
            ) ),
            'title' =>  new Fieldmanager_TextField( array(
              'label'       => __( 'Title', 'fbsafety' ),
              'description' => __( 'This title is required. It will be displayed on page if using a collapsable section. If not using this as a collapsable section, this title will not be displayed on page but will be used for labeling in wp-admin when editing this page.', 'fbsafety' ),
              'validation_rules' => array(
                'required' => true,
              ),
            ) ),
            'collapsable' => new Fieldmanager_Checkbox( array(
              'label'       => 'Make this section collapsable?',
              'description' => 'Check this box to enable a collapsable accordion on this section.',
              'display_if'  => array( 'src' => 'toggle', 'value' => '1' ),
            ) ),
            'collapsed' => new Fieldmanager_Checkbox( array(
              'label'       => 'Collapse this section?',
              'description' => 'Check this box to collapse this section on page load. It will otherwise be visible with the user option to collapse.',
              'display_if'  => array( 'src' => 'toggle', 'value' => '1' ),
            ) ),
            'main_text' =>  new Fieldmanager_RichTextArea( array(
              'label'       => __( 'Body Content', 'fbsafety' ),
              'description' => __( 'The body content to be displayed in this section.', 'fbsafety' ),
              'display_if'  => array( 'src' => 'toggle', 'value' => '1' ),
            ) ),
          ), 
        ) );
        break;

        case 'partners_section':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'partners_section',
        'label'    => __( 'Partners Section', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          'title' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Title', 'fbsafety' ),
            'description' => __( 'The title for this section.', 'fbsafety' ),
          ) ),
          'description' =>  new Fieldmanager_TextArea( array(
            'label'       => __( 'Description', 'fbsafety' ),
            'description' => __( 'The description for this section.', 'fbsafety' ),
          ) ),
          'display_all' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display all partners?', 'fbsafety' ),
            'description' => __( 'Check this box to display all partners on page load. If unchecked, there will be a More Results button if more than 10.', 'fbsafety' ),
          ) ),
          'partners' => new Fieldmanager_Group( array(
              'limit'          => 50,
              'add_more_label' => __( 'Add a Partner', 'fbsafety' ),
              'sortable'       => true,
              'extra_elements' => 0,
              'group_is_empty' => function ( $values ) {
                  return empty( $values['a_partner'] );
              },
              'children'       => array(
                'a_partner' => new Fieldmanager_Group( array(
                  'extra_elements' => 0,
                  'group_is_empty' => function ( $values ) {
                    return empty( $values['partner_name'] );
                  },
                  'label'    => __( 'A Partner', 'fbsafety' ),
                  'children' => array(
                    'partner_name' => new Fieldmanager_TextField( array(
                      'label'       => __( 'Partner Name', 'fbsafety' ),
                    ) ),
                    'partner_link' => new Fieldmanager_Link( array(
                      'label'       => __( 'Partner Link', 'fbsafety' ),
                    ) ),
                    'partner_description' => new Fieldmanager_TextArea( array(
                      'label'       => __( 'Partner Description', 'fbsafety' ),
                    ) ),
                    'partner_image' => new Fieldmanager_Media( array(
                      'label'       => __( 'Partner Image', 'fbsafety' ),
                      'description' => __( 'Upload or select an image.', 'fbsafety' ),
                    ) ),
                  ),
                ) ),
              ),
          ) ),
          ), 
        ) );
        break;

        case 'site_search':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'        => 'site_search',
        'label'       => __( 'Site Search (Under Hero)', 'fbsafety' ),
        'description' => __( 'This is the top search section that usually sits directly under the hero.', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
          'quicklinks_toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display Quick Links?', 'fbsafety' ),
            'description' => __( 'Check this box to display Quick Links with the search form.', 'fbsafety' ),
            ) ),
          'quicklinks_custom' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Specify Custom Quick Links?', 'fbsafety' ),
            'description' => __( 'Check this box to specify custom quick links. Otherwise, default quick links defined in Global Theme Settings will be used.', 'fbsafety' ),
            'display_if'  => array( 'src' => 'quicklinks_toggle', 'value' => '1' )
            ) ),
          'quicklinks' => new Fieldmanager_Group( array(
              'label'       => __( 'Default Quick Links for Search', 'fbsafety' ),
              'description' => __( 'Define up to 6 quick links to be displayed with the search form.', 'fbsafety' ),
              'display_if'  => array( 'src' => 'quicklinks_custom', 'value' => '1' ),
              'children'      => array(
                'link1' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 1', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link2' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 2', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link3' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 3', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link4' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 4', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link5' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 5', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link6' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 6', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
              ),
          ) ),
          ), 
        ) );
        break;

        case 'site_search_full':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'        => 'site_search_full',
        'label'       => __( 'Site Search (Full Page)', 'fbsafety' ),
        'description' => __( 'This was made specfically for the /search/ page, and should probably only be used on that page.', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
          'quicklinks_toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display Quick Links?', 'fbsafety' ),
            'description' => __( 'Check this box to display Quick Links with the search form.', 'fbsafety' ),
            ) ),
          'quicklinks_custom' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Specify Custom Quick Links?', 'fbsafety' ),
            'description' => __( 'Check this box to specify custom quick links. Otherwise, default quick links defined in Global Theme Settings will be used.', 'fbsafety' ),
            'display_if'  => array( 'src' => 'quicklinks_toggle', 'value' => '1' )
            ) ),
          'quicklinks' => new Fieldmanager_Group( array(
              'label'       => __( 'Default Quick Links for Search', 'fbsafety' ),
              'description' => __( 'Define up to 6 quick links to be displayed with the search form.', 'fbsafety' ),
              'display_if'  => array( 'src' => 'quicklinks_custom', 'value' => '1' ),
              'children'      => array(
                'link1' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 1', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link2' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 2', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link3' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 3', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link4' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 4', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link5' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 5', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
                'link6' => new Fieldmanager_Select( array(
                  'label'       => __( 'Module Quick Link 6', 'fbsafety' ),
                  'first_empty' => true,
                  'options'     => $this->get_all_cpt_modules(),
                ) ),
              ),
          ) ),
          ), 
        ) );
        break;

        case 'two_col_cta_img':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'two_col_cta_img',
          'label'    => __( 'Two Column (CTA & Image)', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => 'Display this section?',
              'description' => 'Check this box to display this section.'
            ) ),
            'bg_color' => new Fieldmanager_Select( array(
                'label'       => 'Section Background Color',
                'first_empty' => true,
                'options'     => $this->bgcolors_arr()
            ) ),
            'image' => new Fieldmanager_Media( array(
              'label'       => 'Image',
              'description' => 'Specify the image to be used.'
            ) ),
            'image_pos' => new Fieldmanager_Select( array(
                'label'   => 'Image Position',
                'options' => $this->positioning_arr()
            ) ),
            'main_text' =>  new Fieldmanager_RichTextArea( array(
              'label'       => 'Main Text',
              'description' => 'The main body content for this section.'
            ) ),
            'btn_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => 'Display a button with link?',
              'description' => 'Check to display a linked button under the main text.'
            ) ),
            'btn_group' => new Fieldmanager_Group( array(
              'label'       => 'Button Details',
              'display_if'  => array( 'src' => 'btn_toggle', 'value' => '1' ),
              'children' => array(
                'btn_text' => new Fieldmanager_Textfield( array(
                  'label'       => 'Button Text',
                  'description' => ''
                ) ),
                'btn_link' => new Fieldmanager_Textfield( array(
                  'label'       => 'Button Link',
                  'description' => ''
                ) ),
                'btn_target_blank' => new Fieldmanager_Checkbox( array(
                  'label'       => 'Open the link in a new window?',
                  'description' => 'Check to open in a new window.'
                ) ),
              )
            ) ),
          ), 
        ) );
        break;

        case 'two_col_text_all':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'two_col_text_all',
          'label'    => __( 'Two Column (All Text)', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
            'bg_color' => new Fieldmanager_Select( array(
                'label'       => __( 'Section Background Color', 'fbsafety' ),
                'description' => __( 'Note: This defaults to Grey if left empty.', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->bgcolors_arr()
            ) ),
            'large_text' =>  new Fieldmanager_TextArea( array(
              'label'       => __( 'Large Text', 'fbsafety' ),
              'description' => __( 'The larger text used in one half of this section.', 'fbsafety' ),
            ) ),
            'large_text_pos' => new Fieldmanager_Select( array(
                'label'       => __( 'Large Text Position', 'fbsafety' ),
                'description' => __( 'This defaults to left if not specified.', 'fbsafety' ),
                'options'     => $this->positioning_arr()
            ) ),
            'main_text' =>  new Fieldmanager_RichTextArea( array(
              'label'       => __( 'Main Text', 'fbsafety' ),
              'description' => __( 'The main body content used in one half of this section.', 'fbsafety' ),
            ) ),
            'btn_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display a button with link?', 'fbsafety' ),
              'description' => __( 'Check to display a linked button under the Main Text.', 'fbsafety' ),
            ) ),
            'btn_group' => new Fieldmanager_Group( array(
              'label'       => __( 'Button Details', 'fbsafety' ),
              'display_if'  => array( 'src' => 'btn_toggle', 'value' => '1' ),
              'children' => array(
                'btn_text' => new Fieldmanager_Textfield( array(
                  'label'       => __( 'Button Text', 'fbsafety' ),
                  'description' => __( '', 'fbsafety' ),
                ) ),
                'btn_link' => new Fieldmanager_Textfield( array(
                  'label'       => __( 'Button Link', 'fbsafety' ),
                  'description' => __( '', 'fbsafety' ),
                ) ),
                'btn_target_blank' => new Fieldmanager_Checkbox( array(
                  'label'       => __( 'Open the link in a new window?', 'fbsafety' ),
                  'description' => __( 'Check to open in a new window.', 'fbsafety' ),
                ) ),
              )
            ) ),
          ), 
        ) );
        break;

        case 'two_col_text_img':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'two_col_text_img',
          'label'    => __( 'Two Column (Text & Image)', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => 'Display this section?',
              'description' => 'Check this box to display this section.'
            ) ),
            'bg_color' => new Fieldmanager_Select( array(
                'label'       => 'Section Background Color',
                'first_empty' => true,
                'options'     => $this->bgcolors_arr()
            ) ),
            'image' => new Fieldmanager_Media( array(
              'label'       => 'Image',
              'description' => 'Specify the image to be used.'
            ) ),
            'image_pos' => new Fieldmanager_Select( array(
                'label'   => 'Image Position',
                'options' => $this->positioning_arr()
            ) ),
            'main_text' =>  new Fieldmanager_RichTextArea( array(
              'label'       => 'Main Text',
              'description' => 'The main body content for this section.'
            ) ),
            'btn_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => 'Display a button with link?',
              'description' => 'Check to display a linked button under the main text.'
            ) ),
            'btn_group' => new Fieldmanager_Group( array(
              'label'       => 'Button Details',
              'display_if'  => array( 'src' => 'btn_toggle', 'value' => '1' ),
              'children' => array(
                'btn_text' => new Fieldmanager_Textfield( array(
                  'label'       => 'Button Text',
                  'description' => ''
                ) ),
                'btn_link' => new Fieldmanager_Textfield( array(
                  'label'       => 'Button Link',
                  'description' => ''
                ) ),
                'btn_target_blank' => new Fieldmanager_Checkbox( array(
                  'label'       => 'Open the link in a new window?',
                  'description' => 'Check to open in a new window.'
                ) ),
              )
            ) ),
          ), 
        ) );
        break;

        case 'three_col_text':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'three_col_text',
          'label'    => __( 'Three Column (Text & Links)', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => 'Display this section?',
              'description' => 'Check this box to display this section.'
            ) ),
            'bg_color' => new Fieldmanager_Select( array(
                'label'       => 'Section Background Color',
                'first_empty' => true,
                'options'     => $this->bgcolors_arr()
            ) ),
            'section_group' => new Fieldmanager_Group( array(
              'label'       => 'Section Details',
              'children' => array(
                'main_text_1' =>  new Fieldmanager_RichTextArea( array(
                  'label'       => 'Main Text',
                  'description' => 'The main body content for this section.'
                ) ),
                'btn_toggle_1' => new Fieldmanager_Checkbox( array(
                  'label'       => 'Display a button with link?',
                  'description' => 'Check to display a linked button under the main text.'
                ) ),
                'btn_group_1' => new Fieldmanager_Group( array(
                  'label'       => 'Button Details',
                  'display_if'  => array( 'src' => 'btn_toggle_1', 'value' => '1' ),
                  'children' => array(
                    'btn_text' => new Fieldmanager_Textfield( array(
                      'label'       => 'Button Text',
                      'description' => ''
                    ) ),
                    'btn_link' => new Fieldmanager_Textfield( array(
                      'label'       => 'Button Link',
                      'description' => ''
                    ) ),
                    'btn_target_blank' => new Fieldmanager_Checkbox( array(
                      'label'       => 'Open the link in a new window?',
                      'description' => 'Check to open in a new window.'
                    ) ),
                  )
                ) ),
                'main_text_2' =>  new Fieldmanager_RichTextArea( array(
                  'label'       => 'Main Text',
                  'description' => 'The main body content for this section.'
                ) ),
                'btn_toggle_2' => new Fieldmanager_Checkbox( array(
                  'label'       => 'Display a button with link?',
                  'description' => 'Check to display a linked button under the main text.'
                ) ),
                'btn_group_2' => new Fieldmanager_Group( array(
                  'label'       => 'Button Details',
                  'display_if'  => array( 'src' => 'btn_toggle_2', 'value' => '1' ),
                  'children' => array(
                    'btn_text' => new Fieldmanager_Textfield( array(
                      'label'       => 'Button Text',
                      'description' => ''
                    ) ),
                    'btn_link' => new Fieldmanager_Textfield( array(
                      'label'       => 'Button Link',
                      'description' => ''
                    ) ),
                    'btn_target_blank' => new Fieldmanager_Checkbox( array(
                      'label'       => 'Open the link in a new window?',
                      'description' => 'Check to open in a new window.'
                    ) ),
                  )
                ) ),
                'main_text_3' =>  new Fieldmanager_RichTextArea( array(
                  'label'       => 'Main Text',
                  'description' => 'The main body content for this section.'
                ) ),
                'btn_toggle_3' => new Fieldmanager_Checkbox( array(
                  'label'       => 'Display a button with link?',
                  'description' => 'Check to display a linked button under the main text.'
                ) ),
                'btn_group_3' => new Fieldmanager_Group( array(
                  'label'       => 'Button Details',
                  'display_if'  => array( 'src' => 'btn_toggle_3', 'value' => '1' ),
                  'children' => array(
                    'btn_text' => new Fieldmanager_Textfield( array(
                      'label'       => 'Button Text',
                      'description' => ''
                    ) ),
                    'btn_link' => new Fieldmanager_Textfield( array(
                      'label'       => 'Button Link',
                      'description' => ''
                    ) ),
                    'btn_target_blank' => new Fieldmanager_Checkbox( array(
                      'label'       => 'Open the link in a new window?',
                      'description' => 'Check to open in a new window.'
                    ) ),
                  )
                ) ),
              )
            ) ),     
          ), 
        ) );
        break;

        case 'video_archive':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'video_archive',
        'label'    => __( 'Video Archive', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          'title' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Title', 'fbsafety' ),
            'description' => __( 'The optional title for this section.', 'fbsafety' ),
          ) ),
          'subtitle' =>  new Fieldmanager_TextField( array(
            'label'       => __( 'Subtitle', 'fbsafety' ),
            'description' => __( 'The optional subtitle for this section.', 'fbsafety' ),
          ) ),
          'description' =>  new Fieldmanager_TextArea( array(
            'label'       => __( 'Description', 'fbsafety' ),
            'description' => __( 'The optional description for this section.', 'fbsafety' ),
          ) ),

          'the_videos' => new Fieldmanager_Group( array(
            'name'           => 'the_videos',
            'limit'          => 99,
            'add_more_label' => __( 'Add a Video to the Archive', 'fbsafety' ),
            'sortable'       => true,
            'extra_elements' => 0,
            'group_is_empty' => function ( $values ) {
                return empty( $values['a_video'] );
            },
            'children'       => array(
              'a_video' => new Fieldmanager_Group( array(
                'extra_elements' => 0,
                'group_is_empty' => function ( $values ) {
                  return empty( $values['video'] );
                },
                'label'    => __( 'A video for the archive.', 'fbsafety' ),
                'children' => array(
                  'video' => new Fieldmanager_Select( array(
                      'label'       => __( 'Select Video', 'fbsafety' ),
                      'first_empty' => true,
                      'options'     => $this->get_all_cpt_videos(),
                      'description' => __( 'Select which video to add.', 'fbsafety' ),
                  ) ),
                ),
              ) ),
            ),
          ) ),

          ),
        ) );
        break;

      }
    }

    foreach ( $fullgroup as $flexfield ) {
      $the_select->add_options(
        [
          $flexfield->name => $flexfield->label,
        ]
      );
      $flexfield->display_if = [
        'src'   => 'which_subgroup',
        'value' => $flexfield->name,
      ];
      $fmg->add_child( $flexfield );
    }

    $fmg->add_meta_box( __( $name, 'fbsafety' ), array('page'), 'my_after_title', 'high' );

    return $fmg;

  }

  /**
   * Sets up individual FieldManager fields for custom post type MODULE
   *
   * @return $fmg, a main field manager group consisting of fieldmanager subgroups
   */
  public function module__fields_individual() {

    $fm0 = new Fieldmanager_Select( array(
      'name'             => 'module_number',
      'label'            => __( 'Module Number', 'fbsafety' ),
      'first_empty'      => true,
      'options'          => $this->generate_array_of_numbers(),
      'description'      => __( 'Which number is this module in the overall order of modules?', 'fbsafety' ),
      'validation_rules' => array(
        'required' => true,
      ),
    ) );

    $fm0->add_meta_box( __( 'Module Number (Order)', 'fbsafety' ), array('module'), 'my_after_title', 'high' );

    /*
    $fm1 = new Fieldmanager_TextField( array(
      'name'        => 'display_title',
      'label'       => __( 'Display Title', 'fbsafety' ),
      'description' => __( 'This will be used in place of main title when not empty.', 'fbsafety' ),
    ) );
    $fm1->add_meta_box( __( 'Display Title', 'fbsafety' ), array('module'), 'my_after_title', 'high' );
    */

    $fm2 = new Fieldmanager_Group( array(
      'name'        => 'user_downloads',
      'label'       => __( 'User Downloads', 'fbsafety' ),
      'description' => __( 'These are the main file downloads that will appear at the top of the left sidebar on all pages associated with this specific module.', 'fbsafety' ),
      'children' => array(
        'module_download' => new Fieldmanager_Media( array(
          'label'       => __( 'Module for Download', 'fbsafety' ),
          'description' => __( 'Upload or specify the file to be used as the "Download Module" sidebar link for this module.', 'fbsafety' ),
        ) ),
        'guide_download' => new Fieldmanager_Media( array(
          'label'       => __( 'Facilitator Guide for Download', 'fbsafety' ),
          'description' => __( 'Upload or specify the file to be used as the "Download Facilitator Guide" sidebar link for this module.', 'fbsafety' ),
        ) ),
        ), 
      ) );
    $fm2->add_meta_box( __( 'User Downloads', 'fbsafety' ), array('module'), 'my_after_title', 'high' );

    return;

  }

  /**
   * Sets up the MAINFIELDS FieldManager fields for custom post type MODULE
   *
   * @return $fmg, a main field manager group consisting of fieldmanager subgroups
   */
  public function module__fields_main_top() {

    $name     = 'Main Fields (Top)';
    $lower    = 'mainfields';
    $singular = 'mainfields';

    $fmg = new Fieldmanager_Group(
      [
        'name'           => $lower,
        'label'          => __( $name, 'fbsafety' ),
        'limit'          => 0,
        'sortable'       => 1,
        'collapsible'    => 1,
        'collapsed'      => 1,
        'add_more_label' => __( 'Add another section', 'fbsafety' ),
        'group_is_empty' => function ( $values ) {
          return empty( $values['which_subgroup'] );
        },
      ]
    );

    $the_select = new Fieldmanager_Select(
      __( 'Select Type', 'fbsafety' ), [
        'name' => 'which_subgroup',
      ]
    );

    $fmg->add_child( $the_select );

    $allowed_types = array(
      'breadcrumbs',
      'hero_section',
    );

    $fullgroup = [];

    foreach ( $allowed_types as $type ) {
      switch ( $type ) {

        case 'breadcrumbs':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'breadcrumbs',
        'label'    => __( 'Breadcrumbs', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          ), 
        ) );
        break;

        case 'hero_section':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'hero_section',
          'label'    => __( 'Hero', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
            'image' => new Fieldmanager_Media( array(
              'label'       => __( 'Hero Image (Desktop)', 'fbsafety' ),
              'description' => __( 'Specify the hero image to be used.', 'fbsafety' ),
            ) ),
            'image_mob' => new Fieldmanager_Media( array(
              'label'       => __( 'Hero Image (Mobile)', 'fbsafety' ),
              'description' => __( 'Note: Image above (desktop) will be used for all devices if this is left empty.', 'fbsafety' ),
            ) ),
            'lighter_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Is this a lighter image?', 'fbsafety' ),
              'description' => __( 'Check this box if this is a lighter image. This will turn the navigation on top of the image darker.', 'fbsafety' ),
            ) ),
            'text_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display text content in the hero?', 'fbsafety' ),
              'description' => __( 'Check this box to display content in the hero.', 'fbsafety' ),
            ) ),
            'title' =>  new Fieldmanager_TextField( array(
              'label'       => __( 'Hero Title', 'fbsafety' ),
              'display_if'  => array( 'src' => 'text_toggle', 'value' => '1' ),
              'description' => __( '', 'fbsafety' ),
            ) ),
            'subtitle' =>  new Fieldmanager_TextArea( array(
              'label'       => __( 'Hero Subtitle', 'fbsafety' ),
              'display_if'  => array( 'src' => 'text_toggle', 'value' => '1' ),
              'description' => __( '', 'fbsafety' ),
            ) ),
            'text_color' => new Fieldmanager_Select( array(
                'label'       => __( 'Hero Text Color', 'fbsafety' ),
                'display_if'  => array( 'src' => 'text_toggle', 'value' => '1' ),
                'first_empty' => true,
                'options'     => $this->colors_advanced_arr()
            ) ),
          ), 
        ) );
        break;

      }
    }

    foreach ( $fullgroup as $flexfield ) {
      $the_select->add_options(
        [
          $flexfield->name => $flexfield->label,
        ]
      );
      $flexfield->display_if = [
        'src'   => 'which_subgroup',
        'value' => $flexfield->name,
      ];
      $fmg->add_child( $flexfield );
    }

    $fmg->add_meta_box( __( $name, 'fbsafety' ), array('module'), 'normal', 'high' );

    return $fmg;

  }

  /**
   * Sets up the LESSONS FieldManager fields for custom post type MODULE
   *
   * @return $fmg, a main field manager group consisting of fieldmanager subgroups
   */
  public function module__fields_lessons() {

    $name     = 'Lessons';
    $lower    = 'lessons';
    $singular = 'lesson';

    $post_id = isset( $_GET['post'] ) ? intval( sanitize_text_field( $_GET['post'] ) ) : '';

    $fmg = new Fieldmanager_Group(
      [
        'name'           => $lower,
        'label'          => __( $name, 'fbsafety' ),
        'limit'          => 0,
        'sortable'       => 1,
        'collapsible'    => 1,
        'collapsed'      => 1,
        'add_more_label' => __( 'Add another section', 'fbsafety' ),
        'group_is_empty' => function ( $values ) {
          return empty( $values['which_subgroup'] );
        },
      ]
    );

    $the_select = new Fieldmanager_Select(
      __( 'Select Type', 'fbsafety' ), [
        'name' => 'which_subgroup',
      ]
    );

    $fmg->add_child( $the_select );

    $allowed_types = array(
      'overview',
      'lesson',
      'resources'
    );

    $fullgroup = [];
    $rand__num = '';

    foreach ( $allowed_types as $type ) {
      switch ( $type ) {

        case 'overview':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'overview',
          'label'    => __( 'Overview of this Module', 'fbsafety' ),
          'children' => array(
            'heading' => new Fieldmanager_TextField( array(
              'label'            => __( 'Title', 'fbsafety' ), 
              'validation_rules' => array(
                'required' => true,
              ),
            ) ),
            'body' => new Fieldmanager_RichTextArea( array(
              'label'       => __( 'Body Content', 'fbsafety' ),
              'description' => __( 'Main body content for the Overview.', 'fbsafety' ),
            ) ),
            'uqid' => new Fieldmanager_Hidden( array(
            ) ),
          ),
        ) );
        break;

        case 'lesson':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'lesson',
          'label'    => __( 'Lesson', 'fbsafety' ),
          'children' => array(
            'lesson_id' => new Fieldmanager_Select( array(
                'label'       => __( 'Which Lesson', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_all_cpt_lessons($post_id),
                'description' => __( 'Select which lesson should be displayed here.', 'fbsafety' ),
            ) ),
          ),
        ) ); 
        break;

        case 'resources':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'resources',
          'label'    => __( 'Resources for this Module', 'fbsafety' ),
          'children' => array(
            'lesson_id' => new Fieldmanager_Select( array(
                'label'       => __( 'Resources Page', 'fbsafety' ),
                'first_empty' => true,
                'options'     => $this->get_module_child_pages($post_id),
                'description' => __( 'Select which resource page is associated with this module.', 'fbsafety' ),
            ) ),
          ),
        ) );
        break;

      }
    }

    foreach ( $fullgroup as $flexfield ) {
      $the_select->add_options(
        [
          $flexfield->name => $flexfield->label,
        ]
      );
      $flexfield->display_if = [
        'src'   => 'which_subgroup',
        'value' => $flexfield->name,
      ];
      $fmg->add_child( $flexfield );
    }

    $fmg->add_meta_box( __( $name, 'fbsafety' ), array('module'), 'normal', 'high' );

    return $fmg;

  }

/**
   * Sets up the BOTTOMFIELDS FieldManager fields for custom post type MODULE
   *
   * @return $fmg, a main field manager group consisting of fieldmanager subgroups
   */
  public function module__fields_main_bot() {

    $name     = 'Bottom Fields';
    $lower    = 'bottomfields';
    $singular = 'bottomfields';

    $fmg = new Fieldmanager_Group(
      [
        'name'           => $lower,
        'label'          => __( $name, 'fbsafety' ),
        'limit'          => 0,
        'sortable'       => 1,
        'collapsible'    => 1,
        'collapsed'      => 1,
        'add_more_label' => __( 'Add another section', 'fbsafety' ),
        'group_is_empty' => function ( $values ) {
          return empty( $values['which_subgroup'] );
        },
      ]
    );

    $the_select = new Fieldmanager_Select(
      __( 'Select Type', 'fbsafety' ), [
        'name' => 'which_subgroup',
      ]
    );

    $fmg->add_child( $the_select );

    $allowed_types = array(
      'featured_lessons',
      'site_search_v2',
    );

    $fullgroup = [];

    foreach ( $allowed_types as $type ) {
      switch ( $type ) {

        case 'featured_lessons':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'featured_lessons',
        'label'    => __( 'Featured Lessons (Slider)', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this section.', 'fbsafety' ),
          ) ),
          'custom_toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Make custom selections to feature for this page only?', 'fbsafety' ),
            'description' => __( 'This is optional. If this is left unchecked, Featured Lessons defined in Theme Settings will be used by default.', 'fbsafety' ),
          ) ),
          'the_lessons' => new Fieldmanager_Checkboxes( array(
              'label'       => __( 'Select Custom Lessons to Feature', 'fbsafety' ),
              'description' => __( 'An unlimited number of lessons can be selected here.', 'fbsafety' ),
              'display_if'  => array( 'src' => 'custom_toggle', 'value' => '1' ),
              'options'     => $this->get_all_lessons()
          ) ),
          ), 
        ) );
        break;

        case 'site_search_v2':
        $fullgroup[] = new Fieldmanager_Group( array(
        'name'     => 'site_search_v2',
        'label'    => __( 'Site Search (v2)', 'fbsafety' ),
        'children' => array(
          'toggle' => new Fieldmanager_Checkbox( array(
            'label'       => __( 'Display this section?', 'fbsafety' ),
            'description' => __( 'Check this box to display this search section.', 'fbsafety' ),
          ) ),
          ), 
        ) );
        break;

      }
    }

    foreach ( $fullgroup as $flexfield ) {
      $the_select->add_options(
        [
          $flexfield->name => $flexfield->label,
        ]
      );
      $flexfield->display_if = [
        'src'   => 'which_subgroup',
        'value' => $flexfield->name,
      ];
      $fmg->add_child( $flexfield );
    }

    $fmg->add_meta_box( __( $name, 'fbsafety' ), array('module'), 'normal', 'high' );

    return $fmg;

  }

  /**
   * Sets up individual FieldManager fields for custom post type LESSON
   *
   * @return $fmg, a main field manager group consisting of fieldmanager subgroups
   */
  public function lesson__fields_individual() {

    $fm0 = new Fieldmanager_Select( array(
      'name'             => 'module_id',
      'label'            => __( 'Associated Module', 'fbsafety' ),
      'first_empty'      => true,
      'options'          => $this->get_all_cpt_modules(),
      'description'      => __( 'Which module is this lesson associated with? Selecting this is required. This will determine the top and bottom display sections of this lesson. This will also associate this lesson content with the overall content of the module selected.', 'fbsafety' ),
      'validation_rules' => array(
        'required' => true,
      ),
    ) );

    $fm0->add_meta_box( __( 'Associated Module', 'fbsafety' ), array('lesson'), 'my_after_title', 'high' );

    /*
    $fm1 = new Fieldmanager_TextField( array(
      'name'        => 'display_title',
      'label'       => __( 'Display Title', 'fbsafety' ),
      'description' => __( 'This will be used in place of main title when not empty.', 'fbsafety' ),
    ) );
    $fm1->add_meta_box( __( 'Display Title', 'fbsafety' ), array('lesson'), 'my_after_title', 'high' );
    */

    $fm2 = new Fieldmanager_Group( array(
      'name'           => 'available_resources',
      'limit'          => 50,
      'add_more_label' => __( 'Add a Resource', 'fbsafety' ),
      'sortable'       => true,
      'extra_elements' => 0,
      'group_is_empty' => function ( $values ) {
          return empty( $values['a_file'] );
      },
      'children'       => array(
        'a_file' => new Fieldmanager_Group( array(
          'extra_elements' => 0,
          'group_is_empty' => function ( $values ) {
            return empty( $values['file'] );
          },
          'label'    => __( 'A Resource', 'fbsafety' ),
          'children' => array(
            'file' => new Fieldmanager_Media( array(
              'label'       => __( 'File', 'fbsafety' ),
              'description' => __( 'Upload or a choose the file.', 'fbsafety' ),
            ) ),
            'file_name' => new Fieldmanager_TextField( array(
              'label'       => __( 'File Name', 'fbsafety' ),
              'description' => __( 'Display name for the file.', 'fbsafety' ),
            ) ),
            'file_desc' => new Fieldmanager_TextArea( array(
              'label'       => __( 'File Description', 'fbsafety' ),
              'description' => __( 'Short description of the file.', 'fbsafety' ),
            ) ),
            'resource_type' => new Fieldmanager_Select( array(
                'label'   => 'Resource Type',
                'options' => $this->resource_types()
            ) ),
          ),
        ) ),
      ),
    ) );

    $fm2->add_meta_box( __( 'Available Resources', 'fbsafety' ), array('lesson'), 'my_after_title', 'high' );

    $fm3 = new Fieldmanager_Media( array(
      'name'        => 'all_resources',
      'label'       => __( 'All Resources (Combined in one PDF)', 'fbsafety' ),
      'description' => __( 'Upload or a choose the PDF file. This file will be used for "Print All" links.', 'fbsafety' ),
    ) );

    $fm3->add_meta_box( __( 'All Resources', 'fbsafety' ), array('lesson'), 'my_after_title', 'high' );

    $fm4 = new Fieldmanager_Group( array(
      'name'           => 'available_guidelines',
      'limit'          => 50,
      'add_more_label' => __( 'Add a Guideline', 'fbsafety' ),
      'sortable'       => true,
      'extra_elements' => 0,
      'group_is_empty' => function ( $values ) {
          return empty( $values['a_file'] );
      },
      'children'       => array(
        'a_file' => new Fieldmanager_Group( array(
          'extra_elements' => 0,
          'group_is_empty' => function ( $values ) {
            return empty( $values['file'] );
          },
          'label'    => __( 'A Guideline', 'fbsafety' ),
          'children' => array(
            'file' => new Fieldmanager_Media( array(
              'label'       => __( 'File', 'fbsafety' ),
              'description' => __( 'Upload or a choose the file.', 'fbsafety' ),
            ) ),
            'file_name' => new Fieldmanager_TextField( array(
              'label'       => __( 'File Name', 'fbsafety' ),
              'description' => __( 'Display name for the file.', 'fbsafety' ),
            ) ),
            'file_desc' => new Fieldmanager_TextArea( array(
              'label'       => __( 'File Description', 'fbsafety' ),
              'description' => __( 'Short description of the file.', 'fbsafety' ),
            ) ),
            'resource_type' => new Fieldmanager_Select( array(
                'label'   => 'Resource Type',
                'options' => $this->resource_types()
            ) ),
          ),
        ) ),
      ),
    ) );

    $fm4->add_meta_box( __( 'Available Guidelines', 'fbsafety' ), array('lesson'), 'my_after_title', 'high' );

    $fm5 = new Fieldmanager_Media( array(
      'name'        => 'all_guidelines',
      'label'       => __( 'All Guidelines (Combined in one PDF)', 'fbsafety' ),
      'description' => __( 'Upload or a choose the PDF file. This file will be used for "Print All" links.', 'fbsafety' ),
    ) );

    $fm5->add_meta_box( __( 'All Guidelines', 'fbsafety' ), array('lesson'), 'my_after_title', 'high' );

    return;

  }

  /**
   * Sets up the VIDEOFIELDS FieldManager fields for custom post type VIDEO
   *
   * @return $fmg, a main field manager group consisting of fieldmanager subgroups
   */
  public function video__fields() {

    $name     = 'Video Fields';
    $lower    = 'videofields';
    $singular = 'videofields';

    $fmg = new Fieldmanager_Group(
      [
        'name'           => $lower,
        'label'          => __( $name, 'fbsafety' ),
        'limit'          => 0,
        'sortable'       => 1,
        'collapsible'    => 1,
        'collapsed'      => 1,
        'add_more_label' => __( 'Add another section', 'fbsafety' ),
        'group_is_empty' => function ( $values ) {
          return empty( $values['which_subgroup'] );
        },
      ]
    );

    $the_select = new Fieldmanager_Select(
      __( 'Select Type', 'fbsafety' ), [
        'name' => 'which_subgroup',
      ]
    );

    $fmg->add_child( $the_select );

    $allowed_types = array(
      'breadcrumbs',
      'hero_section',
      'hero_section_basic',
      'video',
    );

    $fullgroup = [];

    foreach ( $allowed_types as $type ) {
      switch ( $type ) {

        case 'breadcrumbs':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'breadcrumbs',
          'label'    => __( 'Breadcrumbs', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
          ), 
        ) );
        break;

        case 'hero_section':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'hero_section',
          'label'    => __( 'Hero', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
            'image' => new Fieldmanager_Media( array(
              'label'       => __( 'Hero Image (Desktop)', 'fbsafety' ),
              'description' => __( 'Specify the hero image to be used.', 'fbsafety' ),
            ) ),
            'image_mob' => new Fieldmanager_Media( array(
              'label'       => __( 'Hero Image (Mobile)', 'fbsafety' ),
              'description' => __( 'Note: Image above (desktop) will be used for all devices if this is left empty.', 'fbsafety' ),
            ) ),
            'lighter_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Is this a lighter image?', 'fbsafety' ),
              'description' => __( 'Check this box if this is a lighter image. This will turn the navigation on top of the image darker.', 'fbsafety' ),
            ) ),
            'text_toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display text content in the hero?', 'fbsafety' ),
              'description' => __( 'Check this box to display content in the hero.', 'fbsafety' ),
            ) ),
            'title' =>  new Fieldmanager_TextField( array(
              'label'       => __( 'Hero Title', 'fbsafety' ),
              'display_if'  => array( 'src' => 'text_toggle', 'value' => '1' ),
              'description' => __( '', 'fbsafety' ),
            ) ),
            'subtitle' =>  new Fieldmanager_TextArea( array(
              'label'       => __( 'Hero Subtitle', 'fbsafety' ),
              'display_if'  => array( 'src' => 'text_toggle', 'value' => '1' ),
              'description' => __( '', 'fbsafety' ),
            ) ),
            'text_color' => new Fieldmanager_Select( array(
                'label'       => __( 'Hero Text Color', 'fbsafety' ),
                'display_if'  => array( 'src' => 'text_toggle', 'value' => '1' ),
                'first_empty' => true,
                'options'     => $this->colors_advanced_arr()
            ) ),
          ), 
        ) );
        break;

        case 'hero_section_basic':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'hero_section_basic',
          'label'    => __( 'Hero Basic (No Image)', 'fbsafety' ),
          'description'    => __( 'This is a basic Hero Section without an image (only a block of color).', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
            'title' =>  new Fieldmanager_TextField( array(
              'label'       => __( 'Hero Title', 'fbsafety' ),
              'description' => __( 'The main hero title (H1).', 'fbsafety' ),
            ) ),
            'bg_color' => new Fieldmanager_Select( array(
                'label'       => __( 'Hero Background Color', 'fbsafety' ),
                'description' => __( 'Note: This is required.', 'fbsafety' ),
                'first_empty' => true,
                'validation_rules' => array(
                  'required' => true,
                ),
                'options'     => $this->bgcolors_arr()
            ) ),
          ), 
        ) );
        break;

        case 'video':
        $fullgroup[] = new Fieldmanager_Group( array(
          'name'     => 'video',
          'label'    => __( 'Video', 'fbsafety' ),
          'children' => array(
            'toggle' => new Fieldmanager_Checkbox( array(
              'label'       => __( 'Display this section?', 'fbsafety' ),
              'description' => __( 'Check this box to display this section.', 'fbsafety' ),
            ) ),
            'video_url' =>  new Fieldmanager_TextArea( array(
              'label'       => __( 'Video URL', 'fbsafety' ),
              'description' => __( 'The full video URL.', 'fbsafety' ),
            ) ),
          ), 
        ) );
        break;

      }
    }

    foreach ( $fullgroup as $flexfield ) {
      $the_select->add_options(
        [
          $flexfield->name => $flexfield->label,
        ]
      );
      $flexfield->display_if = [
        'src'   => 'which_subgroup',
        'value' => $flexfield->name,
      ];
      $fmg->add_child( $flexfield );
    }

    $fmg->add_meta_box( __( $name, 'fbsafety' ), array('video'), 'normal', 'high' );

    return $fmg;

  }

}

//only initiate in backend
if ( is_admin() ) {
  $fm__cbuild = new FieldManagerCustomBuild();
}
