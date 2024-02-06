<?php foreach ($giPartners as $giPartner) {
    
    $giPartnerMeta = get_post_meta($giPartner->ID);
    $giPartnerMeta2 = get_post_meta($giPartner->ID, 'partner_group_module', true);
    $backColor = ($giPartnerMeta2['short_description_backcolor']) ? 'style="background:'.$giPartnerMeta2['short_description_backcolor'].'"' : '';

    if(!empty($giPartnersIds)) { ?>

 <section class="bottom-gray-block evp-section" <?php echo esc_attr($backColor); ?>>

      <div class="container-small">
          <center><a class="evp-logo" href="<?php echo esc_url($giPartnerMeta['partner_url'][0]) ?>"><img src="<?php echo esc_url(wp_get_attachment_url($giPartnerMeta['partner_logo'][0])); ?>" alt=""></a></center>
        
            <p><?php echo wp_kses($giPartnerMeta2['short_description'], counterspace_allowed_html()); ?></p>
            
            <?php if ($giPartnerMeta['partner_cta_label'][0]) : ?>
            <center><a target="_blank"><a href="<?php echo esc_url($giPartnerMeta['partner_url'][0]) ?>" class="btn"><?php echo esc_html($giPartnerMeta['partner_cta_label'][0]); ?></a></center>
            <?php endif; ?>

            <?php if ($giPartnerMeta['partner_cta_label2'][0]) : ?>
            <center><a target="_blank"><a href="<?php echo esc_url($giPartnerMeta['partner_url2'][0]) ?>" class="btn"><?php echo esc_html($giPartnerMeta['partner_cta_label2'][0]); ?></a></center>
            <?php endif; ?>

            <?php if ($giPartnerMeta['partner_cta_label3'][0]) : ?>
            <center><a target="_blank"><a href="<?php echo esc_url($giPartnerMeta['partner_url3'][0]) ?>" class="btn"><?php echo esc_html($giPartnerMeta['partner_cta_label3'][0]); ?></a></center>
            <?php endif; ?>
        </div>
    </section>
<?php

	}
} ?>