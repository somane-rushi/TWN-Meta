<?php
  /**
   * Template Name: Resources Page
   *
   */
  // Start the Loop.
  while (have_posts()) : the_post();
  get_header();
?>

<?php

    $resourcePageMeta = get_post_meta($post->ID);
    $mastheadImage = wp_get_attachment_url($resourcePageMeta['resource_masthead_image'][0]);
    $mastheadText = $resourcePageMeta['resource_masthead_text'][0];
    $mastheadCaption = $resourcePageMeta['resource_masthead_caption'][0];
    $resourceSectionTitle = $resourcePageMeta['resource_section_title'][0];
    $researchSectionTitle = $resourcePageMeta['research_section_title'][0];
    $toolkitsSectionTitle = $resourcePageMeta['toolkits_section_title'][0];

    $guideSectionBgcolor = ($resourcePageMeta['guide_section_bgcolor'][0]) ? $resourcePageMeta['guide_section_bgcolor'][0] : '#fff';
    $researchSectionBgcolor = ($resourcePageMeta['research_section_bgcolor'][0]) ? $resourcePageMeta['research_section_bgcolor'][0] : '#fff';
    $tookitsSectionBgcolor = ($resourcePageMeta['toolkits_section_bgcolor'][0]) ? $resourcePageMeta['toolkits_section_bgcolor'][0] : '#fff';

    $downloadCta = $resourcePageMeta['download_cta'][0];

        // max possible resource count not the actual amount
        // to be returned with the respective queries in $resourcePosts and $researchPosts
        // $resourceCount = wp_count_posts('cntrspch_resource')->publish;

    $resourcePosts = get_posts(array(
      'post_type' => 'cntrspch_resource',
      'orderby' => 'menu_order',
      'posts_per_page' => 50,
      'suppress_filters' => false,
      'order' => 'ASC',
      'meta_query' => array(
      'relation' => 'AND',
        array(
        'key' => 'resource_type',
        'value' => 'resource',
        'compare' => '='
        ),
        array(
        'key' => 'resource_display_on_resources',
        'value' => 'yes',
        'compare' => '='
        )
      )
    ));

    $researchPosts = get_posts(array(
      'post_type' => 'cntrspch_resource',
      'orderby' => 'menu_order',
      'posts_per_page' => 50,
      'suppress_filters' => false,
      'order' => 'ASC',
      'meta_query' => array(
      'relation' => 'AND',
        array(
        'key' => 'resource_type',
        'value' => 'research',
        'compare' => '='
        ),
        array(
        'key' => 'resource_display_on_resources',
        'value' => 'yes',
        'compare' => '='
        )
      )
    ));


    $tookitsPosts = get_posts(array(
      'post_type' => 'cntrspch_resource',
      'orderby' => 'menu_order',
      'posts_per_page' => 50,
      'suppress_filters' => false,
      'order' => 'ASC',
      'meta_query' => array(
      'relation' => 'AND',
        array(
        'key' => 'resource_type',
        'value' => 'toolkits',
        'compare' => '='
        ),
        array(
        'key' => 'resource_display_on_resources',
        'value' => 'yes',
        'compare' => '='
        )
      )
    ));
?>

<section class="hero white" style="background-image:url(<?php echo esc_url($mastheadImage); ?>);">
   <div class="hero-caption">
      <div class="hero-inner">
         <h2><?php echo esc_html($mastheadText); ?></h2>
      </div>
   </div>
</section>

<div id="resources-page" class="page-wrapper">
   <!--Resources Section-->

   <div class="resources-wrapper" style="background-color:<?php echo esc_attr($guideSectionBgcolor); ?>;">

      <div class="content-wrapper">
         <h2 class="section-header header-line-left resource-header-text"  ><?php the_title(); ?></h2>
         <div class="resource-section-wrap resource-header-text" >
            <?php $text = get_post_meta($post->ID, 'resources_intro_text', true); ?>
            <p><?php echo esc_html($text) ?></p>
         </div>
         <h2 class="section-header header-line-left" ><?php echo esc_html($resourceSectionTitle) ?></h2>
         <ul class="resources-list">
            <?php foreach( $resourcePosts as $resource ) {
               $resourceType = 'resource'; 
               include(locate_template('/page-templates/partials/resourceOnResources.php'));
               } ?>
         </ul>
      </div>
   </div>
   <!--Research Section-->

   <div class="research-wrapper" style="background-color:<?php echo esc_attr($researchSectionBgcolor); ?>;">

      <div class="content-wrapper" >
         <h2 class="section-header header-line-left" ><?php echo esc_html($researchSectionTitle) ?></h2>
         <ul class="research-list">
            <?php foreach( $researchPosts as $resource ) {
               $resourceType = 'research'; 
               include(locate_template('/page-templates/partials/resourceOnResources.php'));
               }
               ?>
         </ul>
      </div>
   </div>
   <!--Toolkits Section-->

   <div class="research-wrapper" style="background-color:<?php echo esc_attr($tookitsSectionBgcolor); ?>; padding-bottom:25px;">
      <div class="content-wrapper" >
         <h2 class="section-header header-line-left" ><?php echo esc_html($toolkitsSectionTitle); ?></h2>

         <ul class="research-list">
            <?php foreach( $tookitsPosts as $resource ) {
               $resourceType = 'toolkits'; 
               include(locate_template('/page-templates/partials/resourceOnResources.php'));
               }
               ?>
         </ul>
      </div>
   </div>
</div>

<?php
  get_footer();
  endwhile;
?>