<?php
/**
 * The template for displaying iamdigital archive pages
 */

get_header();
global $wp_query;
$category_query_var_name = 'countries';
$language_query_var_name = 'languages';
$fields = get_option( "archive_iamdigital", array() );
if(isset($_GET['countries'])){ $param_country = sanitize_key($_GET['countries']); }
if(isset($_GET['languages'])){ $param_lang = sanitize_key($_GET['languages']); }
?>

<?php if ( ! empty( $fields['head_image'] ) ) { 
	$headbg = wp_get_attachment_url($fields['head_image']);
?>
    <section class="pi-masthead">
    	<img src="<?php echo esc_url( $headbg ); ?>" alt="iamdigital"/>
	</section>
<?php } ?>

<?php if ( ! empty( $fields['description'] ) || ! empty( $fields['heading'] ) ) { ?>
<section class="jumbotron o-wrap u-animated u-animated--btm-top">
	<div class="divHeight50"></div>
    <?php if ( ! empty( $fields['heading'] ) ) { ?>
		<h2 class="jumbotron__heading text-center text-blue text-upper fontOpt_Display"><?php echo wp_kses_post( $fields['heading'] ); ?></h2>
    <?php } ?>
    <?php if ( ! empty( $fields['description'] ) ) { ?>
        <p class="jumbotron__description text-center text-black fontOpt_ExtraLight">
			<?php echo wp_kses( $fields['description'], array(
					'br' => array(
						'class' => array()
					),
				) ); ?>
		</p>
	<?php } ?>
</section>
<?php } ?>
<?php if ( ! empty( $fields['digi_image'] ) ) {
	$seconebg = wp_get_attachment_url($fields['digi_image']); ?>
	<section class="jumbotron o-wrap u-animated u-animated--btm-top">
		<img src="<?php echo esc_url( $seconebg ); ?>" alt="iamdigital" class="jumbotron__img" />
	</section>
<?php } ?>

<?php if ( ! empty( $fields['post_title'] ) ) { ?>
	<section class="jumbotron o-wrap u-animated u-animated--btm-top">
		<h2 class="jumbotron__heading text-center text-blue text-upper fontOpt_Display"><?php echo wp_kses_post( $fields['post_title'] ); ?></h2>
	</section>
<?php } ?>

<?php if ( have_posts() ) : 
	$serurl=esc_url( get_post_type_archive_link( 'iamdigital' ) ); $firstcont=''; $firstcontname=''; ?>

	<section class="jumbotron scrolldiv" id="divcount">
		<div class="o-wrap">
			<div class="o-layout o-layout--stretch">
			<?php $digi_country_terms = fbiamdigital_get_terms( array(
                'taxonomy' => 'pccountry',
				'parent' => 0,
            ) ); 
			
			$firstcont=$digi_country_terms[0]->term_id;
			$firstcontname=$digi_country_terms[0]->slug;
			?>
            <?php if ( ! empty( $digi_country_terms ) ):; ?>
                <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs u-animated u-animated--btm-top marginBottom" style="transition-delay: 200ms;">
                	<?php $serurl=$serurl.'?'; ?>
                	<form class="c-listing-filter__inner o-box divWidth100 fontOpt_ExtraLight" action="<?php echo esc_url( get_post_type_archive_link( 'iamdigital' ) ); ?>">
						<div class="lang-direction-horizontal fontOpt_ExtraLight">
							<span class="fontOpt_ExtraLight"><?php echo esc_html_x( 'Countries', 'Filter', 'fbiamdigital' ); ?></span><br>
							<select name="countries" class="c-select select2-hidden-accessible fontOpt_ExtraLight" tabindex="-1" aria-hidden="true" onchange="bindurl(this.value,'<?php echo esc_url($serurl); ?>','county')">
                            	<?php foreach ( $digi_country_terms as $digi_country_terms ): $sel='';
										if(!empty($param_country)){
											if($digi_country_terms->slug===$param_country){ $sel= 'selected'; }
										}
								?>
                                <option <?php echo esc_attr($sel); ?> value="<?php echo esc_attr( $digi_country_terms->slug ); ?>"><?php echo esc_html( $digi_country_terms->name ); ?></option>
							<?php endforeach; ?>
                            
                            </select>
						</div>
					</form>
				</div>
            <?php endif; ?>
			<?php 
				
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
                <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs u-animated u-animated--btm-top marginBottom" style="transition-delay: 200ms;">
                	
                	<form class="c-listing-filter__inner o-box divWidth100 fontOpt_ExtraLight" id="postlang"
                    action="<?php echo esc_url( $serurl ); ?>">
                    	<div class="lang-direction-horizontal fontOpt_ExtraLight">
							<span><?php echo esc_html_x( 'Languages', 'Filter', 'fbiamdigital' ); ?></span><br>
							<select name="languages" class="c-select select2-hidden-accessible fontOpt_ExtraLight"  tabindex="-1" aria-hidden="true" onchange="bindurl(this.value,'<?php echo esc_url($serurl); ?>','lang')">
                                <?php foreach ( $digi_lang_terms as $digi_lang_terms ): ?>
								<option <?php if(!empty($param_lang)){ selected( $digi_lang_terms->slug, $param_lang, true ); } else { selected( $digi_lang_terms->slug, $firstlangname, true ); } ?> value="<?php echo esc_attr( $digi_lang_terms->slug ); ?>"><?php echo esc_html( $digi_lang_terms->name ); ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</form>
				</div>
            <?php endif; ?>
            </div>
		</div>
	</section>
    <section class="c-listing imdigital">
		<div class="o-wrap">
			<div id="content" class="o-layout o-layout--stretch">
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
		</div>
	</section> 
    <!--video Section-->

<?php endif; ?>

<?php if ( ! empty( $fields['help_title'] ) ) { ?>
	<section class="jumbotron o-wrap u-animated u-animated--btm-top">
		<h2 class="jumbotron__heading text-center text-blue text-upper fontOpt_Display"><?php echo wp_kses_post( $fields['help_title'] ); ?></h2>
	</section>
<?php } ?>
	<section class="jumbotron">
		<div class="o-wrap">
			<div class="o-layout o-layout--stretch">
            
            	<div class="o-layout__item u-1/1@xl u-1/1@md u-1/1@xs u-animated u-animated--fade-in" style="transition-delay: 0ms;">
                	<div class="o-box c-listing-item paddingDiv" >
                    	<?php if ( ! empty( $fields['add1_title'] ) ) { ?>
                            <div class="countryTitle">
                                <?php if ( ! empty( $fields['add1_image'] ) ) { $flag1 = wp_get_attachment_url($fields['add1_image']); ?>
                                    <img src="<?php echo esc_url( $flag1 ); ?>" alt="iamdigital" />
                                <?php } ?>
                                    <h1 class="fontOpt_ExtraLight text-blue">
										<?php echo wp_kses_post( $fields['add1_title'] ); ?></h1>
                            </div>
                        <?php } ?>
                        <?php if ( ! empty( $fields['add1_text1'] ) || ! empty( $fields['add1_text2'] ) || ! empty( $fields['add1_text3'] ) ) { ?>
                        	<div class="o-layout o-layout--stretch" style="margin-left:0px;">
                            	<?php if ( ! empty( $fields['add1_text1'] ) ) { ?>
								<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
									<div class="countryInfo">
		                            	<?php echo wp_kses( $fields['add1_text1'], array(
											'br' => array(
												'class' => array()
											),
											'p' => array(
												'class' => array()
											),
											'h3' => array(
												'class' => array()
											),
											'a' => array(
												'href' => array(),
												'title' => array(),
												'target' => array(),
												'style' => array()
											),
											'strong' => array(),
										) ); ?>
									</div>
								</div>
                                <?php } ?>
                                <?php if ( ! empty( $fields['add1_text2'] ) ) { ?>
								<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
									<div class="countryInfo">
										<?php echo wp_kses( $fields['add1_text2'], array(
											'br' => array(
												'class' => array()
											),
											'p' => array(
												'class' => array()
											),
											'h3' => array(
												'class' => array()
											),
											'a' => array(
												'href' => array(),
												'title' => array(),
												'target' => array(),
												'style' => array()
											),
											'strong' => array(),
										) ); ?>
									</div>
								</div>
								<?php } ?>
                                <?php if ( ! empty( $fields['add1_text3'] ) ) { ?>
								<div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
		                        	<div class="countryInfo">
		                            	<?php echo wp_kses( $fields['add1_text3'], array(
											'br' => array(
												'class' => array()
											),
											'p' => array(
												'class' => array()
											),
											'h3' => array(
												'class' => array()
											),
											'a' => array(
												'href' => array(),
												'title' => array(),
												'target' => array(),
												'style' => array()
											),
											'strong' => array(),
										) ); ?>
									</div>
								</div>
                                <?php } ?>
							</div>
						<?php } ?>
					</div>
				</div><!--Fiji-->
                
                <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in u-animated--animate" style="transition-delay: 100ms;">
                <div class="o-box c-listing-item paddingDiv">
                    <div class="countryTitle">
                        <?php if ( ! empty( $fields['add2_image'] ) ) { $flag2 = wp_get_attachment_url($fields['add2_image']); ?>
                        		<img src="<?php echo esc_url( $flag2 ); ?>" alt="iamdigital" />
                        <?php } ?>
                        <?php if ( ! empty( $fields['add2_title'] ) ) { ?>
                        		<h1 class="fontOpt_ExtraLight text-blue"><?php echo wp_kses_post( $fields['add2_title'] ); ?></h1>
                        <?php } ?>
                    </div>
					<div class="o-layout o-layout--stretch" style="margin-left:0px;">
                        <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
                        	<?php if ( ! empty( $fields['add2_text'] ) ) { ?>
                            <div class="countryInfo">
								<?php echo wp_kses( $fields['add2_text'], array(
										'br' => array(
											'class' => array()
										),
										'p' => array(
											'class' => array()
										),
										'h3' => array(
											'class' => array()
										),
										'a' => array(
											'href' => array(),
											'title' => array(),
											'target' => array(),
											'style' => array()
										),
										'strong' => array(),
									) ); ?>
                            </div>
                            <?php } ?>
                        </div><!--first col-->
                        <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
                        	<?php if ( ! empty( $fields['add2_text2'] ) ) { ?>
                            <div class="countryInfo">
								<?php echo wp_kses( $fields['add2_text2'], array(
										'br' => array(
											'class' => array()
										),
										'p' => array(
											'class' => array()
										),
										'h3' => array(
											'class' => array()
										),
										'a' => array(
											'href' => array(),
											'title' => array(),
											'target' => array(),
											'style' => array()
										),
										'strong' => array(),
									) ); ?>                     
                            </div>
                            <?php } ?>
                        </div><!--second col-->                        
                    </div>						
                </div>
            </div>
            
            <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in u-animated--animate" style="transition-delay: 100ms;">
                <div class="o-box c-listing-item paddingDiv">
                    <div class="countryTitle">
                    	<?php if ( ! empty( $fields['add3_image'] ) ) { $flag3 = wp_get_attachment_url($fields['add3_image']); ?>
                        		<img src="<?php echo esc_url( $flag3 ); ?>" alt="iamdigital" />
                        <?php } ?>
                        <?php if ( ! empty( $fields['add3_title'] ) ) { ?>
                        		<h1 class="fontOpt_ExtraLight text-blue"><?php echo wp_kses_post( $fields['add3_title'] ); ?></h1>
                        <?php } ?>
                    </div>                    
                    <div class="o-layout o-layout--stretch" style="margin-left:0px;">
                        <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
                            <?php if ( ! empty( $fields['add3_text'] ) ) { ?>
                            <div class="countryInfo">
								<?php echo wp_kses( $fields['add3_text'], array(
										'br' => array(
											'class' => array()
										),
										'p' => array(
											'class' => array()
										),
										'h3' => array(
											'class' => array()
										),
										'a' => array(
											'href' => array(),
											'title' => array(),
											'target' => array(),
											'style' => array()
										),
										'strong' => array(),
									) ); ?>
                            </div>
                            <?php } ?>
                        </div><!--first col-->
                        <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
                            <?php if ( ! empty( $fields['add3_text2'] ) ) { ?>
                            <div class="countryInfo">
								<?php echo wp_kses( $fields['add3_text2'], array(
										'br' => array(
											'class' => array()
										),
										'p' => array(
											'class' => array()
										),
										'h3' => array(
											'class' => array()
										),
										'a' => array(
											'href' => array(),
											'title' => array(),
											'target' => array(),
											'style' => array()
										),
										'strong' => array(),
									) ); ?>                     
                            </div>
                            <?php } ?>
                        </div>                  
                    </div>
                </div>
            </div>
             
            <div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in u-animated--animate" style="transition-delay: 300ms;">
                <div class="o-box c-listing-item paddingDiv">
                    <div class="countryTitle">
                    	<?php if ( ! empty( $fields['add4_image'] ) ) { $flag4 = wp_get_attachment_url($fields['add4_image']); ?>
                        		<img src="<?php echo esc_url( $flag4 ); ?>" alt="iamdigital" />
                        <?php } ?>
                        <?php if ( ! empty( $fields['add4_title'] ) ) { ?>
                        		<h1 class="fontOpt_ExtraLight text-blue"><?php echo wp_kses_post( $fields['add4_title'] ); ?></h1>
                        <?php } ?>
                    </div>
                    <?php if ( ! empty( $fields['add4_text'] ) ) { ?>
                    		<div class="countryInfo">
								<?php echo wp_kses( $fields['add4_text'], array(
										'br' => array(
											'class' => array()
										),
										'p' => array(
											'class' => array()
										),
										'h3' => array(
											'class' => array()
										),
										'a' => array(
											'href' => array(),
											'title' => array(),
											'target' => array(),
											'style' => array()
										),
										'strong' => array(),
									) ); ?>                     
                            </div>
					<?php } ?>
                </div>
            </div>
            <!--4. Samoa-->
            <div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in u-animated--animate" style="transition-delay: 500ms;">
                <div class="o-box c-listing-item paddingDiv">
                    <div class="countryTitle">
                        <?php if ( ! empty( $fields['add5_image'] ) ) { $flag5 = wp_get_attachment_url($fields['add5_image']); ?>
                        		<img src="<?php echo esc_url( $flag5 ); ?>" alt="iamdigital" />
                        <?php } ?>
                        <?php if ( ! empty( $fields['add5_title'] ) ) { ?>
                        		<h1 class="fontOpt_ExtraLight text-blue"><?php echo wp_kses_post( $fields['add5_title'] ); ?></h1>
                        <?php } ?>
                    </div>
                    <?php if ( ! empty( $fields['add5_text'] ) ) { ?>
                    		<div class="countryInfo">
								<?php echo wp_kses( $fields['add5_text'], array(
										'br' => array(
											'class' => array()
										),
										'p' => array(
											'class' => array()
										),
										'h3' => array(
											'class' => array()
										),
										'a' => array(
											'href' => array(),
											'title' => array(),
											'target' => array(),
											'style' => array()
										),
										'strong' => array(),
									) ); ?>                     
                            </div>
					<?php } ?>
                </div>
            </div>
            <!--5. Solomon Islands-->
            <div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in u-animated--animate" style="transition-delay: 500ms;">
                <div class="o-box c-listing-item paddingDiv">
                    <div class="countryTitle">
                        <?php if ( ! empty( $fields['add6_image'] ) ) { $flag6 = wp_get_attachment_url($fields['add6_image']); ?>
                        		<img src="<?php echo esc_url( $flag6 ); ?>" alt="iamdigital" />
                        <?php } ?>
                        <?php if ( ! empty( $fields['add6_title'] ) ) { ?>
                        		<h1 class="fontOpt_ExtraLight text-blue"><?php echo wp_kses_post( $fields['add6_title'] ); ?></h1>
                        <?php } ?>
                    </div>
                    <?php if ( ! empty( $fields['add6_text'] ) ) { ?>
                    		<div class="countryInfo">
								<?php echo wp_kses( $fields['add6_text'], array(
										'br' => array(
											'class' => array()
										),
										'p' => array(
											'class' => array()
										),
										'h3' => array(
											'class' => array()
										),
										'a' => array(
											'href' => array(),
											'title' => array(),
											'target' => array(),
											'style' => array()
										),
										'strong' => array(),
									) ); ?>                     
                            </div>
					<?php } ?>
                </div>
            </div>
            <div class="o-layout__item u-1/1@xl u-1/1@md u-1/1@xs u-animated u-animated--fade-in u-animated--animate" style="transition-delay: 0ms;">
                <div class="o-box c-listing-item paddingDiv">
                    <div class="countryTitle">
                        <?php if ( ! empty( $fields['add7_image'] ) ) { $flag7 = wp_get_attachment_url($fields['add7_image']); ?>
                        		<img src="<?php echo esc_url( $flag7 ); ?>" alt="iamdigital" />
                        <?php } ?>
                        <?php if ( ! empty( $fields['add7_title'] ) ) { ?>
                        		<h1 class="fontOpt_ExtraLight text-blue"><?php echo wp_kses_post( $fields['add7_title'] ); ?></h1>
                        <?php } ?>
                    </div>
                    <div class="o-layout o-layout--stretch" style="margin-left:0px;">
                        <div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
                            <?php if ( ! empty( $fields['add7_text1'] ) ) { ?>
                                <div class="countryInfo">
                                    <?php echo wp_kses( $fields['add7_text1'], array(
                                            'br' => array(
                                                'class' => array()
                                            ),
                                            'p' => array(
                                                'class' => array()
                                            ),
                                            'h3' => array(
                                                'class' => array()
                                            ),
                                            'a' => array(
                                                'href' => array(),
                                                'title' => array(),
												'target' => array(),
												'style' => array()
                                            ),
                                            'strong' => array(),
                                        ) ); ?>                     
                                </div>
							<?php } ?>
                        </div>
                        <div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
                            <?php if ( ! empty( $fields['add7_text2'] ) ) { ?>
                                <div class="countryInfo">
                                    <?php echo wp_kses( $fields['add7_text2'], array(
                                            'br' => array(
                                                'class' => array()
                                            ),
                                            'p' => array(
                                                'class' => array()
                                            ),
                                            'h3' => array(
                                                'class' => array()
                                            ),
                                            'a' => array(
                                                'href' => array(),
                                                'title' => array(),
												'target' => array(),
												'style' => array()
                                            ),
                                            'strong' => array(),
                                        ) ); ?>                     
                                </div>
							<?php } ?>
                        </div>
                        <div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs" style="padding-left:0px;">
                            <?php if ( ! empty( $fields['add7_text3'] ) ) { ?>
                                <div class="countryInfo">
                                    <?php echo wp_kses( $fields['add7_text3'], array(
                                            'br' => array(
                                                'class' => array()
                                            ),
                                            'p' => array(
                                                'class' => array()
                                            ),
                                            'h3' => array(
                                                'class' => array()
                                            ),
                                            'a' => array(
                                                'href' => array(),
                                                'title' => array(),
												'target' => array(),
												'style' => array()
                                            ),
                                            'strong' => array(),
                                        ) ); ?>                     
                                </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            
			</div>
		</div>    
</section>
<?php if ( ! empty( $fields['note'] ) ) { ?>
	<section class="c-home-cite-ref">
		<div class="o-wrap">
			<?php echo wp_kses( $fields['note'], array(
					'br' => array(
						'class' => array()
					),
					'p' => array(
						'class' => array()
					),
					'h3' => array(
						'class' => array()
					),
					'a' => array(
						'href' => array(),
						'title' => array(),
						'target' => array(),
						'style' => array()
					),
					'strong' => array(),
					'sup' => array(),
			) ); ?>
		</div>
	</section>

<?php } ?>

<div class="c-doodad-footer-resources">
	<div></div>
	<div></div>
	<div></div>
</div>

<?php get_footer(); ?>