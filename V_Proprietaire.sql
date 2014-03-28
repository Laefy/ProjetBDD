/* Création de la table V_PROPRIETAIRE */

CREATE TABLE IF NOT EXISTS V_PROPRIETAIRE
(
	identifiant int UNSIGNED NOT NULL AUTOINCREMENT,
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
	nom varchar(30) NOT NULL;
	type enum('eleveur', 'cirque', 'centre equestre') NOT NULL,

	PRIMARY KEY (identifiant),
	FOREIGN KEY (identifiant) REFERENCES V_PROPRIETAIRE(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

/* V_PARTICULIER et V_ENTREPRISE héritent de V_PROPRIETAIRE */