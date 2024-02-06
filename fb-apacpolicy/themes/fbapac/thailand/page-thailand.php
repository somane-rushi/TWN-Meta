<?php
/**
 * Template Name: Thailand Home
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
<?php $sectionfirst = get_post_meta( get_the_ID(), 'sectionfirst', true ); 
if ( ! empty( $sectionfirst['bgimage'] ) ):
	$bgimg = wp_get_attachment_url($sectionfirst['bgimage']); ?>
    <section class="australia-tab-section">
        <div class="container-fluid">
            <div class="row">
                <div class="australia-block " style="background-image: url(<?php echo esc_url($bgimg) ?>);">
                    <?php if ( ! empty( $sectionfirst['heading'] ) ): ?>
                        <h2><?php echo wp_kses_post( $sectionfirst['heading'] ); ?></h2>
                    <?php endif; ?>
                    <?php if ( ! empty( $sectionfirst['description'] ) ): ?>
                    <h4><?php echo wp_kses( $sectionfirst['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
                        ) ); ?></h4>
                     <?php endif; ?>
                     <?php if ( ! empty( $sectionfirst['buttontext'] ) ): ?>
                        <p><a href="<?php echo esc_url( $sectionfirst['buttonlink']  ); ?>">
                        <span class="fa fa-arrow-right"></span>
                        <?php echo wp_kses_post( $sectionfirst['buttontext'] ); ?></a></p>
                     <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="four-boxes-section">
	<div class="container-fluid">
		<div class="row">
        <?php $pilone = get_post_meta( get_the_ID(), 'pillarone', true ); ?>
        	<div class="col-md-3 col-sm-6 col-xs-12 boxes-block">
				<div class="boxes-main-content" id="bOne">
                	<?php if ( ! empty( $pilone['title'] ) ): ?>
                        <div class="boxes-txt">
                            <h2><?php echo wp_kses_post( $pilone['title'] ); ?></h2>
                        </div>
                    <?php endif;
                    if ( ! empty( $pilone['pillarimage'] ) ): $pone = wp_get_attachment_url($pilone['pillarimage']); ?>
                    <div class="boxes-img boxGreen">
						<img src="<?php echo esc_url($pone) ?>" alt="Thailand">
					</div>
                    <?php endif; ?>
				</div>
                <div class="col-xs-12 fullwidth-boxes ch-color1" id="social-sec">
					<div class="fullboxes-content ">
                    	<?php if ( ! empty( $pilone['fullimage'] ) ): $pfone = wp_get_attachment_url($pilone['fullimage']); ?>
						<div class="fullimage borderGreen bgGreen"><img src="<?php echo esc_url($pfone) ?>" alt="Thailand"></div>
                        <?php endif; ?>
						<div class="main-content">
							<div class="leftside-eco">
                            	<?php if ( ! empty( $pilone['title'] ) ): ?>
								<h2><?php echo wp_kses_post( $pilone['title'] ); ?></h2>
                                <?php endif; ?>
                                <?php if ( ! empty( $pilone['description'] ) ): ?>
								<p><?php echo wp_kses( $pilone['description'], array(
										'br' => array( 'class' => array() ),
										'strong' => array(),
									) ); ?></p>
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
            <?php $piltwo = get_post_meta( get_the_ID(), 'pillartwo', true ); ?>
            <div class="col-md-3 col-sm-6 col-xs-12 boxes-block">
				<div class="boxes-main-content" id="bTwo">
                    <?php if ( ! empty( $piltwo['title'] ) ): ?>
                        <div class="boxes-txt">
                            <h2><?php echo wp_kses_post( $piltwo['title'] ); ?></h2>
                        </div>
                    <?php endif;
                    if ( ! empty( $piltwo['pillarimage'] ) ): $ptwo = wp_get_attachment_url($piltwo['pillarimage']); ?>
                    <div class="boxes-img boxYellow">
						<img src="<?php echo esc_url($ptwo) ?>" alt="Thailand">
					</div>
                    <?php endif; ?>
				</div>
                <div class="col-xs-12 fullwidth-boxes ch-color2" id="economic-sec">
					<div class="fullboxes-content">
                    	<?php if ( ! empty( $piltwo['fullimage'] ) ): $pftwo = wp_get_attachment_url($piltwo['fullimage']); ?>
							<div class="fullimage borderYellow bgYellow"><img src="<?php echo esc_url($pftwo) ?>" alt="Thailand"></div>
                        <?php endif; ?>
						<div class="main-content">
							<div class="leftside-eco">
								<?php if ( ! empty( $piltwo['title'] ) ): ?>
                                   	<h2><?php echo wp_kses_post( $piltwo['title'] ); ?></h2>
                                <?php endif; ?>
								<p><?php echo wp_kses( $piltwo['description'], array(
									'br' => array( 'class' => array() ),
									'strong' => array(),
								) ); ?></p>
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
            <?php $pilthr = get_post_meta( get_the_ID(), 'pillarthree', true ); ?>
            <div class="col-md-3 col-sm-6 col-xs-12 boxes-block">
				<div class="boxes-main-content" id="bThree">
                	<?php if ( ! empty( $pilthr['title'] ) ): ?>
					<div class="boxes-txt"><h2><?php echo wp_kses_post( $pilthr['title'] ); ?></h2></div>
                    <?php endif;
                    if ( ! empty( $pilthr['pillarimage'] ) ): $pthr = wp_get_attachment_url($pilthr['pillarimage']); ?>
                    <div class="boxes-img boxBlue">
						<img src="<?php echo esc_url($pthr) ?>" alt="Thailand">
					</div>
                    <?php endif; ?>
				</div>
				<div class="col-xs-12 fullwidth-boxes ch-color3" id="digital-sec">
					<div class="fullboxes-content">
                    	<?php if ( ! empty( $pilthr['fullimage'] ) ): $pfthr = wp_get_attachment_url($pilthr['fullimage']); ?>
							<div class="fullimage borderBlue bgBlue"><img src="<?php echo esc_url($pfthr) ?>" alt="Thailand"></div>
                        <?php endif; ?>
                        <div class="main-content">
							<div class="leftside-eco">
                            	<?php if ( ! empty( $pilthr['title'] ) ): ?>
									<h2><?php echo wp_kses_post( $pilthr['title'] ); ?></h2>
                                <?php endif; ?>
								<p><?php echo wp_kses( $pilthr['description'], array(
									'br' => array( 'class' => array() ),
									'strong' => array(),
								) ); ?>
                                </p>
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
            <?php $pilfr = get_post_meta( get_the_ID(), 'pillarfour', true ); ?>
            <div class="col-md-3 col-sm-6 col-xs-12 boxes-block">
				<div class="boxes-main-content" id="bFour">
                	<?php if ( ! empty( $pilfr['title'] ) ): ?>
					<div class="boxes-txt">
						<h2><?php echo wp_kses_post( $pilfr['title'] ); ?></h2>
					</div>
                    <?php endif;
                    if ( ! empty( $pilfr['pillarimage'] ) ): $pfr = wp_get_attachment_url($pilfr['pillarimage']); ?>
                    <div class="boxes-img boxRed">
						<img src="<?php echo esc_url($pfr) ?>" alt="Thailand">
					</div>
                    <?php endif; ?>
				</div>
                <div class="col-xs-12 fullwidth-boxes ch-color4" id="politics-sec">
					<div class="fullboxes-content">
                    	<?php if ( ! empty( $pilfr['fullimage'] ) ): $pffr = wp_get_attachment_url($pilfr['fullimage']); ?>
							<div class="fullimage borderRed bgRed"><img src="<?php echo esc_url($pffr) ?>" alt="Thailand"></div>
                        <?php endif; ?>
						<div class="main-content">
							<div class="leftside-eco">
                            	<?php if ( ! empty( $pilfr['title'] ) ): ?>
									<h2><?php echo wp_kses_post( $pilfr['title'] ); ?></h2>
                                <?php endif; ?>
								<p><?php echo wp_kses( $pilfr['description'], array(
									'br' => array( 'class' => array() ),
									'strong' => array(),
								) ); ?></p>
                            </div>
							<div class="middleside-eco"></div>
						</div>
						<div class="rightside-eco" id="politics-btn">
							<div class="arrow"><i class="fas fa-chevron-left"></i></div>
							<a>Back</a>
						</div>
					</div>
				</div>
			</div>
			<!--4-->
		</div>
	</div>
</section>

<section class="advocacy-section">
                <div class="container">
                    <div class="page-title text-center">
                        <h1 class="txtBlack text-center">Thailand Policy Team Blog</h1>
                    </div>
                </div>
                <!--container-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="testimonial-block">
                            <div class="testimonial-carousel owl-carousel owl-theme">
                                <div class="testi-full container-fluid">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 testiBgOne" style="background:url(https://apacpolicy-fb-com-develop.go-vip.net/wp-content/uploads/2021/06/slider-img-1.jpg)">
                                            <div class="testimonial-left">
                                                <p>Insights from experts and regulatory authorities.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="">
                                            <div class="testimonial-right">
                                                <div>
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum</p>
                                                    <p>                       					
                                                        <a href="#"><span class="fa fa-arrow-right"></span>Read More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--1-->
                                <div class="testi-full container-fluid">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 testiBgOne" style="background-image:url(https://apacpolicy-fb-com-develop.go-vip.net/wp-content/uploads/2021/06/slider-img-1.jpg)">
                                            <div class="testimonial-left">
                                                <p>Reference Slide #2</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="">
                                            <div class="testimonial-right">
                                                <div>
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum</p>
                                                    <p>                       					
                                                        <a href="#"><span class="fa fa-arrow-right"></span>Read More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--2-->
                                <div class="testi-full container-fluid">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 testiBgOne" style="background-image:url(https://apacpolicy-fb-com-develop.go-vip.net/wp-content/uploads/2021/06/slider-img-1.jpg)">
                                            <div class="testimonial-left">
                                                <p>Reference Slide #3</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="">
                                            <div class="testimonial-right">
                                                <div>
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum</p>
                                                    <p>                       					
                                                        <a href="#"><span class="fa fa-arrow-right"></span>Read More</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--3-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--container fluid-->
            </section>

<?php
get_footer('thailand');
