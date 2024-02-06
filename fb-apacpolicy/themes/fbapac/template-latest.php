<?php
/**
 * Template Name: Latest
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */

get_header();
$theme_options = get_option('repo_fbapac');
$hero_content  = $theme_options['latest_hero_content'];
?>
    
    <?php while ( have_posts() ) : the_post(); ?>
    
     <!--"container-wrapper-->
    <div class="container-wrapper" id="top">
        
        <!--banner-wrapper-->
        <div class="page-banner-wrapper" style="background-image:url();">
               <div class="wrapper">
                <div class="page-banner-desc">
                    <?php echo wp_kses( $hero_content, array( 'h1' => array() , 'h2' => array() , 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(), 'p' => array('id' => array(),'class' => array()), 'span' => array('id' => array(),'class' => array()), 'a' => array('href' => array(),'title' => array()), 'strong' => array(), 'br' => array() ) ); ?>
                </div>
            </div> 
        </div>
        <!--banner-wrapper-->

        <!--list-post-wrap-->
        <div class="list-post-wrap">
            <div class="wrapper" id="loadmore-content">

                <div class="legend-latest" id="the-legend-wrapper">
                    <div class="the-legend show-desktop" id="the-legend">
                        <div class="col col-left">
                            <span class="title">Topic:</span>
                            <ul class="item-list">
                                <li class="topic-digital-citizenship ams-legend-link dynamic-search-link" id="ams-legend-link-1" data-filters="topic--digital_citizenship_digital_skills" data-query="">Digital Citizenship</li>
                                <li class="topic-economic-impact ams-legend-link dynamic-search-link" id="ams-legend-link-2" data-filters="topic--economic_impact" data-query="">Economic Impact</li>
                                <li class="topic-government-politics ams-legend-link dynamic-search-link" id="ams-legend-link-3" data-filters="topic--government_politics" data-query="">Politics &amp; Government</li>
                                <li class="topic-safety ams-legend-link dynamic-search-link" id="ams-legend-link-4" data-filters="topic--safety" data-query="">Safety</li>
                                <li class="topic-social-impact ams-legend-link dynamic-search-link" id="ams-legend-link-5" data-filters="topic--social_impact" data-query="">Social Impact</li>
                                <li class="topic-other ams-legend-link dynamic-search-link" id="ams-legend-link-6" data-filters="topic--other_topic" data-query="">Other</li>
                            </ul>
                        </div>
                        <div class="col col-mid"></div>
                        <div class="col col-right">
                            <span class="title">Product:</span>
                            <ul class="item-list">
                                <li class="product-instagram ams-legend-link dynamic-search-link" id="ams-legend-link-7" data-filters="topic--instagram_asset" data-query="">Instagram</li>
                                <li class="product-whatsapp ams-legend-link dynamic-search-link" id="ams-legend-link-8" data-filters="topic--whatsapp_asset" data-query="">Whatsapp</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="latest-search-results">
                
                <?php $q = new WP_Query(
                    array(
                    'post_type'      => 'fb_assets_apac',
                    'posts_per_page' => '30',
                    'meta_key'       => 'last_modified_date_timestamp',
                    'orderby'        => 'meta_value',
                    'order'          => 'DESC',
                    )
                );
                ?>
                <?php 
                if ($q->have_posts() ) :
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
                endif;
                ?>

                </div>
                <!--latest-search-results-->

            </div>

        </div>
        <!--list-post-wrap-->
        
        <!--list-post-bottom-->
        <div class="list-post-bottom">
            <a class="cta-btn load-more" id="loadmore-cta" data-next="1">Load More </a>
            <a href="#top" class="cta-btn back-to-top border cta-scroll">Back to Top </a>
        </div>
        <!--list-post-bottom-->
        
    </div>
    <!--container-wrapper-->
    
    
    <?php endwhile; ?>

<?php
get_footer();
