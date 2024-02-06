jQuery(document).ready(
  function ($) {

  	//only show lookback fm fields on page-lookback
  	if ( $('body.post-type-page')[0] ) {
  		if ( $('#page_template')[0] ) {
  			if ( $('#page_template').find(':selected').val() !== 'lookback/page-lookback.php' ) {
  				$('#fm_meta_box_lookback_page_fields').hide();
  			}
  		}
		}

	}
);