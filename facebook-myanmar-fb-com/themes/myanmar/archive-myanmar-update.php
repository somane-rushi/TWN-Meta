<?php
/**
 * The template for displaying myanmar update archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package myanmar
 */

get_header();
	
?>
<?php $fields = get_option( "archive_myanmar-update", array() ); ?>
<?php if ( ! empty( $fields['image'] ) ): 
	$bgimg = wp_get_attachment_url($fields['image']); ?>
	<section>
            <div class="container-fluid paddingZero bgWhite headerBanner verticalAlign" style="background-image: url(<?php echo esc_url($bgimg) ?>);">
                <div class="container">                    
                    <div class="newRow">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 paddingZero">                        
                            <div class="headerTitle padding15 ">
                                <?php if ( ! empty( $fields['title'] ) ): ?>
                                	<h1 class="txtWhite fontDisplay txtWhite marginZero">
										<?php echo wp_kses_post( $fields['title'] ); ?></h1>
								<?php endif; ?>
                            </div>                        
                        </div>    
                    </div>
                </div>                
            </div>
	</section>
<?php endif; ?>
<?php if ( ! empty( $fields['desc'] ) ): ?>
	<section>
		<div class="container-fluid bgWhite LeftRightPadding0">
			<div class="container">  
				<div class="padding40">
					<h1 class="fontDisplay txtDarkBlue textLeft paddingZero marginZero">
                    	<?php echo wp_kses( $fields['desc'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ), 'class' => array() ) ); ?>
                    </h1>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php
	$news = getnews_post(); 
	if ( $news->have_posts() ) { $i=1;
		echo '<div class="container-fluid bgWhite LeftRightPadding0 PaddingBottom40">';
		while ( $news->have_posts() )
		{
			$news->the_post();
			$news_cf = get_post_meta( get_the_ID(), 'newsup' , true );
			$newsimg ='';
			if( !empty($news_cf) ){
				foreach($news_cf as $key=>$val)
				{
					if ($key==='simage'){ $newsimg = wp_get_attachment_url($val); }
					if ($key==='sdescription'){ $desc =$val; }
					if ($key==='btntext'){ $btntext = $val; }
				}
			}
			?>
            <div class="row marginZero newsDiv" id="news<?php echo esc_html(get_the_ID()); ?>">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 paddingZero bgBlue">
                	<?php if ( ! empty( $newsimg ) ): ?>
						<img src="<?php echo esc_url( $newsimg ); ?>" alt="myanmar" class="TopBottomPadding50 newsIcon" />
                    <?php endif; ?>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 paddingZero bgWhite">
					<div class="padding40">
						<h2 class="fontTxt MarginBottom25 paddingZero txtGrey textLeft"><?php echo wp_kses_post(the_title()); ?></h2>              
                        <?php 
							if ( ! empty( $desc ) ):
							echo wp_kses( $desc, 
								array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
								'h2' => array( 'class' => array() ), 'h3' => array( 'class' => array() ), 
								'ul' => array( 'class' => array() ), 'li' => array( 'class' => array() ),
								'a' => array( 'href' => array(), 'title' => array(),'download' => array(),'target' => array() ),
								'b' => array( 'class' => array() ), 'div' => array( 'class' => array() ),
								'strong' => array(), 'p' => array( 'class' => array() ), 'class' => array() ) );
							endif;
							if ( ! empty( $btntext ) ):
							?>   
                        <p><a data-toggle="modal" data-target="#newsPop<?php echo esc_html($i); ?>" class="fontTxt PaddingBottom5 MarginBottom25 font16 textLeft txtMetaBlue"><?php echo wp_kses_post($btntext); ?></a></p> <?php endif; ?>
					</div>
				</div>
                <?php $newspop = get_post_meta( get_the_ID(), 'newspopup' , true ); ?>
                <div class="modal fade aboutmodal" id="newsPop<?php echo esc_html($i);?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body bgLightGrey">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="container">
                                    <div class="BottomPadding15">
                                    <?php
									if(!empty( $newspop['popupblocks'] )) {
										foreach($newspop['popupblocks'] as $block)
										{ 
											if($block['sec_type']==='fullheading')
											{
												if( !empty( $block['sec_fullheading_fields']['popfullheading'] ) ) {
										?>
											<h2 class="fontDisplay txtDarkBlue TopBottomPadding15 marginZero">
												<?php echo wp_kses( $block['sec_fullheading_fields']['popfullheading'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array() ) ); ?>
											</h2>
											<?php } } 
											if($block['sec_type']==='fulltext')
											{ 
												if( !empty( $block['sec_fulltext_fields']['popfulltext'] ) ) {
											?>
												<?php echo wp_kses( $block['sec_fulltext_fields']['popfulltext'], array( 'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array(), 'p' => array( 'class' => array() ) ) ); ?>
											<?php } } ?>
										<?php } 
									}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            
            
            <?php $i++; 
		} wp_reset_postdata();
		echo '</div>';
	}
?>

                    	
<?php
get_footer();
?>

