<?php
/**
 * Template part for displaying resources
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<?php $resource_attachment = fbiamdigital_get_resource_attachment( get_post_meta( get_the_ID(), 'resource_attachment' ) ); ?>
<?php $preview_img = $resource_attachment['resource_type'] === 'video' && ! empty( $resource_attachment['preview_img'] ) ? $resource_attachment['preview_img'] : false; ?>
<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in">
	<a class="o-box c-listing-item c-listing-item--resources"
	   href="<?php echo $resource_attachment['resource_type'] === 'video' ? esc_attr( 'javascript:;' ) : esc_url( $resource_attachment['url'] ); ?>" target="_blank" rel="noopener"
		<?php echo esc_html( $resource_attachment['resource_type'] === 'download' ? 'download' : '' ); ?>
		<?php if ( $resource_attachment['resource_type'] === 'video' ): ?>
			data-video-src="<?php echo esc_url( $resource_attachment['url'] ); ?>"
		<?php endif; ?>
	>
		<?php $resource_custom_tag = get_post_meta( get_the_ID(), 'custom_tag', true ); ?>
		<?php if ( ! empty( $resource_custom_tag ) ): ?>
			<span class="c-listing-item__ribbon c-listing-item__ribbon--blue"><?php echo esc_html( $resource_custom_tag ); ?></span>
		<?php elseif ( WP_Featured_Posts::is_featured( get_the_ID() ) ): ?>
			<span class="c-listing-item__ribbon"><?php esc_html_e( 'Featured', 'fbiamdigital' ); ?></span>
		<?php endif; ?>

		<div class="c-listing-item__img"
			<?php if ( ! empty( $preview_img ) ): ?>
				data-preview-img="<?php echo esc_url( $preview_img ); ?>"
			<?php endif; ?>
		>
			<div style="background:url(<?php the_post_thumbnail_url(); ?>) no-repeat 50% 50%; background-size: cover;"></div>
			<?php if ( ! empty( $preview_img ) ): ?>
				<div class="c-listing-item__thumbnail-preview" style="background: no-repeat 50% 50%; background-size: cover;"></div>
				<span class="c-listing-item__thumbnail-icon c-listing-item__thumbnail-icon--play"><i class="fas fa-play"></i></span>
				<span class="c-listing-item__thumbnail-icon c-listing-item__thumbnail-icon--spinner">
				<div class="o-spinner o-spinner--bbounce">
					<div class="o-spinner__doodad-1"></div>
					<div class="o-spinner__doodad-2"></div>
					<div class="o-spinner__doodad-3"></div>
				</div>
			</span>
			<?php endif; ?>
		</div>

		<div class="c-listing-item__body">
			<div class="c-listing-item__meta">
				<?php if ( ! empty( $resource_attachment['content_type'] ) ): ?>
					<span class="c-listing-item__cat"><?php fbiamdigital_the_resource_content_type_label( $resource_attachment ); ?></span>
				<?php endif; ?>
			</div>
			<h3 class="c-listing-item__title"><?php the_title(); ?></h3>
			<p class="c-listing-item__description c-listing-item__description--resource"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
			<p class="c-listing-item__cta">
				<?php if ( $resource_attachment['resource_type'] === 'link' ): ?>
					<?php esc_html_e( 'Access', 'fbiamdigital' ); ?> <i class="far fa-external-link"></i>
				<?php elseif ( $resource_attachment['resource_type'] === 'download' ): ?>
					<?php esc_html_e( 'Download', 'fbiamdigital' ); ?><?php echo esc_html( ! empty( $resource_attachment['size'] ) ? sprintf( ' (%s)', $resource_attachment['size'] ) : '' ); ?> <i class="far fa-arrow-to-bottom"></i>
				<?php elseif ( $resource_attachment['resource_type'] === 'video' ): ?>
					<?php esc_html_e( 'View', 'fbiamdigital' ); ?> <i class="far fa-video"></i>
				<?php endif; ?>
			</p>
		</div>
	</a>
</div>