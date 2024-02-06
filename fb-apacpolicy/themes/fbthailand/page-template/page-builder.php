<?php
/*
Template Name: Page Builder
*/
get_header();
?>
<style>
.australia-block:before{ background: transparent; }
</style>
<?php
	$components = get_post_meta( get_the_ID(), 'body', true );
	if ( ! empty( $components ) ): 
		foreach ( $components as $component ):
			$field_name = 'component_' . $component['component_type'];
			if ( empty( $component[ $field_name ] ) ) {
				continue;
			}
			$fields = $component[ $field_name ];
			switch ( $component['component_type'] ):
				case 'fullsecti':
					if ( ! empty( $fields['title']) || ! empty( $fields['description']) || ! empty( $fields['image'] ) ):
						$bgimg = wp_get_attachment_url($fields['image']); ?>
                        <section class="australia-tab-section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="australia-block " style="background-image: url(<?php echo esc_url($bgimg) ?>);">
                                    	<?php if ( ! empty( $fields['title'] ) ): ?>
                                            <h2><?php echo wp_kses_post( $fields['title'] ); ?></h2>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $fields['subheading'] ) ): ?>
                                            <h4><?php echo wp_kses( $fields['subheading'], array(
                                                    'br' => array( 'class' => array() ),
                                                    'strong' => array(),
                                                ) ); ?></h4>
                                             <?php endif; ?>
                                         <?php if ( ! empty( $fields['description'] ) ): ?>
                                                <?php echo wp_kses( $fields['description'], array(
                                                    'br' => array( 'class' => array() ),
                                                    'strong' => array(),
                                                    'h3' => array( 'class' => array() ), 'h2' => array( 'class' => array() ),
													'h1' => array( 'class' => array() ),'h4' => array( 'class' => array() ),
                                                    'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'ul' => array( 'class' => array() ),
                                                    'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array(),'class' => array() ),
                                                ) ); ?>
                                         <?php endif; ?>
                                         <?php if ( ! empty( $fields['buttontext'] ) ): ?>
                                            <p><a href="<?php echo esc_url( $fields['buttonlink']  ); ?>" target="_blank">
                                            <span class="fa fa-arrow-right"></span>
                                            <?php echo wp_kses_post( $fields['buttontext'] ); ?></a></p>
                                         <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                         </section>
                        
                        <?php
					
					endif;
				break;
				case 'fullvd':
					if ( ! empty( $fields['file_fullvd']) ):
					?>
                    <section class="vid-full-section">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 videoBoxFull">
                                    <div class="row">
                                        <?php
                                            $vimg = wp_get_attachment_url($fields['videoimage_fullvd']);
                                            $video = wp_get_attachment_url($fields['file_fullvd']);
                                            ?>
                                        <video controls autoplay muted poster="<?php echo esc_url($vimg) ?>">
                                            <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
					endif;
				break;
				case 'ltiri':
					if ( ! empty( $fields['title_ltiri'] ) || ! empty( $fields['desc_ltiri'] ) ): ?>
                    	<section class="full-txt bgWhite">
                            <div class="container txtSectionFull">
                                <div class="div80">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 redLink ">
                                        <?php if ( ! empty( $fields['title_ltiri'] ) ): ?>
                                            <h1 class="txtGrey"><?php echo wp_kses_post( $fields['title_ltiri'] ); ?></h1>
                                        <?php endif; ?>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 txtGrey">
                                            <?php if ( ! empty( $fields['desc_ltiri'] ) ): ?>
                                            <?php echo wp_kses( $fields['desc_ltiri'], array(
                                                    'br' => array( 'class' => array() ),
                                                    'strong' => array(),
                                                    'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                ) ); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>                    
                    <?php
					endif;
				break;
				case 'lirt':
					if ( ! empty( $fields['image_lirt']) || ! empty( $fields['title_lirt']) || ! empty( $fields['description_lirt'] ) || ! empty( $fields['file_lirt']) ): 
						$bgcolor='bgLightOrnage'; $fntcolor="txtRed2";
						if ( ! empty( $fields['bgcolor']) ){ 
							if ( $fields['bgcolor']==='red' ){ $bgcolor='bgLightPink'; $fntcolor='txtRed'; }
							if ( $fields['bgcolor']==='orange' ){ $bgcolor='bgLightOrnage'; $fntcolor='txtRed2'; }
						}
					?>
					<section class="vid-section">
                        <div class="container-fluid">
                            <div class="row">
                            	<?php if ( ! empty( $fields['image_lirt'])) {
									$bgimg = wp_get_attachment_url($fields['image_lirt']); ?>
                            		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox" style="background-image:url('<?php echo esc_url($bgimg) ?>');"></div>
                                <?php } else if ( ! empty( $fields['file_lirt'] ) ): ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox bgBlack">
                                    <div class="row">
                                    <?php 
                                    
                                        $vimg = wp_get_attachment_url($fields['videoimage_lirt']);
                                        $video = wp_get_attachment_url($fields['file_lirt']);
                                        ?>
                                        <video controls preload="none" poster="<?php echo esc_url($vimg) ?>">
                                            <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                                        </video>
                                    
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php echo esc_attr($bgcolor); ?> videoBox2">
                                    <div class="div70">
                                        <?php if ( ! empty( $fields['title_lirt'] ) ): ?>
                                            <h1 class="txtRed"><?php echo wp_kses_post( $fields['title_lirt'] ); ?></h1>
                                        <?php endif; ?>
                                        <div class="scrollBoxVideo">
                                            <?php if ( ! empty( $fields['description_lirt'] ) ): ?>
                                                <p class="<?php echo esc_attr($fntcolor); ?>"><?php echo wp_kses( $fields['description_lirt'], array(
                                                    'br' => array( 'class' => array() ),
                                                    'strong' => array(),
                                                    'p' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                ) ); ?></p>
                                            <?php endif; ?>
                                        </div><!--New Edit-->
                                        <?php if ( ! empty( $fields['btntext_ltri'] ) ): ?>
                                        <p class="<?php echo esc_attr($bgcolor); ?>">                       					
                                            <a href="<?php echo esc_url( $fields['btnlink_ltri'] ); ?>" target="_blank" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $fields['btntext_ltri'] ); ?></a>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
							</div>
                        </div>
                    </section>
					<?php
					endif;
				break;
				case 'ltri':
					if ( ! empty( $fields['image_ltri']) || ! empty( $fields['title_ltri']) || ! empty( $fields['description_ltri'] ) || ! empty( $fields['file_ltri']) ): 
						$bgcolor='bgLightOrnage'; $fntcolor="txtRed2";
						if ( ! empty( $fields['bgcolor']) ){ 
							if ( $fields['bgcolor']==='red' ){ $bgcolor='bgLightPink'; $fntcolor='txtRed'; }
							if ( $fields['bgcolor']==='orange' ){ $bgcolor='bgLightOrnage'; $fntcolor='txtRed2'; }
						}
						?>
                        <section class="img-txt-section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php echo esc_attr($bgcolor); ?> mediaBox">
                                        <div class="div70">
                                            <?php if ( ! empty( $fields['title_ltri'] ) ): ?>
                                                <h1 class="txtRed"><?php echo wp_kses_post( $fields['title_ltri'] ); ?></h1>
                                            <?php endif; ?>
                                            <div class="scrollBoxVideo <?php echo esc_attr($fntcolor); ?>">
                                            <?php if ( ! empty( $fields['description_ltri'] ) ): ?>
                                                    <?php echo wp_kses( $fields['description_ltri'], array(
                                                        'br' => array( 'class' => array() ), 'strong' => array(),
                                                        'p' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 
                                                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                        ) ); ?>
                                            <?php endif; ?>
                                            </div>
                                            <?php if ( ! empty( $fields['btntext_ltri'] ) ): ?>
                                                <p class="<?php echo esc_attr($fntcolor); ?>">  
                                                    <a href="<?php echo esc_url( $fields['btnlink_ltri'] ); ?>" class="<?php echo esc_attr($fntcolor); ?>" target="_blank"><span class="fa fa-arrow-right <?php echo esc_attr($fntcolor); ?>"></span><?php echo wp_kses_post( $fields['btntext_ltri'] ); ?></a>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                        if ( ! empty( $fields['image_ltri'] ) ){
                                            $leftsideimage = wp_get_attachment_url($fields['image_ltri']);
                                            ?>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox" 
                                                style="background-image: url('<?php echo esc_url($leftsideimage) ?>')")></div>
                                    <?php } else if ( ! empty( $fields['file_ltri'] ) ): ?>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox bgBlack">
                                            <div class="row">
                                            <?php 
                                            
                                                $vimg = wp_get_attachment_url($fields['videoimage_ltri']);
                                                $video = wp_get_attachment_url($fields['file_ltri']);
                                                ?>
                                                <video controls preload="none" poster="<?php echo esc_url($vimg) ?>">
                                                    <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                                                </video>
                                            
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                        
                                </div>
                            </div>
						</section>
                        <?php
					endif;
				break;
				case 'tcwf':
					if ( ! empty( $fields['heading'] ) ): 
					?>
                    <section class="full-title-section bgWhite">
                        <div class="container titleSectionFull ">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h1 class="text-center txtBlueGrey"><?php echo wp_kses_post( $fields['heading'] ); ?></h1>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php endif; 
					$flipone = wp_get_attachment_url($fields['image_left']); 
					$fliptwo = wp_get_attachment_url($fields['image_right']); 
					$bgcolor=''; $fntcolor=""; $bgcolor_rt=''; $fntcolor_rt="";
					if ( ! empty( $fields['bgcolor']) ){ 
						if ( $fields['bgcolor']==='orange' ){ $bgcolor='bgorange'; }
						if ( $fields['bgcolor']==='brown' ){ $bgcolor='bgbrown'; }
						if ( $fields['bgcolor']==='darkorange' ){ $bgcolor='bgdarkorange'; }
						if ( $fields['bgcolor']==='beige' ){ $bgcolor='bgbeige'; }
					}
					if ( ! empty( $fields['fncolor']) ){ 
						if ( $fields['fncolor']==='brown' ){ $fntcolor='txtBrown'; }
						if ( $fields['fncolor']==='white' ){ $fntcolor='fnwhite'; }
					}
					if ( ! empty( $fields['bgcolor_right']) ){ 
						if ( $fields['bgcolor_right']==='orange' ){ $bgcolor_rt='bgorange'; }
						if ( $fields['bgcolor_right']==='brown' ){ $bgcolor_rt='bgbrown'; }
						if ( $fields['bgcolor_right']==='darkorange' ){ $bgcolor_rt='bgdarkorange'; }
						if ( $fields['bgcolor_right']==='beige' ){ $bgcolor_rt='bgbeige'; }
					}
					if ( ! empty( $fields['fncolor_right']) ){ 
						if ( $fields['fncolor_right']==='brown' ){ $fntcolor_rt='txtBrown'; }
						if ( $fields['fncolor_right']==='white' ){ $fntcolor_rt='fnwhite'; }
					}
					?>
                    <section class="flip-section econ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flipBox flipBoxLeft">
                                    <div class="flip-card">
                                        <div class="flip-card-inner">
                                            <div class="flip-card-front" style="background-image:url('<?php echo esc_url($flipone); ?>');">
                                            <?php if ( ! empty( $fields['title_left'] ) ): ?>
                                                <h1 class="txtWhite2"><a href="" class="txtWhite"><span class="fa fa-arrow-right txtWhite"></span>
                                                <br/><?php echo wp_kses_post( $fields['title_left'] ); ?></a></h1>
                                            <?php endif; ?>
                                            </div>
                                            <div class="flip-card-back <?php echo esc_attr($bgcolor); ?>" <?php echo esc_attr($fntcolor); ?>>
                                                <?php if ( ! empty( $fields['desc_left'] ) ): ?>
                                                    <?php echo wp_kses( $fields['desc_left'], array(
                                                        'br' => array( 'class' => array() ),
                                                        'strong' => array(),
                                                        'h3' => array(), 'span' => array( 'class' => array() ),
                                                        'p' => array( 'class' => array() ),
                                                        'ul' => array( 'class' => array() ),
                                                        'li' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                    ) ); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flipBox flipBoxRight">
                                    <div class="flip-card">
                                        <div class="flip-card-inner">
                                            <div class="flip-card-front" style="background-image:url('<?php echo esc_url($fliptwo); ?>');">
                                            <?php if ( ! empty( $fields['title_right'] ) ): ?>
                                                <h1 class="txtWhite2"><a href="" class="txtWhite"><span class="fa fa-arrow-right txtWhite"></span>
                                                <br/><?php echo wp_kses_post( $fields['title_right'] ); ?></a></h1>
                                            <?php endif; ?>
                                            </div>
                                            <div class="flip-card-back <?php echo esc_attr($bgcolor_rt); ?> <?php echo esc_attr($fntcolor_rt); ?>">
                                                <?php if ( ! empty( $fields['desc_right'] ) ): ?>
                                                    <?php echo wp_kses( $fields['desc_right'], array(
                                                        'br' => array( 'class' => array() ),
                                                        'strong' => array(),
                                                        'h3' => array(), 'span' => array( 'class' => array() ),
                                                        'p' => array( 'class' => array() ),
                                                        'ul' => array( 'class' => array() ),
                                                        'li' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                    ) ); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
    			<?php
				break;
				case 'pillartwo':
				?>
                    <section class="four-boxes-section">
                        <div class="container-fluid">
                            <div class="row">
							<?php if( !empty ($fields['p2one']) ){?>
                    			<div class="col-md-6 col-sm-6 col-xs-12 boxes-block">
                                	<div class="boxes-main-content" id="bOne">
                                    	<?php if ( ! empty( $fields['p2one']['title'] ) ): ?>
                                            <div class="boxes-txt" style="background:#f58c28;">
                                                <h2><?php echo wp_kses( $fields['p2one']['title'], array(
													'br' => array( 'class' => array() ),
                                                    'strong' => array(), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
												) ); ?></h2>
                                            </div>
                                        <?php endif;
										if ( ! empty( $fields['p2one']['pillarimage'] ) ): 
											$p2one = wp_get_attachment_url($fields['p2one']['pillarimage']); ?>
                                            <div class="boxes-img boxEcoOne">
                                                <img src="<?php echo esc_url($p2one) ?>" alt="Thailand">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-12 fullwidth-boxes boxEcoOneInner" id="social-sec">
                                        <div class="fullboxes-content ">
                                            <?php if ( ! empty( $fields['p2one']['fullimage'] ) ): 
                                                $pfone = wp_get_attachment_url($fields['p2one']['fullimage']); ?>
                                            <div class="fullimage "><img src="<?php echo esc_url($pfone) ?>" alt="Thailand"></div>
                                            <?php endif; ?>
                                            <div class="main-content">
                                                <div class="leftside-ecoLarge">
                                                    <?php if ( ! empty( $fields['p2one']['title'] ) ): ?>
                                                        <h2>
														<?php echo wp_kses( $fields['p2one']['title'], array(
                                                        'br' => array( 'class' => array() ),
                                                        'strong' => array(), 'span' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                        ) ); ?></h2>
                                                    <?php endif; ?>
                                                    <?php if ( ! empty( $fields['p2one']['description'] ) ): ?>
                                                        <?php echo wp_kses( $fields['p2one']['description'], array(
                                                        'br' => array( 'class' => array() ),
                                                        'strong' => array(),
                                                        'span' => array( 'class' => array() ),
                                                        'h3' => array( 'class' => array() ),
                                                        'h4' => array( 'class' => array() ),
                                                        'p' => array( 'class' => array() ),
                                                        'ul' => array( 'class' => array() ),
                                                        'li' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                    ) ); ?>
                                                    <?php endif; ?>      
                                                </div>
                                                <div class="middleside-eco"></div>
                                            </div>
                                            <div class="rightside-eco" id="social-btn">
                                                <div class="arrow"><i class="fas fa-chevron-left"></i></div>
                                                <a>Back</a>
                                            </div>
                                    	</div>
									</div>
                                </div>
                    		<?php } ?>
                            <?php if( !empty ($fields['p2two']) ){?>
                            	<div class="col-md-6 col-sm-6 col-xs-12 boxes-block">
                                    <div class="boxes-main-content" id="bTwo">
                                        <?php if(!empty($fields['p2two']['title'])){ ?>
                                        	<div class="boxes-txt" style="background:#e84e1b;">
                                            <h2><?php echo wp_kses( $fields['p2two']['title'], array(
														'br' => array( 'class' => array() ),
														'strong' => array(), 'span' => array( 'class' => array() ),
														'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
												) ); ?></h2>
											</div>
										<?php }
										if ( ! empty( $fields['p2two']['pillarimage'] ) ): 
											$ptwo = wp_get_attachment_url( $fields['p2two']['pillarimage'] ); ?>
                                            <div class="boxes-img boxEcoTwo ">
                                                <img src="<?php echo esc_url($ptwo) ?>" alt="Thailand">
                                            </div>
                                         <?php endif; ?>
                                    </div>
                                    <div class="col-xs-12 fullwidth-boxes boxEcoTwoInner " id="economic-sec">
                                        <div class="fullboxes-content">
                                            <?php if ( ! empty( $fields['p2two']['fullimage'] ) ): 
                                                $pftwo = wp_get_attachment_url( $fields['p2two']['fullimage'] ); ?>
                                                <div class="fullimage ">
                                                	<img src="<?php echo esc_url($pftwo) ?>" alt="Thailand"></div>
                                            <?php endif; ?>
                                            <div class="main-content">
                                                <div class="leftside-ecoLarge">
                                                    <?php if(!empty( $fields['p2two']['title'] )){ ?>
                                                        <h2><?php echo wp_kses( $fields['p2two']['title'], array(
                                                                    'br' => array( 'class' => array() ),
                                                                    'strong' => array(), 'span' => array( 'class' => array() ),
                                                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                            ) ); ?></h2>
                                                    <?php } ?>
                                                    <?php if ( ! empty( $fields['p2two']['description'] ) ): ?>
                                                            <?php echo wp_kses( $fields['p2two']['description'], array(
                                                            'br' => array( 'class' => array() ),
                                                            'strong' => array(), 'span' => array( 'class' => array() ),
                                                            'h3' => array( 'class' => array() ),
                                                            'h4' => array( 'class' => array() ),
                                                            'p' => array( 'class' => array() ),
                                                            'ul' => array( 'class' => array() ),
                                                            'li' => array( 'class' => array() ),
                                                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                        ) ); endif; ?>
                                                </div>
                                                <div class="middleside-eco"></div>
                                            </div>
                                            <div class="rightside-eco" id="economic-btn">
                                                <div class="arrow"><i class="fas fa-chevron-left"></i></div>
                                                <a>Back</a>
                                            </div>
                                    	</div>
									</div>
								</div>
                            <?php } ?>
                            </div>
                        </div>
                    </section>
                    <?php
				break;
				case 'pillarthr': ?>
                	<section class="four-boxes-section">
                        <div class="container-fluid">
                            <div class="row">
                            	<?php if( !empty ($fields['p3one']) ){?>
                                	<div class="col-md-4 col-sm-6 col-xs-12 boxes-block">
                						<div class="boxes-main-content" id="bOne">
                                        	<?php if(!empty($fields['p3one']['title'])){ ?>
                                                    <div class="boxes-txt" style="background:#e69600;">
                                                        <h2><?php echo wp_kses( $fields['p3one']['title'], array(
																'br' => array( 'class' => array() ),
                                                                'strong' => array(), 'span' => array( 'class' => array() ),
                                                                'p' => array( 'class' => array() ),
                                                                'a' => array( 'href' => array(), 'title' => array(), 'target' => array(), 'class' => array() ),
															) ); ?></h2>
                                                    </div>
											<?php }
											if ( ! empty( $fields['p3one']['pillarimage'] ) ): 
												$pone = wp_get_attachment_url($fields['p3one']['pillarimage']); ?>
                                            	<div class="boxes-img boxDigiOne">
                                                	<img src="<?php echo esc_url($pone) ?>" alt="Thailand">
												</div>
											<?php endif; ?>
										</div>
                                        <div class="col-xs-12 fullwidth-boxes boxDigiOneInner" id="social-sec">
                                            <div class="fullboxes-content ">
                                                <?php if ( ! empty( $fields['p3one']['fullimage'] ) ): 
                                                    $pfone = wp_get_attachment_url($fields['p3one']['fullimage']); ?>
                                                <div class="fullimage"><img src="<?php echo esc_url($pfone) ?>" alt="Thailand"></div>
                                                <?php endif; ?>
                                                <div class="main-content">
                                                    <div class="leftside-ecoLarge">
                                                        <?php if ( ! empty( $fields['p3one']['title'] ) ): ?>
                                                        <h2><?php echo wp_kses( $fields['p3one']['title'], array(
                                                                'br' => array( 'class' => array() ),
                                                                'strong' => array(), 'span' => array( 'class' => array() ),
                                                                'p' => array( 'class' => array() ),
                                                                'a' => array( 'href' => array(), 'title' => array(), 'target' => array()),
                                                        ) ); ?></h2>
                                                        <?php endif; ?>
                                                        <?php if ( ! empty( $fields['p3one']['description'] ) ): ?>
															<?php echo wp_kses( $fields['p3one']['description'], array(
                                                                'br' => array( 'class' => array() ),
                                                                'strong' => array(),
                                                                'span' => array( 'class' => array() ),
                                                                'h3' => array(),
                                                                'h4' => array(),
                                                                'p' => array( 'class' => array() ),
                                                                'ul' => array( 'class' => array() ),
                                                                'li' => array( 'class' => array() ),
                                                                'a' => array( 'href' => array(), 'title' => array(), 
                                                                'class' => array(), 'target' => array() ),
                                                            ) ); ?>
                                                        <?php endif; ?>      
                                                    </div>
                                                    <div class="middleside-eco"></div>
                                                </div>
                                                <div class="rightside-eco" id="social-btn">
                                                    <div class="arrow"><i class="fas fa-chevron-left"></i></div>
                                                    <a>Back</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if( !empty ($fields['p3two']) ){?>
                                	<div class="col-md-4 col-sm-6 col-xs-12 boxes-block">
                                        <div class="boxes-main-content" id="bTwo">
                                            <?php if(!empty($fields['p3two']['title'])){ ?>
                                            <div class="boxes-txt" style="background:#692d00;">
                                                <h2><?php echo wp_kses( $fields['p3two']['title'], array(
                                                	'br' => array( 'class' => array() ),
                                                    'strong' => array(), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                ) ); ?></h2>
                                            </div>
                                            <?php }
                                                if ( ! empty( $fields['p3two']['pillarimage'] ) ): 
												$ptwo = wp_get_attachment_url($fields['p3two']['pillarimage']); ?>
                                                <div class="boxes-img boxDigiTwo">
                                                    <img src="<?php echo esc_url($ptwo) ?>" alt="Thailand">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-xs-12 fullwidth-boxes boxDigiTwoInner" id="economic-sec">
                                            <div class="fullboxes-content">
                                                <?php if ( ! empty( $fields['p3two']['fullimage'] ) ): 
                                                    $pftwo = wp_get_attachment_url($fields['p3two']['fullimage']); ?>
                                                <div class="fullimage "><img src="<?php echo esc_url($pftwo) ?>" alt="Thailand"></div>
                                                <?php endif; ?>
                                                <div class="main-content">
                                                    <div class="leftside-ecoLarge">
                                                        <?php if(!empty($fields['p3two']['title'])){ ?>
                                                        <h2><?php echo wp_kses( $fields['p3two']['title'], array(
                                                                'br' => array( 'class' => array() ),
                                                                'strong' => array(), 'span' => array( 'class' => array() ),
                                                                'p' => array( 'class' => array() ),
                                                                'a' => array( 'href' => array(), 'title' => array(),'class' => array() ),
                                                            ) ); ?></h2>
                                                        <?php } ?>
                                                        <?php if ( ! empty( $fields['p3two']['description'] ) ): ?>
                                                        <?php echo wp_kses( $fields['p3two']['description'], array(
                                                            'br' => array( 'class' => array() ),
                                                            'strong' => array(), 'span' => array( 'class' => array() ),
                                                            'h3' => array(),
                                                            'h4' => array(),
                                                            'p' => array( 'class' => array() ),
                                                            'ul' => array( 'class' => array() ),
                                                            'li' => array( 'class' => array() ),
                                                            'a' => array( 'href' => array(), 'class' => array(), 'title' => array(), 'target' => array() ),
                                                            ) ); endif; ?>
                                                    </div>
                                                    <div class="middleside-eco"></div>
                                                </div>
                                                <div class="rightside-eco" id="economic-btn">
                                                    <div class="arrow"><i class="fas fa-chevron-left"></i></div>
                                                    <a>Back</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if( !empty ($fields['p3thr']) ){?>
                                	<div class="col-md-4 col-sm-6 col-xs-12 boxes-block">
                                        <div class="boxes-main-content" id="bThree">
                                            <?php if(!empty($fields['p3thr']['title'])){ ?>
                                            <div class="boxes-txt" style="background:#d27805;">
                                                <h2><?php echo wp_kses( $fields['p3thr']['title'], array(
                                                        'br' => array( 'class' => array() ),
                                                        'strong' => array(), 'span' => array( 'class' => array() ),
                                                        'p' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(),'class' => array(), 'title' => array(), 'target' => array() ),
                                                    ) ); ?>
                                                 </h2>
                                            </div>
                                            <?php }
                                                if ( ! empty( $fields['p3thr']['pillarimage'] ) ): 
                                                    $pthr = wp_get_attachment_url($fields['p3thr']['pillarimage']); ?>
                                                    <div class="boxes-img boxDigiThree">
                                                        <img src="<?php echo esc_url($pthr); ?>" alt="Thailand">
                                                    </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-xs-12 fullwidth-boxes boxDigiThreeInner" id="digital-sec">
                                            <div class="fullboxes-content ">
                                                <?php if ( ! empty( $fields['p3thr']['fullimage'] ) ): 
                                                    $pfthr = wp_get_attachment_url($fields['p3thr']['fullimage']); ?>
                                                <div class="fullimage "><img src="<?php echo esc_url($pfthr); ?>" alt="Thailand"></div>
                                                <?php endif; ?>
                                                <div class="main-content">
                                                    <div class="leftside-ecoLarge">
                                                        <?php if(!empty($fields['p3thr']['title'])){ ?>
                                                        <h2><?php echo wp_kses_post( $fields['p3thr']['title'] ); ?></h2>
                                                        <?php } ?>
                                                        <?php if ( ! empty( $fields['p3thr']['description'] ) ): ?>
                                                        <?php echo wp_kses( $fields['p3thr']['description'], array(
                                                            'br' => array( 'class' => array() ),
                                                            'strong' => array(), 'span' => array( 'class' => array() ),
                                                            'h3' => array(),
                                                            'h4' => array(),
                                                            'p' => array( 'class' => array() ),
                                                            'ul' => array( 'class' => array() ),
                                                            'li' => array( 'class' => array() ),
                                                            'a' => array( 'href' => array(),'class' => array(), 'title' => array(), 'target' => array() ),
                                                            ) ); 
                                                            endif; ?>
                                                    </div>
                                                    <div class="middleside-eco"></div>
                                                </div>
                                                <div class="rightside-eco" id="digital-btn">
                                                    <div class="arrow"><i class="fas fa-chevron-left"></i></div>
                                                    <a>Back</a>
                                                </div>
                                            </div>
                                        </div>
                                	</div>
                                <?php } ?>
                            </div>
						</div>
					</section>
                <?php
				break;
				case 'pillarfr':
					?>
                    <section class="four-boxes-section">
                        <div class="container-fluid">
                            <div class="row">
                            	<?php if( !empty ($fields['pone']) ){?>
                    			<div class="col-md-3 col-sm-6 col-xs-12 boxes-block-1">
                                	<div class="boxes-main-content">
                                    	<?php if ( ! empty( $fields['pone']['title'] ) ): ?>
                                            <div class="boxes-txt ecobg">
                                                <h2><?php echo wp_kses( $fields['pone']['title'], array(
                                                            'br' => array( 'class' => array() ),
                                                            'strong' => array(), 'span' => array( 'class' => array() ),
                                                            'p' => array( 'class' => array() ),
                                                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                    ) ); ?></h2>
                                            </div>
                                        <?php endif;
										if ( ! empty( $fields['pone']['pillarimage'] ) ): 
											$pone = wp_get_attachment_url($fields['pone']['pillarimage']); ?>
                                            <div class="boxes-img boxHomeOne">
                                                <img src="<?php echo esc_url($pone) ?>" alt="Thailand">
                                                <i class="fas fa-arrow-up"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="overlay-boxes-block ecobg">
										<?php if ( ! empty( $fields['pone']['description'] ) ): ?>
                                        <?php echo wp_kses( $fields['pone']['description'], array(
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
                    			<?php } ?>
                                <?php if( !empty ($fields['ptwo']) ){?>
                                	<div class="col-md-3 col-sm-6 col-xs-12 boxes-block-1">
                                	<div class="boxes-main-content">
                                    	<?php if ( ! empty( $fields['ptwo']['title'] ) ): ?>
                                            <div class="boxes-txt digibg">
                                                <h2><?php echo wp_kses( $fields['ptwo']['title'], array(
                                                            'br' => array( 'class' => array() ),
                                                            'strong' => array(), 'span' => array( 'class' => array() ),
                                                            'p' => array( 'class' => array() ),
                                                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                    ) ); ?></h2>
                                            </div>
                                        <?php endif;
										if ( ! empty( $fields['ptwo']['pillarimage'] ) ): 
											$ptwo = wp_get_attachment_url($fields['ptwo']['pillarimage']); ?>
                                            <div class="boxes-img boxHomeTwo">
                                                <img src="<?php echo esc_url($ptwo) ?>" alt="Thailand">
                                                <i class="fas fa-arrow-up"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="overlay-boxes-block digibg">
										<?php if ( ! empty( $fields['ptwo']['description'] ) ): ?>
                                        <?php echo wp_kses( $fields['ptwo']['description'], array(
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
                                <?php } ?>
                                <?php if( !empty ($fields['pthr']) ){?>
                                	<div class="col-md-3 col-sm-6 col-xs-12 boxes-block-1">
                                	<div class="boxes-main-content">
                                    	<?php if ( ! empty( $fields['pthr']['title'] ) ): ?>
                                            <div class="boxes-txt combg">
                                                <h2><?php echo wp_kses( $fields['pthr']['title'], array(
                                                            'br' => array( 'class' => array() ),
                                                            'strong' => array(), 'span' => array( 'class' => array() ),
                                                            'p' => array( 'class' => array() ),
                                                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                    ) ); ?></h2>
                                            </div>
                                        <?php endif;
										if ( ! empty( $fields['pthr']['pillarimage'] ) ): 
											$pthr = wp_get_attachment_url($fields['pthr']['pillarimage']); ?>
                                            <div class="boxes-img boxHomeThree">
                                                <img src="<?php echo esc_url($pthr) ?>" alt="Thailand">
                                                <i class="fas fa-arrow-up"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="overlay-boxes-block combg">
										<?php if ( ! empty( $fields['pthr']['description'] ) ): ?>
                                        <?php echo wp_kses( $fields['pthr']['description'], array(
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
                                <?php } ?>
                                <?php if( !empty ($fields['pfr']) ){?>
                                	<div class="col-md-3 col-sm-6 col-xs-12 boxes-block-1">
                                	<div class="boxes-main-content">
                                    	<?php if ( ! empty( $fields['pfr']['title'] ) ): ?>
                                            <div class="boxes-txt covidbg">
                                                <h2><?php echo wp_kses( $fields['pfr']['title'], array(
                                                            'br' => array( 'class' => array() ),
                                                            'strong' => array(), 'span' => array( 'class' => array() ),
                                                            'p' => array( 'class' => array() ),
                                                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                    ) ); ?></h2>
                                            </div>
                                        <?php endif;
										if ( ! empty( $fields['pfr']['pillarimage'] ) ): 
											$pfr = wp_get_attachment_url($fields['pfr']['pillarimage']); ?>
                                            <div class="boxes-img boxHomeFour">
                                                <img src="<?php echo esc_url($pfr) ?>" alt="Thailand">
                                                <i class="fas fa-arrow-up"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="overlay-boxes-block covidbg">
										<?php if ( ! empty( $fields['pfr']['description'] ) ): ?>
                                        <?php echo wp_kses( $fields['pfr']['description'], array(
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
                                <?php } ?>
							</div>
                        </div>
                    </section>
                    <?php
				break;
				case 'slideltri':
				if( !empty ($fields['slide_testi']) ){ ?>
                	<section class="testi">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="testimonial-block">
                                    <div class="testimonial-carousel owl-carousel owl-theme">
                                        <?php foreach ( $fields['slide_testi'] as $testi ): ?>
                                        <div class="testi-full container-fluid">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightRed" style="">
                                                    <div class="testimonial-right">
                                                        <div>
                                                            <?php if ( ! empty( $testi['heading'] ) ): ?>
                                                            <h1 class="text-left txtRed"><?php echo wp_kses_post( $testi['heading'] ); ?></h1>
                                                            <?php endif; ?>
                                                            <?php if ( ! empty( $testi['desc'] ) ): ?>
                                                            <?php echo wp_kses( $testi['desc'], array(
                                                                'br' => array( 'class' => array() ),'strong' => array(),
                                                                'p' => array( 'class' => array() ),
                                                                'strong' => array(), 'span' => array( 'class' => array() ),
                                                                'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                                ) ); ?>
                                                            <?php endif; ?>
                                                            <?php if ( ! empty( $testi['buttontext'] ) ): ?>
                                                            <p>
                                                                <a target="_blank" href="<?php echo esc_url( $testi['buttonlink'] ); ?>"><span class="fa fa-arrow-right"></span><?php echo wp_kses_post( $testi['buttontext'] ); ?></a>
                                                            </p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    if ( ! empty( $testi['bgimage'] ) ): 
                                                        $bgimg = wp_get_attachment_url($testi['bgimage']);
                                                    ?>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 digiSlideTwo" style="background:url(<?php echo esc_url($bgimg ); ?>)">
                                                    <div class="testimonial-left"></div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php	
				}				
				break;
				case 'carthrimg':
					if( !empty ($fields['title']) ){ 
					?>
                    	<section class="full-title-section bgWhite">
                            <div class="container titleSectionFull ">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h1 class="text-center txtBlueGrey"><?php echo wp_kses_post( $fields['title'] ); ?></h1>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php }
					if( !empty ($fields['slide']) ){ ?>
                    	<section class="full-txt bgWhite">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="quoteCarousel owl-carousel owl-theme">
                                    	<?php foreach ( $fields['slide'] as $img ):
											if ( !empty( $img['cimage'] ) ) { ?>
                                            	<div class="item">
                                                    <img src="<?php echo esc_url( wp_get_attachment_url( $img['cimage'] ) ); ?>" alt="Quote" class="quoteImg" />
                                                </div>
                                        <?php } endforeach; ?>
                                    </div>
								</div>
							</div>
						</section>
                        
                    <?php } 
				break;
				case 'digipartner':
					?>
                    	<section class="full-txt bgWhite ">
                            <div class="container txtSectionFull">
                                <div class="div80">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <?php if ( ! empty( $fields['title_fullsectt'] ) ): ?>
                                            <h1 class="text-left txtGreen"><?php echo wp_kses_post( $fields['title_fullsectt'] ); ?></h1>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $fields['desc_fullsectt'] ) ): ?>
                                            <p class="text-left txtGreen2 font18">
												<?php echo wp_kses( $fields['desc_fullsectt'], array(
                                                'br' => array( 'class' => array() ),
                                                'strong' => array(),
                                                'p' => array( 'class' => array() ),
                                                'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                                ) ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> <?php
                        $query = get_DigitalLogo();
    					if ( $query->have_posts() ) { ?>
							<section class="full-txt bgWhite partnerSection">
                                <div class="container-fluid ">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="div100">
                                            <div class="divRow">
                                                <?php
                                                    while ( $query->have_posts() ) : $query->the_post();
                                                    $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full");
                                                    $logourl = get_post_meta( get_the_ID(), 'digilogo' , true );
                                                    ?>
                                                <div class="divCol">
                                                    <?php if( ! empty( $logourl['logourl'] ) ){ ?>
                                                        <a href="<?php echo esc_url($logourl['logourl']); ?>" target="_blank" >
                                                    <?php } ?>
                                                        <img src="<?php echo esc_url($imgsrc[0]); ?>" alt="<?php echo wp_kses_post( get_the_title() ); ?>" class="partnerLogo" />
                                                        <p class="txtBlack text-center"><?php echo wp_kses_post( get_the_title() ); ?></p>
                                                    <?php if( ! empty( $logourl['logourl'] ) ){ ?>
                                                    </a>
                                                    <?php } ?>
                                                </div>
                                                <?php endwhile; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php } ?>
					<?php
				break;
				case 'carblog': ?>
					<section class="advocacy-section">
						<div class="container">
							<div class="page-title text-center">
								<?php if ( ! empty( $fields['bloghead'] ) ): ?>
									<h1 class="txtBlack text-center"><?php echo wp_kses_post( $fields['bloghead'] ); ?></h1>
								<?php endif; ?>
							</div>
						</div>
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
                        <?php endif; ?>
					</section>
                    <?php
				break;
				case 'banslider': 
					if( !empty ($fields['slide']) ){
				?>
					<section class="full-txt bgWhite">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="vidCarousel videoBoxFull owl-carousel owl-theme" id="homebancrousel">
                                	<?php foreach ( $fields['slide'] as $img ):
										if ( !empty( $img['vd_banner'] ) ) { ?>
                                            <div class="item">
                                                <video controls muted preload="none" poster="<?php echo esc_url( wp_get_attachment_url( $img['vimage_banner'] ) ); ?>">
                                                    <source src="<?php echo esc_url( wp_get_attachment_url( $img['vd_banner'] ) ); ?>" type="video/mp4">
                                                </video>
                                            </div>
                                    <?php } endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </section>    
                	<?php }
				break;
				
			
			endswitch;
		
		endforeach;
	endif;

?>

<?php
get_footer();
