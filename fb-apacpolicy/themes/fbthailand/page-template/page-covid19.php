<?php
    /* Template Name: Thailand covid19 page */
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
                <!--Purvi: New Div and class added-->
                <h4 class="txtWhite scrollBoxVideoCovid  text-left"><?php echo wp_kses( $sectionfirst['description'], array(
                    'br' => array( 'class' => array() ),
                    'strong' => array(),
					'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
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
<?php $secthe = get_post_meta( get_the_ID(), 'sectiontwo', true ); 
    if ( ! empty( $secthe['bgimage'] ) || ! empty( $secthe['file'] ) || ! empty( $secthe['heading'] ) || ! empty( $secthe['description'] ) ): ?>
<section class="img-txt-section">
    <div class="container-fluid">
        <div class="row">
            <?php
			if ( ! empty( $secthe['file'] ) ){ 
				$vimg = wp_get_attachment_url($secthe['videoimage']);
                $video = wp_get_attachment_url($secthe['file']);
            ?>
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 videoBox bgBlack">
                	<div class="row">
                    	<video controls preload="none" poster="<?php echo esc_url($vimg) ?>">
                        	<source src="<?php echo esc_url($video) ?>" type="video/mp4">
                    	</video>
                    </div>
                </div>
            <?php }
                elseif ( ! empty( $secthe['bgimage'] ) ){
                $leftsideimage = wp_get_attachment_url($secthe['bgimage']);
                ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox mediaImgBG2" style="background-image: url('<?php echo esc_url($leftsideimage) ?>')">                		
                    </div>
            <?php } ?>                        
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightOrnage  mediaBox ">
                <div class="div70">
                   
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
        </div>
    </div>
    </div>
</section>
<?php endif; ?>
<?php $secfr = get_post_meta( get_the_ID(), 'sectionthree', true ); ?>
<?php if ( ! empty( $secfr['heading'] ) || ! empty( $secfr['heading'] ) || ! empty( $secfr['description'] ) ): ?>
<section class="full-txt bgWhite">
    <div class="container txtSectionFull">
        <div class="div80">            
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">                
                    <?php if ( ! empty( $secfr['heading'] ) ): ?>
                    <h1 class="txtGrey"><?php echo wp_kses_post( $secfr['heading'] ); ?></h1>
                    <?php endif; ?>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 txtGrey">
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
                        <a target="_blank" href="<?php echo esc_url( $secfr['btnlink']  ); ?>" class="txtGrey"><span class="fa fa-arrow-right txtGrey"></span><?php echo wp_kses_post( $secfr['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>            
        </div>
    </div>
</section>
<?php endif; ?>           
<?php $secseve = get_post_meta( get_the_ID(), 'sectionfour', true ); 
    if ( ! empty( $secseve['heading'] ) || ! empty( $secseve['description'] ) || ! empty( $secseve['bgimage'] ) ): 
    ?>
<section class="img-txt-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightPink mediaBox ">
                <div class="div70">
                    <?php if ( ! empty( $secseve['heading'] ) ): ?>
                    <h1 class="txtRed"><?php echo wp_kses_post( $secseve['heading'] ); ?></h1>
                    <?php endif; ?>
                    <div class="scrollBoxVideo">
                    <?php if ( ! empty( $secseve['description'] ) ): ?>
                    <p class="txtRed"><?php echo wp_kses( $secseve['description'], array(
                        'br' => array( 'class' => array() ),
                        'strong' => array(),
                        'p' => array( 'class' => array() ),
                        'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
                        ) ); ?></p>
                    <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $secseve['btntext'] ) ): ?>
                    <p class="txtRed2">                       					
                        <a target="_blank" href="<?php echo esc_url( $secseve['btnlink']  ); ?>" class="txtRed"><span class="fa fa-arrow-right txtRed"></span><?php echo wp_kses_post( $secseve['btntext'] ); ?></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                if ( ! empty( $secseve['bgimage'] ) ):
                
                $leftsideimage = wp_get_attachment_url($secseve['bgimage']);
                ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox  mediaImgBG2" style="background-image: url('<?php echo esc_url($leftsideimage) ?>')">	                		
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $secegt = get_post_meta( get_the_ID(), 'sectionfive', true ); 
    if ( ! empty( $secegt['bgimage'] ) || ! empty( $secegt['heading'] ) || ! empty( $secegt['description'] ) ):
    ?>
<section class="img-txt-section" id="unknownTogether">
    <div class="container-fluid">
        <div class="row">
            <?php if ( ! empty( $secegt['bgimage'] ) ):
                $leftsideimage = wp_get_attachment_url($secegt['bgimage']);
                ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mediaBox  mediaImgBG2" style="background-image: url('<?php echo esc_url($leftsideimage) ?>')">	                		
            </div>
            <?php endif; ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bgLightOrnage mediaBox ">
                <div class="div70">
                    <?php if ( ! empty( $secegt['heading'] ) ): ?>
                    <h1 class="txtRed"><?php echo wp_kses_post( $secegt['heading'] ); ?></h1>
                    <?php endif; ?>
                    <div class="txtRed scrollBoxVideo">
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
        </div>
    </div>
    </div>
    </div>
</section>
<?php endif; ?>
<?php $secsix = get_post_meta( get_the_ID(), 'sectionsix', true ); 
    if ( ! empty( $secsix['boxoneimage'] ) || ! empty( $secsix['boxoneheading'] ) || ! empty( $secsix['boxonedescription'] ) ):
    ?>
<section class="flip-section covid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flipBox flipBoxLeft">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <?php if ( ! empty( $secsix['boxoneimage'] ) ):
                            $boxoneimage = wp_get_attachment_url($secsix['boxoneimage']);
                            ?>
                        <div class="flip-card-front2 cvover1" style="background-image: url('<?php echo esc_url($boxoneimage) ?>')") >
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
                        <div class="flip-card-front2 cvover2" style="background-image: url('<?php echo esc_url($boxtwoimage) ?>')") >
                            <?php endif; ?>
                            <?php if ( ! empty( $secsix['boxtwoheading'] ) ): ?>
                            <h1 class="txtWhite2"><a  class="txtWhite"><span class="fa fa-arrow-right txtWhite"></span>
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
<?php endif; ?>
<?php
get_footer();