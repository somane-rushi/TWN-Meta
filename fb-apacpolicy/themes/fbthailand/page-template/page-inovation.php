<?php
    /* Template Name: Thailand inovation page */
get_header();
?>
<?php $sectionfirst = get_post_meta( get_the_ID(), 'sectionfirst', true ); 
    if ( ! empty( $sectionfirst['bgimage'] ) ):
    
    	$bgimg = wp_get_attachment_url($sectionfirst['bgimage']); ?>
<section class="thai-main-section">
    <div class="container-fluid">
        <div class="row">
            <div class="comm-innov" style="background-image: url(<?php echo esc_url($bgimg) ?>)">
                <?php if ( ! empty( $sectionfirst['heading'] ) ): ?>
                <h1 class="txtWhite text-left"><?php echo wp_kses_post( $sectionfirst['heading'] ); ?></h1>
                <?php endif; ?>
                <?php if ( ! empty( $sectionfirst['description'] ) ): ?>
                <h4 class="txtWhite text-left"><?php echo wp_kses( $sectionfirst['description'], array(
                    'br' => array( 'class' => array() ),
                    'strong' => array(),
                    ) ); ?></h4>
                <?php endif; ?>
                <?php if ( ! empty( $sectionfirst['btntext'] ) ): ?>
                <p> <a target="_blank" href="<?php echo esc_url( $sectionfirst['btnlink']  ); ?>"><span class="fa fa-arrow-right"></span><?php echo wp_kses_post( $sectionfirst['btntext'] ); ?></a> </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $sectwo = get_post_meta( get_the_ID(), 'sectiontwo', true ); ?>
<section class="vid-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox bgBlack">
                <div class="row">
                    <?php
                        if ( ! empty( $sectwo['file'] ) ):
                        $vimg = wp_get_attachment_url($sectwo['videoimage']);
                        $video = wp_get_attachment_url($sectwo['file']);
                        ?>
                    <video controls preload="none" poster="<?php echo esc_url($vimg) ?>">
                        <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                    </video>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightRed videoBox">
                <div class="div80">
                    <?php if ( ! empty( $sectwo['heading'] ) ): ?>
                    <h1 class="txtRed"><?php echo wp_kses_post( $sectwo['heading'] ); ?></h1>
                    <?php endif; ?>
                    <div class="scrollBoxVideo txtRed">
                        <?php if ( ! empty( $sectwo['description'] ) ): ?>
                        <?php echo wp_kses( $sectwo['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
                            'p' => array( 'class' => array() ),
                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                            ) ); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $sectwo['btntext'] ) ): ?>
                    <p class="txtRed2">                       					
                        <a href="<?php echo esc_url( $sectwo['btnlink']  ); ?>" target="_blank" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $sectwo['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $secthe = get_post_meta( get_the_ID(), 'sectionthree', true ); ?>
<section class="img-txt-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightOrnage mediaBox ">
                <div class="div80">
                    <?php if ( ! empty( $secthe['heading'] ) ): ?>
                    <h1 class="txtRed"><?php echo wp_kses_post( $secthe['heading'] ); ?></h1>
                    <?php endif; ?>
                    <div class="scrollBoxVideo txtRed">
                        <?php if ( ! empty( $secthe['description'] ) ): ?>
                        <?php echo wp_kses( $secthe['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
                            'p' => array( 'class' => array() ),
                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                            ) ); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $secthe['btntext'] ) ): ?>
                    <p class="txtRed2">                       					
                        <a target="_blank" href="<?php echo esc_url( $secthe['btnlink']  ); ?>" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $secthe['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                if ( ! empty( $secthe['bgimage'] ) ){
                	$leftsideimage = wp_get_attachment_url($secthe['bgimage']);
            ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox  mediaImgBG2" style="background-image: url('<?php echo esc_url($leftsideimage) ?>')")	                		
                </div>
                <?php } elseif(! empty( $secthe['file'] ) ){ ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox bgBlack">
                    <div class="row">
                        <?php
                            if ( ! empty( $secthe['file'] ) ):
                            $vimg = wp_get_attachment_url($secthe['videoimage']);
                            $video = wp_get_attachment_url($secthe['file']);
                            ?>
                        <video controls preload="none" poster="<?php echo esc_url($vimg) ?>">
                            <source src="<?php echo esc_url($video) ?>" type="video/mp4">
                        </video>
                        <?php endif; ?>
                    </div>
                </div>
				<?php } ?>     
            </div>
    	</div>
    </div>
</section>

<?php $secfr = get_post_meta( get_the_ID(), 'sectionfour', true ); ?>
<section class="full-txt bgWhite ">
    <div class="container txtSectionFull">
        <div class="div80">
            
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                    <?php if ( ! empty( $secfr['heading'] ) ): ?>
                    <h1 class="txtGrey">
						<?php echo wp_kses( $secfr['heading'], array(
                        'br' => array( 'class' => array() ),
                        'strong' => array(),
                        'p' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?>
					</h1>
                    <?php endif; ?>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <?php if ( ! empty( $secfr['description'] ) ): ?>
                    <?php echo wp_kses( $secfr['description'], array(
                        'br' => array( 'class' => array() ),
                        'strong' => array(),
                        'p' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?>
                    <?php endif; ?>
                    <?php if ( ! empty( $secfr['btntext'] ) ): ?>
                    <p class="txtGrey2">
                        <a href="<?php echo esc_url( $secfr['btnlink']  ); ?>" target="_blank" class="txtGrey"><span class="fa fa-arrow-right txtGrey"></span><?php echo wp_kses_post( $secfr['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</section>


<?php $secfv = get_post_meta( get_the_ID(), 'sectionfive', true );
    if ( ! empty( $secfv['heading'] ) || ! empty( $secfv['description'] ) ): 
		$fvimage = wp_get_attachment_url($secfv['bgimage']);
?>
<section class="img-txt-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox mediaImgBG2" style="background-image:url('<?php echo esc_url($fvimage) ?>')">              		
        </div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightOrnage mediaBox ">
			<div class="div80">
            	<?php if ( ! empty( $secfv['heading'] ) ): ?>
                    <h1 class="txtRed"><?php echo wp_kses_post( $secfv['heading'] ); ?></h1>
                <?php endif; ?>
                <div class="scrollBoxVideo txtRed">
                	<?php if ( ! empty( $secfv['description'] ) ): ?>
                    <?php echo wp_kses( $secfv['description'], array(
                        'br' => array( 'class' => array() ),
                        'strong' => array(),
                        'p' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?>
                    <?php endif; ?>   
                </div>
                <?php if ( ! empty( $secfv['btntext'] ) ): ?>
                    <p class="txtRed2"> 
                        <a href="<?php echo esc_url( $secfv['btnlink'] ); ?>" target="_blank" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $secfv['btntext'] ); ?></a>
                    </p>
                <?php endif; ?>                
            </div>
    	</div>
	</div>
</section>
<?php endif; ?>

<?php $secsix = get_post_meta( get_the_ID(), 'sectionsix', true );?>
<section class="flip-section innovation">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flipBox flipBoxLeft">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <?php if ( ! empty( $secsix['boxoneimage'] ) ):
                            $boxoneimage = wp_get_attachment_url($secsix['boxoneimage']);
                            ?>
                        <div class="flip-card-front2" style="background-image: url('<?php echo esc_url($boxoneimage) ?>')") >
                            <?php endif; ?>
                            <?php if ( ! empty( $secsix['boxoneheading'] ) ): ?>
                            <h1 class="txtWhite2"><a class="txtWhite"><span class="fa fa-arrow-right txtWhite"></span>
                                <br/><?php echo wp_kses_post( $secsix['boxoneheading'] ); ?></a>
                            </h1>
                            <?php endif; ?>
                        </div>
                        <div class="flip-card-back2">
                            <?php if ( ! empty( $secsix['boxonedescription'] ) ): ?>
                            <?php echo wp_kses( $secsix['boxonedescription'], array(
                                'br' => array( 'class' => array() ),
                                'strong' => array(),
                                'h3' => array(),
                                'p' => array( 'class' => array() ),
                                'ul' => array( 'class' => array() ),
                                'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                ) ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flipBox flipBoxRight ">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <?php if ( ! empty( $secsix['boxtwoimage'] ) ):
                            $boxtwoimage = wp_get_attachment_url($secsix['boxtwoimage']);
                            ?>
                        <div class="flip-card-front2" style="background-image: url('<?php echo esc_url($boxtwoimage) ?>')") >
                            <?php endif; ?>
                            <?php if ( ! empty( $secsix['boxtwoheading'] ) ): ?>
                            <h1 class="txtWhite2"><a class="txtWhite"><span class="fa fa-arrow-right txtWhite"></span>
                                <br/><?php echo wp_kses_post( $secsix['boxtwoheading'] ); ?></a>
                            </h1>
                            <?php endif; ?>
                        </div>
                        <div class="flip-card-back2">
                            <?php if ( ! empty( $secsix['boxtwodescription'] ) ): ?>
                            <?php echo wp_kses( $secsix['boxtwodescription'], array(
                                'br' => array( 'class' => array() ),
                                'strong' => array(),
                                'h3' => array(),
                                'p' => array( 'class' => array() ),
                                'ul' => array( 'class' => array() ),
                                'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                                ) ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $secseve = get_post_meta( get_the_ID(), 'sectionseven', true ); ?>
<section class="img-txt-section">
    <div class="container-fluid">
        <div class="row">
            <?php
                if ( ! empty( $secseve['bgimage'] ) ):
                
                $leftsideimage = wp_get_attachment_url($secseve['bgimage']);
                ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox  mediaImgBG2" style="background-image: url('<?php echo esc_url($leftsideimage) ?>')">	                		
            </div>
            <?php endif; ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightRed mediaBox mediaBoxMagenta ">
                <div class="div70">
                    <?php if ( ! empty( $secseve['heading'] ) ): ?>
                    <h1 class="txtRed"><?php echo wp_kses_post( $secseve['heading'] ); ?></h1>
                    <?php endif; ?>
                    <div class="scrollBoxVideoSmall txtRed">
                    <?php if ( ! empty( $secseve['description'] ) ): ?>
                    <?php echo wp_kses( $secseve['description'], array(
                        'br' => array( 'class' => array() ),
                        'strong' => array(),
                        'p' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?>
                    <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $secseve['btntext'] ) ): ?>
                    <p class="txtRed2">                       					
                        <a target="_blank" href="<?php echo esc_url( $secseve['btnlink']  ); ?>" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $secseve['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php $secegt = get_post_meta( get_the_ID(), 'sectioneight', true ); ?>
<section class="img-txt-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightOrnage mediaBox mediaBoxMagenta ">
                <div class="div70">
                    <?php if ( ! empty( $secegt['heading'] ) ): ?>
                    <h1 class="txtRed"><?php echo wp_kses_post( $secegt['heading'] ); ?></h1>
                    <?php endif; ?>
                    <div class="scrollBoxVideoSmall txtRed">
                        <?php if ( ! empty( $secegt['description'] ) ): ?>
                        <?php echo wp_kses( $secegt['description'], array(
                            'br' => array( 'class' => array() ),
                            'strong' => array(),
                            'p' => array( 'class' => array() ),
                            'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                            ) ); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $secegt['btntext'] ) ): ?>
                    <p class="txtRed2">                       					
                        <a target="_blank" href="<?php echo esc_url( $secegt['btnlink']  ); ?>" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $secegt['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ( ! empty( $secegt['bgimage'] ) ):
                $leftsideimage = wp_get_attachment_url($secegt['bgimage']);
                ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox  mediaImgBG2" style="background-image: url('<?php echo esc_url($leftsideimage) ?>')">	                		
            </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
    </div>
</section>
<?php
get_footer();