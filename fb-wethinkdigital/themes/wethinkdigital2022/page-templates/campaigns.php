<?php 
/* 
Template Name: Campaigns 
*/

get_header();?>

<?php
	$banner_sec = get_post_meta( get_the_ID(), 'banner_section', true );
    $campaing_sec = get_post_meta( get_the_ID(), 'campaign', true );
	$bannerbg = wp_get_attachment_url( $banner_sec['banner_bgimage'] );
?>
<?php if ( ! empty( $banner_sec['banner_content'] ) || ! empty( $banner_sec['mbanner_content'] ) ): ?>
        <section>
        	<div class="container-fluid bgWhite headerBanner paddingZero" style="background-image: url(<?php echo esc_url( $bannerbg ); ?>);">
                <div class="container dirRTL">
                    <div class="newRow">
                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">
                        	<?php if ( ! empty( $banner_sec['banner_content'] ) ): ?>
                            <div class="headerTitle padding15 ">
                                <h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                               		<?php echo wp_kses( $banner_sec['banner_content'], array(
                            			'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?>
                                </h1>
                            </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $banner_sec['mbanner_content'] ) ): ?>
                            <div class="headerTitleMob padding15 ">
                                <h3 class="txtWhite fontDisplay padding15 marginZero">
                                	<?php echo wp_kses( $banner_sec['mbanner_content'], array(
                            			'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?>
                                </h3>
                            </div>
                            <?php endif; ?>
                        </div>     
                    </div>                    
                </div>
            </div>
        </section><!--1-->
<?php endif; ?>
        <section>
            <div class="container-fluid bgLightGrey paddingZero">
                <div class="container textCenter">
                    <div class="padding40 dirRTL">	                                            
                        <?php if ( ! empty( $campaing_sec['Campaign_content'] ) ): ?> 
                            <p class="fontTxt marginZero paddingZero font16 txtGrey">
                            <?php echo wp_kses( $campaing_sec['Campaign_content'], 
                                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                            'p' => array( 'class' => array() ),'b' => array( 'class' => array() ), 
                                            'strong' => array(), 'class' => array() ) ); ?>
                            </p>
                        <?php endif; ?>    
                    </div>
                </div>
            </div>
        </section><!--2-->
        <section>
            <div class="container-fluid bgWhite paddingZero">                  
                <div class="container">
                    <h1 class="fontTxt txtDarkBlue textCenter paddingZero marginZero"><?php echo esc_html($campaing_sec['campaign_heading']);?></h1>                                                
                </div>
                <div class="container">
                    <div class="padding40">    
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-10 ">
                                <div class="div100" style="">

                                    <?php if ( ! empty( $campaing_sec['add_sec'] ) ):
                                   
                                    foreach ( $campaing_sec['add_sec'] as $sec ) { 
                                        if($sec['sec_type']==='twocol_iltr')
                                            { 
                                                $leftimg = wp_get_attachment_url($sec['sec_twocol_iltr_fields']['campaign_left_thumbnail']);
                                                if ( ! empty( $leftimg ) || ! empty( $sec['sec_twocol_iltr_fields']['campaign_right_title'] ) ||! empty( $sec['sec_twocol_iltr_fields']['campaign_right_text'] ) ): 
                                            
                                        
                                    ?>
                                        <div class="campaignBox  MarginBottom40">
                                            <div class="row marginZero">
                                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 paddingZero campaignBG" style="background-image: url(<?php echo esc_url( $leftimg ); ?>);">
                                                </div>
                                                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 padding40-campaign campaignContentBox">
                                                    
                                                    <h4 class="fontTxt txtDarkBlue MarginBottom15 font24 dirRTL">
                                                        <?php echo wp_kses($sec['sec_twocol_iltr_fields']['campaign_right_title'],array( 'br' => array( 'class' => array() ) ) );?>
                                                    </h4>
                                                    <p class="fontTxtLight font16 txtGrey MarginBottom25 dirRTL">
                                                        <?php echo wp_kses( $sec['sec_twocol_iltr_fields']['campaign_right_text'], 
                                                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                        'p' => array( 'class' => array() ),'b' => array( 'class' => array() ), 
                                                        'strong' => array(), 'class' => array() ) ); ?>    
                                                    </p>
                                                    <p class="textRight marginZero TopBottomPadding0 TopBottomMargin25 ">
                                                        <a href="<?php echo esc_url($sec['sec_twocol_iltr_fields']['campaign_rread_more']); ?>" target="_blank" class="txtDarkBlue fontTxtLight font14"><?php echo esc_html($sec['sec_twocol_iltr_fields']['campaign_rreadmore_btn']); ?>   <img src="<?php echo esc_url( get_theme_file_uri( 'images/know-more.png' ) ); ?>" alt="" class="knowMoreIcon" /></a>
                                                    </p>                                                
                                                </div>
                                            </div>
                                        </div><!--1-->

                                    <?php endif;
                                            }   
                                            
                                            if($sec['sec_type']==='twocol_irtl')
                                            { 
                                                $ritimg = wp_get_attachment_url($sec['sec_twocol_irtl_fields']['campaign_right_thumbnail']); 
                                                if ( ! empty( $ritimg ) || ! empty( $sec['sec_twocol_irtl_fields']['campaign_left_title'] ) ):
                                    ?> 
                                       
                                        <div class="campaignBox MarginBottom40">
                                            <div class="row marginZero">
                                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 padding40-campaign campaignContentBox">
                                                        <h4 class="fontTxt txtDarkBlue MarginBottom15 font24 dirRTL">
                                                            <?php echo wp_kses($sec['sec_twocol_irtl_fields']['campaign_left_title'],array( 'br' => array( 'class' => array() ) ));?>
                                                        
                                                        </h4>
                                                        <p class="fontTxtLight font16 txtGrey MarginBottom25 dirRTL"><?php echo wp_kses( $sec['sec_twocol_irtl_fields']['campaign_left_text'], 
                                                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                        'p' => array( 'class' => array() ),'b' => array( 'class' => array() ), 
                                                        'strong' => array(), 'class' => array() ) ); ?> 
                                                        </p>
                                                        <p class="textRight marginZero TopBottomPadding0 TopBottomMargin25 ">
                                                            <a href="<?php echo esc_url($sec['sec_twocol_irtl_fields']['campaign_lread_more']); ?>" target="_blank" class="txtDarkBlue fontTxtLight font14"><?php echo esc_html($sec['sec_twocol_irtl_fields']['campaign_lreadmore_btn']); ?><img src="<?php echo esc_url( get_theme_file_uri( 'images/know-more.png' ) ); ?>" alt="" class="knowMoreIcon" /></a>
                                                        </p>                                                
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 paddingZero campaignBG" style="background-image: url(<?php echo esc_url( $ritimg ); ?>);">
                                                </div>
                                            </div>
                                        </div><!--2-->
                                    <?php endif;
                                            }
                                    
                                            }
                                        endif; ?>    
                                </div>
                            </div>                            
                        </div><!--container-->
                    </div>    
                </div>                
            </div>
        </section><!--3-->

        <?php
        get_footer();
        ?>
