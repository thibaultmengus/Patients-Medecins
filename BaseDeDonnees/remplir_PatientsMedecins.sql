INSERT INTO Personne(nom, prenom, telephone, mail, password) VALUES
	('sartre'   , 'jean'   , '+33612256876', 'jean.sartre@gmail.com', 'azerty'),
	('menot'    , 'bastien', '+33648853512', 'bastien.menot@gmail.com', 'azerty'),
	('lihoreau' , 'david'  , '+33771690013', 'd.lihoreau@gmail.com', 'ouestlemd5'),
	('skywalker', 'luc'    , '+33697488522', 'l.skywalker@gmail.com', 'motdepasse'),
	('sebastien', 'patrick', '+33669430034', 'etonfaittournerlesserviettes@gmail.com', '123456'),
	('rabiot'   , 'adrien' , '+33769332655', 'adrienrabbit@gmail.com', 'qwerty');

INSERT INTO Specialite(specialite) VALUES
	('generaliste'),
	('orthodentiste');

INSERT INTO Medecin(idMedecin, adresse, codePostal, ville)
	SELECT idPersonne, '12 rue rivoli', 75016, 'Paris'
	FROM personne WHERE mail="jean.sartre@gmail.com";

INSERT INTO Medecin(idMedecin, adresse, codePostal, ville)
	SELECT idPersonne, '33 avenue charles de gaulle', 92000, 'Nanterre'
	FROM personne WHERE mail="bastien.menot@gmail.com";

INSERT INTO Medecin(idMedecin, adresse, codePostal, ville)
	SELECT idPersonne, '67 avenue des malandrins', 75019, 'Paris'
	FROM personne WHERE mail="etonfaittournerlesserviettes@gmail.com";

INSERT INTO Consultation(idMedecin, creneauHoraire)
	SELECT idPersonne, '2018-11-21 12:30:00'
	FROM personne WHERE mail="jean.sartre@gmail.com";
	INSERT INTO Consultation(idMedecin, creneauHoraire)
	SELECT idPersonne, '2018-11-23 13:30:00'
	FROM personne WHERE mail="jean.sartre@gmail.com";
INSERT INTO Consultation(idMedecin, creneauHoraire)
	SELECT idPersonne, '2018-11-14 12:30:00'
	FROM personne WHERE mail="jean.sartre@gmail.com";
INSERT INTO Consultation(idMedecin, creneauHoraire)
	SELECT idPersonne, '2018-11-14 12:30:00'
	FROM personne WHERE mail="bastien.menot@gmail.com";
INSERT INTO Consultation(idMedecin, creneauHoraire)
	SELECT idPersonne, '2018-11-23 12:30:00'
	FROM personne WHERE mail="jean.sartre@gmail.com";
INSERT INTO Consultation(idMedecin, creneauHoraire)
	SELECT idPersonne, '2018-11-25 12:30:00'
	FROM personne WHERE mail="jean.sartre@gmail.com";
