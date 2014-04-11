
// Insert un individu dans la table proprietaire
// $type est le type de proprietaire , a voir comment on envoie l'information
// Pour le moment ca ne fonctionne pas
<?
function Insert_in_proprietaire()
{
	$identifiant=$_POST['identifiant'];
	$adresse=$_POST['adresse'];
	$codepostal=$_POST['codepostal'];
	$ville=$_POST['ville'];
	$pays=$_POST['pays'];
	$numerotelephone=$_POST['numerotelephone'];

	$query = "INSERT into V_PROPRIETAIRE (identifiant,adresse,codepostal,ville,pays,numerotelephone)
			('$identifiant','$adresse','$codepostal','$ville','$pays','$numerotelephone')";
	$result = mysql_query($query)
		or die("Requete non conforme");	

	if($type=="particulier"){
		$query = "INSERT into V_PARTICULIER (identifiant,nom,prenom)
				('$identifiant','$nom','$prenom')";
		$result = mysql_query($query)
			or die("Requete non conforme");
	}
	else if($type=="entreprise"){
		$query = "INSERT into V_ENTREPRISE (identifiant,nom,enum)
				('$identifiant','$nom','$enum')";
		$result = mysql_query($query)
			or die("Requete non conforme");
	}	
}
?>