<?php
/**
 * The template for displaying events archive pages
 */

get_header();
?>
<?php $fields = get_option( "archive_events", array() ); ?>
<?php if ( ! empty( $fields['heading'] ) ) { 
	$headbg = wp_get_attachment_url($fields['bg_image']);
?>
	<section>
		<div class="container-fluid bgWhite headerBanner paddingZero" style="background-image: url(<?php echo esc_url( $headbg ); ?>);">
			<div class="container">
				<div class="newRow">
					<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">
                    	<?php if ( ! empty( $fields['heading'] ) ): ?>
						<div class="headerTitle padding15 ">
							<h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                            	<?php echo wp_kses( $fields['heading'], array( 
                                	'br' => array('class' => array() ),
									'a' => array( 'href' => array(), 'title' => array() ),
									'strong' => array(),
                                 ) ); ?>
                            </h1>
						</div><!--for Desktop-->
                        <?php endif; ?>
                        <?php if ( ! empty( $fields['headingmb'] ) ): ?>
						<div class="headerTitleMob padding15 ">
							<h3 class="txtWhite fontDisplay padding15 MarginBottomZero">
                            	<?php echo wp_kses( $fields['headingmb'], array( 
                                	'br' => array('class' => array() ),
									'a' => array( 'href' => array(), 'title' => array() ),
									'strong' => array(),
                                 ) ); ?>
                            </h3>
                        </div><!--for Desktop-->
                         <?php endif; ?>
					</div>      
				</div>                                        
			</div>
		</div>
	</section>
  
<?php } ?>
<?php if ( ! empty( $fields['bg_content'] ) ) { ?>
	<section>
		<div class="container-fluid bgLightGrey paddingZero">
			<div class="container">  
				<div class="padding40">				
					<?php echo wp_kses( $fields['bg_content'], 
						array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
						'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),'h2' => array( 'class' => array() ),
						'h3' => array( 'class' => array() ), 'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
						'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
						'strong' => array(), 'class' => array() ) );
					?>                  
				</div>
			</div>
		</div>
	</section>
<?php } ?>

<?php $resources_archive_fields = get_option( 'archive_events' ); ?>
<?php if ( have_posts() ) : ?>
    <section>
		<div class="container-fluid bgWhite paddingZero">
			<div class="container">
			<div class="padding40">	
				<div class="row">
                	<?php if ( ! empty( $fields['headinglist'] ) ): ?>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero"><?php echo wp_kses_post( $fields['headinglist'] ); ?></h1>
                        </div>
                    <?php endif; ?>
				</div>
                <div class="row" id="content">
                <?php while ( have_posts() ) : the_post(); 
					$ev_attachment = get_post_meta( get_the_ID(), 'events_detail' , true );
					$evimage = wp_get_attachment_url($ev_attachment['evimage']);
				?>
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="eventsBox MarginBottom40">
							<img src="<?php echo esc_url( $evimage ); ?>" class="img100 BottomPadding15" alt="WTD Event" />
                            <?php if ( ! empty( get_the_title() ) ): ?>
							<p class="font24 txtDarkBlue textLeft fontDisplay MarginBottom5"><?php echo wp_kses_post(get_the_title());?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $ev_attachment['welcome_content'] ) ): ?>
                           		<?php echo wp_kses( $ev_attachment['welcome_content'], 
									array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),'h2' => array( 'class' => array() ),
									'h3' => array( 'class' => array() ), 'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
									'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
									'strong' => array(), 'class' => array() ) );
								?>
							<?php endif; ?>
                            <?php if ( ! empty( $ev_attachment['button_text'] ) ): ?>
                                <p class="MarginBottom15">
                                    <a href="<?php echo esc_url( $ev_attachment['button_link'] ); ?>" target="_blank" class="font14 txtGrey textLeft fontTxt MarginBottom15"><?php echo wp_kses_post($ev_attachment['button_text']); ?> <i class="fas fa-chevron-right"></i></a>
                                </p>
                            <?php endif; ?>
                            
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
				</div>                    
			</div>
			</div>                
		</div>
	</section><!--4-->
<?php endif; ?>

<?php
	get_footer();
?>
