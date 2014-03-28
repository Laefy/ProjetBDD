/* Création de la table V_Proprietaire */

CREATE TABLE V_Proprietaire
(
	identifiant int UNSIGNED NOT NULL AUTOINCREMENT,
	nom varchar(50) NOT NULL,
	prenom varchar(20),
	type enum('particulier', 'eleveur', 'centre equestre', 'cirque') NOT NULL,
	adresse varchar(50),
	codepostal mediumint(5),
	ville varchar(20),
	pays varchar(2),
	numerotelephone bigint(10),

	PRIMARY KEY (identifiant)
);