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
		if (!isset($login) || $login == '')
		{
			$_SESSION['err_connection'] = 'Aucun identifiant n\'a &eacute;té entr&eacute;.';

			return false;
		}

		if (!isset($passwd) || $passwd == '')
		{
			$_SESSION['err_connection'] = 'Aucun mot de passe n\'a &eacute;té saisi.';

			return false;
		}

		if ($login != 'Charcutier')
		{
			$_SESSION['err_connection'] = 'L\'identifiant est invalide.';

			return false;
		}

		if ($passwd != 'saucisson')
		{
			$_SESSION['err_connection'] = 'Le mot de passe entr&eacute; est incorrect.';

			return false;
		}

		unset($_SESSION['err_connection']);

		setcookie('connected', true, time() + $_SESSION['timeout']);
		$_SESSION['connected'] = true;

		setcookie('login', $login, time() + 3600);

		return true;
	}

	function disconnect()
	{
		setcookie('connected', false, time() + $_SESSION['timeout']);
		$_SESSION['connected'] =  false;
	}