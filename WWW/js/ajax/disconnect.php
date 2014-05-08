<?php

	include_once('../../controller/session.php');

	session_start();
	
	$_SESSION['session']->disconnect();
	$_SESSION['session']->save();

