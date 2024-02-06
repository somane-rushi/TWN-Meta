<?php
/**
 * The template for displaying resource archive pages
 */

get_header();?>


<?php
	global $wp_query;
	$fields = get_option( "archive_partner", array() );
    $headbg = wp_get_attachment_url($fields['bg_image']);
	$category_query_var_name = 'country';
	$param_country = get_query_var( $category_query_var_name );
    $council = $fields['councillorsec'];
    $partner_sec = $fields['part_logo'];
     
	
?>
<?php if ( ! empty( $fields['banner_content'] ) || ! empty( $fields['mbanner_content'] ) ): ?>
<section>
    <div class="container-fluid bgWhite headerBanner paddingZero" style="background-image: url(<?php echo esc_url( $headbg ); ?>);">
        <div class="container dirRTL">
            <div class="newRow">
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 paddingZero">
                <?php if ( ! empty( $fields['banner_content'] ) ): ?>
                    <div class="headerTitle padding15">
                        <h1 class="txtWhite fontDisplay padding15 MarginBottomZero">
                            <?php echo wp_kses( $fields['banner_content'], array(
                            'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array()
                            ) ); ?>
                        </h1>
                    </div>
                <?php endif; 
                    if ( ! empty( $fields['mbanner_content'] ) ): ?>
                    <div class="headerTitleMob padding15 ">
                        <h3 class="txtWhite fontDisplay padding15 marginZero">
                            <?php echo wp_kses( $fields['mbanner_content'], array(
                            'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array()
                            ) ); ?>
                        </h3>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<section>
<div class="container-fluid bgWhite paddingZero">
    <div class="container">
    <div class="padding40">	
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <?php if ( ! empty( $fields['heading'] ) ): ?>
                    <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero dirRTL"><?php echo wp_kses_post( $fields['heading'] ); ?></h1>
                <?php endif; ?>
                <?php if ( ! empty( $fields['description'] ) ): ?>
                    <p class="fontTxt marginZero PaddingBottom40 font16 txtGrey dirRTL">
                        <?php echo wp_kses( $fields['description'], array(
                            'br' => array( 'class' => array() ), 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'title' => array(),'target' => array() ),'strong' => array()
                        ) ); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    
        <?php
		   $args = array(
		   'type'                     => 'partner',
		   'child_of'                 => 0,
		   'parent'                   => '',
		   'orderby'                  => 'name',
		   'order'                    => 'ASC',
		   'hide_empty'               => 1,
		   'hierarchical'             => 1,
		   'taxonomy'                 => 'country',
		   'pad_counts'               => false );
		   $categories = get_categories($args);
		   
		   $phead='Our partners from';
		   $pdrop='around the world';
		   if( !empty($fields['wtdparfilter']['par_head']) ){ $phead = $fields['wtdparfilter']['par_head']; }
		  if( !empty($fields['wtdparfilter']['par_drop']) ){ $pdrop = $fields['wtdparfilter']['par_drop']; }
	   ?>    

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="PaddingBottom40">
                    <ul class="nav navbar justify-content-center marginZero paddingZero dirRTL">
                    <?php if( !empty($fields['wtdparfilter']['par_head']) ) {?>
                        <li class="nav-item">
                            <p class="fontTxt txtGrey textCenter font24 marginZero "><?php echo esc_html( $phead ); ?></p>
                        </li>
                        <?php }
                         else { ?>
                        <li class="nav-item dropdown"> 
                        	<form method="GET" action="<?php echo esc_url( get_post_type_archive_link( 'partner' ) ); ?>" id="partner-fil" >
                                                          
								<span class="fontTxt txtGrey textCenter font24 marginZero " id="partner-sel"> &nbsp;<?php echo esc_html( $phead ); ?></span>
                                
                                <select name="country" class="form-select fontTxt font24 txtDarkBlue partnerDrop " aria-label="Default select example" data-onchangesubmit="true" id="partner-sel" onchange="this.form.submit()">
									<option value="" name="country"><?php echo esc_html( $pdrop ); ?></option>
                                    	<?php foreach ($categories as $category) {
											$url = get_term_link($category);?>
                                            <option <?php selected( $category->slug, $param_country, true ); ?> value="<?php echo esc_attr( $category->slug ); ?>" class="fontTxt font16 txtDarkBlue " name="country"><?php echo esc_html( $category->name); ?></option>
										<?php } ?>
								</select>
                               </form>                                      
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
            
        <div class="row TopBottomPadding40" id="content">
        <?php $morebtn='More Resources';
			if ( ! empty( $fields['wtdparfilter']['morebtn_par'] ) ): $morebtn = $fields['wtdparfilter']['morebtn_par']; endif;
		?>
        <p id="loadvalue" style="display:none;" >  <?php echo esc_html( $morebtn ); ?> </p>
        <?php 
         if ( ! empty( $fields['primary_country_id'] ) ){
            
            $args = array(
                'post_type' => 'partner' ,
                'orderby' => 'date' ,
                'order' => 'DESC' ,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'country',   // taxonomy name
                        'field' => 'tag_ID',           // term_id, slug or name
                        'terms' => $fields['primary_country_id'],                  // term id, term slug or term name
                    )
                )
               
                ); 
                
              $filter = new WP_Query($args);
            while ( $filter->have_posts() ) : $filter->the_post();
                     get_template_part( 'template-parts/content', get_post_type() );
                    endwhile; 
               }
            else{

        while ( have_posts() ) : the_post();
				 get_template_part( 'template-parts/content', get_post_type() );
				endwhile; 
            } ?>
        </div>
       
    </div>        
    </div><!--container-->                
</div>
</section><!--2-->
  <?php if ( ! empty( $council['councillor'] ) ):
					?>
<section>
    <div class="container-fluid bgWhite paddingZero">
        <div class="container">
        <div class="padding40">	
            <?php if( !empty($council['councillor_heading']) ) {?>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="PaddingBottom40">
                            <ul class="nav navbar justify-content-center marginZero paddingZero dirRTL">
                            
                                <li class="nav-item">
                                    <p class="fontTxt txtGrey textCenter font24 marginZero "><?php echo esc_html( $council['councillor_heading'] ); ?></p>
                                </li>
                            
                            </ul>
                        </div>
                    </div>
                </div>
            <?php  }?>    

            <div class="row TopBottomPadding40" id="content">
                 <?php  foreach ( $council['councillor'] as $councils ):
										$cimg = wp_get_attachment_url($councils['councillor_image']);
										
										
				    ?>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="partnerBox MarginBottom25">
                        <div class="row verticalAlign">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 paddingZero">
                                        <?php if ( ! empty( $cimg ) ): ?>
                                            
                                    <img src="<?php echo esc_url($cimg); ?>" class="imgPartner" />

                                            <?php endif;?>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                <?php $council_name = $councils['councillor_title'] ?>
                                <?php if ( ! empty( $council_name ) ): ?>
                                    <p class="font20 txtDarkBlue dirRTL fontDisplay marginZero"><?php echo esc_html( $council_name ); ?></p>
                                <?php endif; ?>    
                                <?php $council_designation = $councils['councillor_designation'] ?>
                                <?php if ( ! empty( $council_designation ) ): ?>
                                <p class="font14 txtGrey dirRTL fontTxt MarginBottom15"><?php echo esc_html( $council_designation ); ?></p>
                                <?php endif; ?>  
                                <p class="font16 txtGrey dirRTL fontTxt MarginBottom15"><?php echo wp_kses( $councils['councillor_desc'], array( 'br' => array() ) ); ?></p>
                            </div>
                        </div>
                    </div><!--1-->
                </div>
                <?php endforeach; ?>
               
            </div>
        
        </div>        
        </div><!--container-->                
    </div>
</section><!--3-->
<?php endif; ?>
    <!--New Partner Section-->   
<?php  if ( ! empty( $partner_sec ) ): ?>                                     
    <section>
        <div class="container-fluid bgWhite paddingZero">
            <div class="container">
                <div class="padding40">	
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h1 class="fontDisplay txtDarkBlue textCenter PaddingBottom40 marginZero dirRTL"><p class="marginZero"><?php echo wp_kses_post($fields['plogo_header']) ?></p></h1>
                        </div>    
                    </div><!--Row-->
                    <div class="row PaddingBottom40">
                       
                      <?php foreach($partner_sec as $partlogo){
                        $plogo = wp_get_attachment_url($partlogo['logo_img']);
                        ?> 
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                            <a href="<?php echo esc_url($partlogo['plogo_link']);?>" target="_blank"> 
                                <img src="<?php echo esc_url($plogo);?>" class="partnerLogoNew">
                            </a>
                            <p class="font14 txtGrey dirRTL fontTxt MarginBottom15 textCenter"><?php echo wp_kses_post($partlogo['p_title']); ?></p>
                        </div><!--Partner New #1-->
                       <?php } ?> 
                        
                    </div><!--Row-->
                </div>
            </div>
        </div><!--Container-->
    </section>
    <!--4-->
<?php endif;?>
   
<?php
get_footer();  ?>