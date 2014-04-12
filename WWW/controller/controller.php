<?php

	/** Connection à la session **/
	include_once('controller/session.php');
	initializeSession();

	/** Connection à la base de données **/
	

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




