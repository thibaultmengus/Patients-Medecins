#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Personne
#------------------------------------------------------------

CREATE TABLE Personne(
        idPersonne Int  Auto_increment  NOT NULL ,
        mail       Varchar (50) NOT NULL ,
        password   Varchar (255) NOT NULL ,
        nom        Varchar (50) NOT NULL ,
        prenom     Varchar (50) NOT NULL ,
        telephone  Varchar (12) NOT NULL
	,CONSTRAINT Personne_PK PRIMARY KEY (idPersonne)
);


#------------------------------------------------------------
# Table: Specialite
#------------------------------------------------------------

CREATE TABLE Specialite(
        idSpecialite Int  Auto_increment  NOT NULL ,
        specialite   Varchar (255) NOT NULL
	,CONSTRAINT Specialite_PK PRIMARY KEY (idSpecialite)
);


#------------------------------------------------------------
# Table: Medecin
#------------------------------------------------------------

CREATE TABLE Medecin(
        idMedecin    Int NOT NULL ,
        adresse      Varchar (255) NOT NULL ,
        codePostal   Int NOT NULL ,
        ville        Varchar (50) NOT NULL ,
        idSpecialite Int
	,CONSTRAINT Medecin_PK PRIMARY KEY (idMedecin)

	,CONSTRAINT Medecin_Personne_FK FOREIGN KEY (idMedecin) REFERENCES Personne(idPersonne)
	,CONSTRAINT Medecin_Specialite0_FK FOREIGN KEY (idSpecialite) REFERENCES Specialite(idSpecialite)
);


#------------------------------------------------------------
# Table: Consultation
#------------------------------------------------------------

CREATE TABLE Consultation(
        creneauHoraire     Datetime NOT NULL ,
        idMedecin          Int NOT NULL ,
        idPersonne		   Int
	,CONSTRAINT Consultation_PK PRIMARY KEY (creneauHoraire, idMedecin)

	,CONSTRAINT Consultation_Medecin_FK FOREIGN KEY (idMedecin) REFERENCES Medecin(idMedecin)
	,CONSTRAINT Consultation_Personne_FK FOREIGN KEY (idPersonne) REFERENCES Personne(idPersonne)
);
