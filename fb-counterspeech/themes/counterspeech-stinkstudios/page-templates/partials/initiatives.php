
<div class="initiatives-wrapper">
  <?php

    foreach ($initiatives as $initiative) {
        $p = get_post($initiative);
        $initiativeUrl = get_permalink($initiative);
        $initiativeDescription = get_post_meta($initiative, 'short_description', true);
        $initiativeIcon = wp_get_attachment_url(get_post_meta($initiative, 'gi_icon', true));
        $initiativeImage = wp_get_attachment_url(get_post_meta($initiative, 'gi_homepage_image', true)); ?>

    <div class="initiative-short-tile">
      <div class="initiative-tile image">
        <img src="<?php echo esc_url($initiativeImage); ?>"/>
      </div>

      <div class="initiative-tile copy">
          <img class="initiative-tile-icon" src="<?php echo esc_url($initiativeIcon) ?>" />
        <h4 class="initiative-tile-title">
          <?php echo esc_html($p->post_title) ?>
        </h4>
        <p class="initiative-tile-copy">
          <?php echo esc_html($initiativeDescription) ?>
        </p>
        <a class="initiative-button" href="<?php echo esc_url($initiativeUrl) ?>">
          <div class="button-link"><?php echo esc_html($initiativeCTA) ?></div>
        </a>
      </div>
    </div>

  <?php
    } ?>
</div>
