<?php
get_header();
// Start the Loop.

while ( have_posts() ) : the_post();
?>

<?php
$countryMeta = get_post_meta( $post->ID );
?>

<div id="country-page" class="page-wrapper">

  <?php
  // masthead
  $altIntro = $countryMeta['country_hero_title'][0];
  $mastheadText = !empty( $altIntro ) ? $altIntro : $post->post_title;
  $countryLatLng = unserialize( $countryMeta['latitude_and_longitude'][0] );
  $countryCode = $countryLatLng['country_code'];
  $countryLng = $countryLatLng['latitude'];
  $countryLat =$countryLatLng['longitude'];
  include(locate_template('/page-templates/partials/country-masthead.php'));

  // intro text
  $text = $countryMeta['intro_text_block'][0];
  include(locate_template('/page-templates/partials/unformattedText.php'));

  // initiatives and campaign children
  $initiativeHeaderCtaCopy = $countryMeta['initiative_header_cta_copy'][0];
  $initiatives = unserialize( $countryMeta['country_sibling_gi'][0] );
  $featuredCampaignLabel = $countryMeta['country_featured_campaign_label'][0];

  // max campaign count, not the actual count filtered/queried in getposts
  // $campaignCount = wp_count_posts('cntrspch_campaign')->publish;

  foreach( $initiatives as $initiativeID ) {
        // grabbing campaigns that are BOTH the child of this initiative AND the current country
    $childCampaigns = get_posts(array(
      'post_type' => 'cntrspch_campaign',
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'posts_per_page' => 200,
      'suppress_filters' => false,
      'meta_query' => array(
        array(
          'key' => 'campaign_parent_gi',
          'value' => $initiativeID
          ),
        array(
          'key' => 'campaign_parent_country',
          'value' => $post->ID
          ),
        ),
      ) );
        // inside this template should be all of the logic and markup for a single initiative and its campaigns for a country
    include(locate_template('/page-templates/partials/countryInitiativesAndCampaigns.php'));
  }

  $resourcePosts = unserialize( $countryMeta['country_resource'][0] );
  if( count($resourcePosts) > 0 ){
    $resourceHeader = $countryMeta['country_resource_header'][0];
    $resourceDownloadCta = $countryMeta['country_resource_cta'][0];
    include(locate_template('/page-templates/partials/countryResources.php'));
  }

  $countryPartnersHeader = $countryMeta['country_partners_header'][0];
  $countryPartners = unserialize( $countryMeta['country_partner'][0] );
  if( count($countryPartners) > 0 ){
    include(locate_template('/page-templates/partials/countryPartners.php'));
  }

  $contactModule = unserialize( $countryMeta['country_contact_module'][0] );
  include(locate_template('/page-templates/partials/contactCTA.php'));
  ?>

</div>

<?php endwhile;

get_footer(); ?>
