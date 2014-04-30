


<?
// Insert un individu dans la table proprietaire
function Insert_in_proprietaire()
{
	$identifiant=$_POST['identifiant_proprietaire'];
	$adresse=$_POST['adresse'];
	$codepostal=$_POST['codepostal'];
	$ville=$_POST['ville'];
	$pays=$_POST['pays'];
	$numerotelephone=$_POST['numerotelephone'];

	$query = "INSERT into V_PROPRIETAIRE (identifiant,adresse,codepostal,ville,pays,numerotelephone)
			($identifiant,$adresse,$codepostal,$ville,$pays,$numerotelephone)";
	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_proprietaire , base");	

	if($type=="particulier"){
		$query = "INSERT into V_PARTICULIER (identifiant,nom,prenom)
				($identifiant,$nom,$prenom)";
		$result = $query->mysql_query()
			or die("Requete non conforme dans Insert_in_proprietaire, particulier");
	}
	else if($type=="entreprise"){
		$query = "INSERT into V_ENTREPRISE (identifiant,nom,enum)
				($identifiant,$nom,$enum)";
		$result = $query->mysql_query()
			or die("Requete non conforme dans Insert_in_proprietaire, entreprise");
	}	
}

// Insert un traitement dans la table traitement

function Insert_in_traitement()
{
	$identifiant=$_POST['identifiant_traitement'];
	$produit=$_POST['produit'];
	$dilution=$_POST['dilution'];
	$frequence=$_POST['frequence'];
	$dose=$_POST['dose'];
	$duree=$_POST['duree'];
	
	$query = " INSERT into V_TRAITEMENT (identifiant,produit,dilution,frequence,dose,duree)
				($identifiant,$produit,$dilution,$frequence,$dose,$duree)";

	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_traitement");
}

function Insert_in_Animal()
{
	$identifiant=$_POST['identifiant_animal'];
	$nom=$_POST['nom'];
	$espece=$_POST['espece'];
	$race=$_POST['race'];
	$taille=$_POST['taille'];
	$poids=$_POST['poids'];
	$genre=$_POST['genre'];
	$castre=$_POST['castre'];
	$numTatouage=$_POST['numTatouage'];
	$numPuce=$_POST['numPuce'];
	$identifiantProprietaire=$_POST['identifiantProprietaire'];

	$query = " INSERT into V_ANIMAL (identifiant,nom,espece,race,taille,poids,genre,castre,numTatouage,numPuce,identifiantProprietaire)
				($identifiant,$nom,$espece,$race,$taille,$poids,$genre,$castre,$numTatouage,$numPuce,$identifiantProprietaire)";

	$result = $query->mysql_query()
		or die("Requete non conforme dans Insert_in_Animal");
}				
function Insert_in_Consultation()
{
	$identifiant=$_POST['identifiant'];
	$date=$_POST['date'];
	$duree=$_POST['duree'];
	$probleme=$_POST['probleme'];
	$diagnostic=$_POST['diagnostic'];
	$resumeManip=$_POST['resumeManip'];
	$identifiantTraitement=$_POST['identifiantTraitement']; 

	$query = " INSERT into V_CONSULTATION (identifiant,date,duree,probleme,diagnostic,resumeManip,identifiantTraitement)
				($identifiant,$date,$duree,$probleme,$diagnostic,$resumeManip,$identifiantTraitement)";

	$result = $query->mysql_query()
		or die(("Requete non conforme dans Insert_in_Consultation");
}

				
?>