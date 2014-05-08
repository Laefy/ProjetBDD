function reload_page()
{
	document.location.href = 'index.php';
}

function head_page(section)
{
	ajax_request('js/ajax/head.php', 'section=' + section, reload_page);
}

function disconnect()
{
	ajax_request('js/ajax/disconnect.php', null, reload_page);
}

function clear_db()
{
	ajax_request('js/ajax/clear.php', null, reload_page);
}