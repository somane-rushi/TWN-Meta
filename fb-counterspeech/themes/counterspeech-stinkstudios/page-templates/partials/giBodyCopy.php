<?php if (isset($bodyCopy) && !empty($bodyCopy)) {
    ?>
  <section class="gray-block">
      <div class="container-small">
          <?php
            $lastBcBlock = null;
    foreach ($bodyCopy as $index=>$contentBlock) {
        if (0 !== $index) {
            echo '<br/>';
        }
        $trigger = $contentBlock['display_if_triggers'];
        switch ($trigger) {
                case 'header':
                echo '<h2>' . esc_html($contentBlock['header']) . '</h2>';
                break;
                case 'paragraph':
                if($contentBlock['content_title']){
                    echo '<h2>'.esc_html($contentBlock['content_title']).'</h2>';
                }
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
                $ctaLink = $contentBlock['cta']['cta_Link'];
                echo '<a href="' . esc_url($ctaLink) . '" target="_blank"><div class="button drop-in">' . esc_html($ctaCopy) . '</div></a>';
                break;
            }
        $lastBcBlock = $trigger;
    } ?>
      </div>
    </section>
<?php
} ?>
