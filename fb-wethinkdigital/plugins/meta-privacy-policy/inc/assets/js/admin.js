jQuery(document).ready(function () {

    //Added Preview Button
    var r = jQuery('<input type="button" name="fm-preview" id="fm-preview" class="button button-primary" value="Preview" />');
    jQuery("#fm-privacy_option_fields-0_form p.submit").append(r);

    //Added Shortcode Text
    var s = jQuery('<h3>Here is the Shortcode: [privacy-policy]. <BR>Note: if shortcode doesn\'t work, please use page template "Privacy Policy Plugin" </h3>');
    jQuery("#fm-privacy_option_fields-0_form").append(s);

    //Modal Form Preview
    
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("fm-preview");
    var close = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    }

    close.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

});