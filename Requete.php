


<?
Include('connexion_inc.php');

?>

<br />
<?
// Insert un individu dans la table proprietaire
function Insert_in_proprietaire()
{
	$codepostal = $_POST['codepostal'];
	$libelle = $_POST['libelle'];
	
	$adresse=$_POST['adresse'];
	$numerotelephone=$_POST['numerotelephone'];
	
	$type_proprietaire=$_POST['type_prorietaire'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$type_entreprise=$_POST['type_entreprise'];
	
	
	$query = "INSERT INTO `V_LOCALITE`(`codepostal`, `libelle`)
							VALUES ($codepostal,'$libelle')";
	$result = mysql_query($query)
		or die('Erreur '.$query);	
		
	

	$query = "INSERT INTO V_PROPRIETAIRE (adresse,numerotelephone)
							VALUES ('$adresse','$numerotelephone')";
	$result = mysql_query($query)
		or die('Erreur '.$query);	

		
	if($type_proprietaire=='particulier'){
		$query = "INSERT INTO V_PARTICULIER (nom,prenom)
								VALUES('$nom','$prenom')";
		$result = mysql_query($query)
			or die('Erreur '.$query);
	}
	else if($type_proprietaire=='entreprise'){
		$query = "INSERT INTO V_ENTREPRISE (nom,type)
								VALUES('$nom','$type_entreprise')";
		$result = mysql_query($query)
			or die('Erreur '.$query);
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
		or die('Erreur '.$query);
	
	
	$query = " INSERT INTO V_TRAITEMENT (dilution,frequence,dose,duree)
				VALUES($dilution,$frequence,$dose,$duree)";

	$result = $query->mysql_query()
		or die('Erreur '.$query);
}

// Insere un Animal dans la table V_ANIMAL
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
		or die('Erreur '.$query);						
	
	$query = " INSERT into V_ANIMAL (nom,race,taille,poids,genre,castre,numTatouage,numPuce)
				VALUES($nom,$race,$taille,$poids,$genre,$castre,$numTatouage,$numPuce)";

	$result = $query->mysql_query()
		or die('Erreur '.$query);
}				
function Insert_in_Consultation()
{
	$date=$_POST['date'];
	$lieu=$_POST['lieu'];
	$duree=$_POST['duree'];
	
	$query = " INSERT into V_CONSULTATION (date,lieu,duree)
										VALUES($date,$lieu,$duree)";

	$result = $query->mysql_query()
		or die('Erreur '.$query);
	
	$anamnese=$_POST['anamnese'];
	$diagnostic=$_POST['diagnostic'];
	$manipultation=$_POST['manipultation'];

	$query = " INSERT into V_SOINS (anamnese,diagnostic,manipulation)
					VALUES($anamnese,$diagnostic,$manipulation)";
				
	$result = $query->mysql_query()
		or die('Erreur '.$query);
}

Insert_in_Proprietaire();


				
?>