function connect()
{
	var form = document.getElementById('connection_form');
	var error_div = document.getElementById('connection_error');
	var login = form.login;
	var passwd = form.passwd;

	var error = false;
	
	remove_class(login, 'error');
	remove_class(passwd, 'error');	
	error_div.style.visibility = 'hidden';

	if (!login.value)
	{
		login.className += 'error';
		error = true;
	}

	if (!passwd.value)
	{
		passwd.className += 'error';
		error = true;
	}

	if (error)
	{
		passwd.value = '';
		return;
	}

	var params = 'login=' + login.value + '&passwd=' + passwd.value;
	passwd.value = '';
	
	var callback = function(response) 
	{
		if (response === 'connected')
		{
			document.location.href = 'index.php';
		}

		else
		{
			error = response.replace('error:', '');

			if (error === 'unknownlogin')
			{
				error_div.innerHTML = 'L\'identifiant est inconnu';
			}

			else
			{
				error_div.innerHTML = 'Mot de passe invalide';
			}

			error_div.style.visibility = 'visible';
		}
	};

	ajax_request('js/ajax/connect.php', params, callback);
}