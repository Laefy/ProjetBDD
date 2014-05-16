<?php

	include_once('../../model/db.php');
	include_once('../../model/select.php');

	$db = new Db();
	
	function get_string_from_array($array)
	{
		$title = isset($array['title']) ? $array['title'] : '';

		foreach ($array['columns'] as $key => $column) 
		{
			if ($key > 0)
				$columns .= '~*';

			$columns .= $column;
		}

		foreach ($array['rows'] as $keyR => $row) 
		{
			if ($keyR > 0)
				$rows .= '~|';

			else
				$rows .= '~/';

			foreach ($row as $keyC => $col) 
			{
				if ($keyC > 0)
					$rows .= '~*';

				$rows .= $col;
			}
		}

		$string = $title.'~/'.$columns.$rows;
		
		return $string;
	}

	function get_null_response($section, $type)
	{
		switch ($section)
		{
			case 'consult':
				return 'Le registre des consultations ne contient aucune entrée concernant les consultations '.($type == 'former' ? 'passées' : 'à venir').'.';

			case 'directory':
				return 'L\'annuaire des '.($type == 'part' ? 'particuliers' : 'professionels').' est vide (il va falloir penser à vous faire des amis).';

			case 'register':
				return 'Aucun animal n\'est référencé pour le moment.';

			default:
				return 'En construction.';
		}
	}

	$section = $_POST['section'];
	$type = $_POST['type'];

	switch ($section)
	{
		case 'consult':
			$array = $type == 'former' ? get_table_formerconsult($db, 'date') : get_table_nextconsult($db, 'date');
			break;

		case 'directory':
			$array = $type == 'part' ? get_table_partdirectory($db, 'nom') : get_table_entrdirectory($db, 'nom');
			break;

		case 'register':
			$array = get_table_register($db, 'V_ESPECE.libelle');
			break;

		case 'prescript':
			$array = get_table_prescript($db);
			break;

		case 'accounting':
			$array = get_table_accounting($db);
			break;

		case 'stock':
			$array = get_table_stock($db);
			break;

		default:
			print('null'.'~~'.'La page demandée n\'a pas été trouvée !');
			break;
	}

	if (isset($array))
	{
		if (count($array['rows']) > 0)
		{
			$response = get_string_from_array($array);
			print('true~~'.$response);
		}

		else
		{
			print('null'.'~~'.get_null_response($section, $type));
		}
	}

