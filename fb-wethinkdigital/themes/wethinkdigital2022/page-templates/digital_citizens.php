<?php 
    /* 
    Template Name: Digital Citizens 
    */
    
    get_header();?>
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
        <div class="container dirRTL">
            <div class="newRow">
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero floatLeft campaignHeight">
                    <div class="headerTitle-campaign padding15 ">
                        <?php if ( ! empty( $fields['title_banner'] )) : ?>
                        <h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                            <?php echo wp_kses( $fields['title_banner'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'h3' => array( 'class' => array() ), 'p' => array( 'class' => array() ), 
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                        </h1>
                        <?php endif; ?>
                        <?php if ( ! empty( $fields['content_banner'] )) : ?>
                        <div class="txtWhite fontDisplay padding15 MarginBottomZero font16" >
                            <?php echo wp_kses( $fields['content_banner'], 
                                array( 'br' => array( 'class' => array() ),'span' =>array('class'=>array()),
                                'h3' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="headerTitleMob-campaign padding15">
                        <?php if ( ! empty( $fields['mtitle_banner'] )) : ?>
                        <h3 class="txtWhite fontDisplay padding15 MarginBottomZero">
                            <?php echo wp_kses( $fields['mtitle_banner'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'h3' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                        </h3>
                        <?php endif; ?>
                        <?php if ( ! empty( $fields['contentm_banner'] )) : ?>
                        <div class="txtWhite fontDisplay padding15 MarginBottomZero font16" >
                            <?php echo wp_kses( $fields['contentm_banner'], 
                                array('br' => array('class' => array()),'span' =>array('class' => array()),
                                'h3' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    endif;
    break;
    case 'fullwidth':
    $bgclr = $fields['bgfull']; $bgclrcls='';
    $txtalign = $fields['textalignfull'];
    if($bgclr==='grey'){$bgclrcls='bgLightGrey'; }
    if($txtalign==='center'){$txta='textCenter'; }
    	if ( ! empty( $fields['contentfull'] )) :
    	?>
<section>
    <div class="container-fluid <?php echo esc_attr($bgclrcls);?> paddingZero">
        <div class="container <?php echo esc_attr($txta); ?>">
            <div class="padding40 dirRTL">
                <div class="fontTxt marginZero paddingZero font16 txtDarkBlue dirRTL">
                    <?php echo wp_kses( $fields['contentfull'], 
                        array('br' => array('class' => array()),'span' => array('class' => array()),
                        'h3' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' =>array(),'download' => array(),'target' => array() ),
                        'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                        'strong' => array(), 'class' => array() ) ); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;
    break;
    case 'limgrtxt':
    		if ( ! empty( $fields['contentlirt'] ) || ! empty( $fields['image_lirt'] ) ) :
    			$img = wp_get_attachment_url($fields['image_lirt']);
    		?>
<section class="dcimagetext ">
    <div class="container padding40">
        <div class="row marginZero verticalAlignCenter">
            <?php if(! empty($fields['title_lirt'])): ?>
            <div class="col-12">
                <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero LeftRightPadding15 dirLTR>"><?php echo wp_kses_post($fields['title_lirt']); ?></h1>
            </div> 
            <?php endif; ?>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 ">
                <img src="<?php echo esc_url($img) ?>" alt="digital-citizens" class="img-responsive img100" />
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                <?php if ( ! empty( $fields['contentlirt'] )) : ?>
                <div class="TopBottomPadding40 fontTxt marginZero font16 txtGrey dirRTL">
                    <?php echo wp_kses( $fields['contentlirt'], 
                        array('br' => array('class' => array()),'span' => array('class' => array()),
                        'h3' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' =>array(),'download' => array(),'target' => array() ),
                        'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                        'strong' => array(), 'class' => array() ) ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif;
    break;
    case 'videosec':
    ?>
<?php if ( ! empty( $fields['more_videosec'] )) : ?>
<section>
    <div class="container-fluid bgWhite paddingZero">
        <div class="container padding40">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 ">
                    <div class="tabs-nav col vertScroll" id="">
                        <?php $i=1;
                            foreach($fields['more_videosec'] as $vd)
                            { 
                            $vdiurl = wp_get_attachment_url($vd['vdimage']); 
                            ?>
                        <a>
                            <div class="vidBox padding15 MarginBottom25 bgLightGrey" id="vid<?php echo esc_attr($i); ?>">
                                <img src="<?php echo esc_url( $vdiurl ); ?>" alt="<?php echo esc_attr( $vd['vtitle'] ); ?>" class="vidBoxThumb" />
                                <div class="">
                                    <?php if ( ! empty( $vd['vtitle'] )) : ?>
                                    <p class="font16 fontDisplay txtDarkBlue dirRTL PaddingBottom10 marginZero">
                                        <?php echo esc_html( $vd['vtitle'] ); ?> 
                                    </p>
                                    <?php endif; 
                                        if ( ! empty( $vd['content_dv'] )) : ?>
                                    <div class="font14 fontDisplay txtGrey dirRTL paddingZero marginZero">
                                        <?php echo wp_kses( $vd['content_dv'], 
                                            array('br' => array('class' => array()),'span' => array('class' => array()),
                                            'h3' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                                            'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                            'a' => array( 'href' => array(), 'title' =>array(),'download' => array(),'target' => array() ),
                                            'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                            'strong' => array(), 'class' => array() ) ); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                        <?php $i++; } ?>
                    </div>
                </div>
                <!--side panel-->
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                    <div class="tabs tabs-content col paddingZero">
                        <?php $j=1;
                            foreach($fields['more_videosec'] as $vd)
                            { 
                            $vdiurl = wp_get_attachment_url($vd['vdimage']);
                            $vdurl = wp_get_attachment_url($vd['vd_file']);
                            ?>
                        <div class="content">
                            <video class="MarginBottom15" width="100%" height="auto" controls="" muted="" poster="<?php echo esc_url( $vdiurl ); ?>">
                                <source src="<?php echo esc_url( $vdurl ); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <?php if ( ! empty( $vd['vtitle'] )) : ?>
                            <h3 class=" fontDisplay txtDarkBlue dirRTL PaddingBottom15 marginZero"><?php echo esc_html( $vd['vtitle'] ); ?></h3>
                            <div class="fontTxt marginZero paddingZero font16 txtGrey dirRTL ">
                                <?php endif;
                                    if ( ! empty( $vd['contentdt_dv'] )) : ?>
                                <?php echo wp_kses( $vd['contentdt_dv'], 
                                    array('br'=>array('class' => array()),'span'=>array('class' => array()),
                                    'h3' => array( 'class' => array() ), 'p' => array( 'class' => array() ),
                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                    'a' => array( 'href' => array(), 'title' =>array(),'download' => array(),'target' => array() ),
                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                    'strong' => array(), 'class' => array() ) ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $j++; } ?> 
                    </div>
                </div>
            </div>
            <?php if ( ! empty( $fields['vid_download_btn'] ) ) : ?>
            <div class="row PaddingTop40">
                <div class="col-12">
                    <p class="textCenter marginZero TopBottomPadding5">
                        <a href="<?php echo esc_url($fields['vid_download_link']); ?>" class="bgGrey txtWhite fontTxt btnLink font16" download=""><?php echo wp_kses_post($fields['vid_download_btn']); ?> <i class="fas fa-arrow-down"></i></a>
                    </p>
                </div>
            </div><!--Download button-->
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php break; ?>
<?php case 'logo': ?>

<section>
<div class="container-fluid bgWhite paddingZero">
    <div class="container padding40">
        <div class="row marginZero ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <?php if ( ! empty( $fields['titlelogo'] )) : ?>
                <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero LeftRightPadding15 dirLTR>">
                    <?php echo esc_html( $fields['titlelogo'] ); ?>
                </h1>
                <?php endif; ?>
            </div>
            <?php if ( ! empty( $fields['slide_slider_vd'] )) : ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
                <div class="div100 PaddingBottom40">
                    <div class="divRow">
                        <?php
                            foreach($fields['slide_slider_vd'] as $plogo)
                            {
                            	$logourl = wp_get_attachment_url($plogo['logoimage']); 
                            	if(!empty($logourl)) { ?>
                        <div class="divColNew">
                            <?php if( !empty($plogo['logourl']) ){ ?>
                            <a href="<?php echo esc_url( $plogo['logourl'] ); ?>" target="_blank">
                            <img src="<?php echo esc_url( $logourl ); ?>" alt="" class="partnerLogoNew" />
                            </a>
                            <?php if( !empty($plogo['logotitle']) ){ ?>
                            <p class="font14 txtGrey textCenter dirRTL fontTxt MarginBottom15 dirLTR">
                                <?php echo esc_html( $plogo['logotitle'] ); ?>
                            </p>
                            <?php } 
                                }
                                else
                                { ?>
                            <img src="<?php echo esc_url($logourl); ?>" alt="" class="partnerLogoNew" />
                            <?php if( !empty($plogo['logotitle']) ){ ?>
                            <p class="font14 txtGrey textCenter dirRTL fontTxt MarginBottom15 dirLTR"><?php echo esc_html( $plogo['logotitle'] ); ?></p>
                            <?php } 
                                } ?>
                        </div>
                        <?php }
                            } ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
    break;
    case 'scarousel': ?>
<section class="scarousel">
    <div class="container-fluid bgLightGrey paddingZero">
        <div class="container padding40">
            <div class="col-12 align-self-center ">
                <?php if ( ! empty( $fields['titlesc'] ) ) : ?>
                <h1 class="fontDisplay txtDarkBlue text-center dirRTL PaddingBottom40 marginZero"><?php echo esc_html( $fields['titlesc'] ); ?></h1>
                <?php endif;
                  
                if ( ! empty( $fields['slide_scarousel'] ) ): ?>
                <div class="row justify-content-center">
                    <div class="col-12 align-self-center ">
                        <div id="resdigCit" class="owl-carousel owl-theme PaddingZero">
                            <?php
                                foreach($fields['slide_scarousel'] as $sc)
                                {
                                    $scimg = wp_get_attachment_url($sc['scimage']); 
                                    if(!empty($scimg)) { ?>
                            <div class="item">
                                <!--Half-Half Layout-->
                                <div class="row verticalAlignCenter">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                        <img class="img100 paddingZero MarginBottom15 " src="<?php echo esc_url( $scimg ); ?>" alt="WTD" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                        <?php  if ( ! empty( $sc['contentsc'] ) ) :
                                            echo wp_kses( $sc['contentsc'], 
                                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                            'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
                                            'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                            'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                            'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                            'strong' => array(), 'class' => array() ) );
                                        endif; ?>
                                    </div>
                                </div>
                                <!--Half-Half Layout-->
                            
                                
                            </div>
                            <?php }
                                } ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php if ( ! empty( $fields['tipstorecharge_dwld_btn'] ) ) : ?>
            <div class="container PaddingTop40">
                <p class="textCenter marginZero TopBottomPadding5">
                    <a href="<?php echo esc_url($fields['tipstorecharge_dwld_link']); ?>" class="bgGrey txtWhite fontTxt btnLink font16" download=""><?php echo wp_kses_post($fields['tipstorecharge_dwld_btn']); ?> <i class="fas fa-arrow-down"></i></a>
                </p>
            </div><!--Download button-->
            <?php endif; ?>
        </div>    
    </div>
</section>
<?php
    break;

    case 'scarouselar': ?>
        <section class="scarousel">
            <div class="container-fluid  paddingZero">
                <div class="container padding40">
                    <div class="col-12 align-self-center ">
                        <?php if ( ! empty( $fields['artitlesc'] ) ) : ?>
                        <h1 class="fontDisplay txtDarkBlue text-center dirRTL PaddingBottom40 marginZero"><?php echo esc_html( $fields['artitlesc'] ); ?></h1>
                        <?php endif;
                          
                        if ( ! empty( $fields['ar_slide_scarousel'] ) ): ?>
                        <div class="row justify-content-center">
                            <div class="col-12 align-self-center ">
                                <div id="resdigCitar" class="owl-carousel owl-theme PaddingZero">
                                    <?php
                                        foreach($fields['ar_slide_scarousel'] as $arsc)
                                        {
                                            $scimg = wp_get_attachment_url($arsc['arscimage']); 
                                            if(!empty($scimg)) { ?>
                                    <div class="item">
                                        <!--Half-Half Layout-->
                                        <div class="row verticalAlignCenter">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                <img class="img100 paddingZero MarginBottom15 " src="<?php echo esc_url( $scimg ); ?>" alt="WTD" />
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                <?php  if ( ! empty( $arsc['arcontentsc'] ) ) :
                                                    echo wp_kses( $arsc['arcontentsc'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) );
                                                endif; ?>
                                            </div>
                                        </div>
                                        <!--Half-Half Layout-->
                                    
                                        
                                    </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                   
                </div>    
            </div>
        </section>
        <?php
            break;

    endswitch;
    
    endforeach;
    endif;
    ?>
<?php get_footer(); ?>