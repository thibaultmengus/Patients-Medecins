INSERT INTO personne(nom,prenom,telephone) VALUES ('sartre'   ,'jean'   ,'+33612256876');
INSERT INTO personne(nom,prenom,telephone) VALUES ('menot'    ,'bastien','+33648853512');
INSERT INTO personne(nom,prenom,telephone) VALUES ('lihoreau' ,'david'  ,'+33771690013');
INSERT INTO personne(nom,prenom,telephone) VALUES ('skywalker','luc'    ,'+33697488522');
INSERT INTO personne(nom,prenom,telephone) VALUES ('sebastien','patrick','+33669430034');
INSERT INTO personne(nom,prenom,telephone) VALUES ('rabiot'   ,'adrien' ,'+33769332655');

INSERT INTO medecin(idMedecin,specialite,adresse,cp,ville)
	SELECT idPersonne,'généraliste','12 rue rivoli','75016','Paris'
	FROM personne WHERE nom="sartre" AND prenom="jean";

INSERT INTO medecin(idMedecin,specialite,adresse,cp,ville)
	SELECT idPersonne,'généraliste','33 avenue charles de gaulle','92000','Nanterre'
	FROM personne WHERE nom="menot" AND prenom="bastien";

INSERT INTO medecin(idMedecin,specialite,adresse,cp,ville)
	SELECT idPersonne,'généraliste','67 avenue des malandrins','75019','Paris'
	FROM personne WHERE nom="lihoreau" AND prenom="david";
