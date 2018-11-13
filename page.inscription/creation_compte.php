<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../entete/entete.css">
	<link rel="stylesheet" type="text/css" href="../menu_deroulant/menu_deroulant.css">
	<link rel="stylesheet" type="text/css" href="css/board.css">
	<link rel="stylesheet" type="text/css" href="css/button.css">
	<link rel="stylesheet" type="text/css" href="css/page_creation_fiche.css">
	<link rel="stylesheet" type="text/css" href="../user_dropdown/user_menu.css">
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
	<title>Cr�er un compte</title>
	<link rel="icon" href="img/logo_trans.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
</head>
<body>
	<?php
		include '../entete/entete.html';
		include '../menu_deroulant/menu_deroulant.html';
		include 'fonctionsBDDCreationCompte.php';
	
        session_start();
        print_r($_SESSION);
		$model = new Model();
		$model->entrePage();
		
		include '../user_dropdown/user_menu.php';
	?>


	<h2 id="creer" class="text-center col-lg-offset-3 col-lg-6">Créer un compte</h2>

	<div class="row board-container col-lg-offset-3 col-lg-6">
		<div class="container-fluid">
			<div id="board">
				<?php
					$model->creerCompte();
					print_r($_POST);
					//$model->testCombo();
					// value="<?php if(isset($_POST['inputId'])) echo $_POST['inputId']
				?>
				<form method="post" action="creation_compte.php">
					<div class="form-group">
				    	<label for="inputId">Identifiant :</label>
				    	<input type="text" class="form-control" id="inputId" name="inputId" >
					</div>
					<div class="form-group">
				    	<label for="inputMdp">Mot de passe :</label>
				    	<input type="text" class="form-control" name="inputMdp" >
					</div>
					<div class="form-group">
				    	<label for="inputMdpConf">Confirmer mot de passe :</label>
				    	<input type="text" class="form-control" name="inputMdpConf" >
					</div>
					<div class="form-group">
				    	<label for="inputNom">Nom :</label>
				    	<input type="text" class="form-control" name="inputNom" >
					</div>
					<div class="form-group">
				    	<label for="inputPrenom">Prénom :</label>
				    	<input type="text" class="form-control" name="inputPrenom" >
					</div>





					<table class="table table-responsive">
						<thead>
							<tr>
								<th>Type de compte</th>
								<th>Oui</th>
								<th>Non</th>
							</tr>
						</thead>
						<tbody>
							<form>
								<tr>
									<td>
										Créer une fiche
									</td>
									<td>
										<div class="radio">
										<label><input type="radio" name="optCreerFiche" value=1 ></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optCreerFiche" value=2 ></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										Modifier une fiche
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optModifierFiche" value=1></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optModifierFiche" value=2></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										Clôturer une fiche
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optCloturerFiche" value=1></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optCloturerFiche" value=2></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										Consulter une fiche
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optConsulterFiche" value=1></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optConsulterFiche" value=2></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										Modifier un suivi
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optModifierSuivi" value=1></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optModifierSuivi" value=2></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										Créer un compte
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optCreerCompte" value=1></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optCreerCompte" value=2></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										Modifier un compte
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optModifierCompte" value=1 ></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optModifierCompte" value=2 ></label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										Modifier site
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optModifierSite" value=1 ></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="optModifierSite" value=2 ></label>
										</div>
									</td>
								</tr>
							</form>
						</tbody>
					</table>

					<div id="buttonConnexion">
						<input type="submit" value="Créer" >
	       			</div>
				</form>




			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
