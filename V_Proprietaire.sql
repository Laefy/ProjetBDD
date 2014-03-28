/* Création de la table V_Proprietaire */

CREATE TABLE V_Proprietaire
(
	identifiant int UNSIGNED NOT NULL AUTOINCREMENT,
	adresse varchar(50),
	codepostal mediumint(5),
	ville varchar(20),
	pays varchar(2),
	numerotelephone bigint(10),

	PRIMARY KEY (identifiant)
);

CREATE TABLE V_Particulier
(
	identifiant int UNSIGNED NOT NULL,
	nom varchar(20) NOT NULL,
	prenom varchar(20) NOT NULL,

	PRIMARY KEY (identifiant),
	FOREIGN KEY (identifiant) REFERENCES V_Proprietaire(identifiant)
		ON DELETE cascade
		ON UPDATE cascade
);

CREATE TABLE V_Entreprise
(
	identifiant int UNSIGNED NOT NULL,
	nom varchar(30) NOT NULL;
	type enum('eleveur', 'cirque', 'centre equestre') NOT NULL,

	PRIMARY KEY (identifiant),
	FOREIGN KEY (identifiant) REFERENCES V_Proprietaire(identifiant)
		ON DELETE cascade
		ON UPDATE cascade
);

/* V_Particulier et V_Entreprise héritent de V_Proprietaire */