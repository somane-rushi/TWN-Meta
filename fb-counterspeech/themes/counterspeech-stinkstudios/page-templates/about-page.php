<?php
/**
 * Template Name: About Page
 *
 */
// Start the Loop.
while (have_posts()) : the_post();
    get_header();
    $aboutPageMeta = get_post_meta($post->ID);
      $mastheadImage = wp_get_attachment_url($aboutPageMeta['about_masthead_image'][0]);
      $mastheadText = $aboutPageMeta['about_masthead_text'][0];
      $mastheadCaption = $aboutPageMeta['about_masthead_caption'][0];
      $contentBlocks = unserialize($aboutPageMeta['about_content_blocks'][0]);
    ?>

    <div id="about-page" class="page-wrapper">

      <div class="masthead">
        <div class="image resize-image masthead-image-container">
          <div class="overlay"></div>
          <img src="<?php echo esc_url($mastheadImage); ?>" />
        </div>
        <div class="masthead-copy-wrapper">
          <h1 class="masthead-copy">
            <?php echo esc_html($mastheadText); ?>
          </h1>
          <div class="masthead-caption-wrapper">
            <span class="masthead-caption">
              <?php echo esc_html($mastheadCaption); ?>
            </span>
          </div>
        </div>
      </div>

      <div class="about-wrapper">
        <div class="content-wrapper">

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

        </div>
      </div>
      <?php
      $contactModule = unserialize($aboutPageMeta['about_contact_module'][0]);
      include(locate_template('/page-templates/partials/contactCTA.php'));
      ?>
    </div>


<?php
  endwhile;
  get_footer();
?>
