<?php
    /* Template Name: Rediscovethailand */
    get_header();
    ?>

    <style> 
.media-document ,  .audio  ,  .iPhone  { --inline-controls-bar-height: 100% !important; -webkit--inline-controls-bar-height: 100% !important; webkit-appearance: none;
        -moz-appearance: none;
        appearance: none; }
</style>
<?php $sectionfive = get_post_meta( get_the_ID(), 'sectionone', true ); 
    $secthimage1 = wp_get_attachment_url($sectionfive['img']);
    ?>

<?php $topvideosection = get_post_meta( get_the_ID(), 'topvideosection', true ); 
    ?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs div100">
                <?php if ( ! empty( $topvideosection['url1'] ) ): ?>
                <video autoplay="autoplay" loop muted  playsinline style="pointer-events: none;" class="div100">
                    <source src="<?php echo wp_kses_post( $topvideosection['url1'] ); ?>" type="video/mp4" />
                </video>
                <?php endif; ?>
            </div>
            <div class="hidden-lg hidden-md hidden-sm col-xs-12 div100">
                <?php if ( ! empty( $topvideosection['url2'] ) ): ?>
                <video autoplay="autoplay" loop muted playsinline style="pointer-events: none;" class="div100">
                    <source src="<?php echo wp_kses_post( $topvideosection['url2'] ); ?>" type="video/mp4" />
                </video>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!--newww3 video key visual-->
<?php $sectiontwo = get_post_meta( get_the_ID(), 'sectiontwo', true );
    if ( ! empty( $sectiontwo['heading'] ) || ! empty( $sectiontwo['description'] ) ): ?>
<section class="intro-area pad80 bggrayl">
    <div class="container">
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="introtxtpara black left mb30">
                <?php if ( ! empty( $sectiontwo['description'] ) ): ?>
                <?php echo wp_kses( $sectiontwo['description'], 
                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                    'p' => array( 'class' => array() ),
                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                    'strong' => array(), 'class' => array() ) ); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="bluebg introinfo brds5 pad30">
                <p class="opt-md white font16 left mb20">
                    <?php if ( ! empty( $sectiontwo['heading'] ) ): ?>
                    <?php echo wp_kses_post( $sectiontwo['heading'] ); ?>
                    <?php endif; ?>
                </p>
                <h5 class="white font16 opt-md left mb10">
                     <?php if ( ! empty( $sectiontwo['datetitle'] ) ): ?>
                    <?php echo wp_kses_post( $sectiontwo['datetitle'] ); ?>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectiontwo['date'] ) ): ?>
                    <?php echo wp_kses_post( $sectiontwo['date'] ); ?>
                    <?php endif; ?>
                </h5> 
				
                <h5 class="white font16 opt-md left mb0">
                     <?php if ( ! empty( $sectiontwo['venuetitle'] ) ): ?>
                    <?php echo wp_kses_post( $sectiontwo['venuetitle'] ); ?>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectiontwo['venue'] ) ): ?>
                    <a class="textdeco white" href="<?php echo wp_kses_post( $sectiontwo['url'] ); ?>" target="_blank">
                    <?php echo wp_kses_post( $sectiontwo['venue'] ); ?>
                    </a>
                    <?php endif; ?>
                </h5>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $sectionthree = get_post_meta( get_the_ID(), 'sectionthree', true ); 
    $secthimage1 = wp_get_attachment_url($sectionthree['image1']);
    $secthimage2 = wp_get_attachment_url($sectionthree['image2']);
    $secthimage3 = wp_get_attachment_url($sectionthree['image3']);
    $secthimage4 = wp_get_attachment_url($sectionthree['image4']);
    ?>
<section class="ararea pad80 bggrayl">
    <div class="container">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100">
            <div class="effectarea" >
                <!--<?php if($secthimage1  !== ''){ ?>
                    <img src="<?php echo esc_url($secthimage1); ?>"/>
                    <?php } ?>-->
                <?php if ( ! empty( $sectionthree['url1'] ) ): ?>
                <video autoplay="autoplay" loop muted playsinline style="pointer-events: none;" class="div100">
                    <source src="<?php echo wp_kses_post( $sectionthree['url1'] ); ?>" type="video/mp4" />
                </video>
                <!--Effects video #1-->
                <?php endif; ?>
            </div>
            <h6 class="black center font16 opt-txt bold padTB20">
                <?php if ( ! empty( $sectionthree['heading1'] ) ): ?>
                <?php echo wp_kses_post( $sectionthree['heading1'] ); ?>
                <?php endif; ?>
            </h6>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="200">
            <div class="effectarea">
                <!--<?php if($secthimage2  !== ''){ ?>
                    <img src="<?php echo esc_url($secthimage2); ?>"/>
                    <?php } ?>-->
                <?php if ( ! empty( $sectionthree['url2'] ) ): ?>
                <video autoplay="autoplay" loop muted playsinline style="pointer-events: none;" class="div100">
                    <source src="<?php echo wp_kses_post( $sectionthree['url2'] ); ?>" type="video/mp4" />
                </video>
                <!--Effects video #2-->
                <?php endif; ?>
            </div>
            <h6 class="black center font16 opt-txt bold padTB20">
                <?php if ( ! empty( $sectionthree['heading2'] ) ): ?>
                <?php echo wp_kses_post( $sectionthree['heading2'] ); ?>
                <?php endif; ?>
            </h6>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="300">
            <div class="effectarea" >
                <!--<?php if($secthimage3  !== ''){ ?>
                    <img src="<?php echo esc_url($secthimage3); ?>"/>
                    <?php } ?>-->
                <?php if ( ! empty( $sectionthree['url3'] ) ): ?>
                <video autoplay="autoplay" loop muted playsinline style="pointer-events: none;" class="div100">
                    <source src="<?php echo wp_kses_post( $sectionthree['url3'] ); ?>" type="video/mp4" />
                </video>
                <!--Effects video #3-->
                <?php endif; ?>
            </div>
            <h6 class="black center font16 opt-txt bold padTB20">
                <?php if ( ! empty( $sectionthree['heading3'] ) ): ?>
                <?php echo wp_kses_post( $sectionthree['heading3'] ); ?>
                <?php endif; ?>
            </h6>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="400">
            <div class="effectarea" >
                <!--<?php if($secthimage4  !== ''){ ?>
                    <img src="<?php echo esc_url($secthimage4); ?>"/>
                    <?php } ?>-->
                <?php if ( ! empty( $sectionthree['url4'] ) ): ?>
                <video autoplay="autoplay" loop muted playsinline style="pointer-events: none;" class="div100">
                    <source src="<?php echo wp_kses_post( $sectionthree['url4'] ); ?>" type="video/mp4" />
                </video>
                <!--Effects video #4-->
                <?php endif; ?>
            </div>
            <h6 class="black center font16 opt-txt bold padTB20">
                <?php if ( ! empty( $sectionthree['heading4'] ) ): ?>
                <?php echo wp_kses_post( $sectionthree['heading4'] ); ?>
                <?php endif; ?>
            </h6>
        </div>
    </div>
</section>
<?php $virtualsection = get_post_meta( get_the_ID(), 'virtualsection', true ); 
    ?>
<section class="tvarea pad80 bggrayl">
    <div class="container mxwidth4">
        <!--New Titleeeee Addition-->
        <?php if ( ! empty( $virtualsection['title'] ) ): ?>  
		<h3 class="blue font24 opt-md center mb60 text-uppercase mxwidth3 aos-init aos-animate" data-aos="fade-up" 
		data-aos-easing="ease-in-sine">
		
		<?php echo wp_kses_post( $virtualsection['title'] ); ?>
		
		</h3>
		 <?php endif; ?>
		<?php $sectionmap = get_post_meta( get_the_ID(), 'sectionmap', true ); 
    ?>
        <!--New Title Addition-->                    
        <div class="tabbable-panel">
            <div class="tabbable-line">
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 nopadding mb30">
                    <ul class="nav nav-tabs mapjtab" data-aos="zoom-in"  data-aos-easing="ease-in-sine">
                        <?php if ( ! empty( $sectionmap['heading'] ) ): ?>  
                        <!--<li id="pr0" class="" > 
                            <a href="#rl0" data-toggle="tab"> <?php echo wp_kses_post( $sectionmap['heading'] ); ?> </a> 
                        </li>-->
                        <?php endif; ?>
                        <li id="pr1" class="active"> 
                            <a href="#rl1" data-toggle="tab" onclick="removeanimation()"> <img src="<?php echo esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/gp.png"/> </a> 
                        </li>
                        <li id="pr2"> 
                            <a href="#rl2" data-toggle="tab"> <img src="<?php echo esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/pp.png"/> </a> 
                        </li>
                        <li id="pr3"> 
                            <a href="#rl3" data-toggle="tab"> <img src="<?php echo esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/yp.png"/> </a> 
                        </li>
                        <li id="pr4"> 
                            <a href="#rl4" data-toggle="tab" onclick="addanimation()"> <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/bp.png"/> </a> 
                        </li>
                        <?php if ( ! empty( $sectionmap['heading2'] ) ): ?>  
                        <li id="pr5"> 
                            <!--<a class="center opt-txt black" href="#rl2" data-toggle="tab" ><?php echo wp_kses_post( $sectionmap['heading2'] ); ?> </a>-->
                            <p class="center opt-txt black mb15" ><?php echo wp_kses_post( $sectionmap['heading2'] ); ?> </p>
                        </li>
                        <?php endif; ?>
                        <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/mapff.png"/>
                    </ul>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <div class="tab-content">
                        <?php $sectionvirtour = get_post_meta( get_the_ID(), 'sectionvirtour', true ); 
                            $secthimage1 = wp_get_attachment_url($sectionvirtour['image1']);
                            $secthimage2 = wp_get_attachment_url($sectionvirtour['image2']);
                            $barcode1 = wp_get_attachment_url($sectionvirtour['barcode1']);
                            $barcode2 = wp_get_attachment_url($sectionvirtour['barcode2']);
                            ?>
                        <div class="tab-pane " id="rl5">
                            <div class="top-area" data-aos="zoom-in"  data-aos-easing="ease-in-sine">
                                <?php if ( ! empty( $sectionvirtour['heading'] ) ): ?>
                                <h6 class="black opt-md bold left pad20 font16 topgrdarea"><?php echo wp_kses_post( $sectionvirtour['heading'] ); ?></h6>
                                <?php endif; ?>
                                <?php if ( ! empty( $sectionvirtour['description1'] ) ): ?>    
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage1  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage1);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectionvirtour['title1'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectionvirtour['title1'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectionvirtour['description1'] ) ): ?>
                                            <div class="black opt-txt font16 left nomargin"> 
                                                <?php echo wp_kses( $sectionvirtour['description1'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode1  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode1);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectionvirtour['scantext1'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectionvirtour['scantext1'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectionvirtour['scantextm1'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectionvirtour['scanlink1']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectionvirtour['scantextm1'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?><?php if ( ! empty( $sectionvirtour['description2'] ) ): ?> 
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage2  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage2);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectionvirtour['title2'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectionvirtour['title2'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectionvirtour['description2'] ) ): ?>
                                            <div class="black opt-txt font16 left"> 
                                                <?php echo wp_kses( $sectionvirtour['description2'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode2  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode2);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectionvirtour['scantext2'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectionvirtour['scantext2'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectionvirtour['scantextm2'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectionvirtour['scanlink2']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectionssouthernregion['scantextm2'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $sectionnorthernregion = get_post_meta( get_the_ID(), 'sectionnorthernregion', true ); 
                            $secthimage1 = wp_get_attachment_url($sectionnorthernregion['image1']);
                            $secthimage2 = wp_get_attachment_url($sectionnorthernregion['image2']);
                            $barcode1 = wp_get_attachment_url($sectionnorthernregion['barcode1']);
                            $barcode2 = wp_get_attachment_url($sectionnorthernregion['barcode2']);
                            ?>
                        <div class="tab-pane active" id="rl1">
                            <div class="top-area">
                                <?php if ( ! empty( $sectionnorthernregion['heading'] ) ): ?>
                                <h6 class="black opt-md bold left pad20 font16 topgrdarea"><?php echo wp_kses_post( $sectionnorthernregion['heading'] ); ?></h6>
                                <?php endif; ?>
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage1  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage1);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectionnorthernregion['title1'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectionnorthernregion['title1'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectionnorthernregion['description1'] ) ): ?>
                                            <div class="black  opt-txt font16 left nomargin"> 
                                                <?php echo wp_kses($sectionnorthernregion['description1'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode1  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode1);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectionnorthernregion['scantext1'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectionnorthernregion['scantext1'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectionnorthernregion['scantextm1'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectionnorthernregion['scanlink1']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectionnorthernregion['scantextm1'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage2  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage2);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectionnorthernregion['title2'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectionnorthernregion['title2'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectionnorthernregion['description2'] ) ): ?>
                                            <div class="black  opt-txt font16 left"> 
                                                <?php echo wp_kses($sectionnorthernregion['description2'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode2  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode2);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectionnorthernregion['scantext2'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectionnorthernregion['scantext2'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectionnorthernregion['scantextm2'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectionnorthernregion['scanlink2']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectionnorthernregion['scantextm2'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php $sectionnortheasternregion = get_post_meta( get_the_ID(), 'sectionnortheasternregion', true ); 
                            $secthimage1 = wp_get_attachment_url($sectionnortheasternregion['image1']);
                            $secthimage2 = wp_get_attachment_url($sectionnortheasternregion['image2']);
                            $barcode1 = wp_get_attachment_url($sectionnortheasternregion['barcode1']);
                            $barcode2 = wp_get_attachment_url($sectionnortheasternregion['barcode2']);
                            ?>
                        <div class="tab-pane" id="rl2">
                            <div class="top-area">
                                <?php if ( ! empty( $sectionnortheasternregion['heading'] ) ): ?>
                                <h6 class="black opt-md bold left pad20 font16 topgrdarea"><?php echo wp_kses_post( $sectionnortheasternregion['heading'] ); ?></h6>
                                <?php endif; ?>
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage1  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage1);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectionnortheasternregion['title1'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectionnortheasternregion['title1'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectionnortheasternregion['description1'] ) ): ?>
                                            <div class="black opt-txt font16 left nomargin">  
                                                <?php echo wp_kses($sectionnortheasternregion['description1'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode1  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode1);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectionnortheasternregion['scantext1'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectionnortheasternregion['scantext1'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectionnortheasternregion['scantextm1'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectionnortheasternregion['scanlink1']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectionnortheasternregion['scantextm1'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage2  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage2);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectionnortheasternregion['title2'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectionnortheasternregion['title2'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectionnortheasternregion['description2'] ) ): ?>
                                            <div class="black opt-txt font16 left"> 
                                                <?php echo wp_kses($sectionnortheasternregion['description2'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode2  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode2);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectionnortheasternregion['scantext2'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectionnortheasternregion['scantext2'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectionnortheasternregion['scantextm2'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectionnortheasternregion['scanlink2']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectionnortheasternregion['scantextm2'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php $sectioncentralregion = get_post_meta( get_the_ID(), 'sectioncentralregion', true ); 
                            $secthimage1 = wp_get_attachment_url($sectioncentralregion['image1']);
                            $secthimage2 = wp_get_attachment_url($sectioncentralregion['image2']);
                            $barcode1 = wp_get_attachment_url($sectioncentralregion['barcode1']);
                            $barcode2 = wp_get_attachment_url($sectioncentralregion['barcode2']);
                            ?>
                        <div class="tab-pane" id="rl3">
                            <div class="top-area">
                                <?php if ( ! empty( $sectioncentralregion['heading'] ) ): ?>
                                <h6 class="black opt-md bold left pad20 font16 topgrdarea"><?php echo wp_kses_post( $sectioncentralregion['heading'] ); ?></h6>
                                <?php endif; ?>
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage1  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage1);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectioncentralregion['title1'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectioncentralregion['title1'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectioncentralregion['description1'] ) ): ?>
                                            <div class="black opt-txt font16 left nomargin"> 
                                                <?php echo wp_kses($sectioncentralregion['description1'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode1  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode1);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectioncentralregion['scantext1'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectioncentralregion['scantext1'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectioncentralregion['scantextm1'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectioncentralregion['scanlink1']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectioncentralregion['scantextm1'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage2  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage2);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectioncentralregion['title2'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectioncentralregion['title2'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectioncentralregion['description2'] ) ): ?>
                                            <div class="black opt-txt font16 left"> 
                                                <?php echo wp_kses($sectioncentralregion['description2'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode2  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode2);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectioncentralregion['scantext2'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectioncentralregion['scantext2'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectioncentralregion['scantextm2'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectioncentralregion['scanlink2']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectioncentralregion['scantextm2'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php $sectionssouthernregion = get_post_meta( get_the_ID(), 'sectionssouthernregion', true ); 
                            $secthimage1 = wp_get_attachment_url($sectionssouthernregion['image1']);
                            $secthimage2 = wp_get_attachment_url($sectionssouthernregion['image2']);
                            $barcode1 = wp_get_attachment_url($sectionssouthernregion['barcode1']);
                            $barcode2 = wp_get_attachment_url($sectionssouthernregion['barcode2']);
                            ?>
                        <div class="tab-pane" id="rl4">
                            <div class="top-area">
                                <?php if ( ! empty( $sectionssouthernregion['heading'] ) ): ?>
                                <h6 class="black opt-md bold left pad20 font16 topgrdarea"><?php echo wp_kses_post( $sectionssouthernregion['heading'] ); ?></h6>
                                <?php endif; ?>
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage1  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage1);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectionssouthernregion['title1'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectionssouthernregion['title1'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectionssouthernregion['description1'] ) ): ?>
                                            <div class="black opt-txt font16 left nomargin"> 
                                                <?php echo wp_kses($sectionssouthernregion['description1'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode1  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode1);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectionssouthernregion['scantext1'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectionssouthernregion['scantext1'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectionssouthernregion['scantextm1'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectionssouthernregion['scanlink1']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectionssouthernregion['scantextm1'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="trvinfoarea">
                                    <div class="reimgarea">
                                        <?php if($secthimage2  !== ''){ ?>
                                        <img src="<?php echo esc_url($secthimage2);?>" style="width:100%"/>
                                        <?php } ?>
                                    </div>
                                    <div class="flexsecarea3">
                                        <div class="txtareaitvinfo">
                                            <?php if ( ! empty( $sectionssouthernregion['title2'] ) ): ?>
                                            <h6 class="blue opt-txt font16 left mb10 bold"> <?php echo wp_kses_post( $sectionssouthernregion['title2'] ); ?> </h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $sectionssouthernregion['description2'] ) ): ?>
                                            <div class="black opt-txt font16 left"> 
                                                <?php echo wp_kses($sectionssouthernregion['description2'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="barcodearea">
                                            <?php if($barcode2  !== ''){ ?>
                                            <img src="<?php echo esc_url($barcode2);  ?>" class="barcodeimg"/>
                                            <?php } ?>
                                            <?php if ( ! empty( $sectionssouthernregion['scantext2'] ) ): ?>
                                            <p class="font10 black center opt-txt mtb5" ><?php echo wp_kses_post( $sectionssouthernregion['scantext2'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ( ! empty( $sectionssouthernregion['scantextm2'] ) ): ?>
                                    <div class="trv-btn-area">
                                        <a href="<?php echo wp_kses_post( esc_url($sectionssouthernregion['scanlink2']) ); ?>" class="bluebg white opt-txt font-12 " target="_blank"> <?php echo wp_kses_post( $sectionssouthernregion['scantextm2'] ); ?> </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $sectionvideo = get_post_meta( get_the_ID(), 'sectionvideo', true ); 
    $img = wp_get_attachment_url($sectionvideo['img']);
    $file = wp_get_attachment_url($sectionvideo['file']);
    ?>
<section class="videoarea pad80 bggrayl">
    <div class="container mxwidth2">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <?php if ( ! empty( $sectionvideo['heading'] ) ): ?>
                <h3 class="blue font24 opt-md center mb60 text-uppercase mxwidth3" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-delay="100"> 
                    <?php echo wp_kses_post( $sectionvideo['heading'] ); ?> 
                </h3>
                <?php endif; ?>
                <?php if($sectionvideo['url']  !== ''){ ?>
                <video controls <?php if($img  !== ''){ ?> poster="<?php echo esc_url($img);?>" <?php } ?>id="makingvideo" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-delay="150">
                    <source src="<?php echo wp_kses_post( esc_url($sectionvideo['url']) ); ?> " type="video/mp4">
                </video>
                <?php } ?>
                <!--<img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/playicon.png" class="playicon"/>-->
            </div>
        </div>
    </div>
</section>
<?php $sectionfour = get_post_meta( get_the_ID(), 'sectionfour', true ); 
    $secthimage1 = wp_get_attachment_url($sectionfour['image1']);
    $secthimage2 = wp_get_attachment_url($sectionfour['image2']);
    $secthimage3 = wp_get_attachment_url($sectionfour['image3']);
    $secthimage4 = wp_get_attachment_url($sectionfour['image4']);
    $secthimage5 = wp_get_attachment_url($sectionfour['image5']);
    ?>
<section class="creatorarea bggrayl">
    <div class="container pad80">
        <?php if ( ! empty( $sectionfour['heading'] ) ): ?>
        <h3 class="blue font24 opt-md center mb60 text-uppercase" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="100"> 
            <?php echo wp_kses_post( $sectionfour['heading'] ); ?> 
        </h3>
        <?php endif; ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 znx">
            <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="100">
                <?php if($secthimage1  !== ''){ ?>
                <img src="<?php echo esc_url($secthimage1);?>"/>
                <?php } ?>
                <div class="conarea pad20">
                    <div class="flexsecarea2">
                        <div class="creator-txt-area">
                            <h3 class="blue Left opt-txt bold font16 mb5">
                                <?php if ( ! empty( $sectionfour['title1'] ) ): ?>
                                <?php echo wp_kses_post( $sectionfour['title1'] ); ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="scl-logo">
                            <?php if ( ! empty( $sectionfour['insta1'] ) ): ?>
                            <a href="<?php echo esc_url($sectionfour['insta1']) ;?>" target="_blank"> <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--scroll-->
                    <div class="txtScroll">
                        <p class="opt-txt black font16 left mb20 ">
                            <?php if ( ! empty( $sectionfour['subtitle1'] ) ): ?>
                            <?php echo wp_kses_post( $sectionfour['subtitle1'] ); ?>
                            <?php endif; ?>
                        </p>
                        <p class="opt-txt black font16 left ">
                            <?php if ( ! empty( $sectionfour['description1'] ) ): ?>
                            <?php echo wp_kses($sectionfour['description1'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'p' => array( 'class' => array() ),
                                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <!--Scroll-->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 znx">
            <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="300">
                <?php if($secthimage2  !== ''){ ?>
                <img src="<?php echo esc_url($secthimage2);?>"/>
                <?php } ?>
                <div class="conarea pad20">
                    <div class="flexsecarea2">
                        <div class="creator-txt-area">
                            <h3 class="blue Left opt-txt bold font16 mb5">
                                <?php if ( ! empty( $sectionfour['title2'] ) ): ?>
                                <?php echo wp_kses_post( $sectionfour['title2'] ); ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="scl-logo">
                            <?php if ( ! empty( $sectionfour['insta2'] ) ): ?>
                            <a href="<?php echo  esc_url($sectionfour['insta2']) ;?>" target="_blank"> <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--scroll-->
                    <div class="txtScroll">
                        <p class="opt-txt black font16 left mb20 ">
                            <?php if ( ! empty( $sectionfour['subtitle2'] ) ): ?>
                            <?php echo wp_kses_post( $sectionfour['subtitle2'] ); ?>
                            <?php endif; ?>
                        </p>
                        <p class="opt-txt black font16 left ">
                            <?php if ( ! empty( $sectionfour['description2'] ) ): ?>
                            <?php echo wp_kses($sectionfour['description2'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'p' => array( 'class' => array() ),
                                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <!--Scroll-->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 znx">
            <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="500">
                <?php if($secthimage3  !== ''){ ?>
                <img src="<?php echo esc_url($secthimage3);?>"/>
                <?php } ?>
                <div class="conarea pad20">
                    <div class="flexsecarea2">
                        <div class="creator-txt-area">
                            <h3 class="blue Left opt-txt bold font16 mb5">
                                <?php if ( ! empty( $sectionfour['title3'] ) ): ?>
                                <?php echo wp_kses_post( $sectionfour['title3'] ); ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="scl-logo">
                            <?php if ( ! empty( $sectionfour['insta3'] ) ): ?>
                            <a href="<?php echo  esc_url($sectionfour['insta3']) ;?>" target="_blank"> <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--scroll-->
                    <div class="txtScroll">
                        <p class="opt-txt black font16 left mb20 ">
                            <?php if ( ! empty( $sectionfour['subtitle3'] ) ): ?>
                            <?php echo wp_kses_post( $sectionfour['subtitle3'] ); ?>
                            <?php endif; ?>
                        </p>
                        <p class="opt-txt black font16 left ">
                            <?php if ( ! empty( $sectionfour['description3'] ) ): ?>
                            <?php echo wp_kses( $sectionfour['description3'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'p' => array( 'class' => array() ),
                                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <!--scroll-->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-md-offset-2 col-sm-6 col-xs-12 znx">
            <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="700">
                <?php if($secthimage4  !== ''){ ?>
                <img src="<?php echo esc_url($secthimage4);?>"/>
                <?php } ?>
                <div class="conarea pad20">
                    <div class="flexsecarea2">
                        <div class="creator-txt-area">
                            <h3 class="blue Left opt-txt bold font16 mb5">
                                <?php if ( ! empty( $sectionfour['title4'] ) ): ?>
                                <?php echo wp_kses_post( $sectionfour['title4'] ); ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="scl-logo">
                            <?php if ( ! empty( $sectionfour['insta4'] ) ): ?>
                            <a href="<?php echo  esc_url($sectionfour['insta4']) ;?>" target="_blank"> <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--scroll-->
                    <div class="txtScroll">
                        <p class="opt-txt black font16 left mb20 ">
                            <?php if ( ! empty( $sectionfour['subtitle4'] ) ): ?>
                            <?php echo wp_kses_post( $sectionfour['subtitle4'] ); ?>
                            <?php endif; ?>
                        </p>
                        <p class="opt-txt black font16 left ">
                            <?php if ( ! empty( $sectionfour['description4'] ) ): ?>
                            <?php echo wp_kses( $sectionfour['description4'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'p' => array( 'class' => array() ),
                                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <!--scroll-->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6  col-md-offset-0 col-sm-offset-3 col-xs-12 znx">
            <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="900">
                <?php if($secthimage5  !== ''){ ?>
                <img src="<?php echo esc_url($secthimage5);?>"/>
                <?php } ?>
                <div class="conarea pad20">
                    <div class="flexsecarea2">
                        <div class="creator-txt-area">
                            <h3 class="blue Left opt-txt bold font16 mb5">
                                <?php if ( ! empty( $sectionfour['title5'] ) ): ?>
                                <?php echo wp_kses_post( $sectionfour['title5'] ); ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="scl-logo">
                            <?php if ( ! empty( $sectionfour['insta5'] ) ): ?>
                            <a href="<?php echo  esc_url($sectionfour['insta5']) ;?>" target="_blank"> <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--scroll-->
                    <div class="txtScroll">
                        <p class="opt-txt black font16 left mb20">
                            <?php if ( ! empty( $sectionfour['subtitle5'] ) ): ?>
                            <?php echo wp_kses_post( $sectionfour['subtitle5'] ); ?>
                            <?php endif; ?>
                        </p>
                        <p class="opt-txt black font16 left ">
                            <?php if ( ! empty( $sectionfour['description5'] ) ): ?>
                            <?php echo wp_kses( $sectionfour['description5'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'p' => array( 'class' => array() ),
                                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <!--scroll-->
                </div>
            </div>
        </div>
        <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/umbrella-flip.gif" class="umbimg" data-aos="fade-down-left"
            data-aos-offset="200" data-aos-easing="ease-in-sine"/> 
    </div>
</section>
<?php $sectionfive = get_post_meta( get_the_ID(), 'sectionfive', true ); 
    $secthimage1 = wp_get_attachment_url($sectionfive['image1']);
    $secthimage2 = wp_get_attachment_url($sectionfive['image2']);
    $secthimage3 = wp_get_attachment_url($sectionfive['image3']);
    $secthimage4 = wp_get_attachment_url($sectionfive['image4']);
    ?>
<section class="behindthe mb80 bggrayl">
    <div class="container pad80">
        <h3 class="blue font24 opt-md center mb30 text-uppercase" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="100">
            <?php if ( ! empty( $sectionfive['maintitle'] ) ): ?>
            <?php echo wp_kses_post( $sectionfive['maintitle'] ); ?>
            <?php endif; ?>
        </h3>
        <p class="opt-txt font16 center black mb60" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="150">
            <?php if ( ! empty( $sectionfive['maindescription'] ) ): ?>
            <?php echo wp_kses( $sectionfive['maindescription'], 
                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                'p' => array( 'class' => array() ),
                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                'strong' => array(), 'class' => array() ) ); ?>
            <?php endif; ?>
        </p>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="mb30 bhbox" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="200">
                <div class="bbimgarea">
                    <?php if($secthimage1  !== ''){ ?>
                    <a class="popup-youtube" href="<?php echo  esc_url($sectionfive['link1']); ?>"> 
                    <img src="<?php echo esc_url($secthimage1);?>"/> </a>
                    <?php } ?>
                </div>
                <h3 class="blue opt-txt bold font16 mb5 left">
                    <?php if ( ! empty( $sectionfive['title1'] ) ): ?>
                    <?php echo wp_kses_post( $sectionfive['title1'] ); ?>
                    <?php endif; ?>
                </h3>
                <p class="opt-txt black font16 left">
                    <?php if ( ! empty( $sectionfive['description1'] ) ): ?>
                    <?php echo wp_kses($sectionfive['description1'], 
                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                        'p' => array( 'class' => array() ),
                        'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                        'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                        'strong' => array(), 'class' => array() ) ); ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="mb30 bhbox" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="300">
                <div class="bbimgarea">
                    <?php if($secthimage2  !== ''){ ?>
                    <a class="popup-youtube" 
                        href="<?php echo esc_url($sectionfive['link2']); ?>"><img src="<?php echo esc_url($secthimage2);?>"/> </a>
                    <?php } ?>
                </div>
                <h3 class="blue opt-txt bold font16 mb5 left">
                    <?php if ( ! empty( $sectionfive['title2'] ) ): ?>
                    <?php echo wp_kses_post( $sectionfive['title2'] ); ?>
                    <?php endif; ?>
                </h3>
                <p class="opt-txt black font16 left">
                    <?php if ( ! empty( $sectionfive['description2'] ) ): ?>
                    <?php echo wp_kses($sectionfive['description2'], 
                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                        'p' => array( 'class' => array() ),
                        'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                        'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                        'strong' => array(), 'class' => array() ) ); ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="mb30 bhbox" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="400">
                <div class="bbimgarea">
                    <?php if($secthimage3  !== ''){ ?>
                    <a class="popup-youtube" 
                        href="<?php echo esc_url($sectionfive['link3']); ?>"> <img src="<?php echo esc_url($secthimage3);?>"/> </a>
                    <?php } ?>
                </div>
                <h3 class="blue opt-txt bold font16 mb5 left">
                    <?php if ( ! empty( $sectionfive['title3'] ) ): ?>
                    <?php echo wp_kses_post( $sectionfive['title3'] ); ?>
                    <?php endif; ?>
                </h3>
                <p class="opt-txt black font16 left">
                    <?php if ( ! empty( $sectionfive['description3'] ) ): ?>
                    <?php echo wp_kses($sectionfive['description3'], 
                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                        'p' => array( 'class' => array() ),
                        'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                        'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                        'strong' => array(), 'class' => array() ) ); ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >
            <div class="mb30 bhbox" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="500">
                <div class="bbimgarea">
                    <?php if($secthimage4  !== ''){ ?>
                    <a class="popup-youtube" 
                        href="<?php echo esc_url($sectionfive['link4']); ?>"> <img src="<?php echo esc_url($secthimage4);?>"/> </a>
                    <?php } ?>
                </div>
                <h3 class="blue opt-txt bold font16 mb5 left">
                    <?php if ( ! empty( $sectionfive['title4'] ) ): ?>
                    <?php echo wp_kses_post( $sectionfive['title4'] ); ?>
                    <?php endif; ?>
                </h3>
                <p class="opt-txt black font16 left">
                    <?php if ( ! empty( $sectionfive['description4'] ) ): ?>
                    <?php echo wp_kses($sectionfive['description4'], 
                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                        'p' => array( 'class' => array() ),
                        'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                        'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                        'strong' => array(), 'class' => array() ) ); ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/ddr1.png" class="ddrarea" data-aos="fade-up-right" data-aos-offset="200" data-aos-easing="ease-in-sine"/>
    </div>
</section>
<?php $whatsApp = get_post_meta( get_the_ID(), 'sectioneight', true ); ?>
<?php   $count =  count($whatsApp['add_Posts1']); ?>
<section class="testiarea pad80 pb50 bggrayl">
    <div class="container mxwidth pa40" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine">
        <h3 class="black font24 opt-md text-uppercase center">
            <?php if ( ! empty( $whatsApp['title'] ) ): ?>
            <?php echo wp_kses($whatsApp['title'], 
                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                'p' => array( 'class' => array() ),
                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                'strong' => array(), 'class' => array() ) ); ?>
            <?php endif; ?>
        </h3>
        <div id="partnerslider" class="owl-carousel">
            <?php foreach ( $whatsApp['add_Posts1']  as $whats ) : ?>
            <div class="item">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
                    <img class="testimg" src="<?php echo esc_url(wp_get_attachment_url($whats['image1']));?>"/>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="testcondispara mb15">
                        <?php if ( ! empty( $whats['description1'] ) ): ?>
                      
						 <?php echo wp_kses( $whats['description1'], 
                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                            'p' => array( 'class' => array() ),
                            'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                            'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                            'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                            'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                            'strong' => array(), 'class' => array() ) ); ?>
                        <?php endif; ?>
						
                    </div>
                    <p class="opt-txt font16 left black">
                        <?php if ( ! empty( $whats['author'] ) ): ?>
                        <?php echo wp_kses( $whats['author'], 
                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                            'p' => array( 'class' => array() ),
                            'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                            'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                            'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                            'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                            'strong' => array(), 'class' => array() ) ); ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <?php endforeach;  ?>
        </div>
    </div>
</section>
<?php $sectionsix = get_post_meta( get_the_ID(), 'sectionsix', true ); 
    $secthimage1 = wp_get_attachment_url($sectionsix['image']);?>
<section class="thanksto bggrayl ptop50">
    <div class="container mxwidth pad80">
        <h3 class="blue font24 opt-md  center mb60 text-uppercase" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-delay="300">
            <?php if ( ! empty( $sectionsix['title'] ) ): ?>
            <?php echo wp_kses_post( $sectionsix['title'] ); ?>
            <?php endif; ?>
        </h3>
        <div class="row dispFlex" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-delay="350">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
                <?php if($secthimage1  !== ''){ ?>
                <img src="<?php echo esc_url($secthimage1);?>" class="ptlogo"/>
                <?php } ?>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h3 class="opt-txt font16 blue left bold mb10" >
                    <?php if ( ! empty( $sectionsix['heading'] ) ): ?>
                    <?php echo wp_kses_post( $sectionsix['heading'] ); ?>
                    <?php endif; ?>
                </h3>
                <p class="opt-txt font16 black left pl-3 pr-3" >
                    <?php if ( ! empty( $sectionsix['description'] ) ): ?>
                    <?php echo wp_kses( $sectionsix['description'], 
                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                        'p' => array( 'class' => array() ),
                        'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                        'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                        'strong' => array(), 'class' => array() ) ); ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="doll" data-aos="fade-up" data-aos-offset="200" data-aos-duration="" data-aos-delay="100">
            <img src="<?php echo  esc_url(get_bloginfo('url'));?>/wp-content/themes/fbthailand/images/doll1.png" class="dollimg"/>
        </div>
    </div>
</section>
<?php $sectionseven = get_post_meta( get_the_ID(), 'sectionseven', true ); ?>
<section class="ourpartner padB60 nomargin bggrayl">
    <div class="container mxwidth center"  data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-delay="100">
        <h3 class="blue font24 opt-md center mb60 text-uppercase">
            <?php if ( ! empty( $sectionseven['title'] ) ): ?>
            <?php echo wp_kses_post( $sectionseven['title'] ); ?>
            <?php endif; ?>
        </h3>
        <div class="belowpartnerarea" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-delay="150">
            <?php foreach ( $sectionseven['add_Posts1']  as $whats ) :
                $secthimage1 = wp_get_attachment_url($whats['image']);
                 ?>
            <?php if($secthimage1  !== ''){ ?>
            <div class="ourpplogorow"> <a ><img src="<?php echo esc_url($secthimage1);?>" class=""/> </a> </div>
            <!--href='<?php  echo esc_url($whats['link']); ?>'-->
            <?php  } ?>
            <?php endforeach;  ?>
        </div>
    </div>
</section>
<?php
get_footer();