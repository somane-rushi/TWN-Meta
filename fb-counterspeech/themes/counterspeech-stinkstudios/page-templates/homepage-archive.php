<?php
/**
 * Template Name: Homepage Archive
 */
// Start the Loop.
while (have_posts()) : the_post();
    get_header();
    ?>
    <div id="home-page" class="page-wrapper">
      <?php
      $heroImages = get_post_meta($post->ID, 'hero_repeater_with_text', true);
        include(locate_template('/page-templates/partials/homepage-masthead.php'));

      $introText = get_post_meta($post->ID, 'home_intro_text', true);
      if (isset($introText) && !empty($introText)) {
          ?>
        <div class="top-row-copy-wrapper">
            <div class="top-row-copy">
                <?php
                foreach ($introText as $index=>$introParagraphBlock) {
                    if (0 !== $index) {
                        echo '<br/>';
                    }
                    echo '<p>' . esc_html($introParagraphBlock['text']) . '</p>';
                } ?>
            </div>
        </div>
      <?php 
      }
      $homeMap = get_post_meta($post->ID, 'home_map', true);
        $mobileCountries = $homeMap['mobile_countries'];
        $mobileCarouselHeader = $homeMap['mobile_carousel_header'];
        $introText = $homeMap['intro_text'];
        $explainerText = $homeMap['explainer_text'];
        include(locate_template('/page-templates/partials/map-segment.php'));
        $homeEmphasisText = get_post_meta($post->ID, 'home_header_text', true);
        $headingText = $homeEmphasisText['heading_text'];
        $explainerText = $homeEmphasisText['text'];
        include(locate_template('/page-templates/partials/unformattedTextWithHeader.php'));

       $initiatives = get_post_meta($post->ID, 'home_initiatives', true);
       $initiativeCTA = get_post_meta($post->ID, 'initiative_cta', true);
       include(locate_template('/page-templates/partials/initiatives.php'));

       $homeResources = get_post_meta($post->ID, 'home_resources', true);
        $headerText = $homeResources['header_text'];
        $sectionCopy = $homeResources['section_copy'];
        $resourcesCTA = $homeResources['resources_cta'];
        $resourcesImage = wp_get_attachment_url($homeResources['resources_image']);
        include(locate_template('/page-templates/partials/resources.php'));

      $contactModule = get_post_meta($post->ID, 'homepage_contact_module', 'normal');
      include(locate_template('/page-templates/partials/contactCTA.php'));
      ?>
    </div>
    <?php
    get_footer();
endwhile;
?>