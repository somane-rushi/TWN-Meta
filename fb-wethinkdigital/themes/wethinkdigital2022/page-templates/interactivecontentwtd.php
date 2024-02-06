<?php
/*
Template Name: Interactive Content WTD page
*/

get_header();

?>
<?php $banner = get_post_meta( get_the_ID(), 'banner', true ); 
    if ( ! empty( $banner['banner_image'] ) && ! empty( $banner['banner_title'] ) ):
        $banner_img = wp_get_attachment_url( $banner['banner_image'] );    ?>

        <section>
            <div class="container-fluid paddingZero bgWhite headerBanner" style="background-image: url(<?php echo esc_url( $banner_img ); ?>);">
                <div class="container dirRTL">
                    <div class="newRow">
                    	<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">
							<?php if ( ! empty( $banner['banner_title'] ) ): ?>
                                <div class="headerTitle padding15">
                                    <h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                                        <?php echo wp_kses( $banner['banner_title'], 
												array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
												'h3' => array( 'class' => array() ), 
												'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
												'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
												'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
												'strong' => array(), 'class' => array() ) ); ?>
                                    </h1>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $banner['mbanner_title'] ) ): ?>
                                <div class="headerTitleMob padding15 ">
                                    <h3 class="txtWhite fontDisplay padding15 marginZero">
                                        <?php echo wp_kses( $banner['mbanner_title'], 
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
            </div>
        </section><!--1-->
    <?php endif; ?>
        <?php $arch = get_post_meta( get_the_ID(), 'videoarchive', true ); 
	        //if ( ! empty( $arch['page_title'] ) && ! empty( $arch['description'] ) ):
        ?>
            <section>
                <div class="container-fluid bgLightGrey LeftRightPadding0">
                    <div class="container "> 
                        <div class="padding40"> 
                            <?php if ( ! empty( $arch['page_title'] ) ): ?>
                                <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero"><?php echo wp_kses_post( $arch['page_title'] ); ?>
                                </h1>
                            <?php endif; ?>    
                            <?php if ( ! empty( $arch['description'] ) ): ?>
                                <div class=" BottomPadding20">
                                    <p class="fontTxt marginZero paddingZero font16 txtGrey dirRTL">
                                        <?php echo wp_kses( $arch['description'], array(
                                                'br' => array( 'class' => array() ),
                                            ) ); 
                                        ?>
                                    </p>                    
                                </div>
                            <?php endif; ?>    
                        </div>
                    </div>
                </div>
            </section><!--2-->
        <?php //endif; 
        $video_sec = get_post_meta( get_the_ID(), 'video_sec', true ); 
        $res_sec = get_post_meta(get_the_ID(), 'res_sec', true);
        $dis_sec = get_post_meta( get_the_ID(), 'dis_sec', true );
       

        
        if( $dis_sec === '1'){
        if(!empty($res_sec) ) {
         ?>
        <section>
            <div class="container-fluid bgWhite paddingZero">
                <div class="container">
                  <div class="padding40"> 
                  <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero"><?php echo wp_kses_post( $res_sec['resource_heading'] ); ?>  </h1>                                       

                    <div class="row paddingZero resContent" id="content">
                            <?php 
                                foreach ($res_sec['addres'] as $res):
                                $resfile = wp_get_attachment_url($res['file']);
                                $res_title = $res['res_title'];
                                $res_excerpt = $res['res_excerpt'];
                                $resimg = wp_get_attachment_url($res['res_thumb']);
                                $res_cta = $res['cta_btn_txt'];
                                $res_type = $res['typeofcontent_txt'];

                            ?>

                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
                                    <div class="resourceBox PaddingBottom35">

                                        <div class="resImgBox MarginBottom15" style="background-image: url(<?php echo esc_url($resimg); ?>);">
                                                            
                                        </div>
                                        
                                        <h6 class="txtGrey dirRTL fontTxt MarginBottom15"><?php echo wp_kses_post($res_type);?></h6>
                                        <p class="font20 txtDarkBlue dirRTL fontDisplay MarginBottom10 resTitle"><?php echo wp_kses_post($res_title); ?></p>
                                        <p class="font16 txtGrey dirRTL fontTxt MarginBottom15 resDesc"><?php echo wp_kses_post($res_excerpt); ?><br>
                                        <br></p>
                                        <p class="txtMetaBlue resCTA">
                                            <a href="<?php echo esc_url( $resfile ); ?>" target="_blank" class="font14 textLeft txtMetaBlue fontTxt MarginBottom15"><?php echo wp_kses_post($res_cta); ?></a>
                                        </p>
                                    </div><!--1-->
                                </div><!-- col4-->
                            <?php endforeach; ?>

                    </div>    

                  </div> 
                    
                </div>
            </div>

        </section>
        <?php } if(!empty($video_sec)) {?>                                      
            <section>
                <div class="container-fluid bgWhite paddingZero">
                    <div class="container">
                        <div class="padding40">   
                        <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero"><?php echo wp_kses_post( $video_sec['Video_heading'] ); ?> </h1>                                        
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">                        
                                    <div class="row">

                                        <?php $i=1;
                                            foreach ($video_sec['addvdo'] as $vdo):
                                             
                                            $vdo_url = $vdo['video_url'];
                                            $vdo_thum_title = $vdo['thumbnail_title'];
                                            $vdo_excerpt = $vdo['excerpt'];
                                            $vdoimg = wp_get_attachment_url($vdo['Video_thumb']);
                                        ?>
                                            <!-- Modal -->
                                            <div class="modal fade aboutmodal" id="modalPop<?php echo esc_html($i); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog quizedialog" role="document">
                                                    <div class="modal-content h-100">
                                                        <div class="modal-body bgLightGrey h-100">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <div class="container-full h-100">
                                                                <div class="TopBottomPadding35 h-100">
                                                                <iframe src="<?php echo esc_url($vdo_url); ?>" allowfullscreen="allowfullscreen" allow="autoplay; fullscreen" scrolling="auto" class="quizeiframe"> </iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End of MOdal-->
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6">
                                                <div class="quizBox">
                                                    <a data-toggle="modal" data-target="#modalPop<?php echo esc_html($i); ?>" class="">
                                                    <img src="<?php echo esc_url( $vdoimg ); ?>" alt="<?php echo wp_kses_post( $vdo_thum_title ); ?>" class="quizCard MarginBottom25" />
                                                    <!--<div class="quizCard bgGrey MarginBottom25">
                                                        <h2 class="fontDisplay txtWhite text-left top MarginTop15 MarginBottom50"><?php echo wp_kses_post($thum_title); ?></h2>
                                                        <p class="text-right txtWhite marginZero TopPadding35 BottomPadding15">
                                                            <a data-toggle="modal" data-target="#modalPop<?php echo esc_html($i); ?>" class="quizButton txtWhite fontTxt font16">Next</a>
                                                        </p>
                                                    </div>-->
                                                    <!--quizCard-->
                                                    </a>
                                                    <p class="font24 txtDarkBlue dirRTL fontDisplay MarginBottom15"><?php echo wp_kses_post( $vdo_thum_title); ?></p>
                                                    <p class="font16 txtGrey dirRTL fontTxt MarginBottom35">
                                                            <?php echo wp_kses($vdo_excerpt, array(
                                                            'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ) ));
                                                            ?>
                                                    </p>
                                                </div>
                                            </div><!--1-->
                                        <?php  $i++;
                                            endforeach;  ?>   
                                    </div><!--row-->
                                </div><!--central-->                            
                            </div>
                        </div>
                    </div>
                </div>
        </section>
           
    <?php } }

    else { 

        $videos = get_Video();
	    if ( $videos->have_posts() ) { ?>
            <section>
                <div class="container-fluid bgWhite paddingZero">
                    <div class="container">
                    <div class="padding40">                                            
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">                        
                                <div class="row">
                                    <?php $i=1;
                                        while ( $videos->have_posts() ) : $videos->the_post();
                                        $vd_field = get_post_meta( get_the_ID(), 'resource_attachment' , true );
                                        $video_url = $vd_field['video_url'];
                                        $thum_title = $vd_field['thumbnail_title'];
                                        $vid = get_the_ID();
                                        $vd_excerpt = get_post_meta( get_the_ID(), 'excerpt', true );
                                        $vdimg = wp_get_attachment_image_src( get_post_thumbnail_id( $vid ), 'full' );
							        ?>
                                        <!-- Modal -->
                                        <div class="modal fade aboutmodal" id="modalPop<?php echo esc_html($i); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog quizedialog" role="document">
                                                <div class="modal-content h-100">
                                                    <div class="modal-body bgLightGrey h-100">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        	<span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="container-full h-100">
                                                            <div class="TopBottomPadding35 h-100">
                                                            <iframe src="<?php echo esc_url($video_url); ?>" allowfullscreen="allowfullscreen" allow="autoplay; fullscreen" scrolling="auto" class="quizeiframe"> </iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End of MOdal-->
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-6">
                                            <div class="quizBox">
                                                <a data-toggle="modal" data-target="#modalPop<?php echo esc_html($i); ?>" class="">
                                                <img src="<?php echo esc_url( $vdimg[0] ); ?>" alt="<?php echo wp_kses_post( get_the_title() ); ?>" class="quizCard MarginBottom25" />
                                                
                                                </a>
                                                <p class="font24 txtDarkBlue dirRTL fontDisplay MarginBottom15"><?php echo wp_kses_post( get_the_title() ); ?></p>
                                                <p class="font16 txtGrey dirRTL fontTxt MarginBottom35">
                                                        <?php echo wp_kses($vd_excerpt, array(
                                                        'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ) ));
                                                         ?>
                                                </p>
                                            </div>
                                        </div><!--1-->
                                    <?php  $i++;
                                        endwhile ;  wp_reset_postdata();?>   
                                </div><!--row-->
                            </div><!--central-->                            
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        <?php }

    } ?>


         <?php $faq = get_post_meta( get_the_ID(), 'faq', true ); 
		 	 if ( ! empty( $faq['addfaq'] ) ):
		 ?>
            <section>
                <div class="container-fluid bgWhite paddingZero">
                    <div class="container">
                        <div class="padding40">                        
                            <?php if ( ! empty( $faq['title'] ) ) : ?>
                            <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero">
                                <?php echo esc_html( $faq['title'] ); ?>
                            </h1>
                            <?php endif; ?>
                            <div class="row marginZero">
                                <?php 
                                    foreach($faq['addfaq'] as $fa)
                                    {
                                        if ( ! empty( $fa['que'] ) || ! empty( $fa['ans'] ) ): ?>
                                        
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero"> 
                                            <div class="paddingZero">
                                                <?php if ( ! empty( $fa['que'] ) ) : ?>
                                                <p class="font24 txtDarkBlue dirRTL fontDisplay MarginBottom15">
                                                    <?php echo esc_html( $fa['que'] ); ?>
                                                </p>
                                                <?php endif; if ( ! empty( $fa['ans'] ) ) : ?>
                                                <div class="font16 txtGrey dirRTL fontTxt MarginBottom35">
                                                    <?php
                                                        echo wp_kses( $fa['ans'], 
                                                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                        'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
                                                        'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                        'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                        'strong' => array(), 'class' => array() ) );
                                                    ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>                   
                                        </div>    
                                        
                                <?php endif; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
		<?php endif; ?>
                
        <?php
get_footer();
