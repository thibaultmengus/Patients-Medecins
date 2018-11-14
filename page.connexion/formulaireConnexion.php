<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="formulaireConnexion.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="icon" href="img/logoSite.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
</head>
<body>
<?php
include '../fonctionsBdd.php';
include '../fonctionsUtiles.inc.php';
session_start();
$formulaire = '
<div  class="text-center">
    <img id="logo" src="img/logoSite.ico" class="rounded" alt="...">
</div>
<h2 id="session" class="text-center col-lg-offset-3 col-lg-6">Ouvrir une session</h2>
<div class="container-fluid">
    <div class="row board-container col-lg-offset-3 col-lg-6 col-xs-13">
        <div id="board">
            <form method="GET" action="formulaireConnexion.php">
            <div class="form-group " >
                <label for="inputEmail"></label>
                    <input name="inputEmail" type="text" class="form-control" id="inputEmail"
                    value="'; if(isset($_GET['inputEmail'])) $formulaire = $formulaire . $_GET['inputEmail'];
                    else $formulaire = $formulaire . "Adresse mail";
                    $formulaire = $formulaire . '" required>
		    </div>
			<div class="form-group">
			     <label for="inputPassword"></label>
				 <input name="inputPassword" type="text" class="form-control" id="inputPassword" value="Mot de passe" required>
			</div>
			<div class="form-check">
		    </div>
			<div id="buttonConnexion">
			     <input id ="boutonSubmit" type="submit" value="Se connecter"/>
			</div>
			</form>
		</div>
		<div id="footer">
        </div>
	</div>
</div>';

// Si l'utilsateur arrive pour la première fois sur la page, on lui propose le formulaire de connexion
if (! isset($_GET['inputEmail']) && !isset($_SESSION['estConnecte']) ) {
    echo $formulaire;

} else {   
    // S'il est déjà connecté, on redirige l utilisateur
    if(isset($_SESSION['estConnecte'])) {
        if($_SESSION['estMedecin'])
            header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.medecin/accueil.php');
        else
            header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.patient/accueil.php');
}
    
// Si le formulaire n'est pas bien rempli (champs vide, ou variable égale à null
if (! formulaireBienRempli($_GET)) {
        echo $formulaire . '<script> alert("Veuillez remplir tous les champs pour vous connecter") </script>';
        
    } else {
        $bdd = new fonctionsBdd();
        
        if ($bdd->connexion($_GET['inputEmail'], $_GET['inputPassword'])) {
            if($_SESSION['estMedecin'])
                header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.medecin/accueil.php');
            else
                header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.patient/accueil.php');
        } else {
            echo $formulaire . '<script> alert("Le mot de passe ou l\'identifiant entré n\'est pas correcte.") </script>';
        }
    }
}
?>
</body>



				    		   