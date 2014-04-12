<?php

	function initializeSession()
	{
		session_start();

		$_SESSION['timeout'] = 30;

		if (!isset($_COOKIE['connected']))
		{
			setcookie('connected', false, time() + $_SESSION['timeout']);
			$_SESSION['connected'] = false;
		}

		else 
		{
		 	setcookie('connected', $_COOKIE['connected'], time() + $_SESSION['timeout']);
		 	$_SESSION['connected'] = $_COOKIE['connected'];
		}

		if (isset($_POST['connection']) && $_POST['connection'])
		{
			authenticate($_POST['login'], $_POST['passwd']);

			unset($_POST['connection']);
		}

		else if (isset($_GET['disc']) && $_GET == true)
		{
			disconnect();

			unset($_GET['disc']);
		}
	}
	
	function authenticate($login, $passwd)
	{
		unset($_SESSION['login']);
		
		if (!isset($login) || $login == '')
		{
			$_SESSION['err_connection'] = true;
			$_SESSION['err_type'] = 'nologin';

			return false;
		}

		$_SESSION['login'] = $login;

		if (!isset($passwd) || $passwd == '')
		{
			$_SESSION['err_connection'] = true;
			$_SESSION['err_type'] = 'nopasswd';

			return false;
		}

		if ($login != 'Charcutier')
		{
			$_SESSION['err_connection'] = true;
			$_SESSION['err_type'] = 'uklogin';

			return false;
		}

		if ($passwd != 'saucisson')
		{
			$_SESSION['err_connection'] = true;
			$_SESSION['err_type'] = 'invpasswd';

			return false;
		}

		unset($_SESSION['err_connection']);

		setcookie('connected', true, time() + $_SESSION['timeout']);
		$_SESSION['connected'] = true;

		return true;
	}

	function disconnect()
	{
		setcookie('connected', false, time() + $_SESSION['timeout']);
		$_SESSION['connected'] =  false;
	}