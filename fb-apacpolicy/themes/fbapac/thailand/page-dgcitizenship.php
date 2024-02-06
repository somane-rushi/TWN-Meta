<?php
/**
 * Template Name: Thailand Digital Citizenship
 * PHP version 7
 *
 * @category FBAPAC
 * @package  File_Repository
 * @author   NJI Media <systems@njimedia.com>
 * @license  GNU General Public License v2 or later
 * @link     http://www.gnu.org/licenses/gpl-2.0.html
 */


 get_header('thailand');
 ?>
 <?php $sectionfirst = get_post_meta( get_the_ID(), 'sectionfirst', true ); ?>
  
 <section class="vid-full-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 videoBoxFull">
                       
                            <div class="row">
                            <?php
                            if ( ! empty( $sectionfirst['file'] ) ):
                                $vimg = wp_get_attachment_url($$sectionfirst['videoimage']);
                                $video = wp_get_attachment_url($$sectionfirst['file']);
                                ?>
                                <video controls poster="<?php echo esc_url($vimg) ?>">
                                    <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                                </video>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--container fluid-->
            </section>

 <?php $sectiontwo = get_post_meta( get_the_ID(), 'sectiontwo', true ); 
 if ( ! empty( $sectiontwo['heading'] ) || ! empty( $sectiontwo['description'] ) ): ?>

            <section class="full-txt bgWhite ">
                <div class="container txtSectionFull">
                    <div class="div80">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if ( ! empty( $sectiontwo['heading'] ) ): ?>
                            <h1 class="text-left txtGreen"><?php echo wp_kses_post( $sectiontwo['heading'] ); ?></h1>
                <?php endif; ?>
                <?php if ( ! empty( $secthr['description'] ) ): ?>
                <p class="text-left txtGreen2 font18"><?php echo wp_kses( $secthr['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
							'p' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array() ),
                        ) ); ?></p>
                    <?php endif; ?>
                               
								
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<?php $sectionthree = get_post_meta( get_the_ID(), 'sectionthree', true ); 
if ( ! empty( $sectionthree['heading'] ) || ! empty( $sectionthree['description'] ) ): ?>
            <section class="full-txt bgLightRed ">
                <div class="container txtSectionFullRed ">
                    <div class="div80">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="borderTopRed"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 redLink ">
                            <?php if ( ! empty( $sectiontwo['heading'] ) ): ?>
                            <h1 class="txtRed"><?php echo wp_kses_post( $sectiontwo['heading'] ); ?></h1>
                <?php endif; ?>
              
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                
                            <?php if ( ! empty( $secthr['description'] ) ): ?>
                           
                            <p class="txtRed"><?php echo wp_kses( $secthr['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
							'p' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array() ),
                        ) ); ?></p>
                    <?php endif; ?>
                    
                                                   					
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4q col-md-4 col-sm-4 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="borderTopRed" style="margin-top:25px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
 
            <?php $sectionfive = get_post_meta( get_the_ID(), 'sectionfive', true ); ?>

 <section class="vid-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox">
                            <div class="row">
                            <?php
                if ( ! empty( $sectionfive['file'] ) ):
					$vimg = wp_get_attachment_url($sectwo['videoimage']);
					$video = wp_get_attachment_url($sectwo['file']);
					?>
                	
                                <video controls poster="<?php echo esc_url($vimg) ?>">
                                    <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                                </video>
                 <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightBlue videoBox">
                            <div class="div70">
                            <?php if ( ! empty( $sectionfive['heading'] ) ): ?>
						<h1 class="txtDarkBlue"><?php echo wp_kses_post( $sectionfive['heading'] ); ?></h1>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectionfive['description'] ) ): ?>
						<p class="txtDarkBlue"><?php echo wp_kses( $sectionfive['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
							'p' => array( 'class' => array() ),
							'a' => array( 'href' => array(), 'title' => array() ),
                        ) ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectionfive['btntext'] ) ): ?>
					<p class="txtDarkBlue">                       					
						<a href="<?php echo esc_url( $sectionfive['btnlink']  ); ?>" class="txtDarkBlue"><span class="fa fa-arrow-right txtDarkBlue"></span><?php echo wp_kses_post( $sectwo['btntext'] ); ?></a>
					</p>
                    <?php endif; ?>


                               
                            </div>
                        </div>
                    </div>
                </div>
                <!--container fluid-->
            </section>

            <section class="">
                
                <div class="container-fluid">
                    <div class="row">
                        <div class="testimonial-block">
                            <div class="testimonial-carousel owl-carousel owl-theme">
                                <div class="testi-full container-fluid">
                                    <div class="row">
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightRed" style="">
                                            <div class="testimonial-right">
                                                <div>
                                                	<h1 class="text-left txtRed">Join us at our upcoming events!</h1>
                                                    <p class="text-left txtRed">Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo cons. Duis autem vel eum iriure dolor in hendrerit.</p>
                                                    <p>                       					
                                                        <a href="#"><span class="fa fa-arrow-right"></span>Read More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 digiSlideOne " style="">
                                            <div class="testimonial-left">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--1-->
                                <div class="testi-full container-fluid">
                                    <div class="row">
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightRed" style="">
                                            <div class="testimonial-right">
                                                <div>
                                                	<h1 class="text-left txtRed">Introducing the We Talk Digital Series</h1>
                                                    <p class="text-left txtRed">Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo cons. Duis autem vel eum iriure dolor in hendrerit.</p>
                                                    <p>                       					
                                                        <a href="#"><span class="fa fa-arrow-right"></span>Read More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 digiSlideTwo " style="">
                                            <div class="testimonial-left">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--2-->
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--container fluid-->
            </section>


<?php $sectionseven = get_post_meta( get_the_ID(), 'sectionseven', true );?>
             <section class="full-txt bgWhite ">
                <div class="container txtSectionFull">
                    <div class="div80">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if ( ! empty( $sectionseven['heading'] ) ): ?>
                            <h1 class="text-left txtGreen"><?php echo wp_kses_post( $sectionseven['heading'] ); ?></h1>
                <?php endif; ?>
                <?php if ( ! empty( $sectionseven['description'] ) ): ?>
                <p class="text-left txtGreen2 font18"><?php echo wp_kses( $sectionseven['description'], array(
						'br' => array( 'class' => array() ),
						'strong' => array(),
						'h3' => array(),
						'p' => array( 'class' => array() ),
						'ul' => array( 'class' => array() ),
						'li' => array( 'class' => array() ),
						'a' => array( 'href' => array(), 'title' => array() ),
					) ); ?></p>
                <?php endif; ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--section Full Text Option-->
            
            <section class="">
            	<div class="container-fluid">
            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            			<div class="borderGrey"></div>
            		</div>
            	</div>
            </section>


 <?php
 get_footer('thailand'); 