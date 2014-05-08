<?php

	include_once('controller/session.php');
	include_once('model/db.php');
	include_once('controller/page.php');
	session_start();

	/** Initialisation de la session **/
	$session = new Session();
	$session->save();

	/** Si on est connecté à la session, on se connecte à la base de données **/
	if ($session->is_connected())
	{
		$db = new Db(true);
	}

	/** Ouverture de la page **/
	$page = new Page($session);
	$page->save();

	/** Affichage **/
	include('view/index.php');




