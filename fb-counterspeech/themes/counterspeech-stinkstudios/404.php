<?php
// first it checks to make sure you're the 404 URL and if not redirects there, just for consistency
// we'll do away with this if it turns out FB doesn't care if the URL contains the mis-typed
// full path. i.e. 'counterspeech.org/en/somethingthatdoesntexist'

$baseSiteUrl = site_url();


$requestedRelativeUrl = esc_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
$fourOhFourUrl = $baseSiteUrl . '/404';
$expectedUrl = substr($fourOhFourUrl, -(strlen($requestedRelativeUrl)));

if ($expectedUrl === $requestedRelativeUrl) {
    // do nothing
} else {
    wp_safe_redirect($fourOhFourUrl);
    exit();
}

// grabs the 404 page content from the 404 template set up in "pages"
$page = wpcom_vip_get_page_by_title('404');
$post = get_post($page->ID);
$title = get_the_title($post);
$contentBlocks = get_post_meta($post->ID, 'four_oh_four_content_blocks', true);

get_header();

?>

<div id="fourohfour-page" class="page-wrapper">

  <h2 class="header-line-left"><?php echo esc_html($title) ?></h2>
  <?php
  $lastBlock = null;
  if (is_array($contentBlocks)) {
      foreach ($contentBlocks as $index => $contentBlock) {
          if (0 !== $index) {
              echo '<br/>';
          }
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
      }
  } ?>
  <a href="/">
    <div class="btn" style="max-width:213px;"><?php $ctaCopy = get_post_meta($post->ID, 'four_oh_four_cta', true); echo esc_html($ctaCopy); ?></div>
  </a>

</div>


<?php
get_footer();

?>
