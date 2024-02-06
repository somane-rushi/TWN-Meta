<?php
/*
Template Name: Thailand Home Page
*/

get_header();
?>
<?php $sectionfirst = get_post_meta( get_the_ID(), 'sectionfirst', true ); 
if ( ! empty( $sectionfirst['bgimage'] ) ):
	$bgimg = wp_get_attachment_url($sectionfirst['bgimage']); ?>
    <section class="australia-tab-section">
        <div class="container-fluid">
            <div class="row">
                <div class="australia-block " style="background-image: url(<?php echo esc_url($bgimg) ?>);">
                    <?php if ( ! empty( $sectionfirst['heading'] ) ): ?>
                        <h2><?php echo wp_kses_post( $sectionfirst['heading'] ); ?></h2>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectionfirst['subheading'] ) ): ?>
                    <h4><?php echo wp_kses( $sectionfirst['subheading'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
                        ) ); ?></h4>
                     <?php endif; ?>
                     <?php if ( ! empty( $sectionfirst['description'] ) ): ?>
                    	<?php echo wp_kses( $sectionfirst['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
							'h3' => array( 'class' => array() ),
							'span' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),
							'ul' => array( 'class' => array() ),
							'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?>
                     <?php endif; ?>

                     <?php if ( ! empty( $sectionfirst['buttontext'] ) ): ?>
                        <p><a href="<?php echo esc_url( $sectionfirst['buttonlink']  ); ?>">
                        <span class="fa fa-arrow-right"></span>
                        <?php echo wp_kses_post( $sectionfirst['buttontext'] ); ?></a></p>
                     <?php endif; ?>
                     
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $pilone = get_post_meta( get_the_ID(), 'pillarone', true ); 
if(!empty($pilone['title']) || !empty( $pilone['description']) ) { ?>
	<section class="four-boxes-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12 boxes-block-1">
					<div class="boxes-main-content">
                    	<?php if ( ! empty( $pilone['title'] ) ): ?>
						<div class="boxes-txt ecobg">
                        	<h2><?php echo wp_kses( $pilone['title'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
								) ); ?></h2>
						</div>
                        <?php endif;
						if ( ! empty( $pilone['pillarimage'] ) ): $pone = wp_get_attachment_url($pilone['pillarimage']); ?>
						<div class="boxes-img boxHomeOne">
							<img src="<?php echo esc_url($pone) ?>" alt="Thailand">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <?php endif; ?>
					</div>
					<div class="overlay-boxes-block ecobg">
                    	<?php if ( ! empty( $pilone['description'] ) ): ?>
                        <?php echo wp_kses( $pilone['description'], array(
								'br' => array( 'class' => array() ),
								'strong' => array(),
								'h3' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ),
								'ul' => array( 'class' => array() ),
								'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
							) ); ?>
                        <?php endif; ?>
					</div>
				</div>
				<?php $piltwo = get_post_meta( get_the_ID(), 'pillartwo', true ); ?>
                <div class="col-md-3 col-sm-6 col-xs-12 boxes-block-1">
                	<div class="boxes-main-content">
                    	<?php if ( ! empty( $piltwo['title'] ) ): ?>
                            <div class="boxes-txt digibg">
                                <h2><?php echo wp_kses( $piltwo['title'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
									) ); ?></h2>
                            </div>
                        <?php endif;
						if ( ! empty( $piltwo['pillarimage'] ) ): $ptwo = wp_get_attachment_url($piltwo['pillarimage']); ?>
						<div class="boxes-img boxHomeTwo">
							<img src="<?php echo esc_url($ptwo) ?>" alt="Thailand">
                            <i class="fas fa-arrow-up"></i>
						</div>
                        <?php endif; ?>
					</div>
					<div class="overlay-boxes-block digibg">
						<?php if ( ! empty( $piltwo['description'] ) ): 
								echo wp_kses( $piltwo['description'], array(
									'br' => array( 'class' => array() ),
									'strong' => array(), 'span' => array( 'class' => array() ),
									'h3' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),
									'ul' => array( 'class' => array() ),
									'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
								) ); 
						endif; ?>
					</div>
				</div>
				<?php $pilthr = get_post_meta( get_the_ID(), 'pillarthree', true ); ?>
				<div class="col-md-3 col-sm-6 col-xs-12 boxes-block-1">
					<div class="boxes-main-content">
                    	<?php if ( ! empty( $pilthr['title'] ) ): ?>
						<div class="boxes-txt combg">
                        	<h2><?php echo wp_kses( $pilthr['title'], array(
									'br' => array( 'class' => array() ),
									'strong' => array(), 'span' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
							) ); ?></h2>
                        </div>
                        <?php endif;
						if ( ! empty( $pilthr['pillarimage'] ) ): $pthr = wp_get_attachment_url($pilthr['pillarimage']); ?>
                        <div class="boxes-img boxHomeThree">
                                <img src="<?php echo esc_url($pthr) ?>" alt="Thailand">
                                <i class="fas fa-arrow-up"></i>
                        </div>
                        <?php endif; ?>
					</div>
                    <div class="overlay-boxes-block combg">
                    	<?php if ( ! empty( $pilthr['description'] ) ):  
							echo wp_kses( $pilthr['description'], array(
							'br' => array( 'class' => array() ),
							'strong' => array(), 'span' => array( 'class' => array() ),
							'h3' => array( 'class' => array() ),
							'p' => array( 'class' => array() ),
							'ul' => array( 'class' => array() ),
							'li' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
						) ); endif; ?>
                    </div>
				</div>
				<?php $pilfr = get_post_meta( get_the_ID(), 'pillarfour', true ); ?>
                <div class="col-md-3 col-sm-6 col-xs-12 boxes-block-1">
					<div class="boxes-main-content">
                    	<?php if ( ! empty( $pilfr['title'] ) ): ?>
						<div class="boxes-txt covidbg">
							<h2><?php echo wp_kses( $pilfr['title'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ),
										'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
								) ); ?></h2>
						</div>
                        <?php endif;
                    	if ( ! empty( $pilfr['pillarimage'] ) ): $pfr = wp_get_attachment_url($pilfr['pillarimage']); ?>
						<div class="boxes-img boxHomeFour">
							<img src="<?php echo esc_url($pfr) ?>" alt="Thailand">
                            <i class="fas fa-arrow-up"></i>
						</div>
                        <?php endif; ?>
					</div>
					<div class="overlay-boxes-block covidbg">
                     	<?php if ( ! empty( $pilfr['description'] ) ):  
								echo wp_kses( $pilfr['description'], array(
									'br' => array( 'class' => array() ),
									'strong' => array(), 'span' => array( 'class' => array() ),
									'h3' => array( 'class' => array() ),
									'p' => array( 'class' => array() ),
									'ul' => array( 'class' => array() ),
									'li' => array( 'class' => array() ),
									'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
								) );
							endif; ?>
					</div>
				</div>
                
			</div>
		</div>
	</section>
<?php } ?>
<?php
	$args = array(
		'post_type'=> 'leadership',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'DESC',
		'posts_per_page' => 5
	);
	$result = new WP_Query( $args );
	if ( $result-> have_posts() ) : ?>

<section class="advocacy-section">
	<div class="container">
		<div class="page-title text-center">
        	<?php $bhead = get_post_meta( get_the_ID(), 'bloghome', true ); ?>
            <?php if ( ! empty( $bhead['bloghead'] ) ): ?>
				<h1 class="txtBlack text-center"><?php echo wp_kses_post( $bhead['bloghead'] ); ?></h1>
            <?php endif; ?>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="testimonial-block">
				<div class="testimonial-carousel owl-carousel owl-theme">
                	<?php while ( $result->have_posts() ) : $result->the_post(); 
					$blogdt = get_post_meta( get_the_ID(), 'leadership_detail' , true );
					$bimg = wp_get_attachment_url($blogdt['leader_image']);
					?>
					<div class="testi-full container-fluid">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 testiBgOne" style="background:url(<?php echo esc_url($bimg); ?>)">
								<div class="testimonial-left"></div>
							</div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="">
								<div class="testimonial-right">
									<div>
                                    	<h2 class="txtRed"><?php echo wp_kses_post( get_the_title() ); ?></h2>
                                    	<p><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
                                        <?php if ( ! empty( $blogdt['rbtntext'] ) ): ?>
										<p>             
                                        	<a href="<?php the_permalink()?>"><span class="fa fa-arrow-right"></span>
											<?php echo wp_kses_post( $blogdt['rbtntext'] ); ?></a>
										</p>
                                        <?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <?php
				 endwhile;
				 wp_reset_postdata(); ?>
                              
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php
get_footer();
