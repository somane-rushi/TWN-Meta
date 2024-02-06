
<?php

  if (isset($_GET['contact-form-sent'])) {
      $cfSent = true;
  } else {
      $cfSent = false;
  }

?>

<div class="contact-module-overlay"></div>
<div class="contact-module-wrapper">
  <div class="contact-wrapper">
    <div class="close-cross">
      <div class="close-cross-inner"></div>
    </div>
    <?php if (isset($contactModalTitle) && !empty($contactModalTitle)) {
    ?> <h2> <?php echo esc_html($contactModalTitle); ?> </h2> <?php
        if (isset($contactModalIntro) && !empty($contactModalIntro) && !$cfSent) {
            ?> <p> <?php echo esc_html($contactModalIntro); ?> </p> <?php

        }
}
    ?>
    <?php if ($cfSent && isset($contactModalSuccess) && !empty($contactModalSuccess)) {
        echo esc_html($contactModalSuccess);
    }
            echo do_shortcode($contactFormShortcode);
      ?>
  </div>
</div>
