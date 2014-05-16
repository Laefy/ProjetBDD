<?php

	function get_client_name($db, $idClient)
	{
		$client = $db->select_one('V_PARTICULIER', 'identifiant', $idClient);

		if ($client)
		{
			$nomClient = $client['prenom'].' '.$client['nom'];
		}

		else
		{
			$client = $db->select_one('V_ENTREPRISE', 'identifiant', $idClient);
			$nomClient = $client['nom'];
		}

		return $nomClient;
	}

	function get_date($format, $timestamp)
	{
		$array = explode(' ', $timestamp);
		$date = explode('-', $array[0]);
		$hour = explode(':', $array[1]);

		$format = str_replace('d', $date[2], $format);
		$format = str_replace('m', $date[1], $format);
		$format = str_replace('y', $date[0], $format);
		$format = str_replace('h', $hour[0], $format);
		$format = str_replace('i', $hour[1], $format);

		return $format;
	}


	function get_clients_list($db)
	{
		$table = 'V_PROPRIETAIRE';
		$columns = 'identifiant';
		$result = $db->advanced_select($table, $columns);

		$i = 0;
		while ($row = $db->get_one_row($result))
		{
			$array[$i] = array($row['identifiant'], get_client_name($db, $row['identifiant']));
			$i ++;
		}

		return $array;
	}

	function get_localites_list($db, $lib = false)
	{
		$table = 'V_LOCALITE';
		$columns = 'identifiant, codepostal, libelle';
		$result = $db->advanced_select($table, $columns);

		$i = 0;

		if ($lib)
		{
			while ($row = $db->get_one_row($result))
			{
				$array[$i] = $row['libelle'];
				$i ++;
			}
		}

		else
		{
			while ($row = $db->get_one_row($result))
			{
				$array[$i] = array($row['identifiant'], $row['codepostal'].' '.$row['libelle']);
				$i ++;
			}
		}

		return $array;
	}

	function get_especes_list($db, $lib = false)
	{
		$table = 'V_ESPECE';
		$columns = 'identifiant, libelle';
		$result = $db->advanced_select($table, $columns);

		$i = 0;

		if ($lib)
		{
			while ($row = $db->get_one_row($result))
			{
				$array[$i] = $row['libelle'];
				$i ++;
			}
		}

		else
		{
			while ($row = $db->get_one_row($result))
			{
				$array[$i] = array($row['identifiant'], $row['libelle']);
				$i ++;
			}
		}
		
		return $array;
	}

	function get_medicament_list($db, $lib = false)
	{
		$table = 'V_MEDICAMENT';
		$columns = 'identifiant, libelle';
		$result = $db->advanced_select($table, $columns);

		$i = 0;

		if ($lib)
		{
			while ($row = $db->get_one_row($result))
			{
				$array[$i] = $row['libelle'];
				$i ++;
			}
		}

		else
		{
			while ($row = $db->get_one_row($result))
			{
				$array[$i] = array($row['identifiant'], $row['libelle']);
				$i ++;
			}
		}

		return $array;

	}

	function get_animal_list($db)
	{
		$table = 'V_ANIMAL';
		$columns = 'identifiant, nom';
		$result = $db->advanced_select($table, $columns);

		$i = 0;

		while ($row = $db->get_one_row($result))
		{
			$array[$i] = array($row['identifiant'], $row['nom']);
			$i ++;
		}

		return $array;
	}

	function get_traitement_list($db)
	{
		$table = 'V_TRAITEMENT';
		$columns = 'identifiant';
		$result = $db->advanced_select($table, $columns);

		$i = 0;
		while ($row = $db->get_one_row($result))
		{
			$array[$i] = array($row['identifiant']);
			$i ++;
		}

		return $array;
	}

	function get_consultation_list($db)
	{
		$table = 'V_CONSULTATION';
		$columns = 'identifiant, client';
		$result = $db->advanced_select($table, $columns);

		$i = 0;
		while ($row = $db->get_one_row($result))
		{
			$array[$i] = array($row['identifiant'], get_client_name($db, $row['client']));
			$i ++;
		}

		return $array;
	}



	function get_table_formerconsult($db, $sortlabel, $sorttype = '')
	{
		$table = 'V_CONSULTATION';
		$columns = 'identifiant, date, lieu, duree, client';
		$condition = 'date < NOW()';

		$result = $db->advanced_select($table, $columns, $condition, $sortlabel, $sorttype);

		$array['title'] = 'Consultations Passées';
		$array['columns'] = array('N°', 'Client', 'Date', 'Heure', 'Lieu', 'Durée');
		$array['rows'] = array();

		$key = 0;
		while (($row = $db->get_one_row($result)))
		{
			$idClient = $row['client'];

			$array['rows'][$key][0] = $row['identifiant'];
			$array['rows'][$key][1] = get_client_name($db, $idClient);
			$array['rows'][$key][2] = get_date('d/m/y', $row['date']);
			$array['rows'][$key][3] = get_date('h:i', $row['date']);
			$array['rows'][$key][4] = $row['lieu'] == 'cabinet' ? 'Cabinet' : 'Extérieur';
			$array['rows'][$key][5] = $row['duree'] != '' ? get_date('h:i', $row['duree']) : 'NR';

			$key ++;
		}

		return $array;		
	}

	function get_table_nextconsult($db, $sortlabel, $sorttype = '')
	{
		$table = 'V_CONSULTATION';
		$columns = 'identifiant, date, lieu, client';
		$condition = 'date >= NOW()';

		$result = $db->advanced_select($table, $columns, $condition, $sortlabel, $sorttype);

		$array['title'] = 'Consultations à Venir';
		$array['columns'] = array('N°', 'Client', 'Date', 'Heure', 'Lieu');
		$array['rows'] = array();

		$key = 0;
		while (($row = $db->get_one_row($result)))
		{
			$idClient = $row['client'];

			$array['rows'][$key][0] = $row['identifiant'];
			$array['rows'][$key][1] = get_client_name($db, $idClient);
			$array['rows'][$key][2] = get_date('d/m/y', $row['date']);
			$array['rows'][$key][3] = get_date('h:i', $row['date']);
			$array['rows'][$key][4] = $row['lieu'] == 'cabinet' ? 'Cabinet' : 'Extérieur';

			$key ++;
		}

		return $array;		
	}

	function get_table_partdirectory($db, $sortlabel, $sorttype = '')
	{
		$table = 'V_PARTICULIER part NATURAL JOIN V_PROPRIETAIRE prop INNER JOIN V_LOCALITE loc ON prop.localite = loc.identifiant';
		$columns = 'part.identifiant id, part.nom nom, part.prenom prenom, prop.numerotelephone tel, loc.libelle ville';
		$condition = '';

		$result = $db->advanced_select($table, $columns, $condition, $sortlabel, $sorttype);

		$array['title'] = 'Particuliers';
		$array['columns'] = array('N°', 'Nom', 'Prénom', 'Téléphone', 'Localité');
		$array['rows'] = array();

		$key = 0;
		while (($row = $db->get_one_row($result)))
		{
			$array['rows'][$key][0] = $row['id'];
			$array['rows'][$key][1] = $row['nom'];
			$array['rows'][$key][2] = $row['prenom'];
			$array['rows'][$key][3] = $row['tel'];
			$array['rows'][$key][4] = $row['ville'];

			$key ++;
		}

		return $array;		
	}

	function get_table_entrdirectory($db, $sortlabel, $sorttype = '')
	{
		$table = 'V_ENTREPRISE entr NATURAL JOIN V_PROPRIETAIRE prop INNER JOIN V_LOCALITE loc ON prop.localite = loc.identifiant';
		$columns = 'entr.identifiant id, entr.nom nom, entr.type type, prop.numerotelephone tel, loc.libelle ville';
		$condition = '';

		$result = $db->advanced_select($table, $columns, $condition, $sortlabel, $sorttype);

		$array['title'] = 'Entreprises et Professionels';
		$array['columns'] = array('N°', 'Nom', 'Type', 'Téléphone', 'Localité');
		$array['rows'] = array();

		$key = 0;
		while (($row = $db->get_one_row($result)))
		{
			$array['rows'][$key][0] = $row['id'];
			$array['rows'][$key][1] = $row['nom'];
			$array['rows'][$key][2] = $row['type'];
			$array['rows'][$key][3] = $row['tel'];
			$array['rows'][$key][4] = $row['ville'];

			$key ++;
		}

		return $array;		
	}

	function get_table_register($db)
	{
		$table = 'V_ANIMAL ani INNER JOIN V_ESPECE espece ON ani.espece = espece.identifiant';
		$columns = 'ani.identifiant id, ani.nom nom, espece.libelle esp, ani.race race, ani.genre genre, ani.proprietaire prop';
		$condition = '';

		$result = $db->advanced_select($table, $columns, $condition, $sortlabel, $sorttype);

		$array['columns'] = array('N°', 'Nom', 'Espèce', 'Race', 'Genre', 'Propriétaire');
		$array['rows'] = array();

		$key = 0;
		while (($row = $db->get_one_row($result)))
		{
			$array['rows'][$key][0] = $row['id'];
			$array['rows'][$key][1] = $row['nom'];
			$array['rows'][$key][2] = $row['esp'];
			$array['rows'][$key][3] = $row['race'] != '' ? $row['race'] : 'Inconnue';
			$array['rows'][$key][4] = $row['genre'];
			$array['rows'][$key][5] = get_client_name($db, $row['prop']);

			$key ++;
		}

		return $array;
	}

	function get_table_prescript($db)
	{
		return null;
	}

	function get_table_accounting($db)
	{
		return null;
	}

	function get_table_stock($db)
	{
		return null;
	}


	function get_details_consult($db, $type, $id)
	{
		$table = 'V_CONSULTATION';

		$row = $db->select_one($table, 'identifiant', $id);

		$array['title'] = 'Consultations';
		$array['id'] = $row['identifiant'];

		$client = get_client_name($db, $row['client']);
		$duree = $row['duree'] ? get_date('h:i', $row['duree']) : 'NR';

		$columns['client'] = array($client, 'select', array('~*', 'directory', $row['client']));
		$columns['date'] = array(get_date('d/m/y', $row['date']), 'text');
		$columns['heure'] = array(get_date('h:i', $row['date']), 'text');
		$columns['lieu'] = array($row['lieu'], 'select');

		if ($type == 'former')
			$columns['duree'] = array($duree, 'text');

		$array['columns'] = $columns;

		return $array;		
	}

	function get_details_client($db, $id)
	{
		$table = 'V_PROPRIETAIRE prop INNER JOIN V_LOCALITE loc ON (prop.localite = loc.identifiant)';
		$cols = 'prop.identifiant id, prop.adresse ad, prop.numerotelephone num, loc.identifiant locid, loc.libelle ville';
		$result = $db->advanced_select($table, $cols, 'prop.identifiant = '.$id);

		$prop = $db->get_one_row($result);

		$array['title'] = 'Client';
		$array['id'] = $prop['id'];

		$tablepart = 'V_PARTICULIER';
		$tableent = 'V_ENTREPRISE';

		$client = $db->select_one($tablepart, 'identifiant', $id);
		if ($client)
		{
			$columns['nom'] = array($client['nom'], 'text');
			$columns['prenom'] = array($client['prenom'], 'text');
			$columns['adresse'] = array($prop['ad'], 'text');
			$columns['ville'] = array($prop['ville'], 'select', array('~*', 'towns', $prop['locid']));
			$columns['tel'] = array($prop['num'], 'text');
		}

		else
		{
			$client = $db->select_one($tableent, 'identifiant', $id);
			$columns['nom'] = array($client['nom'], 'text');
			$columns['type'] = array($prop['type'], 'select');
			$columns['adresse'] = array($prop['ad'], 'text');
			$columns['ville'] = array($prop['ville'], 'select', array('~*', 'towns', $prop['locid']));
			$columns['tel'] = array($prop['num'], 'text');
		}

		$array['columns'] = $columns;

		return $array;		
	}

	function get_details_animal($db, $id)
	{
		$table = 'V_ANIMAL ani INNER JOIN V_ESPECE esp ON (ani.espece = esp.identifiant)';
		$cols = 'ani.identifiant id, ani.nom nom, esp.libelle espece, ani.race race, ani.taille tl, ani.poids pds, ani.genre genre, ani.sterile st,
						ani.numTatouage tatou, ani.numPuce puce, ani.proprietaire prop, esp.identifiant espid';
		$result = $db->advanced_select($table, $cols, 'ani.identifiant = '.$id);

		$animal = $db->get_one_row($result);
		$array['title'] = 'Animal';
		$array['id'] = $animal['id'];

		$prop = get_client_name($db, $animal['prop']);

		$columns['nom'] = array($animal['nom'], 'text');
		$columns['prop'] = array($prop, 'select', array('~*', 'directory', $animal['prop']));
		$columns['espece'] = array($animal['espece'], 'select', array('~*', 'species', $animal['espid']));
		$columns['race'] = array($animal['race'] ? $animal['race'] : 'NR', 'text');
		$columns['taille'] = array($animal['tl'] ? $animal['tl'] : 'NR', 'text');
		$columns['pds'] = array($animal['pds'] ? $animal['pds'] : 'NR', 'text');
		$columns['genre'] = array($animal['genre'], 'select');
		$columns['sterile'] = array($animal['st'], 'radio');
		$columns['tatou'] = array($animal['tatou'] ? $animal['tatou'] : 'NR', 'text');
		$columns['puce'] = array($animal['puce'] ? $animal['puce'] : 'NR', 'text');

		$array['columns'] = $columns;

		return $array;		
	}