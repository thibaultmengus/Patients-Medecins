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
        $data = $this->sendRequest('SELECT idPersonne, mail, password, nom, prenom FROM Personne WHERE mail = :inputEmail');
        $requete->bindValue(':inputEmail', htmlspecialchars($email));
        $data = $this->execute($requete);
        
        if ($data['password'] == $mdp) { //rajouter le md5 après!
            $requete = $this->bdd->prepare('SELECT idMedecin FROM Medecin WHERE idMedecin = :idPersonne');
            $requete->bindValue(':idPersonne', $data['idPersonne']);
			$data2 = $this->execute($requete);
            $_SESSION['estMedecin'] = ! empty($data2['idMedecin']);
            $_SESSION['estConnecte'] = true;
            $_SESSION['identifiant'] = $data['nom'] . ' ' . $data['prenom'];
            return true;
        }
        else
            return false;
    }
}
?>