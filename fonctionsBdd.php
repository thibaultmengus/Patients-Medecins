<?php

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
    public function execute($requete)
	{
		$requete->execute();
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
        $requete = $this->sendRequest('SELECT idPersonne, mail, password, nom, prenom FROM Personne WHERE mail = :inputEmail');
        $requete->bindValue(':inputEmail', htmlspecialchars($email));
        $data = $this->execute($requete);
        
        if ($data['password'] == $mdp) { //rajouter le md5 après!
            $requete = $this->bdd->prepare('SELECT idMedecin FROM Medecin WHERE idMedecin = :idPersonne');
            $requete->bindValue(':idPersonne', $data['idPersonne']);
			$data2 = $this->execute($requete);
            $_SESSION['estMedecin'] = ! empty($data2['idMedecin']);
            $_SESSION['estConnecte'] = true;
            $_SESSION['idPersonne'] = $data['idPersonne'];
            $_SESSION['identifiant'] = $data['nom'] . ' ' . $data['prenom'];
            return true;
        }
        else
            return false;
    }
	
	/**
     * @param $idMedecin ID du médecin du rendez-vous pris
     * @param $creneauHoraire Créneau horaire du rendez-vous pris
     * Réserve une consultation pour le patient connecté
     */
	public function ajouteRendezVousPatient($idMedecin, $creneauHoraire)
	{
		$requete = $this->sendRequest('UPDATE Consultation SET idPersonne = :idPersonne WHERE idMedecin=:idMedecin AND creneauHoraire=:creneauHoraire')
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
		$requete = $this->sendRequest('UPDATE Consultation SET idPersonne = NULL WHERE idMedecin=:idMedecin AND creneauHoraire=:creneauHoraire')
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
		$requete = $this->sendRequest('SELECT * FROM consultationMedecinLibre WHERE idMedecin=:idMedecin')
		$requete->bindValue(':idMedecin', $idMedecin);
		return $this->execute($requete);
	}
	
	/**
     * @param $creneauHoraire Créneau horaire du rendez-vous à ajouter
     * Ajoute un rendez-vous pour le médecin connecté
     */
	public function ajouteRendezVousMedecin($creneauHoraire)
	{
		$requete = $this->sendRequest('INSERT INTO Consultation (idMedecin, creneauHoraire) VALUES (:idMedecin, :creneauHoraire)')
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
		$requete = $this->sendRequest('DELETE FROM Consultation WHERE idMedecin=:idMedecin AND creneauHoraire=:creneauHoraire;')
		$requete->bindValue(':idMedecin', $_SESSION['idPersonne']);
		$requete->bindValue(':creneauHoraire', $creneauHoraire);
		$this->execute($requete);
	}
	
	/**
     * Consulte les rendez-vous du médecin connecté
     */
	public function consulteRendezVousMedecin()
	{
		$requete = $this->sendRequest('SELECT * FROM consultationPatient WHERE idMedecin=:idMedecin')
		$requete->bindValue(':idMedecin', $_SESSION['idPersonne']);
		return $this->execute($requete);
	}
	
}
?>