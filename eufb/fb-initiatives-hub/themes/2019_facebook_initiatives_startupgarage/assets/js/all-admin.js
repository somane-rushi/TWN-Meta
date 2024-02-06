'use strict';

(function () {
  'use strict';

  jQuery(document).ready(function ($) {

    function blockRename() {
      var blockGroups = $('.fm-blocks');
      blockGroups.each(function () {
        var label = $(this).find('.fm-group-label-wrapper > h4.fm-label').first();
        var select = $(this).find('.fm-element');
        var selectValue = select.val();
        var selectValueCapitalized = selectValue.charAt(0).toUpperCase() + selectValue.slice(1).replace(/_/g, ' ');

        label.replaceWith(selectValueCapitalized);
      });
    }
    blockRename();
  });
})();
//# sourceMappingURL=all-admin.js.map
