#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Personne
#------------------------------------------------------------

CREATE TABLE personne(
        idPersonne Int  Auto  NOT NULL ,
        nom        Varchar (50) NOT NULL,
        prenom     Varchar (50) NOT NULL,
        telephone  Varchar (12) NOT NULL,
	CONSTRAINT Personne_PK PRIMARY KEY (idPersonne)
)
ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Médecin
#------------------------------------------------------------

CREATE TABLE medecin(
        idPersonne Int NOT NULL ,
        specialite Varchar (50) NOT NULL ,
        adresse    Varchar (50) NOT NULL ,
        cp         Int NOT NULL ,
        ville      Varchar (50) NOT NULL,

	CONSTRAINT Medecin_PK PRIMARY KEY (idPersonne),
	CONSTRAINT Medecin_Personne_FK FOREIGN KEY (idPersonne) REFERENCES Personne(idPersonne)
)
ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Consultation
#------------------------------------------------------------

CREATE TABLE consultation(
        idPersonne         Int NOT NULL ,
        creneauHoraire     Datetime NOT NULL ,
        idPersonne_PRENDRE Int,

        CONSTRAINT Consultation_PK PRIMARY KEY (idPersonne,creneauHoraire),
	CONSTRAINT Consultation_Medecin_FK FOREIGN KEY (idPersonne) REFERENCES Medecin(idPersonne),
	CONSTRAINT Consultation_Personne0_FK FOREIGN KEY (idPersonne_PRENDRE) REFERENCES Personne(idPersonne)
)

ENGINE=InnoDB;

