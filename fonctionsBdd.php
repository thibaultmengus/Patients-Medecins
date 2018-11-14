<?php

require_once 'fonctionsUtiles.inc.php';

class fonctionsBdd
{
    
    /**
     * 
     * @var $bdd base de donnée à laquelle se connecter
     */
    public $bdd;

    /**
     * Constructeur de la classe qui permet de se connecter à la base de donnée
     */
    function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=PatientsMedecins;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : impossible de se connecter à la base de donnée, le site est inaccessible.');
        }
    }

    /**
     * @param $requete Requete à envoyer à la BDD
     * retourne le résultat de la requête
     */
    public function execute($requete, $hasMultiplesLines = false)
	{
		$requete->execute();
        if ($hasMultiplesLines)
            return $requete->fetchAll(PDO::FETCH_ASSOC);
        else
            return $requete->fetch(PDO::FETCH_ASSOC);
	}
	
    /**
     * @param $email adresse mail saisie par l'utilisateur qui veut se connecter
     * @param $mdp mot de passe saisie par l'utilisateur qui veut se connecter
     * retourne true si l'identifiant et le mot de passe entrés correspondent et affecte la variable de
     * session 'estMedecin' à true si c'est un médecin, à false sinon
     */
    public function connexion($email, $mdp)
    {
        $requete = $this->bdd->prepare('SELECT idPersonne, mail, password, nom, prenom FROM Personne WHERE mail = :inputEmail');
        $requete->bindValue(':inputEmail', htmlspecialchars($email));
        $data = $this->execute($requete);

        if ($data['password'] == $mdp) { //rajouter le md5 après!
            $requete = $this->bdd->prepare('SELECT idMedecin FROM Medecin WHERE idMedecin = :idPersonne');
            $requete->bindValue(':idPersonne', $data['idPersonne']);
			$data2 = $this->execute($requete);
            $_SESSION['estMedecin'] = ! empty($data2['idMedecin']);
            if($_SESSION['estMedecin'])
                $_SESSION['idMedecin'] = $data2['idMedecin'];
            $_SESSION['estConnecte'] = true;
            $_SESSION['idPersonne'] = $data['idPersonne'];
            $_SESSION['identifiant'] = $data['nom'] . ' ' . $data['prenom'];
            return true;
        }
        else
            return false;
    }
	
	public function getMedecins()
	{
		$requete = $this->bdd->prepare('SELECT nom, prenom FROM viewMedecin');
		return $this->execute($requete, true);
	}
	
	public function rechercheMedecin($nom, $specialite, $ville)
	{
		$requete = $this->bdd->prepare('SELECT M.nom, M.prenom, S.specialite, M.adresse, M.codePostal, M.ville FROM Personne P JOIN Medecin M ON M.idMedecin=P.idPersonne JOIN Specialite S ON M.idSpecialite=S.idSpecialite WHERE M.nom LIKE "%:nom%" AND S.specialite LIKE "%:specialite%" AND M.ville LIKE "%:ville%"');
        $requete->bindValue(':nom', $nom);
        $requete->bindValue(':specialite', $specialite);
        $requete->bindValue(':ville', $ville);
		return $this->execute($requete);
	}
	
	/**
     * @param $idMedecin ID du médecin du rendez-vous pris
     * @param $creneauHoraire Créneau horaire du rendez-vous pris
     * Réserve une consultation pour le patient connecté
     */
	public function ajouteRendezVousPatient($idMedecin, $creneauHoraire)
	{
		$requete = $this->bdd->prepare('UPDATE Consultation SET idPersonne = :idPersonne WHERE idMedecin=:idMedecin AND creneauHoraire=:creneauHoraire');
		$requete->bindValue(':idPersonne', $_SESSION['idPersonne']);
		$requete->bindValue(':idMedecin', $idMedecin);
		$requete->bindValue(':creneauHoraire', $creneauHoraire);
		$this->execute($requete);
	}
	
	/**
     * @param $idMedecin ID du médecin du rendez-vous pris
     * @param $creneauHoraire Créneau horaire du rendez-vous pris
     * Supprime une consultation pour le patient connecté
     */
	public function supprimeRendezVousPatient($idMedecin, $creneauHoraire)
	{
		$requete = $this->bdd->prepare('UPDATE Consultation SET idPersonne = NULL WHERE idMedecin=:idMedecin AND creneauHoraire=:creneauHoraire');
		$requete->bindValue(':idPersonne', $_SESSION['idPersonne']);
		$requete->bindValue(':idMedecin', $idMedecin);
		$requete->bindValue(':creneauHoraire', $creneauHoraire);
		$this->execute($requete);
	}
	
	/**
     * @param $idMedecin ID du médecin sélectionné
     * Consulte les rendez-vous du médecin sélectionné
     */
	public function consulteRendezVousLibres($idMedecin)
	{
		$requete = $this->bdd->prepare('SELECT * FROM consultationMedecinLibre WHERE idMedecin=:idMedecin');
		$requete->bindValue(':idMedecin', $idMedecin);
		return $this->execute($requete);
	}
	
	/**
     * Consulte les rendez-vous du médecin connecté
     */
	public function consulteRendezVousPatient($start, $end)
	{
		$requete = $this->bdd->prepare("SELECT * FROM consultationPatient WHERE idPersonne=:idPersonne");
        $requete->bindValue(':idPersonne', $_SESSION['idPersonne']);
		$ret = $this->execute($requete, true);
        return $ret;
	}
    	
	/**
     * @param $creneauHoraire Créneau horaire du rendez-vous à ajouter
     * Ajoute un rendez-vous pour le médecin connecté
     */
	public function ajouteRendezVousMedecin($creneauHoraire)
	{
		$requete = $this->bdd->prepare('INSERT INTO Consultation (idMedecin, creneauHoraire) VALUES (:idMedecin, :creneauHoraire)');
		$requete->bindValue(':idMedecin', $_SESSION['idPersonne']);
		$requete->bindValue(':creneauHoraire', $creneauHoraire);
		$this->execute($requete);
	}
	
	/**
     * @param $creneauHoraire Créneau horaire du rendez-vous à ajouter
     * Supprime un rendez-vous pour le médecin connecté
     */
	public function supprimeRendezVousMedecin($creneauHoraire)
	{
		$requete = $this->bdd->prepare('DELETE FROM Consultation WHERE idMedecin=:idMedecin AND creneauHoraire=:creneauHoraire;');
		$requete->bindValue(':idMedecin', $_SESSION['idPersonne']);
		$requete->bindValue(':creneauHoraire', $creneauHoraire);
		$this->execute($requete);
	}
	
	/**
     * Consulte les rendez-vous du médecin connecté
     */
	public function consulteRendezVousMedecin()
	{
		$requete = $this->bdd->prepare('SELECT * FROM consultationMedecinOccupe WHERE idMedecin=:idMedecin');
		$requete->bindValue(':idMedecin', $_SESSION['idPersonne']);
		return $this->execute($requete, true);
	}
	
    public function inscription($tab) {
        try {
            // Dans tous les cas :
            $requete_personne = $this->bdd->prepare('INSERT INTO Personne (mail, password, nom, prenom, telephone) VALUES (:mail, :password, :nom, :prenom, :telephone)');
            $requete_personne->bindValue('mail',htmlspecialchars($tab['inputIdentifiant']));
            $requete_personne->bindValue('password',htmlspecialchars($tab['inputPassword']));
            $requete_personne->bindValue('nom',htmlspecialchars($tab['inputNom']));
            $requete_personne->bindValue('prenom',htmlspecialchars($tab['inputPrenom']));
            $requete_personne->bindValue('telephone',htmlspecialchars($tab['inputNumeroTelephone']));
            $requete_reponse_personne = $this->execute($requete_personne);
            // on récupère l'id Personne
            $requete_getIdPersonne = $this->bdd->prepare('SELECT idPersonne FROM Personne WHERE mail = :mailCheck');
            $requete_getIdPersonne->bindValue(':mailCheck', htmlspecialchars($tab['inputIdentifiant']));
            $requete_getIdPersonne = $this->execute($requete_getIdPersonne);
    
            // S'il a coché la checkbox "est médecin" :
            if($tab['inscriptionMedecin'] === "1") {
                $requete_medecin = $this->bdd->prepare('INSERT INTO Medecin(idMedecin, adresse, codePostal, ville) VALUES (:idPersonne, :adresse, :codePostal, :ville)');
                $requete_medecin->bindValue('adresse',htmlspecialchars($requete_getIdPersonne['idPersonne']));
                $requete_medecin->bindValue('adresse',htmlspecialchars($tab['inputAdresse']));
                $requete_medecin->bindValue('codePostal',htmlspecialchars($tab['inputCodePostal']));
                $requete_medecin->bindValue('ville',htmlspecialchars($tab['inputVille']));
                $requete_reponse_medecin = $this->bdd->execute();
            }
            return true;
        } catch (Exception $e) {
            die('Erreur : impossible de se s\'inscrire.');
        }
    }

    public function editInfo($tab){
        $requete_update = $this->bdd->prepare("UPDATE Personne SET mail = :mail  ,nom = :nom, prenom = :prenom, telephone = :telephone WHERE idPersonne = :idPersonne");
        $requete_update->bindValue(':mail',editMail(htmlspecialchars($tab['mail'])) );
        $requete_update->bindValue(':nom',editNom(htmlspecialchars($tab['nom'])) );
        $requete_update->bindValue(':prenom',editPrenom(htmlspecialchars($tab['prenom'])) );
        $requete_update->bindValue(':telephone',editTelephone(htmlspecialchars($tab['prenom'])) );
        $requete_update->bindValue(':idPersonne',htmlspecialchars($_SESSION['idPersonne']));

    }


    //il faut verifier si le nouvel email existe deja dans la base
    public function editMail($tab){
        $requete_update = $this->bdd->prepare("UPDATE Personne SET prenom = :mail WHERE idPersonne = :idPersonne");
        $req_check = $this->bdd->prepare("SELECT 'mail existe' FROM Personne WHERE EXISTS (SELECT mail FROM Personne where mail = :mail) limit 1");
        $req_check->bindValue(":mail",$tab['mail']);
        $req_check->bindValue(':idPersonne',htmlspecialchars($_SESSION['idPersonne']));

        $req_check->execute();

        if(!isset($req_check)){
            if (isset($tab['mail']) ){
                $requete_update->bindValue(':mail',$tab['mail']);
                $requete_update->execute();
                return true;
            }
        }
        if (isset($tab['mail']) ){
            $requete_update->bindValue(':mail',$tab['mail']);
            $requete_update->execute();
            return true;
        }
        else
            return false;
    }

    public function editPrenom($tab){
        $requete_update = $this->bdd->prepare("UPDATE Personne SET prenom = :prenom WHERE idPersonne = :idPersonne");
        $requete_update->bindValue(':idPersonne',htmlspecialchars($_SESSION['idPersonne']));

        if (isset($tab['prenom']) ){
            $requete_update->bindValue(':prenom',$tab['prenom']);
            $requete_update->execute();
            return true;
        }
        else return false;
    }

    public function editNom($tab){
        $requete_update = $this->bdd->prepare("UPDATE Personne SET nom = :nom WHERE idPersonne = :idPersonne");
        $requete_update->bindValue(':idPersonne',htmlspecialchars($_SESSION['idPersonne']));
        if (isset($tab['nom']) ){
            $requete_update->bindValue(':nom',$tab['nom']);
            $requete_update->execute();
            return true;
        }
        else return false;
    }


    public function editTelephone($tab){
        $requete_update = $this->bdd->prepare("UPDATE Personne SET telephone = :telephone WHERE idPersonne = :idPersonne");
        $requete_update->bindValue(':idPersonne',htmlspecialchars($_SESSION['idPersonne']));
        if (isset($tab['telephone']) ){
            $requete_update->bindValue(':telephone',$tab['telephone']);
            $requete_update->execute();
            return true;
        }
        else return false;
    }



    public function editInfoMedecin($tab){
            $requete_update = $this->bdd->prepare("UPDATE medecin SET  adresse = :adresse , codePostal = :codePostal , ville = :ville WHERE idMedecin = :medecin ");
            $requete_update->bindValue(':medecin',htmlspecialchars($_SESSION['idMedecin']));
        $requete_update->bindValue(':adresse',editCodePostal(htmlspecialchars($tab['adresse']) ));
        $requete_update->bindValue(':codePostal',editCodePostal( htmlspecialchars($tab['codePostal']) ));
        $requete_update->bindValue(':ville',editVille(htmlspecialchars($tab['ville'])) );
        }

    public function editAdresse($tab){
        $requete_update = $this->bdd->prepare("UPDATE medecin SET adresse = :adresse WHERE idMedecin = :medecin");
        $requete_update->bindValue(':medecin',htmlspecialchars($_SESSION['idMedecin']));

        if (isset($tab['adresse']) ){
            $requete_update->bindValue(':adresse',$tab['adresse']);
            $requete_update->execute();
            return true;
        }
        else return false;
    }

    public function editCodePostal($tab){
        $requete_update = $this->bdd->prepare("UPDATE medecin SET codePostal = :codePostal WHERE idMedecin = :medecin");
        $requete_update->bindValue(':medecin',htmlspecialchars($_SESSION['idMedecin']));

        if (isset($tab['codePostal']) ){
            $requete_update->bindValue(':codePostal',$tab['codePostal']);
            $requete_update->execute();
            return true;
        }
        else return false;
    }

    public function editVille($tab){
        $requete_update = $this->bdd->prepare("UPDATE medecin SET ville = :ville WHERE idMedecin = :medecin");
        $requete_update->bindValue(':medecin',htmlspecialchars($_SESSION['idMedecin']));

        if (isset($tab['ville']) ){
            $requete_update->bindValue(':ville',$tab['ville']);
            $requete_update->execute();
            return true;
        }
        else return false;
    }

}
?>
