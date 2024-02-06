<?php
/**
 * The template for displaying taknakscam archive pages
 */

get_header();
$takyear = gmdate('Y');
if(isset($_GET['taknakYear'])) { if( !empty($_GET['taknakYear']) ) { $takyear = sanitize_key($_GET['taknakYear']); } }
?>

<?php 
    $fields = get_option( "archive_taknakscam", array() );
      if(!empty($fields) ):
       
        foreach($fields as $data)
        { //print_r($data);
            foreach($data as $dt)
            {
                $field_name = 'tmy_'.$dt['tmy_year'].'_fields';
                if ( empty( $dt[ $field_name ] ) ) {
                    continue;
                }
                $component = $dt[ $field_name ];
                
                if($dt['tmy_year']===$takyear)
                {
                    if ( ! empty( $component['banner_image'] ) ):
                        $banner = wp_get_attachment_url($component['banner_image']); ?>
          
                
                        <section>
                            <div class="container-fluid paddingZero bgWhite headerBanner" style="background-image: url(<?php echo esc_url( $banner ); ?>);">
                        
                            </div>
                        </section>
                    <?php endif; 
                    
                     if ( ! empty( $component['scrollinks'] ) ):?>
                        <!-------Scam Tabs--------->
                        <section>
                            <div class="container-fluid paddingZero ScamTab">
                                <div class="container TopBottomPadding40">
                                    <ul class="mal_scam paddingZero ">

                                        <?php
                                        foreach($component['scrollinks'] as $slink)
                                        { ?>
                                            <li> <a class="font18 txtMetaBlue MarginBottom15" href="#<?php echo esc_attr(str_replace(" ","",strtolower(wp_kses_post( $slink['ftitle'] )))); ?>">
                                            <?php echo wp_kses_post( $slink['ftitle'] ); ?></a></li>
                                        <?php } ?>
                                        
                                    </ul>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                
                    <!---------Scam Years Section--------------->
                        <section>
                            <div class="container-fluid bgWhite paddingZero">
                                <div class="container">
                                    <div class="PaddingBottom40 ">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div>
                                                    <ul class="nav navbar justify-content-center marginZero paddingZero dirRTL textCenter">
                                                        <li class="nav-item dropdown">
                                                            <h1 class="marginZero paddingZero">
                                                            <?php
                                                                $takterms = fbiamdigital_get_terms( array(
                                                                    'taxonomy' => 'takyear',
                                                                ) );
                                                            ?>
                                                                <form method="GET"
                                                                    action="<?php echo esc_url( get_post_type_archive_link( 'taknakscam' ) ); ?>" method="get" id="">
                                                                    <span
                                                                        class="fontTxt txtGrey textCenter paddingZero marginZero">#TakNakScam</span>    
                                                                    <select name="taknakYear" class="form-select fontTxt txtDarkBlue partnerDrop"
                                                                        aria-label="Default select example" data-onchangesubmit="true" id="taknakYear">
                                                                        <?php foreach ( $takterms as $tak_terms ): $sel='';
                                                                        	if(!empty($takyear)){ 
													                        if($tak_terms->slug===$takyear){ $sel= 'selected'; }
                                                                            }
                                                                            ?>
												                            <option <?php echo esc_attr($sel); ?> value="<?php echo esc_attr( $tak_terms->slug ); ?>"><?php echo esc_html( $tak_terms->name ); ?></option>
										                                <?php endforeach; ?>                                                                       
                                                                    </select>
                                                                </form>
                                                            </h1>    
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--container-->
                            </div>
                        </section>
                        <!-----Paragraph Text------->
                        <section>
                            <div class="container-fluid bgWhite LeftRightPadding0">
                                <div class="container">
                                    <div class="PaddingBottom40">
                                    <?php if ( ! empty( $component['welcome_content'] ) ): ?>
                                       <?php echo wp_kses( $component['welcome_content'], array(
                                            'br' => array( 'class' => array() ),
                                            'p' => array( 'class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                            'strong' => array(),
                                        ) ); ?>
                                        
                                    <?php endif;  ?>
                                    </div>
                                    <?php if ( ! empty( $component['featurebox'] ) ): ?>
                                        <div class="PaddingBottom40">
                                            <div class="row">
                                              <?php foreach($component['featurebox'] as $feat) { ?> 
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="div100 scambox MarginBottom15 padding40">
                                                            
                                                                <?php if ( ! empty( $feat['ftitle'] ) ): ?>
                                                                    <h1 class="fontTxt txtDarkBlue MarginBottom25 dirRTL"><?php echo wp_kses_post($feat['ftitle']); ?></h1>
                                                                <?php endif; ?>
                                                                <?php if ( ! empty( $feat['fcontent'] ) ): ?>
                                                                    <p class="fontTxtLight font18 txtGrey MarginBottom25 dirRTL"><?php echo wp_kses( $feat['fcontent'], array(
                                                                        'br' => array(
                                                                            'class' => array()
                                                                        ),
                                                                    ) ); ?></p>
                                                                <?php endif;?>   
                                                                <?php if ( ! empty( $feat['flinks'] ) ): ?>
                                                                    <p class="fsource font14 fontTxtLight txtMetaBlue marginZero dirRTL"><?php echo wp_kses( $feat['flinks'], array(
                                                                        'br' => array('class' => array() ),
                                                                        'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                                        'strong' => array(),
                                                                    ) ); ?></p>
                                                                <?php endif; ?>   
                                                            
                                                        <!--1-->
                                                    </div>
                                                </div>
                                              <?php } ?>                                                  
                                            </div>
                                            <!--container-->
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </section>
                    <?php if ( ! empty( $component['box_text'] ) ||  ! empty( $component['box_image'] ) ): ?>
                        <!---Full box section-->
                        <section>
                            <div class="container-fluid bgWhite paddingZero">
                                <div class="container">
                                    <div class="PaddingBottom40">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="tnsBox MarginBottom15">
                                                    <div class="row marginZero">                                                       
                                                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 padding40-campaign campaignContentBox">
                                                                <div class="dirRTL marginZero fontTxt txtGrey font18"> 
                                                                    <form method="GET" action="" method="get" id="">
                                                                    <?php if ( ! empty( $component['box_text'] ) ): ?>
                                                                        <?php  echo wp_kses( $component['box_text'], array(
                                                                                'br' => array('class' => array() ),
                                                                                'p' => array('class' => array() ),
                                                                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                                                'strong' => array(),
                                                                        ) ); ?>
                                                                    <?php endif; ?>
                                                                    <select name="taknaksel" id="taknaksel" class="c-select select2-hidden-accessible" onchange="scrollval(this.value)">
                                                                        <option value="lankah">3 Langkah </option>
                                                                        <option value="kenalpastiscam">Kenal Pasti Scam</option>
                                                                        <option value="semakdata">Semak Data</option>
                                                                        <option value="laporkanscam">Laporkan Scam</option>
                                                                        <option value="tipskeselamatan">Tips Keselamatan</option>								
                                                                    </select>
                                                                    <?php if ( ! empty( $component['box_text_after'] ) ): ?>
                                                                        <?php  echo wp_kses( $component['box_text_after'], array(
                                                                                'br' => array('class' => array() ),
                                                                                'p' => array('class' => array(), 'style' => array() ),
                                                                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                                                'strong' => array(),
                                                                        ) ); ?>
                                                                    <?php endif; ?>
                                                                </form> 
                                                                </div>
                                                            </div>
                                                        <?php $sidebg = wp_get_attachment_url($component['box_image']); ?>
                                                        <?php if ( ! empty( $sidebg ) ): ?>
                                                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 verticalAlign">
                                                                <img src="<?php echo esc_url( $sidebg ); ?>" class="img100 objectFitContain">
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--container-->
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif;?>

                        <!----3 column image and text----->
                    <?php if ( ! empty( $component['ibox'] ) ): ?>
                        <section>
                            <div class="container-fluid bgWhite paddingZero" id="divcount">
                                <div class="container">
                                    <div class="PaddingBottom40">
                                        <div class="row paddingZero resContent" id="content">
                                         <?php foreach($component['ibox'] as $ibox) { 
                                                $iboximg = wp_get_attachment_url($ibox['iimages']);
                                          ?>         
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
                                                <div class="resourceBox">
                                                    <div class="resImgBox marginZero">
                                                        <img src="<?php echo esc_url( $iboximg ); ?>" class="partnerLogoNew">
                                                    </div>
                                                    <?php if ( ! empty( $ibox['ititle'] ) ): ?>
                                                     <p class="font22 txtDarkBlue textCenter dirRTL fontDisplay MarginBottom25 ">
                                                        <?php echo wp_kses_post($ibox['ititle']);?></p>
                                                    <?php endif; ?> 
                                                    <?php if ( ! empty( $ibox['icontent'] ) ): ?>
                                                        <p class="font16 txtGrey dirRTL fontTxt MarginBottom15 LeftRightPadding15">
                                                            <?php echo wp_kses( $ibox['icontent'], array(
                                                                    'br' => array( 'class' => array() ),
                                                                ) ); ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    
                                                </div><!--1-->
                                            </div><!-- col4-->
                                          <?php }?>  
                                        </div>
                                    </div>
                                </div><!-- container -->
                            </div>
                        </section>
                    <?php endif; ?>
                        <!------5 scam boxes with heading------->
                    <?php if ( ! empty( $component['post_header'] ) ): 
                        
                        $args = array(
                            'post_type' => 'taknakscam' ,
                            'orderby' => 'date' ,
                            'order' => 'ASC' ,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'takyear',   // taxonomy name
                                    'field' => 'slug',           // term_id, slug or name
                                    'terms' =>  $tak_terms->slug,                  // term id, term slug or term name
                                )
                            )
                           
                            ); 
                            $filter = new WP_Query($args);
                        ?>
                        <section id="kenalpastiscam">
                            <div class="container-fluid paddingZero">
                                <div class="container">
                                    <div class="PaddingBottom40">
                                        <h1 class="txtDarkBlue textCenter paddingZero marginZero dirRTL"><?php echo wp_kses_post($component['post_header']);?></h1>
                                    </div>
                                    <div class="row PaddingBottom40 resContent" id="content">
                                      <?php
                                        while ($filter->have_posts() ) : $filter->the_post();
                                            get_template_part( 'template-parts/content', get_post_type() );
                                        endwhile;
                                      ?>
                                    </div>
                                </div>
                        </section>
                    <?php endif;?>
                        <!----Carousel Section----->
                    <?php if ( ! empty( $component['stories'] ) ): ?>   
                        <section id="semakdata">
                            <div class="container-fluid paddingZero">
                                <div class="container" style="" id=""> 
                                    <h1 class="dirRTL txtDarkBlue textCenter PaddingBottom40 marginZero"><?php echo wp_kses_post($component['story_header']);?>
                                    </h1>
                                    <div id="aboutvideocrousel" class="owl-carousel owl-theme PaddingBottom40 MarginBottom15">
                                      <?php foreach($component['stories'] as $stry) { 
                                                $simage = wp_get_attachment_url($stry['simage']);
                                      ?> 
                                        <div class="item">
                                            
                                                <img class="videocoverimg" src="<?php echo esc_url( $simage ); ?>" alt="" />
                                                <!--Download Image-->
                                                <a href="<?php echo esc_url( $simage ); ?>" download="<?php echo esc_url( $simage ); ?>" target="_blank">
                                                    <i class="fas fa-arrow-down font14 txtGrey floatRight TopBottomPadding5"></i>
                                                </a>
                                                <!--Download Image-->
                                            
                                        </div>
                                       <?php } ?>  
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                    <?php if ( ! empty( $component['videobox'] ) ): $i=1; $j=1; ?>
						
                        <section>
                            <div class="container-fluid paddingZero">
                                <div class="container">
                                    <div class="PaddingBottom40">
                                      <?php if ( ! empty( $component['secure_title'] ) ): ?> 
                                        <h1 class=" txtDarkBlue textCenter paddingZero marginZero dirRTL"><?php echo wp_kses_post($component['secure_title']);?></h1>
                                      <?php endif; ?>  
                                    </div>
                                    <div class="row PaddingBottom40 resContent" id="tipskeselamatan">
                                        <?php foreach($component['videobox'] as $vd) { 
                                          $vimage = wp_get_attachment_url($vd['video_poster']);
                                          $vdo = wp_get_attachment_url($vd['video_file']);   
                                          if($i%2!==0){?> 
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="div100">
                                                    <div class="tnsBox MarginBottom25">
                                                        <div class="row marginZero">
                                                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 paddingZero ">
                                                                <img src="<?php echo esc_url( $vimage ); ?>" class="img100" style="">
                                                            </div>
                                                            <div
                                                                class="col-xl-7 col-lg-7 col-md-12 col-sm-12 padding40-campaign campaignContentBox">
                                                                <!--<p class="">
                                                                </p>-->
                                                                <p class="fontTxtLight font18 txtGrey marginZero dirRTL">
                                                                    <?php echo wp_kses( $vd['video_content'], array( 
                                                                                'br' => array('class' => array() ),
                                                                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                                                'strong' => array(),
                                                                    ) ); ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--1-end-->
                                          <?php } else{ ?>  
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"><!--2-->
                                                <div class="div100">
                                                    <div class="tnsBox MarginBottom25">
                                                        <div class="row marginZero">
                                                            <div
                                                                class="col-xl-7 col-lg-7 col-md-12 col-sm-12 padding40-campaign campaignContentBox">
                                                                <!--<p class="fontTxtLight font16 txtGrey MarginBottom25 dirRTL">
                                                                </p>-->
                                                                <p class="fontTxtLight font18 txtGrey marginZero dirRTL ">
                                                                    <?php echo wp_kses( $vd['video_content'], array( 
                                                                            'br' => array('class' => array() ),
                                                                            'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                                            'strong' => array(),
                                                                    ) ); ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 paddingZero ">
                                                                <img src="<?php echo esc_url( $vimage ); ?>" class="img100" style="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--2-end-->
                                            <?php } $i++;?>
                                        <?php } ?>
                                                                                
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif;?>

                        <!----Second Carosuel------->
                    <?php if ( ! empty( $component['secure_image'] ) ): ?>    
                        <section>
                            <div class="container-fluid paddingZero">
                                <div class="container PaddingBottom40 " style="height: auto;">                                    
                                    <div id="secureimgcrousel" class="owl-carousel owl-theme">
                                        <?php foreach($component['secure_image'] as $simg) { 
                                            $secimage = wp_get_attachment_url($simg['secimage']);
                                            if( ! empty( $secimage) )
                                            { ?> 
                                                <div class="item">
                                                    
                                                        <img class="videocoverimg" src="<?php echo esc_url( $secimage ); ?>" alt="" />
                                                        <!--Download Image-->
                                                        <a class="" href="<?php echo esc_url( $secimage ); ?>" download="<?php echo esc_url( $secimage ); ?>" target="_blank">
                                                            <i class="fas fa-arrow-down font14 txtGrey floatRight TopBottomPadding5"></i>
                                                        </a>
                                                        <!--Download Image-->
                                                
                                                </div>
                                            <?php }?>
                                        <?php } ?>        
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>

                        <!---blue box with text------>
                    
                        <section id="laporkanscam">
                         <?php if ( ! empty( $component['msg_header'] ) ): ?>
                            <div class="container-fluid paddingZero">
                                <div class="container">
                                    <div class="PaddingBottom40">
                                        <h1 class=" txtDarkBlue textCenter paddingZero marginZero dirRTL" >
                                            <?php echo wp_kses( $component['msg_header'], array( 
                                        'br' => array('class' => array() ),
                                    ) ); ?>	</h1>
                                    </div>
                                    <div class="row paddingZero resContent" id="content">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="div100 PaddingBottom40">
                                                <div class="tnsBox MarginBottom25 bgBlue">
                                                    <div class="row marginZero">
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 padding40-campaign campaignContentBox">
                                                            <?php echo wp_kses( $component['msg_content'], array( 
                                                                'br' => array('class' => array() ),
                                                                'p' => array('class' => array() ),
                                                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                                'strong' => array(),
                                                            ) ); ?>	
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--1-end-->

                                    </div>
                                </div>
                            </div>
                         <?php endif;?>   
                         <?php if ( ! empty( $component['scames_image'] ) ): ?>                                                                
                            <div class="container-fluid paddingZero">
                                <div class="container PaddingBottom40 " style="height: auto;">
                                    <div id="scamimgcrousel" class="owl-carousel owl-theme">
                                    <?php foreach($component['scames_image'] as $simg) { 
                                            $secimage = wp_get_attachment_url($simg['secimage']);
                                            if( ! empty( $secimage) )
                                            { ?>  
                                                <div class="item">
                                                    
                                                        <img class="videocoverimg" src="<?php echo esc_url( $secimage ); ?>" style="width:100%" alt="" />
                                                        <!--Download Image-->
                                                        <a href="<?php echo esc_url( $secimage ); ?>" download="<?php echo esc_url( $secimage ); ?>" target="_blank">
                                                            <i class="fas fa-arrow-down font14 txtGrey floatRight TopBottomPadding5"></i>
                                                        </a>
                                                        <!--Download Image-->
                                                    
                                                </div>
                                        <?php } 
                                    }?>

                                       
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>   
                        </section>
                    

                        <!---PDRM text section---->
                    <?php if ( ! empty( $component['scames_content'] ) ): ?>
                        <section>
                            <div class="container-fluid paddingZero">
                                <div class="container textCenter">
                                    <div class="padding40 dirRTL textLeft MarginBottom15 fontTxt txtGrey">
                                        <p class="textLeft MarginBottom15 fontTxt txtGrey "><?php echo wp_kses( $component['scames_content'], array( 
                                            'br' => array('class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                            'strong' => array(),
                                            'ul' => array('class' => array() ),
                                            'li' => array('class' => array() ),
                                            ) ); ?>	
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif;?>
                    <?php if ( ! empty( $component['jumbotron'] ) ): ?>
                        <!------logos section-------->
                        <section>
                            <div class="container-fluid paddingZero">
                                <div class="container">
                                    <div class="row w-100 marginZero PaddingBottom40">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h2 class=" txtDarkBlue textCenter PaddingBottom40 marginZero dirLTR">
                                            <?php echo wp_kses_post($component['logo_header']);?></h2>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
                                            <div class="div100">
                                                <div class="divRow">
                                                  <?php foreach($component['jumbotron'] as $lg) { 
                                                    $logo = wp_get_attachment_url($lg['parlogo']);
                                                    if( ! empty( $logo) )
                                                  { ?>  
                                                    <div class="divCol">
                                                      <?php if( ! empty($lg['plogolink']) ) { ?>
                                                        <a href="<?php echo esc_url($lg['plogolink'] ); ?>" target="_blank">
                                                      <?php } ?>      
                                                            <img src="<?php echo esc_url( $logo ); ?>"
                                                                alt="Staying Safe Online" class="partnerLogo">
                                                        <?php if( ! empty($lg['plogolink']) ) { echo '</a>'; } ?> 
                                                
                                                    </div>
                                                  <?php } } ?>  
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif ?>    

<?php   
                }
            }

        }


endif; ?>





















<?php
get_footer();
?>

<script type="text/javascript">
	jQuery(function() {
		jQuery('#taknakYear').change(function() {
			this.form.submit();
		});
	});
</script>