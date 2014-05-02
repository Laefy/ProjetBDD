<?php

	/** Initialisation de la session **/
	include_once('controller/session.php');
	$session = new Session();

	/** Traitement POST **/
	include_once('controller/post.php');
	$session = process_post($session);

	/** Traitement GET **/
	include_once('controller/get.php');
	$session = process_get($session);

	/** Redirection **/
	include_once('controller/reheading.php');
	$session = process_reheading($session);

	/** On enregistre l'état de la session avant d'afficher la page **/
	$session->save();
	$page = $session->get_page();

	/** Mise à jour des informations à afficher sur la page **/
	include_once('controller/page.php');
	$page->update($session);

	/** Affichage **/
	include('view/index.php');




