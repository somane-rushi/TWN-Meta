<?php
/**
 * Submodule: PARTNERS SECTION
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
  $sub_fields = $args['sub_fields'];
  $partners_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
  if ('1' === $partners_toggle) :
  	$the_partners    = fbsafety_fm_get_data($sub_fields, 'partners');
  	$the_title       = fbsafety_fm_get_data($sub_fields, 'title');
  	$the_description = fbsafety_fm_get_data($sub_fields, 'description');
  	$display_all_p   = fbsafety_fm_get_data($sub_fields, 'display_all');
?>

<div class="container" id="our-partners">
  <div class="row">
    <div class="partners-section">

			<div class="partners-head">
				<h3>
					<?php echo esc_html( $the_title ); ?>
				</h3>
				<p>
					<?php echo esc_html( $the_description ); ?>
				</p>
			</div>

			<div class="partners-section-body desktop">
				<ul>

				<?php
					if ( ! empty($the_partners) ) :
						$i = 0;
						foreach($the_partners as $partner) :
							$i++;
							$has_more_results = false;
							$classes  				= '';
							if ($i > 10) {
								$has_more_results = true;
								$classes          = ' more--results';
							}
							$p        = fbsafety_fm_get_data($partner, 'a_partner');
							$p_name   = fbsafety_fm_get_data($p, 'partner_name');
							$p_link   = fbsafety_fm_get_data($p, 'partner_link');
							$p_desc   = fbsafety_fm_get_data($p, 'partner_description');
							$p_img    = get_template_directory_uri() . '/img/square-logo-placeholder.png';
							$p_img_id = fbsafety_fm_get_data($p, 'partner_image');
							if ( ! empty($p_img_id) ) {
								$p_img = wp_get_attachment_image_src( $p_img_id, 'full' )[0];
							}
							if ( !empty($p) && !empty($p_name) ) :
				?>

					<li class="a-partner<?php echo esc_attr($classes); ?>">
						<div class="partners-logo">
						<img 
							src="<?php echo esc_url( $p_img ); ?>" 
							alt="<?php echo esc_attr( $p_name ); ?>"
						>
						</div>
						<div class="partners-info">
							<h5>
								<?php echo esc_html( $p_name ); ?>
							</h5>
							<p>
								<?php echo esc_html( $p_desc ); ?>
							</p>
						<?php if ( ! empty($p_link) ) : ?>
							<a 
								href="<?php echo esc_url( $p_link ); ?>" 
								class="partner-link" 
								target="_blank" 
								rel="noopener"
							>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/img/right-grey.png' ); ?>" class="partner-arrow" alt="Visit <?php echo esc_attr( $p_name ); ?>" /> <span>Visit</span>
							</a>
						<?php endif; ?>
						</div>
					</li>

				<?php
							endif;
						endforeach;
					endif;
				?>

				</ul>
			</div>

			<div class="partners-section-body mobile">
				<ul>

				<?php
					if ( ! empty($the_partners) ) :
						$i = 0;
						foreach($the_partners as $partner) :
							$i++;
							$has_more_results = false;
							$classes  				= '';
							if ($i > 10) {
								$has_more_results = true;
								$classes          = ' more--results';
							}
							$p        = fbsafety_fm_get_data($partner, 'a_partner');
							$p_name   = fbsafety_fm_get_data($p, 'partner_name');
							$p_link   = fbsafety_fm_get_data($p, 'partner_link');
							$p_desc   = fbsafety_fm_get_data($p, 'partner_description');
							$p_img    = get_template_directory_uri() . '/img/square-logo-placeholder.png';
							$p_img_id = fbsafety_fm_get_data($p, 'partner_image');
							if ( ! empty($p_img_id) ) {
								$p_img = wp_get_attachment_image_src( $p_img_id, 'full' )[0];
							}
							if ( !empty($p) && !empty($p_name) ) :
				?>

					<li class="a-partner<?php echo esc_attr($classes); ?>">
						<div class="acc_trigger_three accordion">
							<h5>
								<?php echo esc_html( $p_name ); ?>
							</h5>
						</div>
						<div class="acc_container_three panel">
							<div class="partners-logo">
						<?php if ( ! empty($p_link) ) : ?>
							<a 
								href="<?php echo esc_url( $p_link ); ?>" 
								target="_blank" 
								rel="noopener"
							>
						<?php
							endif;
						?>
								<img 
									src="<?php echo esc_url( $p_img ); ?>" 
									alt="<?php echo esc_attr( $p_name ); ?>"
								>
						<?php if ( ! empty($p_link) ) : ?>
							</a>
						<?php
							endif;
						?>
							</div>
							<div class="partners-info">
								<p>
									<?php echo esc_html( $p_desc ); ?>
								</p>
							</div>
						</div>
					</li>

				<?php
							endif;
						endforeach;
					endif;
				?>

				</ul>
			</div>

			<div class="btn-bottom-group">
				<a href="#our-partners" class="btn-bottom">Back to Top of Partners <i class="fas fa-angle-up"></i></a>
			<?php 
				if ( (true === $has_more_results) && ('1' !== $display_all_p) ) :
			?>
				<a href="#" id="more--results" class="btn-bottom">More Results <i class="fas fa-plus"></i></a>
			<?php
				endif;
			?>
			</div>

    </div>
  </div>

<?php 
	if ( (true === $has_more_results) && ('1' !== $display_all_p) ) :
?>
<script>
jQuery(document).ready(function($){
	$('.more--results').fadeOut(1);
	$('#more--results').click(function(e){
		e.preventDefault();
		$('.more--results').fadeIn(750);
		$(this).fadeOut(1000);
	});
});
</script>
<?php
	endif;
?>

</div>

<?php
  endif;//toggle
endif;//sub_fields
