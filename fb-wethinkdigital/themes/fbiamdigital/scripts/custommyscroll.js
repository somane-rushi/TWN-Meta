function scrollval(val)
{
	if(val === 'kenalpastiscam')
	{
		jQuery('html, body').animate({
			scrollTop: jQuery("#kenalpastiscam").offset().top
		 }, 500);
	}
	else if(val === 'semakdata')
	{
		jQuery('html, body').animate({
			scrollTop: jQuery("#semakdata").offset().top
		 }, 500);
	}
	else if(val === 'laporkanscam')
	{
		jQuery('html, body').animate({
			scrollTop: jQuery("#laporkanscam").offset().top
		 }, 500);
	}
	else if(val === 'tipskeselamatan')
	{
		jQuery('html, body').animate({
			scrollTop: jQuery("#tipskeselamatan").offset().top
		 }, 500);
	}
	else if(val === 'lankah')
	{
		jQuery('html, body').animate({
			scrollTop: jQuery("#lankah").offset().top
		 }, 500);
	}
}