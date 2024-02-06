jQuery(function($){
	$('tr:has(.submitapprove)').css('background-color', '#FFFFE0');
	var option1 = jQuery( '<option>');
	option1.attr('value', 'wpau_bulk_approve');
	option1.text(wp_approve_user.approve);
	var option2 = jQuery( '<option>');
	option2.attr('value', 'wpau_bulk_unapprove');
	option2.text(wp_approve_user.unapprove);
	$('.actions select[name^="action"]').append(option2);
	$('.actions select[name^="action"]').append(option1);
});