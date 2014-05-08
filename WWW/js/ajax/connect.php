<?php

	include_once('../../controller/session.php');

	session_start();

	$status = $_SESSION['session']->authenticate($_POST['login'], $_POST['passwd']);

	if (!$status['out'])
	{
		if ($status['error'] == 'unknownlogin')
		{
			print('error:unknownlogin');
		}

		else
		{
			print('error:invalidpasswd');
		}
	}

	else
	{
		print('connected');
	}

	$_SESSION['session']->save();

	
