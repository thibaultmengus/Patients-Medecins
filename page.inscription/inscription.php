<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/entete.css">
	<link rel="stylesheet" type="text/css" href="../css/menu_deroulant.css">
	<link rel="stylesheet" type="text/css" href="../css/board.css">
	<link rel="stylesheet" type="text/css" href="../css/button.css">
	<link rel="stylesheet" type="text/css" href="../css/page_creation_personne.css">
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
	<title>Inscription</title>
	<link rel="icon" href="img/logo_trans.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
</head>
<body>
	<h2 id="creer" class="text-center col-lg-offset-3 col-lg-6">Créer un compte</h2>

	<div class="row board-container col-lg-offset-3 col-lg-6">
		<div class="container-fluid">
			<div id="board">
				<form method="post" action="inscription.php">
					<div class="form-group">
				    	<label for="inputIdentifiant">Adresse mail</label>
				    	<input type="text" class="form-control" id="inputIdentifiant" name="inputIdentifiant" >
					</div>
					<div class="form-group">
				    	<label for="inputPassword">Mot de passe</label>
				    	<input type="text" class="form-control" name="inputPassword" >
					</div>
					<div class="form-group">
				    	<label for="inputConfirmPassword">Confirmer mot de passe</label>
				    	<input type="text" class="form-control" name="inputConfirmPassword" >
					</div>
					<div class="form-group">
				    	<label for="inputNom">Nom</label>
				    	<input type="text" class="form-control" name="inputNom" >
					</div>
					<div class="form-group">
				    	<label for="inputPrenom">Prénom</label>
				    	<input type="text" class="form-control" name="inputPrenom" >
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
							<form>
								<tr>
									<td>
										Médecin ?
									</td>
									<td>
										<div class="radio">
										<label><input type="radio" name="inscriptionMedecin" value=1 ></label>
										</div>
									</td>
									<td>
										<div class="radio">
											<label><input type="radio" name="inscriptionMedecin" value=2 ></label>
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