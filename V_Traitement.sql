/* Création de la table V_TRAITEMENT */

CREATE TABLE IF NOT EXISTS V_TRAITEMENT 
(
	identifiant int UNSIGNED NOT NULL AUTO_INCREMENT,
	produit varchar(30) NOT NULL,
	dilution varchar(20),
	frequence varchar(20),
	dose varchar(20),
	duree varchar(20) NOT NULL,

	PRIMARY KEY(identifiant)
);