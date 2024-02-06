<?php
/**
 * File Repository functions and definitions
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */


/**
 * Increase Upload Size on WPVIP
 *
 * @param $GB_IN_BYTES string
 *
 * @return string
 */
add_filter( 'upload_size_limit', function( $limit ) {
   // See http://vip-support.automattic.com/tickets/115904
    return GB_IN_BYTES * 2;
} );


/**
 * Check for empty dates
 *
 * @param $last_modified_date string
 *
 * @return string
 */
function Fb_Is_Last_Modified_date($last_modified_date)
{

    if (!$last_modified_date) {

        $last_modified_date= "UNKNOWN";
    }

    RETURN $last_modified_date;

}


/**
 * Get Incoming User's IP
 *
 * @return string
 */
function get_client_ip() {
    $ipaddress = '';
    if(! empty(getenv('HTTP_X_FORWARDED_FOR'))) {
      $iplist = getenv('HTTP_X_FORWARDED_FOR');
      if (strpos($iplist, ',') !== false) {
        $iplist = explode(',', $iplist);
        $ipaddress = $iplist[0];
      } else {
        $ipaddress = $iplist;
      }
    } elseif( getenv('REMOTE_ADDR') ) {
      $ipaddress = getenv('REMOTE_ADDR');
    } else{
      $ipaddress = '';
    }
    // Hotfix see: https://wordpressvip.zendesk.com/tickets/115966
    return sanitize_text_field( $ipaddress );
}

/**
 * Allow User or not
 *
 * @return void
 */
function vpn_ip_check() {

  $vpn_result = false;

  if ( is_user_logged_in() || is_page('login-page') ) {

    $vpn_result = true;

  } else {

    $ip_whitelist_ipv4 = array( 
      '199.201.64.0', 
      '199.201.67.0', 
      '199.201.65.0',
      '199.201.66.0',
      '163.114.128.0',
      '163.114.129.0',
      '163.114.131.0',
      '163.114.130.0',
      '163.114.132.0',
      '163.114.133.0',
      '163.114.134.0',
      '163.114.130.7',
      '96.88.224.49' 
    );

    $ip_whitelist_ipv6 = array( 
      '2620:10d:c091:480:',
      '2620:10d:c090:400:',
      '2620:10d:c093:400:',
      '2620:10d:c09a:180:',
      '2620:10d:c094:400:',
      '2620:10d:c091:480:',
      '2620:10d:c090:400:',
      '2620:10d:c091:480:'
    );

    $client_ip = get_client_ip() ?: '';

    if ( !empty($client_ip) ) :

      $is_ipv4 = true;
      $is_ipv6 = false;
      //check if it is ipv6
      if (strpos($client_ip, '::') !== false) {
        $is_ipv4 = false;
        $is_ipv6 = true;
      }

      if (true === $is_ipv4) {
        if( $client_ip && is_array($ip_whitelist_ipv4) ) {
          if( in_array($client_ip, $ip_whitelist_ipv4) ) {
            $vpn_result = true;
          }
        }
      }

      if (true === $is_ipv6) {
        if( $client_ip && is_array($ip_whitelist_ipv6) ) {
          foreach ($ip_whitelist_ipv6 as $ipv6) {
            if (strpos($client_ip, $ipv6) !== false) {
              $vpn_result = true;
              break;
            }
          }
        }
      }

    endif;

    if (false === $vpn_result) {
      if ( ! is_page('login-page') && !is_page('login') && !is_page('external-request-form') && !is_page('facebook-employee-form') ) {
        // Hotfix see: https://wordpressvip.zendesk.com/tickets/115966
        wp_safe_redirect(
          esc_url( home_url() . '/login-page/' )
        );
        exit();
      }
    }

  }

}
add_action('template_redirect', 'vpn_ip_check');


/**
 * Check for allowed tags
 *
 * @param $allowed_tags string
 *
 * @return string
 */


function apac_allowed_html() {

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
      'title' => array(),
      'style' => array(),
      'id' => array(),
      'data-filters' => array(),
      'data-query' => array(),
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





/**
 * Which icon to display
 *
 * @param $one_pager                 boolean 
 * @param $report                    boolean 
 * @param $case_study                boolean 
 * @param $presentation              boolean 
 * @param $presentation_template     boolean 
 * @param $logo                      boolean 
 * @param $brochure                  boolean 
 * @param $video                     boolean 
 * @param $case_study_video          boolean 
 * @param $case_study_micro          boolean 
 * @param $case_study_small_business boolean 
 * @param $case_study_women          boolean 
 * @param $narrative                 boolean 
 *
 * @return string
 */
function Fb_Asset_icon($one_pager,$report,$case_study,$presentation,$presentation_template,$logo,$brochure,$video,$case_study_video,$case_study_micro,$case_study_small_business,$case_study_women,$narrative)
{


    // This will determine what SVG Icon will display based off Asset Type


    if ($one_pager) {

        $asset_icon="";

    } elseif ($report) {

    } elseif ($case_study) {
            
    } elseif ($presentation) {
            
    } elseif ($presentation_template) {
            
    } elseif ($logo) {
            
    } elseif ($brochure) {
            
    } elseif ($video) {
            
    } elseif ($case_study_video) {
            
    } elseif ($case_study_micro) {
            
    } elseif ($case_study_small_business) {
            
    } elseif ($case_study_women) {
            
    } elseif ($narrative) {
            
    } else {
            
    }

    RETURN $asset_icon;

}

/**
 * Which background color to display
 *
 * @param $economic      boolean
 * @param $social_impact boolean
 * @param $digital       boolean
 *
 * @return string
 */
function Fb_Asset_background($economic,$social_impact,$digital)
{

    // This will determine what background color will display based off Asset Type


    if ($economic === "TRUE" ) {

        $asset_background_color="#009ED7";

    } elseif ($social_impact === "TRUE") {

        $asset_background_color="#007980";

    } elseif ($digital === "TRUE") {
        $asset_background_color="#3E2D86";
    } else {
        $asset_background_color="#677B8C";
    }

    RETURN $asset_background_color;

}

if (! defined('_S_VERSION') ) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.9.9');
}

if (! function_exists('Fb_File_Repository_setup') ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @return void
     */
    function Fb_File_Repository_setup()
    {
        /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on File Repository, use a find and replace
        * to change 'fb_file_repository' to the name of your theme in all the template files.
        */
        load_theme_textdomain('fb_file_repository', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
        add_theme_support('title-tag');

        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
            'menu-1' => esc_html__('Primary', 'fb_file_repository'),
            )
        );

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support(
            'html5',
            array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'fb_file_repository_custom_background_args',
                array(
                'default-color' => 'ffffff',
                'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'Fb_File_Repository_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @return mixed
 */
function Fb_File_Repository_Content_width()
{
    $GLOBALS['content_width'] = apply_filters('Fb_File_Repository_Content_width', 640);
}
add_action('after_setup_theme', 'Fb_File_Repository_Content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function Fb_File_Repository_Widgets_init()
{
    register_sidebar(
        array(
        'name'          => esc_html__('Sidebar', 'fb_file_repository'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'fb_file_repository'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'Fb_File_Repository_Widgets_init');

/**
 * Enqueue scripts and styles.
 *
 * @return void
 */
function Fb_File_Repository_scripts()
{
    
    wp_enqueue_style('fb_file_repository-all-css', get_template_directory_uri() . '/css/all.css');
    wp_enqueue_style('fb_file_repository-fontface-css', get_template_directory_uri() . '/webfonts/fontface/fonts.css');
    //wp_enqueue_style('fb_file_repository-slide-menu-css', get_template_directory_uri() . '/css/slide-menu.css');
    wp_enqueue_style('fb_file_repository-chosen-css', get_template_directory_uri() . '/css/chosen.css');
    wp_enqueue_style('fb_file_repository-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('fb_file_repository-style', 'rtl', 'replace');
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('fb_file_repository-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    //wp_enqueue_script('fb_file_repository-slide-menu', get_template_directory_uri() . '/js/slide-menu.js', array(), _S_VERSION, true);
    wp_enqueue_script('', '/wp-content/plugins/wordpress-fieldmanager-1.2.4/js/chosen/chosen.jquery.js', array(), _S_VERSION, true);
    wp_enqueue_script('fb_file_repository-custom', get_template_directory_uri() . '/js/custom.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'Fb_File_Repository_scripts');

/**
 * REPO custom functions
 */
require get_template_directory() . '/repo/repo_functions.php';


/* Facebook Login */


if(!empty($_GET['fb-registration']) && strtolower($_GET['fb-registration']) == "yes"){
 function custom_login_message() {
     $message = '<p class="message">Registration complete. You will receive an email once your registration was confirmed by an administrator.
     </p>';
     return $message;
 }
 add_filter('login_message', 'custom_login_message');
 function hide_loginform() { ?>
    <style type="text/css">
        #nav, #loginform{
        display:none;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'hide_loginform' );
}

add_action( 'init', 'logout_unapproved_users' );
 
function logout_unapproved_users() {
     if(is_user_logged_in()) {
        $user = wp_get_current_user();
        $user_status_meta = get_user_meta($user->ID);
        $user_status = $user_status_meta['wp-approve-user'][0];
        
         if($user_status != 1) {
            wp_destroy_current_session();
            wp_clear_auth_cookie();
            
            wp_redirect('/login-page/?fb-registration=yes');
            exit();
        } 
        
     }
}

add_filter('show_admin_bar', '__return_false');

// FB Employee Form fb_employee_form

function fb_employee_form( $password, $email, $first_name, $last_name ) {
  echo '
  <style>
  div {
      margin-bottom:2px;
  }
   
  input{
      margin-bottom:4px;
  }
  </style>
  ';



  echo '<form action="';
  echo isset($_SERVER['REQUEST_URI']) ? esc_url($_SERVER['REQUEST_URI']) : '';
  echo '" method="post">';

print "<p style='color:#9c2b2e;'>If you are still unable to gain access using your VPN, please complete the below form.</p><BR>";

  echo '
  <div>
  <label for="firstname">First Name</label>
  <input type="text" name="fname" >
  </div>
   
  <div>
  <label for="website">Last Name</label>
  <input type="text" name="lname">
  </div>

  <div>
  <label for="email">Facebook Email</label>
  <input type="text" name="email" >
  </div>
   


   '.wp_kses(wp_nonce_field('register_nonce'),apac_allowed_html()).'

  <input type="submit" name="submit" value="Request Access"/>
  </form>';
}


function fb_employee_validation( $password, $email, $first_name, $last_name)  {

global $reg_errors;
$reg_errors = new WP_Error;



if ( !is_email( $email ) ) {
  $reg_errors->add( 'email_invalid', 'Email is not valid' );
}

if ( email_exists( $email ) ) {
  $reg_errors->add( 'email', 'Email Already in use' );
}


if ( is_wp_error( $reg_errors ) ) {
 
  foreach ( $reg_errors->get_error_messages() as $error ) {
   
      echo '<div>';
      echo '<strong>ERROR</strong>:';
      echo esc_html($error) . '<br/><br/>';
      echo '</div>';
       
  }

}

}

function complete_fb_employee() {
  global $reg_errors, $password, $email, $facebookcontact, $first_name, $last_name;
  if ( 1 > count( $reg_errors->get_error_messages() ) ) {
      $userdata = array(
      'user_login'    =>   $email,
      'user_email'    =>   $email,
      'user_pass'     =>   $email,
      'first_name'    =>   $first_name,
      'last_name'     =>   $last_name,
      );
      $user = wp_insert_user( $userdata );
      update_user_meta( $user, 'facebookcontact', $email);
      echo '<p class="message">Thanks. You have registered and your access is pending approval.
    </p> <style>
    .custom-registration-inputs form {display:none;}
    </style>';
    $headers = array('Content-Type: text/html; charset=UTF-8');
				wp_mail(
					$email,
					'Facebook WhatsApp Policy Resource Hub - Access Request',
					'Your request for access to the Facebook WhatsApp Policy Resource Hub has been received. Your request will be approved shortly.<br/><br/>Thank you,<br/><br/>APAC Policy Team',
					$headers
				);

  }
}

function custom_fb_employee_function() {



  if ( isset($_POST['submit'] ) ) {



        $retrieved_nonce = isset($_REQUEST['_wpnonce']) ? esc_html($_REQUEST['_wpnonce'])  : null ;

        if (!wp_verify_nonce($retrieved_nonce, 'register_nonce')) die( 'Failed security check' );




    fb_employee_validation(
      isset($_POST['password']) ? esc_attr($_POST['password']) : '',
      isset($_POST['email']) ? esc_attr($_POST['email']) : '',
      isset($_POST['fname']) ? esc_attr($_POST['fname']) : '',
      isset($_POST['lname']) ? esc_attr($_POST['lname']) : ''
      );
       
      // sanitize user form input
      global $password, $email, $first_name, $last_name;
  
      $password   =   sanitize_text_field( $_POST['password'] );
      $email      =   sanitize_email( $_POST['email'] );
      $first_name =   sanitize_text_field( $_POST['fname'] );
      $last_name  =   sanitize_text_field( $_POST['lname'] );

      // call @function complete_registration to create the user
      // only when no WP_error is found
      complete_fb_employee(
      $password,
      $email,
      $first_name,
      $last_name
      );
  }


  fb_employee_form(
      $password,
      $email,
      $first_name,
      $last_name
      );
}



// External Request Form external_request_form

function external_request_form( $password, $email, $facebookcontact, $first_name, $last_name ) {
  echo '
  <style>
  div {
      margin-bottom:2px;
  }
   
  input{
      margin-bottom:4px;
  }
  </style>
  ';



  echo '<form action=" ';
  echo isset($_SERVER['REQUEST_URI']) ? esc_url($_SERVER['REQUEST_URI']) : '';
  echo '" method="post">';

  echo '
  <div>
  <label for="firstname">First Name</label>
  <input type="text" name="fname" value=""></div>
   
  <div>
  <label for="website">Last Name</label>
  <input type="text" name="lname" value="">
  </div>

  <div>
  <label for="email">Email</label>
  <input type="text" name="email" value="">
  </div>
   
  <div>
  <label for="facebookcontact">Who do you work with at Facebook?</label>
  <input type="text" name="facebookcontact" value="">
  </div>
   
  <div>
  <label for="password">Create a Password</label>
  <input type="password" name="password" value="">
  </div>

         '.wp_kses(wp_nonce_field('register_nonce'),apac_allowed_html()).'
  <input type="submit" name="submit" value="Request Access"/>
  </form>
  ';
}


function external_request_validation( $password, $email, $facebookcontact, $first_name, $last_name)  {

global $reg_errors;
$reg_errors = new WP_Error;

if ( empty( $password ) || empty( $email ) ) {
  $reg_errors->add('field', 'Required form field is missing');
}

if ( 5 > strlen( $password ) ) {
  $reg_errors->add( 'password', 'Password length must be greater than 5' );
}

if ( !is_email( $email ) ) {
  $reg_errors->add( 'email_invalid', 'Email is not valid1' );
}

if ( email_exists( $email ) ) {
  $reg_errors->add( 'email', 'Email Already in use' );
}


if ( is_wp_error( $reg_errors ) ) {
 
  foreach ( $reg_errors->get_error_messages() as $error ) {
   
      echo '<div>';
      echo '<strong>ERROR</strong>:';
      echo esc_html($error) . '<br/>';
      echo '</div>';
       
  }

}

}

function complete_external_request() {
  global $reg_errors, $password, $email, $facebookcontact, $first_name, $last_name;
  if ( 1 > count( $reg_errors->get_error_messages() ) ) {
      $userdata = array(
      'user_login'    =>   $email,
      'user_email'    =>   $email,
      'user_pass'     =>   $password,
      'facebookcontact'      =>   $facebookcontact,
      'first_name'    =>   $first_name,
      'last_name'     =>   $last_name,
      );
      $user = wp_insert_user( $userdata );
      update_user_meta( $user, 'facebookcontact', $facebookcontact);
      echo '<p class="message">Thanks. You have registered and your access is pending approval.
    </p> <style>
    .custom-registration-inputs form {display:none;}
    </style>';
    $headers = array('Content-Type: text/html; charset=UTF-8');
				wp_mail(
					$email,
					'Facebook WhatsApp Policy Resource Hub - Access Request',
					'Your request for access to the Facebook WhatsApp Policy Resource Hub has been received. Your request will be approved shortly.<br/><br/>Thank you,<br/><br/>APAC Policy Team',
					$headers
				);

  }
}

function custom_external_request_function() {



  if ( isset($_POST['submit'] ) ) {

      $retrieved_nonce = isset($_REQUEST['_wpnonce']) ? esc_html($_REQUEST['_wpnonce'])  : null ;

        if (!wp_verify_nonce($retrieved_nonce, 'register_nonce')) die( 'Failed security check' );


       external_request_validation(
        isset($_POST['password']) ? esc_attr($_POST['password']) : '',
        isset($_POST['email']) ? esc_attr($_POST['email']) : '',
        isset($_POST['facebookcontact']) ? esc_attr($_POST['facebookcontact']) : '',
        isset($_POST['fname']) ? esc_attr($_POST['fname']) : '',
        isset($_POST['lname']) ? esc_attr($_POST['lname']) : ''
      );
       
       
      global $password, $email, $facebookcontact, $first_name, $last_name;
      $password   =   sanitize_text_field( $_POST['password']  );
      $email      =   sanitize_email(  $_POST['email']  );
      $facebookcontact    =   sanitize_text_field( $_POST['facebookcontact']  );
      $first_name =   sanitize_text_field( $_POST['fname']  );
      $last_name  =   sanitize_text_field( $_POST['lname']  );

      complete_external_request(
      $password,
      $email,
      $facebookcontact,
      $first_name,
      $last_name
      );
  }

  external_request_form(
      $password,
      $email,
      $facebookcontact,
      $first_name,
      $last_name
      );
}


function wporg_usermeta_form_field_facebookcontact( $user )
{
    ?>
    <h3>FBAPAC Fields</h3>
    <table class="form-table">
        <tr>
            <th>
                <label for="facebookcontact">Facebook Contact</label>
            </th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="facebookcontact"
                       name="facebookcontact"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'facebookcontact', true ) ) ?>"
                       >
            </td>
        </tr>
    </table>
    <?php
}
  
/**
 * The save action.
 *
 * @param $user_id int the ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function wporg_usermeta_form_field_facebookcontact_update( $user_id ) {
  
  $retrieved_nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : null;

  // die on nonce failure
  if ( ! wp_verify_nonce($retrieved_nonce, 'update-user_' . $user_id) ) {
    die( 'Failed security check' );
  } 

  // check that the current user have the capability to edit users
  if ( ! current_user_can( 'edit_user', $user_id ) ) {
    return false;
  }
  
  // create/update user meta for the $user_id
  return update_user_meta(
    $user_id, 
    'facebookcontact',
    isset($_POST['facebookcontact']) ? sanitize_text_field($_POST['facebookcontact']) : ''
  );

}
  
// Add the field to user's own profile editing screen.
add_action(
    'show_user_profile',
    'wporg_usermeta_form_field_facebookcontact'
);
  
// Add the field to user profile editing screen.
add_action(
    'edit_user_profile',
    'wporg_usermeta_form_field_facebookcontact'
);
  
// Add the save action to user's own profile editing screen update.
add_action(
    'personal_options_update',
    'wporg_usermeta_form_field_facebookcontact_update'
);
  
// Add the save action to user profile editing screen update.
add_action(
    'edit_user_profile_update',
    'wporg_usermeta_form_field_facebookcontact_update'
);


function new_modify_user_table( $column ) {
  $column['fbid'] = 'Facebook Contact';
  return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
  switch ($column_name) {
      case 'fbid' :
          return get_the_author_meta( 'facebookcontact', $user_id );
      default:
  }
  return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );



function goto_login_page() {
$login_page = home_url( '/login/' );
$page = basename(isset($_SERVER['REQUEST_URI']));

if( $page == "wp-login.php" && isset($_SERVER['REQUEST_METHOD']) == 'GET') {
wp_redirect('/login/');
exit;
}
}
//add_action('init','goto_login_page');

function login_failed() {
global $page_id;
$login_page = home_url( '/login/' );
wp_redirect( $login_page . '?login=failed' );
exit;
}
add_action( 'wp_login_failed', 'login_failed' );

function blank_username_password( $user, $username, $password ) {
$login_page = home_url( '/login/' );
if( $username == "" || $password == "" ) {
wp_redirect( $login_page );
exit;
}
}
// add_filter( 'authenticate', 'blank_username_password', 1, 3);

//echo $login_page = $page_path ;

function logout_page() {
$login_page = home_url( '/login/' );
wp_redirect( $login_page);
exit;
}
add_action('wp_logout', 'logout_page');

add_action( 'login_form_middle', 'add_lost_password_link' );
function add_lost_password_link() {
	return '<a href="/login/?action=lostpassword">Lost Password?</a>';
}