


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
	
	if(isset($_POST[proprietaire])){
		echo $_POST[prorietaire];
		echo 'chaine apres type proprietaire';
	}
	else{
		echo 'type proprietaire non set';
	}
	$type_proprietaire=$_POST['prorietaire'];
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	
	$type_entreprise=$_POST['type_entreprise'];
	
	$string_particulier="particulier";
	$string_entreprise="entreprise";
	
	$query = sprintf("INSERT INTO `V_LOCALITE`(`codepostal`, `libelle`)
							VALUES ('%s','%s')",
						$codepostal,
						$libelle);
						
	/*$query = 'INSERT INTO `V_LOCALITE`(`codepostal`, `libelle`)
							VALUES ('.$codepostal.','.$libelle.')';					
	printf("%s \n",$query);	*/				
	$result = mysql_query($query)
		or die(mysql_error());
		//or die('Erreur '.$query);	
		
	$query = sprintf("INSERT INTO V_PROPRIETAIRE (adresse,localite,numerotelephone)
							VALUES (
							'%s',
							(SELECT codepostal
							FROM V_LOCALITE
							WHERE codepostal='%s'),
									'%s')",
						$adresse,
						$codepostal,
						$numerotelephone);	
	$result = mysql_query($query)
		or die(mysql_error());	

	// 1 = particulier
	// 2 = entreprise
	echo $type_proprietaire;
	
	if($type_proprietaire===$string_particulier){
		$query = sprintf("INSERT INTO V_PARTICULIER (nom,prenom)
								VALUES('%s','%s')",
								$nom,
								$prenom);
		$result = mysql_query($query)
			or die('Erreur '.$query);
	}
	else if($type_proprietaire===$string_entreprise){
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