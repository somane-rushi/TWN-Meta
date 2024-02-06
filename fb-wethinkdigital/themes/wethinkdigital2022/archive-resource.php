<?php
/**
 * The template for displaying resource archive pages
 */

get_header();
?>
<?php $fields = get_option( "archive_resource", array() );
	$wtdbanner=$fields['wtdresource']; 
	if( !empty($wtdbanner) ):
		$bgimg = wp_get_attachment_url($wtdbanner['wtdres_bg']);
		if ( ! empty( $bgimg ) ):
		?>
        	<section>
                <div class="container-fluid paddingZero bgWhite headerBanner" style="background-image: url('<?php echo esc_url($bgimg) ?>');">
                    <div class="container dirRTL">
                        <div class="newRow">
                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">   
                            	<?php if ( ! empty( $wtdbanner['wtdres_head'] ) ): ?>                        
                                    <div class="headerTitle padding15 ">
                                        <h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                                        	<?php echo wp_kses( $wtdbanner['wtdres_head'], 
											array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
											'p' => array( 'class' => array() ),
											'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
											'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
											'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
											'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
											'strong' => array(), 'class' => array() ) ); ?>
										</h1>
                                    </div>
                                <?php endif; 
								if ( ! empty( $wtdbanner['wtdresm_head'] ) ):
								?>
                                    <div class="headerTitleMob padding15 ">
                                        <h3 class="txtWhite fontDisplay padding15 marginZero">
                                        	<?php echo wp_kses( $wtdbanner['wtdresm_head'], 
											array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
											'p' => array( 'class' => array() ),
											'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
											'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
											'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
											'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
											'strong' => array(), 'class' => array() ) ); ?>
                                        </h3>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
		<?php endif; 
		if ( ! empty( $wtdbanner['wtdres_weldesc'] ) ):?>
            <section class="">
                <div class="container-fluid bgWhite LeftRightPadding0">
                    <div class="container ">
                        <div class="padding40">
                            <div class="fontTxt marginZero paddingZero font16 txtGrey dirRTL">
                                <?php echo wp_kses( $wtdbanner['wtdres_weldesc'], 
										array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
										'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
										'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
										'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
										'a' => array('href' => array(),'title' => array(),'download' => array(),'target'=>array()),
										'b' => array('class' => array()),'div' => array( 'class' => array() ),
										'strong' => array(), 'class' => array() ) ); ?>
                            </div>
                        </div>                    
                    </div>              
                </div>
            </section>
        <?php endif; ?>
<?php endif; ?>
<?php $wtdres=$fields['wtdreslist'];
if ( ! empty( $wtdres ) ):
?>
<section>
	<div class="container-fluid bgLightGrey paddingZero">
    	<?php if ( ! empty( $wtdres['mainheading'] ) || ! empty( $wtdres['desc'] ) ): ?>
		<div class="container">
            <div class="padding40">	
                <?php if ( ! empty( $wtdres['mainheading'] ) ): ?>
                <h1 class="fontDisplay txtDarkBlue textCenter paddingZero marginZero dirRTL"><?php echo esc_html( $wtdres['mainheading'] ); ?></h1>
                <?php endif; 
                if ( ! empty( $wtdres['desc'] ) ):
                ?>
                    <div class="marginZero paddingZero dirRTL">
                        <?php echo wp_kses( $wtdres['desc'], 
                                array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
                                'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                'strong' => array(), 'class' => array() ) ); ?>                  
                    </div>
                <?php endif; ?>
            </div>
		</div>
        <?php endif;
		if ( ! empty( $wtdres['resources'] ) ): ?>
        <div class="container-fluid">
			<div class="row BottomPadding25 TopPaddingZero LeftRightPadding15 flip-justify-center flip-res">
            	<?php $i=1;
            	foreach($wtdres['resources'] as $box)
				{ 
					$boximage = wp_get_attachment_url($box['boximage']);
				?>
                    <div class="col col1 col-lg-2 col-md-6 col-sm-12 MarginBottom25">
                        <div class="digBox flipBox">
                            <div class="flipBox-inner">
                                <div class="flipBox-front bgGrey">
                                    <img src="<?php echo esc_url( $boximage ); ?>" class="img100 flipImg" />
                                    <p class="textCenter marginZero TopBottomPadding25 bgGrey txtWhite fontDisplay font18 dirRTL">
                                        <?php echo esc_html( $box['heading'] ); ?>
                                    </p>                                   
                                </div>
                                <div class="flipBox-back bgGrey">
                                    <div class="txtWhite padding25 text-left fontTxt font14">
                                        <p class="fontTxt font14 dirRTL">
                                            <?php echo wp_kses( $box['description'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) ); ?>
										</p>
                                        <?php
                                             if ( ! empty( $box['btn_text'] ) ): ?>
												<a class="txtWhiteLink text-left fontTxt TopBottomMargin15" data-toggle="modal" data-target="#modalPop<?php echo esc_html($i); ?>" > <?php echo esc_html( $box['btn_text'] ); ?></a>
										<?php endif; ?>
                                        
                                    </div>                                    
                                </div>
                            </div>                                
                        </div>
                    </div>
                    <div class="modal fade aboutmodal" id="modalPop<?php echo esc_html($i);; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body bgLightGrey">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="container">
                                        <div class="BottomPadding15">
                                            <?php if ( ! empty( $box['popheading'] ) ): ?>
                                                <h2 class="fontDisplay txtDarkBlue TopBottomPadding15 marginZero">
                                                    <?php echo esc_html( $box['popheading'] ); ?></h2>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $box['popdes'] ) ): ?>
                                                <?php echo wp_kses( $box['popdes'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) );
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++; } ?>
                
			</div>
		</div>
        <?php endif; ?>
	</div>
</section>
<?php endif; ?> 
  
<section>
	<div class="container-fluid bgWhite paddingZero" id="divcount">
		<div class="container">
            <div class="padding40">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-1 col-sm-12 paddingZero"></div>
                    <div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 paddingZero">
                        <?php if ( ! empty( $fields['wtdmreslist'] ) ):  $rl= $fields['wtdmreslist']; ?>
                            <h1 class="fontDisplay txtDarkBlue textCenter paddingZero marginZero dirRTL">
                                <?php echo wp_kses( $rl['wtdmres_head'], 
                                        array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                        'p' => array( 'class' => array() ), 'b' => array( 'class' => array() ),
                                        'strong' => array(), 'class' => array() ) );
                                ?>
                            </h1>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-1 col-sm-12 paddingZero"></div>
                </div>
            </div>
            <div class="PaddingBottom40">
            	<?php $morebtn='More Resources';
					if ( ! empty( $fields['morebtn_res'] ) ): $morebtn = $fields['morebtn_res']; endif;
				?>
            	<p id="loadvalue" style="display:none;" >  <?php echo esc_html( $morebtn ); ?> </p>
                <form class="o-media__body c-home-section__body" action="<?php echo esc_url( get_post_type_archive_link( 'resource' ) ); ?>">
                <?php $resources_archive_fields = get_option( 'archive_resource' );
				 
                if ( ! empty( $resources_archive_fields['jumbotron'] ) ) { 
					$aud='AUDIENCES';
		   			$topic='TOPICS';
					if( !empty($resources_archive_fields['wtdresfilter']['wtd_aud']) ){ $aud = $resources_archive_fields['wtdresfilter']['wtd_aud']; }
		   			if( !empty($resources_archive_fields['wtdresfilter']['wtd_topic']) ){ $topic = $resources_archive_fields['wtdresfilter']['wtd_topic']; }
					
				?>
                    <div class="row padding40-resource justify-content-md-center">
                    	<?php wethinkdigital2022_the_resources_filter_options($aud,$topic); ?>
                    </div>
                    
                    <?php if ( have_posts() ) : ?>
                    <div class="row paddingZero resContent" id="content">
                        <?php
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/content', get_post_type() );
                        endwhile;
                        ?>
                    </div>
                    <?php else: 
                        if ( ! empty( get_query_var( 'topic' ) ) || ! empty( get_query_var( 'audience' ) ) ):
                            $suggested_resources_query = wethinkdigital2022_get_suggested_resources();
                            if ( $suggested_resources_query->have_posts() ) :
                    ?>
                                <div class="row paddingZero" id="content">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mobDispNone">
                                    <h4 class="fontDisplay txtDarkBlue textCenter TopBottomPadding15 marginZero">
                                        <?php esc_html_e( 'We\'re working on adding more resources in this section.', 'wethinkdigital2022' ); ?>
                                    </h4>
                                    <p>
                                        <?php esc_html_e( 'Explore other popular resources today.', 'fbiamdigital' ); ?>
                                    </p>
                                    </div>
                                </div>
                                
                                <div class="row paddingZero" id="content">

                                    <?php
                                    while ( $suggested_resources_query->have_posts() ) : $suggested_resources_query->the_post();
                                        get_template_part( 'template-parts/content', 'resource' );
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                                
                    <?php 
                            endif;
                        endif;
                    
                    endif; ?>
                <?php } ?>
                </form>
            </div>    
		</div><!-- container -->
	</div>
</section>
<?php $wtdfaq=$fields['wtdfaq'];
if ( ! empty( $wtdfaq ) ):
?>
<section>
	<div class="container-fluid bgWhite paddingZero">
		<div class="container">
            <div class="padding40">            
                <?php if ( ! empty( $wtdfaq['title'] ) ): ?>
                    <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero dirRTL"><?php echo esc_html( $wtdfaq['title'] ); ?></h1>
                <?php endif; 
                if ( ! empty( $wtdfaq['addfaq'] ) ): 
                    foreach($wtdfaq['addfaq'] as $fa)
                    { 
                        if ( ! empty( $fa['que'] ) || ! empty( $fa['ans'] ) ): ?>
                        <div class="row marginZero">                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 paddingZero">
                                    <div class="paddingZero">
                                        <?php if ( ! empty( $fa['que'] ) ) : ?>
                                            <p class="font24 txtDarkBlue dirRTL fontDisplay MarginBottom15">
                                            <?php echo esc_html( $fa['que'] ); ?></p>
                                        <?php endif; if ( ! empty( $fa['ans'] ) ) : ?>
                                            <div class="font16 txtGrey dirRTL fontTxt MarginBottom35">
                                                <?php
                                                    echo wp_kses( $fa['ans'], 
                                                    array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
                                                    'p' => array( 'class' => array() ), 'h1' => array( 'class' => array() ),
                                                    'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
                                                    'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
                                                    'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
                                                    'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
                                                    'strong' => array(), 'class' => array() ) );
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>                              
                                </div>                                  
                            </div>
                <?php endif; } endif; ?>
            </div>
		</div>
	</div>
</section>
<?php endif; ?>

  
<?php
get_footer();
if ( ! empty( get_query_var( 'topic' ) ) || ! empty( get_query_var( 'audience' ) ) ){
	?>
    	<script>
			jQuery(document).ready(function (){
				jQuery('html, body').animate({
					scrollTop: jQuery("#divcount").offset().top
				}, 1000);                
			});
		</script>
    <?php
}
?>

<script type="text/javascript">
	jQuery(function() {
		jQuery('#topic').change(function() {
			this.form.submit();
		});
		jQuery('#audience').change(function() {
			this.form.submit();
		});
	});
</script>
<script>
$(document).on('hidden.bs.modal','.aboutmodal', function (event) {
	$('video').trigger('pause');
});
</script>





