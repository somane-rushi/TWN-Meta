<?php
/**
 * The template for displaying stories archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shemb
 */

get_header();
?>
<?php $fields = get_option( "archive_partners", array() ); ?>
<?php if ( ! empty( $fields['description'] ) ): ?>
<section class="top-area greenback">
	<div class="container">
		<div class="col-lg-12">
			<div class="top-para">
            	<?php echo wp_kses( $fields['description'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'class' => array() ) ); ?>
            </div>
		</div>
	</div>
</section>
<?php endif; ?>

<section id="tabs" class="partner-tab">
	<div class="container">
		<div class="row fxd">
			<div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <?php $mcountry = partner_country(); ?>
                <?php if ( ! empty( $mcountry ) ): ?>
				<nav>
					<div class="nav nav-tabs nav-fill main-nav" id="nav-tab" role="tablist">
                    <?php $i=1; foreach ( $mcountry as $cou ) { ?>
                    	<a class="nav-item nav-link txtDarkGreen <?php if($i===1){ echo 'active'; } ?>" 
                        id="nav-<?php echo wp_kses_post($cou->slug); ?>-tab" data-toggle="tab" role="tab" aria-controls="nav-<?php echo wp_kses_post($cou->slug); ?>" aria-selected="false" href="#nav-<?php echo wp_kses_post($cou->slug); ?>"><?php echo wp_kses_post($cou->name); ?></a>
                       
                    <?php $i++; } ?>
					</div>
				</nav>
                <?php endif; ?>
                <div class="divder2"></div>
                <?php 
				wp_reset_query();
				
				$mcountry1 = partner_country();
				if ( ! empty( $mcountry1 ) ): ?>
                	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
						<?php $i=1; foreach ( $mcountry1 as $cou1 ) { ?>
                        	
                        	<div class="tab-pane fade <?php if($i===1){ echo 'show active'; } ?>" id="nav-<?php echo wp_kses_post($cou1->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo wp_kses_post($cou1->slug); ?>">
                            	<div class="row fxd">
              						<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    	<?php 
											$subcoun = partner_subcountry($cou1->term_id);
										if ( ! empty( $subcoun ) ) { ?>
                                            <nav>
                                                <div class="nav nav-tabs nav-fill subnav " id="nav-tab" role="tablist"> 
                                                    <a class="nav-item nav-link active txtDarkGreen" id="nav-all-asiapacific-tab" data-toggle="tab" href="#all-asiapacific" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                                    <?php foreach ( $subcoun as $scou ) { ?>
                                                    <a class="nav-item nav-link txtDarkGreen" id="nav-<?php echo wp_kses_post($scou->slug); ?>-tab" data-toggle="tab" href="#<?php echo wp_kses_post($scou->slug); ?>" role="tab" aria-controls="nav-profile" aria-selected="false"><?php echo wp_kses_post($scou->name); ?></a>
                                                    <?php } ?>
                                                </div>
                                            
                                            </nav>
                                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-subtabContent">
                                                <div class="tab-pane fade show active" id="all-asiapacific" role="tabpanel" aria-labelledby="nav-all-asiapacific-tab">
                                                    <div class="row ">
                                                    <?php
													$mainpartner = getpartner_post($cou1->slug);
                                                    if ( $mainpartner->have_posts() ) {
                                                        while ( $mainpartner->have_posts() )
                                                        {
															$mainpartner->the_post();
                                                            $shop_cf = get_post_meta( get_the_ID(), 'partner' , true );
                                                            $shopimg = wp_get_attachment_url($shop_cf['pimage']);
                                                            ?>
                                                                <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6"> 
																	<!--pad5-->
                                                                    <img class="partner" src="<?php echo esc_url( $shopimg ); ?>"
                                                                    alt="<?php echo wp_kses_post(the_title()); ?>" />
                                                                </div>
                                                                <?php
                                                        } wp_reset_postdata();
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                                <?php wp_reset_query(); 
													$subcoundt = partner_subcountry($cou1->term_id); 
													foreach ( $subcoundt as $scoudt ) {
												?>
                                                    <div class="tab-pane fade" id="<?php echo wp_kses_post($scoudt->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo wp_kses_post($scoudt->slug); ?>-tab">
                                                        <div class="row">
                                                        <?php
															$subpartner = getpartner_post($scoudt->slug);
																if ( $subpartner->have_posts() ) { 
																	$shop_cf=''; $shopimg='';
																	while ( $subpartner->have_posts() ): $subpartner->the_post();
																		$shop_cf = get_post_meta( get_the_ID(), 'partner', true);
																		$shopimg = wp_get_attachment_url($shop_cf['pimage']);
																		?>
                                                          				<div class="col col-lg-4 ">
																			<!--pad5-->  
                                                                        	<img class="partner" src="<?php echo esc_url( $shopimg ); ?>" alt="<?php echo wp_kses_post(the_title()); ?>" />
                                                                            <?php if ( ! empty( $shop_cf['pdescription'] ) ): ?>
                                                                            <p class="pa-para">
																			<?php echo wp_kses( $shop_cf['pdescription'], array(
																					'br' => array( 'class' => array() ),
																					'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                        															'strong' => array(),
																					'style' => array(),
																			) ); ?></p>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                <?php endwhile; wp_reset_postdata(); } ?>
                                                        </div>
                                                    </div>
                                               <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                        <?php
												$mainpart = getpartner_post($cou1->slug);
												if ( $mainpart->have_posts() ) {
													echo '<div class="row">';
													while ( $mainpart->have_posts() )
													{
														$mainpart->the_post();
														$shop_cf = get_post_meta( get_the_ID(), 'partner' , true );
                                                        $shopimg = wp_get_attachment_url($shop_cf['pimage']);
														?>
                                                        <div class="col col-lg-4 ">
															<!--pad5--> 
															<img class="partner" src="<?php echo esc_url( $shopimg ); ?>"
															alt="<?php echo wp_kses_post(the_title()); ?>" />
														</div>
                                                        <?php
													} wp_reset_postdata();
													echo '</div>';
												}
											} //else
										?>
                                    </div>
                                 </div>
                            </div>
                            
                            
                        <?php $i++; } ?>
                	</div>
                <?php endif; 
				?>
                
			</div> <!-- 12 -->
		</div>
	</div><!-- container -->
</section>



<?php
get_footer();
