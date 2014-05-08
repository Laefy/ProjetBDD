<?php

	include_once('model/db.php');
	
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

