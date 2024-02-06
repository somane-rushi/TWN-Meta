<?php
/*
Template Name: Fellowship Page
*/

get_header();
?>

<?php while ( have_posts() ) : the_post(); 
	$sec_banner = get_post_meta( get_the_ID(), 'banner', true );
	$banner = wp_get_attachment_url($sec_banner['image']);
	if ( ! empty( $banner ) ):
?>
    <section id="topsec">
		<div class="container-fluid pad-0"> 
        	<img src="<?php echo esc_url( $banner ); ?>" class="tpbannerimg" alt="Shemb" />
		</div>
	</section>
    <?php endif; 
	$sec_two = get_post_meta( get_the_ID(), 'sec_two', true );
	?>
    <section class="fellowshipback">
    	<?php if ( ! empty( $sec_two['sec_head']) && ! empty( $sec_two['sec_desc'] ) ): ?>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
                    	<?php 
							if( ! empty( $sec_two['sec_head'] ) ){ ?>
								<h3 class="hl-text-heading"><?php echo esc_html( $sec_two['sec_head'] ); ?></h3>
                        <?php } ?>
						<?php 
							if( ! empty( $sec_two['sec_desc'] ) ){
								echo wp_kses( $sec_two['sec_desc'], 
									array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
									'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
									'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
									'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
									'strong' => array(), 'class' => array() ) ); 
							}
						?>
              		</div>
            	</div>
          </div>
      <?php endif; 
	  $sec_thr = get_post_meta( get_the_ID(), 'secthr', true );
	  $img = wp_get_attachment_url( $sec_thr['sec_thr_image'] );
	  if ( ! empty( $img ) && ! empty( $sec_thr['sec_thr_desc'] ) ):
	  ?>
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-md-6 col-12">
                	<img src="<?php echo esc_url( $img ); ?>" class="aluminiimghk" alt="Shemb" />
                </div>
                <div class="col-md-6 col-12">
                    <?php 
						if( ! empty( $sec_thr['sec_thr_desc'] ) ){
							echo wp_kses( $sec_thr['sec_thr_desc'] , 
								array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
								'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
								'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
								'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
								'strong' => array(), 'class' => array() ) ); 
						}
					?>
                </div>
            </div>
		</div>
		<?php endif; ?>
    </section>
    
    <?php include get_template_directory().'/template-parts/content-fellows.php'; ?> 
    
<?php endwhile; ?>
<?php
get_footer();
