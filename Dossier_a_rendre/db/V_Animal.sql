/* Création de la table V_Animaux */

CREATE TABLE IF NOT EXISTS V_ESPECE
(
	identifiant smallint UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle varchar(15) NOT NULL UNIQUE,

	PRIMARY KEY (identifiant)
);

CREATE TABLE IF NOT EXISTS V_ANIMAL
(
	identifiant mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	nom varchar(20) NOT NULL,
	espece smallint UNSIGNED NOT NULL,
	race varchar(15),
	taille float(4, 2), 
	poids float(6, 2),
	genre enum('Male', 'Femelle', 'Hermaphrodite', 'Inconnu') NOT NULL,
	sterile enum('Oui', 'Non') NOT NULL,
	numTatouage int UNSIGNED UNIQUE,
	numPuce int UNSIGNED UNIQUE,
	proprietaire mediumint UNSIGNED NOT NULL,

	PRIMARY KEY (identifiant),

	FOREIGN KEY (espece) REFERENCES V_ESPECE(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	FOREIGN KEY (proprietaire) REFERENCES V_PROPRIETAIRE(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);
