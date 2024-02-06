/*****************
ADMIN-ONLY SCRIPTS
*****************/
jQuery(document).ready(
  function ($) {

    //don't show fm custom fields on new modules until saved
    function noDisplayFmNewPost() {
      if ( $('.post-new-php.post-type-module')[0] ) {
        $("[id^=fm_meta_box]").hide();
      }
    }
    noDisplayFmNewPost();

    //don't show 'menu order' page attributre on cpt => module
    function noMenuOrderCPTModule() {
      if ( $( '.post-type-module' )[0] ) {
        $( '#pageparentdiv .menu-order-label-wrapper' ).hide();
        $( '#pageparentdiv #menu_order' ).hide();
      } 
    }
    noMenuOrderCPTModule();

    //don't show Parent Module FM fields on Module Child pages
    function noDisplayFmChildPosts() {
      if ( $( '.post-type-module' )[0] ) {
        if ( '' !== $( '#pageparentdiv #parent_id' ).val() ) {
          $("[id^=fm_meta_box]").hide(); 
        }
      }
    }
    noDisplayFmChildPosts();

    //don't show main Editor on Module Parent pages
    function noDisplayEditorModuleParent() {
      if ( $( '.post-type-module' )[0] ) {
        if ( '' == $( '#pageparentdiv #parent_id' ).val() ) {
          $("#postdivrich").hide(); 
        }
      }
    }
    noDisplayEditorModuleParent();

    //don't show main Editor on Standard Pages
    function noDisplayEditorPages() {
      if ( $( '.post-type-page' )[0] ) {
        if ( '' == $( '#pageparentdiv #parent_id' ).val() ) {
          $("#postdivrich").hide(); 
        }
      }
    }
    noDisplayEditorPages();

    //rename FIELDMANAGER groups separately in wp-admin
    function fmfieldsFmRename(which) {
      if ( $('#fm_meta_box_' + which)[0] ) {
        var name_arr = ['.fm-' + which];
        $.each(name_arr, function(index, value) {
          var blockGroups = $(value);
          blockGroups.each(function () {
            var label     = $(this).find('.fm-group-label-wrapper > h4.fm-label').first();
            var option    = $(this).find('.fm-element option:selected').first();
            var newLabel  = option.text();
            $(label).text(newLabel);
          });
        });
      }
    }

    // cpt module (main) fields
    fmfieldsFmRename('mainfields');

    // cpt module (bottom) fields
    fmfieldsFmRename('bottomfields');

    // cpt video fields
    fmfieldsFmRename('videofields');

    //rename PAGE FM groups separately in wp-admin
    function pageFmRename() {
      if ( $('#fm_meta_box_pagefields')[0] ) {
        var name_arr = ['.fm-pagefields'];
        $.each(name_arr, function(index, value) {
          var blockGroups = $(value);
          blockGroups.each(function () {
            var label     = $(this).find('.fm-group-label-wrapper > h4.fm-label').first();
            var option    = $(this).find('.fm-element option:selected').first();
            var newLabel  = option.text();
            var xtraLabel = $(this).find('input[id*=page_content_collapsable-0-title-0]').val();
            if (undefined !== xtraLabel && '' !== xtraLabel) {
              xtraLabel = ' [' + xtraLabel + ']';
            }
            $(label).text(newLabel + xtraLabel);
          });
        });
      }
    }
    pageFmRename();

    //rename lessons FM groups separately in wp-admin
    function lessonsFmRename() {
      if ( $('#fm_meta_box_lessons')[0] ) {
        var name_arr = ['.fm-lessons'];
        $.each(name_arr, function(index, value) {
          var blockGroups = $(value);
          blockGroups.each(function () {
            var label       = $(this).find('.fm-group-label-wrapper > h4.fm-label').first();
            var select      = $(this).find('.fm-element');
            var selectVal   = select.val();
            var selectValUc = selectVal.charAt(0).toUpperCase() + selectVal.slice(1).replace(/_/g, ' ');
            var actualTitle = '';
            var actualTitle = $(this).find('input[id*=lesson-0-heading-0]').val();
            if (undefined === actualTitle) {
              actualTitle = $(this).find('select[id*=lesson-0-lesson_id-0]').find(":selected").text();
            }
            if (undefined === actualTitle) {
              actualTitle = '';
            }
            var newLabel = '[' + selectValUc + '] ' + actualTitle;
            if ( '' === selectVal ) {
              newLabel = '';
            }
            $(label).text(newLabel);
          });
        });
      }
    }
    lessonsFmRename();

    //add unique IDs to lessons if empty
    function lessons_UniqueIDs() {
      if ( $('.post-php.post-type-module')[0] ) {
        if ( $('#fm_meta_box_lessons')[0] ) {
          $('.fm-element').change( function(){
            $('input[id$=-uqid-0]').each(function(){
              var this_id     = $(this).attr('id');
              var heading_id  = this_id.replace('uqid', 'heading');
              var heading_val = $('#' + heading_id).val();
              var clean_key   = heading_val.replace(/[^a-zA-Z0-9 ]/g, '');
              var final_key   = clean_key.replace(/\s+/g, '-').toLowerCase();
              $( '#' + this_id ).val( final_key );
            });
          });
        }
      }
    }
    lessons_UniqueIDs();

	}
);