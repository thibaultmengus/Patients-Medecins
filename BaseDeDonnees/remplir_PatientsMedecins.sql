INSERT INTO personne(nom,prenom,telephone,mail,password) VALUES ('sartre'   ,'jean'   ,'+33612256876','jean.sartre@gmail.com','azerty');
INSERT INTO personne(nom,prenom,telephone,mail,password) VALUES ('menot'    ,'bastien','+33648853512','bastien.menot@gmail.com','azerty');
INSERT INTO personne(nom,prenom,telephone,mail,password) VALUES ('lihoreau' ,'david'  ,'+33771690013','d.lihoreau@gmail.com','ouestlemd5');
INSERT INTO personne(nom,prenom,telephone,mail,password) VALUES ('skywalker','luc'    ,'+33697488522','l.skywalker@gmail.com','motdepasse');
INSERT INTO personne(nom,prenom,telephone,mail,password) VALUES ('sebastien','patrick','+33669430034','etonfaittournerlesserviettes@gmail.com','123456');
INSERT INTO personne(nom,prenom,telephone,mail,password) VALUES ('rabiot'   ,'adrien' ,'+33769332655','adrienrabbit@gmail.com','qwerty');

INSERT INTO medecin(idMedecin,adresse,cp,ville)
	SELECT idPersonne,'12 rue rivoli','75016','Paris'
	FROM personne WHERE mail="jean.sartre@gmail.com";

INSERT INTO medecin(idMedecin,adresse,cp,ville)
	SELECT idPersonne,'33 avenue charles de gaulle','92000','Nanterre'
	FROM personne WHERE mail="bastien.menot@gmail.com";

INSERT INTO medecin(idMedecin,adresse,cp,ville)
	SELECT idPersonne,'67 avenue des malandrins','75019','Paris'
	FROM personne WHERE mail="etonfaittournerlesserviettes@gmail.com";
