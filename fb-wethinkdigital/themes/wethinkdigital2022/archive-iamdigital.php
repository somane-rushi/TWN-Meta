<?php
/**
 * The template for displaying iamdigital archive pages
 */

get_header();
global $wp_query;
$category_query_var_name = 'countries';
$language_query_var_name = 'languages';
$fields = get_option( "archive_iamdigital", array() );
if( ! empty( get_query_var( 'countries' )) ){ $param_country = get_query_var( 'countries' ); }
if( ! empty( get_query_var( 'languages' )) ){ $param_lang = get_query_var( 'languages' ); }

?>
<style>
#infinite-handle{ display:none; }
</style>
<?php if ( ! empty( $fields['head_image'] ) ) { 
$headbg = wp_get_attachment_url($fields['head_image']);
?>
<section>
	<div class="container-fluid paddingZero bgWhite headerBanner" style="background-image: url('<?php echo esc_url( $headbg ); ?>');">
    	<div class="container dirRTL">
			<div class="newRow">
				<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">
                	<?php if ( ! empty( $fields['head_desc'] ) ): ?> 
					<div class="headerTitle padding15 ">
						<h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                        	<?php echo wp_kses( $fields['head_desc'], 
								array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ),
								'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
								'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
								'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
								'strong' => array(), 'class' => array() ) ); ?>
                        </h1>
					</div>
                    <?php endif;
					if ( ! empty( $fields['headm_desc'] ) ): ?>
                    <div class="headerTitleMob padding15 ">
						<h3 class="txtWhite fontDisplay padding15 marginZero">
                        	<?php echo wp_kses( $fields['headm_desc'], 
								array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'p' => array( 'class' => array() ),
								'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
								'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
								'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
								'strong' => array(), 'class' => array() ) ); ?>
                        </h3>
					</div>
                    <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php if ( ! empty( $fields['description'] ) || ! empty( $fields['heading'] ) ) { ?>
	<div class="container-fluid bgWhite LeftRightPadding0">
		<div class="container ">
			<div class="padding40">
            	<?php if ( ! empty( $fields['heading'] ) ) { ?>
				<h1 class="fontDisplay txtDarkBlue textCenter paddingZero marginZero dirRTL"><?php echo wp_kses_post( $fields['heading'] ); ?></h1>
                <?php } ?>
                <?php if ( ! empty( $fields['description'] ) ) { ?>
				<div class="marginZero paddingZero dirRTL">
					<p class="fontTxt marginZero PaddingTop40 font16 txtGrey textLeft">
					<?php echo wp_kses( $fields['description'], array(
							'br' => array(
								'class' => array()
							),
						) ); ?>
					</p>
				</div>
                <?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
<?php if ( ! empty( $fields['digi_image'] ) ) { 
	$seconebg = wp_get_attachment_url($fields['digi_image']);
?>
<section>
	<div class="container-fluid paddingZero bgLightGrey LeftRightPadding0">
		<div class="container">
			<div class="padding40">                                
				<img src="<?php echo esc_url( $seconebg ); ?>" class="img100 paddingZero marginZero" />
			</div>
		</div>
	</div>
</section>
<?php } ?>

<section>
	<div class="container-fluid bgWhite paddingZero" id="divcount">
		<div class="container">
        	<?php if ( ! empty( $fields['post_title'] ) ) { ?>
			<div class="padding40">
				<div class="row">
					<div class="col-xl-2 col-lg-2 col-md-1 col-sm-12 paddingZero"></div>
					<div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 paddingZero">
						<h1 class="fontDisplay txtDarkBlue textCenter paddingZero marginZero dirRTL"><?php echo wp_kses_post( $fields['post_title'] ); ?></h1>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-1 col-sm-12 paddingZero"></div>
				</div>
			</div>
            <?php } ?>
            <?php if ( have_posts() ) : 
				$serurl=esc_url( get_post_type_archive_link( 'iamdigital' ) ); $firstcont=''; $firstcontname=''; ?>
                    <div class="PaddingBottom40">
                        <div class="row padding40-resource">
                        	<?php $digi_country_terms = fbiamdigital_get_terms( array(
									'taxonomy' => 'pccountry',
									'parent' => 0,
								) ); 
								
								$firstcont=$digi_country_terms[0]->term_id;
								$firstcontname=$digi_country_terms[0]->slug;
								if(!empty($param_country)){
									$playlist = get_term_by( 'slug', $param_country, 'pccountry' );
									$cid=$playlist->term_id;
								}
								else
								{ $cid = $firstcont; }
								$digi_lang_terms = fbiamdigital_get_terms( array(
									'taxonomy' => 'pccountry',
									'parent' => $cid,
								) );
								
								$firstlangname=$digi_lang_terms[0]->slug;
								$fterm_id='';
								if( !empty($param_country) )
								{
									$fterm = get_term_by('slug', $param_country, 'pccountry'); 
									$fterm_id = $fterm->term_id;
								}
								else
								{ $fterm_id = $firstcont; }
								
								$firstlangname=get_firstlan($fterm_id);
							?>
                            <?php if ( ! empty( $digi_country_terms ) ): ?>
                            <?php $serurl=$serurl.'?'; ?>
                            	<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 mobDispNone paddingZero"></div>
                            		
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-center">
                                    	<form action="<?php echo esc_url( get_post_type_archive_link( 'iamdigital' ) ); ?>" class="c-select select2-hidden-accessible fontOpt_ExtraLight" tabindex="-1" aria-hidden="true">
                                        
                                        <select class="form-select fontTxt txtDarkBlue font20 padding15 MarginBottom15 bgWhite div100" id="countries" name="countries" aria-label="" onchange="bindurl(this.value,'<?php echo esc_url($serurl); ?>','county')">
                                            <option value="" selected class="fontTxt font14 txtDarkBlue">Countries</option>
                                            <?php foreach ( $digi_country_terms as $digi_country_terms ): $sel='';
													if(!empty($param_country)){
														if($digi_country_terms->slug===$param_country){ $sel= 'selected'; }
													}
											?>
											<option value="<?php echo esc_attr( $digi_country_terms->slug ); ?>" class="fontTxt font14 txtDarkBlue" <?php if(!empty($sel)){ echo esc_attr($sel); } else { selected( $digi_country_terms->slug, $firstcontname, true ); } ?>><?php echo esc_html( $digi_country_terms->name ); ?></option>
											<?php endforeach; ?>
                                        </select>
                                         </form>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-center">
                                    	<?php if ( ! empty( $digi_lang_terms ) ):
												if(!empty($param_country)){
													$serurl=$serurl.'?countries='.$param_country.'&';
												}
												else{
													$serurl=$serurl.'?';
												}
												
												if(!empty($param_lang))
												{
													$sel_lan=$param_lang;
												}
												else { $sel_lan=''; }
											?>
                                            <form class="c-listing-filter__inner o-box divWidth100 fontOpt_ExtraLight" id="postlang"
                    						action="<?php echo esc_url( $serurl ); ?>">
                                            <select class="form-select fontTxt txtDarkBlue font20 padding15 MarginBottom15 bgWhite div100" id="languages" name="languages" aria-label="" onchange="bindurl(this.value,'<?php echo esc_url($serurl); ?>','lang')">
                                                <option value="" selected="" class="fontTxt font14 txtDarkBlue">Language</option>
                                                <?php foreach ( $digi_lang_terms as $digi_lang_terms ): ?>
                                                    <option <?php if(!empty($param_lang)){ selected( $digi_lang_terms->slug, $param_lang, true ); } else { selected( $digi_lang_terms->slug, $firstlangname, true ); } ?> value="<?php echo esc_attr( $digi_lang_terms->slug ); ?>" class="fontTxt font14 txtDarkBlue"><?php echo esc_html( $digi_lang_terms->name ); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                
                                	<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 mobDispNone paddingZero"></div>
                            	</div>
                           
                    		<?php endif; ?>
                    
                    
                    <div class="row paddingZero resContent" id="content">
                    	<?php
							if(!empty($param_country) && !empty($param_lang))
							{
								$argsp = array(
									'post_type' => 'iamdigital',
									'posts_per_page'   => 50,
									'post_status' => 'publish',
									'order' => 'ASC',
									'tax_query' => array(
										'relation' => 'AND',
										array(
											'taxonomy' => 'pccountry',
											'field' => 'slug',
											'terms' => $param_country,
										),
										array(
											'taxonomy' => 'pccountry',
											'field'	=> 'slug',
											'terms'	=> $param_lang,
										),
									)
								);
							}
							else if(!empty($param_country))
							{
								$argsp = array(
									'post_type' => 'iamdigital',
									'posts_per_page'   => 50,
									'post_status' => 'publish',
									'order' => 'ASC',
									'tax_query' => array(
										'relation' => 'AND',
										array(
											'taxonomy' => 'pccountry',
											'field' => 'slug',
											'terms' => $param_country,
										),
										array(
											'taxonomy' => 'pccountry',
											'field'	=> 'slug',
											'terms'	=> $firstlangname,
										),
									)
								);
							}
							else if(!empty($param_lang))
							{
								$argsp = array(
									'post_type' => 'iamdigital',
									'posts_per_page'   => 50,
									'post_status' => 'publish',
									'order' => 'ASC',
									'tax_query' => array(
										array(
											'taxonomy' => 'pccountry',
											'field' => 'slug',
											'terms' => $param_lang,
										)
									)
								);
							}
							else
							{
								$argsp = array(
									'post_type' => 'iamdigital',
									'posts_per_page'   => 50,
									'post_status' => 'publish',
									'order' => 'ASC',
									'tax_query' => array(
										'relation' => 'AND',
										array(
											'taxonomy' => 'pccountry',
											'field' => 'slug',
											'terms' => $firstcontname,
										),
										array(
											'taxonomy' => 'pccountry',
											'field'	=> 'slug',
											'terms'	=> $firstlangname,
										),
									)
								);
							}
							 
							$the_query = new WP_Query( $argsp );
							while ( $the_query->have_posts() ) : $the_query->the_post();
								get_template_part( 'template-parts/content', get_post_type() );
							endwhile;
						?>
					</div>
                
            <?php endif; ?>
            
		</div>
	</div>
</section>


<section>
	<div class="container-fluid paddingZero bgLightGrey LeftRightPadding0">
		<div class="container TopBottomPadding50 ">
        	<?php if ( ! empty( $fields['help_title'] ) ) { ?>
			<div class="padding40">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
						<h1 class="fontDisplay txtDarkBlue textCenter paddingZero marginZero dirRTL"><?php echo wp_kses_post( $fields['help_title'] ); ?></h1>
                    </div>
				</div>
			</div>
            <?php } ?>
            <div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="campaignBox bgWhite MarginBottom25 padding40-iamDigital campaignContent div100 ">
						<?php if ( ! empty( $fields['add1_title'] ) ) { ?>
							<div class="row marginZero">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
									<div class="verticalAlignCenter MarginBottom25">
                                        <?php if ( ! empty( $fields['add1_image'] ) ) { 
											$flag1 = wp_get_attachment_url($fields['add1_image']); ?>
                                            <img src="<?php echo esc_url( $flag1 ); ?>" class="minImg" />
                                        <?php } ?>
										<h4 class="fontTxt txtDarkBlue MarginBottomZero font20 dirRTL"><?php echo wp_kses_post( $fields['add1_title'] ); ?></h4>
									</div>
								</div>
							</div>
						<?php } ?>
                        <?php if ( ! empty( $fields['add1_text1'] ) || ! empty( $fields['add1_text2'] ) || ! empty( $fields['add1_text3'] ) ) { ?>
                                <div class="row marginZero">
                                	<?php if ( ! empty( $fields['add1_text1'] ) ) { ?>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                        	<?php echo wp_kses( $fields['add1_text1'], array(
                                            	'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                                                'h3' => array( 'class' => array() ),
                                                'a' => array(
                                                   'href' => array(), 'title' => array(), 'target' => array(), 'style' => array()
                                                 ), 'strong' => array(),'class' => array(),
                                             ) ); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ( ! empty( $fields['add1_text2'] ) ) { ?>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                        <?php echo wp_kses( $fields['add1_text2'], array(
                                            	'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                                                'h3' => array( 'class' => array() ),
                                                'a' => array(
                                                   'href' => array(), 'title' => array(), 'target' => array(), 'style' => array()
                                                 ), 'strong' => array(),'class' => array(),
                                             ) ); ?>
                                    </div>
                                    <?php } ?>
                                    <?php if ( ! empty( $fields['add1_text3'] ) ) { ?>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                        <?php echo wp_kses( $fields['add1_text3'], array(
                                            	'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                                                'h3' => array( 'class' => array() ),
                                                'a' => array(
                                                   'href' => array(), 'title' => array(), 'target' => array(), 'style' => array()
                                                 ), 'strong' => array(),'class' => array(),
                                             ) ); ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?><!--1 Fiji-->
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="campaignBox bgWhite MarginBottom25 padding40-iamDigital campaignContent div100 ">
                                <div class="row marginZero">
                                	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
										<div class="verticalAlignCenter MarginBottom25">
											<?php if ( ! empty( $fields['add2_image'] ) ) { 
												$flag2 = wp_get_attachment_url($fields['add2_image']); ?>
												<img src="<?php echo esc_url( $flag2 ); ?>" class="minImg">
                                            <?php } ?>
                                            <?php if ( ! empty( $fields['add2_title'] ) ) { ?>
                                            	<h4 class="fontTxt txtDarkBlue MarginBottomZero font20 dirRTL">
													<?php echo wp_kses_post( $fields['add2_title'] ); ?></h4>
                                            <?php } ?>
										</div>
									</div>
                                </div>
                                <div class="row marginZero">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
										<?php if ( ! empty( $fields['add2_text'] ) ) { ?>
											<div class="div100 marginZero paddingZero">
												<?php echo wp_kses( $fields['add2_text'], array(
													'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
													'h3' => array('class' => array()),
													'a' => array(
														'href' => array(),'title' => array(),'target' => array(),
														'style' => array(),'class' => array(),'strong' => array(),
													),
													'strong' => array(),
												) ); ?>                                     
											</div>
										<?php } ?>
										<?php if ( ! empty( $fields['add2_text2'] ) ) { ?>
											<div class="div100 marginZero paddingZero">
												<?php echo wp_kses( $fields['add2_text2'], array(
													'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
													'h3' => array('class' => array()),
													'a' => array(
														'href' => array(),'title' => array(),'target' => array(),
														'style' => array(),'class' => array(),'strong' => array(),
													),
													'strong' => array(),
												) ); ?>   
											</div>
										<?php } ?>
									</div>
                                </div>
                            </div>
                        </div><!--2 Kiribati-->						
						
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 ">
                            <div class="campaignBox bgWhite MarginBottom25 padding40-iamDigital campaignContent div100 ">
                                <div class="row marginZero">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
                                        <div class="verticalAlignCenter MarginBottom25">
                                        	<?php if ( ! empty( $fields['add3_image'] ) ) { 
												$flag3 = wp_get_attachment_url($fields['add3_image']); ?>
                                            	<img src="<?php echo esc_url( $flag3 ); ?>" class="minImg">
                                            <?php } ?>
                                            <?php if ( ! empty( $fields['add3_title'] ) ) { ?>
                                            <h4 class="fontTxt txtDarkBlue MarginBottomZero font20 dirRTL"><?php echo wp_kses_post( $fields['add3_title'] ); ?></h4>
                        					<?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row marginZero">
                                	<?php if ( ! empty( $fields['add3_text'] ) ) { ?>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                             <?php echo wp_kses( $fields['add3_text'], array(
												'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
												'h3' => array('class' => array()),
												'a' => array(
													'href' => array(),'title' => array(),'target' => array(),
													'style' => array(),'class' => array(),'strong' => array(),
												),
												'strong' => array(),
											) ); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ( ! empty( $fields['add3_text2'] ) ) { ?>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                        <?php echo wp_kses( $fields['add3_text2'], array(
												'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
												'h3' => array('class' => array()),
												'a' => array(
													'href' => array(),'title' => array(),'target' => array(),
													'style' => array(),'class' => array(),'strong' => array(),
												),
												'strong' => array(),
											) ); ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div><!--3 PNG-->

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                            <div class="campaignBox bgWhite MarginBottom25 padding40-iamDigital campaignContent div100 ">
                                <div class="row marginZero">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
                                        <div class="verticalAlignCenter MarginBottom25">
                                        	<?php if ( ! empty( $fields['add4_image'] ) ) { 
												$flag4 = wp_get_attachment_url($fields['add4_image']); ?>
                                            	<img src="<?php echo esc_url( $flag4 ); ?>" class="minImg">
                                            <?php } ?>
                                            <?php if ( ! empty( $fields['add4_title'] ) ) { ?>
                                            <h4 class="fontTxt txtDarkBlue MarginBottomZero font20 dirRTL">
                                           <?php echo wp_kses_post( $fields['add4_title'] ); ?></h4>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ( ! empty( $fields['add4_text'] ) ) { ?>
                                <div class="row marginZero">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
                                        <?php echo wp_kses( $fields['add4_text'], array(
												'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
												'h3' => array('class' => array()),
												'a' => array(
													'href' => array(),'title' => array(),'target' => array(),
													'style' => array(),'class' => array(),'strong' => array(),
												),
												'strong' => array(),
											) ); ?>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div><!--4 Samoa-->

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                            <div class="campaignBox bgWhite MarginBottom25 padding40-iamDigital campaignContent div100 ">
                                <div class="row marginZero">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
                                        <div class="verticalAlignCenter MarginBottom25">
                                        	<?php if ( ! empty( $fields['add5_image'] ) ) { 
												$flag5 = wp_get_attachment_url($fields['add5_image']); ?>
                                            	<img src="<?php echo esc_url( $flag5 ); ?>" class="minImg">
                                            <?php } ?>
                                            <?php if ( ! empty( $fields['add5_title'] ) ) { ?>
                                            <h4 class="fontTxt txtDarkBlue MarginBottomZero font20 dirRTL"><?php echo wp_kses_post( $fields['add5_title'] ); ?></h4>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ( ! empty( $fields['add5_text'] ) ) { ?>
                                <div class="row marginZero">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
                                       <?php echo wp_kses( $fields['add5_text'], array(
												'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
												'h3' => array('class' => array()),
												'a' => array(
													'href' => array(),'title' => array(),'target' => array(),
													'style' => array(),'class' => array(),'strong' => array(),
												),
												'strong' => array(),
											) ); ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div><!--5 Solomon Islands--> 

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                            <div class="campaignBox bgWhite MarginBottom25 padding40-iamDigital campaignContent div100 ">
                                <div class="row marginZero">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
                                        <div class="verticalAlignCenter MarginBottom25">
                                        	<?php if ( ! empty( $fields['add6_image'] ) ) { 
												$flag6 = wp_get_attachment_url($fields['add6_image']); ?>
                                                <img src="<?php echo esc_url( $flag6 ); ?>" class="minImg" />
                                            <?php } ?>
                                            <?php if ( ! empty( $fields['add6_title'] ) ) { ?>
                                            	<h4 class="fontTxt txtDarkBlue MarginBottomZero font20 dirRTL"><?php echo wp_kses_post( $fields['add6_title'] ); ?></h4>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ( ! empty( $fields['add6_text'] ) ) { ?>
                                <div class="row marginZero">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
                                        <?php echo wp_kses( $fields['add6_text'], array(
												'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
												'h3' => array('class' => array()),
												'a' => array(
													'href' => array(),'title' => array(),'target' => array(),
													'style' => array(),'class' => array(),'strong' => array(),
												),
												'strong' => array(),
											) ); ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div><!--6 Tonga-->

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="campaignBox bgWhite MarginBottom25 padding40-iamDigital campaignContent div100 ">
                                <div class="row marginZero">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 paddingZero">
                                        <div class="verticalAlignCenter MarginBottom25">
                                        	<?php if ( ! empty( $fields['add7_image'] ) ) { 
												$flag7 = wp_get_attachment_url($fields['add7_image']); ?>
                                                    <img src="<?php echo esc_url( $flag7 ); ?>" class="minImg" alt="iamdigital" />
                                            <?php } ?>
                                            <?php if ( ! empty( $fields['add7_title'] ) ) { ?>
                                            <h4 class="fontTxt txtDarkBlue MarginBottomZero font20 dirRTL"><?php echo wp_kses_post( $fields['add7_title'] ); ?></h4>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row marginZero">
                                	<?php if ( ! empty( $fields['add7_text1'] ) ) { ?>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                       	<?php echo wp_kses( $fields['add7_text1'], array(
												'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
												'h3' => array('class' => array()),
												'a' => array(
													'href' => array(),'title' => array(),'target' => array(),
													'style' => array(),'class' => array(),'strong' => array(),
												),
												'strong' => array(),
											) ); ?>
                                    </div>
                                    <?php } ?>
                                    <?php if ( ! empty( $fields['add7_text2'] ) ) { ?>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                       <?php echo wp_kses( $fields['add7_text2'], array(
												'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
												'h3' => array('class' => array()),
												'a' => array(
													'href' => array(),'title' => array(),'target' => array(),
													'style' => array(),'class' => array(),'strong' => array(),
												),
												'strong' => array(),
											) ); ?>
                                    </div>
                                    <?php } ?>
                                    <?php if ( ! empty( $fields['add7_text3'] ) ) { ?>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                                        <?php echo wp_kses( $fields['add7_text3'], array(
												'br' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
												'h3' => array('class' => array()),
												'a' => array(
													'href' => array(),'title' => array(),'target' => array(),
													'style' => array(),'class' => array(),'strong' => array(),
												),
												'strong' => array(),
											) ); ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div><!--7 Vanuatu-->                         
                    </div>
                    <!--row-->    
                </div>
            </div>
        </section>
<?php if ( ! empty( $fields['note'] ) ) { ?>
	<section>
        <div class="container-fluid paddingZero bgLightGrey LeftRightPadding0">
            <div class="container TopBottomPadding50 ">
                <?php echo wp_kses( $fields['note'], array(
                        'br' => array( 'class' => array() ),
                        'p' => array( 'class' => array() ),
                        'h3' => array( 'class' => array() ),
                        'a' => array(
                            'href' => array(), 'title' => array(), 'target' => array(), 'style' => array()
                        ),
                        'strong' => array(), 'sup' => array(),
                ) ); ?>
            </div>
		</div>
	</section>
<?php } ?>

<?php get_footer(); ?>
<script>
$(document).on('hidden.bs.modal','.aboutmodal', function (event) {
	$('video').trigger('pause');
});
</script>
