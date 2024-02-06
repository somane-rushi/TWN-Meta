<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thailand
 */

?>


<div class="row  blogarea"  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php $blogleader = get_post_meta( get_the_ID(), 'leadership_detail' , true );
					$fimg = wp_get_attachment_url($blogleader['leader_image']); ?>


						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox blogimgarea p" 
						 style="background-image:url(<?php echo esc_url($fimg); ?>)"> 
             		    </div>
						 
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox">
                            <div class="div70">
                              
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title marginBottom25">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title marginBottom25"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				thailand_posted_on();
				thailand_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>


                <p><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>

	<?php 
	
	
	
	
	$blogbtntext = get_post_meta( get_the_ID(), 'leadership_detail' , true );
									if ( ! empty( $blogbtntext['rbtntext'] ) ): ?>
							<p class="txtDarkBlue">
				
								<a href="<?php the_permalink()?>" rel="bookmark" class="txtDarkGreen"><span class="fa fa-arrow-right txtDarkGreen"></span><?php echo wp_kses_post( $blogbtntext['rbtntext'] ); ?></a>
								</p>
                    	<?php endif; ?>	
							
                            </div>
                        </div>
                    </div>
					</div>
	

	</div><!-- #post-<?php the_ID(); ?> -->
