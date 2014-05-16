<?php

	include_once('../../model/db.php');
	include_once('../../model/insert.php');

	function get_array_from_string($string)
	{
		$array = explode('~~', $string);

		foreach ($array as $row) 
		{
			$str = explode('~#', $row);
			$array[$str[0]] = $str[1];
		}

		return $array;
	}

	$db = new Db();

	$section = $_POST['section'];
	$rowsStr = $_POST['rows'];

	$rows = get_array_from_string($rowsStr);

	switch ($section)
	{
		case 'consult':
			insert_consultation($db, $rows);
			break;

		case 'register':
		case 'animal':
			insert_animal($db, $rows);
			break;

		case 'client':
		case 'directory':
			$array = insert_client($db, $rows);
			break;

		case 'traitement':
			$array = insert_traitement($db, $rows);
			break;

		case 'soins':
			$array = insert_soins($db, $rows);
			break;
	}

