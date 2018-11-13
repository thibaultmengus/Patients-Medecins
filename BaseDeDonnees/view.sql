CREATE OR REPLACE VIEW viewMedecin AS
SELECT *
FROM Personne P
JOIN Medecin M ON P.idPersonne=M.idMedecin
;

CREATE OR REPLACE VIEW consultationPatient AS
SELECT M.idMedecin, C.idPersonne, C.creneauHoraire, P.nom, P.prenom, S.specialite, M.adresse, M.codePostal, M.ville
FROM Consultation C
JOIN Medecin M ON C.idMedecin=M.idMedecin
LEFT JOIN Personne P ON M.idMedecin=P.idPersonne
JOIN Specialite S ON M.idSpecialite=S.idSpecialite
WHERE C.idPersonne IS NOT NULL
;

CREATE OR REPLACE VIEW consultationMedecinOccupe AS
SELECT M.idMedecin, C.creneauHoraire, P.nom, P.prenom, P.mail, P.telephone
FROM Consultation C
JOIN Medecin M ON C.idMedecin=M.idMedecin
JOIN Personne P ON M.idMedecin=P.idPersonne
;

CREATE OR REPLACE VIEW consultationMedecinLibre AS
SELECT C.creneauHoraire, P.nom, P.prenom, S.specialite, M.adresse, M.codePostal, M.ville
FROM Consultation C
JOIN Medecin M ON C.idMedecin=M.idMedecin
JOIN Personne P ON M.idMedecin=P.idPersonne
JOIN Specialite S ON M.idSpecialite=S.idSpecialite
WHERE C.idPersonne IS NULL
;