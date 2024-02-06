<?php
/**
 * Custom FUNCTIONS relating to select2 & the search functionality
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Redirect most everything to home
 *
 * @return void
 */


function Repo_Redirect_To_home()
{
    if (is_user_logged_in() && is_page('login-page') || is_user_logged_in() && is_page('login') || is_user_logged_in() && is_page('registration') || is_user_logged_in() && is_page('facebook-employee-form') || is_user_logged_in() && is_page('external-request-form')) {
        wp_safe_redirect(home_url());
        exit();
    }  
}
add_action('template_redirect', 'Repo_Redirect_To_home');


/**
 * Redirect logged-in Subscriber wp-admin requests to home
 *
 * @return void
 */
/*
function Repo_Subscribers_No_Wpadmin_access()
{
    global $current_user;
    $user_roles = $current_user->roles ?: array();
    if ( !empty($user_roles) && in_array('subscriber', $user_roles) ){
        $redirect = home_url();
        wp_redirect( esc_url($redirect) );
        exit();
    }
}
add_action( 'admin_init', 'Repo_Subscribers_No_Wpadmin_access' );
*/


/**
 * Enqueue REPO scripts and styles.
 *
 * @return void
 */
function Repo_File_Repository_scripts()
{
    wp_register_script('repo-js', get_template_directory_uri() . '/repo/repo.js', array(), '0.1.8', false);
    $repo__arr = array(
    'ajaxurl'  => admin_url('admin-ajax.php'),
    'security' => wp_create_nonce('repo--fbapac')
    );
    wp_localize_script('repo-js', 'repofbapac', $repo__arr);
    wp_enqueue_script('repo-js');
    wp_enqueue_style('repo-css', get_template_directory_uri() . '/repo/repo.css', null, '0.1.8');
}
add_action('wp_enqueue_scripts', 'Repo_File_Repository_scripts');


/**
 * Load search results via AJAX
 *
 * @return mixed
 */
function Repo_Load_Search_results()
{

    if (! check_ajax_referer('repo--fbapac', 'security') ) {

        // failed nonce
        wp_die();

    } else {

        $allowed_atts = array(
            'align'            => array(),
            'class'            => array(),
            'type'             => array(),
            'id'               => array(),
            'dir'              => array(),
            'lang'             => array(),
            'style'            => array(),
            'xml:lang'         => array(),
            'src'              => array(),
            'alt'              => array(),
            'href'             => array(),
            'rel'              => array(),
            'rev'              => array(),
            'target'           => array(),
            'novalidate'       => array(),
            'type'             => array(),
            'value'            => array(),
            'name'             => array(),
            'tabindex'         => array(),
            'action'           => array(),
            'method'           => array(),
            'for'              => array(),
            'width'            => array(),
            'height'           => array(),
            'data'             => array(),
            'title'            => array(),
            'download'         => array(),
            'data-nextgroup'   => array(),
            'data-totalgroups' => array(),
            'data-part'        => array(),
            'data-total'       => array(),
            'data-num'         => array()
        );
        
        
        $allowedposttags = array();
        
        $allowedposttags['form']     = $allowed_atts;
        $allowedposttags['button']   = $allowed_atts;
        $allowedposttags['label']    = $allowed_atts;
        $allowedposttags['style']    = $allowed_atts;
        $allowedposttags['strong']   = $allowed_atts;
        $allowedposttags['small']    = $allowed_atts;
        $allowedposttags['table']    = $allowed_atts;
        $allowedposttags['span']     = $allowed_atts;
        $allowedposttags['abbr']     = $allowed_atts;
        $allowedposttags['code']     = $allowed_atts;
        $allowedposttags['pre']      = $allowed_atts;
        $allowedposttags['div']      = $allowed_atts;
        $allowedposttags['img']      = $allowed_atts;
        $allowedposttags['h1']       = $allowed_atts;
        $allowedposttags['h2']       = $allowed_atts;
        $allowedposttags['h3']       = $allowed_atts;
        $allowedposttags['h4']       = $allowed_atts;
        $allowedposttags['h5']       = $allowed_atts;
        $allowedposttags['h6']       = $allowed_atts;
        $allowedposttags['ol']       = $allowed_atts;
        $allowedposttags['ul']       = $allowed_atts;
        $allowedposttags['li']       = $allowed_atts;
        $allowedposttags['em']       = $allowed_atts;
        $allowedposttags['hr']       = $allowed_atts;
        $allowedposttags['br']       = $allowed_atts;
        $allowedposttags['tr']       = $allowed_atts;
        $allowedposttags['td']       = $allowed_atts;
        $allowedposttags['p']        = $allowed_atts;
        $allowedposttags['a']        = $allowed_atts;
        $allowedposttags['b']        = $allowed_atts;
        $allowedposttags['i']        = $allowed_atts;

        $continue_query = true;

        $query   = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
        $filters = isset($_POST['filters']) ? sanitize_text_field($_POST['filters']) : '';
        $sortby  = isset($_POST['sortby']) ? sanitize_text_field($_POST['sortby']) : '';

        $width   = isset($_POST['width']) ? intval(sanitize_text_field($_POST['width'])) : '';
        $the_template_part_path = '/repo/part--post-col-content.php';

        // don't need this anymore but it is here if we do
        /*
        if ( is_numeric($width) && 0 != $width && $width < 768 ) {
        $the_template_part_path = '/repo/part--post-col-content-mobile.php';
        }
        */

        $args = array(
        'post_status'    => 'publish',
        'post_type'      => 'fb_assets_wa',
        'fields'         => 'ids',
        'posts_per_page' => 750
        );

        if (! empty($query) ) {
            $args['s']       = $query;
        }

        if ('alphabetical' == $sortby) {
            $args['orderby'] = 'title';
            $args['order']   = 'ASC';     
        }

        if ('recent' == $sortby) {
            $args['meta_key'] = 'last_modified_date_timestamp';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'DESC';
        }

        if (! empty($filters) ) {

            $filter_arr     = explode(',', $filters);
            if (count($filter_arr) > 15 ) {
                $continue_query = false;
            }

            $filter_combo = array();
            $meta_queries = array();

            if (! empty($filter_arr) ) {
                foreach ($filter_arr as $f) {
                    $exploded = explode('--', $f);
                    $meta_key = $exploded[0];
                    $meta_value = str_replace('_', ' ', $exploded[1]);
                    $filter_combo[$meta_key][] = $meta_value;
                }
            }

            if (! empty($filter_combo) ) {
                foreach ($filter_combo as $k => $v) {

                    // *audience is true/false 
                    // audience: 2 different keys only: external & internal 
                    // *topic is true/false 
                    // topic: 3 different keys: need underscores
                    // *program is true/false 
                    // program: 4 different keys: need underscores
                    // *asset_type is true/false 
                    // asset_type: 13 different keys: need underscores
                    $true_false_array = array(
                    'asset_type', 
                    'audience', 
                    'program', 
                    'topic'
                    );

                    if (in_array($k, $true_false_array) ) {
                        $meta_key  = str_replace(' ', '_', $v);
                        $other_arr = array( 'other_project', 'other_topic','other_asset' );
                        if (in_array($meta_key[0], $other_arr) ) {
                           //$meta_value = array('');
                            $meta_value = 'TRUE';
                            //$meta_oper  = 'NOT IN';
                            $meta_oper  = 'IN';
                        } else {
                            $meta_value = 'TRUE';
                            $meta_oper  = 'IN';
                        }
                        $meta_queries[] = array( $meta_key, $meta_value, $meta_oper );
                    } elseif ('asset_language' == $k) {
                        $meta_queries[] = array( $k, $v[0], 'LIKE' );
                    } else {
                        $meta_queries[] = array( $k, $v, 'IN' );
                    }

                }
            }

            if (! empty($meta_queries) ) {
                $the_meta_arrays = array();
                foreach ($meta_queries as $k => $v) {
                    $the_meta_arrays[] = array(
                    'key' => $v[0],
                    'value' => $v[1],
                    'compare' => $v[2]
                    );
                }

                $args['meta_query'] = array(
                'relation' => 'AND',
                $the_meta_arrays,
                );

            } 

        }//has_filters

        ob_start();

        if (true === $continue_query ) {

            $q = new WP_Query($args);
            
            if ($q->have_posts() ) {
                $loop_i = 0;
                $i = 0;
                $g = 0;
                ?>
                    <span id="search-results-hidden-count" data-total="<?php echo intval($q->found_posts); ?>"></span>
                <?php
                while ( $q->have_posts() ) {
                    $q->the_post();
                    if ( 'notavailable' !== get_post_meta(get_the_ID(), 'asset_url', true) ) {
                        $i++;
                        $loop_i_reset_arr = range(0, 300, 3);
                        if (in_array($loop_i, $loop_i_reset_arr) ) {
                              $loop_i = 0;
                        }
                        include locate_template($the_template_part_path);
                        $loop_i++;
                    }
                }

                if ($q->found_posts > 6) {
                    ?>
                    <div class="load-more-search-results">
                    <button id="load-more-results" data-nextgroup="2" data-totalgroups="<?php echo esc_attr(ceil($q->found_posts/6)); ?>">Load More</button>
                    <a href="#top" class="cta-btn back-to-top cta-scroll main">Back to Top </a>
                </div>
                    <?php
                }


            } else {
                $list = '';
                if (! empty($query) ) {
                    $list = '&quot;' . $query . '&quot; and ';
                }
                if (! empty($filters) ) {
                    foreach ($filter_combo as $k => $v) {
                        $i = 0;
                        $count = count($v);
                        foreach ($v as $item) {
                            $item = ucwords($item);
                            $i++;
                            if ($count === 1) {
                                $list .= '&quot;' . $item . '&quot; and ';
                            } else { 
                                if ($i == 1) {
                                    $list .= '&quot;' . $item . '&quot;';
                                } else {
                                    if ($i == $count) {
                                        $list .= ', &quot;' . $item . '&quot; and ';
                                    } else {
                                        $list .= ', &quot;' . $item . '&quot;';
                                    }
                                }
                            }
                        }
                    }
                }
                if ( ' and ' === substr($list, -5) ) {
                    $list = substr($list, 0, -5);
                }
                ?>
                <span id="search-results-hidden-count" class="no-results-found" data-total="0"></span>
                <p class="no-results-found-text">0 results containing <?php echo esc_html($list); ?>. For more search tips <a href="/faq">consult our FAQ</a></p>
                <?php
            }//have_posts

            wp_reset_postdata();

        } else {
            ?>
                <span id="search-results-hidden-count" class="too-many-filters" data-total="0"></span>
                <p class="no-results-found-text">0 results, not due to the data but we are not able to process search queries with more than 15 tags. Please select 15 or fewer tags. For more search tips <a href="/faq">consult our FAQ</a></p>
            <?php
        }//continue_query

        $results = ob_get_clean();

        echo wp_kses($results, $allowedposttags);

        wp_die();

    }
}
add_action('wp_ajax_Repo_Load_Search_results', 'Repo_Load_Search_results');
add_action('wp_ajax_nopriv_Repo_Load_Search_results', 'Repo_Load_Search_results');


/**
 * Determine which link(s) to show on search results
 *
 * @param $url string
 *
 * @return mixed
 */
function Repo_Which_link($url='', $ID='', $masked='')
{

    if ( ! empty($url) ) {

        if ( empty($masked) ) {
            $masked = $url;
        }

        $home_url        = home_url();
        $home_url_parse  = wp_parse_url($home_url);
        $home_domain     = $home_url_parse['host'];
        $asset_url_parse = wp_parse_url($url);
        $asset_domain    = $asset_url_parse['host'];

        $is__link = false;
        if ( (strpos($url, 'http') !== false ) || (strpos($url, 'https') !== false ) ) {
            $is__link = true;
        }

        $download_toggle = true;
        if ( true === $is__link ) {
            $download_toggle = false;
        }

        //view link
        $link_text  = 'View';
        $rand_num   = wp_rand(0, 999999999999);
        $i_class    = 'view';
        $target     = ' target="_blank"';
        $xtra_attr  = '';
        $xtra_class = '';
        $the_url    = 'https://drive.google.com/open?id=' . $url;
        if ( true === $is__link ) {
            $the_url = $url;
        }
?>
    <div class="pccb-row">
        <div class="pccb-row-label"><a href="<?php echo esc_url($the_url); ?>" data-part="text" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="card-link card-link-text-<?php echo esc_attr($rand_num); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><?php echo esc_attr($link_text); ?></a></div>
        <div class="pccb-row-icon"><a href="<?php echo esc_url($the_url); ?>" data-part="icon" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="card-link asset-link card-link-icon-<?php echo esc_attr($rand_num); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><i class="icon-<?php echo esc_attr($i_class); ?>"></i></a></div>
    </div>

<?php
        if ( true === $download_toggle ) {

            //download link
            $link_text  = 'Download';
            $rand_num   = wp_rand(0, 999999999999);
            $i_class    = 'download';
            $target     = ' target="_blank"';
            //$xtra_attr = ' download=' . $file_name;
            $xtra_attr  = '';
            $xtra_class = ' show-desktop';
            $the_url    = 'https://drive.google.com/u/1/uc?export=download&id=' . $url;
            if ( true === $is__link ) {
                $the_url = $url;
            }
?>
    <div class="pccb-row">
        <div class="pccb-row-label"><a href="<?php echo esc_url($the_url); ?>" data-part="text" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="card-link card-link-text-<?php echo esc_attr($rand_num); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><?php echo esc_attr($link_text); ?></a></div>
        <div class="pccb-row-icon"><a href="<?php echo esc_url($the_url); ?>" data-part="icon" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?>  class="card-link asset-link card-link-icon-<?php echo esc_attr($rand_num); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><i class="icon-<?php echo esc_attr($i_class); ?>"></i></a></div>
    </div>
<?php
        }//download_toggle__true

        //share link
        $link_text           = 'Share';
        $i_class             = 'icon-share';
        $target              = ' target="_blank"';
        $xtra_attr           = '';
        $base_url            = home_url( '/?shared_id=' );
        $postIdForEncryption = $ID;
        $pass                = "fbapac@2020";
        $key                 = substr(sha1($pass, true), 0, 16);
        $ivlen               = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv                  = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw      = openssl_encrypt($postIdForEncryption, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac                = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $encryptedPostId     = base64_encode( $iv.$hmac.$ciphertext_raw );
        $enconded            = urlencode($encryptedPostId);
        $share_url           = $base_url.$enconded;
?>
    <div class="pccb-row">
        <div class="pccb-row-label"><?php echo esc_attr($link_text); ?> <a href="<?php echo esc_url($share_url); ?>" id="<?php echo esc_attr($postIdForEncryption); ?>" data-part="text" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="clipboard copytoclipboard"<?php echo esc_attr($xtra_attr); ?>> (Copy URL) </a></div>
        <div class="pccb-row-icon"><a class="clipboard" href="<?php echo esc_url($share_url); ?>" id="<?php echo esc_attr($postIdForEncryption); ?>" data-part="icon" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="card-link asset-link card-link-icon-<?php echo esc_attr($rand_num); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><i class="<?php echo esc_attr($i_class); ?>"></i></a></div>
    </div>
<?php

    } 

}


/**
 * Determine which link(s) to show on latest page
 *
 * @param $url string
 *
 * @return mixed
 */
function Repo_Which_Link_latest($url='', $masked='')
{

    if ( ! empty($url) ) {

        if ( empty($masked) ) {
            $masked = $url;
        }

        $home_url        = home_url();
        $home_url_parse  = wp_parse_url($home_url);
        $home_domain     = $home_url_parse['host'];
        $asset_url_parse = wp_parse_url($url);
        $asset_domain    = $asset_url_parse['host'];

        $is__link = false;
        if ( (strpos($url, 'http') !== false ) || (strpos($url, 'https') !== false ) ) {
            $is__link = true;
        }

        $download_toggle = true;
        if ( true === $is__link ) {
            $download_toggle = false;
        }

        //view link
        $link_text  = 'View';
        $rand_num   = wp_rand(0, 999999999999);
        $icon       = 'view';
        $target     = ' target="_blank"';
        $xtra_attr  = '';
        $xtra_class = '';
        $the_url    = 'https://drive.google.com/open?id=' . $url;
        if ( true === $is__link ) {
            $the_url = $url;
        }
?>

  <div class="lpr-desc-row">
      <div class="lpr-row-icon"><a href="<?php echo esc_url($the_url); ?>" data-part="icon" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="latest-link latest-link-icon latest-link-icon-<?php echo esc_attr($rand_num); ?> icon-<?php echo esc_attr($icon); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><span class="sr-only"><?php echo esc_attr($link_text); ?></span></a></div>
      <div class="lpr-row-label"><a href="<?php echo esc_url($the_url); ?>" data-part="text" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="latest-link latest-link-text latest-link-text-<?php echo esc_attr($rand_num); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><?php echo esc_attr($link_text); ?></a></div>
  </div>

<?php
        if ( true === $download_toggle ) {

            //download link
            $link_text  = 'Download';
            $rand_num   = wp_rand(0, 999999999999);
            $icon       = 'download';
            $target     = '';
            //$xtra_attr = ' download=' . $file_name;
            $xtra_attr  = '';
            $xtra_class = ' show-desktop';
            $the_url    = 'https://drive.google.com/u/1/uc?export=download&id=' . $url;
            if ( true === $is__link ) {
                $the_url = $url;
            }
?>

  <div class="lpr-desc-row">
      <div class="lpr-row-icon"><a href="<?php echo esc_url($the_url); ?>" data-part="icon" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="latest-link latest-link-icon latest-link-icon-<?php echo esc_attr($rand_num); ?> icon-<?php echo esc_attr($icon); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><span class="sr-only"><?php echo esc_attr($link_text); ?></span></a></div>
      <div class="lpr-row-label"><a href="<?php echo esc_url($the_url); ?>" data-part="text" data-num="<?php echo esc_attr($rand_num); ?>"<?php echo esc_attr($target); ?> class="latest-link latest-link-text latest-link-text-<?php echo esc_attr($rand_num); ?><?php echo esc_attr($xtra_class); ?>"<?php echo esc_attr($xtra_attr); ?>><?php echo esc_attr($link_text); ?></a></div>
  </div>

<?php
        }//download_toggle__true

    } 

}


/* Determines if Padding needs to be adjusted for only view or download/view */
function Repo_latest_padding($url='')
{

    // make sure it is a link first
    if ( ! empty($url) ) {

        $home_url        = home_url();
        $home_url_parse  = parse_url($home_url);
        $home_domain     = $home_url_parse['host'];
        $asset_url_parse = parse_url($url);
        $asset_domain    = $asset_url_parse['host'];
        $rand_num        = wp_rand(0, 999999999999);

        if ( ($home_domain == $asset_domain) || (strpos($url, 'export=download') !== false) ) {

            $class="lpr-desc-bottom-two";

        } else {

               $class="lpr-desc-bottom-one";

        } 


        RETURN $class;

    }



}
/**
 * Update IDs to avoid duplicate ID errors
 *
 * @param $content mixed
 *
 * @return string
 */
function Repo_Differentiate_mobile($content)
{
    return str_replace('ams-quick-link-', 'ams-quick-link-mobile-', $content);
}


/**
 * Return which icon class a card should use
 *
 * @param $ID integer
 *
 * @return array
 */
function Repo_Determine_Icon_data($ID)
{
    // always prioritize 'case_study' & 'video' above all else
    $types      = array( 'case_study', 'video', 'report', 'one_pager', 'presentation', 'presentation_template', 'logobrand_guidelines', 'brochure', 'case_study_video', 'case_study_written', 'case_study_micro_business', 'case_study_small_business', 'case_study_women_entrepreneur', 'narrative_key_messaging','audio','image','research' );
    $meta       = get_post_meta($ID);
    $result_arr = array();
    if (is_array($meta) && is_array($types) ) {
        $total = 0;
        foreach ($types as $t) {
            if (array_key_exists($t, $meta) ) {
                if ('TRUE' === $meta[$t][0]) {
                    $icon_class = ' ' . $t;
                    $icon_name   = $t;
                    $result_arr[] = array( $icon_class, $icon_name );
                }
            }
        }
    }
    if ( empty($result_arr) ) {
        $result_arr = array( array('default', 'default') );
    }
    wp_reset_postdata();
    return $result_arr;
}


/**
 * Return which Topic is assoicated with a post
 *
 * @param $ID integer
 *
 * @return array
 */
function Repo_Determine_Topic_data($ID)
{
    $topic_class = 'topic-other';
    $topic_name  = 'Other';
    $meta        = get_post_meta($ID);

    $results_array = array();

    $allowed_priority_values = array( 'Economic Impact', 'Safety' );

    if (is_array($meta)) {
        if ( array_key_exists('priority_topic', $meta) && !empty($meta['priority_topic']) ) { 
            if ( in_array($meta['priority_topic'][0], $allowed_priority_values) ) {
                if ('Economic Impact' == $meta['priority_topic'][0]) {
                    $topic_class = 'topic-economic-impact';
                    $topic_name  = 'Economic Impact';
                }
                if ('Safety' == $meta['priority_topic'][0]) {
                    $topic_class = 'topic-safety';
                    $topic_name  = 'Safety';
                }
                $results_array[] = array( $topic_class, $topic_name, true );
            }
        }
    }

    $topics      = array( 'finsafety', 'safety_misinfo', 'economic_recovery', 'privacy', 'training_resource' );
    if (is_array($meta) && is_array($topics) ) {
        foreach ($topics as $t) {
            if (array_key_exists($t, $meta) ) {
                if ('TRUE' === $meta[$t][0]) {
                    if ('digital_citizenship_digital_skills' == $t) {
                        $t = 'digital_skills';
                    }
                    $topic_class = 'topic-' . str_replace('_', '-', $t);
                    $topic_name  = ucwords(str_replace('_', ' ', $t));
                    if ('Government Politics' == $topic_name) {
                        $topic_name = 'Politics &amp; Government Outreach';
                    }
                    if ('Digital Skills' == $topic_name) {
                        $topic_name = 'Digital Citizenship';
                    }
                    $results_array[] = array( $topic_class, $topic_name, false );
                }
            }
        }
    }
    $override = array( 'instagram_asset', 'whatsapp_asset' );
    if (is_array($meta) && is_array($override) ) {
        foreach ($override as $o) {
            if (array_key_exists($o, $meta) ) {
                if ('TRUE' === $meta[$o][0]) {
                    $topic_class = 'topic-' . str_replace('_', '-', $o);
                    $topic_name  = ucwords(str_replace('_asset', '', $o));
                    if ('Whatsapp' == $topic_name) {
                        $topic_name = 'WhatsApp';
                    }
                    $results_array[] = array( $topic_class, $topic_name, false );
                }
            }
        }
    }
    wp_reset_postdata();
    if ( empty($results_array) ) {
        $results_array[] = array( $topic_class, $topic_name, false );
    }
    return $results_array;
}


/**
 * Return which Program is assoicated with a post
 *
 * @param $ID integer
 *
 * @return array
 */
function Repo_Determine_Program_data($ID)
{
    $programs   = array( 'boost', 'research', 'shemeansbusiness', 'we_think_digital' );
    $prog_class = 'other';
    $prog_name  = 'Other';
    $meta       = get_post_meta($ID);
    if (is_array($meta) && is_array($programs) ) {
        foreach ($programs as $p) {
            if (array_key_exists($p, $meta) ) {
                if ('TRUE' == $meta[$p][0]) {
                    $prog_class = 'topic-' . str_replace('_', '-', $p);
                    $prog_name  = ucwords(str_replace('_', ' ', $p));
                    if ('Shemeansbusiness' == $prog_name) {
                        $prog_name = 'SheMeansBusiness';
                    }

                }
            }
        }
    }
    wp_reset_postdata();
    return array( $prog_class, $prog_name );
}


/**
 * REPO Theme Options using Fieldmanager plugin
 *
 * @return void
 */
if (function_exists('fm_register_submenu_page') ) {
    fm_register_submenu_page('repo_fbapac', 'options-general.php', 'Theme Options');
    add_action(
        'fm_submenu_repo_fbapac', function () {
            $fm = new Fieldmanager_Group(
                array(
                'name'     => 'repo_fbapac',
                'children' => array(
                'main_header'          => new Fieldmanager_RichTextArea('Main Header'),
                'main_description'     => new Fieldmanager_RichTextArea('Main Description'),
                'quicklinks'           => new Fieldmanager_RichTextArea('Quick Links'),
                'featured_html'        => new Fieldmanager_RichTextArea('Featured HTML (Desktop)'),
                'featured_html_mobile' => new Fieldmanager_RichTextArea('Featured HTML (Mobile)'),
                'featured_link'        => new Fieldmanager_TextField('Featured Link'),
                'latest_hero_content'  => new Fieldmanager_RichTextArea('Latest Page, Hero Content'),
                'faq_hero_content'     => new Fieldmanager_RichTextArea('FAQ Page, Hero Content'),
                'search_faq_title'     => new Fieldmanager_TextField('Title for Search FAQ'),
                'search_faq_content'   => new Fieldmanager_RichTextArea('Content for Search FAQ'),
                'site_faq_title'       => new Fieldmanager_TextField('Title for Site FAQ'),
                'site_faq_content'     => new Fieldmanager_RichTextArea('Content for Site FAQ'),
                'tooltip_content'     => new Fieldmanager_RichTextArea('Info/Tips - Tooltip Content'),
                ) 
                ) 
            );
            $fm->activate_submenu_page();
        } 
    );
}


/**
 * Load latest legend click results via AJAX
 *
 * @return mixed
 */
function Repo_Load_Latest_results()
{

    if (! check_ajax_referer('repo--fbapac', 'security') ) {

        // failed nonce
        wp_die();

    } else {

        $allowed_atts = array(
            'align'            => array(),
            'class'            => array(),
            'type'             => array(),
            'id'               => array(),
            'dir'              => array(),
            'lang'             => array(),
            'style'            => array(),
            'xml:lang'         => array(),
            'src'              => array(),
            'alt'              => array(),
            'href'             => array(),
            'rel'              => array(),
            'rev'              => array(),
            'target'           => array(),
            'novalidate'       => array(),
            'type'             => array(),
            'value'            => array(),
            'name'             => array(),
            'tabindex'         => array(),
            'action'           => array(),
            'method'           => array(),
            'for'              => array(),
            'width'            => array(),
            'height'           => array(),
            'data'             => array(),
            'title'            => array(),
            'download'         => array(),
            'data-nextgroup'   => array(),
            'data-totalgroups' => array(),
            'data-part'        => array(),
            'data-total'       => array(),
            'data-num'         => array()
        );
        $allowedposttags             = array();
        $allowedposttags['form']     = $allowed_atts;
        $allowedposttags['button']   = $allowed_atts;
        $allowedposttags['label']    = $allowed_atts;
        $allowedposttags['style']    = $allowed_atts;
        $allowedposttags['strong']   = $allowed_atts;
        $allowedposttags['small']    = $allowed_atts;
        $allowedposttags['table']    = $allowed_atts;
        $allowedposttags['span']     = $allowed_atts;
        $allowedposttags['abbr']     = $allowed_atts;
        $allowedposttags['code']     = $allowed_atts;
        $allowedposttags['pre']      = $allowed_atts;
        $allowedposttags['div']      = $allowed_atts;
        $allowedposttags['img']      = $allowed_atts;
        $allowedposttags['h1']       = $allowed_atts;
        $allowedposttags['h2']       = $allowed_atts;
        $allowedposttags['h3']       = $allowed_atts;
        $allowedposttags['h4']       = $allowed_atts;
        $allowedposttags['h5']       = $allowed_atts;
        $allowedposttags['h6']       = $allowed_atts;
        $allowedposttags['ol']       = $allowed_atts;
        $allowedposttags['ul']       = $allowed_atts;
        $allowedposttags['li']       = $allowed_atts;
        $allowedposttags['em']       = $allowed_atts;
        $allowedposttags['hr']       = $allowed_atts;
        $allowedposttags['br']       = $allowed_atts;
        $allowedposttags['tr']       = $allowed_atts;
        $allowedposttags['td']       = $allowed_atts;
        $allowedposttags['p']        = $allowed_atts;
        $allowedposttags['a']        = $allowed_atts;
        $allowedposttags['b']        = $allowed_atts;
        $allowedposttags['i']        = $allowed_atts;

        $continue_query = true;

        $filters = isset($_POST['filters']) ? sanitize_text_field($_POST['filters']) : '';
        $the_template_part_path = '/repo/part--latest-card.php';

        $args = array(
        'post_status'    => 'publish',
        'post_type'      => 'fb_assets_wa',
        'fields'         => 'ids',
        'posts_per_page' => 30,
        'meta_key'       => 'last_modified_date_timestamp',
        'orderby'        => 'meta_value',
        'order'          => 'DESC'
        );

        if (! empty($filters) ) {

            $filter_arr     = explode(',', $filters);
            if (count($filter_arr) > 15 ) {
                $continue_query = false;
            }

            $filter_combo = array();
            $meta_queries = array();

            if (! empty($filter_arr) ) {
                foreach ($filter_arr as $f) {
                    $exploded = explode('--', $f);
                    $meta_key = $exploded[0];
                    $meta_value = str_replace('_', ' ', $exploded[1]);
                    $filter_combo[$meta_key][] = $meta_value;
                }
            }

            if (! empty($filter_combo) ) {
                foreach ($filter_combo as $k => $v) {

                    $allowed_array = array(
                    'topic'
                    );

                    if (in_array($k, $allowed_array) ) {
                        $meta_key  = str_replace(' ', '_', $v);
                        $other_arr = array( 'other_topic' );
                        if (in_array($meta_key[0], $other_arr) ) {
                            $meta_value = array('');
                            $meta_oper  = 'NOT IN';
                        } else {
                            $meta_value = 'TRUE';
                            $meta_oper  = 'IN';
                        }
                        $meta_queries[] = array( $meta_key, $meta_value, $meta_oper );
                    }

                }
            }

            if (! empty($meta_queries) ) {
                $the_meta_arrays = array();
                foreach ($meta_queries as $k => $v) {
                    $the_meta_arrays[] = array(
                    'key' => $v[0],
                    'value' => $v[1],
                    'compare' => $v[2]
                    );
                }

                $args['meta_query'] = array(
                'relation' => 'AND',
                $the_meta_arrays,
                );

            } 

        }//has_filters

        ob_start();

        if (true === $continue_query ) {

            $q = new WP_Query($args);
            
            if ($q->have_posts() ) {
        ?>
        <span id="latest-query-totals" data-num="<?php echo esc_attr( intval($q->post_count) ); ?>" data-totalgroups="<?php echo esc_attr( ceil($q->post_count/5) ); ?>"></span>
        <?php
                $i = 0;
                $g = 0;
                while ($q->have_posts()) : $q->the_post(); 
                    if ( 'notavailable' !== get_post_meta(get_the_ID(), 'asset_url', true) ) {
                        $i++;
                        include( locate_template( '/repo/part--latest-card.php' ) );
                    }
                endwhile; wp_reset_postdata();
            }//have_posts

            wp_reset_postdata();

        }//continue_query

        $results = ob_get_clean();

        echo wp_kses($results, $allowedposttags);

        wp_die();

    }
}
add_action('wp_ajax_Repo_Load_Latest_results', 'Repo_Load_Latest_results');
add_action('wp_ajax_nopriv_Repo_Load_Latest_results', 'Repo_Load_Latest_results');


/**
 * Create a hashed media url to mask file path
 *
 * @param $file_uri string
 *
 * @return mixed
 */
function fbwa_create_hashed_media_url($post_id) {
    $hashed_id = bin2hex( base64_encode( $post_id ) );
    return esc_url( home_url() . '/resource/?fid=' . $hashed_id );
}


/**
 * Get the attachment absolute path from its url
 *
 * @param string $url the attachment url to get its absolute path
 *
 * @return bool|string It returns the absolute path of an attachment
 */
function fbwa_attachment_url_to_path( $url ) {
    $parsed_url = wp_parse_url( $url );
    if(empty($parsed_url['path'])) return false;
    $file = ABSPATH . ltrim( $parsed_url['path'], '/');
    if (file_exists( $file)) return $file;
    return false;
}

