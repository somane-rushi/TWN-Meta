<?php
$contactOnOff = $contactModule['on_off'];
$defaultContactPage = wpcom_vip_get_page_by_path('contact');
  $contactPageMeta = get_post_meta($defaultContactPage->ID);

  $modalCopy = unserialize($contactPageMeta['contact_modal_content_blocks'][0]);
  $contactLeadIn = $modalCopy['intro_copy'];
  $contactButtonCopy = $modalCopy['button_copy'];
  $contactModalIntro = $modalCopy['text'];
  $contactModalTitle = $modalCopy['header'];
  $contactModalSuccess = $modalCopy['success'];
  $contactFormShortcode = $contactPageMeta['contact_contact_form'][0];

//check if enabled on page
if ('yes' === $contactOnOff) {
    ?>
  <div class="section-wrapper contact">
    <div class="section">
      <h3><?php echo esc_html($contactLeadIn) ?></h3>
      <a class="button-wrapper" href="<?php echo esc_url(site_url()); ?>/contact/">
        <div class="button invert" id="contact-module"><?php echo esc_html($contactButtonCopy) ?></div>
      </a>
    </div>
  </div>

  <div class="contact-module-container">
    <?php
      include(locate_template('/page-templates/partials/contact-module.php'))
    ?>
  </div>

<?php 
} ?>
