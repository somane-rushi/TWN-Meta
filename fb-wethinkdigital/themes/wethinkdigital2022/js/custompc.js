function bindurl(val,url,txt)
{
	if(txt=='lang'){
		var furl= url+'languages='+val;
		location.href = furl;
	}
	if(txt=='county')
	{
		var furl= url+'countries='+val;
		location.href = furl;
	}
}
