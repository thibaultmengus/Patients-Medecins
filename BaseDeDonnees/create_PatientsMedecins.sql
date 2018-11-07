#------------------------------------------------------------
# Table: Personne
#------------------------------------------------------------

CREATE TABLE Personne(
        idPersonne Int  Auto_increment NOT NULL,
		mail	   Varchar (50) NOT NULL,
		password   Varchar (255) NOT NULL,
        nom        Varchar (50) NOT NULL,
        prenom     Varchar (50) NOT NULL,
        telephone  Varchar (12) NOT NULL,

	CONSTRAINT Personne_PK PRIMARY KEY (idPersonne)
);


#------------------------------------------------------------
# Table: Medecin
#------------------------------------------------------------

CREATE TABLE Medecin(
        idMedecin   Int NOT NULL,
        specialite  Varchar (50) NOT NULL,
        adresse     Varchar (50) NOT NULL,
        codePostal  Int NOT NULL,
        ville       Varchar (50) NOT NULL,

	CONSTRAINT Medecin_PK PRIMARY KEY (idMedecin),
	CONSTRAINT Medecin_Personne_FK FOREIGN KEY (idMedecin) REFERENCES Personne(idPersonne)
);


#------------------------------------------------------------
# Table: Consultation
#------------------------------------------------------------

CREATE TABLE Consultation(
        idMedecin      Int NOT NULL,
        creneauHoraire Datetime NOT NULL,
        idPatient 	   Int,

	CONSTRAINT Consultation_PK PRIMARY KEY (idMedecin, creneauHoraire),
	CONSTRAINT Consultation_Medecin_FK FOREIGN KEY (idMedecin) REFERENCES Medecin(idMedecin),
	CONSTRAINT Consultation_Personne_FK FOREIGN KEY (idPatient) REFERENCES Personne(idPersonne)
);
