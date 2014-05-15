function skip_nav()
{
	var nav = document.getElementsByTagName('nav')[0];
	var scroll = nav.getBoundingClientRect().bottom + window.pageYOffset;
	window.scrollTo(0, scroll);
}

function resize_content()
{
	var content = document.getElementById('content');
	var nav = document.getElementsByTagName('nav')[0];
	var hwin = window.innerHeight;
	var offset = nav.getBoundingClientRect().bottom + window.pageYOffset;
	var hcontent = content.offsetHeight;

	if (hcontent < hwin + offset)
	{
		var newh = hwin + offset;
		content.style.minHeight = newh + 'px';
	}
}