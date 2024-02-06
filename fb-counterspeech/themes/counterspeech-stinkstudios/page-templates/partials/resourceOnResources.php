<?php
    $resourceDownloads = get_post_meta($resource->ID, 'resource_uploads', true);
?>

<div class="resource-copy">

    <h4 class="resource-title"><?php echo esc_html($resource->post_title) ?></h4>
    <p class="resource-desc small"><?php echo esc_html($resource->short_description) ?></p>
    <li class="resource-item">
        <div class="resource-icon">
            <div>
                <div class="resource-button test">
                    <?php if (!empty($resourceDownloads[0]['resource_website_link'])) : ?>
                    
                    <a target="_blank" href="<?php echo esc_url($resourceDownloads[0]['resource_website_link']); ?>" class="resource-btn">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/dist/assets/link-icon.png"><span><?php echo wp_kses(get_option('cntrspch_label_website_button'),counterspace_allowed_html()); ?></span></a>

                    
                    <?php elseif(!empty($resourceDownloads[0]['resource_file'])) : ?>

                    <a target="_blank" href="<?php echo esc_url(wp_get_attachment_url($resourceDownloads[0]['resource_file'])); ?>" class="resource-btn">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/frontend/dist/assets/download-icon.png"><span><?php echo wp_kses(get_option('cntrspch_link_download_button'),counterspace_allowed_html()); ?></span></a>

                    
                    <?php else : ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </li>
</div>