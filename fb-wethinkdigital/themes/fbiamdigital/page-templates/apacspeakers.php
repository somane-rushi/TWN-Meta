<?php
/*
Template Name: APAC Summit Speakers Page
*/

get_header();
$postid='1383';
$mypost_id = wpcom_vip_url_to_postid( esc_url( site_url() ).'/apacsummit/');
$postid=$mypost_id;
?>
<section class="paddingNone">
	<div class="container">
		<nav class="navbar" id="topMain-nav">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <img class="hemicon" src="<?php echo esc_url( get_theme_file_uri( '/images/ham.png' ) ); ?>"/> </button>
            	<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav justify-content-end">
						<li class="nav-item"> <a class="nav-link text-grey" href="<?php echo esc_url( site_url() ); ?>/apacsummit/#smilestone">Milestones</a> </li>
                        <li class="nav-item"> <a class="nav-link text-grey" href="<?php echo esc_url( site_url() ); ?>/apacsummit/#says">Testimonials</a> </li>
						<li class="nav-item active"> <a class="nav-link text-grey" href="<?php echo esc_url( site_url() ); ?>/apacsummit/#sagenda">Agenda</a> </li>
						<li class="nav-item"> <a class="nav-link text-grey" href="<?php echo esc_url( site_url() ); ?>/apacsummit/#spartner">Partner Highlights</a> </li>
						
					</ul>
				</div>
		</nav>
	</div> 
</section>

<section class="bgwhite" id="spker">
	<div class="container" data-aos="fade-up">
    	<?php $head = get_post_meta($postid, 'speakerpagehead', true );
			 if ( ! empty( $head ) ): ?>
                <div class="row">
                    <h3 class="main-heading"><?php echo esc_html( $head['evnet_title'] ); ?></h3>
                </div>
        <?php endif; ?>
        <div class="row">
        
        	<?php $welnote = get_post_meta($postid, 'welnote_speakers', true ); ?>
            <?php if ( ! empty( $welnote ) ): ?>
                <div class="cstart" id="welcome_note">
                	<?php if ( ! empty( $welnote['heading'] ) ): ?>
                    <div class="carea">
                        <h6 class="crou-heading mar-20"><?php echo esc_html( $welnote['heading'] ); ?></h6>
                    </div>
                    <?php endif; ?>
                    <div class="keynote mar-20">
                    	<?php foreach ( $welnote['add_welnote_speakers'] as $welnot ) : ?>
                            <div class="item">
                                <div class="dispLeft">
                                	<?php if ( ! empty( $welnot['pimage'] ) ): ?>
                                		<?php $welnote_img = wp_get_attachment_url( $welnot['pimage'] ); ?>
                                    	<img src="<?php echo esc_url( $welnote_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                                    <?php endif; ?>
                                </div>
                                <div class="dispRight">
                                	<?php if ( ! empty( $welnot['pname'] ) ): ?>
                                    	<h3 class="spkrName marB-16"><?php echo esc_html( $welnot['pname'] ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $welnot['pdDesignation'] ) ): ?>
                                    	<p class="spkrDes"> <?php echo esc_html( $welnot['pdDesignation'] ); ?> </p>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $welnot['pdDesignation'] ) ): ?>
                                    <p class="spkrBio">
										<?php echo wp_kses($welnot['description'], array(
												'br' => array(),
												'span' => array(),
											) ); ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div><!--Keynote Speaker-->
                </div><!--cstart-->
            <?php endif; ?>
            
            <?php $keynote = get_post_meta( $postid, 'keynote_speakers', true ); ?>
            <?php if ( ! empty( $keynote ) ): ?>
                <div class="cstart" id="key_note">
                	<?php if ( ! empty( $keynote['heading'] ) ): ?>
                        <div class="carea">
                            <h6 class="crou-heading mar-20"><?php echo esc_html( $keynote['heading'] ); ?></h6>
                        </div>
                    <?php endif; ?>
                    <div class="keynote mar-20">
                    	<?php foreach ( $keynote['add_keynote_speakers'] as $keynot ) : ?>
                            <div class="item">
                                <div class="dispLeft">
                                	<?php if ( ! empty( $keynot['pimage'] ) ): ?>
										<?php $keynot_img = wp_get_attachment_url( $keynot['pimage'] ); ?>
                                    	<img src="<?php echo esc_url( $keynot_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                                    <?php endif; ?>
                                </div>
                                <div class="dispRight">
                                	<?php if ( ! empty( $keynot['pname'] ) ): ?>
                            			<h3 class="spkrName marB-16"><?php echo esc_html( $keynot['pname'] ); ?></h3>
                            		<?php endif; ?>
                                    <?php if ( ! empty( $keynot['pdDesignation'] ) ): ?>
                                    	<p class="spkrDes"><?php echo esc_html( $keynot['pdDesignation'] ); ?></p>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $keynot['description'] ) ): ?>
                                    	<p class="spkrBio"><?php echo wp_kses($keynot['description'], array(
												'br' => array(),
												'span' => array(),
											) ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
						<?php endforeach; ?>
                    </div><!--Keynote Speaker-->
                </div><!--cstart-->
            <?php endif; ?>
            <?php $panel1 = get_post_meta( $postid, 'panelist', true ); ?>
            <?php if ( ! empty( $panel1 ) ): ?>
                <div class="cstart" id="panelone">
                	<?php if ( ! empty( $panel1['heading'] ) ): ?>
                        <div class="carea">
                            <h6 class="crou-heading mar-20"><?php echo esc_html( $panel1['heading'] ); ?></h6>
                        </div>
                    <?php endif; ?>
                    <div class="keynote mar-20">
                    	 <?php foreach ( $panel1['add_panelist'] as $pnone ) : ?>
                            <div class="item">
                                <div class="dispLeft">
                                    <?php if ( ! empty( $pnone['pimage'] ) ): ?>
                                        <?php $pnone_img = wp_get_attachment_url( $pnone['pimage'] ); ?>
                                        <img src="<?php echo esc_url( $pnone_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                                    <?php endif; ?>
                                </div>
                                <div class="dispRight">
                                    <?php if ( ! empty( $pnone['pname'] ) ): ?>
                                        <h3 class="spkrName marB-16"><?php echo esc_html( $pnone['pname'] ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $pnone['pdDesignation'] ) ): ?>
                                        <p class="spkrDes"><?php echo esc_html( $pnone['pdDesignation'] ); ?> </p>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $pnone['description'] ) ): ?>
                                            <p class="spkrBio"><?php echo wp_kses($pnone['description'], array(
                                                'br' => array(),
                                                'span' => array(),
                                            ) ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
						<?php endforeach; ?>
                    </div><!--Speaker 1-->
                </div><!--cstart-->
            <?php endif; ?>
            
            <?php $panel2 = get_post_meta( $postid, 'panelisttwo', true ); ?>
            <?php if ( ! empty( $panel2 ) ): ?>
                <div class="cstart" id="paneltwo">
                	<?php if ( ! empty( $panel2['heading'] ) ): ?>
                        <div class="carea">
                            <h6 class="crou-heading mar-20"><?php echo esc_html( $panel2['heading'] ); ?></h6>
                        </div>
                    <?php endif; ?>
                    <div class="keynote mar-20">
                    	<?php foreach ( $panel2['add_panelisttwo'] as $ptwo ) : ?>
                            <div class="item">
                                <div class="dispLeft">
                                	<?php if ( ! empty( $ptwo['pimage'] ) ): ?>
										<?php $pntwo_img = wp_get_attachment_url( $ptwo['pimage'] ); ?>
                                        <img src="<?php echo esc_url( $pntwo_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                                    <?php endif; ?>
                                </div>
                                <div class="dispRight">
                                	<?php if ( ! empty( $ptwo['pname'] ) ): ?>
                                        <h3 class="spkrName marB-16"><?php echo esc_html( $ptwo['pname'] ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $ptwo['pdDesignation'] ) ): ?>
                                        <p class="spkrDes"><?php echo esc_html( $ptwo['pdDesignation'] ); ?> </p>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $ptwo['description'] ) ): ?>
                               			<p class="spkrBio"><?php echo wp_kses($ptwo['description'], array(
											'br' => array(),
											'span' => array(),
										) ); ?></p>
                                	<?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div><!--Speaker 5-->
                </div><!--cstart-->
			<?php endif; ?>
            
            <?php $fireside = get_post_meta( $postid, 'fireside_speakers', true ); ?>
            <?php if ( ! empty( $fireside ) ): ?>
                <div class="cstart" id="fireside">
					<?php if ( ! empty( $fireside['heading'] ) ): ?>
                        <div class="carea">
                            <h6 class="crou-heading mar-20"><?php echo esc_html( $fireside['heading'] ); ?></h6>
                        </div>
                    <?php endif; ?>
                    <div class="keynote mar-20">
                    	<?php foreach ( $fireside['add_fireside_speakers'] as $fire ) : ?>
                        <div class="item">
                            <div class="dispLeft">
                                <?php if ( ! empty( $fire['pimage'] ) ): ?>
                            		<?php $fire_img = wp_get_attachment_url( $fire['pimage'] ); ?>
                                	<img src="<?php echo esc_url( $fire_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                              	<?php endif; ?>
                            </div>
                            <div class="dispRight">
                            	<?php if ( ! empty( $fire['pname'] ) ): ?>
                                	<h3 class="spkrName marB-16"><?php echo esc_html( $fire['pname'] ); ?></h3>
                                <?php endif; ?>
                                <?php if ( ! empty( $fire['pdDesignation'] ) ): ?>
                                	<p class="spkrDes"><?php echo esc_html( $fire['pdDesignation'] ); ?> </p>
                                <?php endif; ?>
                                <?php if ( ! empty( $fire['description'] ) ): ?>
                               		<p class="spkrBio"><?php echo wp_kses($fire['description'], array(
										'br' => array(),
										'span' => array(),
									) ); ?></p>
                               <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div><!--Fireside 1-->
				</div><!--cstart-->
			<?php endif; ?>
            
            
            <?php $whatsApp = get_post_meta( $postid, 'whatsApp_speakers', true ); ?>
            <?php if ( ! empty( $whatsApp ) ): ?>
                <div class="cstart" id="whatsapp">
                	<?php if ( ! empty( $whatsApp['heading'] ) ): ?>
                        <div class="carea">
                            <h6 class="crou-heading mar-20"><?php echo esc_html( $whatsApp['heading'] ); ?></h6>
                        </div>
                    <?php endif; ?>
                    <div class="keynote mar-20">
                    	<?php foreach ( $whatsApp['add_whatsApp_speakers'] as $whats ) : ?>
                            <div class="item">
                                <div class="dispLeft">
                                   	<?php if ( ! empty( $whats['pimage'] ) ): ?>
										<?php $whats_img = wp_get_attachment_url( $whats['pimage'] ); ?>
                                        <img src="<?php echo esc_url( $whats_img ); ?>" class="testimonial-img" alt="APAC SUMMIT">
                                    <?php endif; ?>
                                </div>
                                <div class="dispRight">
                                	<?php if ( ! empty( $whats['pname'] ) ): ?>
                                        <h3 class="spkrName marB-16"><?php echo esc_html( $whats['pname'] ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $whats['pdDesignation'] ) ): ?>
                                        <p class="spkrDes"> <?php echo esc_html( $whats['pdDesignation'] ); ?> </p>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $whats['description'] ) ): ?>
                               			<p class="spkrBio"><?php echo wp_kses($whats['description'], array(
											'br' => array(),
											'span' => array(),
										) ); ?></p>
                                	<?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
			<?php endif; ?>
            
		</div> <!-- row -->
	</div>
</section>


<?php
get_footer();
