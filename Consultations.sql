


CREATE TABLE IF NOT EXISTS V_CONSULTATIONS (
    
  IdConsultation int(11) NOT NULL auto_increment,
  IdTraitement int(11) ,  
  Jour varchar(10) NOT NULL,
  HeureConsul TIME NOT NULL,
  Duree TIME NOT NULL,
  Probleme varchar(50) ,
  Diagnostic varchar(200) ,
  ResumeManip varchar(200)
    
  PRIMARY KEY (IdConsultation)
  FOREIGN KEY (IdTraitement) REFERENCES V_TRAITEMENT(IdT)
			ON DELETE SET NULL
			ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS V_TRAITEMENT (
	
	IdT int(11) NOT NULL auto_increment,
	Produit varchar(50) NOT NULL,
	Dilution varchar(20),
	Frequence varchar(20),
	Doses varchar(20),
	DureeTraitement varchar(20) NOT NULL,
			ON DELETE SET NULL
			ON UPDATE CASCADE

	PRIMARY KEY(IdConsultation)
);