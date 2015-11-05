function changePage(pageName, url)
{
	if(url.indexOf("?") == -1)
	{
		url += "?page=" + pageName;
	}
	else
	{
		url += "&page=" + pageName;
	}
	location.href = url;
	
	
}