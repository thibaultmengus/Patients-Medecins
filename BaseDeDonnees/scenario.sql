--
-- Cas Patient
--

-- Cas 1 : Ajouter un rendez-vous
UPDATE Consultation
SET idPersonne = $idPersonne
WHERE idMedecin=$idMedecin AND creneauHoraire=$creneauHoraire;

-- Cas 2 : Consulter les rendez-vous
SELECT C.creneauHoraire, M.nom, M.prenom, S.specialite, M.adresse, M.codePostal, M.ville
FROM Personne P
JOIN Consultation C ON P.idPersonne=C.idPersonne
JOIN (
	SELECT *
	FROM Medecin M
	JOIN Personne P ON M.idMedecin=P.idPersonne) M ON C.idMedecin=M.idMedecin
JOIN Specialite S ON M.idSpecialite=S.idSpecialite
-- WHERE P.idPersonne = $idPersonne
;

-- Cas 3 : Supprimer un rendez-vous
UPDATE Consultation
SET idPersonne = NULL
WHERE idMedecin=$idMedecin AND creneauHoraire=$creneauHoraire;

-- Cas 4 : Chercher un médecin
SELECT M.nom, M.prenom, S.specialite, M.adresse, M.codePostal, M.ville
FROM Personne P
FROM Medecin M ON M.idMedecin=P.idPersonne
JOIN Specialite S ON M.idSpecialite=S.idSpecialite
WHERE M.nom LIKE "%$nom%" AND S.specialite LIKE "%$specialite%" AND M.ville LIKE "%$ville%"
;

--
-- Cas Medecin
--

-- Cas 1 : Ajouter un rendez-vous
INSERT INTO Consultation (idMedecin, creneauHoraire) VALUES ($idMedecin, $creneauHoraire);

-- Cas 2 : Consulter les rendez-vous 
SELECT C.creneauHoraire, P.nom, P.prenom, P.telephone
FROM Medecin M
JOIN Consultation C ON M.idMedecin=C.idMedecin
JOIN Personne P ON C.idPersonne=P.idPersonne
-- WHERE M.idMedecin = $idMedecin
;

-- Cas 3 : Supprimer un rendez-vous
DELETE FROM Consultation
WHERE idMedecin=$idMedecin AND creneauHoraire=$creneauHoraire;