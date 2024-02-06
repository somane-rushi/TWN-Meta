<?php
/**
 * Template part for displaying resources
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>
<?php $resource_attachment = wethinkdigital2022_get_resource_attachment( get_post_meta( get_the_ID(), 'resource_attachment' ) ); ?>
<?php $preview_img = $resource_attachment['resource_type'] === 'video' && ! empty( $resource_attachment['preview_img'] ) ? $resource_attachment['preview_img'] : false; 
$resource_custom_tag = get_post_meta( get_the_ID(), 'custom_tag', true );
?>

<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
	<div class="resourceBox PaddingBottom35">
        <div class="resImgBox MarginBottom15" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
        	<?php if ( ! empty( $resource_custom_tag ) ): ?>
        		<div class="featuredRes bgBlue fontTxt dirRTL"><p><?php echo esc_html( $resource_custom_tag ); ?></p></div>
            <?php elseif ( WP_Featured_Posts::is_featured( get_the_ID() ) ): ?>
            	<div class="featuredRes bgBlue fontTxt dirRTL"><p><?php esc_html_e( 'Featured', 'wethinkdigital2022' ); ?></p></div>
            <?php endif; ?>
            <?php if ( $resource_attachment['resource_type'] === 'video' ): ?>
                <a data-toggle="modal" data-target="#respopup<?php the_ID();?>" class="">
                    <img src="<?php echo esc_url( get_theme_file_uri( 'images/res-play.png' ) ); ?>" alt="WTD" class="resPlayIcon">
                </a>
            <?php endif; ?>
		</div>
        
        <?php if ( ! empty( $resource_attachment['content_type'] ) ): ?>
        	<h6 class="txtGrey dirRTL fontTxt MarginBottom15">
			<?php if ( ! empty($resource_attachment['typeofcontent'] ) ): ?>
					<?php echo esc_html( $resource_attachment['typeofcontent'] ); ?> 
					<?php else: ?>
					<?php wethinkdigital2022_the_resource_content_type_label( $resource_attachment ); ?>
            		<?php endif; ?>
				
            </h6>
        <?php endif; ?>
		<p class="font20 txtDarkBlue dirRTL fontDisplay MarginBottom10 resTitle"><?php the_title(); ?></p>
		<p class="font16 txtGrey dirRTL fontTxt MarginBottom15 resDesc"><?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?></p>
		<p class="txtMetaBlue resCTA">
        	<?php if ( $resource_attachment['resource_type'] === 'link' ): ?>
            		<a href="<?php echo esc_url( $resource_attachment['url'] ); ?>" target="_blank" class="font14 textLeft fontTxt MarginBottom15 txtMetaBlue">
					<?php if ( ! empty($resource_attachment['cta_btn_txt'] ) ): ?>
					<?php echo esc_html( $resource_attachment['cta_btn_txt'] ); ?> 
					<?php else: ?>
					<?php echo esc_html_e('Access', 'wethinkdigital2022' ); ?>
            		<?php endif; ?>
                    </a>
			<?php elseif ( $resource_attachment['resource_type'] === 'download' ): ?>
                    <a href="<?php echo esc_url( $resource_attachment['url'] ); ?>" target="_blank" class="font14 textLeft fontTxt MarginBottom15 txtMetaBlue"> 
					<?php if ( ! empty($resource_attachment['cta_btn_txt'] ) ): ?>
					<?php echo esc_html( $resource_attachment['cta_btn_txt'] ); ?> 
					<?php else: ?>
					<?php echo esc_html_e('Access', 'wethinkdigital2022' ); ?>
            		<?php endif; ?>
					<?php echo esc_html( ! empty( $resource_attachment['size'] ) ? sprintf( ' (%s)', $resource_attachment['size'] ) : '' ); ?> </a>
			<?php elseif ( $resource_attachment['resource_type'] === 'video' ): ?>
                    <a data-toggle="modal" data-target="#respopup<?php the_ID();?>" class="font14 textLeft txtMetaBlue fontTxt MarginBottom15">
					<?php if ( ! empty($resource_attachment['cta_btn_txt'] ) ): ?>
					<?php echo esc_html( $resource_attachment['cta_btn_txt'] ); ?> 
					<?php else: ?>
					<?php echo esc_html_e('View', 'wethinkdigital2022' ); ?>
            		<?php endif; ?>
                    </a>
			<?php elseif ( $resource_attachment['resource_type'] === 'content' ): ?>
            		<a data-toggle="modal" data-target="#rescpopup<?php the_ID();?>" class="font14 textLeft txtMetaBlue fontTxt MarginBottom15">
					<?php if ( ! empty($resource_attachment['cta_btn_txt'] ) ): ?>
					<?php echo esc_html( $resource_attachment['cta_btn_txt'] ); ?> 
					<?php else: ?>
					<?php echo esc_html_e('View', 'wethinkdigital2022' ); ?>
            		<?php endif; ?>
                    </a>
			<?php endif; ?>
        
			
		</p>
	</div><!--1-->
</div><!-- col4-->
<?php if ( $resource_attachment['resource_type'] === 'video' ) : ?>
<div class="modal fade aboutmodal" id="respopup<?php the_ID();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body bgLightGrey">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
				</button>
				<div class="container-full">
					<div class="TopBottomPadding35">
						<video width="100%" height="auto" controls autoplay muted class="resvd">
							<source src="<?php echo esc_url( $resource_attachment['url'] ); ?>" type="video/mp4">
								Your browser does not support the video tag.
						</video>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if ( $resource_attachment['resource_type'] === 'content' ) : ?>
<div class="modal fade aboutmodal" id="rescpopup<?php the_ID();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body bgLightGrey">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
				</button>
				<div class="container-full">
					<div class="TopBottomPadding50 LeftRightPadding15-acc">
						<div class="popUpScroll">
                        	<?php
								$field_group = $resource_attachment['con_fields'];
								foreach ( $field_group as $field_data ) {
									foreach ( $field_data as $data ) {
										
										if($field_data['sec_type']==='downloadlink')
										{
											if( !empty($data['con_dwntext']) && !empty($data['con_dwnlink']) ) { 
											$linkurl = wp_get_attachment_url( $data['con_dwnlink'] );
											?>
											<p class="MarginBottom15 font16 txtGrey">
												<a href="<?php echo esc_url( $linkurl ); ?>" target="_blank" class="font14 txtGrey textLeft fontTxt MarginBottom15" target="_blank">
													<?php echo esc_html( $data['con_dwntext'] ); ?>&nbsp;&nbsp; <i class="fas fa-arrow-down"></i>
												</a>                        
											</p>
                                            <?php }
										}
										
										if($field_data['sec_type']==='fulltext')
										{
											if( !empty($data['con_title']) ) { ?>
                                                <h4 class="txtDarkBlue dirRTL fontDisplay MarginBottom15">
                                                    <?php echo esc_html( $data['con_title'] ); ?>
                                                </h4>
                                            <?php } if( !empty($data['con_des']) ) { ?>
                                            <div class="font16 txtGrey dirRTL fontTxt MarginBottom15">
                                            	<?php echo wp_kses( $data['con_des'], 
													array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
													'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
													'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
													'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
													'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
													'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array(),'class' => array() ),
													'strong' => array(), 'class' => array() ) );
												?>
                                            </div>
                                            <?php }
										}
										
										if($field_data['sec_type']==='accordian')
										{
											if( !empty($data['con_accor']) ) {
												
												echo '<div class="container-fluid paddingZero">
														<div class="accordion bgLightGrey" id="faq2">
															<div class="card borderNone bgLightGrey">';
												$i=1;
												foreach ($data['con_accor'] as $acc ) {
													$faqid = get_the_ID().$i;
													if ( !empty( $acc['acc_title'] ) ):
													echo '<div class="card-header padding15-accordian borderNone bgLightGrey" id="faqhead'.esc_html($faqid).'">
															<a href="#" class="btn btn-header-link fontDisplay resAccTitle txtDarkBlue collapsed paddingZero" data-toggle="collapse" data-target="#faq'.esc_html($faqid).'" aria-expanded="true" aria-controls="faq'.esc_html($faqid).'" style="display: block; text-align: left;">'.esc_html($acc['acc_title']).'
															<i class="fas fa-chevron-down txtDarkBlue accIcon"></i>
															</a>
															
														</div>';
												
													echo '<div id="faq'.esc_html($faqid).'" class="collapse" aria-labelledby="faqhead'.esc_html($faqid).'" data-parent="#faq'.esc_html($faqid).'"><div class="card-body font16 txtGrey dirRTL fontTxt MarginBottom15 padding15">';
													if ( !empty( $acc['acc_title'] ) ):
														echo wp_kses( $acc['acc_text'], 
														array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ), 'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ), 'strong' => array(),'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array(),'class' => array() ), 'video' => array( 'width' => array(), 'height' => array(), 'poster' => array(), 'preload' => array(), 'controls' => array(), 'source' => array(),'type' => array(),'class' => array() ),'source' => array( 'type' => array(),'class' => array() ),'class' => array() ) );
													endif;
													
													if ( !empty( $acc['acc_file'] ) ):
														$vdurl = wp_get_attachment_url( $acc['acc_file'] );
														?>
                                                        	<video width="100%" height="auto" controls="" muted=""
                                                             id="<?php echo 'acvd'.esc_html($faqid); ?>" class="resvd">
                                                            	<source src="<?php echo esc_url( $vdurl ); ?>" type="video/mp4">
                                                                Your browser does not support the video tag.
															</video>
                                                            <script>
															$("#rescpopup<?php the_ID();?>").on('hidden.bs.modal', function (e) {
																$('#<?php echo 'acvd'.esc_html($faqid); ?>').get(0).pause();
															});
															</script>
                                                        <?php
													endif;
													
													echo '</div></div>';
													endif;
													$i++;
												}
												
												echo '</div></div></div>';												
											}
										} 
										
									}
								}
								
							?>
                        
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>