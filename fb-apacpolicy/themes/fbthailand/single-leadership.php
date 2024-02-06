<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thailand
 */

get_header();
?>

 <section class="blog-inner-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="blogHeader blogDarkRedBG">
                        <?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="main-post-div">
                <div class="single-page-post-heading">
                            <h1 class="txtWhite "><?php the_title(); ?></h1>
                            <?php endwhile; ?>
                            <?php $blogbtnsubt = get_post_meta( get_the_ID(), 'leadership_detail' , true );
									if ( ! empty( $blogbtnsubt['leader_subtitle'] ) ): ?>
									<h3 class="txtWhite"><?php echo wp_kses_post( $blogbtnsubt['leader_subtitle'] ); ?></h3>

									<?php endif; ?>	
                            <div class="flxarea">
                        <?php 
	$blogsubt = get_post_meta( get_the_ID(), 'leadership_detail' , true );
                                    if ( ! empty( $blogsubt['authorname'] ) ): ?>
    <h3 class="txtWhite"><?php echo wp_kses_post( $blogsubt['authorname'] ); ?></h3>
    <?php endif; ?>
   




    <?php $blogaut = get_post_meta( get_the_ID(), 'leadership_detail' , true );
                                    if ( ! empty( $blogaut['authorpost'] ) ): ?>
    <h3 class="txtWhite"><?php echo wp_kses_post( $blogaut['authorpost'] ); ?></h3>
    <?php endif; ?>
</div>
</div>
</div>
    
</div>
</div>
</section>


                <section class="blogContainer bgLightRed">

                <?php $blogcon = get_post_meta( get_the_ID(), 'leadership_detail' , true );
                                    if ( ! empty( $blogcon['description'] ) ): ?>

                     <div class="txtRed blogcontent">
                     <?php echo wp_kses( nl2br( get_post_meta( get_the_ID(), 'excerpt', true ) ), array( 'br' => array( 'class' => array() ) ) ); ?>
    
                     
                     <?php echo wp_kses_post( $blogcon['description'] ); ?></h3>
</div>

<?php endif; ?>	

							
                    	
							
            

<div class="container-fluid blogNav">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                            <p class="blogTxtMain pull-left text-left">  
                            <?php previous_post_link('%link', '<span class="fa fa-chevron-left blogTxtMain navIcon txtRed" style="margin-right:15px; font-size:16px;"></span> Previous'); ?>                     					
                               
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
                            <p class="blogTxtMain pull-right text-right">                       					
                            <?php next_post_link('%link', 'Next <span class="fa fa-chevron-right blogTxtMain navIcon txtRed" style="margin-left:15px; font-size:16px;"></span>'); ?>
</a>
                            </p>
                        </div>
                    </div>
                </div>
            
             
            </section>

          
               

