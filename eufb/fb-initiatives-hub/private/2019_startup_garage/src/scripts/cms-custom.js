jQuery(document).ready(function($){

  function blockRename() {
    const blockGroups = $('.fm-blocks');
    blockGroups.each(function(){
      const label = 
        $(this)
          .find('.fm-group-label-wrapper > h4.fm-label')
          .first();
      const select = $(this).find('.fm-element');
      const selectValue = select.val();
      const selectValueCapitalized = 
        selectValue.charAt(0)
        .toUpperCase() + 
        selectValue.slice(1)
        .replace(/_/g, ' ');

      label.replaceWith(selectValueCapitalized);
    });
  }
  blockRename();

});