<div class="section-wrapper partners">
  <div class="section">
    <h2 class="section-header header-line-left"><?php echo esc_html($countryPartnersHeader); ?></h2>
    <div class="partner-container">
      <?php foreach ($countryPartners as $countryPartner) {
    $countryPartnerMeta =  get_post_meta($countryPartner); ?>
        <div class="partner-wrapper">
            <a class="large-image" href="<?php echo esc_url($countryPartnerMeta['partner_url'][0]); ?>" target="_blank">
                <img class="image" src="<?php echo esc_url(wp_get_attachment_url($countryPartnerMeta['partner_logo'][0])); ?>" />
            </a>
            <a href="<?php echo esc_url($countryPartnerMeta['partner_url'][0]); ?>" target="_blank" class="partner-link">
              <?php echo esc_url($countryPartnerMeta['partner_url'][0]); ?>
            </a>
        </div>
      <?php 
} ?>
    </div>
  </div>
</div>
