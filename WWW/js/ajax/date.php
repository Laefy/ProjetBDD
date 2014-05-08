<?php

	include_once('../../model/db.php');

	$db = new Db();

	$today = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	$now = $today.' '.$_POST['time'];
	$tomorrow = $today.' + 1';

	$date = $db->select_first_from('V_CONSULTATION', 'date', $now, $tomorrow);
		
	if ($date)
	{
		print(date('G\hi', $date));
	}

	else
	{
		print('false');
	}


