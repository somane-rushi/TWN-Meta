<?php

  // this is the
  $initiativePost = get_post($initiativeID);
  $initiativeMeta = get_post_meta($initiativeID);
  $globalLocal = isset($initiativeMeta['gi_global_local'][0])? $initiativeMeta['gi_global_local'][0] : false;
  $mediumDescription = unserialize($initiativeMeta['medium_description'][0]);
  $initiativeIcon = wp_get_attachment_url($initiativeMeta['gi_icon'][0]);
  $initiativeIllustration = wp_get_attachment_url($initiativeMeta['gi_illustration'][0]);
  $linkToGi = get_permalink($initiativePost);
  $localizedDescriptions = unserialize($initiativeMeta['gi_localized_descriptions'][0]);

  $localizedDescription = null;
  foreach ($localizedDescriptions as $ld) {
      $countryId = (int)$ld['country_localization']['country'];
      if ($countryId === $post->ID) {
          $localizedDescription = $ld['country_localization']['description'];
          break;
      }
  }
  $paragraphBlocks = null;
  if (isset($localizedDescription)) {
      $paragraphBlocks = $localizedDescription;
  } else {
      $paragraphBlocks = $mediumDescription;
  }
  ?>

<div class="section-wrapper initiative <?php if (!isset($initiativeIllustration) || empty($initiativeIllustration)) {
      echo esc_html("no-img");
  } ?>">
  <div class="section">
    <h2 class="section-header header-line-left"><?php echo esc_html($initiativePost->post_title) ?></h2>
    <div class="initiative-content">
      <div class="initiative-copy">
        <?php
          foreach ($paragraphBlocks as $index=>$paragraphBlock) {
              echo '<p class="description">' . esc_html($paragraphBlock['paragraph']) . '</p>';
              if (count($paragraphBlocks) !== ($index+1)) {
                  echo '<br/>';
              }
          }
          ?>
        <?php if (isset($linkToGi) && $globalLocal != 'local') {
              ?>
          <a href="<?php echo esc_url($linkToGi); ?>">
            <div class="button">
              <?php if ('' !== $initiativeHeaderCtaCopy) {
                  ?>
                <?php echo esc_html($initiativeHeaderCtaCopy); ?>
              <?php
              } else {
                  ?>

              <?php
              } ?>
            </div>
          </a>
        <?php
          } ?>
      </div>
      <?php if (isset($initiativeIllustration) && !empty($initiativeIllustration)) {
              ?>
      <div class="initiative-image">
          <img src="<?php echo esc_url($initiativeIllustration); ?>"/>
      </div>
      <?php
          } ?>
    </div>
  </div>
</div>

<?php
if (count($childCampaigns) > 0) {
              ?>
<div class="section-wrapper case-studies">
  <div class="section campaign">

    <?php

      foreach ($childCampaigns as $childCampaign) {
          $childCampaignPost = get_post($childCampaign);
          $childCampaignMeta = get_post_meta($childCampaign->ID);
          $title = $childCampaignPost->post_title;
          $locale = $childCampaignMeta['campaign_locale'][0];
          $facebookUrl = $childCampaignMeta['campaign_video'][0];
          $imageAndCaption = unserialize($childCampaignMeta['campaign_image'][0]);
          $image = $imageAndCaption['image'];
          $image = wp_get_attachment_url($image);
          $caption = $imageAndCaption['caption'];
          $contentBlocks = unserialize($childCampaignMeta['campaign_description'][0]);
          $ctaMobileDescription = $childCampaignMeta['campaign_mobile_cta_description'][0];
          $ctaCopyAndLink = unserialize($childCampaignMeta['campaign_cta'][0]);
          $ctaCopy = $ctaCopyAndLink['cta_copy'];
          $ctaLink = $ctaCopyAndLink['cta_link']; ?>

    <div class="campaign-wrapper">
      <h3 class="campaign-title"><?php echo esc_html($title) ?></h3>
      <div class="campaign-subhead">
        <?php if (!empty($initiativeIcon)) {
              ?>
          <img class="campaign-icon" src="<?php echo esc_url($initiativeIcon) ?>" />
        <?php
          } ?>

        <div class="campaign-subhead-copy-wrapper">
          <?php if (isset($featuredCampaignLabel) && !empty($featuredCampaignLabel)) {
              ?>
            <h5 class="campaign-subhead-title featured"><?php echo esc_html($featuredCampaignLabel) ?></h5>
          <?php
          } ?>
          <h5 class="campaign-subhead-title"><?php echo esc_html($locale) ?></h5>
        </div>

      </div>
      <?php if (isset($facebookUrl) && !empty($facebookUrl)) {
              ?>
        <div class="video-container">
          <div class="fb-video" data-href="<?php echo esc_url($facebookUrl) ?>" data-show-text="false"></div>
        </div>
      <?php
          } elseif (isset($image) && !empty($image)) {
              ?>
        <div class="campaign-image resize-image">
          <img src="<?php echo esc_url($image) ?>" />
        </div>
      <?php
          } ?>
      <div class="campaign-subhead mobile">
        <?php if (!empty($initiativeIcon)) {
              ?>
          <img class="campaign-icon" src="<?php echo esc_url($initiativeIcon) ?>" />
        <?php
          } ?>
        <?php if (isset($featuredCampaignLabel) && !empty($featuredCampaignLabel)) {
              ?>
          <h5 class="campaign-subhead-title featured"><?php echo esc_html($featuredCampaignLabel) ?></h5>
        <?php
          } ?>
        <h5 class="campaign-subhead-title"><?php echo esc_html($locale) ?></h5>
      </div>
      <div class="campaign-sub-wrapper">
        <div class="campaign-copy-wrapper">
          <?php foreach ($contentBlocks as $index => $contentBlock) {
              $trigger = $contentBlock['display_if_triggers'];
              switch ($trigger) {
                case 'header':
                  echo '<h2>' . esc_html($contentBlock['header']) . '</h2>';
                  break;
                case 'paragraph':
                  echo '<p>' . esc_html($contentBlock['paragraph']) . '</p>';
                  break;
              }
          } ?>
            <p><?php echo esc_html($ctaMobileDescription) ?></p>
          <?php
          if (isset($ctaCopy) && !empty($ctaCopy)) {
              ?>
            <a href="<?php echo esc_url($ctaLink) ?>" target="_blank">
              <div class="button"><?php echo esc_html($ctaCopy) ?></div>
            </a>
          <?php

          } ?>
        </div>
        <div class="campaign-data-wrapper">
          <?php
            $dataPoints = unserialize($childCampaignMeta['campaign_data_points'][0]);
          foreach ($dataPoints as $dataPoint) {
              $point = $dataPoint['data_point'];
              $label = $dataPoint['data_label']; ?>
                <div class="campaign-data">
                  <div class="campaign-data-point"><?php echo esc_html($point) ?></div>
                  <p class="campaign-data-copy"><?php echo esc_html($label) ?></p>
                </div>
          <?php
          } ?>
        </div>
        <?php if (isset($ctaMobileDescription) && !empty($ctaMobileDescription)) {
              ?>
          <p class="campaign-learn-more mobile"><?php echo esc_html($ctaMobileDescription) ?></p>
        <?php
          } ?>
        <?php if (isset($ctaCopy) && !empty($ctaCopy)) {
              ?>
          <a href="<?php echo esc_url($ctaLink) ?>" target="_blank">
            <div class="button mobile"><?php echo esc_html($ctaCopy) ?></div>
          </a>
        <?php
          } ?>
      </div>
    </div>

    <?php
      } ?>

    </div>
  </div>
  <?php

          }
  ?>
