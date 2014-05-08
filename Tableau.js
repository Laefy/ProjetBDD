
// IdTableau = id  du tableau sur lequel il faut travailler
	// NombreColonne = nombre de colonne du tableau
	// ListeElemTableau = tableau contenant tout les elements à ajouter
	// 		Par exemple si on a un tableau avec 3 valeur "Nom" ,"Age" , "Pays"
	//			ListeElemTableau sera un tableau contenant les 3 variables
	//				ListeElem = ['Nom','Age','Pays']
	//		On ajoutera successivement 'Nom' , 'Age' , 'Pays' sur la ligne d'indice i
function ajouterLigne(IdTableau,NombreColonne,ListeElem)
	{
		var tableau = document.getElementById(IdTableau);
		var ligne = tableau.insertRow(-1);
		var i=0;
		var colonne;
		

		while(i < NombreColonne)
		{
			colonne = ligne.insertCell(i);
			colonne.innerHTML += ListeElem[i];
			i++;
		}
		
	}
	
	var montab=['Valeur1','Valeur2','Valeur3'];
	
	ajouterLigne("mytab",3,montab);