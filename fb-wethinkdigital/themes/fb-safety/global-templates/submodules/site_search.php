<?php
/**
 * Submodule: SITE SEARCH (Top, Under Hero)
 * This section appears as part of PAGEFIELDS near the top of pages
 *
 * @package fbsafety
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( isset($args['sub_fields']) && !empty($args['sub_fields']) ) :
	$sub_fields = $args['sub_fields'];
	$site_search_toggle = fbsafety_fm_get_data($sub_fields, 'toggle');
	if ('1' === $site_search_toggle) :
    $global_fields = get_option('global_fields');
    $search_placeholder = (!empty(fbsafety_fm_get_data($global_fields, 'default_search_term'))) ? fbsafety_fm_get_data($global_fields, 'default_search_term') : 'Search';
    $quick_links_arr = array();
    $quicklinks_toggle = fbsafety_fm_get_data($sub_fields, 'quicklinks_toggle');
    if ('1' === $quicklinks_toggle) {
      $quicklinks_custom = fbsafety_fm_get_data($sub_fields, 'quicklinks_custom');
      if ('1' === $quicklinks_custom) {
        //get custom links specified in this specific use case
        $quicklinks = fbsafety_fm_get_data($sub_fields, 'quicklinks');
      } else {
        //get default links specified in Global Theme Settings
        $quicklinks    = fbsafety_fm_get_data($global_fields, 'quicklinks');
      }
    }
    if ( ! empty($quicklinks) ) {
      foreach ($quicklinks as $ql) {
        if ( ! empty($ql) ) {
          $quick_links_arr[] = $ql;
        }
      }
    }
?>

    <div class="page-search-wrap">
    	<div class="container">
        <div class="page-search-container">
          
          <form action="" id="global--search" method="post">
            <div class="search-tool">
                    	
              <input type="text" id="search--query" placeholder="<?php echo esc_attr($search_placeholder); ?>" autocomplete="off">
              
              <div class="search-tool-right autocomplete">
              	<div class="search-tool-dropdowns">
                  <!--<div class="search-tool-dropdowns-label floated-tab" dataId="language" >in any language</div>-->
                  <div class="search-tool-dropdowns-label floated-tab" dataId="module" >in any module</div>
                </div>	  
                <input id="search-submit" type="submit" value="Search">
                <input id="search-reset" type="reset" value="Clear">
              </div><!--../search-tool-right-->
              
              <!--
              <div class="search-tool-dropdowns-content floated-tab-panes" id="language">        	
                <div class="input-col">
                  <input type="radio" name="language">
                  <label>Language select</label>
                </div>
                <div class="input-col">
                  <input type="radio" name="language">
                  <label>Language select</label>
                </div>          
              </div>
              -->
                
              <div class="search-tool-dropdowns-content col-4 floated-tab-panes" id="module">

          <?php
              $modules = get_all_cpt_modules() ?: array();
              if ( ! empty($modules) ) :
                  foreach ($modules as $k => $v) :
          ?>
                  <div class="input-col">
                      <input type="radio" name="module" value="<?php echo esc_attr( $k ); ?>">
                      <label><?php echo esc_html( $v ); ?></label>
                  </div>

          <?php
                  endforeach;
              endif;
          ?>
                                  
              </div>
             
            </div><!--../search-tool-->
          </form>
         
      <?php
        if (! empty($quick_links_arr) ) :
      ?>
          <div class="quick-links-widget"> 
          	<div class="quick-links-widget-label">
              Quick Links:
            </div>
            <div class="quick-links-widget-list">
        <?php
          $i = 0;
          foreach ($quick_links_arr as $qlk) :
            $i++;
        ?>
                  <a href="<?php echo esc_url( get_permalink( $qlk ) ); ?>" class="a-quick-link-v2" id="aql<?php echo esc_attr( $i ); ?>" data-query="<?php echo esc_attr( str_replace( ' ', '__', strtolower($qlk) ) ); ?>"><?php echo esc_html( get_the_title( $qlk ) ); ?></a>
        <?php
          endforeach;
        ?>
            </div>  
          </div><!--../quick-links-widget-->
      <?php
        endif;
      ?>
          <div class="search-results" id="search--results"></div>
        </div><!--../page-search-container-->
      </div>

      <script>
      jQuery(document).on( 'submit', 'form#global--search', function(e) {
        e.preventDefault();
        fbsafety_search_results('', 'form#global--search', '#search--query', '#search--results', 'v1');
      });
      jQuery('form#global--search #search-submit').click( function(e) {
        e.preventDefault();
        fbsafety_search_results('', 'form#global--search', '#search--query', '#search--results', 'v1');
      });
      </script>

<?php
  if ( '1' === fbsafety_fm_get_data($global_fields, 'autocomplete_toggle') ) :
    $autocomplete_search_terms = fbsafety_fm_get_data($global_fields, 'autocomplete_search_terms');
    if ( ! empty($autocomplete_search_terms) ) :
      $search_terms_explode = array_map('trim', explode(',', $autocomplete_search_terms)) ?: array();
      if ( ! empty($search_terms_explode) ) :
?>
      <script>
        var the__list = JSON.parse( decodeURIComponent( '<?php echo rawurlencode( wp_json_encode($search_terms_explode ) ); ?>' ) );
        fbsafety_autocomplete(document.getElementById("search--query"), the__list);
      </script>
<?php
      endif;
    endif;
  endif;
?>
    </div><!--..page-search-wrap-->

<?php
	endif;//toggle
endif;//sub_fields
