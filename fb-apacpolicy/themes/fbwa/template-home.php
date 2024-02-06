<?php
/**
 * Template Name: Home
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
$quick_links   = $theme_options['quicklinks'];
$featured_link = sanitize_text_field($theme_options['featured_link']);
$main_header = sanitize_text_field($theme_options['main_header']);
$main_description = sanitize_text_field($theme_options['main_description']);
$featured_html = $theme_options['featured_html'];
$featured_html_mobile = $theme_options['featured_html_mobile'];
$tooltip_content = $theme_options['tooltip_content'];
?>

<?php 
    $image_array = array(
        get_stylesheet_directory_uri() . '/images/background-1.jpg', 
        get_stylesheet_directory_uri() . '/images/background-2.jpg',
        get_stylesheet_directory_uri() . '/images/background-3.jpg',
        get_stylesheet_directory_uri() . '/images/background-4.jpg',
        get_stylesheet_directory_uri() . '/images/background-5.jpg',
        get_stylesheet_directory_uri() . '/images/background-6.jpg',
 
    );
    shuffle($image_array);
    ?>
        
<script  type="text/javascript">
/*<![CDATA[*/

/* var list   = '<?php echo esc_attr(implode(",", $image_array)); ?>';  */

    var list   = JSON.parse( decodeURIComponent( '<?php
            echo rawurlencode( wp_json_encode( $image_array ) );
        ?>' ) );

    //var images = list.split(',');
    var images = list;
    //preload
    function preloadImage(src) {
        var image = new Image();
        image.src = src;
    }
    for (var i = 0; i < images.length; i++) {
        preloadImage(images[i]);
    }
/*]]>*/
</script>
    <?php while ( have_posts() ) : the_post(); ?>

     <!--"container-wrapper-->
    <div class="container-wrapper">
    
        <!--banner-wrap-->
            <div class="banner-wrap front-page" id="heroimage">
            <?php $i=0; foreach ($image_array as $img) : $i++; 

             

            ?>
                <div class="heroimage-inner <?php echo (intval($i) > 1) ? 'not--first' : 'current'; ?>" id="heroimage-inner-<?php echo intval($i); ?>" style="background-image:url('<?php echo esc_url($img); ?>');" data-previous="<?php echo (intval($i) == 1) ? intval(count($image_array)) : intval($i - 1); ?>" data-next="<?php echo (intval($i) == count($image_array)) ? intval(1) : intval($i + 1); ?>"></div>
            <?php endforeach; ?>

                <div class="wrapper">

            <?php if (! empty($featured_html_mobile) ) : ?>
   
            <?php endif; ?>

         
                <h1 class="mobile-h show-mobile">Your Latest Resources</h1>
                    <!--banner-desc-->
                        <div class="banner-desc show-desktop">
                            <h4> <?php echo esc_html($main_header); ?></h4>
                            <p> <?php echo wp_kses($main_description,apac_allowed_html()); ?></p>
                        </div>
                    <!--banner-desc-->
                    
                    <!--banner-search-->
                        <div class="banner-search show-desktop">
                            <form method="post" action="" id="ams-form">
                                <input type="text" placeholder="What resources are you looking for?" name="ams" id="ams" value="" />
                                <input type="button" id="ams-form-submit" value="Search"/>
                                <div class="banner-search-icon"><i class="fas fa-search"></i></div>
                            </form>
                        </div>
                    <!--banner-search-->
                    
                <?php if (! empty($quick_links) ) : ?>
                    <!--quick-links-->
                        <div class="quick-links show-desktop">
                            <h6> Quick Links: </h6> 
                            <?php echo wp_kses($quick_links,apac_allowed_html());  ?>
                        </div>
                    <!--quick-links-->
                <?php endif; ?>
                    
                </div>
            </div>
        <!--banner-wrap-->
        
        
        <div class="search-row-wrap">
        
            <div class="wrapper">
            
            <?php if (! empty($featured_html) ) : ?>
                <!--info-bar-->
                    <div class="info-bar featured-info-bar show-desktop" id="featured-info-bar">
                        <div class="info-bar-icon"><i class="fa fa-exclamation-circle"></i></div>
                        <div class="info-bar-main">
                            <div class="ibm-cont">
                                <?php echo wp_kses($featured_html,apac_allowed_html()); ?>
                           </div>
                        </div>
                        <div class="info-bar-right">
                            <a href="<?php echo (!empty(esc_url($featured_link))) ? esc_url($featured_link) : '#'; ?>" class="info-box-icon"><i class="icon-view"></i></a>
                            <a id="close-featured-info-bar" class="info-box-icon close-bar"><i class="icon-close"></i></a>
                        </div>
                    </div>
                <!--info-bar-->
            <?php endif; ?>
                
                <!--advanced-search-content-->
                <div class="advanced-search-content">

                     <h6 class="show-desktop">ADVANCED SEARCH <span class="tooltip-circle"><span>i</span></span><div id="tooltip-content" class=""><div class="inner"><h5>Search Tips:</h5><?php echo wp_kses( $tooltip_content, apac_allowed_html() ); ?></div></div></h6>
                    
                    <div class="advanced-search-main custom-chosen-style">

                        <span class="show-mobile">

                            <p class="go-to-desktop">
                                This site is best viewed on desktop devices. In order to use advanced search filters and download assets please view on desktop.
                            </p>

                            <h3 class="h-mobile">
                                <!--Search-->
                            </h3>

                            <div class="mobile-search">
                                <form method="post" action="" id="ams-form-mobile">
                                    <input type="text" placeholder="" name="ams-mobile" id="ams-mobile" value="" />
                                    <input type="button" id="ams-form-submit-mobile" value="Search"/>
                                    <div class="mobile-search-icon"><i class="fas fa-search"></i></div>
                                </form>
                            </div>

                            <div class="advanced-search-col">
                                <label class="sr-only">Select Search Filters</label>
                                <select id="ams__mobile" class="multi-select-all is-mobile" name="mobile[]" multiple="multiple" data-placeholder="Select Filters" style="width:100%;">
                                    <optgroup label="Asset Type">
                                             <option value="asset_type--audio">Audio File</option>
                                                <option value="asset_type--case_study">Case Study</option>
                                                
                                         <option value="asset_type--image">Image / Infograhic</option>
                                        <option value="asset_type--one_pager">One-Pager</option>
                                        <option value="asset_type--presentation">Presentation</option>
                                               <option value="asset_type--video">Video</option>
                                         <option value="asset_type--other_asset">Other</option>
                                    </optgroup>
                                    <optgroup label="Topic">
                                        <option value="topic--economic_recovery">Economic Impact & Recovery</option>
                                        <option value="topic--safety_misinfo">Safety/Misinformation/Elections</option>
                                           <option value="topic--finsafety">Payments/Financial Safety & Inclusion</option>
                                        <option value="topic--privacy">Privacy & Encryption</option>
                                     
                                 
                                    </optgroup>
                                </select>
                            </div>

                        </span>

                            <div class="advanced-search-col show-desktop">
                                <label>Resource Type</label>
                                <select id="ams__asset_type" class="multi-select-all" name="asset_type[]" multiple="multiple" data-placeholder="Select your Resource Type(s)">
                                        <option value="asset_type--audio">Audio File</option>
                                        <option value="asset_type--case_study">Case Study</option>
                                  
                                        <option value="asset_type--image">Image / Infographic</option>
                                        <option value="asset_type--one_pager">One-Pager</option>
                                        <option value="asset_type--presentation">Presentation</option>
                                        <option value="asset_type--video">Video</option>
                                         <option value="asset_type--report">Research/Report</option>
                                        <option value="asset_type--other_asset">Other</option>
                                </select>
                            </div>
                            
                            <div class="advanced-search-col show-desktop">
                                <label>Audience</label>
                                <select id="ams__audience" class="multi-select-all" name="audience[]" multiple="multiple" data-placeholder="Select your Audience(s)">
                           
                                         <option value="audience--community_leaders">Community Leaders</option>
                                          <option value="audience--educators">Educators</option>
                                          <option value="audience--general_public">General Public</option>
                                             <option value="audience--health_profession">Health Professionals</option>
                                    <option value="audience--media">Media</option>
                                      <option value="audience--policy_audience">Policy Audience</option>
                                  
                                        
                                     <option value="audience--small_medium_business">Small & Medium Businesses</option>

                                </select>
                            </div>
                            
                            <div class="advanced-search-col show-desktop">
                                <label>Country</label>
                                <select id="ams__country" class="multi-select-all" name="country[]" multiple="multiple" data-placeholder="Select your Country(ies)">
                                    <option value="country--APAC">APAC</option>
                                    <option value="country--Global">Global</option>                             
                                    <option value="country--Indonesia">Indonesia</option>
                                    <option value="country--LatAM">LATAM</option>
                                     <option value="country--singapore">Singapore</option>
                                </select>
                             </div>
                            
                            <div class="advanced-search-col show-desktop">
                                <label>Language</label>
                                <select id="ams__asset_language" class="multi-select-all" name="asset_language[]" multiple="multiple" data-placeholder="Select your Language(s)">
                                    <option value="asset_language--Bahasa_Indonesia">Bahasa Indonesia</option>
                            
                                    <option value="asset_language--English">English</option>
                                    
                                    <option value="asset_language--Portuguese">Portuguese</option>
                                    <option value="asset_language--Spanish">Spanish</option>
                                   
                                </select>
                            </div>
                            
                            <div class="advanced-search-col show-desktop">
                                <label>Topics</label>
                                <select id="ams__topic" class="multi-select-all" name="topic[]" multiple="multiple" data-placeholder="Select your Topic(s)">
                                    
                                     <option value="topic--economic_recovery">Economic Impact & Recovery</option>
                                        <option value="topic--safety_misinfo">Safety / Misinformation / Elections</option>
                                           <option value="topic--finsafety">Payments / Financial Safety & Inclusion</option>
                                        <option value="topic--privacy">Privacy & Encryption</option>
                                                 <option value="topic--other_topic">Other</option>
                               
                                </select>  
                            </div>

                    </div>
                    
                    <!--advanced-search-bottom-->
                    <div class="advanced-search-bottom has-results-or-no">
                        <!--<div id="search-is-querying" style="width:100%;padding:20px 0;text-align:center"><img src="<?php //echo get_template_directory_uri() . '/images/loading.gif'; ?>" style="width:30px;height:auto;" alt="Results loading" /></div>-->
                        <button type="submit" id="ams-advanced-filters"><span class="show-desktop">Search</span><span class="show-mobile">Apply</span></button>
                        <button type="reset" id="ams-reset-advanced-filters"> <i class="fas fa-times"></i> Reset</button>
                    </div>
                    <!--advanced-search-bottom-->
                    
                </div>
                <!--advanced-search-content-->

                <?php if (! empty($quick_links) ) : ?>
                    <!--quick-links-->
                        <div class="quick-links quick-links-mobile show-mobile">
                            <h6> Quick Links: </h6> 
                            <?php echo wp_kses(Repo_Differentiate_mobile($quick_links),apac_allowed_html()); ?>
                        </div>
                    <!--quick-links-->
                <?php endif; ?>
                
                <!--advanced-search-results-->
                <div class="advanced-search-results has-results-or-no" id="advanced-search-results">
                    
                       <div style="padding-bottom:15px;text-align:center;"><a href="/faq/" style="border-bottom: 1px solid #cd5555;color:#cd5555;">Please ensure you are logged out of all personal Google Drive accounts in order to download any resources</a>
                    </div>
                    
                    <div class="advanced-results-head has-results-or-no">
                        
                        <div class="advanced-results-left show-desktop">
                            <h6 id="search-results-title">Results</h6>
                            <p id="search-results-count"></p>
                        </div>
                        
                        <div class="advanced-results-right custom-chosen-style" id="search-results-sortby">
                            
                            <select class="chosen-select" id="search-results-sortby-select">
                                <option value="alphabetical" selected>Sort: Alphabetically</option>
                                <option value="recent">Sort: Most Recent</option>
                            </select>
                        </div>

                        <div class="legend-home" id="the-legend-wrapper">
                            <div class="the-legend show-desktop" id="the-legend">
                                <div class="col col-left">
                                    <span class="title">Topic:</span>
                                    <ul class="item-list">
                                        <li  class="topic-economic-recovery ams-legend-link dynamic-search-link" id="ams-legend-link-1" data-filters="topic--economic_recovery" data-query="">Economic Impact & Recovery</li>
                                        <li class="topic-finsafety" id="ams-legend-link-2" data-filters="topic--finsafety" data-query="">Financial Safety & Inclusion</li>
                                        <li class="topic-privacy ams-legend-link dynamic-search-link" id="ams-legend-link-3" data-filters="topic--privacy" data-query="">Privacy & Encryption</li>
                                        <li  class="topic-safety-misinfo ams-legend-link dynamic-search-link" id="ams-legend-link-4" data-filters="topic--safety_misinfo" data-query="">Safety / Misinformation / Elections</li>
                                        <li class="topic-other ams-legend-link dynamic-search-link" id="ams-legend-link-5" data-filters="topic--other_topic" data-query="">Other</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    
                    <div class="advanced-search-holder has-results-or-no" id="search-results">


                    <?php 
                            if(!empty($_GET['shared_id'])) {
                                // $encryptedPostId = urldecode($_GET['shared_id']);
                                // $encryptedPostId = "J7xeDbHPjPwfP/3K7hQontkD2CZ26iuH ZURBaWClFig3Z9 AwlzOElg0qVaVmrdTfXIkqh/dhUwEm lUnN4KQ==";
                                $uriSegments = explode("?shared_id=", $_SERVER['REQUEST_URI']);
                                $encryptedPostId = urldecode($uriSegments[1]);
                                $pass = "fbapac@2020";
                                $key = substr(sha1($pass, true), 0, 16);
                                
                                $c = base64_decode($encryptedPostId);
                                $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                                $iv = substr($c, 0, $ivlen);
                                $hmac = substr($c, $ivlen, $sha2len=32);
                                $ciphertext_raw = substr($c, $ivlen+$sha2len);
                                $originalPostId = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                               
                                if($originalPostId){
                                    $shareId = $originalPostId;
                                    // WP_Query arguments
                                    $args = array(
                                        'p'                      => $shareId,
                                        'post_type'              => array( 'fb_assets_wa' ),
                                    );
                                    // The Query
                                    $query = new WP_Query( $args );
                                    // The Loop
                                    if ( $query->have_posts() ) {
                                        while ( $query->have_posts() ) {
                                            $query->the_post();
                                            $the_template_part_path = '/repo/part--post-col-content.php';
                                            include locate_template($the_template_part_path); 
                                        }

                                       
                                    } 
                                    wp_reset_postdata();

                                    
                                }?>
                                <script>
                                jQuery(window).load(function() {
                                    jQuery('html, body').animate({
                                        scrollTop: jQuery("#advanced-search-results").offset().top - 100
                                    }, 75); 
                                });
                                </script>

                                
                           <?php  }
                            ?>
                        <br>
                        
                    </div>

                    <?php    if(!empty($_GET['shared_id'])) {
                                    echo '<p class="add-edit-assets has-results-or-no has--results"> <a href="#heroimage">Click Here</a> to search for more APAC resources. </p>'; 
                                }
                    ?>

                    <p class="add-edit-assets has-results-or-no">Want to add, update or edit your assets? <a href="https://docs.google.com/forms/d/e/1FAIpQLSeM8kpjywsolXW6UFQSMUMxxJetxouArDW3MEm_0IukUWkM-A/viewform" target="_blank">Submit a request</a> </p>
                        
                </div>
                <!--advanced-search-results-->
                
            </div>
        
        </div>
        
    </div>
    <!--container-wrapper-->
    
    
    <?php endwhile; ?>

<?php
get_footer();
