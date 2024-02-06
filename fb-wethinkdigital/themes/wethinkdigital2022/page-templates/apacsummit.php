<?php
/*
Template Name: APAC Summit Page
*/

get_header();

?>
<?php $banner = get_post_meta( get_the_ID(), 'banner', true ); 
		$banner_img = wp_get_attachment_url( $banner['banner_image'] ); ?>
<section>
  <div class="container-fluid paddingZero bgWhite headerBanner" style="background-image: url(<?php echo esc_url( $banner_img ); ?>);">
    <div class="container">
      <div class="newRow">
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">
          <div class="headerTitle padding15">
        	<?php if ( ! empty( $banner['banner_title'] ) ): ?>
            <h1 class="txtWhite fontDisplay padding15 MarginBottomZero"> <?php echo wp_kses($banner['banner_title'], array(
										'sup' => array(),
										'span' => array(),
										'p' => array(),
                                        'br'=> array(),
										'a'   => array(
											'href'   => array(),
											'title'  => array(),
											'target' => array( '_blank' ),
										),
									) ); ?> </h1>
            <?php endif; ?>
          </div>
          <div class="headerTitleMob padding15 ">
            <h3 class="txtWhite fontDisplay padding15 MarginBottomZero"> </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <?php $journey = get_post_meta( get_the_ID(), 'global_journey', true ); 
        $jour_img = wp_get_attachment_url( $journey['journey_bgimage'] );
    ?>
<section id="smilestone" class="bgwhite">
  <div class="container">
        <?php if ( ! empty( $journey['heading'] ) ): ?>
    <div class="padding40">
      <h1 class="fontDisplay txtDarkBlue textCenter  marginZero"><?php echo esc_html( $journey['heading'] ); ?></h1>
    </div>
        <?php endif; ?>
  </div>
  <div class="summitjourney" id="journey" style="background-image:url(<?php echo esc_url($jour_img); ?>);">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-sm-12 col-xs-12 ">
          <div class="nav nav-tabs nav-fill jtab" id="nav-tab" role="tablist">
            <div class="tabflx">
              <!--<div class="bottom-br"> <span class="dot1"></span> <span class="dot2"></span> <span class="dot3"></span> </div>-->
              <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item"> <a class="nav-link active htab" data-toggle="tab" href="#home-h" role="tab" aria-controls="home">2019 <span class="dot"></span> </a> </li>
                <li class="nav-item"><a class="nav-link htab" data-toggle="tab" href="#profile-h" role="tab" aria-controls="profile">2020 <span class="dot"></span> </a> </li>
                <li class="nav-item"><a class="nav-link htab" data-toggle="tab" href="#messages-h" role="tab" aria-controls="messages">2021 <span class="dot"></span> </a> </li>
              </ul>
            </div>
          </div>
          <span class="info-txt"><?php echo esc_html( $journey['journey_subheading'] ); ?></span>
          </nav>
          <div class="tab-content px-3 px-sm-0" id="nav-tabContent">
                     
          <div class="tab-pane active" id="home-h" role="tabpanel">
                <?php foreach($journey['journey'] as $jour19){
                    if($jour19['year'] === '2019' ) {
                    $fimg19 =  wp_get_attachment_url( $jour19['flag'] ); ?>
                <div class="country-list">
                    <h4 class="country-name"><?php echo esc_html( $jour19['countryname'] ); ?></h4>
                    <div class="jlist"> <img src="<?php echo esc_url( $fimg19); ?>"/>
                    <h6 class="jdate"><?php echo esc_html( $jour19['jdate'] ); ?></h6>
                    <p class="jpara"><?php echo wp_kses($jour19['description'], array(
                                                    'br' => array(),
                                                    'a'   => array(
                                                        'href'   => array(),
                                                        'title'  => array(),
                                                        'target' => array( '_blank' ),
                                                    ),
                                                ) ); ?>
                    </p>
                    </div>
                </div>
                <?php } } ?>
           </div>
                   
            <div class="tab-pane" id="profile-h" role="tabpanel">
            <?php foreach($journey['journey'] as $jour20){
                if($jour20['year'] === '2020'){
                $fimg20 =wp_get_attachment_url($jour20['flag']); ?>

            <div class="country-list">
                <h4 class="country-name"><?php echo esc_html( $jour20['countryname'] ); ?></h4>
                <div class="jlist"> <img src="<?php echo esc_url( $fimg20); ?>"/>
                  <h6 class="jdate"><?php echo esc_html( $jour20['jdate'] ); ?></h6>
                  <p class="jpara"><?php echo wp_kses($jour20['description'], array(
												'br' => array(),
												'a'   => array(
													'href'   => array(),
													'title'  => array(),
													'target' => array( '_blank' ),
												),
											) ); ?>
                  </p>
                </div>
            </div>
            <?php }} ?>
           
            </div>
            <div class="tab-pane" id="messages-h" role="tabpanel">
                <?php foreach($journey['journey'] as $jour21){
                    if($jour21['year'] === '2021'){
                    $fimg21 =wp_get_attachment_url($jour20['flag']); ?>

                <div class="country-list">
                    <h4 class="country-name"><?php echo esc_html( $jour21['countryname'] ); ?></h4>
                    <div class="jlist"> <img src="<?php echo esc_url( $fimg21); ?>"/>
                    <h6 class="jdate"><?php echo esc_html( $jour21['jdate'] ); ?></h6>
                    <p class="jpara"><?php echo wp_kses($jour21['description'], array(
                                                    'br' => array(),
                                                    'a'   => array(
                                                        'href'   => array(),
                                                        'title'  => array(),
                                                        'target' => array( '_blank' ),
                                                    ),
                                                ) ); ?>
                    </p>
                    </div>
                </div>
                <?php }} ?>
              
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
    <div class="padding40">
    <?php if ( ! empty( $testi['heading'] ) ): ?>
      <h1 class="fontDisplay txtDarkBlue textCenter marginZero PaddingBottom35"><?php echo esc_html($testi['heading']); ?> </h1>
    <?php endif; ?>
      <div class="owl_4 owl-carousel owl-theme govtest">
            <?php foreach($testi['add_gov_partner'] as $test){ 
                $testi_thumb = wp_get_attachment_url( $test['pimage'] );?>
                <?php if ( ! empty( $test['pimage'] ) ): ?>
        <div class="item"> <img src="<?php echo esc_url($testi_thumb); ?>" class="gtesti-img" alt="">
                    <?php endif; 
                    if ( ! empty( $test['pcoutry'] ) ): ?>
          <h4 class="test-country-name"><?php echo esc_html($test['pcoutry']);?></h4>
                        <?php endif; ?>
          <p class="ppara">
                <?php echo wp_kses($test['description'], array(
                'sup' => array(),
                'span' => array(),
                'p' => array(),
                    ) ); ?>
          </p>
                <?php if(! empty( $test['pname'] ) ):?>
          <p class="sp-name"> <?php echo esc_html( $test['pname'] ); ?> </p>
                <?php endif; ?>
          <p class="sp-desi"> <?php echo esc_html( $test['pdDesignation'] ); ?> </p>
        </div>
            <?php } ?>
        
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- ======= About Section ======= -->
<?php $agendaone = get_post_meta( get_the_ID(), 'agendaone', true ); 
$agendatwo = get_post_meta( get_the_ID(), 'agendatwo', true ); 
if ( ! empty( $agendaone['description'] ) || ! empty( $agendatwo['description'] ) ) :
?>
<section id="sagenda">
  <div id="aboutsummit" class="summitplan">
    <div class="relative agone"> <img class="mug" src="<?php echo esc_url(get_template_directory_uri() .'/images/mug.png' ); ?>" data-aos="slide-right"
      data-aos-offset="200" data-aos-easing="ease-in-sine"/> </div>
     <div class="relative agone"> <img class="book" src="<?php echo esc_url( get_template_directory_uri() . '/images/book.png');?>" data-aos="slide-left"
        data-aos-offset="200" data-aos-easing="ease-in-sine"/>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-md-1 col-sm-12 col-xs-12"></div>
                <div class="col-md-11 col-sm-12" data-aos="zoom-in" data-aos-delay="100">
                    <div class="agenda-area mar-30">
                        <?php if ( ! empty( $agendaone['agenda_title'] ) ): ?>
                            <h3><?php echo esc_html($agendaone['agenda_title']);?></h3>
                        <?php endif; ?>
                        <?php if ( ! empty( $agendaone['agenda_subtitle'] ) ): ?>
                            <p><?php echo esc_html($agendaone['agenda_title']);?></p>
                        <?php endif; ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relative agfour"> <img class="pen" src="<?php echo esc_url( get_template_directory_uri() . '/images/pen.png')?>" data-aos="zoom-in-up" data-aos-offset="200" data-aos-easing="ease-in-sine"/>
      <!--<img class="mob" src="images/mob.png"  data-aos="slide-left" data-aos-offset="200" data-aos-easing="ease-in-sine"/>-->
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-md-1 col-sm-12 col-xs-12"></div>
          <div class="col-md-11 col-sm-12" data-aos="zoom-in" data-aos-delay="100">
            <div class="agenda-area mar-18">
            <?php if ( ! empty( $agendaone['agenda_title'] ) ): ?>
                    <h3><?php echo esc_html($agendatwo['agenda_title']);?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $agendatwo['agenda_subtitle'] ) ): ?>
                    <p><?php echo esc_html($agendatwo['agenda_title']);?></p>
            <?php endif; ?>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif;?>
<section class="bgwhite" id="spker">
  <div class="container  team-area" data-aos="fade-up">
    <div class="padding40" >
        <?php $title_speaker = get_post_meta( get_the_ID(), 'community', true ); ?>
        <?php if ( ! empty( $title_speaker['com_title'] ) ): ?>
      <h3 class="fontDisplay txtDarkBlue textCenter  marginZero PaddingBottom35"><?php echo esc_html($title_speaker['com_title']); ?> </h3>
        <?php endif; ?>
        <?php $welnote = get_post_meta( get_the_ID(), 'welnote_speakers', true ); ?>
            <?php if ( ! empty( $welnote ) ): ?>
      <div class="cstart">
        <div class="carea">
          <h6 class="crou-heading"><?php echo esc_html( $welnote['heading'] ); ?></h6>
        </div>
        <div class="owl_welcome owl-carousel owl-theme keynote mar-20">
            <?php foreach ( $welnote['add_welnote_speakers'] as $welnot ) : ?>
                <?php if ( ! empty( $welnot['pimage'] ) ): ?>
                    <?php $welnote_img = wp_get_attachment_url( $welnot['pimage'] ); ?>
          <div class="item"> <img src="<?php echo esc_url( $welnote_img ); ?>" class="testimonial-img" alt="">
                <?php endif; ?>
                <?php  if ( ! empty( $welnot['pname'] ) ): ?>
            <p class="sp-name"><?php echo esc_html( $welnot['pname'] ); ?>  </p>
                    <?php endif; ?>
                <?php  if ( ! empty( $welnot['pdDesignation'] ) ): ?>
            <p class="sp-desi"><?php echo esc_html( $welnot['pdDesignation'] ); ?> </p>
                    <?php endif; ?>
            <?php if ( ! empty( $welnot['plink_text'] ) ): ?>
            <a class="test-read-more" href="<?php echo esc_url( $welnot['plink'] ); ?>"  target="_blank"><?php echo esc_html( $welnot['plink_text'] ); ?> </a> 
            <?php endif; ?>
         </div>
         <?php endforeach; ?>
        </div>
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
                    <?php foreach($keynote['add_keynote_speakers'] as $keynot ):
                        $keynote_img = wp_get_attachment_url($keynot['pimage']);  ?>
                <div class="item"> 
                    <img src="<?php echo esc_url($keynote_img); ?>" class="testimonial-img" alt="">
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
          <h6 class="crou-heading"><?php echo esc_html($panel1['heading']); ?> </h6>
        </div>
        <?php endif; ?>
        <div class="owl_day1 owl-carousel owl-theme penlist ">
         <?php foreach(  $panel1['add_panelist'] as $pnone) { ?>
                
          <div class="item">
              <?php if(! empty( $pnone['pimage'] ) ): 
                $panel_thumb = wp_get_attachment_url( $pnone['pimage']); ?>
             <img src="<?php echo esc_url($panel_thumb); ?>" class="testimonial-img" alt="">
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
            <?php } ?>
          
        </div>
      </div>
      <?php endif; ?>
      <?php $panel2 = get_post_meta( get_the_ID(), 'panelisttwo', true ); ?>
            <?php if ( ! empty( $panel2 ) ): ?>
      <div class="cstart">
        <?php if(!empty($panel2['heading'])): ?>
        <div class="carea">
          <h6 class="crou-heading"><?php echo esc_html($panel2['heading']); ?> </h6>
        </div>
        <?php endif; ?>
        <div class="owl_day2 owl-carousel owl-theme penlist ">
          <?php foreach($panel2['add_panelisttwo'] as $panellist2):?>
          <div class="item"> 
            <?php if(!empty($panellist2['pimage'])): ?>
                <?php $plist2_thumb = wp_get_attachment_url($panellist2['pimage']);   ?>         
              <img src="<?php echo esc_url($plist2_thumb); ?>" class="testimonial-img" alt="">
            <?php endif;?>
            <?php if(!empty($panellist2['pname'])):?>
            <p class="sp-name"><?php echo esc_html($panellist2['pname']);  ?> </p>
            <?php endif; ?>
            <?php if(!empty($panellist2['pdDesignation'])): ?>
            <p class="sp-desi"><?php  echo esc_html($panellist2['pdDesignation']);?></p>
            <?php endif; ?>
            <?php if ( ! empty( $panellist2['plink_text'] ) ): ?>
                    			<a class="test-read-more" href="<?php echo esc_url( $panellist2['plink'] ); ?>" target="_blank"><?php echo esc_html( $panellist2['plink_text'] ); ?></a>
                            <?php endif; ?>
          </div>
          <?php endforeach; ?>
          
        </div>
      </div>
          <?php endif; ?>
          <?php $fireside = get_post_meta( get_the_ID(), 'fireside_speakers', true ); ?>
            <?php if ( ! empty( $fireside ) ): ?>
      <div class="cstart">
         <?php if(!empty($fireside['heading'])) : ?>
        <div class="carea">
          <h6 class="crou-heading"><?php echo esc_html($fireside['heading']); ?></h6>
        </div>
        <?php endif; ?>
        <div class="owl_fireside owl-carousel owl-theme penlist">
          <?php foreach($fireside['add_fireside_speakers'] as $fire) : 
            $fir_thumb = wp_get_attachment_url($fire['pimage']);?>
          <div class="item"> 
            <img src="<?php echo esc_url($fir_thumb); ?>" class="testimonial-img" alt="">
              <?php if( !empty($fire['pname'])): ?>
            <p class="sp-name"> <?php echo esc_html($fire['pname']) ?></p>
             <?php endif; ?>
             <?php if ( ! empty( $fire['pdDesignation'] ) ): ?>
                                	<p class="sp-desi"> <?php echo esc_html( $fire['pdDesignation'] ); ?> </p>
                                <?php endif; ?>
                                <?php if ( ! empty( $fire['plink_text'] ) ): ?>
                                	<a class="test-read-more" href="<?php echo esc_url( $fire['plink'] ); ?>" target="_blank">
                                    <?php echo esc_html( $fire['plink_text'] ); ?></a>
                                <?php endif; ?>
          </div>
          <?php endforeach;?>
        </div>
      </div>
      <?php endif;  ?>
      <?php $whatsApp = get_post_meta( get_the_ID(), 'whatsApp_speakers', true ); ?>
      <?php if ( ! empty( $whatsApp ) ): ?>
        <div class="cstart">
          <?php if(!empty($whatsApp['heading'])):?>
            <div class="carea">
              <h6 class="crou-heading"><?php echo esc_html($whatsApp['heading']); ?> </h6>
            </div>
          <?php endif; ?>
          <div class="owl_whatsapp owl-carousel owl-theme keynote">
            <?php foreach($whatsApp['add_whatsApp_speakers'] as $whats):
              $whats_thumb = wp_get_attachment_url($whats['pimage']); ?>
              <div class="item">
                  <?php if(!empty($whats['pimage'])): ?> 
                <img src="<?php echo esc_url($whats_thumb); ?>" class="testimonial-img" alt="">
                <?php endif; ?>
                <?php if(!empty($what['pname'])): ?>
                <p class="sp-name"> <?php echo esc_html($whats['pname']); ?></p>
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
<section id="spartner" class="vr bgwhite" style="background-image:url('<?php echo esc_url( $part_img ); ?>')" >
  <div class="container-fluid p-0 ptdiv">
      <?php if ( ! empty( $part['pj_title'] ) ): ?>
    <h1 class="partner-heading" data-aos="zoom-in" data-aos-delay="100">
        <?php echo esc_html($part['pj_title']); ?> 
    </h1>
      <?php endif;?>
      <?php if ( ! empty( $part['pj_desc'] ) ): ?>
    <p class="partner-para" data-aos="zoom-in" data-aos-delay="100"><?php echo wp_kses($part['pj_desc'], array(
				'br' => array(), 'span' => array(), 'b' => array(),
			) ); ?> 
    </p>
       <?php endif; ?>
       <?php if ( ! empty( $part['pj_link_text'] ) ): ?>
    <h6 class="partner-txt"><a href="<?php echo esc_url( $part['pj_link'] ); ?>" target="_blank">
        <?php echo esc_html( $part['pj_link_text'] ); ?> </a>
    </h6>
        <?php endif; ?>
  </div>
</section>
    <?php endif; ?>

<?php
get_footer();