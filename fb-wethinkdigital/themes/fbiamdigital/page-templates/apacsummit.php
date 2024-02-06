<?php
/*
Template Name: APAC Summit Page
*/

get_header();

?>
<?php $banner = get_post_meta( get_the_ID(), 'banner', true ); 
		$banner_img = wp_get_attachment_url( $banner['banner_image'] ); ?>
<section id="hero" class="bannerarea" style="background: url(<?php echo esc_url( $banner_img ); ?>);">
	<div class="container">
		<nav class="navbar" id="topMain-nav">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <img class="hemicon" src="<?php echo esc_url( get_theme_file_uri( '/images/ham.png' ) ); ?>"/> </button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav justify-content-end">
					<li class="nav-item"> <a class="nav-link" href="#smilestone">Milestones</a> </li>
					<li class="nav-item"> <a class="nav-link" href="#says">Testimonials</a> </li>
					<li class="nav-item active"> <a class="nav-link" href="#sagenda">Agenda</a> </li>
					<li class="nav-item"> <a class="nav-link" href="#spartner">Partner Highlights</a> </li>
				</ul>
                
			</div>
		</nav>
		<div class="heading-area tete">
        	<?php if ( ! empty( $banner['banner_title'] ) ): ?>
				<h1 class="top-heading"><?php echo esc_html( $banner['banner_title'] ); ?> </h1>
            <?php endif; ?>
            <?php if ( ! empty( $banner['banner_date'] ) ): ?>
				<h3 class="top-date"><?php echo wp_kses($banner['banner_date'], array(
										'sup' => array(),
										'span' => array(),
										'p' => array(),
										'a'   => array(
											'href'   => array(),
											'title'  => array(),
											'target' => array( '_blank' ),
										),
									) ); ?>
				</h3>
            <?php endif; ?>
		</div>
	</div>
</section>
<?php $event = get_post_meta( get_the_ID(), 'eventbegins', true ); ?>
<?php if ( ! empty( $event['evnet_location'] ) ): ?>
<section id="counter" class="p-10 bgblue">
	<div class="container counterarea">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
            	
                <a href="#">
                    <div class="flx-area">
                        <img class="loc-icon" src="<?php echo esc_url( get_theme_file_uri( '/images/location.png' ) ); ?>"/>
                        <h4 class="loc-txt"><?php echo esc_html( $event['evnet_location'] ); ?> </h4>
                    </div>
                </a>
                
            </div>
			<div class="col-sm-12 col-xs-12">
				<div class="eve-area">
					<h1 class="small-heading"><?php echo esc_html( $event['evnet_title'] ); ?></h1>
					<div class="timer">
						<div class="days">
							<p id="dnum"> </p><span>Days</span>
                        </div>
						<div class="hours">
							<p id="hnum"> </p><span>Hours</span>
                        </div>
						<div class="minutes">
							<p id="mnum"> </p><span>Minutes</span>
                        </div>
						<div class="second">
							<p id="snum"> </p> <span>Seconds</span>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $journey = get_post_meta( get_the_ID(), 'global_journey', true ); 
	$jour_img = wp_get_attachment_url( $journey['journey_bgimage'] );
?>
<section id="smilestone" class="bgwhite">
	<div class="container">
		<div class="row align-center">
        	<?php if ( ! empty( $journey['heading'] ) ): ?>
                <div class="col-xs-12 ">
                    <h1 class="main-heading"><?php echo esc_html( $journey['heading'] ); ?></h1>
                </div>
            <?php endif; ?>
		</div>
	</div>
    <div class="journey-back" id="journey" style="background: url(<?php echo esc_url( $jour_img ); ?>);">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-sm-12 col-xs-12 ">
					<div class="nav nav-tabs nav-fill jtab" id="nav-tab" role="tablist">
						<div class="tabflx">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item"> <a class="nav-link active htab" data-toggle="tab" href="#home-h" role="tab" aria-controls="home">2019 <span class="dot"></span> </a> </li>
								<li class="nav-item"><a class="nav-link htab" data-toggle="tab" href="#profile-h" role="tab" aria-controls="profile">2020 <span class="dot"></span> </a> </li>
								<li class="nav-item"><a class="nav-link htab" data-toggle="tab" href="#messages-h" role="tab" aria-controls="messages">2021 <span class="dot"></span> </a> </li>
							</ul>
						</div>
					</div>
                    <?php if ( ! empty( $journey['journey_subheading'] ) ): ?>
						<span class="info-txt"><?php echo esc_html( $journey['journey_subheading'] ); ?></span>
                    <?php endif; ?>
          			<div class="tab-content px-3 px-sm-0" id="nav-tabContent">
                    	<div class="tab-pane active" id="home-h" role="tabpanel">
                            	<?php foreach ( $journey['journey'] as $jour1 ): 
									if($jour1['year'] == '2019' ) {
								?>
                            	<div class="country-list">
                                	<?php if ( ! empty( $jour1['countryname'] ) ): ?>
                                    	<h4 class="country-name"><?php echo esc_html( $jour1['countryname'] ); ?> </h4>
                                    <?php endif; ?>
                                    <div class="jlist">
                                    	<?php if ( ! empty( $jour1['flag'] ) ): ?>
											<?php $img2019 = wp_get_attachment_url( $jour1['flag'] ); ?>
                                        	<img src="<?php echo esc_url( $img2019 ); ?>"/>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $jour1['jdate'] ) ): ?>
                                        	<h6 class="jdate"><?php echo esc_html( $jour1['jdate'] ); ?></h6>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $jour1['description'] ) ): ?>
                                        <p class="jpara">
                                        	<?php echo wp_kses($jour1['description'], array(
												'br' => array(),
												'a'   => array(
													'href'   => array(),
													'title'  => array(),
													'target' => array( '_blank' ),
												),
											) ); ?>
                                        </p>
                                       <?php endif; ?>
                                    </div>
                                </div>
                                <?php } endforeach; ?>
                        </div>
						<div class="tab-pane" id="profile-h" role="tabpanel">
                        	<?php foreach ( $journey['journey'] as $jourtwo ): 
								if($jourtwo['year'] == '2020' ) {
							?>
                                    <div class="country-list">
                                        <?php if ( ! empty( $jourtwo['countryname'] ) ): ?>
                                            <h4 class="country-name"><?php echo esc_html( $jourtwo['countryname'] ); ?> </h4>
                                        <?php endif; ?>
                                        <div class="jlist">
                                            <?php if ( ! empty( $jourtwo['flag'] ) ): ?>
												<?php $img2020 = wp_get_attachment_url( $jourtwo['flag'] ); ?>
                                                <img src="<?php echo esc_url( $img2020 ); ?>"/>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $jourtwo['jdate'] ) ): ?>
                                                <h6 class="jdate"><?php echo esc_html( $jourtwo['jdate'] ); ?></h6>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $jourtwo['description'] ) ): ?>
                                                <p class="jpara">
                                                    <?php echo wp_kses($jourtwo['description'], array(
														'br' => array(),
														'a'   => array(
															'href'   => array(),
															'title'  => array(),
															'target' => array( '_blank' ),
														),
                                                	) ); ?>
                                            	</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
							<?php } endforeach; ?>
            			</div>
            			<div class="tab-pane" id="messages-h" role="tabpanel">
                        	<?php foreach ( $journey['journey'] as $jourthr ): 
								if($jourthr['year'] == '2021' ) {
							?>
              				<div class="country-list">
                				<?php if ( ! empty( $jourthr['countryname'] ) ): ?>
                                	<h4 class="country-name"><?php echo esc_html( $jourthr['countryname'] ); ?> </h4>
                                <?php endif; ?>
                				<div class="jlist">
                                	<?php if ( ! empty( $jourthr['flag'] ) ):
										$img2021 = wp_get_attachment_url( $jourthr['flag'] ); ?>
                                        <img src="<?php echo esc_url( $img2021 ); ?>"/>
									<?php endif; ?>
                  					<?php if ( ! empty( $jourthr['jdate'] ) ): ?>
                                    	<h6 class="jdate"><?php echo esc_html( $jourthr['jdate'] ); ?></h6>
                                    <?php endif; ?>
                  					<?php if ( ! empty( $jourthr['description'] ) ): ?>
                                    	<p class="jpara">
											<?php echo wp_kses($jourthr['description'], array(
												'br' => array(),
												'a'   => array(
													'href'   => array(),
													'title'  => array(),
													'target' => array( '_blank' ),
												),
                                               ) ); ?>
										</p>
									<?php endif; ?>
                				</div>
              				</div>
                            <?php } endforeach; ?>
            			</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $testi = get_post_meta( get_the_ID(), 'gov_partner', true );
if ( ! empty( $testi['add_gov_partner'] ) ): ?>
<section id="says" class="testimoni bgwhite" >
	<div class="container">
		<div class="row">
        	<?php if ( ! empty( $testi['heading'] ) ): ?>
			<div class="carea">
				<h3 class="main-heading"><?php echo esc_html( $testi['heading'] ); ?> </h3>
			</div>
            <?php endif; ?>
			<div class="owl_4 owl-carousel owl-theme govtest">
            	<?php foreach ( $testi['add_gov_partner'] as $test ): ?>
                    <div class="item">
                    	<?php if ( ! empty( $test['pimage'] ) ): ?>
							<?php $icon_src = wp_get_attachment_url( $test['pimage'] ); ?>
                        	<img src="<?php echo esc_url( $icon_src ); ?>" class="gtesti-img" alt="APAC SUMMIT">
                       	<?php endif; ?>
                        <?php if ( ! empty( $test['pcoutry'] ) ): ?>
                        	<h4 class="test-country-name"><?php echo esc_html( $test['pcoutry'] ); ?></h4>
                        <?php endif; ?>
                        <div class="ppara">
                        	<?php echo wp_kses($test['description'], array(
										'sup' => array(),
										'span' => array(),
										'p' => array(),
							) ); ?>
                        </div>
                        <?php if ( ! empty( $test['pname'] ) ): ?>
                        	<p class="sp-name"><?php echo esc_html( $test['pname'] ); ?> </p>
                        <?php endif; ?>
                        <?php if ( ! empty( $test['pdDesignation'] ) ): ?>
          					<p class="sp-desi"><?php echo esc_html( $test['pdDesignation'] ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php $agendaone = get_post_meta( get_the_ID(), 'agendaone', true ); 
$agendatwo = get_post_meta( get_the_ID(), 'agendatwo', true ); 
if ( ! empty( $agendaone['description'] ) || ! empty( $agendatwo['description'] ) ) :
?>
<section id="sagenda">
	<div id="about" class="about">
		<div class="relative agone"> <img class="mug" src="<?php echo esc_url( get_theme_file_uri( '/images/mug.png' ) ); ?>" data-aos="slide-right" data-aos-offset="200" data-aos-easing="ease-in-sine"/> </div>
		<?php if ( ! empty( $agendaone['description'] )): ?>
        <div class="relative agone"> <img class="book" src="<?php echo esc_url( get_theme_file_uri( '/images/book.png' ) ); ?>" data-aos="slide-left" data-aos-offset="200" data-aos-easing="ease-in-sine"/>
			<div class="container" data-aos="fade-up">
				<div class="row">
					<div class="col-md-1 col-sm-12 col-xs-12"></div>
					<div class="col-md-11 col-sm-12" data-aos="zoom-in" data-aos-delay="100">
						<div class="agenda-area mar-30">
                        	<?php if ( ! empty( $agendaone['agenda_title'] ) ): ?>
								<h3><?php echo esc_html( $agendaone['agenda_title'] ); ?></h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $agendaone['agenda_subtitle'] ) ): ?>
								<p><?php echo esc_html( $agendaone['agenda_subtitle'] ); ?></p>
                           	<?php endif; ?>
                            <?php if ( ! empty( $agendaone['description'] ) ): ?>
							<div id="cs-table">
								<?php echo wp_kses($agendaone['description'], array(
										'sup' => array(),
										'span' => array(),
										'p' => array(),
										'ul' => array(),'li' => array(),
										'table' => array(),'tr' => array(), 'td' => array(),'th' => array(),
										'thead' => array(),'tbody' => array(),
								) ); ?>
              				</div>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php endif; ?>
		<div class="relative agfour"> <img class="pen" src="<?php echo esc_url( get_theme_file_uri( '/images/pen.png' ) ); ?>" data-aos="zoom-in-up" data-aos-offset="200" data-aos-easing="ease-in-sine"/>
			<div class="container" data-aos="fade-up">
				<div class="row">
					<div class="col-md-1 col-sm-12 col-xs-12"></div>
					<div class="col-md-11 col-sm-12" data-aos="zoom-in" data-aos-delay="100">
						<div class="agenda-area mar-18">
                        	<?php if ( ! empty( $agendatwo['agenda_title'] ) ): ?>
								<h3><?php echo esc_html( $agendatwo['agenda_title'] ); ?></h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $agendatwo['agenda_subtitle'] ) ): ?>
								<p><?php echo esc_html( $agendatwo['agenda_subtitle'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $agendatwo['description'] ) ): ?>
                                <div id="cs-table">
                                    <?php echo wp_kses($agendatwo['description'], array(
                                            'sup' => array(),
                                            'span' => array(),
                                            'p' => array(),
											'ul' => array(),'li' => array(),
											'table' => array(),'tr' => array(), 'td' => array(),'th' => array(),
											'thead' => array(),'tbody' => array(),
                                    ) ); ?>
                                </div>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="bgwhite" id="spker">
	<div class="container team-area" data-aos="fade-up">
		<div class="row" >
        	<?php $title_speaker = get_post_meta( get_the_ID(), 'community', true ); ?>
            <?php if ( ! empty( $title_speaker['com_title'] ) ): ?>
				<h3 class="main-heading"><?php echo esc_html( $title_speaker['com_title'] ); ?> </h3>
            <?php endif; ?>
            
            <?php $welnote = get_post_meta( get_the_ID(), 'welnote_speakers', true ); ?>
            <?php if ( ! empty( $welnote ) ): ?>
                <div class="cstart">
                	<?php if ( ! empty( $welnote['heading'] ) ): ?>
                        <div class="carea">
                          <h6 class="crou-heading"><?php echo esc_html( $welnote['heading'] ); ?></h6>
                        </div>
                    <?php endif; ?>
                    <div class="owl_welcome owl-carousel owl-theme keynote mar-20">
                    	<?php foreach ( $welnote['add_welnote_speakers'] as $welnot ) : ?>
                          <div class="item"> 
                            <?php if ( ! empty( $welnot['pimage'] ) ): ?>
                                <?php $welnote_img = wp_get_attachment_url( $welnot['pimage'] ); ?>
                                <img src="<?php echo esc_url( $welnote_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                            <?php endif; ?>
                            <?php if ( ! empty( $welnot['pname'] ) ): ?>
                                <p class="sp-name"> <?php echo esc_html( $welnot['pname'] ); ?> </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $welnot['pdDesignation'] ) ): ?>
                                <p class="sp-desi"> <?php echo esc_html( $welnot['pdDesignation'] ); ?> </p>
                            <?php endif; ?>
                           <?php if ( ! empty( $welnot['plink_text'] ) ): ?>
                                <a class="test-read-more" href="<?php echo esc_url( $welnot['plink'] ); ?>" target="_blank"><?php echo esc_html( $welnot['plink_text'] ); ?></a>
                           <?php endif; ?>
						</div>
                        <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php $keynote = get_post_meta( get_the_ID(), 'keynote_speakers', true ); ?>
            <?php if ( ! empty( $keynote ) ): ?>
			<div class="cstart">
            	<?php if ( ! empty( $keynote['heading'] ) ): ?>
                <div class="carea">
                  <h6 class="crou-heading"><?php echo esc_html( $keynote['heading'] ); ?></h6>
                </div>
                <?php endif; ?>
                <div class="owl_keynote owl-carousel owl-theme keynote mar-20">
                	<?php foreach ( $keynote['add_keynote_speakers'] as $keynot ) : ?>
						<div class="item">
                        	<?php if ( ! empty( $keynot['pimage'] ) ): ?>
								<?php $keynot_img = wp_get_attachment_url( $keynot['pimage'] ); ?>
                                <img src="<?php echo esc_url( $keynot_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                            <?php endif; ?>
                            <?php if ( ! empty( $keynot['pname'] ) ): ?>
                            	<p class="sp-name"> <?php echo esc_html( $keynot['pname'] ); ?> </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $keynot['pdDesignation'] ) ): ?>
                            	<p class="sp-desi"> <?php echo esc_html( $keynot['pdDesignation'] ); ?> </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $keynot['plink_text'] ) ): ?>
                            	<a class="test-read-more" href="<?php echo esc_url( $keynot['plink'] ); ?>" target="_blank">
								<?php echo esc_html( $keynot['plink_text'] ); ?></a>
                            <?php endif; ?>
                        </div>
					<?php endforeach; ?>
                </div>
      		</div>
            <?php endif; ?>
            <?php $panel1 = get_post_meta( get_the_ID(), 'panelist', true ); ?>
            <?php if ( ! empty( $panel1 ) ): ?>
			<div class="cstart">
            	<?php if ( ! empty( $panel1['heading'] ) ): ?>
                    <div class="carea">
                      <h6 class="crou-heading"><?php echo esc_html( $panel1['heading'] ); ?> </h6>
                    </div>
                <?php endif; ?>
                <div class="owl_day1 owl-carousel owl-theme penlist ">
                <?php foreach ( $panel1['add_panelist'] as $pnone ) : ?>
                  		<div class="item">
                        	<?php if ( ! empty( $pnone['pimage'] ) ): ?>
								<?php $pnone_img = wp_get_attachment_url( $pnone['pimage'] ); ?>
                        		<img src="<?php echo esc_url( $pnone_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                            <?php endif; ?>
                            <?php if ( ! empty( $pnone['pname'] ) ): ?>
                            	<p class="sp-name"> <?php echo esc_html( $pnone['pname'] ); ?> </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $pnone['pdDesignation'] ) ): ?>
                                <p class="sp-desi"> <?php echo esc_html( $pnone['pdDesignation'] ); ?> </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $pnone['plink_text'] ) ): ?>
                            	<a class="test-read-more" href="<?php echo esc_url( $pnone['plink'] ); ?>"  target="_blank"><?php echo esc_html( $pnone['plink_text'] ); ?> </a>
                            <?php endif; ?>
                   		</div>
                    <?php endforeach; ?>
                </div>
			</div>
            <?php endif; ?>
            <?php $panel2 = get_post_meta( get_the_ID(), 'panelisttwo', true ); ?>
            <?php if ( ! empty( $panel2 ) ): ?>
			<div class="cstart">
                <?php if ( ! empty( $panel2['heading'] ) ): ?>
                    <div class="carea">
                      <h6 class="crou-heading"><?php echo esc_html( $panel2['heading'] ); ?> </h6>
                    </div>
                <?php endif; ?>
                <div class="owl_day2 owl-carousel owl-theme penlist ">
                	<?php foreach ( $panel2['add_panelisttwo'] as $ptwo ) : ?>
						<div class="item">
                        	<?php if ( ! empty( $ptwo['pimage'] ) ): ?>
                            	<?php $pntwo_img = wp_get_attachment_url( $ptwo['pimage'] ); ?>
                  				<img src="<?php echo esc_url( $pntwo_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                            <?php endif; ?>
                            <?php if ( ! empty( $ptwo['pname'] ) ): ?>
                    			<p class="sp-name"> <?php echo esc_html( $ptwo['pname'] ); ?> </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $ptwo['pdDesignation'] ) ): ?>
                    			<p class="sp-desi"><?php echo esc_html( $ptwo['pdDesignation'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $ptwo['plink_text'] ) ): ?>
                    			<a class="test-read-more" href="<?php echo esc_url( $ptwo['plink'] ); ?>" target="_blank"><?php echo esc_html( $ptwo['plink_text'] ); ?></a>
                            <?php endif; ?>
						</div>
                  <?php endforeach; ?>
                </div>
			</div>
            <?php endif; ?>
            <?php $fireside = get_post_meta( get_the_ID(), 'fireside_speakers', true ); ?>
            <?php if ( ! empty( $fireside ) ): ?>
                <div class="cstart">
                    <?php if ( ! empty( $fireside['heading'] ) ): ?>
                        <div class="carea">
                          <h6 class="crou-heading"><?php echo esc_html( $fireside['heading'] ); ?> </h6>
                        </div>
                    <?php endif; ?>
                    <div class="owl_fireside owl-carousel owl-theme penlist">
                    	<?php foreach ( $fireside['add_fireside_speakers'] as $fire ) : ?>
                            <div class="item">
                            	<?php if ( ! empty( $ptwo['pimage'] ) ): ?>
                            		<?php $fire_img = wp_get_attachment_url( $fire['pimage'] ); ?>
                                	<img src="<?php echo esc_url( $fire_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                              	<?php endif; ?>
                                <?php if ( ! empty( $fire['pname'] ) ): ?>
                                	<p class="sp-name"> <?php echo esc_html( $fire['pname'] ); ?></p>
                                <?php endif; ?>
                                <?php if ( ! empty( $fire['pdDesignation'] ) ): ?>
                                	<p class="sp-desi"> <?php echo esc_html( $fire['pdDesignation'] ); ?> </p>
                                <?php endif; ?>
                                <?php if ( ! empty( $fire['plink_text'] ) ): ?>
                                	<a class="test-read-more" href="<?php echo esc_url( $fire['plink'] ); ?>" target="_blank">
                                    <?php echo esc_html( $fire['plink_text'] ); ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php $whatsApp = get_post_meta( get_the_ID(), 'whatsApp_speakers', true ); ?>
            <?php if ( ! empty( $whatsApp ) ): ?>
                <div class="cstart">
                    <?php if ( ! empty( $whatsApp['heading'] ) ): ?>
                        <div class="carea">
                          <h6 class="crou-heading"><?php echo esc_html( $whatsApp['heading'] ); ?> </h6>
                        </div>
                    <?php endif; ?>
                    <div class="owl_whatsapp owl-carousel owl-theme keynote">
                    	<?php foreach ( $whatsApp['add_whatsApp_speakers'] as $whats ) : ?>
                        	<div class="item">
                            	<?php if ( ! empty( $whats['pimage'] ) ): ?>
                            		<?php $whats_img = wp_get_attachment_url( $whats['pimage'] ); ?>
                                	<img src="<?php echo esc_url( $whats_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                              	<?php endif; ?>
                        		<?php if ( ! empty( $whats['pname'] ) ): ?>
                                	<p class="sp-name"> <?php echo esc_html( $whats['pname'] ); ?></p>
                                <?php endif; ?>
                        		<?php if ( ! empty( $whats['pdDesignation'] ) ): ?>
                                	<p class="sp-desi"> <?php echo esc_html( $whats['pdDesignation'] ); ?> </p>
                                <?php endif; ?>
                                <?php if ( ! empty( $whats['plink_text'] ) ): ?>
                                    <a class="test-read-more" href="<?php echo esc_url( $whats['plink'] ); ?>"  target="_blank">
                                   <?php echo esc_html( $whats['plink_text'] ); ?> </a>
                                <?php endif; ?>
                     		</div>
                     	<?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
		</div>
	</div>
</section>
<?php $part = get_post_meta( get_the_ID(), 'partner_journey', true );
if ( ! empty( $part['pj_image'] ) ):
	$part_img = wp_get_attachment_url( $part['pj_image'] ); ?>
<section id="spartner" class="vr bgwhite" style="background: url(<?php echo esc_url( $part_img ); ?>);">
	<div class="container-fluid p-0 ptdiv">
    	<?php if ( ! empty( $part['pj_title'] ) ): ?>
			<h1 class="partner-heading" data-aos="zoom-in" data-aos-delay="100"><?php echo esc_html( $part['pj_title'] ); ?></h1>
		<?php endif; ?>
        <?php if ( ! empty( $part['pj_desc'] ) ): ?>
        <div class="partner-para" data-aos="zoom-in" data-aos-delay="100">
			<?php echo wp_kses($part['pj_desc'], array(
				'br' => array(), 'span' => array(), 'b' => array(),
			) ); ?></div>
        <?php endif; ?>
        <?php if ( ! empty( $part['pj_link_text'] ) ): ?>
			<h6 class="partner-txt">
            	<?php if ( ! empty( $part['pj_link'] ) ){ ?>
                    <a href="<?php echo esc_url( $part['pj_link'] ); ?>" target="_blank"> 
                    <?php echo esc_html( $part['pj_link_text'] ); ?> </a>
                <?php } else { ?>
                	<?php echo esc_html( $part['pj_link_text'] ); ?>
                <?php } ?>
            </h6>
        <?php endif; ?>
	</div>
</section>
<?php endif; ?>
<?php $vd = get_post_meta( get_the_ID(), 'lookbackvd', true );
if ( ! empty( $vd['look_video'] ) ): 
$vd_url = wp_get_attachment_url( $vd['look_video'] );
?>
<section class="video-sec bgwhite">
	<div class="container">
		<div class="row">
			<div class="video-area" data-aos="fade-up">
            	<?php if ( ! empty( $vd['look_image'] ) ): ?>
					<?php $vd_img = wp_get_attachment_url( $vd['look_image'] ); endif; ?>
                <video id="lookback-vd" controls poster="<?php echo esc_url( $vd_img ); ?>">
                    <source src="<?php echo esc_url( $vd_url ); ?>" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
                <?php if ( ! empty( $vd['look_title'] ) ): ?>
                <h1 class="video-titl"> <?php echo esc_html( $vd['look_title'] ); ?> </h1>
                <?php endif; ?>
            </div>
        </div>
	</div>
</section>
<?php endif; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
get_footer();
