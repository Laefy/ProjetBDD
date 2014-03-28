/* Création de la table V_CONSULTATION */

CREATE TABLE IF NOT EXISTS V_CONSULTATION 
(   
	identifiant int NOT NULL AUTO_INCREMENT,
	date timestamp(12) NOT NULL,
	duree time NOT NULL,
	probleme varchar(50),
	diagnostic varchar(200),
	resumeManip varchar(200),
	identifiantTraitement int, 

	PRIMARY KEY (identifiant),
	FOREIGN KEY (identifiantTraitement) REFERENCES V_TRAITEMENT(identifiant)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);