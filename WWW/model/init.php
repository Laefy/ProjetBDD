<?php

	function initialize_databases($mysqli)
	{
		/* Création de V_Médicament, V_Traitement, V_Localite, V_Proprietaire, V_Entreprise, V_Particulier, V_Espece, V_Animal, V_Consultations et V_Soins */

		$files = array('Traitement', 'Proprietaire', 'Animal', 'Consultation');

		foreach ($files as $file) 
		{			
			$query = file_get_contents('db/V_'.$file.'.sql');
			$mysqli->multi_query($query);
						
			do 
			{
			    if ($result = $mysqli->store_result()) 
			    {
			        $result->free();
			    }

			} while ($mysqli->more_results() && $mysqli->next_result());
		}
	}

	function drop_databases($mysqli)
	{
		$tables = array('SOINS', 'CONSULTATION', 'ANIMAL', 'ESPECE', 'ENTREPRISE', 'PARTICULIER', 'PROPRIETAIRE', 'LOCALITE', 'TRAITEMENT', 'MEDICAMENT');

		foreach ($tables as $table) 
		{
			$query = 'DROP TABLE V_'.$table;
			$mysqli->query($query);

			if ($result = $mysqli->store_result()) 
		    {
		        $result->free();
		    }
		}
	}


