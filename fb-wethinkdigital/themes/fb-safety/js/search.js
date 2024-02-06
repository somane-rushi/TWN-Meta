/*****************
SEARCH SCRIPTS
*****************/
function fbsafety_search_results(query='', form='', input='', results='', ver='') {
  const ajaxurl  = fbsafety.ajaxurl;
  const security = fbsafety.security; 
  var $form      = jQuery(form);
  var $results   = jQuery(results);
  var paged      = parseInt(1);
  var $input     = $form.find(input);
  var version    = ver;
  var is_qlink = true;
  if ('' === query) {
    query    = $input.val();
    is_qlink = false;
  }
  var moduleid = jQuery('input[name=module]:checked', $form).val();
  if (undefined === moduleid) {
    moduleid = '';
  }
  if ('' !== query) {
    jQuery.ajax({
      type : 'post',
      url : ajaxurl,
      data : {
        action    : 'fbsafety_module_search',
        security  : security,
        paged     : paged,
        query     : query,
        version   : version,
        moduleid  : moduleid
      },
      beforeSend: function() {
        $results.css('opacity','0');
        if (false !== is_qlink) {
          $input.val( js__sanitize_text_field( query.replace('__',' ') ) );
        }
      },
      success : function(response) {
        setTimeout(function() {
          $results.css('opacity','1');
          $results.html(response).fadeIn(500);
          more_group_fade();
          s__load__more();
        }, 100);
        jQuery('html, body').animate({
          scrollTop: $results.offset().top - 50
        }, 100); 
      }
    }); 
  }
  return false;
}

function more_group_fade() {
  jQuery('.more--group').fadeOut(1);
}

function s__load__more() {
  jQuery('#s--load--more').click( function (e) {
    e.preventDefault();
    var num = jQuery(this).attr('data-num');
    jQuery('.more-group-' + num).fadeIn(750);
    var new_num = parseInt(num) + parseInt(1);
    if ( jQuery('.more-group-' + new_num)[0] ) {
      jQuery(this).attr('data-num', new_num);
    } else {
      jQuery(this).fadeOut(375);
    }
  });
}

function js__sanitize_text_field(string) {
  const map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#x27;',
      "/": '&#x2F;',
      "`": '&grave;',
  };
  const reg = /[&<>"'/]/ig;
  return string.replace(reg, (match)=>(map[match]));
}

function fbsafety_autocomplete(inp, arr) {

  var currentFocus;

  inp.addEventListener("input", function(e) {
    var a, b, i, val = this.value;
    closeAllLists();
    if (!val) { 
      return false; 
    }
    currentFocus = -1;
    a = document.createElement("div");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    this.parentNode.appendChild(a);
    for (i = 0; i < arr.length; i++) {
      if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        b = document.createElement("div");
        /*make the matching letters bold:*/
        b.innerHTML = arr[i].substr(0, val.length);
        b.innerHTML += arr[i].substr(val.length);
        var ninput = document.createElement("input");
        var att1   = document.createAttribute("type");
        att1.value = "hidden"; 
        ninput.setAttributeNode(att1); 
        var att2  = document.createAttribute("value");
        att2.value = arr[i];
        ninput.setAttributeNode(att2); 
        b.appendChild(ninput);
        b.addEventListener("click", function(e) {
          inp.value = this.getElementsByTagName("input")[0].value;
          closeAllLists();
        });
        a.appendChild(b);
      }
    }
  });
  
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }

  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }

  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    } 
  }

  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });

}
