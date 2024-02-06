<?php get_header(); ?>
<section class="container-fluid section section-hero1-container">
    <div class="container">
        <div class="row align-items-end">
            <div class="col col-lg-6">
                <h1>Helping the next generation of startups in France</h1>
                <div class="col col-lg-12 section-hero1-copy">
                    <p>
                        Startup Garage is a six-month-long programme for data-driven startups. We currently work with 12 innovative French companies in Paris, supporting their business models that put people more in control of their data.
                        <br/><br/>Soon, we’ll be inviting 12 more startups to join the programme. Learn more below.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid section section-benefits-container">
    <div class="container">
        <div class="row align-items-end">
            <div class="objective-blocks d-flex justify-content-between container">
                <div class="objective-block d-flex flex-lg-column flex-row-reverse">
                    <a class="d-flex flex-lg-column flex-row-reverse" href="<?php echo esc_url(home_url('/how-we-help/#mentoring'));?>">
                        <div class="objective-block-content">
                            <h4><span class="blue-primary">Technical<br/>Facebook mentoring</span></h4>
                        </div>
                        <div class="objective-block-img img-1">
                        </div>
                    </a>
                </div>
                <div class="objective-block d-flex flex-lg-column flex-row-reverse">
                    <a class="d-flex flex-lg-column flex-row-reverse" href="<?php echo esc_url(home_url('/how-we-help/#drive-growth'));?>">
                        <div class="objective-block-content">
                            <h4><span class="blue-primary">Business skills and<br/>development</span></h4>
                        </div>
                        <div class="objective-block-img img-2">
                        </div>
                    </a>
                </div>
                <div class="objective-block d-flex flex-lg-column flex-row-reverse">
                    <a class="d-flex flex-lg-column flex-row-reverse" href="<?php echo esc_url(home_url('/how-we-help/#design-privacy'));?>">
                        <div class="objective-block-content">
                            <h4><span class="blue-primary">Expertise on<br/>privacy design</span></h4>
                        </div>
                        <div class="objective-block-img img-3">
                        </div>
                    </a>
                </div>
                <div class="objective-block d-flex flex-lg-column flex-row-reverse">
                    <a class="d-flex flex-lg-column flex-row-reverse" href="<?php echo esc_url(home_url('/how-we-help/#community-workspace'));?>">
                        <div class="objective-block-content">
                            <h4><span class="blue-primary">An innovative<br/>community</span></h4>
                        </div>
                        <div class="objective-block-img img-4">
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12">
                <a href="<?php echo esc_url(home_url('/how-we-help'));?>" class="btn-cta">Learn more <img
                        src="<?php facebook_image_include( '/assets/images/en/arrow-right.svg' ); ?>" alt=""/>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid section section-startups-container">
    <div class="container">
        <div class="row align-items-center flex-lg-row-reverse">
            <div class="col-12 col-lg-6">
                <h2><span class="blue-secondary">Meet the</span><span class="blue-primary"> community</span></h2>
                <hr class="underscore" />
                <p class="grey-dark startups-copy">We've already helped 12 startups to grow at Startup Garage Paris. Get to know them here.</p>
                <a href="<?php echo esc_url(home_url('/who-we-help'));?>" class="btn-cta d-none d-lg-inline-block">Learn more <img
                        src="<?php facebook_image_include( '/assets/images/en/arrow-right.svg' ); ?>" alt=""/>
                </a>
            </div>
            <div class="col-12 col-lg-6">
                <div class="meet-startups-video">
                    <div class="fb-video" data-href="https://www.facebook.com/FbStationF/videos/1786035294803910/" data-width="550" data-show-text="false"></div>
                    <a href="<?php echo esc_url(home_url('/who-we-help'));?>" class="btn-cta d-lg-none">Learn more <img
                            src="<?php facebook_image_include( '/assets/images/en/arrow-right.svg' ); ?>"
                            alt=""/></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid section section-startup-logo-bar">
</section>
<section class="container-fluid section section-resources-container">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
                <h2><span class="blue-primary">Resources</span></h2>
                <hr class="underscore" />
                <p class="grey-dark resources-copy">Keep up to date with the latest news from the programme and get access to all of our resources including articles and expert interviews.</p>
            </div>
            <div class="col-12 col-lg-6">
                <div class="resources-block d-flex">
                    <div class="resources-block-img">
                        <img src="<?php facebook_image_include( '/assets/images/en/resources_block_img1.png' ); ?>"
                             alt=""/>
                    </div>
                    <div class="resources-block-content">
                        <h4 class="blue-secondary">Startup Garage</h4>
                        <h4 class="blue-primary">on Facebook</h4>
                        <hr class="underscore small" />
                        <a class="blue-secondary" href="https://www.facebook.com/FbStationF/?utm_source=startup-home&utm_content=en" target="_blank">LEARN MORE</a>
                    </div>
                </div>
                <div class="resources-block d-flex">
                    <div class="resources-block-img">
                        <img src="<?php facebook_image_include( '/assets/images/en/resources_block_img2.png' ); ?>"
                             alt=""/>
                    </div>
                    <div class="resources-block-content">
                        <h4 class="blue-secondary">Startup Garage blog</h4>
                        <h4 class="blue-primary">on Medium</h4>
                        <hr class="underscore small" />
                        <a class="blue-secondary" href="https://medium.com/startup-garage-at-station-f?utm_source=startup-home&utm_content=en" target="_blank">LEARN MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
