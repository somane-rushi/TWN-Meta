<?php
/**
 * The template for displaying stories archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shemb
 */

get_header();
?>
<?php $fields = get_option( "archive_stories", array() ); ?>
<?php if ( ! empty( $fields['description'] ) ): ?>
<section class="top-area greenback">
	<div class="container">
		<div class="col-lg-12">
			<p class="top-para">
            	<?php echo wp_kses( $fields['description'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'class' => array() ) ); ?>
            </p>
		</div>
	</div>
</section>
<?php endif; ?>
<section id="tabs">
	<div class="container">
		<div class="row">
			<div class="col-12 ">
            	<?php $mcountry = story_country('0'); 
					if ( ! empty( $mcountry ) ): ?>
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                <?php foreach ( $mcountry as $cou ) { ?>
                                <a class="nav-item nav-link" id="nav-<?php echo $cou->slug; ?>-tab" data-toggle="tab" href="#<?php echo $cou->slug; ?>" role="tab" aria-controls="<?php echo $cou->slug; ?>" aria-selected="false"><?php echo $cou->name; ?></a>
                                <?php } ?>
                            </div>
                        </nav>
                <?php endif; ?>
                
                <div class="divder"></div>
                
                <?php $mcountrytab = story_country('0'); 
					if ( ! empty( $mcountrytab ) ):
				?>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    	<?php $i=1; foreach ( $mcountrytab as $mtab ) { ?>
                        <div class="tab-pane fade <?php if($i===1){ echo 'show active'; } ?>" id="nav-<?php echo wp_kses_post($mtab->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo wp_kses_post($mtab->slug); ?>-tab">
                        
                        	<div class="row valign ">
                            	<?php 
									$tabcontent = getstory_post($mtab->slug);
                                    if ( $tabcontent->have_posts() ) {
										$t=1;
										while ( $tabcontent->have_posts() ): $tabcontent->the_post();
										$story = get_post_meta( get_the_ID(), 'story', true);
										$storyimg = wp_get_attachment_url($story['simage']);
										if($t==1){
									?>
                            
                                        <div class="col-2 col-lg-2 col pad5"> <img class="con-flag" src="https://shemeansbusinessfb.com/wp-content/uploads/2021/03/VietnamFlag-1.png"/> <?php echo $mtab->slug; ?> </div>
                                    <?php } else { ?>
                                        <div class="col-2 col-sm-2 pad5">
                                            <div data-id="storyAP31" class="storyA">
                                                <div class="flip-card">
                                                    <div class="flip-card-inner">
                                                        <div class="flip-card-front">
                                                            <div class="storyBox">
                                                                <div><?php echo wp_kses_post(the_title()); ?></div>
                                                                <img src="<?php echo esc_url( $storyimg ); ?>">
                                                                <div><?php echo wp_kses_post($story['sbusiness']); ?><br>&nbsp;<br>&nbsp;</div>
                                                                <div>Read More</div>
                                                            </div>
                                                        </div>
                                                        <div class="flip-card-back" data-toggle="modal" data-target="#exampleModalLong">
                                                            <div class="contentWrapper">
                                                                <p>
                                                                	<?php echo wp_kses( $story['sdescription'], array(
																		'br' => array( 'class' => array() ),
																		'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                        												'strong' => array(),
																		'style' => array(),
																	) ); ?>
                                                                <br><br>
                                                                <span style="font-size:12px;">Click for detailed story</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- col-sm-2 -->
                                        <?php } $t++; endwhile; wp_reset_postdata(); ?>
                            		<?php } ?>
                            </div> <!-- row -->
                        
                        </div>
                        <?php } ?>
                        
                       <?php /*?> <?php foreach ( $mcountrytab as $mtab ) { ?>
                            <div class="tab-pane fade" id="<?php echo $mtab->slug; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $mtab->slug; ?>-tab">
                            	<?php $subcoun = story_country($mtab->term_id);
									if ( ! empty( $subcoun ) ) { ?>
                                    	<nav>
                  							<div class="nav nav-tabs nav-fill subnav" id="nav-tab" role="tablist">
                                            	<a class="nav-item nav-link active" id="nav-all-asiapacific-tab" data-toggle="tab" href="#all-asiapacific" role="tab" aria-controls="nav-home" aria-selected="true">All</a> 
                                                <?php foreach ( $subcoun as $scou ) { ?>
                                                	<a class="nav-item nav-link" id="nav-<?php echo $scou->slug; ?>-tab" data-toggle="tab" href="#<?php echo $scou->slug; ?>" role="tab" aria-controls="<?php echo $scou->slug; ?>" aria-selected="false"><?php echo $scou->name; ?></a>
                                                <?php } ?>
                                            </div>
                                        </nav>
								<?php } ?>
                                    
                            	<?php echo $mtab->name; ?>
                            </div>
                        <?php } ?><?php */?>
                    </div>
                <?php endif; ?>
                
                
                
                
                
			</div> <!-- 12 -->
		</div>
	</div>
</section>
                
                
                
                

<?php /*?><section id="tabs">
  <div class="container">
    <div class="row">
      <div class="col-12 ">
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist"> <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a> <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Asia Pacific</a> <a class="nav-item nav-link" id="nav-europe-tab" data-toggle="tab" href="#europe" role="tab" aria-controls="nav-contact" aria-selected="false">Europe</a> <a class="nav-item nav-link" id="nav-lamerica-tab" data-toggle="tab" href="#letin-america" role="tab" aria-controls="nav-about" aria-selected="false">Letin America</a> <a class="nav-item nav-link" id="nav-africa-tab" data-toggle="tab" href="#africa" role="tab" aria-controls="africa" aria-selected="false">Sub Saharan Africa</a> </div>
        </nav>
        <div class="divder"></div>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row valign ">
              <div class="col-2 pad5"> <img class="con-flag" src="images/VietnamFlag-1.png"/> </div>
              <div class="col-2 pad5">
                <div data-id="storyAP31" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Nguyễn Thu Hồng</div>
                          <img src="images/Nguyen-Thu-Hong-Cha-Ca-Hong_1x1.jpg">
                          <div>Chả Cá Hồng<br>
                            &nbsp;<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back" data-toggle="modal" data-target="#exampleModalLong">
                        <div class="contentWrapper">
                          <p>Leveraged local specialties to start her fish cake business<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body text-center pad-0">
                          <div class="col-12 main0">
                            <h1>Building a fish cake business with inspiration and technique</h1>
                            <h2>Nguyễn Thu Hồng</br>
                              Khánh Hòa, Vietnam</h2>
                          </div>
                          <div class="main1">
                            <div class="col-8 col-12 img-main pad-0"> <img src="images/m1.png" /> </div>
                            <div class="col-4 col-12  head1">
                              <h2>She wanted to introduce a <br />
                                healthy and safe fish </br>
                                paste solution to the </br>
                                Vietnamese market.</h2>
                            </div>
                          </div>
                          <div class="col-lg-12 para1">
                            <p>My name is Nguyễn Thu Hồng. I founded Chả Cá Hồng in 2018 in Vietnam. I am from Nha Trang, a seaside city in Southern Central Vietnam. While I was pursuing a research career in Japan, I discovered the health benefits of fish paste and the high hygienic standards used in Japan. I decided to return to my seaside hometown and start a fish cake production business that would apply these principles in Vietnam. I have always believed that when people eat nutritious food, the nation becomes more prosperous. I wanted to leverage the large reserve of seafood in my hometown and pin it on the Vietnamese food map. I frequently traveled to Japan for research and to learn the technique prior to starting my business. </p>
                          </div>
                          <div class="main2">
                            <div class="col-sm-4 col-12 head1">
                              <h2>Social Media Marketing <br />
                                helped her achieve a wider </br>
                                reach.</h2>
                            </div>
                            <div class="col-sm-8 col-12  img-main pad-0"> <img src="images/m2.png" /> </div>
                          </div>
                          <div class="col-lg-12 para1">
                            <p>Facebook’s “zero dollar” market testing tool helped me pilot my products in the early days. Ever since, I’ve used Facebook to promote my products to a larger audience. During the COVID-19 pandemic, I was able to easily sell my products online. Regular Facebook Live sessions also helped boost my sales greatly.</p>
                          </div>
                          <div class="main3">
                            <div class="col-sm-8 col-12  img-main pad-0"> <img src="images/m3.png" /> </div>
                            <div class="col-sm-4 col-12  head1">
                              <h2>Online sales kept her <br />
                                business going during the </br>
                                COVID 19 pandemic.</h2>
                            </div>
                          </div>
                          <div class="col-lg-12 para1">
                            <p>My business’s online presence enabled me to retain my employees over the difficult period of the COVID-19 pandemic while continuing to upskill them with digital marketing skills on Facebook. My aim is to further expand our reach online and inspire other businesses in Vietnam to promote local specialties. </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP32" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Nguyễn Hoàng Điệp </div>
                          <img src="images/Nguyen-Hoang-Diep-O-Kia-Ha-Noi-Teahouse_1x1.jpg">
                          <div>Ơ Kìa Hà Nội<br>
                            Film Production and<br>
                            Creative Hub</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Created a platform to showcase the independent arts of her city<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP33" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Trần Thanh Huyền</div>
                          <img src="images/Tran-Thanh-Huyen-True-Juice_1x1.jpg">
                          <div>True Juice<br>
                            &nbsp;<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Helped people lead a healthy lifestyle with her juice business<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP34" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Lương Thanh Hạnh</div>
                          <img src="images/Luong-Thanh-Hanh-Hanh-Silk_1x1.jpg">
                          <div>HanhSilk<br>
                            &nbsp;<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Set up a business to revive the silk industry<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP35" class="storyE">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Ngô Thị Hoài </div>
                          <img src="images/Ngo-Thi-Hoai-WeCreate-Vietnam_1x1.jpg">
                          <div>WeCreate Vietnam<br>
                            &nbsp;<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Helped women realise their entrepreneurial dreams<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign ">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/PhilippinesFlag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP21" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Catherine V.<br>
                            Taleon</div>
                          <img src="images/Cathrine_Balai-Tablea.jpg">
                          <div>Balai Tablea<br>
                            &nbsp;<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Produced high quality chocolate with local produce<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP22" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Michelle Marjorie Con Pablico-Zabanal </div>
                          <img src="images/Michelle.jpg">
                          <div>Sweet Memories –<br>
                            Invitations and<br>
                            Souvenirs</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Built a successful business with her handcrafted creations<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP23" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Marian<br>
                            Tuazon</div>
                          <img src="images/Marian-Tuazon-Hurnohan-Handcrafted-Pastries.jpg">
                          <div>Hurnohan Handcrafted<br>
                            Pastries<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Turned her love for baking into a successful business<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP24" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Jocyl<br>
                            Gobres-Militar</div>
                          <img src="images/Jocyl-Gobres-Militar_Chorizo.jpg">
                          <div>Jocyl’s Foods Chorizo<br>
                            de Kalibo<br>
                            &nbsp; </div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>A Chorizo business that stood the test of time<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP25" class="storyE">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Katrina<br>
                            Cortez</div>
                          <img src="images/Katrina-Cortez-Katrins-Kaong-Nata-de-Coco.jpg">
                          <div>Katrins Kaong &amp;<br>
                            Nata de Coco<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Her family owned business scale greater heights<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign ">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/IndiaFlag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP10" class="storyE">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Tamanna Dhamija<br>
                            &nbsp;</div>
                          <img src="images/Story-Face-Card-Images_India_0000s_0005_Tamanna.jpg">
                          <div>Baby Destination</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Shared parenting content which answered questions that mothers had<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP9" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Pabiben Rabari<br>
                            &nbsp;</div>
                          <img src="images/Story-Face-Card-Images_India_0000s_0004_Pabiben-Rabari.jpg">
                          <div>Pabiben&nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used online tools to give her modest business a wider audience<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP8" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Shashi Bagchi<br>
                            &nbsp;</div>
                          <img src="images/Story-Face-Card-Images_India_0000s_0003_Shashi-Bagchi-2.jpg">
                          <div>Maati</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used online tools to revive a dying art form<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP7" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Nirmala Sainath<br>
                            Habka</div>
                          <img src="images/Story-Face-Card-Images_India_0000s_0001_Nirmala-Habka.jpg">
                          <div>Devrai Art School</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Sold hand-crafted bags to fund her visually-impaired children’s education<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP6" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Parvesh<br>
                            &nbsp;</div>
                          <img src="images/Story-Face-Card-Images_India_0000s_0000_Parvesh-Indha.jpg">
                          <div>Indha</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Grew her business and gave her children access to quality education<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/PakistanFlag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP20" class="storyE">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Sher Bano</div>
                          <img src="images/SherBano_Face-card-image.jpeg">
                          <div>Sherry’s Stitching</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Relied on ecommerce to increase sales at her women-run fashion boutique<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP19" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Nida Jaffery </div>
                          <img src="images/Nida-Jaffery-1X1.jpg">
                          <div>Nashtay Walay</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Delivered traditional breakfast to customers despite facing odds<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP18" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Saira Jahan</div>
                          <img src="images/Saira-Jahan-1X1.jpg">
                          <div>Moksha Resort</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Practised digital marketing strategies to help business during the COVID-19 pandemic<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP17" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Bushra Shahid</div>
                          <img src="images/Bushra-Shahid-1X1.jpg">
                          <div>BeesCraftland</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Learnt to tailor her posts in a way that helped her reach a wider audience<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP16" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Nadia Qamar Ali</div>
                          <img src="images/Nadia-Quamar-Ali-1X1.jpg">
                          <div>Ajia Collections</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Grew her clothing line by teaching herself to use social media for business<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/Taiwan-Flag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP26" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Mandy Huang</div>
                          <img src="images/Mandy-Huang-Choice.jpg">
                          <div>Choice<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Taking her baking business online to survive the COVID-19 pandemic<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP27" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Candace Chen</div>
                          <img src="images/Candace-Chen-Fluv.jpg">
                          <div>Fluv<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Created an app to bring the community’s animal lovers together to help animals feel cared for<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP28" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Jie Ying Huang</div>
                          <img src="images/Jie-Ying-Huang-Golden-Flower-Tea-Oil.jpg">
                          <div>Golden Flower<br>
                            Tea Oil</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Bringing her oil products to more and more kitchens<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP29" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Viola Cheng</div>
                          <img src="images/Viola-Cheng-Good-Food-Enterprise.jpg">
                          <div>Good Food<br>
                            Enterprise</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Founded a restaurant with a business model based on social welfare<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5"> </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/IndonesiaFlag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP11" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Anastasya<br>
                            Citra</div>
                          <img src="images/Anastasya-Citra-1X1.jpg">
                          <div>TACI Design</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Married design and business to build successful companies<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP12" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Dian<br>
                            Jimmy</div>
                          <img src="images/Dian-Jimmy-1X1.jpg">
                          <div>Kios Kaos Kupang</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Made t-shirts to celebrate her culture and increase tourism in the region<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP13" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Meybi Agnesya<br>
                            Lomanledo</div>
                          <img src="images/Meybi-Agnesya-Lomanledo-1X1.jpg">
                          <div>Timor Moringa</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Turned to online business to help give local farmers due credit<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5"> </div>
              <div class="col-sm-2 pad5"> </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/HongKongFlag-01.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP1" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Cinci Leung</div>
                          <img src="images/Cinci-Leung-1X1.jpg">
                          <div>CheckCheckCin</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Made her preventive healthcare products easily accessible to the community through digital platforms<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP2" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Vriko Kwok</div>
                          <img src="images/Vriko-1X1.jpg">
                          <div>Herbs’Oil</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Revolutionized skincare for sensitive skin by using powerful Hawaiian botanicals in her products<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/LATAM-Region.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="story5" class="storyE">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Mary Silvia<br>
                            Marin Pineda</div>
                          <img src="images/La-Teca-De-Oro-1X1.jpg">
                          <div>La Teca<br>
                            de Oro</div>
                          <div>Mexico</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Preserving local Oaxacan textiles through her embroidery business<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story4" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Jazmin<br>
                            Sandoval</div>
                          <img src="images/Jazmin-Sandoval-1X1.jpg">
                          <div>All You Need<br>
                            is Lunch</div>
                          <div>Mexico</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used local products to curate eco friendly meal experiences<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story3" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Emma Eugenia<br>
                            Mesa Arias</div>
                          <img src="images/Emma-Eugenia-Mesa-Arias-1X1.jpg">
                          <div>Maquiempanadas<br>
                            &nbsp;</div>
                          <div>Colombia </div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Designed a machine to make Colombian Empanadas<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story2" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Agustina<br>
                            Tavella</div>
                          <img src="images/Agustina-Tavella-1X1.jpg">
                          <div>EnOrden<br>
                            &nbsp;</div>
                          <div>Argentina</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Built a brand offering cost effective organising solutions<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story1" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Agnes<br>
                            Martins</div>
                          <img src="images/Agnes-Martins-1X1.jpg">
                          <div>AgnesRasta Bolsas<br>
                            e Acessórios</div>
                          <div>Brazil</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used online selling to popularise her handmade creations<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story61" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Manuela<br>
                            Iribarren</div>
                          <img src="images/Manuela-Iribarren-1X1.jpg">
                          <div>By Maria<br>
                            &nbsp;</div>
                          <div>Chile</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used fresh and local ingredients to make her gourmet products<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story62" class="storyB ">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Iris Ferreira<br>
                            Leite</div>
                          <img src="images/Iris-Ferreira-Leite-1X1.png">
                          <div>Quintal<br>
                            Paraense</div>
                          <div>Brazil</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Started a cafe business from her own backyard<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyFausta" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Mila Huamán<br>
                            &nbsp;</div>
                          <img src="images/Mila-Huaman-1X1.png">
                          <div>Fausta<br>
                            &nbsp;</div>
                          <div>Peru</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Founded a restaurant serving traditional Peruvian snacks<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyComeS" class="storyD ">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Carol and<br>
                            Camilla</div>
                          <img src="images/Carol-and-Camilla-1X1.png">
                          <div>ComeS<br>
                            &nbsp;</div>
                          <div>Chile</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Empowered local producers through their online organic store<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/NIGERIAFlag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP51" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Janet<br>
                            Falola</div>
                          <img src="images/Janet-Falola-Ankara-for-Shakara.jpg">
                          <div>Ankara for<br>
                            Shakara</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Garnering international attention to her fabric business through digital platforms<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP52" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Oluwunmi<br>
                            Funbi-Olufeko</div>
                          <img src="images/Oluwunmi-Funbi-Olufeko-DFL-Clutch-Bags.jpg">
                          <div>DFL Clutch<br>
                            Bags</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Finding international buyers for her chic apparel made out of African prints<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP53" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Saudat<br>
                            Salami</div>
                          <img src="images/Saudat-Salami-Easyshop-Easycook.jpg">
                          <div>Easyshop<br>
                            Easycook</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Making household shopping easier for working women by setting up an online grocery store<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP54" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Tosin<br>
                            Oshinowo</div>
                          <img src="images/Tosin-Oshinowo-House-of-Lines-IIe-IIa.jpg">
                          <div>House of<br>
                            Lines (Ile-Ila)</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Bringing global recognition to her craftsmanship through digital advertising<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAP55" class="storyE">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Emem-Obong<br>
                            &nbsp;</div>
                          <img src="images/Emem-Obong-Mfrima-Bakes.jpg">
                          <div>Mfrima<br>
                            Bakes</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Earning revenue during the pandemic by selling her home-baked goods online<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/SenegalFlag-2.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs1" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Mariane<br>
                            Quattara</div>
                          <img src="images/Farifima-Cosmetique_Marianne.jpg">
                          <div>FariFima<br>
                            Cosmétique</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Made natural and inclusive skin care products for people of colour<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs2" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Thérèse Mayé<br>
                            Diouf Ba</div>
                          <img src="images/Therese-Maye-Diouf-Ba-Growing-Life-Farm.jpg">
                          <div>Growing Life<br>
                            Farm</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Freed underprivileged women from exploitation by giving them an alternative<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs3" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Siny<br>
                            Samba</div>
                          <img src="images/Siny-Samba-Le-Lionceau.jpg">
                          <div>Le Lionceau<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Helped local farmers with her passion for infant nutrition<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs4" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Fatima Sarr<br>
                            Mbow </div>
                          <img src="images/Fatima-Sarr-Mbow-Mosasane.jpg">
                          <div>Mossane<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Employed influencer marketing to bring foreign products to local women<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/SouthAfricaFlag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs6" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Zelna Naude</div>
                          <img src="images/Zelna-Naude-Avrio-Kursusse.jpg">
                          <div>Avrio Kursusse<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Her training services business makes people job ready<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs7" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Margaret Chandia</div>
                          <img src="images/Margaret-Chandia-Tru-Beauty-Africa.jpg">
                          <div>Tru Beauty<br>
                            Africa </div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Built an all natural brand offering unique skin solutions<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs8" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Jackie Owgan </div>
                          <img src="images/Jackie-Owgan-Image-Cartel-Nail-Academy.jpg">
                          <div>Image Cartel<br>
                            Nail Academy</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Partnered with her son to build a multi-city business<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs9" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Tamburai Chirume</div>
                          <img src="images/Story-Face-Card-Image_Tamburai_OneOfEach.png">
                          <div>ONEOFEACH<br>
                            &nbsp;</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Built a luxury product brand from Africa<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyAPs10" class="storyE">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Mosebjadi Seshoene </div>
                          <img src="images/Mogau-Mosebjadi-Seshoene-The-Lazy-Makoti.jpg">
                          <div>The Lazy<br>
                            Makoti </div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Started cooking classes to popularise South African cuisine<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/UK-image-flag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK5" class="story5AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Helen Pritchett and<br>
                            Georgia Pattison</div>
                          <img src="images/Georgia-Pattison-1X1.png">
                          <div>The Soap Sisters</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Set up a flourishing business of handmade soaps<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK4" class="story4AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Anita<br>
                            Mattson-Hesketh</div>
                          <img src="images/Anita-Mattson-Hesketh-1X1.png">
                          <div>Lush Blooms</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Turned her floristry hobby into a full-time venture<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK3" class="story3AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Nasira<br>
                            Kasmani</div>
                          <img src="images/Nasira-Kasmani-1X1.png">
                          <div>Jewellery by Nasira</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Followed her passion for  jewellery to create a successful brand<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK2" class="story2AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Bami<br>
                            Kuteyi</div>
                          <img src="images/Bami-Kuteyi-1X1.png">
                          <div>Bam Bam Boogie</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Started a fun and sociable fitness craze with her Afro-Caribbean dance classes<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK1" class="story1AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Rachael Corson and Joycelyn Mate</div>
                          <img src="images/Rachael-Corson-and-Joycelyn-Mate-1X1.png">
                          <div>Afrocenchi</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used natural ingredients to build an Afro hair care brand<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row">
              <div class="col-12 ">
                <nav>
                  <div class="nav nav-tabs nav-fill subnav" id="nav-tab" role="tablist"> <a class="nav-item nav-link active" id="nav-all-asiapacific-tab" data-toggle="tab" href="#all-asiapacific" role="tab" aria-controls="nav-home" aria-selected="true">All</a> <a class="nav-item nav-link" id="nav-hongkong-tab" data-toggle="tab" href="#hongkong" role="tab" aria-controls="nav-profile" aria-selected="false">HongKong</a> <a class="nav-item nav-link" id="nav-india-tab" data-toggle="tab" href="#india" role="tab" aria-controls="nav-contact" aria-selected="false">India</a> <a class="nav-item nav-link" id="nav-indonesia-tab" data-toggle="tab" href="#indonesia" role="tab" aria-controls="nav-about" aria-selected="false">Indonesia</a> <a class="nav-item nav-link" id="nav-pakistan-tab" data-toggle="tab" href="#pakistan" role="tab" aria-controls="pakistan" aria-selected="false"> Pakistan</a> <a class="nav-item nav-link" id="nav-philippines-tab" data-toggle="tab" href="#philippines" role="tab" aria-controls="philippines" aria-selected="false"> PHILIPPINES</a> <a class="nav-item nav-link" id="nav-taiwan-tab" data-toggle="tab" href="#taiwan" role="tab" aria-controls="taiwan" aria-selected="false">Taiwan</a> <a class="nav-item nav-link" id="nav-vietnam-tab" data-toggle="tab" href="#vietnam" role="tab" aria-controls="vietnam" aria-selected="false"> Vietnam</a> </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-subtabContent">
                  <div class="tab-pane fade show active" id="all-asiapacific" role="tabpanel" aria-labelledby="nav-all-asiapacific-tab">
                    <div class="row valign ">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/VietnamFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP31" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nguyễn Thu Hồng</div>
                                  <img src="images/Nguyen-Thu-Hong-Cha-Ca-Hong_1x1.jpg">
                                  <div>Chả Cá Hồng<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Leveraged local specialties to start her fish cake business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP32" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nguyễn Hoàng Điệp </div>
                                  <img src="images/Nguyen-Hoang-Diep-O-Kia-Ha-Noi-Teahouse_1x1.jpg">
                                  <div>Ơ Kìa Hà Nội<br>
                                    Film Production and<br>
                                    Creative Hub</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Created a platform to showcase the independent arts of her city<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP33" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Trần Thanh Huyền</div>
                                  <img src="images/Tran-Thanh-Huyen-True-Juice_1x1.jpg">
                                  <div>True Juice<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Helped people lead a healthy lifestyle with her juice business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP34" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Lương Thanh Hạnh</div>
                                  <img src="images/Luong-Thanh-Hanh-Hanh-Silk_1x1.jpg">
                                  <div>HanhSilk<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Set up a business to revive the silk industry<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP35" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Ngô Thị Hoài </div>
                                  <img src="images/Ngo-Thi-Hoai-WeCreate-Vietnam_1x1.jpg">
                                  <div>WeCreate Vietnam<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Helped women realise their entrepreneurial dreams<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row valign ">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/PhilippinesFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP21" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Catherine V.<br>
                                    Taleon</div>
                                  <img src="images/Cathrine_Balai-Tablea.jpg">
                                  <div>Balai Tablea<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Produced high quality chocolate with local produce<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP22" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Michelle Marjorie Con Pablico-Zabanal </div>
                                  <img src="images/Michelle.jpg">
                                  <div>Sweet Memories –<br>
                                    Invitations and<br>
                                    Souvenirs</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Built a successful business with her handcrafted creations<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP23" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Marian<br>
                                    Tuazon</div>
                                  <img src="images/Marian-Tuazon-Hurnohan-Handcrafted-Pastries.jpg">
                                  <div>Hurnohan Handcrafted<br>
                                    Pastries<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Turned her love for baking into a successful business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP24" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Jocyl<br>
                                    Gobres-Militar</div>
                                  <img src="images/Jocyl-Gobres-Militar_Chorizo.jpg">
                                  <div>Jocyl’s Foods Chorizo<br>
                                    de Kalibo<br>
                                    &nbsp; </div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>A Chorizo business that stood the test of time<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP25" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Katrina<br>
                                    Cortez</div>
                                  <img src="images/Katrina-Cortez-Katrins-Kaong-Nata-de-Coco.jpg">
                                  <div>Katrins Kaong &amp;<br>
                                    Nata de Coco<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Her family owned business scale greater heights<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row valign ">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/IndiaFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP10" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Tamanna Dhamija<br>
                                    &nbsp;</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0005_Tamanna.jpg">
                                  <div>Baby Destination</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Shared parenting content which answered questions that mothers had<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP9" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Pabiben Rabari<br>
                                    &nbsp;</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0004_Pabiben-Rabari.jpg">
                                  <div>Pabiben&nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Used online tools to give her modest business a wider audience<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP8" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Shashi Bagchi<br>
                                    &nbsp;</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0003_Shashi-Bagchi-2.jpg">
                                  <div>Maati</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Used online tools to revive a dying art form<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP7" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nirmala Sainath<br>
                                    Habka</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0001_Nirmala-Habka.jpg">
                                  <div>Devrai Art School</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Sold hand-crafted bags to fund her visually-impaired children’s education<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP6" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Parvesh<br>
                                    &nbsp;</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0000_Parvesh-Indha.jpg">
                                  <div>Indha</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Grew her business and gave her children access to quality education<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/PakistanFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP20" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Sher Bano</div>
                                  <img src="images/SherBano_Face-card-image.jpeg">
                                  <div>Sherry’s Stitching</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Relied on ecommerce to increase sales at her women-run fashion boutique<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP19" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nida Jaffery </div>
                                  <img src="images/Nida-Jaffery-1X1.jpg">
                                  <div>Nashtay Walay</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Delivered traditional breakfast to customers despite facing odds<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP18" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Saira Jahan</div>
                                  <img src="images/Saira-Jahan-1X1.jpg">
                                  <div>Moksha Resort</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Practised digital marketing strategies to help business during the COVID-19 pandemic<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP17" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Bushra Shahid</div>
                                  <img src="images/Bushra-Shahid-1X1.jpg">
                                  <div>BeesCraftland</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Learnt to tailor her posts in a way that helped her reach a wider audience<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP16" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nadia Qamar Ali</div>
                                  <img src="images/Nadia-Quamar-Ali-1X1.jpg">
                                  <div>Ajia Collections</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Grew her clothing line by teaching herself to use social media for business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/Taiwan-Flag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP26" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Mandy Huang</div>
                                  <img src="images/Mandy-Huang-Choice.jpg">
                                  <div>Choice<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Taking her baking business online to survive the COVID-19 pandemic<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP27" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Candace Chen</div>
                                  <img src="images/Candace-Chen-Fluv.jpg">
                                  <div>Fluv<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Created an app to bring the community’s animal lovers together to help animals feel cared for<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP28" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Jie Ying Huang</div>
                                  <img src="images/Jie-Ying-Huang-Golden-Flower-Tea-Oil.jpg">
                                  <div>Golden Flower<br>
                                    Tea Oil</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Bringing her oil products to more and more kitchens<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP29" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Viola Cheng</div>
                                  <img src="images/Viola-Cheng-Good-Food-Enterprise.jpg">
                                  <div>Good Food<br>
                                    Enterprise</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Founded a restaurant with a business model based on social welfare<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5"> </div>
                    </div>
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/IndonesiaFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP11" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Anastasya<br>
                                    Citra</div>
                                  <img src="images/Anastasya-Citra-1X1.jpg">
                                  <div>TACI Design</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Married design and business to build successful companies<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP12" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Dian<br>
                                    Jimmy</div>
                                  <img src="images/Dian-Jimmy-1X1.jpg">
                                  <div>Kios Kaos Kupang</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Made t-shirts to celebrate her culture and increase tourism in the region<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP13" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Meybi Agnesya<br>
                                    Lomanledo</div>
                                  <img src="images/Meybi-Agnesya-Lomanledo-1X1.jpg">
                                  <div>Timor Moringa</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Turned to online business to help give local farmers due credit<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5"> </div>
                      <div class="col-sm-2 pad5"> </div>
                    </div>
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/HongKongFlag-01.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP1" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Cinci Leung</div>
                                  <img src="images/Cinci-Leung-1X1.jpg">
                                  <div>CheckCheckCin</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Made her preventive healthcare products easily accessible to the community through digital platforms<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP2" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Vriko Kwok</div>
                                  <img src="images/Vriko-1X1.jpg">
                                  <div>Herbs’Oil</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Revolutionized skincare for sensitive skin by using powerful Hawaiian botanicals in her products<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="hongkong" role="tabpanel" aria-labelledby="nav-hongkong-tab">
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/HongKongFlag-01.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP1" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Cinci Leung</div>
                                  <img src="images/Cinci-Leung-1X1.jpg">
                                  <div>CheckCheckCin</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Made her preventive healthcare products easily accessible to the community through digital platforms<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP2" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Vriko Kwok</div>
                                  <img src="images/Vriko-1X1.jpg">
                                  <div>Herbs’Oil</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Revolutionized skincare for sensitive skin by using powerful Hawaiian botanicals in her products<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="india" role="tabpanel" aria-labelledby="nav-india-tab">
                    <div class="row valign ">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/IndiaFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP10" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Tamanna Dhamija<br>
                                    &nbsp;</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0005_Tamanna.jpg">
                                  <div>Baby Destination</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Shared parenting content which answered questions that mothers had<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP9" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Pabiben Rabari<br>
                                    &nbsp;</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0004_Pabiben-Rabari.jpg">
                                  <div>Pabiben&nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Used online tools to give her modest business a wider audience<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP8" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Shashi Bagchi<br>
                                    &nbsp;</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0003_Shashi-Bagchi-2.jpg">
                                  <div>Maati</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Used online tools to revive a dying art form<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP7" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nirmala Sainath<br>
                                    Habka</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0001_Nirmala-Habka.jpg">
                                  <div>Devrai Art School</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Sold hand-crafted bags to fund her visually-impaired children’s education<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP6" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Parvesh<br>
                                    &nbsp;</div>
                                  <img src="images/Story-Face-Card-Images_India_0000s_0000_Parvesh-Indha.jpg">
                                  <div>Indha</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Grew her business and gave her children access to quality education<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="indonesia" role="tabpanel" aria-labelledby="nav-indonesia-tab">
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/IndonesiaFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP11" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Anastasya<br>
                                    Citra</div>
                                  <img src="images/Anastasya-Citra-1X1.jpg">
                                  <div>TACI Design</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Married design and business to build successful companies<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP12" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Dian<br>
                                    Jimmy</div>
                                  <img src="images/Dian-Jimmy-1X1.jpg">
                                  <div>Kios Kaos Kupang</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Made t-shirts to celebrate her culture and increase tourism in the region<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP13" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Meybi Agnesya<br>
                                    Lomanledo</div>
                                  <img src="images/Meybi-Agnesya-Lomanledo-1X1.jpg">
                                  <div>Timor Moringa</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Turned to online business to help give local farmers due credit<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5"> </div>
                      <div class="col-sm-2 pad5"> </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="pakistan" role="tabpanel" aria-labelledby="nav-pakistan-tab">
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/PakistanFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP20" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Sher Bano</div>
                                  <img src="images/SherBano_Face-card-image.jpeg">
                                  <div>Sherry’s Stitching</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Relied on ecommerce to increase sales at her women-run fashion boutique<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP19" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nida Jaffery </div>
                                  <img src="images/Nida-Jaffery-1X1.jpg">
                                  <div>Nashtay Walay</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Delivered traditional breakfast to customers despite facing odds<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP18" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Saira Jahan</div>
                                  <img src="images/Saira-Jahan-1X1.jpg">
                                  <div>Moksha Resort</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Practised digital marketing strategies to help business during the COVID-19 pandemic<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP17" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Bushra Shahid</div>
                                  <img src="images/Bushra-Shahid-1X1.jpg">
                                  <div>BeesCraftland</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Learnt to tailor her posts in a way that helped her reach a wider audience<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP16" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nadia Qamar Ali</div>
                                  <img src="images/Nadia-Quamar-Ali-1X1.jpg">
                                  <div>Ajia Collections</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Grew her clothing line by teaching herself to use social media for business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="philippines" role="tabpanel" aria-labelledby="nav-philippines-tab">
                    <div class="row valign ">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/PhilippinesFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP21" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Catherine V.<br>
                                    Taleon</div>
                                  <img src="images/Cathrine_Balai-Tablea.jpg">
                                  <div>Balai Tablea<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Produced high quality chocolate with local produce<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP22" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Michelle Marjorie Con Pablico-Zabanal </div>
                                  <img src="images/Michelle.jpg">
                                  <div>Sweet Memories –<br>
                                    Invitations and<br>
                                    Souvenirs</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Built a successful business with her handcrafted creations<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP23" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Marian<br>
                                    Tuazon</div>
                                  <img src="images/Marian-Tuazon-Hurnohan-Handcrafted-Pastries.jpg">
                                  <div>Hurnohan Handcrafted<br>
                                    Pastries<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Turned her love for baking into a successful business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP24" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Jocyl<br>
                                    Gobres-Militar</div>
                                  <img src="images/Jocyl-Gobres-Militar_Chorizo.jpg">
                                  <div>Jocyl’s Foods Chorizo<br>
                                    de Kalibo<br>
                                    &nbsp; </div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>A Chorizo business that stood the test of time<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP25" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Katrina<br>
                                    Cortez</div>
                                  <img src="images/Katrina-Cortez-Katrins-Kaong-Nata-de-Coco.jpg">
                                  <div>Katrins Kaong &amp;<br>
                                    Nata de Coco<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Her family owned business scale greater heights<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="taiwan" role="tabpanel" aria-labelledby="nav-taiwan-tab">
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/Taiwan-Flag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP26" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Mandy Huang</div>
                                  <img src="images/Mandy-Huang-Choice.jpg">
                                  <div>Choice<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Taking her baking business online to survive the COVID-19 pandemic<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP27" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Candace Chen</div>
                                  <img src="images/Candace-Chen-Fluv.jpg">
                                  <div>Fluv<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Created an app to bring the community’s animal lovers together to help animals feel cared for<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP28" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Jie Ying Huang</div>
                                  <img src="images/Jie-Ying-Huang-Golden-Flower-Tea-Oil.jpg">
                                  <div>Golden Flower<br>
                                    Tea Oil</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Bringing her oil products to more and more kitchens<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP29" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Viola Cheng</div>
                                  <img src="images/Viola-Cheng-Good-Food-Enterprise.jpg">
                                  <div>Good Food<br>
                                    Enterprise</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Founded a restaurant with a business model based on social welfare<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5"> </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="vietnam" role="tabpanel" aria-labelledby="nav-vietnam-tab">
                    <div class="row valign ">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/VietnamFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP31" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nguyễn Thu Hồng</div>
                                  <img src="images/Nguyen-Thu-Hong-Cha-Ca-Hong_1x1.jpg">
                                  <div>Chả Cá Hồng<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Leveraged local specialties to start her fish cake business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP32" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Nguyễn Hoàng Điệp </div>
                                  <img src="images/Nguyen-Hoang-Diep-O-Kia-Ha-Noi-Teahouse_1x1.jpg">
                                  <div>Ơ Kìa Hà Nội<br>
                                    Film Production and<br>
                                    Creative Hub</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Created a platform to showcase the independent arts of her city<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP33" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Trần Thanh Huyền</div>
                                  <img src="images/Tran-Thanh-Huyen-True-Juice_1x1.jpg">
                                  <div>True Juice<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Helped people lead a healthy lifestyle with her juice business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP34" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Lương Thanh Hạnh</div>
                                  <img src="images/Luong-Thanh-Hanh-Hanh-Silk_1x1.jpg">
                                  <div>HanhSilk<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Set up a business to revive the silk industry<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP35" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Ngô Thị Hoài </div>
                                  <img src="images/Ngo-Thi-Hoai-WeCreate-Vietnam_1x1.jpg">
                                  <div>WeCreate Vietnam<br>
                                    &nbsp;<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Helped women realise their entrepreneurial dreams<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
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
            </div>
          </div>
          <div class="tab-pane fade" id="europe" role="tabpanel" aria-labelledby="nav-europe-tab">
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/UK-image-flag-1.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK5" class="story5AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Helen Pritchett and<br>
                            Georgia Pattison</div>
                          <img src="images/Georgia-Pattison-1X1.png">
                          <div>The Soap Sisters</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Set up a flourishing business of handmade soaps<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK4" class="story4AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Anita<br>
                            Mattson-Hesketh</div>
                          <img src="images/Anita-Mattson-Hesketh-1X1.png">
                          <div>Lush Blooms</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Turned her floristry hobby into a full-time venture<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK3" class="story3AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Nasira<br>
                            Kasmani</div>
                          <img src="images/Nasira-Kasmani-1X1.png">
                          <div>Jewellery by Nasira</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Followed her passion for  jewellery to create a successful brand<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK2" class="story2AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Bami<br>
                            Kuteyi</div>
                          <img src="images/Bami-Kuteyi-1X1.png">
                          <div>Bam Bam Boogie</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Started a fun and sociable fitness craze with her Afro-Caribbean dance classes<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyUK1" class="story1AB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Rachael Corson and Joycelyn Mate</div>
                          <img src="images/Rachael-Corson-and-Joycelyn-Mate-1X1.png">
                          <div>Afrocenchi</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used natural ingredients to build an Afro hair care brand<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="letin-america" role="tabpanel" aria-labelledby="nav-letin-america-tab">
            <div class="row valign">
              <div class="col-sm-2 pad5"> <img class="con-flag" src="images/LATAM-Region.png"/> </div>
              <div class="col-sm-2 pad5">
                <div data-id="story5" class="storyE">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Mary Silvia<br>
                            Marin Pineda</div>
                          <img src="images/La-Teca-De-Oro-1X1.jpg">
                          <div>La Teca<br>
                            de Oro</div>
                          <div>Mexico</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Preserving local Oaxacan textiles through her embroidery business<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story4" class="storyD">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Jazmin<br>
                            Sandoval</div>
                          <img src="images/Jazmin-Sandoval-1X1.jpg">
                          <div>All You Need<br>
                            is Lunch</div>
                          <div>Mexico</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used local products to curate eco friendly meal experiences<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story3" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Emma Eugenia<br>
                            Mesa Arias</div>
                          <img src="images/Emma-Eugenia-Mesa-Arias-1X1.jpg">
                          <div>Maquiempanadas<br>
                            &nbsp;</div>
                          <div>Colombia </div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Designed a machine to make Colombian Empanadas<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story2" class="storyB">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Agustina<br>
                            Tavella</div>
                          <img src="images/Agustina-Tavella-1X1.jpg">
                          <div>EnOrden<br>
                            &nbsp;</div>
                          <div>Argentina</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Built a brand offering cost effective organising solutions<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story1" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Agnes<br>
                            Martins</div>
                          <img src="images/Agnes-Martins-1X1.jpg">
                          <div>AgnesRasta Bolsas<br>
                            e Acessórios</div>
                          <div>Brazil</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used online selling to popularise her handmade creations<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story61" class="storyA">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Manuela<br>
                            Iribarren</div>
                          <img src="images/Manuela-Iribarren-1X1.jpg">
                          <div>By Maria<br>
                            &nbsp;</div>
                          <div>Chile</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Used fresh and local ingredients to make her gourmet products<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="story62" class="storyB ">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Iris Ferreira<br>
                            Leite</div>
                          <img src="images/Iris-Ferreira-Leite-1X1.png">
                          <div>Quintal<br>
                            Paraense</div>
                          <div>Brazil</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Started a cafe business from her own backyard<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyFausta" class="storyC">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Mila Huamán<br>
                            &nbsp;</div>
                          <img src="images/Mila-Huaman-1X1.png">
                          <div>Fausta<br>
                            &nbsp;</div>
                          <div>Peru</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Founded a restaurant serving traditional Peruvian snacks<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-2 pad5">
                <div data-id="storyComeS" class="storyD ">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <div class="storyBox">
                          <div>Carol and<br>
                            Camilla</div>
                          <img src="images/Carol-and-Camilla-1X1.png">
                          <div>ComeS<br>
                            &nbsp;</div>
                          <div>Chile</div>
                          <div>Read More</div>
                        </div>
                      </div>
                      <div class="flip-card-back">
                        <div class="contentWrapper">
                          <p>Empowered local producers through their online organic store<br>
                            <br>
                            <span style="font-size:12px;">Click for detailed story</span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="africa" role="tabpanel" aria-labelledby="nav-africa-tab">
            <div class="row">
              <div class="col-12 ">
                <nav>
                  <div class="nav nav-tabs nav-fill subnav" id="nav-tab" role="tablist"> <a class="nav-item nav-link active" id="nav-all-africa-tab" data-toggle="tab" href="#all-africa" role="tab" aria-controls="all-africa" aria-selected="true">All</a> <a class="nav-item nav-link" id="nav-nigeria-tab" data-toggle="tab" href="#nigeria" role="tab" aria-controls="nav-profile" aria-selected="false">NIGERIA</a> <a class="nav-item nav-link" id="nav-senegal-tab" data-toggle="tab" href="#senegal" role="tab" aria-controls="nav-contact" aria-selected="false">SENEGAL</a> <a class="nav-item nav-link" id="nav-south-africa-tab" data-toggle="tab" href="#south-africa" role="tab" aria-controls="nav-about" aria-selected="false">SOUTH AFRICA</a> </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-subtabContent">
                  <div class="tab-pane fade show active" id="all-africa" role="tabpanel" aria-labelledby="nav-all-africa-tab">
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/NIGERIAFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP51" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Janet<br>
                                    Falola</div>
                                  <img src="images/Janet-Falola-Ankara-for-Shakara.jpg">
                                  <div>Ankara for<br>
                                    Shakara</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Garnering international attention to her fabric business through digital platforms<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP52" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Oluwunmi<br>
                                    Funbi-Olufeko</div>
                                  <img src="images/Oluwunmi-Funbi-Olufeko-DFL-Clutch-Bags.jpg">
                                  <div>DFL Clutch<br>
                                    Bags</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Finding international buyers for her chic apparel made out of African prints<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP53" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Saudat<br>
                                    Salami</div>
                                  <img src="images/Saudat-Salami-Easyshop-Easycook.jpg">
                                  <div>Easyshop<br>
                                    Easycook</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Making household shopping easier for working women by setting up an online grocery store<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP54" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Tosin<br>
                                    Oshinowo</div>
                                  <img src="images/Tosin-Oshinowo-House-of-Lines-IIe-IIa.jpg">
                                  <div>House of<br>
                                    Lines (Ile-Ila)</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Bringing global recognition to her craftsmanship through digital advertising<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP55" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Emem-Obong<br>
                                    &nbsp;</div>
                                  <img src="images/Emem-Obong-Mfrima-Bakes.jpg">
                                  <div>Mfrima<br>
                                    Bakes</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Earning revenue during the pandemic by selling her home-baked goods online<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/SenegalFlag-2.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs1" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Mariane<br>
                                    Quattara</div>
                                  <img src="images/Farifima-Cosmetique_Marianne.jpg">
                                  <div>FariFima<br>
                                    Cosmétique</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Made natural and inclusive skin care products for people of colour<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs2" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Thérèse Mayé<br>
                                    Diouf Ba</div>
                                  <img src="images/Therese-Maye-Diouf-Ba-Growing-Life-Farm.jpg">
                                  <div>Growing Life<br>
                                    Farm</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Freed underprivileged women from exploitation by giving them an alternative<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs3" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Siny<br>
                                    Samba</div>
                                  <img src="images/Siny-Samba-Le-Lionceau.jpg">
                                  <div>Le Lionceau<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Helped local farmers with her passion for infant nutrition<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs4" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Fatima Sarr<br>
                                    Mbow </div>
                                  <img src="images/Fatima-Sarr-Mbow-Mosasane.jpg">
                                  <div>Mossane<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Employed influencer marketing to bring foreign products to local women<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/SouthAfricaFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs6" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Zelna Naude</div>
                                  <img src="images/Zelna-Naude-Avrio-Kursusse.jpg">
                                  <div>Avrio Kursusse<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Her training services business makes people job ready<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs7" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Margaret Chandia</div>
                                  <img src="images/Margaret-Chandia-Tru-Beauty-Africa.jpg">
                                  <div>Tru Beauty<br>
                                    Africa </div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Built an all natural brand offering unique skin solutions<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs8" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Jackie Owgan </div>
                                  <img src="images/Jackie-Owgan-Image-Cartel-Nail-Academy.jpg">
                                  <div>Image Cartel<br>
                                    Nail Academy</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Partnered with her son to build a multi-city business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs9" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Tamburai Chirume</div>
                                  <img src="images/Story-Face-Card-Image_Tamburai_OneOfEach.png">
                                  <div>ONEOFEACH<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Built a luxury product brand from Africa<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs10" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Mosebjadi Seshoene </div>
                                  <img src="images/Mogau-Mosebjadi-Seshoene-The-Lazy-Makoti.jpg">
                                  <div>The Lazy<br>
                                    Makoti </div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Started cooking classes to popularise South African cuisine<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nigeria" role="tabpanel" aria-labelledby="nav-nigeria-tab">
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/NIGERIAFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP51" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Janet<br>
                                    Falola</div>
                                  <img src="images/Janet-Falola-Ankara-for-Shakara.jpg">
                                  <div>Ankara for<br>
                                    Shakara</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Garnering international attention to her fabric business through digital platforms<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP52" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Oluwunmi<br>
                                    Funbi-Olufeko</div>
                                  <img src="images/Oluwunmi-Funbi-Olufeko-DFL-Clutch-Bags.jpg">
                                  <div>DFL Clutch<br>
                                    Bags</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Finding international buyers for her chic apparel made out of African prints<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP53" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Saudat<br>
                                    Salami</div>
                                  <img src="images/Saudat-Salami-Easyshop-Easycook.jpg">
                                  <div>Easyshop<br>
                                    Easycook</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Making household shopping easier for working women by setting up an online grocery store<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP54" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Tosin<br>
                                    Oshinowo</div>
                                  <img src="images/Tosin-Oshinowo-House-of-Lines-IIe-IIa.jpg">
                                  <div>House of<br>
                                    Lines (Ile-Ila)</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Bringing global recognition to her craftsmanship through digital advertising<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAP55" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Emem-Obong<br>
                                    &nbsp;</div>
                                  <img src="images/Emem-Obong-Mfrima-Bakes.jpg">
                                  <div>Mfrima<br>
                                    Bakes</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Earning revenue during the pandemic by selling her home-baked goods online<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="senegal" role="tabpanel" aria-labelledby="nav-senegal-tab">
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/SenegalFlag-2.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs1" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Mariane<br>
                                    Quattara</div>
                                  <img src="images/Farifima-Cosmetique_Marianne.jpg">
                                  <div>FariFima<br>
                                    Cosmétique</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Made natural and inclusive skin care products for people of colour<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs2" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Thérèse Mayé<br>
                                    Diouf Ba</div>
                                  <img src="images/Therese-Maye-Diouf-Ba-Growing-Life-Farm.jpg">
                                  <div>Growing Life<br>
                                    Farm</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Freed underprivileged women from exploitation by giving them an alternative<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs3" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Siny<br>
                                    Samba</div>
                                  <img src="images/Siny-Samba-Le-Lionceau.jpg">
                                  <div>Le Lionceau<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Helped local farmers with her passion for infant nutrition<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs4" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Fatima Sarr<br>
                                    Mbow </div>
                                  <img src="images/Fatima-Sarr-Mbow-Mosasane.jpg">
                                  <div>Mossane<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Employed influencer marketing to bring foreign products to local women<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="south-africa" role="tabpanel" aria-labelledby="nav-south-africa-tab">
                    <div class="row valign">
                      <div class="col-sm-2 pad5"> <img class="con-flag" src="images/SouthAfricaFlag-1.png"/> </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs6" class="storyA">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Zelna Naude</div>
                                  <img src="images/Zelna-Naude-Avrio-Kursusse.jpg">
                                  <div>Avrio Kursusse<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Her training services business makes people job ready<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs7" class="storyB">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Margaret Chandia</div>
                                  <img src="images/Margaret-Chandia-Tru-Beauty-Africa.jpg">
                                  <div>Tru Beauty<br>
                                    Africa </div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Built an all natural brand offering unique skin solutions<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs8" class="storyC">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Jackie Owgan </div>
                                  <img src="images/Jackie-Owgan-Image-Cartel-Nail-Academy.jpg">
                                  <div>Image Cartel<br>
                                    Nail Academy</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Partnered with her son to build a multi-city business<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs9" class="storyD">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Tamburai Chirume</div>
                                  <img src="images/Story-Face-Card-Image_Tamburai_OneOfEach.png">
                                  <div>ONEOFEACH<br>
                                    &nbsp;</div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Built a luxury product brand from Africa<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-2 pad5">
                        <div data-id="storyAPs10" class="storyE">
                          <div class="flip-card">
                            <div class="flip-card-inner">
                              <div class="flip-card-front">
                                <div class="storyBox">
                                  <div>Mosebjadi Seshoene </div>
                                  <img src="images/Mogau-Mosebjadi-Seshoene-The-Lazy-Makoti.jpg">
                                  <div>The Lazy<br>
                                    Makoti </div>
                                  <div>Read More</div>
                                </div>
                              </div>
                              <div class="flip-card-back">
                                <div class="contentWrapper">
                                  <p>Started cooking classes to popularise South African cuisine<br>
                                    <br>
                                    <span style="font-size:12px;">Click for detailed story</span></p>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
            
<?php */?>

<?php
get_footer();
