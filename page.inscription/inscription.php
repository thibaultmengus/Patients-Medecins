<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/entete.css">
	<link rel="stylesheet" type="text/css" href="css/menu_deroulant.css">  
	<link rel="stylesheet" type="text/css" href="css/board.css">
	<link rel="stylesheet" type="text/css" href="css/button.css">
	<link rel="stylesheet" type="text/css" href="css/page_creation_personne.css">
	<link rel="stylesheet" type="text/css/" href="css/verificationFormulaire.css" >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="inscription.js"></script>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
	<title>Inscription</title>
	<link rel="icon" href="img/logo_trans.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
</head>
<body>
<?php
require '../fonctionsBdd.php';
require_once '../fonctionsUtiles.inc.php';
$formulaire = '
	<h2 id="creer" class="text-center col-lg-offset-3 col-lg-6">Créer un compte</h2>

	<div class="row board-container col-lg-offset-3 col-lg-6">
		<div class="container-fluid">
			<div id="board">
				<form method="POST" action="inscription.php">
					<div class="form-group">
				    	<label for="inputIdentifiant">Adresse mail</label>
				    	<input type="email" class="form-control" id="inputIdentifiant" name="inputIdentifiant" required>
					</div>
					<div class="form-group">
				    	<label for="inputPassword">Mot de passe</label>
				    	<input type="text" class="form-control" id="inputPassword" name="inputPassword" minlength="8" maxlength="12" required>
					</div>
					<div class="form-group">
				    	<label for="inputConfirmPassword">Confirmer mot de passe</label>
				    	<input type="text" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword" minlenght="8" maxlength="" disabled="disabled" required>
					</div>
					<div class="form-group">
				    	<label for="inputNom">Nom</label>
				    	<input type="text" class="form-control" id="inputNom" name="inputNom" required>
					</div>
					<div class="form-group">
				    	<label for="inputPrenom">Prénom</label>
				    	<input type="text" class="form-control" id="inputPrenom" name="inputPrenom" required>
					</div>
					<div class="form-group">
				    	<label for="inputNumeroTelephone">Téléphone</label>
				    	<input type="text" class="form-control" id="inputNumeroTelephone" name="inputNumeroTelephone" minlength="10" maxlength="10" required>
					</div>
					<table class="table table-responsive">
						<thead>
							<tr>
								<th></th>
								<th>Oui</th>
								<th>Non</th>
							</tr>
						</thead>
						<tbody>
								<th>
									Médecin ?
								</th>
								
								<td>
									<div class="radio">
										<label><input type="radio" name="inscriptionMedecin" id="checkboxEstMedecin" value=1></label>
									</div>
								</td>
								<td>
									<div class="radio">
										<label><input type="radio" name="inscriptionMedecin" id="checkboxEstPasMedecin" value=0 checked></label>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					
					<div class="form-group">
				    	<label for="inputAdresse" id="labelAdresse"></label>
				    	<input type="hidden" class="form-control" id="inputAdresse" name="inputAdresse" required>
					</div>
					<div class="form-group">
				    	<label for="inputVille" id="labelVille"></label>
				    	<input type="hidden" class="form-control" id="inputVille" name="inputVille" required>
					</div>
					<div class="form-group">
				    	<label for="inputCodePostal" id="labelCodePostal"></label>
				    	<input type="hidden" class="form-control" id="inputCodePostal" name="inputCodePostal" required>
					</div>
					
					<div id="buttonConnexion">
						<input type="submit" value="Créer" onSubmit="return validerMotDePasse(this);">
	       			</div>
				</form>
			</div>
		</div>
	</div>
    ';
// Si l'utilsateur arrive pour la première fois sur la page, on lui propose le formulaire de d'inscription
if (! isset($_POST['inputIdentifiant']) && !isset($_SESSION['estConnecte']) ) {
    echo $formulaire;
    
} else {
    // S'il est déjà connecté, on redirige l utilisateur
    if(isset($_SESSION['estConnecte'])) {
        if($_SESSION['estMedecin']) {
            echo '<script> alert("Veuillez d\'abord vous déconnecter afin de créer un compte.") </script>';
            header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.medecin/accueil.php');
            exit();
        }
        else {
            echo '<script> alert("Veuillez d\'abord vous déconnecter afin de créer un compte.") </script>';
            header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.patient/accueil.php');
            exit();
        }
    }
    else {
        $bdd = new fonctionsBdd();
        if ($bdd->inscription($_POST)) {
            if($_POST['inscriptionMedecin'] === "1") {
                echo '<script> alert("Vous vous êtes bien inscrits en tant que Médecin!") </script>';
                header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.connexion/formulaireConnexion.php?inputEmail=' . $_POST['inputIdentifiant'] . '&inputPassword=' . $_POST['inputPassword']);
                exit();
            }
            else {
                echo '<script> alert("Vous vous êtes bien inscrits en tant que Patient!") </script>';
                header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.connexion/formulaireConnexion.php?inputEmail=' . $_POST['inputIdentifiant'] . '&inputPassword=' . $_POST['inputPassword']);
                exit();
            }
        }
    }
}
?>
</body>
</html>