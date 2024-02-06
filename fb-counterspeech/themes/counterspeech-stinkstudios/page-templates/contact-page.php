
<?php
  /**
   * Template Name: Contact Page
   *
   */
  // Start the Loop.
  while (have_posts()) : the_post();
  get_header();
?>

  <?php

    $contactPageMeta = get_post_meta($post->ID);
      $contentBlocks = unserialize($contactPageMeta['contact_content_blocks'][0]);
      $contactFormShortcode = $contactPageMeta['contact_contact_form'][0];

      $modalCopy = unserialize($contactPageMeta['contact_modal_content_blocks'][0]);
      $contactModalSuccess = $modalCopy['success'];

      if (isset($_GET['contact-form-sent'])) {
          $cfSent = true;
      } else {
          $cfSent = false;
      }

  ?>

  <div id="contact-page" class="page-wrapper">
    <div class="contact-wrapper">

      <?php
      $lastBlock = null;
      foreach ($contentBlocks as $index => $contentBlock) {
          $trigger = $contentBlock['display_if_triggers'];
          switch ($trigger) {
            case 'header':
              echo '<h2>' . esc_html($contentBlock['header']) . '</h2>';
              break;
            case 'paragraph':
              echo '<p>' . esc_html($contentBlock['paragraph']) . '</p>';
              break;
            case 'image':
              echo '<img src="' . esc_url(wp_get_attachment_url($contentBlock['image'])) . '" />';
              break;
            case 'list':
              $listItems = $contentBlock['list'];
              echo '<ul>';
              foreach ($listItems as $listItem) {
                  $listItem = $listItem['list_item'];
                  echo '<li>' . esc_html($listItem) . '</li>';
              }
              echo '</ul>';
              break;
            case 'cta':
              $ctaCopy = $contentBlock['cta']['cta_copy'];
              $ctaLink = $contentBlock['cta']['cta_link'];
              echo '<a href="' . esc_url($ctaLink) . '" target="_blank"><div class="button drop-in">' . esc_html($ctaCopy) . '</div></a>';
              break;
          }
          $lastBlock = $trigger;
      } ?>
				<div class="contact-form-container">
          <?php if ($cfSent && isset($contactModalSuccess) && !empty($contactModalSuccess)) {
          echo esc_html($contactModalSuccess);
      }
                  echo do_shortcode($contactFormShortcode);
            ?>
				</div>

    </div>
  </div>

<?php
  endwhile;
  get_footer();
?>
