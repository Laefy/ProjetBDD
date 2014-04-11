/* Création de la table V_PROPRIETAIRE */

CREATE TABLE IF NOT EXISTS V_PROPRIETAIRE
(
	identifiant int UNSIGNED NOT NULL AUTO_INCREMENT,
	adresse varchar(50),
	codepostal mediumint(5),
	ville varchar(20),
	pays varchar(2),
	numerotelephone bigint(10),

	PRIMARY KEY (identifiant)
);

CREATE TABLE IF NOT EXISTS V_PARTICULIER
(
	identifiant int UNSIGNED NOT NULL,
	nom varchar(20) NOT NULL,
	prenom varchar(20) NOT NULL,

	PRIMARY KEY (identifiant),
	FOREIGN KEY (identifiant) REFERENCES V_PROPRIETAIRE(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS V_ENTREPRISE
(
	identifiant int UNSIGNED NOT NULL,
	nom varchar(30) NOT NULL,
	type enum('Eleveur', 'Cirque', 'Centre Equestre', 'Parc Aquatique') NOT NULL,

	PRIMARY KEY (identifiant),
	FOREIGN KEY (identifiant) REFERENCES V_PROPRIETAIRE(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

/* V_PARTICULIER et V_ENTREPRISE héritent de V_PROPRIETAIRE */

ALTER TABLE V_PROPRIETAIRE AUTO_INCREMENT = 1;

/* Insertions */

INSERT INTO V_PROPRIETAIRE 
	VALUES (1, 'La plage', '98300', 'Suncity', 'Danemark', 0193094039);
	
INSERT INTO V_ENTREPRISE 
	VALUES (1, 'AquaPark', 'parc aquatique');

