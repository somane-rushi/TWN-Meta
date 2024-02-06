<?php

$SITE = get_current_site()->domain;

define('WP_DEBUG', true);
if (strpos($SITE, 'counterspeech.dev') !== false || strpos($SITE, 'counterspeech.test') !== false  ) {
  // disable password protection on local.
} else if (strpos($SITE, 'counterspeech.fb.com') !== false) {
  //  disable password on live.
} else {
    //
    // everywhere else add a password to the site.
    //

    /* Comment out the Password authentication on Dev and Preprod

    if (!isset($_SERVER['PHP_AUTH_PW'])) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    } else {
        if (
     ($_SERVER['PHP_AUTH_PW'] == 'Counterh8')
     ) {
            // continue
        } else {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            exit;
        }
    }

    */
    define('VIP_MAINTENANCE_MODE', false);
}

define('CS_DIR', __DIR__);

// this doesn't work if enabled, but passes the scan commented out.
// uncommenting this breaks the entire site, unable to include the vip/plugins
// via svn and still use mu-plugins
// require_once WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php';


function counterspace_allowed_html() {

  $allowed_tags = array(
    'a' => array(
      'class' => array(),
      'href'  => array(),
      'rel'   => array(),
      'title' => array(),
    ),
    'abbr' => array(
      'title' => array(),
    ),
     'label' => array(
      'for' => array(),
    ),
    
    'input' => array(
      'name' => array(),
       'id' => array(),
        'type' => array(),
         'size' => array(),
         'value' => array(),
    ),

       'form' => array(
      'action' => array(),
       'class' => array(),
        'method' => array(),
   
    ),
    'b' => array(),
    'blockquote' => array(
      'cite'  => array(),
    ),
    'cite' => array(
      'title' => array(),
    ),
    'code' => array(),
    'del' => array(
      'datetime' => array(),
      'title' => array(),
    ),
    'dd' => array(),
    'div' => array(
      'class' => array(),
      'title' => array(),
      'style' => array(),
    ),
    'dl' => array(),
    'dt' => array(),
    'em' => array(),
    'h1' => array(),
    'h2' => array(),
    'h3' => array(),
    'h4' => array(),
    'h5' => array(),
    'h6' => array(),
    'i' => array(),
   
    'li' => array(
      'class' => array(),
    ),
    'ol' => array(
      'class' => array(),
    ),
    'p' => array(
      'class' => array(),
    ),
      'br' => array(
      'class' => array(),
    ),
 
    'span' => array(
      'class' => array(),
      'title' => array(),
      'style' => array(),
    ),
  
    'strong' => array(),
    'ul' => array(
      'class' => array(),
    ),
  );
  
  return $allowed_tags;
}


// ------- register base theme style -------

function cntrspch_register_styles()
{
    // include the base style in the header:
  $baseCSSStyle = get_stylesheet_directory_uri().(WP_DEBUG ? "/frontend/public/css/base.css" : "/frontend/dist/css/base.min.css");

    wp_register_style(
          'base-style', // handle name
          $baseCSSStyle,
          null, // an array of dependent styles
          '2.7', // version number
          'screen' // CSS media type
          );
    wp_enqueue_style('base-style');
  
  
}
  // Register style sheet.
add_action('wp_enqueue_scripts', 'cntrspch_register_styles');

// ------- end register base theme style -------

// ------- Unused Wordpress Functionality and <head> injections -------

    // Remove Comment Functionality
add_action('admin_menu', 'cntrspch_remove_admin_comments');
function cntrspch_remove_admin_comments()
{
    remove_menu_page('edit-comments.php');
}
add_action('init', 'cntrspch_remove_comment_support', 100);
function cntrspch_remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
add_action('wp_before_admin_bar_render', 'cntrspch_remove_admin_bar_comments');
function cntrspch_remove_admin_bar_comments()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
    // Remove Emoji Default Support Code
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
    // Remove WP Embed JS
function cntrspch_my_deregister_scripts()
{
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'cntrspch_my_deregister_scripts');
    // Remove EditURI
remove_action('wp_head', 'rsd_link');
    // Remove wlwmanifest link
remove_action('wp_head', 'wlwmanifest_link');

// ------- End Unused Wordpress Functionality and <head> injections -------

// ------- Regist custom post types and taxonomies-------

require CS_DIR . '/custom-taxonomies/registerTaxonomies.php';
require CS_DIR . '/custom-posts/registerPosts.php';

// ------- end custom post types -------

// ------- Register custom fields
if (is_admin()) {
    if (class_exists('Fieldmanager_Context')) {
        require CS_DIR . '/custom-fields/custom_field_manager.php';
    }
}
// ------- end register custom fields
// ------- Register custom endpoints
require CS_DIR . '/endpoints/map.php';
// -------
// ------- Adding a global options page for translateable labels -------

add_action('admin_menu', 'cntrspch_add_global_custom_options');

function cntrspch_add_global_custom_options()
{
    add_options_page('Sitewide Labels', 'Sitewide Labels', 'manage_options', 'functions', 'cntrspch_global_custom_options');
}

function cntrspch_global_custom_options()
{
  if ( current_user_can( 'manage_options' ) ) {
    ?>
  <div class="wrap">
    <h2>Sitewide Labels</h2>
    <p>Below you can tranlate the labels for elements like cta's and filters</p>
    <form method="post" action="options.php">
      <?php wp_nonce_field('update-options') ?>
      <p><strong>"Counterspeech" label in the header logo</strong><br /><input type="text" name="cntrspch_label_counterspeech" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_counterspeech')); ?>" /></p>
      <p><strong>"Locations" label in the header </strong><br /><input type="text" name="cntrspch_label_locations" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_locations')); ?>" /></p>
      <p><strong>"Initiatives" label in the header / footer</strong><br /><input type="text" name="cntrspch_label_initiatives" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_initiatives')); ?>" /></p>
      <p><strong>"Privacy" label in the header / footer</strong><br /><input type="text" name="cntrspch_label_privacy" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_privacy')); ?>" /></p>
      <p><strong>"Privacy" url in the header / footer</strong><br /><input type="text" name="cntrspch_link_privacy" size="45" value="<?php echo esc_attr(get_option('cntrspch_link_privacy')); ?>" /></p>
      <p><strong>"Terms" label in the header / footer</strong><br /><input type="text" name="cntrspch_label_terms" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_terms')); ?>" /></p>
      <p><strong>"Terms" url in the header / footer</strong><br /><input type="text" name="cntrspch_link_terms" size="45" value="<?php echo esc_attr(get_option('cntrspch_link_terms')); ?>" /></p>
      <p><strong>"Cookies" label in the header / footer</strong><br /><input type="text" name="cntrspch_label_cookies" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_cookies')); ?>" /></p>
      <p><strong>"Cookies" url in the header / footer</strong><br /><input type="text" name="cntrspch_link_cookies" size="45" value="<?php echo esc_attr(get_option('cntrspch_link_cookies')); ?>" /></p>
      <p><strong>"Help" label in the header / footer</strong><br /><input type="text" name="cntrspch_label_help" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_help')); ?>" /></p>
      <p><strong>"Help" url in the header / footer</strong><br /><input type="text" name="cntrspch_link_help" size="45" value="<?php echo esc_attr(get_option('cntrspch_link_help')); ?>" /></p>


   <p><strong>Website Button</strong><br /><input type="text" name="cntrspch_label_website_button" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_website_button')); ?>" /></p>

   <p><strong>Website Button Width</strong><br /><input type="text" name="cntrspch_label_website_button_width" size="45" value="<?php echo esc_attr(get_option('cntrspch_label_website_button_width')); ?>" /></p>


      <p><strong>Download Button</strong><br /><input type="text" name="cntrspch_link_download_button" size="45" value="<?php echo esc_attr(get_option('cntrspch_link_download_button')); ?>" /></p>


      <p><strong>Download Button Width</strong><br /><input type="text" name="cntrspch_link_download_button_width" size="45" value="<?php echo esc_attr(get_option('cntrspch_link_download_button_width')); ?>" /></p>

         <p><strong>Learn More Button</strong><br /><input type="text" name="cntrspch_learn_more_button" size="45" value="<?php echo esc_attr(get_option('cntrspch_learn_more_button')); ?>" /></p>

         <p><strong>Counterspeech PNG (only PNG)</strong><br /><input type="text" name="cntrspch_png" size="45" value="<?php echo esc_attr(get_option('cntrspch_png')); ?>" /></p>


     <p><input type="submit" class="button action" value="Submit Translations"></p>
      <input type="hidden" name="action" value="update" />
      <input type="hidden" name="page_options" value="cntrspch_label_locations,cntrspch_label_initiatives,cntrspch_label_privacy,cntrspch_link_privacy,cntrspch_label_terms,cntrspch_link_terms,cntrspch_label_cookies,cntrspch_link_cookies,cntrspch_label_help,cntrspch_link_help,cntrspch_label_counterspeech,cntrspch_label_website_button,cntrspch_label_website_button_width,cntrspch_link_download_button,cntrspch_link_download_button_width,cntrspch_learn_more_button,cntrspch_png" />
   </form>

  </div>
  <?php
  }
}

// ------- end global options page -------
// ------- Clear caches as needed -------
function clear_cntrspch_country_cache($post_id, $post, $update)
{
    /*
     * In production code, $slug should be set only once in the plugin,
     * preferably as a class property, rather than in each function that needs it.
     */
    $post_type = get_post_type($post_id);
    // clear the cache for the map json data points.
    if ('cntrspch_country' === $post_type) {
        wp_cache_delete('cntrspch_country_json');
        wp_cache_delete('menu_regions_and_countries');
    }
}
  add_action('save_post', 'clear_cntrspch_country_cache', 10, 3);

  function clear_cntrspch_region_cache($term_id, $taxonomy)
  {
    // clear the cache for the map json data points.
    if ('cntrspch_region' === $taxonomy) {
        wp_cache_delete('menu_regions_and_countries');
    }
  }

  add_action('edited_cntrspch_region', 'clear_cntrspch_region_cache', 10, 2);
  function regionsAndCountries()
  {
      $regionsAndCountries = wp_cache_get('menu_regions_and_countries');

      if (false === $regionsAndCountries) {
          $regionsAndCountries = array();
          $regionTerms = get_terms(array(
        'taxonomy' => 'cntrspch_region',
        'meta_key' => 'order',
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'hide_empty' => false,
        ));

          foreach ($regionTerms as $regionTerm) {
              $singleRegionAndCountries = [];
              $singleRegionAndCountries['region'] = $regionTerm->name;
              $singleRegionAndCountries['countries'] = array();
              $regionCountries = get_posts(array(
          'post_type' => 'cntrspch_country',
          'meta_key'   => 'country_region',
          'posts_per_page' => 50,
          'suppress_filters' => false,
          'meta_value' => $regionTerm->slug,
          'orderby' => 'title',
          'order' => 'ASC'
          ));
              foreach ($regionCountries as $country) {
                  $singleRegionAndCountries['countries'][] = $country;
              }
              $regionsAndCountries[] = $singleRegionAndCountries;
          }

          wp_cache_set('menu_regions_and_countries', $regionsAndCountries);
      }
      return $regionsAndCountries;
  }

  function human_filesize($bytes, $decimals = 2)
  {
      $sz = 'BKMGTP';
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $sz[$factor];
  }
//------- CLEAN UP WP-ADMIN MENU -------
function cntrspch_edit_admin_menus() {
    remove_menu_page('edit.php'); // Remove the Tools Menu
}
add_action( 'admin_menu', 'cntrspch_edit_admin_menus' );

function cntrspch_custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
        'index.php', // Dashboard
        'edit.php?post_type=page',
        'edit.php?post_type=cntrspch_campaign',
        'edit.php?post_type=cntrspch_gi',
        'edit.php?post_type=cntrspch_country',
        'edit.php?post_type=cntrspch_resource',
        'edit.php?post_type=cntrspch_partner',
        'admin.php?page=cntrspch-cei-export',
        'upload.php',
        'themes.php',
    );
}
add_filter('cntrspch_custom_menu_order', 'cntrspch_custom_menu_order');
add_filter('menu_order', 'cntrspch_custom_menu_order');

//------- END CLEAN UP WP-ADMIN MENU -------


