<?php
    /*
    Template Name: BuyFromHer Page
    */
    get_header();
?>
<?php while ( have_posts() ) : the_post(); 
    $sec_banner = get_post_meta( get_the_ID(), 'banner', true );
    $vdbanner = wp_get_attachment_url($sec_banner['banner_vd']);
    ?>
<?php if ( ! empty( $vdbanner ) ): ?>
<section class="videoBanner noPadding" id="pgTop">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 noPadding">
                <video autoplay controls muted class="vidContainer">
                    <source src="<?php echo esc_url( $vdbanner ); ?>" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</section>
<?php endif; 
    $sec_two = get_post_meta( get_the_ID(), 'sec_two', true ); 
    $vdtwo = wp_get_attachment_url($sec_two['sectwo_vd']);
    $vdposter = wp_get_attachment_url($sec_two['sectwo_poster']);
    if ( ! empty( $vdtwo ) ):
    ?>
<section class="videoBanner noPadding pinkBGone" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/02/pink-bg-1.png');">
    <div class="container paddTop50 paddBottom50">
        <div class="row">
            <?php if ( ! empty( $sec_two['sectwo_title'] ) ): ?>
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <h1 class="txtGrey fontOptLight text-center noMargin paddBottom50">
                    <?php echo esc_html( $sec_two['sectwo_title'] ); ?>
                </h1>
            </div>
            <?php endif; ?>
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <video controls muted class="vidContainer" poster="<?php echo esc_url( $vdposter ); ?>">
                    <source src="<?php echo esc_url( $vdtwo ); ?>" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</section>
<?php endif; 
    $sec_thr = get_post_meta( get_the_ID(), 'sec_thr', true ); 
    $imgthr = wp_get_attachment_url($sec_thr['secthr_img']);
    if( !empty($imgthr) || $sec_thr['secthr_desc'] ):
    ?>
<section class="videoBanner noPadding">
    <div class="container paddTop50">
        <div class="row valign">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <img src="<?php echo esc_url( $imgthr ); ?>" class="img100 paddBottom25" />
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <?php if ( ! empty( $sec_thr['secthr_title'] ) ): ?>
                <h3 class="txtGrey fontOptLight text-left noMargin paddBottom25">
                    <?php echo esc_html( $sec_thr['secthr_title'] ); ?>
                </h3>
                <?php endif; ?>
                <?php if ( ! empty( $sec_thr['secthr_desc'] ) ): ?>
                <div class="font20 txtGrey fontOptLight text-left noMargin">
                    <?php echo wp_kses( $sec_thr['secthr_desc'], 
                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                        'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
                        'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                        'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                        'b' => array( 'class' => array() ), 'strong' => array(), 'class' => array() ) ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $mcountry = buyfromher_country('0'); 
    if ( ! empty( $mcountry ) ):
    ?>
<section class="noPadding">
    <div class="container-fluid paddBottom50 paddTop50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="bfhTabs">
                        <div class="nav nav-tabs nav-fill main-nav" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link bfhTab txtGrey active" id="nav-all" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">ALL</a>
                            <?php foreach ( $mcountry as $cou ) { ?>
                            <a class="nav-item nav-link bfhTab txtGrey" id="nav-<?php echo wp_kses_post($cou->slug); ?>-tab" data-toggle="tab" href="#<?php echo wp_kses_post($cou->slug); ?>" role="tab" aria-controls="<?php echo wp_kses_post($cou->slug); ?>" aria-selected="false"  data-parent="<?php echo wp_kses_post($mtab->slug); ?>"><?php echo wp_kses_post($cou->name); ?></a>
                            <?php } ?>
                        </div>
                    </nav>
                    <div class="divder"></div>
                    <?php $mcountrytab = buyfromher_country('0'); 
                        if ( ! empty( $mcountrytab ) ):
                        ?>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all">
                            <?php $a=1; $b=1;
                                foreach ( $mcountrytab as $mtab ) {
									$subcoun = buyfromher_country($mtab->term_id);
									if ( ! empty( $subcoun ) ) {
										foreach ( $subcoun as $scou ) {
											$allcontent = getbuyformher_post($scou->slug);
											if ( $allcontent->have_posts() ) 
											{
												?>
													<div class="bfhBox">
														<?php if($a===1) { ?>
														<div class="row">
															<div class="col-12 paddBottom35 paddTop35">
																<h4 class="txtDarkGrey fontOptLight text-center noMargin noPadding">Stories of resilience from women entrepreneurs across the world.</h4>
															</div>
														</div>
														<?php } ?>
														<?php
															$pid =''; 
															while ( $allcontent->have_posts() ): $allcontent->the_post();
															$buyfrm = get_post_meta( get_the_ID(), 'buyfromher', true);
															$herimg = wp_get_attachment_url($buyfrm['simage']); 
															$pid=get_the_ID(); 
															if($b%2===1){
															?>
																<div class="row valign bfhStory pinkBGtwo marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/03/pink-wave-1.png')">
																	<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
																		<img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
																	</div>
																	<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
																		<?php if ( ! empty( $buyfrm['bname'] ) ): ?>
																		<h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
																			<?php echo esc_html( $buyfrm['bname'] ); ?>
																		</h3>
																		<?php endif; ?>
																		<div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
																			<?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
																			<?php echo esc_html( $buyfrm['bcou'] ); ?> | 
																			<?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
																			<?php echo esc_html( $buyfrm['business'] ); ?>
																			<?php endif; ?>
																		</div>
																		<?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
																		<?php echo wp_kses( $buyfrm['sdescription'], array(
																			'br' => array( 'class' => array() ), 'class' => array(),
																			'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																			'strong' => array(), 'style' => array(), 
																			'p' => array( 'class' => array() ),
																			) ); ?>
																		<?php endif; ?>
																		<a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
																	</div>
																</div>
														<?php }else{ ?>
																<div class="row valign bfhStory ltGreenBG marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/02/yello-bg-wave.png')">
																	<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
																		<?php if ( ! empty( $buyfrm['bname'] ) ): ?>
																		<h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
																			<?php echo esc_html( $buyfrm['bname'] ); ?>
																		</h3>
																		<?php endif; ?>
																		<div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
																			<?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
																			<?php echo esc_html( $buyfrm['bcou'] ); ?> | 
																			<?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
																			<?php echo esc_html( $buyfrm['business'] ); ?>
																			<?php endif; ?>
																		</div>
																		<?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
																		<?php echo wp_kses( $buyfrm['sdescription'], array(
																			'br' => array( 'class' => array() ), 'class' => array(),
																			'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																			'strong' => array(), 'style' => array(),
																			'p' => array( 'class' => array() ), 'class' => array(),
																			) ); ?>
																		<?php endif; ?>
																		<a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
																	</div>
																	<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
																		<img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
																	</div>
																</div>
														<?php } ?>
														<?php $a++; $b++;  endwhile; wp_reset_postdata(); ?>
													</div>
											<!--bfhBox-->
											<?php 
											}
										}
                                	}
									else
									{
										$allcontent = getbuyformher_post($mtab->slug);
										if ( $allcontent->have_posts() ) 
										{
											?>
													<div class="bfhBox">
														<?php if($a===1) { ?>
														<div class="row">
															<div class="col-12 paddBottom35 paddTop35">
																<h4 class="txtDarkGrey fontOptLight text-center noMargin noPadding">Stories of resilience from women entrepreneurs across the world.</h4>
															</div>
														</div>
														<?php } ?>
														<?php
															$pid =''; 
															while ( $allcontent->have_posts() ): $allcontent->the_post();
															$buyfrm = get_post_meta( get_the_ID(), 'buyfromher', true);
															$herimg = wp_get_attachment_url($buyfrm['simage']); 
															$pid=get_the_ID(); 
															if($b%2===1){
															?>
																<div class="row valign bfhStory pinkBGtwo marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/03/pink-wave-1.png')">
																	<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
																		<img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
																	</div>
																	<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
																		<?php if ( ! empty( $buyfrm['bname'] ) ): ?>
																		<h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
																			<?php echo esc_html( $buyfrm['bname'] ); ?>
																		</h3>
																		<?php endif; ?>
																		<div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
																			<?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
																			<?php echo esc_html( $buyfrm['bcou'] ); ?> | 
																			<?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
																			<?php echo esc_html( $buyfrm['business'] ); ?>
																			<?php endif; ?>
																		</div>
																		<?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
																		<?php echo wp_kses( $buyfrm['sdescription'], array(
																			'br' => array( 'class' => array() ), 'class' => array(),
																			'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																			'strong' => array(), 'style' => array(), 
																			'p' => array( 'class' => array() ),
																			) ); ?>
																		<?php endif; ?>
																		<a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
																	</div>
																</div>
														<?php }else{ ?>
																<div class="row valign bfhStory ltGreenBG marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/02/yello-bg-wave.png')">
																	<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
																		<?php if ( ! empty( $buyfrm['bname'] ) ): ?>
																		<h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
																			<?php echo esc_html( $buyfrm['bname'] ); ?>
																		</h3>
																		<?php endif; ?>
																		<div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
																			<?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
																			<?php echo esc_html( $buyfrm['bcou'] ); ?> | 
																			<?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
																			<?php echo esc_html( $buyfrm['business'] ); ?>
																			<?php endif; ?>
																		</div>
																		<?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
																		<?php echo wp_kses( $buyfrm['sdescription'], array(
																			'br' => array( 'class' => array() ), 'class' => array(),
																			'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
																			'strong' => array(), 'style' => array(),
																			'p' => array( 'class' => array() ), 'class' => array(),
																			) ); ?>
																		<?php endif; ?>
																		<a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
																	</div>
																	<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
																		<img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
																	</div>
																</div>
														<?php } ?>
														<?php $a++; $b++;  endwhile; wp_reset_postdata(); ?>
													</div>
											<!--bfhBox-->
											<?php 
										}
									}
                                } ?>
                        </div>
                        <?php
                            foreach ( $mcountrytab as $mtab ) { ?>
                        <div class="tab-pane fade" id="<?php echo wp_kses_post($mtab->slug); ?>" role="tabpanel" aria-labelledby="nav-<?php echo wp_kses_post($mtab->slug); ?>-tab">
                            <?php $subcoun = buyfromher_country($mtab->term_id);
                                if ( ! empty( $subcoun ) ) { ?>
                            <nav class="bfhTabs">
                                <div class="nav nav-tabs nav-fill main-nav" id="nav-tab2" role="tablist">
                                    <a class="nav-item nav-link bfhTab txtGrey active" id="nav-all-<?php echo wp_kses_post($mtab->slug); ?>-tab" data-toggle="tab" href="#all-<?php echo wp_kses_post($mtab->slug); ?>" role="tab" aria-controls="nav-<?php echo wp_kses_post($mtab->slug); ?>" aria-selected="true">All</a> 
                                    <?php foreach ( $subcoun as $scou ) { ?>
                                    <a class="nav-item nav-link bfhTab txtGrey " id="nav-<?php echo wp_kses_post($scou->slug); ?>-tab" data-toggle="tab" data-parent="<?php echo wp_kses_post($mtab->slug); ?>" href="#<?php echo wp_kses_post($scou->slug); ?>" role="tab" aria-controls="<?php echo wp_kses_post($scou->slug); ?>" aria-selected="false"><?php echo wp_kses_post($scou->name); ?></a>
                                    <?php } ?>
                                </div>
                            </nav>
                            <div class="divder"></div>
                            <div class="tab-content" id="nav-subtabContent">
                                <div class="tab-pane fade show active" id="all-<?php echo wp_kses_post($mtab->slug); ?>" role="tabpanel" aria-labelledby="nav-all-<?php echo wp_kses_post($mtab->slug); ?>-tab">
                                    <?php
                                        $a=1;  $b=1;
                                        foreach ( $subcoun as $scou ) { $allcontent='';
                                                                        	$allcontent = getbuyformher_post($scou->slug);
                                        if ( $allcontent->have_posts() ) {
                                        	$pid ='';
                                        		while ( $allcontent->have_posts() ): $allcontent->the_post();
                                        			$buyfrm = get_post_meta( get_the_ID(), 'buyfromher', true);
                                        			$herimg = wp_get_attachment_url($buyfrm['simage']); 
                                        			$pid=get_the_ID(); 
                                        			if($b%2===1){
                                        			?>
                                    <div class="row valign bfhStory pinkBGtwo marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/03/pink-wave-1.png')">
                                        <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                                            <img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
                                        </div>
                                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                            <?php if ( ! empty( $buyfrm['bname'] ) ): ?>
                                            <h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
                                                <?php echo esc_html( $buyfrm['bname'] ); ?>
                                            </h3>
                                            <?php endif; ?>
                                            <div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
                                                <?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
                                                <?php echo esc_html( $buyfrm['bcou'] ); ?> | 
                                                <?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
                                                <?php echo esc_html( $buyfrm['business'] ); ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
                                            <?php echo wp_kses( $buyfrm['sdescription'], array(
                                                'br' => array( 'class' => array() ), 'class' => array(),
                                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
                                                'strong' => array(), 'style' => array(),
                                                'p' => array( 'class' => array() ), 'class' => array(),
                                                ) ); ?>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="row valign bfhStory ltGreenBG marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/02/yello-bg-wave.png')">
                                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                            <?php if ( ! empty( $buyfrm['bname'] ) ): ?>
                                            <h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
                                                <?php echo esc_html( $buyfrm['bname'] ); ?>
                                            </h3>
                                            <?php endif; ?>
                                            <div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
                                                <?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
                                                <?php echo esc_html( $buyfrm['bcou'] ); ?> | 
                                                <?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
                                                <?php echo esc_html( $buyfrm['business'] ); ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
                                            <?php echo wp_kses( $buyfrm['sdescription'], array(
                                                'br' => array( 'class' => array() ), 'class' => array(),
                                                'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
                                                'strong' => array(), 'style' => array(),
                                                'p' => array('class' => array()), 'class' => array(),
                                                ) ); ?>
                                            <?php endif; ?>
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                                            <img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php $a++; $b++;  endwhile; wp_reset_postdata();
                                        }
                                        ?>
                                    <?php } ?>
                                </div>
                                <?php 
                                    foreach ( $subcoun as $scou ) { $a=1; $b=1; ?>
                                <div class="tab-pane fade" id="<?php echo wp_kses_post($scou->slug); ?>" role="tabpanel" aria-labelledby="<?php echo wp_kses_post($scou->slug); ?>">
                                    <div class="bfhBox">
                                        <div class="row">
                                            <?php if($a===1) { ?>
                                            <div class="col-12 paddBottom35 paddTop35">
                                                <h4 class="txtDarkGrey fontOptLight text-center noMargin noPadding">
                                                    <?php $catID = get_the_category();
                                                        echo category_description( $scou->term_id );
                                                        ?>
                                                </h4>
                                            </div>
                                            <?php }
                                                $allcontent = getbuyformher_post($scou->slug);
                                                $pid =''; 
                                                while ( $allcontent->have_posts() ): $allcontent->the_post();
                                                $buyfrm = get_post_meta( get_the_ID(), 'buyfromher', true);
                                                $herimg = wp_get_attachment_url($buyfrm['simage']); 
                                                $pid=get_the_ID(); 
                                                if($b%2===1){
                                                ?>
                                            <div class="row valign bfhStory pinkBGtwo marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/03/pink-wave-1.png')">
                                                <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                                                    <img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
                                                </div>
                                                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                                    <?php if ( ! empty( $buyfrm['bname'] ) ): ?>
                                                    <h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
                                                        <?php echo esc_html( $buyfrm['bname'] ); ?>
                                                    </h3>
                                                    <?php endif; ?>
                                                    <div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
                                                        <?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
                                                        <?php echo esc_html( $buyfrm['bcou'] ); ?> | 
                                                        <?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
                                                        <?php echo esc_html( $buyfrm['business'] ); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
                                                    <?php echo wp_kses( $buyfrm['sdescription'], array(
                                                        'br' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
                                                        'strong' => array(), 'style' => array(),
                                                        'p' => array('class' => array()), 'class' => array(),
                                                        ) ); ?>
                                                    <?php endif; ?>
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
                                                </div>
                                            </div>
                                            <?php }else{ ?>
                                            <div class="row valign bfhStory ltGreenBG marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/02/yello-bg-wave.png')">
                                                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                                    <?php if ( ! empty( $buyfrm['bname'] ) ): ?>
                                                    <h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
                                                        <?php echo esc_html( $buyfrm['bname'] ); ?>
                                                    </h3>
                                                    <?php endif; ?>
                                                    <div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
                                                        <?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
                                                        <?php echo esc_html( $buyfrm['bcou'] ); ?> | 
                                                        <?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
                                                        <?php echo esc_html( $buyfrm['business'] ); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
                                                    <?php echo wp_kses( $buyfrm['sdescription'], array(
                                                        'br' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
                                                        'strong' => array(), 'style' => array(),
                                                        'p' => array('class' => array()), 'class' => array(),
                                                        ) ); ?>
                                                    <?php endif; ?>
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
                                                </div>
                                                <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                                                    <img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php $a++; $b++;  endwhile; wp_reset_postdata(); ?>
                                            <?php
												$coulink = get_term_meta( wp_kses_post($scou->term_id), 'cat_desc', true );
												if( !empty( $coulink['category_linktxt'] ) ) :
											?>
											<div class="dispBlock img100 tanBG">
												<div class="col-12 paddBottom50 paddTop50">
                                                	<h4 class="txtDarkGrey fontOptLight text-center noMargin noPadding">
                                                    	<?php echo wp_kses( $coulink['category_linktxt'], array(
                                                        'br' => array( 'class' => array() ),
                                                        'a' => array( 'href' => array(), 'title' => array(), 'class' => array(), 'target' => array() ),																	
                                                        'strong' => array(), 'style' => array(), 'p' => array('class' => array()),
                                                        ) ); ?>
                                                    </h4>
                                                </div>
											</div>
											<?php endif; ?>
                                        </div>
                                        <!---->
                                    </div>
                                    <!--bfhBox-->
                                </div>
                                <?php } //for ?>
                            </div>
                            <!-- content -->
                            <?php }
                                else {
                                $a=1; $b=1;
                                $allcontent = getbuyformher_post($mtab->slug);
                                if ( $allcontent->have_posts() ) { ?>
                            <div class="bfhBox">
                                <?php if($a===1) { ?>
                                <div class="row">
                                    <?php if($a===1) { ?>
                                    <div class="col-12 paddBottom35 paddTop35">
                                        <h4 class="txtDarkGrey fontOptLight text-center noMargin noPadding">
                                            <?php $catID = get_the_category();
                                                echo category_description( $mtab->term_id );
                                                ?>
                                        </h4>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <?php
                                    $pid =''; 
                                    while ( $allcontent->have_posts() ): $allcontent->the_post();
                                    $buyfrm = get_post_meta( get_the_ID(), 'buyfromher', true);
                                    $herimg = wp_get_attachment_url($buyfrm['simage']); 
                                    $pid=get_the_ID(); 
                                    if($b%2===1){
                                    ?>
                                <div class="row valign bfhStory pinkBGtwo marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/03/pink-wave-1.png')">
                                    <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                                        <img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                        <?php if ( ! empty( $buyfrm['bname'] ) ): ?>
                                        <h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
                                            <?php echo esc_html( $buyfrm['bname'] ); ?>
                                        </h3>
                                        <?php endif; ?>
                                        <div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
                                            <?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
                                            <?php echo esc_html( $buyfrm['bcou'] ); ?> | 
                                            <?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
                                            <?php echo esc_html( $buyfrm['business'] ); ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
                                        <?php echo wp_kses( $buyfrm['sdescription'], array(
                                            'br' => array( 'class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
                                            'strong' => array(), 'style' => array(),
                                            'p' => array( 'class' => array() ), 'class' => array(),
                                            ) ); ?>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="row valign bfhStory ltGreenBG marginBottom25" style="background-image: url('https://shemeansbusiness.fb.com/wp-content/uploads/2022/02/yello-bg-wave.png')">
                                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                                        <?php if ( ! empty( $buyfrm['bname'] ) ): ?>
                                        <h3 class="fontOptTxt txtGrey marginTop25 marginBottom5">
                                            <?php echo esc_html( $buyfrm['bname'] ); ?>
                                        </h3>
                                        <?php endif; ?>
                                        <div class="fontOptTxt txtGrey font14 marginBottom25 marginTopZero">
                                            <?php if ( ! empty( $buyfrm['bcou'] ) ): ?>
                                            <?php echo esc_html( $buyfrm['bcou'] ); ?> | 
                                            <?php endif; if ( ! empty( $buyfrm['business'] ) ): ?>
                                            <?php echo esc_html( $buyfrm['business'] ); ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ( ! empty( $buyfrm['sdescription'] ) ): ?>
                                        <?php echo wp_kses( $buyfrm['sdescription'], array(
                                            'br' => array( 'class' => array() ),
                                            'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),																	
                                            'strong' => array(), 'style' => array(),
                                            'p' => array( 'class' => array() ), 'class' => array(),
                                            ) ); ?>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="btn btnGrey font14">Read More</a>
                                    </div>
                                    <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
                                        <img src="<?php echo esc_url( $herimg ); ?>" alt="shemb" class="img80" />
                                    </div>
                                </div>
                                <?php } ?>
                                <?php $a++; $b++;  endwhile; wp_reset_postdata(); ?>
								<?php
									$coulink = get_term_meta( wp_kses_post($mtab->term_id), 'cat_desc', true );
									if( !empty( $coulink['category_linktxt'] ) ) :
								?>
									<div class="dispBlock img100 tanBG">
										<div class="col-12 paddBottom50 paddTop50">
											<h4 class="txtDarkGrey fontOptLight text-center noMargin noPadding">
                                            	<?php echo wp_kses( $coulink['category_linktxt'], array(
													'br' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(), 'class' => array(), 'target' => array() ),																	
                                                    'strong' => array(), 'style' => array(), 'p' => array('class' => array()),
												) ); ?>
											</h4>
										</div>
									</div>
								<?php endif; ?>
                            </div>
                            <!--bfhBox-->
                            <?php
                                }
                                
                                ?>
                            <?php } ?>
                        </div>
                        <?php } //for ?>
                    </div>
                    <!-- tab content -->
                    <?php endif; ?>
                </div>
                <!-- 12 -->
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!---->
<section class="noPadding marBottom75">
	<div class="container-fluid">        
		<div class="img100">
			<a href="#pgTop" target="_self" title="Back To Top" class="btn text-white bTop noPadding">
                <img src="https://shemeansbusiness-fb-com-develop.go-vip.net/wp-content/uploads/2022/02/top-grey-arrow.png" alt="Back To Top" class="bTopImg" />
                <p class="text-center font12 txtGrey marginTB15 fontOptTxt">Back to Top</p>
            </a>									
		</div>	
	</div>
</section>
<!---->
<?php
    $sec_four = get_post_meta( get_the_ID(), 'sec_four', true ); 
    $imgfr = wp_get_attachment_url($sec_four['secfr_img']);
    if( !empty($imgfr) || $sec_four['secfr_title'] ):
    ?>
<section class="noPadding orangeBG">
    <div class="container-fluid paddTop50 paddBottom50">
        <div class="container">
            <div class="row valign">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                    <?php if ( ! empty( $sec_four['secfr_title'] ) ): ?>
                    <h2 class="fontOptTxt txtDarkGrey text-left noMargin paddBottom15">
                        <?php echo esc_html( $sec_four['secfr_title'] ); ?>
                    </h2>
                    <?php endif; ?>
                    <?php if ( ! empty( $sec_four['secfr_desc'] ) ): ?>
                    <div class="font16 txtDarkGrey fontOptLight text-left noMargin paddBottom15">
                        <?php echo wp_kses( $sec_four['secfr_desc'], 
                            array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                            'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
                            'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                            'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                            'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                            'b' => array( 'class' => array() ), 'strong' => array(), 'class' => array() ) ); ?>
                    </div>
                    <?php endif; ?>
                    <div class="valign txtDarkGrey dispInline">
                        <p class="font16 bfhLinks noMargin">
                            <img src="https://shemeansbusiness.fb.com/wp-content/uploads/2022/02/instagram-icon.png" alt="Instagram" class="instaLogo" />
                            <?php if ( ! empty( $sec_four['secfr_insta'] ) ): ?>
                            <a href="<?php echo esc_url( $sec_four['secfr_instaln'] ); ?>" class="txtDarkGrey" target="_blank">
                            <?php echo esc_html( $sec_four['secfr_insta'] ); ?></a> &nbsp;|&nbsp;
                            <?php endif; 
                                if ( ! empty( $sec_four['secfr_website'] ) ):
                                ?>
                            <a href="<?php echo esc_url( $sec_four['secfr_websiteln'] ); ?>" class="txtDarkGrey" target="_blank">
                            <?php echo esc_html( $sec_four['secfr_website'] ); ?></a>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <img src="<?php echo esc_url( $imgfr ); ?>" class="sideImg" alt="buyformher" />
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php endwhile; ?>
<?php
get_footer();