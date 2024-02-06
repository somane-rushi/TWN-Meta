<?php if (!empty($featuredCampaigns)) {   ?>
    <?php
      foreach ($featuredCampaigns as $campaign) {    
          $image = $campaign['cp_image'];
          $image = wp_get_attachment_url($image);
          $header = $campaign['cp_header'];
          $textcolor = $campaign['cp_header_text_color'];
          $title_info = $campaign['cp_title'];
          $descLeft = $campaign['cp_description_left'];
          $descright = $campaign['cp_description_right'];
          ?>


<img src="<?php echo esc_url($image); ?>" alt="">
          <div class="container-medium">    
          <div class="description-holder">
                <div class="title-box">
                    <h4 style="<?php print "color:". esc_attr($textcolor); ?>"><?php echo esc_html($header); ?></h4>
                    <h3><?php echo esc_html($title_info); ?></h3>
                </div>
                <div class="description-box">
                    <div class="description-box-col">
                        <?php echo wp_kses($descLeft,counterspace_allowed_html()); ?>
                    </div>
                    <?php if($descright) : ?>
                    <div class="description-box-col">
                     <?php echo wp_kses($descright,counterspace_allowed_html()); ?>
                    </div>
                     <?php endif; ?>
                </div>
          </div>
      </div>  
    <?php
      } ?>

   
<?php
} ?>
