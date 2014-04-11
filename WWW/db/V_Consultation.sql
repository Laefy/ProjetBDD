/* Création de la table V_CONSULTATION */

CREATE TABLE IF NOT EXISTS V_CONSULTATION 
(   
	identifiant int NOT NULL AUTO_INCREMENT,
	date time NOT NULL,
	duree timestamp NOT NULL,
	lieu enum('cabinet', 'hors cabinet'),

	PRIMARY KEY (identifiant)
);


/* Création de la table V_MANIPULATION */

CREATE TABLE IF NOT EXISTS V_MANIPULATION
{
	identifiant int NOT NULL AUTO_INCREMENT,
	resumeManip varchar(200),

	PRIMARY KEY (identifiant)
}


/* Création de la table V_SOINS */

CREATE TABLE IF NOT EXISTS V_SOINS
{
	identifiantConsultation int NOT NULL,
	identifiantAnimal int NOT NULL,
	anamnese varchar(50),
	diagnostic varchar(200),
	identifiantManipulation int,	/* NULL si pas de manipulation osthéopathiques */
	identifiantTraitement int,		/* NULL si aucun traitement prescrit */

	PRIMARY KEY (identifiantConsultation, identifiantAnimal),

	FOREIGN KEY (identifiantConsultation) REFERENCES V_CONSULTATION(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	FOREIGN KEY (identifiantAnimal) REFERENCES V_ANIMAL(identifiant)
		ON DELETE CASCADE
		ON UPDATE CASCADE,

	FOREIGN KEY (identifiantManipulation) REFERENCES V_MANIPULATION(identifiant)
		ON DELETE SET NULL
		ON UPDATE CASCADE,

	FOREIGN KEY (identifiantTraitement) REFERENCES V_TRAITEMENT(identifiant)
		ON DELETE SET NULL
		ON UPDATE CASCADE
}

