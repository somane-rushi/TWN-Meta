<?php
/* Template Name: Rediscovethailandnew */
get_header();
?>
<?php $sectionfive = get_post_meta( get_the_ID(), 'sectionone', true ); 
$secthimage1 = wp_get_attachment_url($sectionfive['img']);
?>

<section>
  <div class="div100">
    <img src="https://apacpolicy-fb-com-develop.go-vip.net/thailand/wp-content/uploads/sites/3/2022/10/rediscover-thailand-kv.gif" alt="Thailand Keyvisual" class="div100" />
  </div>    
</section>  


  <?php $sectiontwo = get_post_meta( get_the_ID(), 'sectiontwo', true );
    if ( ! empty( $sectiontwo['heading'] ) || ! empty( $sectiontwo['description'] ) ): ?>
<section class="intro-area pad80 bggrayl">
    <div class="container">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom">
        <div class="introtxtpara black left mb30">
          <?php if ( ! empty( $sectiontwo['description'] ) ): ?>
          <?php echo $sectiontwo['description'];  ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom">
        <div class="bluebg introinfo brds5 pad30">
          <p class="opt-md white font16 left mb20">
            <?php if ( ! empty( $sectiontwo['heading'] ) ): ?>
            <?php echo wp_kses_post( $sectiontwo['heading'] ); ?>
            <?php endif; ?>
          </p>
          <h5 class="white font18 opt-md left">Date:
            <?php if ( ! empty( $sectiontwo['date'] ) ): ?>
            <?php echo wp_kses_post( $sectiontwo['date'] ); ?>
            <?php endif; ?>
            <br/>
            Venue:
            <?php if ( ! empty( $sectiontwo['venue'] ) ): ?>
            <?php echo wp_kses_post( $sectiontwo['venue'] ); ?>
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
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" >
        <div class="effectarea" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom" data-aos-delay="100">
          <?php if($secthimage1  !=  ''){ ?>
          <img src="<?php echo esc_url($secthimage1); ?>"/>
          <?php } ?>
        </div>
        <h6 class="black center font16 opt-txt bold pad20">
          <?php if ( ! empty( $sectionthree['heading1'] ) ): ?>
          <?php echo wp_kses_post( $sectionthree['heading1'] ); ?>
          <?php endif; ?>
        </h6>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" >
        <div class="effectarea" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom" data-aos-delay="200">
          <?php if($secthimage2  !=  ''){ ?>
          <img src="<?php echo esc_url($secthimage2); ?>"/>
          <?php } ?>
        </div>
        <h6 class="black center font16 opt-txt bold pad20">
          <?php if ( ! empty( $sectionthree['heading2'] ) ): ?>
          <?php echo wp_kses_post( $sectionthree['heading2'] ); ?>
          <?php endif; ?>
        </h6>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" >
        <div class="effectarea" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom" data-aos-delay="400">
          <?php if($secthimage3  !=  ''){ ?>
          <img src="<?php echo esc_url($secthimage3); ?>"/>
          <?php } ?>
        </div>
        <h6 class="black center font16 opt-txt bold pad20">
          <?php if ( ! empty( $sectionthree['heading3'] ) ): ?>
          <?php echo wp_kses_post( $sectionthree['heading3'] ); ?>
          <?php endif; ?>
        </h6>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" >
        <div class="effectarea" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom" data-aos-delay="500">
          <?php if($secthimage4  !=  ''){ ?>
          <img src="<?php echo esc_url($secthimage4); ?>"/>
          <?php } ?>
        </div>
        <h6 class="black center font16 opt-txt bold pad20">
          <?php if ( ! empty( $sectionthree['heading4'] ) ): ?>
          <?php echo wp_kses_post( $sectionthree['heading4'] ); ?>
          <?php endif; ?>
        </h6>
      </div>
    </div>
</section>
<section class="tvarea pad80 bggrayl">
    <div class="container mxwidth4">
      <div class="tabbable-panel">
        <div class="tabbable-line">
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 nopadding">
            <ul class="nav nav-tabs mapjtab" data-aos="zoom-in"  data-aos-easing="ease-in-sine">
            <li id="pr0" class="active disnonera" > <a href="#rl0" data-toggle="tab"></a> </li>
              <li id="pr1" class=""> <a href="#rl1" data-toggle="tab"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/gp.png"/> </a> </li>
              <li id="pr2"> <a href="#rl2" data-toggle="tab"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/pp.png"/> </a> </li>
              <li id="pr3"> <a href="#rl3" data-toggle="tab"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/yp.png"/> </a> </li>
              <li id="pr4"> <a href="#rl4" data-toggle="tab"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/bp.png"/> </a> </li>
              <li id="pr5"> <a class="center opt-txt black" href="#rl5" data-toggle="tab" >Restart your journey to Rediscover Thailand </a>
          </li>
              <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/mapff.png"/>
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
              <div class="tab-pane active" id="rl5">
                <div class="top-area" data-aos="zoom-in"  data-aos-easing="ease-in-sine">
                  <h6 class="black opt-md bold left pad20 font16 topgrdarea">A Virtual Journey across Thailand</h6>
                <?php if ( ! empty( $sectionvirtour['description1'] ) ): ?>    <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage1  !=  ''){ ?>
                      <img src="<?php echo $secthimage1;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectionvirtour['title1'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectionvirtour['title1'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectionvirtour['description1'] ) ): ?>
                        <div class="black  opt-txt font12 left nomargin"> <?php echo wp_kses_post( strip_tags($sectionvirtour['description1']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode1  !=  ''){ ?>
                        <img src="<?php echo $barcode1;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
				   <?php endif; ?><?php if ( ! empty( $sectionvirtour['description2'] ) ): ?> 
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage2  !=  ''){ ?>
                      <img src="<?php echo $secthimage2;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectionvirtour['title2'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectionvirtour['title2'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectionvirtour['description2'] ) ): ?>
                        <div class="black  opt-txt font12 left"> <?php echo wp_kses_post( strip_tags($sectionvirtour['description2']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode2  !=  ''){ ?>
                        <img src="<?php echo $barcode2;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
                  </div><?php endif; ?>
                </div>
              </div>
              <?php $sectionnorthernregion = get_post_meta( get_the_ID(), 'sectionnorthernregion', true ); 
              $secthimage1 = wp_get_attachment_url($sectionnorthernregion['image1']);
              $secthimage2 = wp_get_attachment_url($sectionnorthernregion['image2']);
              $barcode1 = wp_get_attachment_url($sectionnorthernregion['barcode1']);
              $barcode2 = wp_get_attachment_url($sectionnorthernregion['barcode2']);
              ?>
              <div class="tab-pane" id="rl1">
                <div class="top-area">
                  <h6 class="black opt-md bold left pad20 font16 topgrdarea">Northern Region</h6>
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage1  !=  ''){ ?>
                      <img src="<?php echo $secthimage1;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectionnorthernregion['title1'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectionnorthernregion['title1'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectionnorthernregion['description1'] ) ): ?>
                        <div class="black  opt-txt font12 left nomargin"> <?php echo wp_kses_post( strip_tags($sectionnorthernregion['description1']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode1  !=  ''){ ?>
                        <img src="<?php echo $barcode1;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage2  !=  ''){ ?>
                      <img src="<?php echo $secthimage2;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectionnorthernregion['title2'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectionnorthernregion['title2'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectionnorthernregion['description2'] ) ): ?>
                        <div class="black  opt-txt font12 left"> <?php echo wp_kses_post( strip_tags($sectionnorthernregion['description2']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode2  !=  ''){ ?>
                        <img src="<?php echo $barcode2;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
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
                  <h6 class="black opt-md bold left pad20 font16 topgrdarea">Northeastern Region</h6>
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage1  !=  ''){ ?>
                      <img src="<?php echo $secthimage1;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectionnortheasternregion['title1'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectionnortheasternregion['title1'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectionnortheasternregion['description1'] ) ): ?>
                        <div class="black  opt-txt font12 left nomargin"> <?php echo wp_kses_post( strip_tags($sectionnortheasternregion['description1']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode1  !=  ''){ ?>
                        <img src="<?php echo $barcode1;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage2  !=  ''){ ?>
                      <img src="<?php echo $secthimage2;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectionnortheasternregion['title2'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectionnortheasternregion['title2'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectionnortheasternregion['description2'] ) ): ?>
                        <div class="black  opt-txt font12 left"> <?php echo wp_kses_post( strip_tags($sectionnortheasternregion['description2']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode2  !=  ''){ ?>
                        <img src="<?php echo $barcode2;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
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
                  <h6 class="black opt-md bold left pad20 font16 topgrdarea">Central Region</h6>
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage1  !=  ''){ ?>
                      <img src="<?php echo $secthimage1;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectioncentralregion['title1'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectioncentralregion['title1'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectioncentralregion['description1'] ) ): ?>
                        <div class="black  opt-txt font12 left nomargin"> <?php echo wp_kses_post( strip_tags($sectioncentralregion['description1']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode1  !=  ''){ ?>
                        <img src="<?php echo $barcode1;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage2  !=  ''){ ?>
                      <img src="<?php echo $secthimage2;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectioncentralregion['title2'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectioncentralregion['title2'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectioncentralregion['description2'] ) ): ?>
                        <div class="black  opt-txt font12 left"> <?php echo wp_kses_post( strip_tags($sectioncentralregion['description2']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode2  !=  ''){ ?>
                        <img src="<?php echo $barcode2;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
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
                  <h6 class="black opt-md bold left pad20 font16 topgrdarea">Southern Region</h6>
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage1  !=  ''){ ?>
                      <img src="<?php echo $secthimage1;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectionssouthernregion['title1'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectionssouthernregion['title1'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectionssouthernregion['description1'] ) ): ?>
                        <div class="black  opt-txt font12 left nomargin"> <?php echo wp_kses_post( strip_tags($sectionssouthernregion['description1']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode1  !=  ''){ ?>
                        <img src="<?php echo $barcode1;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="trvinfoarea">
                    <div class="reimgarea">
                      <?php if($secthimage2  !=  ''){ ?>
                      <img src="<?php echo $secthimage2;?>" style="width:100%"/>
                      <?php } ?>
                    </div>
                    <div class="flexsecarea3">
                      <div class="txtareaitvinfo">
                        <?php if ( ! empty( $sectionssouthernregion['title2'] ) ): ?>
                        <h6 class="blue  opt-txt font14 left nomargin"> <?php echo wp_kses_post( $sectionssouthernregion['title2'] ); ?> </h6>
                        <?php endif; ?>
                        <?php if ( ! empty( $sectionssouthernregion['description2'] ) ): ?>
                        <div class="black  opt-txt font12 left"> <?php echo wp_kses_post( strip_tags($sectionssouthernregion['description2']) ); ?> </div>
                        <?php endif; ?>
                      </div>
                      <div class="barcodearea">
                        <?php if($barcode2  !=  ''){ ?>
                        <img src="<?php echo $barcode2;  ?>" class="barcodeimg"/>
                        <?php } ?>
                      </div>
                    </div>
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine">
          <?php if ( ! empty( $sectionvideo['heading'] ) ): ?>
          <h3 class="blue font24 opt-md center mb60 text-uppercase mxwidth3"> <?php echo wp_kses_post( $sectionvideo['heading'] ); ?> </h3>
          <?php endif; ?>
          <?php if($file  !=  ''){ ?>
          <video controls <?php if($img  !=  ''){ ?> poster="<?php echo $img;?>" <?php } ?>id="makingvideo">
            <source src="<?php echo $file;?>" type="video/mp4">
          </video>
          <?php } ?>
          <!--<img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/playicon.png" class="playicon"/>-->
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
      <h3 class="blue font24 opt-md center mb60 text-uppercase"> <?php echo wp_kses_post( $sectionfour['heading'] ); ?> </h3>
      <?php endif; ?>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="creator-box" data-aos="fade-up"data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="100">
            <?php if($secthimage1  !=  ''){ ?>
            <img src="<?php echo $secthimage1;?>"/>
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
                  <a href="<?php echo $sectionfour['insta1'] ;?>" target="_blank"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                  <?php endif; ?>
              </div>
            </div>
              <p class="opt-txt black font14 left mb20 ">
                <?php if ( ! empty( $sectionfour['subtitle1'] ) ): ?>
                <?php echo wp_kses_post( $sectionfour['subtitle1'] ); ?>
                <?php endif; ?>
              </p>
              <p class="opt-txt black font14 left ">
                <?php if ( ! empty( $sectionfour['description1'] ) ): ?>
                <?php echo strip_tags($sectionfour['description1']);  ?>
                <?php endif; ?>
              </p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="300">
            <?php if($secthimage2  !=  ''){ ?>
            <img src="<?php echo $secthimage2;?>"/>
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
                  <a href="<?php echo $sectionfour['insta2'] ;?>" target="_blank"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                  <?php endif; ?>
                </div>
              </div>
              <p class="opt-txt black font14 left mb20 ">
                <?php if ( ! empty( $sectionfour['subtitle2'] ) ): ?>
                <?php echo wp_kses_post( $sectionfour['subtitle2'] ); ?>
                <?php endif; ?>
              </p>
              <p class="opt-txt black font14 left ">
                <?php if ( ! empty( $sectionfour['description2'] ) ): ?>
                <?php echo strip_tags($sectionfour['description2']);  ?>
                <?php endif; ?>
              </p>
            </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="600">
            <?php if($secthimage3  !=  ''){ ?>
            <img src="<?php echo $secthimage3;?>"/>
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
                  <a href="<?php echo $sectionfour['insta3'] ;?>" target="_blank"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                  <?php endif; ?>
                </div>
              </div>
              <p class="opt-txt black font14 left mb20 ">
                <?php if ( ! empty( $sectionfour['subtitle3'] ) ): ?>
                <?php echo wp_kses_post( $sectionfour['subtitle3'] ); ?>
                <?php endif; ?>
              </p>
              <p class="opt-txt black font14 left ">
                <?php if ( ! empty( $sectionfour['description3'] ) ): ?>
                <?php echo strip_tags($sectionfour['description3']);  ?>
                <?php endif; ?>
              </p>
            </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-4 col-md-offset-2 col-sm-6 col-xs-12">
          <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="900">
            <?php if($secthimage4  !=  ''){ ?>
            <img src="<?php echo $secthimage4;?>"/>
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
                  <a href="<?php echo $sectionfour['insta4'] ;?>" target="_blank"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                  <?php endif; ?>
                </div>
              </div>
              <p class="opt-txt black font14 left mb20 ">
                <?php if ( ! empty( $sectionfour['subtitle4'] ) ): ?>
                <?php echo wp_kses_post( $sectionfour['subtitle4'] ); ?>
                <?php endif; ?>
              </p>
              <p class="opt-txt black font14 left ">
                <?php if ( ! empty( $sectionfour['description4'] ) ): ?>
                <?php echo strip_tags($sectionfour['description4']);  ?>
                <?php endif; ?>
              </p>
            </div>
          </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6  col-md-offset-0 col-sm-offset-3 col-xs-12">
          <div class="creator-box" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="1200">
            <?php if($secthimage5  !=  ''){ ?>
            <img src="<?php echo $secthimage5;?>"/>
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
                  <a href="<?php echo $sectionfour['insta5'] ;?>" target="_blank"> <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/inslogo.png"  onmouseover="hover(this);" onmouseout="unhover(this);"/> </a>
                  <?php endif; ?>
                </div>
              </div>
              <p class="opt-txt black font14 left mb20">
                <?php if ( ! empty( $sectionfour['subtitle5'] ) ): ?>
                <?php echo wp_kses_post( $sectionfour['subtitle5'] ); ?>
                <?php endif; ?>
              </p>
              <p class="opt-txt black font14 left ">
                <?php if ( ! empty( $sectionfour['description5'] ) ): ?>
                <?php echo strip_tags($sectionfour['description5']);  ?>
                <?php endif; ?>
              </p>
            </div>
          </div>
      </div>
      <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/umbrella-flip.gif" class="umbimg" data-aos="fade-down-left"
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
       <h3 class="blue font24 opt-md center mb30 text-uppercase">
        <?php if ( ! empty( $sectionfive['maintitle'] ) ): ?>
        <?php echo wp_kses_post( $sectionfive['maintitle'] ); ?>
        <?php endif; ?>
        </h3>
        <p class="opt-txt font14 center black mb60">
        <?php if ( ! empty( $sectionfive['maindescription'] ) ): ?>
        <?php echo strip_tags($sectionfive['maindescription']);  ?>
        <?php endif; ?>
        </p>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="mb30 bhbox" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="100">
            <div class="bbimgarea">
              <?php if($secthimage1  !=  ''){ ?>
              <a class="popup-youtube" href="<?php echo $sectionfive['link1']; ?>"> 
              <img src="<?php echo $secthimage1;?>"/> </a>
              <?php } ?>
            </div>
            <h3 class="blue opt-txt bold font15 center">
              <?php if ( ! empty( $sectionfive['title1'] ) ): ?>
              <?php echo wp_kses_post( $sectionfive['title1'] ); ?>
              <?php endif; ?>
            </h3>
            <p class="opt-txt black font14 center">
              <?php if ( ! empty( $sectionfive['description1'] ) ): ?>
              <?php echo strip_tags($sectionfive['description1']);  ?>
              <?php endif; ?>
            </p>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="mb30 bhbox" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="300">
            <div class="bbimgarea">
              <?php if($secthimage2  !=  ''){ ?>
              <a class="popup-youtube" 
			         href="<?php echo $sectionfive['link2']; ?>"><img src="<?php echo $secthimage2;?>"/> </a>
              <?php } ?>
            </div>
            <h3 class="blue opt-txt bold font15 center">
              <?php if ( ! empty( $sectionfive['title2'] ) ): ?>
              <?php echo wp_kses_post( $sectionfive['title2'] ); ?>
              <?php endif; ?>
            </h3>
            <p class="opt-txt black font14 center">
              <?php if ( ! empty( $sectionfive['description2'] ) ): ?>
              <?php echo strip_tags($sectionfive['description2']);  ?>
              <?php endif; ?>
            </p>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="mb30 bhbox" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="600">
            <div class="bbimgarea">
              <?php if($secthimage3  !=  ''){ ?>
              <a class="popup-youtube" 
	       		href="<?php echo $sectionfive['link3']; ?>"> <img src="<?php echo $secthimage3;?>"/> </a>
              <?php } ?>
            </div>
            <h3 class="blue opt-txt bold font15 center">
              <?php if ( ! empty( $sectionfive['title3'] ) ): ?>
              <?php echo wp_kses_post( $sectionfive['title3'] ); ?>
              <?php endif; ?>
            </h3>
            <p class="opt-txt black font14 center">
              <?php if ( ! empty( $sectionfive['description3'] ) ): ?>
              <?php echo strip_tags($sectionfive['description3']);  ?>
              <?php endif; ?>
            </p>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >
          <div class="mb30 bhbox" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-delay="900">
            <div class="bbimgarea">
              <?php if($secthimage4  !=  ''){ ?>
              <a class="popup-youtube" 
		          	href="<?php echo $sectionfive['link4']; ?>"> <img src="<?php echo $secthimage4;?>"/> </a>
              <?php } ?>
            </div>
            <h3 class="blue opt-txt bold font15 center">
              <?php if ( ! empty( $sectionfive['title4'] ) ): ?>
              <?php echo wp_kses_post( $sectionfive['title4'] ); ?>
              <?php endif; ?>
            </h3>
            <p class="opt-txt black font14 center">
              <?php if ( ! empty( $sectionfive['description4'] ) ): ?>
              <?php echo strip_tags($sectionfive['description4']);  ?>
              <?php endif; ?>
            </p>
          </div>
        </div>
       <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/ddr1.png" class="ddrarea" data-aos="fade-up-right"
     data-aos-offset="200" data-aos-easing="ease-in-sine"/>
     </div>
</section>
  <?php $whatsApp = get_post_meta( get_the_ID(), 'sectioneight', true ); ?>
  <?php   $count =  count($whatsApp['add_Posts1']); ?>
  <section class="testiarea pad80 pb50 bggrayl">
    <div class="container mxwidth pa40" data-aos="fade-up" data-aos-offset="200" data-aos-easing="ease-in-sine">
      <h3 class="black font24 opt-md text-uppercase center">
        <?php if ( ! empty( $whatsApp['title'] ) ): ?>
        <?php echo strip_tags($whatsApp['title']);  ?>
        <?php endif; ?>
      </h3>
      <div id="partnerslider" class="owl-carousel">
        <?php foreach ( $whatsApp['add_Posts1']  as $whats ) : ?>
        <div class="item">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> 
       <img class="testimg" src="<?php echo wp_get_attachment_url($whats['image1']);?>"/>
 </div>
   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <div class="testcondispara mb15">
                <?php if ( ! empty( $whats['description1'] ) ): ?>
                <?php echo wp_kses_post($whats['description1']); ?>
                <?php endif; ?>
         </div>
              <p class="opt-txt font14 left black">
                <?php if ( ! empty( $whats['author'] ) ): ?>
                <?php echo strip_tags($whats['author']);  ?>
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
      <h3 class="blue font24 opt-md  center mb60 text-uppercase" data-aos="fade-up"
    data-aos-easing="ease-in-sine">
        <?php if ( ! empty( $sectionsix['title'] ) ): ?>
        <?php echo wp_kses_post( $sectionsix['title'] ); ?>
        <?php endif; ?>
      </h3>
      <?php if($secthimage1  !=  ''){ ?>
      <img src="<?php echo $secthimage1;?>" class="ptlogo" data-aos="fade-up"
      data-aos-easing="ease-in-sine"/>
      <?php } ?>
      <h3 class="opt-txt font18 blue center  bold mb5" data-aos="fade-up"
     data-aos-easing="ease-in-sine">
        <?php if ( ! empty( $sectionsix['heading'] ) ): ?>
        <?php echo wp_kses_post( $sectionsix['heading'] ); ?>
        <?php endif; ?>
      </h3>
      <p class="opt-txt font14 black center pl-3 pr-3" data-aos="fade-up"
      data-aos-easing="ease-in-sine">
        <?php if ( ! empty( $sectionsix['description'] ) ): ?>
        <?php echo wp_kses_post( strip_tags($sectionsix['description']) ); ?>
        <?php endif; ?>
      </p>
      <img src="<?php echo get_bloginfo('url');?>/wp-content/themes/fbthailand/images/doll1.png" class="doll" data-aos="zoom-in"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="200"/> </div>
  </section>
  <?php $sectionseven = get_post_meta( get_the_ID(), 'sectionseven', true ); ?>
  <section class="ourpartner pad80 mb80 bggrayl">
    <div class="container mxwidth center"  data-aos="fade-up"
     data-aos-offset="200" data-aos-easing="ease-in-sine">
      <h3 class="blue font24 opt-md center mb60 text-uppercase">
        <?php if ( ! empty( $sectionseven['title'] ) ): ?>
        <?php echo wp_kses_post( $sectionseven['title'] ); ?>
        <?php endif; ?>
      </h3>
      <div class="belowpartnerarea">
        <?php foreach ( $sectionseven['add_Posts1']  as $whats ) :
         $secthimage1 = wp_get_attachment_url($whats['image']);
          ?>
        <?php if($secthimage1  !=  ''){ ?>
        <div class="ourpplogorow"> <a href='<?php  echo $whats['link']; ?>'><img src="<?php echo $secthimage1;?>" class=""/> </a> </div>
        <?php  } ?>
        <?php endforeach;  ?>
      </div>
    </div>
  </section>
  <?php
get_footer();