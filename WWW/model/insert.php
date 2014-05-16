<?php

	function format_date($date, $heure)
	{
		$d = explode('/', $date);
		return ('\''.$d[2].'-'.$d[1].'-'.$d[0].' '.$heure.':00\'');
	}

	function format_heure($heure)
	{
		return ('\'0000-00-00 '.$heure.':00\'');
	}

	function insert_client($db, $values)
	{
		$addProp['adresse'] = '\''.$values['adresse'].'\'';
		$addProp['numerotelephone'] = '\''.$values['num'].'\'';
		$addProp['localite'] = $values['localite'];

		/** Ajout du Propriétaire **/
		$db->insert_one('V_PROPRIETAIRE', $addProp);
		$idProp = $db->get_last_insert_id();

		/** Détermination du sous-type de propriétaire **/
		if ($values['type'] == 'particulier')
		{
			$addPart['nom'] = '\''.$values['nom'].'\'';
			$addPart['prenom'] = '\''.$values['prenom'].'\'';
			$addPart['identifiant'] = $idProp;
			$db->insert_one('V_PARTICULIER', $addPart);
		}

		else
		{
			$addEnt['nom'] = '\''.$values['nom'].'\'';
			$addEnt['type'] = '\''.$values['type'].'\'';
			$addEnt['identifiant'] = $idProp;
			$db->insert_one('V_ENTREPRISE', $addPart);	
		}

		return $idProp;
	}

	function insert_animal($db, $values)
	{
		$addAnimal['espece'] = $values['espece'];
		$addAnimal['proprietaire'] = $values['client'];

		$addAnimal['nom'] = '\''.$values['nom'].'\'';
		$addAnimal['race'] = '\''.$values['race'].'\'';
		$addAnimal['taille'] = str_replace(',', '.', $values['taille']);
		$addAnimal['poids'] = str_replace(',', '.', $values['poids']);
		$addAnimal['genre'] = '\''.$values['genre'].'\'';
		$addAnimal['sterile'] = '\''.$values['sterile'].'\'';
		$addAnimal['numTatouage'] = $values['numTatouage'];
		$addAnimal['numPuce'] = $values['numPuce'];

		/** Ajout de l'animal **/
		$db->insert_one('V_ANIMAL', $addAnimal);

		return $db->get_last_insert_id();
	}

	function insert_traitement($db, $values)
	{
		$addTr['medicament'] = $values['medicament'];

		$addTr['dilution'] = '\''.$values['dilution'].'\'';
		$addTr['frequence'] = '\''.$values['frequence'].'\'';
		$addTr['dose'] = '\''.$values['dose'].'\'';
		$addTr['duree'] = '\''.$values['duree'].'\'';

		/** Ajout du traitement **/
		$db->insert_one('V_TRAITEMENT', $addTr);

		return $db->get_last_insert_id();
	}

	function insert_soins($db, $values)
	{
		$addCare['animal'] = $values['animal'];
		$addCare['traitement'] = $values['traitement'];
		$addCare['consultation'] = $values['consultation'];

		$addCare['anamnese'] = '\''.$values['anamnese'].'\'';
		$addCare['diagnostic'] = '\''.$values['diagnostic'].'\'';
		$addCare['manipulation'] = '\''.$values['manipulation'].'\'';

		$db->insert_one('V_SOINS', $addCare);
		return $db->get_last_insert_id();
	}

	function insert_consultation($db, $values)
	{
		$addCons['client'] = $values['client'];

		$addCons['date'] = format_date($values['date'], $values['heure']);
		$addCons['lieu'] = '\''.$values['lieu'].'\'';
		$addCons['duree'] = format_heure($values['duree']);

		/** Ajout de la consultation **/
		$idCons = $db->insert_one('V_CONSULTATION', $addCons);

		return $idCons;
	}


	function get_insert_consult($db)
	{
		$array['title'] = 'Consultation';

		$clients = get_clients_list($db);

		$array['columns']['client'] = array('select', $clients, 'dyn');
		$array['columns']['date'] = array('text', 'date');
		$array['columns']['heure'] = array('text', 'heure');
		$array['columns']['lieu'] = array('select', array('Cabinet', 'Extérieur'));
		$array['columns']['duree'] = array('text', '0/heure');
		$array['columns']['soins'] = array('list');

		return $array;
	}

	function get_insert_client($db)
	{
		$array['title'] = 'Client';

		$localites = get_localites_list($db);

		$array['columns']['typeProp'] = array('radio', array('Particulier', 'Entreprise'), array('nomPart', 'prenom'), array('nomEnt', 'type'));
		$array['columns']['nomPart'] = array('text', '1-20');
		$array['columns']['prenom'] = array('text', '1-20');
		$array['columns']['nomEnt'] = array('text', '1-30');
		$array['columns']['type'] = array('select', array('Eleveur', 'Cirque', 'Centre Equestre', 'Parc Aquatique', 'Parc Zoologique', 'Brigade Canine', 'Refuge'));
		$array['columns']['adresse'] = array('text', '0-50');
		$array['columns']['localite'] = array('select', $localites, 'dyn');
		$array['columns']['tel'] = array('text', '0/d:10');

		return $array;
	}

	function get_insert_animal($db)
	{
		/* Titre de la section */
		$array['title'] = 'Animal';

		/* Afin de réaliser des select dynamiques (choisir un propriétaire ou une espèce et non une option figée) */
		$props = get_clients_list($db);
		$especes = get_especes_list($db);

		/* Danse columns, on met les différents champs */
		$array['columns']['nom'] = array('text', '1-20');
		$array['columns']['client'] = array('select', $props, 'dyn');
		$array['columns']['espece'] = array('select', $especes, 'dyn');
		$array['columns']['race'] = array('text', '0-15');
		$array['columns']['taille'] = array('text', '0/f:3.2');
		$array['columns']['poids'] = array('text', '0/f:4.3');
		$array['columns']['genre'] = array('select', array('Male', 'Femelle', 'Hermaphrodite', 'Inconnu'));
		$array['columns']['sterile'] = array('radio', array('Oui', 'Non'));
		$array['columns']['tatouage'] = array('text', 'd:0-10');
		$array['columns']['puce'] = array('text', 'd:0-10');

		/* type text :> input type='text', nécessite la chaîne de format à côté */
			/* a-b : entre a et b caractères */
			/* f:a : float de type a */
			/* d:a-b : entier de a à b chiffres */
		/* type select :> select, nécessite la liste des options possibles */
			/* sous forme d'array pour les statics */
			/* sous forme de get_section_list($db), suivi de 'dyn', pour les dynamiques */
		/* type radio :> input type='radio', nécessite la liste des options possible sous forme d'array comme pour les select */

		return $array;
	}

	function get_insert_localite($db)
	{
		$array['title'] = 'Localité';

		$localites = get_localites_list($db, true);

		$array['columns']['codepostal'] = array('text', 'd:5');
		$array['columns']['libelle'] = array('text', '1-15', $localites);

		return $array;
	}

	function get_insert_espece($db)
	{
		$array['title'] = 'Espèce';

		$especes = get_especes_list($db, true);

		$array['columns']['libelle'] = array('text', '1-15', 'unique', $especes);

		return $array;
	}

	function get_insert_medicament($db)
	{
		$array['title'] = 'Médicament';

		$medicament = get_medicament_list($db, true);

		$array['columns']['libelle'] = array('text', '1-20','unique', $medicament);

		return $array;
	}

	function get_insert_traitement($db)
	{
		$array['title'] = 'Traitement';

		$medicament = get_medicament_list($db);

		$array['columns']['medicament'] = array('select', $medicament, 'dyn');
		$array['columns']['dilution'] = array('text', '0-10');
		$array['columns']['frequence'] = array('text', '0-10');
		$array['columns']['dose'] = array('text', '0-10');
		$array['columns']['duree'] = array('text', '1-10');

		return $array;
	}

	function get_insert_soins($db)
	{
		$array['title'] = 'Soins';

		$consultation = get_consultation_list($db);
		$animal = get_animal_list($db);
		$traitement = get_traitement_list($db);

		$array['columns']['consultation'] = array('select', $consultation, 'dyn');
		$array['columns']['animal'] = array('select', $animal, 'dyn');
		$array['columns']['anamnese'] = array('text', '0-50');
		$array['columns']['diagnostic'] = array('text', '0-100');
		$array['columns']['manipulation'] = array('text', '0-100');
		$array['columns']['traitement'] = array('select', $traitement, 'dyn');

		return $array;
	}