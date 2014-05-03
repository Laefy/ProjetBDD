


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
	
	
	$query = "INSERT into V_LOCALITE(codepostal,libelle)
									($codepostal,$libelle)"
	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_proprietaire , localite");	
		
	

	$query = "INSERT into V_PROPRIETAIRE (adresse,numerotelephone)
										($adresse,$numerotelephone)";
	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_proprietaire , proprietaire");	

		
	if($type_particulier=="particulier"){
		$query = "INSERT into V_PARTICULIER (identifiant,nom,prenom)
											($identifiant,$nom,$prenom)";
		$result = $query->mysql_query()
			or die("Requete non conforme dans Insert_in_proprietaire, particulier");
	}
	else if($type_particulier=="entreprise"){
		$query = "INSERT into V_ENTREPRISE (identifiant,nom,type)
										($identifiant,$nom,$type_entreprise)";
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
	
	$query = " INSERT into V_MEDICAMENT (libelle)
										($libelle)";

	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_traitement,medicament");
	
	
	$query = " INSERT into V_TRAITEMENT (dilution,frequence,dose,duree)
				($dilution,$frequence,$dose,$duree)";

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
								($libelle)";
	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_Animal, espece");							
	
	$query = " INSERT into V_ANIMAL (nom,race,taille,poids,genre,castre,numTatouage,numPuce)
				($nom,$race,$taille,$poids,$genre,$castre,$numTatouage,$numPuce)";

	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_Animal");
}				
function Insert_in_Consultation()
{
	$date=$_POST['date'];
	$lieu=$_POST['lieu'];
	$duree=$_POST['duree'];
	
	$query = " INSERT into V_CONSULTATION (date,lieu,duree)
										($date,$lieu,$duree)";

	$result = $query->mysql_query()
		or die(("Requete non conforme dans Insert_in_Consultation , consultation");
	
	$anamnese=$_POST['anamnese'];
	$diagnostic=$_POST['diagnostic'];
	$manipultation=$_POST['manipultation'];

	$query = " INSERT into V_SOINS (anamnese,diagnostic,manipulation)
					($anamnese,$diagnostic,$manipulation)";
				
	$result = $query->mysql_query()
		or die(("Requete non conforme dans Insert_in_Consultation");
}

				
?>