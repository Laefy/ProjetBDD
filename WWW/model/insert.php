<?php

	function insert_owner($db, $values)
	{
		/** Détermination la localité **/
		if ($values['localite'])
		{
			$localite = $db->select_one('V_LOCALITE', 'libelle', $values['localite']);

			if (!$localite)
			{
				$addLoc['codepostal'] = $values['codepostal'];
				$addLoc['libelle'] = $values['localite'];
				$db->insert_one('V_LOCALITE', $addLoc);
				$idLoc = $db->get_last_insert_id();
			}

			else
			{
				$idLoc = $localite['identifiant'];
			}

			$addProp['localite'] = $idLoc;
		}

		else
		{
			$addProp['localite'] = 'null';
		}

		/** Autres variables **/
		$addProp['adresse'] = $values['adresse'] || 'null';
		$addProp['numerotelephone'] = $values['num'] || 'null';

		/** Ajout du Propriétaire **/
		$db->insert_one('V_PROPRIETAIRE', $addProp);
		$idProp = $db->get_last_insert_id();

		/** Détermination du sous-type de propriétaire **/
		if ($values['type'] == 'particulier')
		{
			$addPart['nom'] = $values['nom'];
			$addPart['prenom'] = $values['prenom'];
			$addPart['identifiant'] = $idProp;
			$db->insert_one('V_PARTICULIER', $addPart);
		}

		else
		{
			$addEnt['nom'] = $values['nom'];
			$addEnt['type'] = $values['type'];
			$addEnt['identifiant'] = $idProp;
			$db->insert_one('V_ENTREPRISE', $addPart);	
		}

		return $idProp;
	}

	function insert_animal($db, $values)
	{
		/** Détermination de l'espèce **/
		$espece = $db->select_one('V_ESPECE', 'libelle', $values['espece']);

		if (!$espece)
		{
			$addEsp['libelle'] = $values['espece'];
			$db->insert_one('V_ESPECE', $addEsp);
			$idEsp = $db->get_last_insert_id();
		}

		else
		{
			$idEsp = $espece['identifiant'];
		}

		$addAnimal['espece'] = $idEsp;

		/** Détermination du propriétaire **/
		if ($values['newProp'])
		{
			$idProp = insert_owner($db, $values['proprietaire']);
		}

		else
		{
			$idProp = $values['proprietaire'];
		}

		$addAnimal['proprietaire'] = $idProp;

		/** Autres variables **/
		$addAnimal['nom'] = $values['nom'];
		$addAnimal['race'] = $values['race'] || 'null';
		$addAnimal['taille'] = $values['taille'] || 'null';
		$addAnimal['poids'] = $values['poids'] || 'null';
		$addAnimal['genre'] = $values['genre'];
		$addAnimal['sterile'] = $values['sterile'];
		$addAnimal['numTatouage'] = $values['numTatouage'] || 'null';
		$addAnimal['numPuce'] = $values['numPuce'] || 'null';

		/** Ajout de l'animal **/
		$db->insert_one('V_ANIMAL', $addAnimal);

		return $db->get_last_insert_id();
	}

	function insert_treatment($db, $values)
	{
		/** Détermination du médicament **/
		$medicament = $db->select_one('V_MEDICAMENT', 'libelle', $values['medicament']);

		if (!$medicament)
		{
			$addMed['libelle'] = $values['medicament'];
			$db->insert_one('V_MEDICAMENT', $addMed);
			$idMed = $db->get_last_insert_id();
		}

		else
		{
			$idMed = $medicament['identifiant'];
		}

		$addTr['medicament'] = $idMed;

		/** Autres variables **/
		$addTr['dilution'] = $values['dilution'] || 'null';
		$addTr['frequence'] = $values['frequence'] || 'null';
		$addTr['dose'] = $values['dose'] || 'null';
		$addTr['duree'] = $values['duree'];

		/** Ajout du traitement **/
		$db->insert_one('V_TRAITEMENT', $addTr);

		return $db->get_last_insert_id();
	}

	function insert_care($db, $values)
	{
		/** Détermination de l'animal **/
		if ($values['newAnimal'])
		{
			$idAnimal = insert_animal($db, $values['animal']);
		}

		else
		{
			$idAnimal = $values['animal'];
		}

		$addCare['animal'] = $idAnimal;

		/** Détermination de l'éventuel traitement **/
		if ($values['traitement'])
		{
			if ($values['newTraitement'])
			{
				$idTr = insert_treatment($db, $values['traitement']);
			}

			else
			{
				$idTr = $values['traitement'];
			}

			$addCare['traitement'] = $idTr;
		}

		else
		{
			$addCare['traitement'] = 'null';
		}

		/** Autres valeurs **/
		$addCare['consultation'] = $values['consultation'];
		$addCare['anamnese'] = $values['anamnese'] || 'null';
		$addCare['diagnostic'] = $values['diagnostic'] || 'null';
		$addCare['manipulation'] = $values['manipulation'] || 'null';

		$db->insert_one('V_SOINS', $addCare);
		return $db->get_last_insert_id();
	}

	function insert_consultation($db, $values)
	{
		/** Détermination du propriétaire **/
		if ($values['newProp'])
		{
			$idProp = insert_owner($db, $values['proprietaire']);
		}

		else
		{
			$idProp = $values['proprietaire'];
		}

		$addCons['proprietaire'] = $idProp;

		/** Autres variables **/
		$addCons['date'] = $values['date'];
		$addCons['lieu'] = $values['lieu'];
		$addCons['duree'] = $values['duree'] || 'null';

		/** Ajout de la consultation **/
		$idCons = $db->insert_one('V_CONSULTATION', $addCons);

		/** Ajout des soins éventuels **/
		if ($values['soins'])
		{
			foreach ($values['soins'] as $soin) 
			{
				$soin['consultation'] = $idCons;
				insert_care($db, $soin);
			}
		}

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
		$array['columns']['duree'] = array('text', 'duree');
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
		$array['columns']['taille'] = array('text', 'f:3.2');
		$array['columns']['poids'] = array('text', 'f:4.3');
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