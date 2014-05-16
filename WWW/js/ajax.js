function ajax_request(url, params, callback, async)
{
	async = async === null ? true : async;

	var ajaxReq = new XMLHttpRequest();

	ajaxReq.onreadystatechange = function()
	{
		if (ajaxReq.readyState === 4 && (ajaxReq.status === 0 || ajaxReq.status === 200))
		{
			callback(ajaxReq.responseText);
		}
	}

	ajaxReq.open('POST', url, async);

	ajaxReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	if (params != null)
		ajaxReq.setRequestHeader('Content-length', params.length);
		
	ajaxReq.setRequestHeader('Connection', 'close');

	ajaxReq.send(params);
}