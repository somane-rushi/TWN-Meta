<div class="section-wrapper resources">
    <div class="section">
        <h2 class="section-header header-line-left">
            <?php
            echo esc_html($resourceHeader);
            ?>
        </h2>
        <ul class="resources-list">
            <div class="research-icon mobile">
            <?php include(locate_template('/svg-templates/resource-icon.php')); ?>
            </div>
            <?php foreach ($resourcePosts as $resource) {
                $resource = get_post($resource);
                $resourceMeta = get_post_meta($resource->ID);
                $resourceDownloads = get_post_meta($resource->ID, 'resource_uploads', true); ?>
            <?php if (isset($resourceDownloads[0]['resource_file'])) {
                    ?>
            <li class="resource-item">
              <div class="resource-icon">
                <?php include(locate_template('/svg-templates/resource-icon.php')); ?>
              </div>
              <div class="resource-copy">
                <h4 class="resource-title">
                    <?php echo esc_html($resource->post_title) ?>
                </h4>
                <p class="resource-desc small">
                    <?php echo esc_html($resource->short_description) ?>
                </p>
              </div>
              <div class="resource-button">
                <div class="button">
                  <a class="resource-download" <?php if (count($resourceDownloads) === 1) {
                        echo 'href="' . esc_url(wp_get_attachment_url($resourceDownloads[0]['resource_file'])) . '"';
                    } ?> target="_blank">
                    <div class="button-copy"><?php echo esc_html($resourceDownloadCta) ?></div>
                  </a>
                  <a class="button-copy noscript" href="<?php echo esc_url($resourceUrl) ?>" target="_blank">
                    (<?php echo human_filesize(filesize(get_attached_file($resourceDownloads[0]['resource_file']))); ?>)
                  </a>

                  <?php if (count($resourceDownloads) > 1) {
                        ?>
                    <div class="resource-dropdown-button"></div>
                  <?php
                    } ?>
                </div>
              </div>

              <?php if (count($resourceDownloads) > 1) {
                        ?>
                <div class="resource-dropdown">
                  <?php foreach ($resourceDownloads as $resourceDownload) {
                            $resourceUrl = wp_get_attachment_url($resourceDownload['resource_file']);
                            $resourceLanguage = wpcom_vip_get_term_by('slug', $resourceDownload['lang_options'], 'cntrspch_resource_language'); ?>
                  <div class="language-list-item">
                    <a class="button-copy" href="<?php echo esc_url($resourceUrl) ?>" target="_blank">
                      <?php echo esc_html($resourceLanguage->name) ?>
                    </a>
                    <a class="button-copy noscript" href="<?php echo esc_url($resourceUrl) ?>" target="_blank">
                      (<?php echo human_filesize(filesize(get_attached_file($resourceDownload['resource_file']))); ?>)
                    </a>
                  </div>
                  <?php
                        } ?>
                </div>
              <?php
                    } ?>
            </li>
            <?php
                } ?>
          <?php
            } ?>
        </ul>
    </div>
</div>
