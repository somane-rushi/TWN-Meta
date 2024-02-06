<?php
/**
 * Template part to display search results
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$real_i = $i - 1;
if ($real_i % 6 == 0) {
    $g++;
}

$ID             = get_the_ID();
$the_title      = get_the_title($ID);
$author         = get_post_meta($ID, 'author', true) ?: '';
$asset_language = get_post_meta($ID, 'asset_language', true) ?: '';
$country        = get_post_meta($ID, 'country', true) ?: '';
$mod_stamp      = get_post_meta($ID, 'last_modified_date_timestamp', true);
$mod_date       = get_post_meta($ID, 'last_modified_date_visual', true);

$actual_url     = get_post_meta($ID, 'asset_url', true);
$actual_parse   = wp_parse_url( $actual_url );
$actual_domain  = $actual_parse['host'];
$home_url       = home_url();
$home_parse     = wp_parse_url( $home_url );
$home_domain    = $home_parse['host'];
if ( 'drive.google.com' === $actual_domain) {
    $asset_url     = $actual_url;
    $actual_extnsn = 'drive';
} elseif ($home_domain === $actual_domain) {
    $asset_url     = fbapac_create_hashed_media_url($ID);
    $actual_extnsn = pathinfo($actual_url, PATHINFO_EXTENSION) ?: ''; 
} else {
    $asset_url     = $actual_url;
    $actual_extnsn = 'external';
}

$all_meta    = get_post_meta($ID);

$icon_data   = Repo_Determine_Icon_data($ID);
$icon_class  = esc_attr($icon_data[0][0]);
$icon_name   = esc_attr($icon_data[0][1]);
$icon_alt    = ucwords(str_replace('_', ' ', $icon_name));
if ('Default' == $icon_alt) {
   $icon_alt = 'Other';
}
if ('Logobrand Guidelines' == $icon_alt) {
   $icon_alt = 'Logo/Brand Guidelines';
}
$two_icons   = false;
if ( isset($icon_data[1]) && !empty($icon_data[1]) ) {
    $two_icons    = true;
    $icon_class_2 = esc_attr($icon_data[1][0]);
    $icon_name_2  = esc_attr($icon_data[1][1]);
    $icon_alt_2   = ucwords(str_replace('_', ' ', $icon_name_2));
    if ('Default' == $icon_alt_2) {
       $icon_alt_2 = 'Other';
    }
    if ('Logobrand Guidelines' == $icon_alt_2) {
       $icon_alt_2 = 'Logo/Brand Guidelines';
    }
}

$topic_data  = Repo_Determine_Topic_data($ID);
$topic_pre   = 'Topic: ';
$topic_name  = $topic_data[0][1] ?: '';
$topic_class = $topic_data[0][0] ?: '';
if ( true === $topic_data[0][2] && (count($topic_data) > 1) ) {
    $topic_name_arr = array();
    $z = 0;
    foreach ($topic_data as $t) {
        $z++;
        if ($z == 1) {
           $topic_name_arr[] = $t[1];
        } else {
            if ( ! in_array($t[1], $topic_name_arr) ) {
                $topic_name_arr[] = $t[1];
            }
        }
    }
    if ( ! empty($topic_name_arr) ){
        $topic_name = implode(', ', $topic_name_arr);
    }
    $topic_pre   = 'Topics: ';
}

$prog_data   = Repo_Determine_Program_data($ID);
$prog_class  = $prog_data[0] ?: '';
$program     = $prog_data[1] ?: '';
?>

    <div class="post-col-content <?php echo esc_attr($topic_class); ?> more-group-<?php echo esc_attr($g); ?><?php echo ($i > 6) ? ' post-col-content-more-results' : ''; ?>" id="post-col-content-<?php echo esc_attr($i); ?>" data-part="<?php echo esc_attr($actual_extnsn); ?>">
        <div class="post-col-content-image" >
            <div class="post-col-content-icon <?php echo esc_attr($icon_class); ?>"><span class="card-icon-wrap <?php echo esc_attr($icon_class); ?>" data-num="<?php echo esc_attr($icon_alt); ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/images/svgs/icons/' . $icon_name . '.svg' ) ; ?>" class="card-icon<?php echo (true == $two_icons) ? ' two-icons' : ''; ?>" alt="<?php echo esc_attr($icon_alt); ?>" /></span><?php if (true == $two_icons) : ?><span class="card-icon-wrap <?php echo esc_attr($icon_class_2); ?>" data-num="<?php echo esc_attr($icon_alt_2); ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/images/svgs/icons/' . $icon_name_2 . '.svg' ) ; ?>" class="card-icon two-icons card-icon-two" alt="<?php echo esc_attr($icon_alt_2); ?>" /></span><?php endif; ?></div>
        </div>
        <div class="post-col-content-desc">

                <?php
               if(! empty($asset_language) && $asset_language !='Not Applicable'){

                        $asset_language = " - $asset_language";

                }else{

                        $asset_language ="";
                }


                ?>

            <h6><?php echo esc_html($the_title) . esc_html($asset_language); ?></h6>
            <p><?php echo esc_html($author); ?></p>    
            <div class="post-col-content-meta">
                <span>Last Modified:  <?php $last_modified = Fb_Is_Last_Modified_date($mod_date); echo esc_html($last_modified); ?></span>
                <?php echo ( ! empty($country) ) ? '<span>Country: ' . esc_html($country) . '</span>' : ''; ?>
                <?php echo ( ! empty($program) && ('Research' != $program) ) ? '<span>Program: ' . esc_html($program) . '</span>' : ''; ?>
                <?php echo ( ! empty($topic_name) ) ? '<span>' . esc_html($topic_pre) . esc_html($topic_name) . '</span>' : ''; ?>                
            </div>
         
            <div class="post-col-content-bottom">
                
            <?php 
                Repo_Which_link( $actual_url, $ID, $asset_url ); 
            ?>
                
            </div>
            
        </div>
    </div>
