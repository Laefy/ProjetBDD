/* Création de la table V_TRAITEMENT */

CREATE TABLE IF NOT	EXISTS V_MEDICAMENT
(
	identifiant mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle varchar(20) NOT NULL UNIQUE,

	PRIMARY KEY (identifiant)
);

CREATE TABLE IF NOT EXISTS V_TRAITEMENT 
(
	identifiant mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	medicament mediumint UNSIGNED NOT NULL,
	dilution varchar(10),
	frequence varchar(10),
	dose varchar(10),
	duree varchar(10) NOT NULL,

	PRIMARY KEY (identifiant),

	FOREIGN KEY (medicament) REFERENCES V_MEDICAMENT(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);