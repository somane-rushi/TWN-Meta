function bindurl(val,url,txt)
{
	if(txt=='lang'){
		var furl= url+'languages='+val;
		window.location = furl;
	}
	if(txt=='county')
	{
		var furl= url+'countries='+val;
		window.location = furl;
	}
}