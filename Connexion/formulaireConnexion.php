<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="icon" href="img/logoSite.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
</head>
<body>
	<div  class="text-center">
	 	<img id="logo" src="img/logoSite.ico" class="rounded" alt="...">
	</div>
	<h2 id="session" class="text-center col-lg-offset-3 col-lg-6">Ouvrir une session</h2>
	<div class="container-fluid">
  		<div class="row board-container col-lg-offset-3 col-lg-6 col-xs-13">
			<div id="board">
				<form method="POST" action="" >
				  	<div class="form-group " >
				    	<label for="inputEmail"></label>
				    	<input type="email" class="form-control" id="inputEmail" onclick="javascript:this.value = '';"
				    		   value="<?php if(isset($_POST[inputEmail])) echo $_POST[inputEmail]; else echo 'Adresse email'; ?>" >
				  	</div>
				  	<div class="form-group">
				    	<label for="inputPassword"></label>
				    	<input type="password" class="form-control" id="inputPassword" onclick="javascript:this.value = '';" >
				  	</div>
				  	<div class="form-check">
				    	<label class="form-check-label">
				      		<input type="checkbox" class="form-check-input">
				     		 Se souvenir de moi
				    	</label>
				  	</div>
				</form>
				<div id="buttonConnexion">
						Se connecter
		       	</div>
			</div>
		<a href="" id="mdpOublie" >Mot de passe oublié ?</a>
		<div id="footer"></div>
  		</div>

	</div>
	
</body>
</html>