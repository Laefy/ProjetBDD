


<?
// Insert un individu dans la table proprietaire
function Insert_in_proprietaire()
{
	$codepostal=$_POST['codepostal'];
	$libelle=$_POST['libelle'];
	
	$adresse=$_POST['adresse'];
	$numerotelephone=$_POST['numerotelephone'];
	
	$type_proprietaire=$_POST['type_prorietaire'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$type_entreprise=$_POST['type_entreprise'];
	
	
	$query = "INSERT INTO V_LOCALITE(codepostal,libelle)
							VALUES ($codepostal,$libelle)";
	$result = $query->mysql_query($query)
		or die("Requete non conforme dans Insert_in_proprietaire , localite");	
		
	

	$query = "INSERT INTO V_PROPRIETAIRE (adresse,numerotelephone)
							VALUES ($adresse,$numerotelephone)";
	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_proprietaire , proprietaire");	

		
	if($type_particulier=="particulier"){
		$query = "INSERT INTO V_PARTICULIER (identifiant,nom,prenom)
								VALUES($identifiant,$nom,$prenom)";
		$result = $query->mysql_query()
			or die("Requete non conforme dans Insert_in_proprietaire, particulier");
	}
	else if($type_particulier=="entreprise"){
		$query = "INSERT INTO V_ENTREPRISE (identifiant,nom,type)
								VALUES($identifiant,$nom,$type_entreprise)";
		$result = $query->mysql_query()
			or die("Requete non conforme dans Insert_in_proprietaire, entreprise");
	}	
}

// Insert un traitement dans la table traitement

function Insert_in_traitement()
{
	$libelle=$_POST['libelle'];

	$dilution=$_POST['dilution'];
	$frequence=$_POST['frequence'];
	$dose=$_POST['dose'];
	$duree=$_POST['duree'];
	
	$query = " INSERT INTO V_MEDICAMENT (libelle)
								VALUES($libelle)";

	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_traitement,medicament");
	
	
	$query = " INSERT INTO V_TRAITEMENT (dilution,frequence,dose,duree)
				VALUES($dilution,$frequence,$dose,$duree)";

	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_traitement , traitement");
}

function Insert_in_Animal()
{
	$libelle=$_POST['libelle'];

	$nom=$_POST['nom'];
	$race=$_POST['race'];
	$taille=$_POST['taille'];
	$poids=$_POST['poids'];
	$genre=$_POST['genre'];
	$castre=$_POST['castre'];
	$numTatouage=$_POST['numTatouage'];
	$numPuce=$_POST['numPuce'];

	$query = "Insert into V_ESPECE(libelle)
								VALUES($libelle)";
	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_Animal, espece");							
	
	$query = " INSERT into V_ANIMAL (nom,race,taille,poids,genre,castre,numTatouage,numPuce)
				VALUES($nom,$race,$taille,$poids,$genre,$castre,$numTatouage,$numPuce)";

	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_Animal");
}				
function Insert_in_Consultation()
{
	$date=$_POST['date'];
	$lieu=$_POST['lieu'];
	$duree=$_POST['duree'];
	
	$query = " INSERT into V_CONSULTATION (date,lieu,duree)
										VALUES($date,$lieu,$duree)";

	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_Consultation , consultation");
	
	$anamnese=$_POST['anamnese'];
	$diagnostic=$_POST['diagnostic'];
	$manipultation=$_POST['manipultation'];

	$query = " INSERT into V_SOINS (anamnese,diagnostic,manipulation)
					VALUES($anamnese,$diagnostic,$manipulation)";
				
	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_Consultation");
}

				
?>