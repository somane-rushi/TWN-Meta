<?php
/**
 * Submodule: SITE SEARCH V2
 * This section appears as part of BOTTOMFIELDS near the bottom of pages
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
    $default_search_title = fbsafety_fm_get_data($global_fields, 'default_search_title');
    $search_title         = ( !empty( $default_search_title ) ) ? $default_search_title : 'Search Digital Tayo';
?>

<section class="bottom-search">
  <div class="container">
    <div class="row">

      <h2>
        <?php echo esc_html( $search_title ); ?>
      </h2>

      <div class="page-search-wrap">
        <div class="container">

          <div class="page-search-container">

            <form action="" id="bottom--search" method="post">
                
              <div class="search-tool autocomplete">
                <input type="text" id="search--query-b" placeholder="<?php echo esc_attr($search_placeholder); ?>" autocomplete="off">
                <div class="search-tool-right module-search-tool">
                  <div class="search-tool-dropdowns">
                    <!--<div class="search-tool-dropdowns-label floated-tab" dataId="language" >in any language</div>-->
                    <div class="search-tool-dropdowns-label floated-tab" dataId="module" >in any module</div>
                  </div> 
                  <input id="search-submit-b" type="submit" value="Search">
                  <input id="search-reset-b" type="reset" value="Clear">
                </div>
                  
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
                                <input type="radio" class="checkbox" name="module" value="<?php echo esc_attr( $k ); ?>">
                                <label><?php echo esc_html( $v ); ?></label>
                            </div>

                    <?php
                        endforeach;
                      endif;
                    ?>              
                    </div>
                        
                  </div><!--../search-tool-->
                  
              </form>
                                  
          </div><!--../page-search-container-->
        </div>
      </div><!--../page-container-wrap-->
    </div>
  </div>

  <script>
  jQuery(document).on( 'submit', 'form#bottom--search', function(e) {
    e.preventDefault();
    fbsafety_search_results('', 'form#bottom--search', '#search--query-b', '#search--results-b', 'v2');
  });
  jQuery('form#bottom--search #search-submit-b').click( function(e) {
    e.preventDefault();
    fbsafety_search_results('', 'form#bottom--search', '#search--query-b', '#search--results-b', 'v2');
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
        var the__list_b = JSON.parse( decodeURIComponent( '<?php echo rawurlencode( wp_json_encode($search_terms_explode ) ); ?>' ) );
        fbsafety_autocomplete(document.getElementById("search--query-b"), the__list_b);
      </script>
<?php
      endif;
    endif;
  endif;
?>

</section><!--../bottom search-->

<div class="container small">
  <div class="row">
    <div class="search-results" id="search--results-b"></div>
  </div>
</div>

<?php
	endif;//toggle
endif;//sub_fields
