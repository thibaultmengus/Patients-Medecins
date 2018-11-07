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

-- Cas 4 : Chercher un créneau
SELECT C.creneauHoraire, M.

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

-- Cas 1 : 
-- Cas 1 : 
-- Cas 1 : 
-- Cas 1 : 



-- Cas 1 : Création d'un compte joueur (Test résidant en France, non Admin, mot de passe ******)
INSERT INTO PLAYERS (name, password, isAdmin, points, code)
	SELECT 'Test', '******', false, 0, code
	FROM COUNTRIES
	WHERE country_name='FRANCE';

-- Cas 2 : Accéder au classement général
SELECT P.code, P.name, P.points
FROM PLAYERS P
ORDER BY P.points;

-- Cas 3 : Accéder au classement général de la France
SELECT code, P.name, P.points
FROM PLAYERS P NATURAL JOIN COUNTRIES C
WHERE C.country_name='FRANCE'
ORDER BY P.points;

-- Cas 4 : Accéder au classement de la chanson Song
SELECT P.code, id_player, P.name, MAX(SC.score) AS 'score'
FROM PLAYERS P NATURAL JOIN SCORES SC NATURAL JOIN CHARTS C NATURAL JOIN SONGS SO
WHERE SC.isValidated=true AND song_name='Song'
GROUP BY P.code, id_player, P.name
ORDER BY MAX(SC.score);

-- Cas 5 : Accéder aux informations des chansons
SELECT S.song_name, S.bpm, S.length, S.lengthAdj, MIN(C.blocks) AS 'Diff min', MAX(C.blocks) AS 'Diff max'
FROM SONGS S NATURAL JOIN CHARTS C
GROUP BY S.song_name, S.bpm, S.length, S.lengthAdj;

-- Cas 6 : Accéder aux informations de la chanson Song
SELECT D.difficulty_name, C.blocks, C.steps, C.breakdown
FROM SONGS S NATURAL JOIN CHARTS C NATURAL JOIN DIFFICULTIES D
WHERE S.song_name='Song';

-- Cas 7 : Afficher les scores du joueur Test
SELECT S.song_name, MAX(SC.score) AS 'score'
FROM PLAYERS P NATURAL JOIN SCORES SC NATURAL JOIN CHARTS C NATURAL JOIN SONGS S
WHERE SC.isValidated=true AND P.name='Test'
GROUP BY S.id_song
ORDER BY MAX(SC.score);

--
-- Cas Joueurs
--

-- Cas 8 : Le joueur Test change son pseudo en Player
UPDATE PLAYERS
SET name='Player'
WHERE name='Test';

-- Cas 9 : Le joueur Player change son Pays en Afghanistan
UPDATE PLAYERS
SET PLAYERS.code = (
    SELECT code
    FROM COUNTRIES
    WHERE country_name = 'Afghanistan'
    )
WHERE name = 'Player';
	
-- Cas 10 : Le joueur Player change son Password en Password
UPDATE PLAYERS
SET password = 'Password'
WHERE name='Player';

-- Cas 11 : La joueur Player soumet un score de 80,01% sur la chart Challenge de la chanson Song
INSERT INTO SCORES (date_score, score, points, isValidated, id_player, id_chart) VALUES
	(NOW(), 0.8001, 20, false, 1, 1);

--
-- Cas Administrateurs
--

-- Cas 12 : Un administrateur ajoute un pays
INSERT INTO COUNTRIES (country_name, code) VALUES
	('Afghanistan', 'AFG');
	
-- Cas 13 : Un administrateur ajoute une difficulté
INSERT INTO DIFFICULTIES (id_difficulty, difficulty_name) VALUES
	(1, 'Beginner');
	
-- Cas 14 : Un administrateur ajoute une chanson
INSERT INTO SONGS (division, song_name, bpm, length, lengthAdj) VALUES
	(true, 'Song', 150, 300, 270);

-- Cas 15 : Un administrateur ajoute une chart
INSERT INTO CHARTS (blocks, steps, breakdown, id_difficulty, id_song) VALUES
	(15, 4000, '19 (8) 200', 5, 1);

-- Cas 16 : Un administrateur ajoute une médaille
INSERT INTO MEDALS (medal_name) VALUES
	('ss');

-- Cas 17 : Un administrateur ajoute un niveau de médaille
INSERT INTO MEDAL_LEVELS (id_level, level_name) VALUES
	(1, 'Bronze');

-- Cas 18 : Un administrateur accède à la liste des scores en attente de validation
SELECT P.name, SO.song_name, D.difficulty_name, SC.score
FROM PLAYERS P NATURAL JOIN SCORES SC NATURAL JOIN CHARTS C NATURAL JOIN DIFFICULTIES D NATURAL JOIN SONGS SO
ORDER BY SC.date_score ASC;

-- Cas 19 : Un administrateur valide le score d'id 1
UPDATE SCORES
SET isValidated = true
WHERE id_score = 1;

-- Cas 20 : Un administrateur refuse / supprime le score d'id 1
DELETE FROM SCORES
WHERE id_score = 1;