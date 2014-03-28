/* Création de la table V_Animaux */

CREATE TABLE IF NOT EXISTS V_ANIMAL
(
	identifiant int UNSIGNED NOT NULL AUTO_INCREMENT,
	nom varchar(20) NOT NULL,
	espece varchar(15) NOT NULL,
	race varchar(15),
	taille float(3, 2), 
	poids float(4, 3),
	genre enum('Male', 'Femelle', 'Hermaphrodite', 'Inconnu') NOT NULL,
	castre enum('Oui', 'Non') NOT NULL,
	numTatouage int UNSIGNED UNIQUE,
	numPuce int UNSIGNED UNIQUE,
	identifiantProprietaire int UNSIGNED,

	PRIMARY KEY (identifiant),
	FOREIGN KEY (identifiantProprietaire) REFERENCES V_PROPRIETAIRE(identifiant)
		ON DELETE SET NULL 
		ON UPDATE CASCADE
);


/* Insertions */

INSERT INTO V_ANIMAL(nom, espece, race, taille, poids, genre, castre, numTatouage, numPuce, identifiantProprietaire)
	VALUES ('Rafiki', 'Marsouin', NULL, 2.16, 943, 'Male', 'Non', NULL, 04334522, 1);