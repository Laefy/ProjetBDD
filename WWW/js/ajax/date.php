<?php

	include_once('../../model/db.php');

	$db = new Db();

	$today = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	$now = '\''.$today.' '.$_POST['time'].'\'';
	$tomorrow = mktime(0, 0, 0, $_POST['month'], $_POST['day'] + 1, $_POST['year']);
	$tomorrow = '\''.date('Y-m-d', $tomorrow).'\'';

	$date = $db->select_first_from('V_CONSULTATION', 'date', $now, $tomorrow);
		
	if ($date)
	{
		$hash = explode(' ', $date);
		$time = explode(':', $hash[1]);

		print($time[0].'h'.$time[1]);
	}

	else
	{
		print('false');
	}


