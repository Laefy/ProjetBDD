


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
		or die("Requete non conforme");	

	if($type=="particulier"){
		$query = "INSERT into V_PARTICULIER (identifiant,nom,prenom)
				($identifiant,$nom,$prenom)";
		$result = $query->mysql_query()
			or die("Requete non conforme");
	}
	else if($type=="entreprise"){
		$query = "INSERT into V_ENTREPRISE (identifiant,nom,enum)
				($identifiant,$nom,$enum)";
		$result = $query->mysql_query()
			or die("Requete non conforme");
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
	
	$query = " INSERT into V_traitement (identifiant,produit,dilution,frequence,dose,duree)
				($identifiant,$produit,$dilution,$frequence,$dose,$duree)";

	$result = $query->mysql_query()
		or die("Requete non conforme");
}


?>