<?php
/**
 * Template Name: Homepage
 *
 */
// Start the Loop.

while (have_posts()) : the_post(); ?>

<?php if(post_password_required()) : ?>
    <section class="single-block">
        <div class="container-small">

                    <?php echo wp_kses(get_the_password_form(),counterspace_allowed_html()); ?>
       
        </div>
    </section>
<?php else : ?>

    get_header();
	$homePageMeta = get_post_meta($post->ID, 'home_hero_module', true);
	$mastheadImage = wp_get_attachment_url($homePageMeta['hero_image_new']);
	$mastheadText = $homePageMeta['hero_title'];
	$mastheadCaption = $homePageMeta['hero_caption'];
	$mastheadCTAText = $homePageMeta['hero_btn_text'];
    $mastheadLink = $homePageMeta['hero_btn_link'];

    ?>
  
	<section class="hero" style="background-image:url(<?php echo esc_url($mastheadImage); ?>);">
		<div class="hero-caption">
			<div class="hero-inner">
			<?php if($mastheadText) : ?><h2><?php echo esc_html($mastheadText); ?></h2><?php endif; ?>
			<?php if($mastheadCaption) : ?><p><?php echo esc_html($mastheadCaption); ?></p><?php endif; ?>
			<?php if($mastheadCTAText) : ?><a href="<?php echo esc_url($mastheadLink); ?>" class="btn"><?php echo esc_html($mastheadCTAText); ?></a><?php endif; ?>
			</div>
		</div>
	</section>

	<?php 
	$homeBasicContent = get_post_meta($post->ID, 'home_basic_text', true);
	$BasicContent = $homeBasicContent['home_content'];
	?>

	<section class="single-block">
    	<div class="container-small">
        	<?php echo wp_kses($BasicContent,counterspace_allowed_html()); ?>
        </div>
    </section>

    <?php 
	$homePostContent = get_post_meta($post->ID, 'home_post_module', true);
	$PostContent = $homePostContent['home_post_block'];
	$my_query = new WP_Query(array(
    'post_type'=>$PostContent,
    'posts_per_page'=>'50',
    'orderby' => 'menu_order', 
    'order' => 'ASC', 
    ));
    if ( $my_query->have_posts() ) : ?>

    <section class="two-col-section">
    	<div class="container">
    		<?php while ($my_query->have_posts()) : $my_query->the_post(); 
    			$initiativeDescription = get_post_meta(get_the_ID(), 'short_description', true);
		        $initiativeImage = wp_get_attachment_url(get_post_meta(get_the_ID(), 'gi_homepage_image', true));
    		?>
            <div class="two-col-box">
                <div class="col-box">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_kses($initiativeDescription,counterspace_allowed_html()); ?></p>
                    <a href="<?php the_permalink();?>" class="btn"><?php echo wp_kses(get_option('cntrspch_learn_more_button'),counterspace_allowed_html()); ?></a>

                </div>
                <div class="image-box"><a href="<?php the_permalink();?>"><img src="<?php echo esc_url($initiativeImage); ?>" alt="<?php the_title(); ?>"></a></div>
            </div>
             <?php endwhile; wp_reset_query(); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php 
	$homeBottomContentBack = get_post_meta($post->ID, 'home_bottom_background_module', true);
	$PostBottomHeader = $homeBottomContentBack['header_text'];
    $PostBottomDesc = $homeBottomContentBack['section_copy'];
    $PostBottomCTAlabel = $homeBottomContentBack['resources_cta_label'];
    $PostBottomCTAlink = $homeBottomContentBack['resources_cta_link'];
    $PostBackgroundColor = $homeBottomContentBack['background_color'];
    $PostBottomImage = wp_get_attachment_url($homeBottomContentBack['resources_image']);
    ?>
	
    <section class="bottom-gray-block" style="<?php print "background-color:". esc_attr($PostBackgroundColor); ?>">
    	<div class="container">
             <div class="two-col-box">
                <div class="col-box">
                    <h3><?php echo esc_html($PostBottomHeader); ?></h3>
                    <p><?php echo esc_html($PostBottomDesc); ?></p>
                    <?php if($PostBottomCTAlabel) : ?><a href="<?php echo esc_url($PostBottomCTAlink); ?>" class="btn"><?php echo esc_html($PostBottomCTAlabel); ?></a><?php endif; ?>
                </div>
                <div class="image-box"><img src="<?php echo esc_url($PostBottomImage); ?>"></div>
            </div>  
        </div>
    </section>
    

  
    <?php //endif; ?>
    <?php
    get_footer();
endif;
endwhile;
?>