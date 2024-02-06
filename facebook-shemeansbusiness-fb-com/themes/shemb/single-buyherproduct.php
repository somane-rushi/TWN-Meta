<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package shemb
 */

get_header();
?>
<?php while ( have_posts() ) : the_post();
	$sec_pro = get_post_meta( get_the_ID(), 'herproduct', true );
	$sec_buy = get_post_meta( get_the_ID(), 'buyfromher', true );
	$imgbanner = wp_get_attachment_url($sec_pro['bimage']);
	$bannerbg = wp_get_attachment_url( $sec_pro['bgimage'] );
?>
<?php if ( ! empty( $imgbanner ) ): ?>
    <section class="probanarea">
        <div class="container-fluid noPadding">
            <img src="<?php echo esc_url( $imgbanner ); ?>" class="mainproban" alt="Shemb"/>
            <?php if ( ! empty( $bannerbg ) ): ?>
            	<img src="<?php echo esc_url( $bannerbg ); ?>" alt="Shemb" class="buyinban"/>
            <?php endif; ?>
        </div>    
    </section>
<?php endif; ?>
<?php if ( ! empty( $sec_pro['bname'] ) || ! empty( $sec_pro['bcountry']) ): ?>
    <section class="prodetailarea">
        <div class="container-fluid">
            <div class="container prbrbottom">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <?php if ( ! empty( $sec_pro['bname'] ) ): ?>
                            <h1 class="prodetail-heading">
                                <?php echo wp_kses( $sec_pro['bname'], 
                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                    'p' => array( 'class' => array() ),'b' => array( 'class' => array() ), 
                                    'strong' => array(), 'class' => array() ) ); ?>
                            </h1>
                        <?php endif; ?>
                        <?php if ( ! empty( $sec_buy['bname'] ) ): ?>
                            <h5 class="promakername"> <?php echo esc_html( $sec_buy['bname'] ); ?> </h5>
                        <?php endif; ?>
                        <?php if ( ! empty( $sec_pro['bcountry'] ) ): ?>
                            <h5 class="promakercity"><?php echo esc_html( $sec_pro['bcountry'] ); ?></h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;
if ( ! empty( $sec_pro['add_sec'] ) ):
foreach ( $sec_pro['add_sec'] as $sec ) { 
	if($sec['sec_type']==='fulltext')
	{ 
		if ( ! empty( $sec['sec_fulltext_fields']['popfulltext'] ) ): ?>
    	<section class="prodetailparaarea">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-12">
                            <?php echo wp_kses( $sec['sec_fulltext_fields']['popfulltext'], 
                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                    'p' => array( 'class' => array() ),'h1' => array( 'class' => array() ),
                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                    'b' => array( 'class' => array() ), 'strong' => array(), 'class' => array() ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
		</section>
    <?php
		endif;
	}
	if($sec['sec_type']==='twocol_iltr')
	{ 
		$leftimg = wp_get_attachment_url($sec['sec_twocol_iltr_fields']['poplimage']);
		if ( ! empty( $leftimg ) || ! empty( $sec['sec_twocol_iltr_fields']['poprightttext'] ) ): 
	?>
    	<section class="prodetailparaarea">
            <div class="container-fluid">
                <div class="container">
                    <div class="row proparaimgarea">
                        <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                            <img src="<?php echo esc_url( $leftimg ); ?>" class="prosubimg" alt="Shemb" />
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                            <div class="probglightpink">
                                <h1 class="abooutprotxt">
                                    <?php echo wp_kses( $sec['sec_twocol_iltr_fields']['poprightttext'], 
                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                    'p' => array( 'class' => array() ), 'strong' => array(),
                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                    'b' => array( 'class' => array() ), 'class' => array() ) ); ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
	}
	if($sec['sec_type']==='twocol_irtl')
	{ 
		$ritimg = wp_get_attachment_url($sec['sec_twocol_irtl_fields']['poprimage']); 
		if ( ! empty( $ritimg ) || ! empty( $sec['sec_twocol_irtl_fields']['poplefttext'] ) ):
	?>
    	<section class="prodetailparaarea">
            <div class="container-fluid">
                <div class="container">
                    <div class="row proparaimgarea">
                        <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                            <div class="probglightpink">
                                <h1 class="abooutprotxt">
                                    <?php echo wp_kses( $sec['sec_twocol_irtl_fields']['poplefttext'], 
                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                    'p' => array( 'class' => array() ), 'strong' => array(),
                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                    'b' => array( 'class' => array() ), 'class' => array() ) ); ?>
                                </h1>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-md-6 col-12">
                            <img src="<?php echo esc_url( $ritimg ); ?>" class="prosubimg" alt="Shemb" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
	}
}
endif;
?>
    
    
    <?php
	$logo = wp_get_attachment_url($sec_pro['logo']); 
	if ( ! empty( $sec_pro['socialsec'] ) || ! empty( $logo ) || ! empty( $sec_pro['instaname'] ) || ! empty( $sec_pro['instaln'] ) || ! empty( $sec_pro['fbln'] ) ) :
	?>
    <section class="prownersocialarea ">
        <div class="container-fluid">
            <div class="container">
                <div class="probglight">
                    <div class="row  align-items-center justify-content-center ">
                        <div class="col-lg-3 col-md-3 col-sm-12 probrright proimgcenter">
                            <?php if ( ! empty( $logo ) ): ?>
                                <img src="<?php echo esc_url( $logo ); ?>" class="mainprologo" alt="Shemb"/>
                            <?php endif; ?>
                            <?php if ( ! empty( $sec_pro['instaname'] ) ): ?>
                                <span class="socialhandle"><?php echo esc_html( $sec_pro['instaname'] ); ?></span>
                            <?php endif; ?>
                            <?php if ( ! empty( $sec_pro['instaln'] ) || ! empty( $sec_pro['fbln'] ) ): ?>
                                <div class="prosclarea">
                                    <?php if ( ! empty( $sec_pro['instaln'] ) ): ?>
                                        <a href="<?php echo esc_url( $sec_pro['instaln'] ); ?>" target="_blank">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/proinstaicon.png" class="mainprosocialicon" alt="Shemb"/> </a>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $sec_pro['fbln'] ) ): ?>
                                        <a href="<?php echo esc_url( $sec_pro['fbln'] ); ?>" target="_blank">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/profbicon.png" class="mainprosocialicon" alt="Shemb"/> </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div class="row">
                                <?php if ( ! empty( $sec_pro['socialsec'] )) :
                                        foreach($sec_pro['socialsec'] as $box)
                                        { 
                                            $boximage = wp_get_attachment_url($box['simage']);
                                            if ( ! empty( $boximage ) ):
                                        ?>
                                            <div class="col-lg-4 col-md-4 col-sm-12 proimgcenter">
                                                <img src="<?php echo esc_url($boximage); ?>" class="profooterimgcircle" alt="Shemb"/>
                                            </div>
                                        <?php endif; ?>
                                <?php } endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;
endwhile; ?>
<?php
get_footer();
