<?php

	include_once('../../model/db.php');
	include_once('../../model/select.php');
	include_once('../../model/insert.php');

	function get_string_from_array($array)
	{
		$title = $array['title'];
		$rows = '';
		$nf = 0;

		foreach ($array['columns'] as $key => $col) 
		{
			if ($nf)
				$rows .= '~#';

			$type = $col[0];
			$row = $key.'~/'.$type;

			switch ($type)
			{
				case 'text':
					$row .= '~/'.$col[1];
					if (isset($col[2]))
					{
						$unique = '~/';
						foreach ($col[2] as $value) 
							$unique .= '~]'.$value;

						$row .= str_replace('~/~]', '~/', $unique);
					}
					break;

				case 'select':
					$select = '~/';
					if ($col[2] == 'dyn')
					{
						if (count($col[1]) > 0)
						{	
							foreach ($col[1] as $value)
								$select .= '~]'.$value[0].'~&'.$value[1];

							$row .= str_replace('~/~]', '~/', $select).'~/';
						}

						$row .= $col[2];
					}

					else
					{
						foreach ($col[1] as $value) 
						{
							$select .= '~]'.$value;
						}

						$row .= str_replace('~/~]', '~/', $select);
					}
					break;

				case 'radio':
					$radio = '~/';
					foreach ($col[1] as $i => $value) 
					{
						$radio .= '~]'.$value;

						$deps = '';
						if (isset($col[2 + $i]))
						{
							foreach ($col[2 + $i] as $dep) 
								$deps .= '~&'.$dep;

							$radio .= $deps;
						}
					}

					$row .= str_replace('~/~]', '~/', $radio);
					break;
			}

			$rows .= $row;
			$nf = 1;
		}

		$string = $title.'~~'.$rows;
		
		return $string;
	}

	$db = new Db();

	$section = $_POST['section'];

	switch ($section)
	{
		case 'consult':
			$array = get_insert_consult($db);
			break;

		case 'directory':
			$array = get_insert_client($db);
			break;

		case 'register':
			$array = get_insert_animal($db);
			break;

		case 'localite':
			$array = get_insert_localite($db);
			break;

		case 'espece':
			$array = get_insert_espece($db);
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

