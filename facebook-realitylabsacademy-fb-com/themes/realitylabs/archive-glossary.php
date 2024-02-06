<?php
/**
 * The template for displaying glossary archive pages
 */

get_header();
 
?>
<?php $arcfields = get_option( "archive_glossary", array() ); ?>
<section>
	<div class="container-full padding-top-lg padding-bottom-lg">
	</div>
</section>

<section>
	<div class="container-full" style="display: block;">
		<div class="divFullFlex">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 col-xx-12 sidePanelGrey padding-left-no padding-right-no padding-bottom-no">
            	<?php include get_template_directory().'/page-templates/sidebar-portal.php'; ?>
			</div>
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 col-xx-12 bgwhite padding-left-no padding-right-no">
				<div class="div100 padding-bottom padding-top">
                
                	<div class="padding-left padding-right dispBlock">
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12 col-xx-12">
                            <div class="dispBlock">
                            	<?php if ( ! empty( $arcfields['heading'] ) ): ?>
                                    <h1 class="fontXtraLight txtDarkGrey margin-bottom-lg margin-top-lg text-left">
                                    <?php echo wp_kses_post( $arcfields['heading'] ); ?> </h1>
                                <?php endif; ?>
                                <?php if ( ! empty( $arcfields['sortheading'] ) ): ?>							
                                <p class="margin-bottom-sm margin-top-sm txtDarkGrey fontLight font18"><?php echo wp_kses_post( $arcfields['sortheading'] ); ?></p>
                                <?php endif; ?>
                                
                            </div>
                            <div class="dispBlock">

                                <div class="div100 margin-bottom" id="af">
                                	<?php 
										$gcategory = glossary_category();
										if( !empty( $gcategory ) ) :
									?>
                                    	<?php 
										foreach ( $gcategory as $gcat ) 
										{ ?>
                                        	<div id="<?php echo esc_attr( $gcat->slug ); ?>">
                                                <h1 class="text-center margin-bottom-lg margin-top-lg fontXtraLight glossAlpha"><?php echo esc_html( $gcat->name ); ?></h1>
                                                <div class="table-responsive whiteBox margin-bottom-no margin-top-no">
                                                <table class="table" title="">
                                                    <thead>
                                                        <tr>
                                                            <th><p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font14 text-center">TERM</p></th>
                                                            <th><p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font14 text-center">DEFINITION OR USAGE</p></th>
                                                            <th><p class="margin-bottom-sm margin-top-sm txtDarkGrey fontXtraLight font14 text-center">ACRONYM</p></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    global $post;
													$gpost = glossary_post($gcat->term_id);
													while ( $gpost->have_posts() ) : $gpost->the_post();
													$glos = get_post_meta( get_the_ID(), 'glossarylist', true );
												
													?>
                                                    	<tr>
                                                            <td>
                                                                <p class="txtDarkGrey fontLight font16 text-center">
																<?php echo esc_html( $glos['gterm'] ); ?></p>
                                                            </td>
                                                            <td>
                                                                <div class="txtDarkGrey fontXtraLight font14 text-left">
																<?php echo wp_kses($glos['gdefinition'], array(
																		'sup' => array(), 'br' => array(), 
																		'p' => array( 'class' => array() ), 
																		'span' => array( 'class' => array() ), 
																		'strong' => array(),
																		'ul' => array( 'class' => array() ), 
																		'li' => array( 'class' => array() ), 
																		'style' => array(),
																		'a'   => array(
																			'href'   => array(), 'title'  => array(), 
																			'target' => array( '_blank' ),
																		),
																) ); ?></div>
                                                            </td>
                                                            <td>
                                                                <p class="txtDarkGrey fontXtraLight font14 text-center">
                                                                	<?php echo esc_html( $glos['gacronym'] ); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                    </tbody>
												</table>							
                                            	</div>
                                            </div>
										<?php } ?>
                                    <?php endif; ?>
                                    
								</div>
							</div> <!-- dispBlock -->
                            
						</div> <!-- lg-11 -->
					</div>
					<div class="padding-left padding-right dispBlock padding-bottom-no">
						<div class="div100">
							<div class="container-full">
								<div class="dotPatternContainer"> </div>
							</div>
						</div><!--end of Div100-->
					</div><!--Spacer-->
				</div><!--end of Div100-->
			
            </div><!--Dashboard Right-->
		</div>
	</div><!--container-full-->
</section><!--Full-->
            
            
            

<?php get_footer(); ?>