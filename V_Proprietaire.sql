/* Création de la table V_PROPRIETAIRE */

CREATE TABLE IF NOT EXISTS V_LOCALITE
(
	codepostal mediumint(5) NOT NULL,
	libelle varchar(20) NOT NULL,

	PRIMARY KEY (codepostal)
);

CREATE TABLE IF NOT EXISTS V_PROPRIETAIRE
(
	identifiant mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	adresse varchar(50),
	localite mediumint(5),
	numerotelephone char(10),

	PRIMARY KEY (identifiant),

	FOREIGN KEY (localite) REFERENCES V_LOCALITE(codepostal)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

/* V_PARTICULIER et V_ENTREPRISE héritent de V_PROPRIETAIRE */

CREATE TABLE IF NOT EXISTS V_PARTICULIER
(
	identifiant mediumint UNSIGNED NOT NULL,
	nom varchar(20) NOT NULL,
	prenom varchar(20) NOT NULL,

	PRIMARY KEY (identifiant),

	FOREIGN KEY (identifiant) REFERENCES V_PROPRIETAIRE(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS V_ENTREPRISE
(
	identifiant mediumint UNSIGNED NOT NULL,
	nom varchar(30) NOT NULL,
	type enum('Eleveur', 'Cirque', 'Centre Equestre', 'Parc Aquatique', 'Parc Zoologique', 'Brigade Canine', 'Refuge') NOT NULL,

	PRIMARY KEY (identifiant),

	FOREIGN KEY (identifiant) REFERENCES V_PROPRIETAIRE(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);


