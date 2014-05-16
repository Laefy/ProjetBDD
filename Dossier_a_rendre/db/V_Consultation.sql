/* Création de la table V_CONSULTATION */

CREATE TABLE IF NOT EXISTS V_CONSULTATION 
(   
	identifiant mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	date timestamp NOT NULL,
	lieu enum('cabinet', 'hors cabinet') NOT NULL,
	duree timestamp NULL,
	client mediumint UNSIGNED NOT NULL,

	PRIMARY KEY (identifiant), 

	FOREIGN KEY (client) REFERENCES V_PROPRIETAIRE(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

/* Création de la table V_SOINS */

CREATE TABLE IF NOT EXISTS V_SOINS
(
	consultation mediumint UNSIGNED NOT NULL,
	animal mediumint UNSIGNED NOT NULL,
	anamnese varchar(50),
	diagnostic varchar(100),
	manipulation varchar(100),		/* NULL si pas de manipulations osthéopathiques */
	traitement mediumint UNSIGNED,	/* NULL si aucun traitement prescrit */

	PRIMARY KEY (consultation, animal),

	FOREIGN KEY (consultation) REFERENCES V_CONSULTATION(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	FOREIGN KEY (animal) REFERENCES V_ANIMAL(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	FOREIGN KEY (traitement) REFERENCES V_TRAITEMENT(identifiant)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);
