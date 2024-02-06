<?php
$giMeta = get_post_meta($post->ID);
if ($giMeta['gi_global_local'][0] === 'local') {
    wp_safe_redirect(site_url() . '/404');
    exit();
}
get_header();
// Start the Loop.
while (have_posts()) : the_post(); ?>

<?php
    $giHero = unserialize($giMeta['gi_hero'][0]);
    $giHeroImage = wp_get_attachment_url($giHero['image']);
    $giHeroCaption = $giHero['caption'];
    ?>
<section class="hero white" style="background-image:url(<?php echo esc_url($giHeroImage); ?>);">
        <div class="hero-caption">
            <div class="hero-inner">
            <h2><?php echo esc_html($giHeroCaption); ?></h2>
            </div>
        </div>
    </section>

    <?php
    $pullQuoteText = $giMeta['intro_text'][0];

    if (!empty($pullQuoteText)) {
    ?>
    <section class="single-block">
      <div class="container-small">
          <?php echo wp_kses($pullQuoteText,counterspace_allowed_html());?>
        </div>
    </section>

    <?php
    }
    $middleModule = get_post_meta($post->ID, 'middle_module', true);
    $mmbackground_color = $middleModule['middle_background_color'];
    $mmTitle =$middleModule['middle_title'];
    $mmDesc = $middleModule['middle_desc'];

    if (!empty($mmTitle) || !empty($mmDesc)) {
    ?>

    <section class="gray-block"   style="<?php print "background-color:". esc_attr($mmbackground_color); ?>">
      <div class="container-small">
        <?php if($mmTitle) : ?><h2><?php echo  esc_html($mmTitle); ?></h2><?php endif; ?>
        <?php echo wp_kses($mmDesc,counterspace_allowed_html());?>
      </div>
    </section>

  
    <?php

  }
    $twoColmun = get_post_meta($post->ID, 'two_column_module', true);
    $content_col_one = $twoColmun['content_col_one'];
    $content_col_two = $twoColmun['content_col_two'];
    if (!empty($content_col_one) || !empty($content_col_two)) {
    ?>
    <section class="two-col-block-outer">
      <div class="container">
          <div class="two-col-content">
            <div class="two-col-block">
              <?php echo wp_kses($content_col_one,counterspace_allowed_html());?>
            </div>
            <div class="two-col-block">
                <?php echo wp_kses($content_col_two,counterspace_allowed_html());?>
            </div>
        </div>
    </section>

    <?php

  }
    // max parent GI count, not the actual count filtered/queried in getposts


  $featuredCampaigns = get_post_meta($post->ID, 'new_featured_campaigns', true);
  $featuredCampaignLabel = $giMeta['gi_featured_campaign_label'][0];

    if (!empty($featuredCampaignLabel)) {
  ?>
    <section class="description-block">
          <center><h2><?php echo  esc_html($featuredCampaignLabel); ?></h2></center>
        <?php include(locate_template('/page-templates/partials/giCampaigns.php')); ?>
    </section>

  <?php


}
  $winnerBlock = get_post_meta($post->ID, 'three_column_module', true);
  $sectionTitle = $winnerBlock['bottom_section_title'];
  $winnerRepeaters = $winnerBlock['wn_group'];


    if (!empty($sectionTitle)) {

  ?>
<section class="winners">
      <center><h2><?php echo esc_html($sectionTitle); ?></h2></center>
        <div class="container-big">
          <div class="winner-box">
                <?php foreach ($winnerRepeaters as $winner) : 
                    $wnImage = $winner['wn_image'];
                    $wnImage = wp_get_attachment_url($wnImage);
                    $wnTitle = $winner['wn_title'];
                    $wn_url =  $winner['wn_url'];
                    $wnDesc =  $winner['wn_description'];
                ?>
                <div class="winner-box-col">

                  <?php
                  if($wn_url){

                      echo "<a href=\"".esc_url($wn_url)." \">";
                  }
                  ?>
                     <img src="<?php echo esc_url($wnImage); ?>" alt="<?php echo esc_attr($wnTitle); ?>">
                       <?php
                  if($wn_url){

                      print "</a>";
                  }
                  if($wnTitle){
                  ?>  
                     <h4><?php echo esc_html($wnTitle); ?></h4>

                    <?php 
                     }

                     ?>
                     <?php echo wp_kses($wnDesc,counterspace_allowed_html());?>
                </div>
              <?php endforeach; ?>
            </div>
        </div>
    </section>

  <?php
  }
  $giPartnersHeader = $giMeta['gi_partners_header'][0];
  $giPartnersIds = unserialize($giMeta['gi_partner'][0]);
  if (isset($giPartnersIds) && !empty($giPartnersIds)) {
      $giPartners = get_posts(array(
      'posts_per_page' => 1,
      'post_type' => 'cntrspch_partner',
      'post__in' => $giPartnersIds,
      'orderby' => 'post__in',
      'suppress_filters' => false
      ));
      include(locate_template('/page-templates/partials/giPartners.php'));
  }

  ?>

<?php endwhile;
get_footer();

?>