SET FEEDBACK OFF
SET LINESIZE 150
SET PAGESIZE 40


ALTER SESSION SET NLS_DATE_FORMAT = 'dd/mm/yyyy';

PROMPT --> DEBUT DU SCRIPT

** Requête SQL de création des tables **

DROP TABLE personne CASCADE CONSTRAINTS PURGE
/
DROP TABLE medecin CASCADE CONSTRAINTS PURGE
/
DROP TABLE consultation CASCADE CONSTRAINTS PURGE
/

PROMPT CREATION DES TABLES
#------------------------------------------------------------
# Table: Personne
#------------------------------------------------------------

CREATE TABLE personne(
        idPersonne Int  Auto_increment NOT NULL,
        nom        Varchar (50) NOT NULL,
        prenom     Varchar (50) NOT NULL,
        telephone  Varchar (12) NOT NULL,

	CONSTRAINT Personne_PK PRIMARY KEY (idPersonne)
);


#------------------------------------------------------------
# Table: Médecin
#------------------------------------------------------------

CREATE TABLE medecin(
        idMedecin Int NOT NULL,
        specialite Varchar (50) NOT NULL,
        adresse    Varchar (50) NOT NULL,
        cp         Int NOT NULL,
        ville      Varchar (50) NOT NULL,

	CONSTRAINT Medecin_PK PRIMARY KEY (idMedecin),
	CONSTRAINT Medecin_Personne_FK FOREIGN KEY (idMedecin) REFERENCES Personne(idPersonne)
);


#------------------------------------------------------------
# Table: Consultation
#------------------------------------------------------------

CREATE TABLE consultation(
        idMedecin          Int NOT NULL,
        creneauHoraire     Datetime NOT NULL,
        idPatient 		   Int,

	CONSTRAINT Consultation_PK PRIMARY KEY (idMedecin, creneauHoraire),
	CONSTRAINT Consultation_Medecin_FK FOREIGN KEY (idMedecin) REFERENCES Medecin(idMedecin),
	CONSTRAINT Consultation_Personne_FK FOREIGN KEY (idPatient) REFERENCES Personne(idPersonne)
);

