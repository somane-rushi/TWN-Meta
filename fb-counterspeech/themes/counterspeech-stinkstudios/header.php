<?php

  // retreive the latest build hashed file from the manifest json file.
  // the wpcom_vip_file_get_contents() function broke our develop remote site so we removed it
$jsonString = file_get_contents(get_template_directory() ."/frontend/dist/js/asset-manifest.json");
$json_manifest = json_decode($jsonString, true);

$DEPLOY_BUNDLE = $json_manifest['main.js'];
  // to bust the css cache we just use the same hash from the js file.
  // new deploy of js file new and same hash value for css as well:
$JS_HASH = explode('.', $DEPLOY_BUNDLE)[2];

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- OG Tags -->
  <?php
  $ogUrl = get_permalink();
  $post_meta_tags = array();

  if (! empty($post->ID)) {
      $post_meta_tags = get_post_meta($post->ID, 'meta_tags', true);
  }

  $ogImage = get_post_meta($post->ID, 'meta_tags', true)['image'];
  ?>

  <?php if (isset($ogUrl) && !empty($ogUrl)) {
      ?>
  <meta property="og:url" content="<?php echo esc_url($ogUrl); ?>">
  <?php
  } ?>
  <?php if (isset($post_meta_tags['title']) && !empty($post_meta_tags['title'])) {
      ?>
  <meta property="og:title" content="<?php echo esc_attr($post_meta_tags['title']); ?>">
  <?php
  } ?>
  <?php if (isset($post_meta_tags['description']) && !empty($post_meta_tags['description'])) {
      ?>
  <meta property="og:description" content="<?php echo esc_attr($post_meta_tags['description']); ?>">
  <?php
  } ?>
  <?php if (isset($post_meta_tags['image']) && !empty($post_meta_tags['image'])) {
      ?>
  <meta property="og:image" content="<?php echo esc_attr(wp_get_attachment_url($post_meta_tags['image'])); ?>">
  <?php
  } ?>

  <!-- end og tags -->

  <meta name="fulljs"  content=<?php echo esc_html(get_stylesheet_directory_uri().(WP_DEBUG ? "/frontend/public/js/bundle.js" : "/frontend/dist/js/".$DEPLOY_BUNDLE)); ?>>
  <link rel="shortcut icon" href=<?php echo esc_url(get_stylesheet_directory_uri()."/frontend/public/assets/favicon.ico"); ?> >

  <?php
  wp_head();
  ?>

  <?php
  $bundle = 'bundle.min.js';
    // Checking if WP_DEBUG is true to run the non mininified version.
  if (WP_DEBUG === true) {
      $bundle = 'bundle.js';
  }
 $criticalJavascriptPath = '/script-templates/' . $bundle;

 ?>

 <script type="text/javascript">
   window.cpsch = {};
   window.cpsch.sDir = '<?php echo esc_url(get_template_directory_uri()); ?>';
   window.cpsch.siteUrl = '<?php echo esc_url(site_url()); ?>';
   new function() { <?php include(locate_template($criticalJavascriptPath)) ?> };
 </script>

 <?php
  // Checking if WP_DEBUG is true to run live reload
 if (WP_DEBUG === true) {
     echo '<script src="http://localhost:9091"></script>';
 }
?>

<?php
  // render the additional no script css file on no js machines.
?>

<script type="text/javascript">
  // Add the show class for unQualified browsers - 'Cutting the Mustard'
  // So we show the content as fast as possible. Minimal styling will be loaded later
  if( !('querySelector' in document) || (window.CustomEvent === undefined)) {
    document.documentElement.className = 'feature-phone ' + document.documentElement.className;
  }
</script>

<style>
  /*html { opacity: 0; visibility: hidden; }*/
  html { opacity: 1; visibility: visible; }
</style>

<!-- no-script css handle -->
<?php $noscriptCss = WP_DEBUG ? "/frontend/public/css/app-noscript.css" : "/frontend/dist/css/app-noscript.min.css"; ?>

<noscript>
  <!-- Include the noscript css for browsers with no JavaScript -->
  <style>
    html { opacity: 1; visibility: visible; }
    <?php echo esc_html(include(locate_template($noscriptCss))); ?>
  </style>
</noscript>

<!-- GA -->
<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-93254506-3', 'auto');

  ga('send', 'pageview');

</script>
<!-- /GA -->

</head>
<body class="header-not-sticky" >

  <?php

  $regionsAndCountries = regionsAndCountries();

  $initiatives = get_posts(array(
    'post_type' => 'cntrspch_gi',
    'posts_per_page' => 50,
    'suppress_filters' => false,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'meta_key' => 'gi_global_local',
    'meta_value' => 'global'
    ));

    ?>

  <div class="header-close-overlay"></div>

  <header class="top-header-wrapper">
      <div class="top-container-big clear">
          <a class="logo" href="<?php echo esc_url(site_url()); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/dist/assets/facebook-logo.svg" alt="Facebook Counterspeech" class="logo-svg"></a>
          
        
        </div>
    </header>




  <header class="header-section header-wrapper header-not-sticky">
      <div class="container-big clear">

                  <a class="counterspeech-logo" href="<?php echo esc_url(site_url()); ?>"><img src="<?php echo wp_kses(get_option('cntrspch_png'),counterspace_allowed_html()); ?>" alt="Facebook Counterspeech" class="counterspeech-logo-svg"></a>

          <div class='burger-container'>

          <div class="burger">
            <span class="burger-inner top"></span>
            <span class="burger-inner center"></span>
            <span class="burger-inner bottom"></span>
          </div>
        </div>
            <div class="header-right desktop-show">
              <div class="top-nav">
                    <ul>
                        <li class="haschild"><a href="#"><?php echo wp_kses(get_option('cntrspch_label_initiatives'),counterspace_allowed_html()); ?></a>
                          <ul>
                                 <?php foreach ($initiatives as $initiative) { ?>
                            <li class="list-item">
                              <a class="header-copy initiative-options <?php echo esc_attr(substr(get_permalink($initiative->ID), -10, -1)); ?>" href="<?php echo esc_url(get_permalink($initiative->ID)); ?>">
                                <?php echo esc_html($initiative->post_title); ?>
                              </a>
                            </li>
                            <?php } ?>
                            </ul>
                        </li>
                        <li><a href="<?php echo esc_url(site_url() . '/resources/'); ?>"><?php echo esc_html(get_the_title(wpcom_vip_get_page_by_path('resources'))); ?></a></li>
                    </ul>
              
                </div>
            </div>



             <div class="header-right mobile-show">
              <div class="top-nav">
                  
                          <ul>
                                 <?php foreach ($initiatives as $initiative) { ?>
                            <li class="list-item">
                              <a class="header-copy initiative-options <?php echo esc_attr(substr(get_permalink($initiative->ID), -10, -1)); ?>" href="<?php echo esc_url(get_permalink($initiative->ID)); ?>">
                                <?php echo esc_html($initiative->post_title); ?>
                              </a>
                            </li>
                            <?php } ?>

                                <li><a href="<?php echo esc_url(site_url() . '/resources/'); ?>"><?php echo esc_html(get_the_title(wpcom_vip_get_page_by_path('resources'))); ?></a></li>
                            </ul>
                        
                    
                 
              
                </div>
            </div>




        </div>    </header>