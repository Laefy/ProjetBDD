<?php

	include_once('../../model/db.php');
	include_once('../../model/select.php');

	function get_string_from_array($array)
	{
		$title = $array['title'];
		$id = $array['id'];
		$rows = '';
		$nf = 0;

		foreach ($array['columns'] as $key => $col) 
		{
			if ($nf)
				$rows .= '~#';

			if (gettype($col[0]) == 'string')
				$row = $key.'~/'.$col[1].'~/'.$col[0];

			$rows .= $row;
			$nf = 1;
		}

		$string = $title.'~~'.$id.'~~'.$rows;
		
		return $string;
	}

	$db = new Db();

	$section = $_POST['section'];
	$id = $_POST['id'];
	$type = $_POST['type'];

	switch ($section)
	{
		case 'consult':
			$array = get_details_consult($db, $type, $id);
			break;

		case 'directory':
			$array = get_details_client($db, $id);
			break;

		case 'register':
			$array = get_details_animal($db, $id);
			break;
	}

	if (!isset($array))
	{
		print('null');	
	}

	else
	{
		$string = get_string_from_array($array);
		print($string);
	}
