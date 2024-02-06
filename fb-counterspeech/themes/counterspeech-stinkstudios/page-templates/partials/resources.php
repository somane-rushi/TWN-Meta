<div class="resources-section-wrapper">
  <div class="content-wrapper">
    <h2 class="resources-header header-line-left">
      <?php echo esc_html($headerText) ?>
    </h2>
    <div class="resources-section-image mobile">
      <img class="image" src="<?php echo esc_url($resourcesImage) ?>" />
    </div>
    <div class="resources-section">
      <div class="resources-section-copy">
        <p class="resources-copy">
          <?php echo esc_html($sectionCopy) ?>
        </p>
        <a href="<?php echo esc_url(site_url()); ?>/resources/">
          <div class="button-link"><?php echo esc_html($resourcesCTA) ?></div>
        </a>
      </div>

      <div class="resources-section-image">
        <img class="image" src="<?php echo esc_url($resourcesImage) ?>" />
      </div>
    </div>
  </div>
</div>
