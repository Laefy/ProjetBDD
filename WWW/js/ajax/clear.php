<?php

	include_once('../../model/db.php');
	
	session_start();
	
	$_SESSION['db']->clear();