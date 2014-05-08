<?php

	include_once('../../controller/page.php');

	session_start();

	$_SESSION['page']->head($_POST['section']);
	$_SESSION['page']->save();
