


<?
// Insert un individu dans la table proprietaire
function Insert_in_proprietaire()
{
	$identifiant=$_GET['identifiant_proprietaire'];
	$adresse=$_GET['adresse'];
	$codepostal=$_GET['codepostal'];
	$ville=$_GET['ville'];
	$pays=$_GET['pays'];
	$numerotelephone=$_GET['numerotelephone'];

	$query = "INSERT into V_PROPRIETAIRE (identifiant,adresse,codepostal,ville,pays,numerotelephone)
			($identifiant,$adresse,$codepostal,$ville,$pays,$numerotelephone)";
	$result = mysqli_query($query)
		or die("Requete non conforme");	

	if($type=="particulier"){
		$query = "INSERT into V_PARTICULIER (identifiant,nom,prenom)
				($identifiant,$nom,$prenom)";
		$result = mysqli_query($query)
			or die("Requete non conforme");
	}
	else if($type=="entreprise"){
		$query = "INSERT into V_ENTREPRISE (identifiant,nom,enum)
				($identifiant,$nom,$enum)";
		$result = mysqli_query($query)
			or die("Requete non conforme");
	}	
}

// Insert un traitement dans la table traitement

function Insert_in_traitement()
{
	$identifiant=$_GET['identifiant_traitement'];
	$produit=$_GET['produit'];
	$dilution=$_GET['dilution'];
	$frequence=$_GET['frequence'];
	$dose=$_GET['dose'];
	$duree=$_GET['duree'];
	
	$query = " INSERT into V_traitement (identifiant,produit,dilution,frequence,dose,duree)
				($identifiant,$produit,$dilution,$frequence,$dose,$duree)";

	$result = mysqli_query($query)
		or die("Requete non conforme");
}


?>