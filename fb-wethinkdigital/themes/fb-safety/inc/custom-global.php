<?php
/**
 * Custom GLOBAL FUNCTIONS
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Fieldmanager: check and get field data
 * 
 * @param array $fields Any data array to check (usually fieldmanager fields)
 * @param string $key The key to check for in the array
 *
 * @return mixed
 */
function fbsafety_fm_get_data($fields=array(), $key='') {
  $data = ( isset( $fields[$key] ) ) ? $fields[$key] : '';
  return $data;
}


/**
 * Set allowed html tags for use with wp_kses()
 *
 * @return array
 */
function allowed_html_tags() {

  $allowed = array();

  $atts = array(
    'action'        => array(),
    'align'         => array(),
    'alt'           => array(),
    'class'         => array(),
    'data'          => array(),
    'data-desktop'  => array(),
    'data-last'     => array(),
    'data-mobile'   => array(),
    'data-num'      => array(),
    'data-part'     => array(),
    'data-query'    => array(),
    'data-total'    => array(),
    'data-which'    => array(),
    'download'      => array(),
    'dir'           => array(),
    'for'           => array(),
    'height'        => array(),
    'id'            => array(),
    'href'          => array(),
    'lang'          => array(),
    'method'        => array(),
    'name'          => array(),
    'novalidate'    => array(),
    'rel'           => array(),
    'src'           => array(),
    'style'         => array(),
    'tabindex'      => array(),
    'target'        => array(),
    'title'         => array(),
    'type'          => array(),
    'value'         => array(),
    'width'         => array(),
    'xml:lang'      => array(),
  );
        
  $tags = array(
    'a', 
    'abbr', 
    'b', 
    'br', 
    'button', 
    'code',
    'div', 
    'em', 
    'form', 
    'h1', 
    'h2', 
    'h3', 
    'h4', 
    'h5', 
    'h6', 
    'hr', 
    'i', 
    'img', 
    'label',
    'li', 
    'ol', 
    'p', 
    'pre', 
    'small', 
    'span', 
    'strong',
    'style', 
    'table',
    'td', 
    'th', 
    'tr', 
    'ul', 
  );

  foreach ($tags as $tag) {
    $allowed[$tag] = $atts;
  }

  return $allowed;

}


/**
 * Default language array by country
 */
$DEFAULT_LANG = array(
	'us' => 'en',
	'ph' => 'tl',
);
defined( 'DEFAULT_LANG' ) or define( 'DEFAULT_LANG', $DEFAULT_LANG );


/**
 * Determine User IP
 *
 * @return string
 */
function fbsafety_get_user_ip() {
  $ipaddress = '';
  if( ! empty( getenv('HTTP_X_FORWARDED_FOR') ) ) {
    $iplist = getenv('HTTP_X_FORWARDED_FOR');
    if (strpos($iplist, ',') !== false) {
      $iplist = explode(',', $iplist);
      $ipaddress = $iplist[0];
    } else {
      $ipaddress = $iplist;
    }
  } else {
    if ( getenv('REMOTE_ADDR') ) {
      $ipaddress = getenv('REMOTE_ADDR');
    }
  }
  return sanitize_text_field( $ipaddress );
}


/**
 * Determine current language
 *
 * @return array
 */
function fbsafety_which_country_language() {
  $country  = 'us';
  $language = 'en';
  return array( sanitize_key($country), sanitize_key($language) );
}


/**
 * Check to see if the current page is the login/register page.
 *
 * @return bool
 */
function is_a_login_page() {
  return in_array( 
    sanitize_text_field($GLOBALS['pagenow']), 
    array( 'wp-login.php', 'wp-register.php' ), 
    true 
  );
}


/**
 * Return all published custom post type Module
 *
 * @param string $sort_by
 *
 * @return array
 */
function get_all_cpt_modules( $sort_by='id' ) {
  $modules_array = array();
  $modules_query = new WP_Query( 
    array( 
      'post_type'           => 'module', 
      'post_status'         => 'publish', 
      'post_parent'         => 0,
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
      'posts_per_page'      => 50
    ) 
  );
  if ( $modules_query->have_posts() ) {
    while ( $modules_query->have_posts() ) {
      $modules_query->the_post(); 
      $ID    = get_the_ID();
      $title = get_the_title();
      if ('module_id' === $sort_by) {
        $module_number = intval( get_post_meta( $ID, 'module_number', true ) );
        $modules_array[] = array( sanitize_key($module_number), sanitize_key($ID) );
        usort($modules_array, function($a, $b) {
          return $a['order'] <=> $b['order'];
        });
      } else {
        $modules_array[sanitize_key($ID)] = sanitize_text_field($title);
      }
    }
  }
  wp_reset_postdata();

  // sort array 
  if ('module_id' === $sort_by) {
    usort($modules_array, function($a, $b) {
      return $a[0] <=> $b[0];
    });
  } else {
    ksort($modules_array);
  }

  return $modules_array;
}

/**
 * Returns post_id of the next module
 *
 * @param integer $key current module_number
 *
 * @return integer
 */
function fbsafety_get_next_module($key='') {
  if ( ! empty($key) ) {
    $array = get_all_cpt_modules( 'module_id' ); 
    if ( ! empty($array) ) {   
      $i = 0;
      foreach ($array as $a) {
        $next = $i + 1;
        if ( intval($key) === intval($a[0]) ) {
          if ( isset($array[$next]) ) {
            if ( isset($array[$next][1]) ) {
              return $array[$next][1];
            }
          } else {
            if ( isset($array[0][1]) ) {
              return $array[0][1];
            }
          }
        }
        $i++;
      }
    }
  }
}


/**
 * Trim a string to desired maximum word count
 *
 * @return string
 */
function fbsafety_word_chop($text='', $word_count=33) {
  if (str_word_count($text, 0) > $word_count) {
    $words = str_word_count($text, 2);
    $pos   = array_keys($words);
    $text  = substr($text, 0, $pos[$word_count]) . '...';
  }
  return $text;
}

if ( ! class_exists( 'Add_button_of_Sublevel_Walker' ) ) {
	class Add_button_of_Sublevel_Walker extends Walker_Nav_Menu {
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth);
			$output .= "\n$indent<ul class='sub-menu'>\n<button class='mega-button'></button>";
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "$indent</ul>\n";
		}
	}
}

