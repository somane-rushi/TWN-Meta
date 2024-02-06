<?php
/**
 * Template part to display LATEST PAGE search results
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

$assetsid = get_the_ID();

$actual_url    = get_post_meta($assetsid, 'asset_url', true);
$actual_parse  = wp_parse_url( $actual_url );
$actual_domain = $actual_parse['host'];
$home_url      = home_url();
$home_parse    = wp_parse_url( $home_url );
$home_domain   = $home_parse['host'];
if ( 'drive.google.com' === $actual_domain) {
    $asset_url     = $actual_url;
    $actual_extnsn = 'drive';
} elseif ($home_domain === $actual_domain) {
    $asset_url     = fbwa_create_hashed_media_url($assetsid);
    $actual_extnsn = pathinfo($actual_url, PATHINFO_EXTENSION) ?: '';
} else {
    $asset_url     = $actual_url;
    $actual_extnsn = 'external';
}

$extra_classes = 'first-group';
if ($i > 5) {
    $extra_classes = 'more-group more-group-' . $g;
}
if ($i % 5 == 0) {
    $g++;
}

$the_title  = get_the_title($assetsid);
$author      = get_post_meta($assetsid, 'author', true) ?: '';
$country     = get_post_meta($assetsid, 'country', true) ?: '';

$icon_data   = Repo_Determine_Icon_data($assetsid);
$icon_class  = $icon_data[0][0];
$icon_name   = $icon_data[0][1];
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
$topic_data  = Repo_Determine_Topic_data($assetsid);
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

$prog_data   = Repo_Determine_Program_data($assetsid);
$prog_class  = $prog_data[0] ?: '';
$program     = $prog_data[1] ?: '';
?>

<a name="a-data-<?php echo esc_attr($assetsid);?>"></a>
<div class="more-row <?php echo esc_attr($extra_classes); ?>" id="data-<?php echo esc_attr($assetsid);?>" data-part="<?php echo esc_attr( $actual_extnsn ); ?>">

    <div class="list-post-row <?php echo esc_attr($topic_class); ?>">

        <div class="lpr-img">
            <div class="lpr-icon"><span class="card-icon-wrap <?php echo esc_attr($icon_class); ?>" data-num="<?php echo esc_attr($icon_alt); ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/images/svgs/icons/' . esc_attr($icon_name) . '.svg' ); ?>" class="card-icon<?php echo (true == $two_icons) ? ' two-icons' : ''; ?>" alt="<?php echo esc_attr($icon_alt); ?>" /></span><?php if (true == $two_icons) : ?><span class="card-icon-wrap <?php echo esc_attr($icon_class_2); ?>" data-num="<?php echo esc_attr($icon_alt_2); ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/images/svgs/icons/' . esc_attr($icon_name_2) . '.svg' )  ?>" class="card-icon two-icons card-icon-two" alt="<?php echo esc_attr($icon_alt_2); ?>" /></span><?php endif; ?></div>
        </div>

        <div class="lpr-main">
            
            <div class="lpr-meta">
            <span class="item"><span class="lpr-meta-label">Last Modified:</span> <?php echo esc_html(get_post_meta($assetsid, 'last_modified_date_visual', true));?></span>
                <?php echo ( ! empty($country) ) ? '<span class="item">Country: ' . esc_html($country) . '</span>' : ''; ?>
             
                <?php echo ( ! empty($topic_name) ) ? '<span class="item">' . esc_attr($topic_pre) . esc_html($topic_name) . '</span>' : ''; ?>
             </div>
            
            <div class="lpr-desc">
                <h6><?php echo esc_html($the_title); ?></h6>
                <p><?php echo esc_html($author); ?></p>
                <div class="lpr-desc-bottom">
                <?php 
                    Repo_Which_Link_latest($actual_url, $asset_url); 
                ?>
                </div>
                
            </div>

        </div>

        <div class="lpr-main-tool">

            <div class="lpr-desc-row">
      
              <div class="lpr-row-label">
                <a target="_blank" href="<?php echo esc_url($asset_url); ?>">
                    View
                </a>
              </div>
          
              <div class="lpr-row-icon">
                <a target="_blank" href="<?php echo esc_url($asset_url); ?>">
                   <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/view-icon.png" alt="View: <?php echo esc_attr($the_title); ?>" >
                </a>
              </div>                      
          
          
            </div>
    
    
        </div>

    </div>

</div>