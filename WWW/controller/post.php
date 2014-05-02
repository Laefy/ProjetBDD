<?php

	function process_post_connexion($session)
	{
		include_once('controller/session.php');
		$page = $session->get_page();

		if ($session->is_connected())
		{
			$session->disconnect();
		}

		$page->head('connection');
		$status = true;

		if (!isset($_POST['login']) || $_POST['login'] == '')
		{
			$page->set_status('nologin');
			$status = false;
		}

		else
		{
			$page->set_status('login', $_POST['login']);
		}

		if (!isset($_POST['passwd']) || $_POST['passwd'] == '')
		{
			$page->set_status('nopasswd');
			$status = false;
		}

		if ($status)
		{
			$session->authenticate($_POST['login'], $_POST['passwd']);
		}

		$session->set_page($page);
		return $session;
	}

	function process_post($session)
	{
		/** Tentative de connection **/
		if ($_POST['connection'])
		{
			process_post_connexion($session);
		}

		return $session;
	}

	
