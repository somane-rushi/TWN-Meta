<?php
/**
 * The template for displaying taknakscam archive pages
 */

get_header();
$takyear = gmdate('Y');
if(isset($_GET['taknakYear'])) { if( !empty($_GET['taknakYear']) ) { $takyear = sanitize_key($_GET['taknakYear']); } }
?>
<style>
#infinite-handle{ display: none; }
</style>

<?php $fields = get_option( "archive_taknakscam", array() ); 
	if ( ! empty( $fields ) ):
	foreach($fields as $data)
	{
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
                    <section class="home-banner"> <img src="<?php echo esc_url( $banner ); ?>" style="width:100%"/> </section>
    			<?php
				endif;
				if ( ! empty( $component['scrollinks'] ) ): ?>
                	<section class="top-sub-sec">
                        <div class="o-wrap">
                            <ul class="top-sub-nav fontOpt_Display">
                            	<?php
								foreach($component['scrollinks'] as $slink)
								{ ?>
									<li> <a href="#<?php echo esc_attr(str_replace(" ","",strtolower(wp_kses_post( $slink['ftitle'] )))); ?>">
										<?php echo wp_kses_post( $slink['ftitle'] ); ?></a></li>
								<?php } ?>
                            </ul>
                        </div>
                    </section>
				<?php endif; ?>
                <section class="c-home-section c-home-section--funfacts mmt-40 mmb-20">
                    <div class="o-wrap text-center">
                        <?php
                            $takterms = fbiamdigital_get_terms( array(
                                'taxonomy' => 'takyear',
                            ) );
                        ?>
                        <form class="c-listing-filter__inner" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'taknakscam' ) ); ?>">
                            <div class="lang-direction-horizontal">
                                <div class="main-heading c-heading3">
                                	<?php if ( ! empty( $component['heading'] ) ):  ?>
                                    <span><?php echo wp_kses_post($component['heading']);?></span>
                                    <br> <?php endif; ?>
                                    <select name="taknakYear" id="taknakYear" class="fontOpt_Display borderBottom c-heading3 tnSelect">                              
                                        <?php foreach ( $takterms as $tak_terms ): $sel='';
												if(!empty($takyear)){ 
													if($tak_terms->slug===$takyear){ $sel= 'selected'; }
												}
												?>
												<option <?php echo esc_attr($sel); ?> value="<?php echo esc_attr( $tak_terms->slug ); ?>"><?php echo esc_html( $tak_terms->name ); ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>                        
                    </div>
                    <div class="o-wrap">
						<?php if ( ! empty( $component['welcome_content'] ) ): ?>
                            <div class="c-home-section__description u-tac sub-heading fontOpt_ExtraLight mb-60"> 
                                <?php echo wp_kses( $component['welcome_content'], array(
                                        'br' => array( 'class' => array() ),
                                        'p' => array( 'class' => array() ),
                                        'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                        'strong' => array(),
                                    ) ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $component['featurebox'] ) ): ?>
                            <div id="taknakscam" class="o-layout o-layout--stretch">
                                <?php foreach($component['featurebox'] as $feat) { ?>
                                    <div class="o-layout__item u-1/2@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in u-animated--animate" > 
                                        <div class="o-box c-listing-item c-listing-item--resources c-funfacts">
                                            <div class="c-listing-item__body bigtext-area">
                                                <?php if ( ! empty( $feat['ftitle'] ) ): ?>
                                                    <div class="c-listing-item__meta"> 
                                                    <span class="c-listing-item__cat big-text fontOpt_Display c-funfact__heading">
                                                        <?php echo wp_kses_post($feat['ftitle']);?></span> </div>
                                                <?php endif; ?>
                                                <?php if ( ! empty( $feat['fcontent'] ) ): ?>
                                                    <h3 class="c-listing-item__title fontOpt_ExtraLight">
                                                        <?php echo wp_kses( $feat['fcontent'], array(
                                                            'br' => array(
                                                                'class' => array()
                                                            ),
                                                        ) ); ?>
                                                    </h3>
                                                 <?php endif; ?>
                                                 <?php if ( ! empty( $feat['flinks'] ) ): ?>
                                                     <p class="fsource"><?php echo wp_kses( $feat['flinks'], array(
                                                        'br' => array('class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                        'strong' => array(),
                                                        ) ); ?></p>
                                                 <?php endif; ?>                    
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php endif; ?>
					</div>
				</section>
                <?php if ( ! empty( $component['box_text'] ) ||  ! empty( $component['box_image'] ) ): ?>
                    <section class="c-home-section c-home-section--resources u-animated" id="lankah">
                        <div class="o-wrap">
                            <div class="o-box o-media c-home-section__media">
                                <form class="o-media__body c-home-section__body ikuti-area" action="">
                                    <h2 class="c-home-section__heading c-heading2 fontOpt_Display"></h2>
                                    <div class="c-home-section__description ikuti fontOpt_ExtraLight mlboxtext" id="divsel">
                                    <?php if ( ! empty( $component['box_text'] ) ): ?>
                                        <?php  echo wp_kses( $component['box_text'], array(
                                                'br' => array('class' => array() ),
                                                'p' => array('class' => array() ),
                                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                'strong' => array(),
                                         ) ); ?>
                                    <?php endif; ?>
                                    <select name="taknaksel" id="taknaksel" class="c-select" onchange="scrollval(this.value)">
                                        <option value="lankah">3 Langkah </option>
                                        <option value="kenalpastiscam">Kenal Pasti Scam</option>
                                        <option value="semakdata">Semak Data</option>
                                        <option value="laporkanscam">Laporkan Scam</option>
                                        <option value="tipskeselamatan">Tips Keselamatan</option>								
                                    </select>
                                    <?php if ( ! empty( $component['box_text_after'] ) ): ?>
                                        <?php  echo wp_kses( $component['box_text_after'], array(
                                                'br' => array('class' => array() ),
                                                'p' => array('class' => array() ),
                                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                'strong' => array(),
                                         ) ); ?>
                                    <?php endif; ?>
                                    </div>
                                </form>
                                <?php $sidebg = wp_get_attachment_url($component['box_image']); ?>
                                <?php if ( ! empty( $sidebg ) ): ?>
                                    <div class="o-media__img c-home-section__img ikuti-img mmb-30" style="background: url(<?php echo esc_url( $sidebg ); ?>)"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
                <?php if ( ! empty( $component['ibox'] ) ): ?>
                    <section class="c-listing c-listing--resources mmb-20">
                        <div class="o-wrap">
                            <div id="content" class="o-layout o-layout--stretch">
                                <?php foreach($component['ibox'] as $ibox) { 
                                    $iboximg = wp_get_attachment_url($ibox['iimages']);
                                ?>
                                <div class="o-layout__item u-1/3@xl u-1/2@md u-1/1@xs u-animated u-animated--fade-in">
                                    <a class="c-listing-item c-listing-item--resources ">
                                        <div class="c-listing-item__img cimg center"> <img src="<?php echo esc_url( $iboximg ); ?>" style="width:100%"/> </div>
                                        <div class="c-listing-item__body #taknakscam">
                                            <div class="c-listing-item__meta"> </div>
                                            <?php if ( ! empty( $ibox['ititle'] ) ): ?>
                                            <h2 class="c-home-section__heading c-heading2 center video-heading fontOpt_Display"><?php echo wp_kses_post($ibox['ititle']);?></h2>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $ibox['icontent'] ) ): ?>
                                                <p class="c-listing-item__description c-listing-item__description--resource fontOpt_ExtraLight">
                                                    <?php echo wp_kses( $ibox['icontent'], array(
                                                                'br' => array( 'class' => array() ),
                                                            ) ); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
				<?php endif; ?>
                <?php if ( ! empty( $component['post_header'] ) ): ?>
                    <section class="c-listing c-listing--resources scroll-margin taknakscam" id="kenalpastiscam">
                        <div class="o-wrap">
                            <h2 class="c-home-section__heading c-heading2 center fontOpt_Display mb-50">
							<?php echo wp_kses_post($component['post_header']);?></h2>
                            <div id="content" class="o-layout o-layout--stretch ress">
                                <?php
                                    while ( have_posts() ) : the_post();
                                        get_template_part( 'template-parts/content', get_post_type() );
                                    endwhile;
                                ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
                <?php if ( ! empty( $component['stories'] ) ): ?>
                    <section class="c-listing scroll-margin" id="semakdata">
                        <div class="o-wrap">
                            <h2 class="c-home-section__heading c-heading2 center fontOpt_Display"><?php echo wp_kses_post($component['story_header']);?></h2>
                            <div id="content" class="o-layout o-layout--stretch">
                                <div class="o-layout__item u-1/1@xl u-1/1@md u-1/1@xs u-animated u-animated--fade-in u-animated--animate pad10">
                                    <div class="o-media__body c-partner-item__body cstrip">
                                        <div class="carousel-one owl-carousel owl-theme">
                                            <?php foreach($component['stories'] as $stry) { 
                                                $simage = wp_get_attachment_url($stry['simage']);
                                            ?>
                                                <div class="carousel-single">
                                                <img src="<?php echo esc_url( $simage ); ?>" style="width:100%"/> 
                                                <a class="rightal" href="<?php echo esc_url( $simage ); ?>" download="<?php echo esc_url( $simage ); ?>" target="_blank"><img src="<?php echo esc_url(get_theme_file_uri( '/images/darrow.png' )); ?>" /></a> 
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </section>
				<?php endif; ?>
                <section class="c-home-section c-home-section--partners u-animated scroll-margin mb-30" id="tipskeselamatan">
                    <div class="o-wrap">
                        <?php if ( ! empty( $component['secure_title'] ) ): ?>
                                <h2 class="c-home-section__heading c-heading2 center fontOpt_Display"> <?php echo wp_kses_post($component['secure_title']);?> </h2>
                        <?php endif; ?>
                    </div>
                </section> 
                <?php if ( ! empty( $component['videobox'] ) ): $i=1; $j=1; 
						foreach($component['videobox'] as $vd) { 
							$vimage = wp_get_attachment_url($vd['video_poster']);
							$vdo = wp_get_attachment_url($vd['video_file']);
							if($i%2!==0){ ?>
                            	<section class="c-home-section c-home-section--partners u-animated mt-50">
                                    <div class="o-wrap">
                                        <div class="o-box o-media o-media--reverse c-home-section__media fcenter">
                                            <div class="o-media__body c-home-section__body videoright">
                                                <h2 class="c-home-section__heading c-heading2 video-heading fontOpt_Display"> <?php echo wp_kses_post($vd['video_title']);?> </h2>
                                                <p class="c-home-section__description fontOpt_ExtraLight">
                                                    <?php echo wp_kses( $vd['video_content'], array( 
                                                            'br' => array('class' => array() ),
                                                            'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                            'strong' => array(),
                                                     ) ); ?>
                                                </p>
                                            </div>
                                            <div class="video-area videoleft" >
                                                <a data-fancybox href="#myVideo<?php echo esc_attr( $j ); ?>">
                                                    <img src="<?php echo esc_url( $vimage ); ?>" width="500" />
                                                </a>
                                                
                                                <video controls id="myVideo<?php echo esc_attr( $j ); ?>" style="display:none;">
                                                    <source src="<?php echo esc_url( $vdo ); ?>" type="video/mp4">
                                                    Your browser doesn't support HTML5 video tag.
                                                </video>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php } else { ?>
                                <section class="c-home-section c-home-section--partners u-animated">
                                    <div class="o-wrap">
                                        <div class="o-box o-media o-media--reverse c-home-section__media fcenter">
                                            <div class="video-area videoleft" >
                                                <a data-fancybox href="#myVideo<?php echo esc_attr( $j ); ?>">
                                                    <img src="<?php echo esc_url( $vimage ); ?>" width="500" />
                                                </a>
                                                
                                                <video controls id="myVideo<?php echo esc_attr( $j ); ?>" style="display:none;">
                                                    <source src="<?php echo esc_url( $vdo ); ?>" type="video/mp4">
                                                    Your browser doesn't support HTML5 video tag.
                                                </video>
                                            </div>
                                            <div class="o-media__body c-home-section__body">
                                                <h2 class="c-home-section__heading c-heading2 video-heading fontOpt_Display"> <?php echo wp_kses_post($vd['video_title']);?> </h2>
                                                <p class="c-home-section__description fontOpt_ExtraLight">
                                                    <?php echo wp_kses( $vd['video_content'], array( 
                                                            'br' => array('class' => array() ),
                                                            'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                                            'strong' => array(),
                                                     ) ); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                
                		<?php } $i++; $j++; } 
				endif; ?>
                <?php if ( ! empty( $component['secure_image'] ) ): ?>
                    <section class=" c-home-section c-home-section--partners u-animated c-listing">
                        <div class="o-wrap">
                            <div id="content" class="o-layout o-layout--stretch">
                                <div class="o-layout__item u-1/1@xl u-1/1@md u-1/1@xs u-animated u-animated--fade-in">
                                    <div class="o-media__body c-partner-item__body pad0">
                                        <div class="carousel-one owl-carousel owl-theme">
                                        <?php foreach($component['secure_image'] as $simg) { 
                                            $secimage = wp_get_attachment_url($simg['secimage']);
                                            if( ! empty( $secimage) )
                                            { ?>
                                                <div class="carousel-single">
                                                <img src="<?php echo esc_url( $secimage ); ?>" style="width:100%"/>
                                                <a class="rightal" href="<?php echo esc_url( $secimage ); ?>" download="<?php echo esc_url( $secimage ); ?>" target="_blank"><img src="<?php echo esc_url(get_theme_file_uri( '/images/darrow.png' )); ?>" /></a> 
                                                </div>
                                        <?php } }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
				<?php endif; ?>
                <?php if ( ! empty( $component['msg_header'] ) ): ?>
                    <section class="c-home-section c-home-section--funfacts scroll-margin" id="laporkanscam">
                        <div class="o-wrap">
                            <h2 class="c-home-section__heading c-heading2 u-tac fontOpt_Display mb-40">
                                <?php echo wp_kses( $component['msg_header'], array( 
                                        'br' => array('class' => array() ),
                                    ) ); ?>	
                            </h2>
                            <div class="c-home-section__description blueback pad40 white jika-text fontOpt_ExtraLight"> 
                                <?php echo wp_kses( $component['msg_content'], array( 
                                        'br' => array('class' => array() ),
                                        'p' => array('class' => array() ),
                                        'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                        'strong' => array(),
                                    ) ); ?>		
                            </div>
                        </div>
                    </section>
				<?php endif; ?>
                <?php if ( ! empty( $component['scames_image'] ) ): ?>
                    <section class=" c-home-section c-home-section--partners u-animated c-listing">
                        <div class="o-wrap">
                            <div id="content" class="o-layout o-layout--stretch">
                                <div class="o-layout__item u-1/1@xl u-1/1@md u-1/1@xs u-animated u-animated--fade-in">
                                    <div class="o-media__body c-partner-item__body pad0">
                                        <div class="carousel-one owl-carousel owl-theme">
                                        <?php foreach($component['scames_image'] as $simg) { 
                                            $secimage = wp_get_attachment_url($simg['secimage']);
                                            if( ! empty( $secimage) )
                                            { ?>
                                                <div class="carousel-single"> <img src="<?php echo esc_url( $secimage ); ?>" style="width:100%"/>
                                                <a class="rightal" href="<?php echo esc_url( $secimage ); ?>" download="<?php echo esc_url( $secimage ); ?>" target="_blank"><img src="<?php echo esc_url(get_theme_file_uri( '/images/darrow.png' )); ?>" /></a> 
                                                </div>
                                        <?php } }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
				<?php endif; ?>
                <?php if ( ! empty( $component['scames_content'] ) ): ?>
                    <section class="c-home-section c-home-section--funfacts marginnone mmb-40" id="sourceinfo">
                        <div class="o-wrap">
                            <div class="c-home-section__description u-tac jika-text fontOpt_ExtraLight"> 
                                <?php echo wp_kses( $component['scames_content'], array( 
                                        'br' => array('class' => array() ),
                                        'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),
                                        'strong' => array(),
                                        'ul' => array('class' => array() ),
                                        'li' => array('class' => array() ),
                                    ) ); ?>	
                            </div>
                        </div>
                    </section>
				<?php endif; ?>
                
				<?php if ( ! empty( $component['jumbotron'] ) ): ?>
                    <section class="c-home-section c-home-section--funfacts mmt-30">
                        <div class="o-wrap">
                            <h2 class="c-home-section__heading c-heading2 u-tac fontOpt_Display mb-40 texttrans-none"><?php echo wp_kses_post($component['logo_header']);?></h2>
                            <ul class="logo-area">
                                <?php foreach($component['jumbotron'] as $lg) { 
                                    $logo = wp_get_attachment_url($lg['parlogo']);
                                    if( ! empty( $logo) )
                                    { ?>
                                        <li>
                                            <?php if( ! empty($lg['plogolink']) ) { ?>
                                            <a href="<?php echo esc_url($lg['plogolink'] ); ?>" target="_blank">
                                            <?php } ?>
                                                <img src="<?php echo esc_url( $logo ); ?>"/>
                                            <?php if( ! empty($lg['plogolink']) ) { echo '</a>'; } ?> 
                                        </li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </section>
                <?php endif; ?>
                <?php
			}
			
			
		}
	}
	endif;
?>
<div class="c-home--player c-resources-video-player">
	<div class="c-resources-video-player__content">
		<video controls="" controlslist="nodownload" preload="metadata" playsinline=""></video>
        <button class="c-resources-video-player__btn-close"><i class="fal fa-times"></i></button>
	</div>
</div>
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