<?php

	/** Connection à la session **/
	include_once('controller/session.php');
	initializeSession();

	/** Connection à la base de données **/
	if ($_SESSION['connected'])
	{
		include_once('model/connection.php');
		$_SESSION['mysqli'] = connectdb();
	}

	/** Page demandée **/
	if (!$_SESSION['connected'])
	{
		$_SESSION['page'] = 'connection';
	}

	else if (!isset($_SESSION['page']) || $_SESSION['page'] = 'connection')
	{
		$_SESSION['page'] = 'accueil';
	}

	/** Affichage **/
	include('view/index.php');




