CREATE OR REPLACE VIEW consultation AS
SELECT C.idPersonne, C.creneauHoraire, P.nom, P.prenom, S.specialite, M.adresse, M.codePostal, M.ville
FROM Consultation C
JOIN Medecin M ON C.idMedecin=M.idMedecin
JOIN Personne P ON M.idMedecin=P.idPersonne
JOIN Specialite S ON M.idSpecialite=S.idSpecialite;