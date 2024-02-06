<?php
/*
Template Name: About WTD Page
*/

get_header();
?>
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
				case 'banner':
					$bgimg = wp_get_attachment_url($fields['image_banner']);
					if ( ! empty( $bgimg ) ):
					?>
                    <section>
                        <div class="container-fluid paddingZero bgWhite headerBanner" style="background-image: url(<?php echo esc_url($bgimg) ?>);">
                        	<?php if ( ! empty( $fields['title_banner'] ) || ! empty( $fields['mtitle_banner'] ) ): ?>
                            <div class="container dirRTL">
                                <div class="newRow">
                                	<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">
                                    <?php if ( ! empty( $fields['title_banner'] )) : ?>
                                    <div class="headerTitle padding15">
                                        <h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                                        	<?php echo wp_kses( $fields['title_banner'], 
												array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
												'h3' => array( 'class' => array() ), 
												'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
												'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
												'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
												'strong' => array(), 'class' => array() ) ); ?>
                                        </h1>
									</div>
                                    <?php endif; 
										if ( ! empty( $fields['mtitle_banner'] )) : ?>
                                    	<div class="headerTitleMob padding15 ">
                                            <h3 class="txtWhite fontDisplay padding15 MarginBottomZero">
                                            	<?php echo wp_kses( $fields['mtitle_banner'], 
												array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
												'h3' => array( 'class' => array() ), 
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
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php endif; ?>
                    <?php
				break;
				
				case 'slider_vd':
					if ( ! empty( $fields['slide_slider_vd'] ) ):
					?>
                    <section>
                        <div class="container-fluid paddingZero bgLightGrey LeftRightPadding0" >
                            <div class="container">
                            <div class="padding40">                                
                                <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero dirRTL"><?php echo esc_html( $fields['title'] ); ?></h1>
                                <div id="aboutvideocrousel" class="owl-carousel owl-theme">
                                	<?php foreach ( $fields['slide_slider_vd'] as $slide ):
										$simg = wp_get_attachment_url($slide['slideimage']);
										$svd = wp_get_attachment_url($slide['slidevd']); 
										if ( ! empty( $simg ) ):
									?>
                                    <div class="item">
                                        <a class="popup-youtube" href="<?php echo esc_url($svd); ?>">
                                        <img class="videocoverimg" src="<?php echo esc_url($simg); ?>" alt="wtd"  /> 
                                        <img src="<?php echo esc_url( get_theme_file_uri( 'images/play.png' ) ); ?>" class="vdplaybtn"/>
                                        </a> 
                                    </div>
                                    <?php endif; endforeach; ?>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                    <?php endif;
				break;
				
				case 'flip_circle':
					if ( ! empty( $fields['slide_flip'] ) ):
					$i=1;
				?>
                	<section id="flipareabox">
                        <div class="container-fluid LeftRightPadding0">
                            <div class="container">
                                <div class="padding40">    
                                    <div class="row flip-justify-center">
                                        <?php foreach ( $fields['slide_flip'] as $slide ): 
                                        $fimg = wp_get_attachment_url($slide['fimage']);
                                        ?>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 TopBottomMargin25">
                                            <div class="div100 flipBox">
                                                <div class="flipBox-inner">
                                                    <div class="flipBox-front">
                                                        <div class="div100 circleBox bottomAlign" style="background-image: url(<?php echo esc_url($fimg); ?>);">
                                                            <?php 
                                                            if ( ! empty( $slide['ftitle'] )) :
                                                                echo wp_kses( $slide['ftitle'], 
                                                                    array( 'br' => array( 'class' => array() ), 
                                                                    'span' => array( 'class' => array() ),
                                                                    'b' => array( 'class' => array() ), 
                                                                    'p' => array( 'class' => array() ),
                                                                    'strong' => array(), 'class' => array() ) ); 
                                                        endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="flipBox-back">
                                                        <div class="div100 circleBox middleAlign bgGrey">
                                                            <div class="txtWhite padding25 text-center fontTxt">
                                                                <?php 
                                                                    if ( ! empty( $slide['fdesc'] )) :
                                                                        echo wp_kses( $slide['fdesc'], 
                                                                        array( 'br' => array( 'class' => array() ),
                                                                        'span' => array( 'class' => array() ),
                                                                        'b' => array( 'class' => array() ),
                                                                        'p' => array( 'class' => array() ),
                                                                        'strong' => array(), 'class' => array() ) ); 
                                                                    endif; 
                                                                    if ( ! empty( $slide['flinktext'] )) :?>
                                                                        <a class="txtWhite text-left fontTxt TopBottomMargin15 font14 txtUnderline dirRTL" data-toggle="modal" data-target="#flipmodal<?php echo esc_html($i); ?>"><?php echo esc_html( $slide['flinktext'] ); ?></a>
                                                                    <?php endif; ?>
                                                            </div>                        
                                                        </div>            
                                                    </div>
                                                </div>                                
                                            </div>                            
                                        </div>
                                        
                                        <div class="modal fade aboutmodal" id="flipmodal<?php echo esc_html($i); ?>" tabindex="-1" role="dialog" aria-labelledby="flipmodalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body bgLightGrey">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="container">
                                                            <div class="BottomPadding15">
                                                                <?php if ( ! empty( $slide['fpopuptitle'] ) ): ?>
                                                                <h2 class="fontDisplay txtDarkBlue TopBottomPadding15 marginZero">
                                                                    <?php echo esc_html( $slide['fpopuptitle'] ); ?>
                                                                </h2>
                                                                <?php endif;
                                                                    if ( ! empty( $slide['fpopupdesc'] ) ): 
                                                                        echo wp_kses( $slide['fpopupdesc'], 
                                                                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),'p' => array( 'class' => array() ),'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),'strong' => array(), 'class' => array() ) ); 
                                                                    endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <?php $i++; endforeach; ?>
                                        
                                        
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
				endif;
				break;
				
				case 'journey': 
				$jimg = wp_get_attachment_url($fields['main_image']);
				?>
				
					<section class="journey-back paddingZero" id="wtderaarea">
                        <div class="container">
                        <div class="padding40">                                                        
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-sm-12 col-xs-12 paddingZero">
                                    <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero dirRTL"><?php echo esc_html( $fields['main_head'] ); ?> </h1>
                                    <div class="cswidth2">                                        
                                        <div class="nav nav-tabs nav-fill jtab" id="nav-tab" role="tablist">
                                            <div class="tabflx">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li id="backarea1" class="nav-item tackback"> <a class="nav-link htab" data-toggle="tab" href="#j2019" role="tab" aria-controls="home">2019<span class="stdot"></span> <span class="dot"></span> </a> </li>
                                                    <li id="backarea1" class="nav-item tackback"><a class="nav-link active htab" data-toggle="tab" href="#j2020" role="tab" aria-controls="profile">2020 <span class="stdot"></span><span class="dot"></span> </a> </li>
                                                    <li id="backarea1" class="nav-item tackback"><a class="nav-link htab" data-toggle="tab" href="#j2021" role="tab" aria-controls="messages">2021 <span class="stdot"></span><span class="dot"></span> </a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <span class="info-txt fontTxt dirRTL"><?php echo esc_html( $fields['main_note'] ); ?> </span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="container-fluid p-0 countrybackbanner bgWhite PaddingBottom40 LeftRightPadding0" id="backarea1">
                            <div class="row">
                                <div class="col-md-6 col-xs-12 p-0"><img class="aboutconimg" src="<?php echo esc_url($jimg); ?>"/></div>
                                <div class="col-md-6 col-xs-12 p-0 bgWhite">
                                <div class="tab-content px-3 px-sm-0" id="nav-tabContent">
                                    <div class="tab-pane" id="j2019" role="tabpanel">
                                    	<?php foreach ( $fields['coun_dt'] as $coun ): 
											if($coun['selyear']==='2019') {
											$jcimg = wp_get_attachment_url($coun['jimage']);
										?>
                                        <div class="country-list">
                                            <div class="jlist">
                                                <img src="<?php echo esc_url($jcimg); ?>"/>
                                                <h4 class="country-name"><?php echo esc_html( $coun['jname'] ); ?> </h4>
                                            </div>
                                            <h6 class="jdate dirRTL textLeft"><?php echo esc_html( $coun['jyear'] ); ?></h6>
                                            <?php if ( ! empty( $coun['jdesc'] ) ): 
												echo wp_kses( $coun['jdesc'], 
													array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),'p' => array( 'class' => array() ),'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),'strong' => array(), 'class' => array() ) ); 
											endif; ?>
                                        </div>
                                        <?php } endforeach; ?>
                                    </div>
                                    <div class="tab-pane active" id="j2020" role="tabpanel">
                                       <?php foreach ( $fields['coun_dt'] as $coun20 ): 
											if($coun20['selyear']==='2020') {
											$jcimg = wp_get_attachment_url($coun20['jimage']);
										?>
                                        <div class="country-list">
                                            <div class="jlist">
                                                <img src="<?php echo esc_url($jcimg); ?>"/>
                                                <h4 class="country-name"><?php echo esc_html( $coun20['jname'] ); ?> </h4>
                                            </div>
                                            <h6 class="jdate dirRTL textLeft"><?php echo esc_html( $coun20['jyear'] ); ?></h6>
                                            <?php if ( ! empty( $coun20['jdesc'] ) ): 
												echo wp_kses( $coun20['jdesc'], 
													array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),'p' => array( 'class' => array() ),'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),'strong' => array(), 'class' => array() ) ); 
											endif; ?>
                                        </div>
                                        <?php } endforeach; ?>
                                    </div>
                                    <div class="tab-pane" id="j2021" role="tabpanel">
                                        <?php foreach ( $fields['coun_dt'] as $coun ): 
											if($coun['selyear']==='2021') {
											$jcimg = wp_get_attachment_url($coun['jimage']);
										?>
                                        <div class="country-list">
                                            <div class="jlist">
                                                <img src="<?php echo esc_url($jcimg); ?>"/>
                                                <h4 class="country-name"><?php echo esc_html( $coun['jname'] ); ?> </h4>
                                            </div>
                                            <h6 class="jdate dirRTL textLeft"><?php echo esc_html( $coun['jyear'] ); ?></h6>
                                            <?php if ( ! empty( $coun['jdesc'] ) ): 
												echo wp_kses( $coun['jdesc'], 
													array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),'p' => array( 'class' => array() ),'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),'strong' => array(), 'class' => array() ) ); 
											endif; ?>
                                        </div>
                                        <?php } endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>  
				<?php
				break;
				
				case 'testimonial':
				if ( ! empty( $fields['slide_testi'] ) ):
				?>
                	<section id="aknolgtestmonial" class="testimoni center paddingZero" >
                            <div class="container">
                                <div class="padding40">                                
                                	<?php if ( ! empty( $fields['slide_testi'] ) ): ?>
                                    <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero dirRTL">                                    
                                    <!--main-heading d-xl-block d-lg-block d-md-block d-sm-none mobDispNone-->
                                    	<?php echo wp_kses( $fields['theading'], 
												array( 'br' => array( 'class' => array() ), 
												'span' => array( 'class' => array() ),
												'b' => array( 'class' => array() ), 
												'strong' => array(), 'class' => array() ) ); ?>
                                    </h1>
                                    
                                    <?php endif; ?>
                                    <div class="aknlogslider owl-carousel owl-theme govtest">
                                    	<?php foreach ( $fields['slide_testi'] as $testi ): 
											$timg = wp_get_attachment_url($testi['timage']);
										?>
                                        <div class="item">
                                        	<?php if ( ! empty( $timg ) ): ?>
                                            <img src="<?php echo esc_url($timg); ?>" class="gtesti-img" alt="APAC SUMMIT">
                                            <?php endif; 
											if ( ! empty( $testi['ttitle'] ) ):
											?>
                                            <h4 class="test-country-name dirRTL"><?php echo esc_html( $testi['ttitle'] ); ?></h4>
                                            <?php endif; 
											if ( ! empty( $testi['tdesc'] ) ):
											?>
                                            <div class="ppara">
                                                <?php echo wp_kses( $testi['tdesc'], 
												array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
												'p' => array( 'class' => array() ),
												'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
												'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
												'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
												'strong' => array(), 'class' => array() ) ); ?>      
                                            </div>
                                            <?php endif; 
											if ( ! empty( $testi['tname'] ) ): ?>
                                            	<p class="sp-name dirRTL"><?php echo esc_html( $testi['tname'] ); ?></p>
                                            <?php endif; 
											if ( ! empty( $testi['tpos'] ) ): ?>
                                            	<p class="sp-desi dirRTL"><?php echo esc_html( $testi['tpos'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                         <?php endforeach; ?>
                                    </div>                                
                                </div>
                            </div>
                        </section>
                <?php
				endif;
				break;
				
				
			endswitch;
		
		endforeach;
	endif;
?>


              
        

<?php
get_footer();
