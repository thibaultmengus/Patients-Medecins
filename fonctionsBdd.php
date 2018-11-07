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
            $this->bdd = new PDO('mysql:host=localhost;dbname=sea2;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : impossible de se connecter à la base de donnée, le site est inaccessible.');
        }
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
        $requete->execute();
        $data = $requete->fetch(PDO::FETCH_ASSOC);
        
        if ($data['password'] == md5(htmlspecialchars($mdp))) {
            $requete = $this->bdd->prepare('SELECT idMedecin FROM utilisateur WHERE idMedecin = :idPersonne');
            $requete->bindValue(':idPersonne', $data['idPersonne']);
            $requete->execute();
            $data2 = $requete->fetch(PDO::FETCH_ASSOC);
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