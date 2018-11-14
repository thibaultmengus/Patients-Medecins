<!DOCTYPE html">
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <title>Free Medecine</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/entete.css">
  <link rel="stylesheet" type="text/css" href="css/menu_deroulant.css">
  <link rel="stylesheet" type="text/css" href="css/board.css">
  <link rel="stylesheet" type="text/css" href="css/button.css">
  <link rel="stylesheet" type="text/css" href="css/page_creation_fiche.css">
  <link rel="icon" href="img/logoSite.ico">
</head>
  
  <body>
  <?php session_start();
  ?>

  <a href="..\page.connexion\formulaireConnexion.php" class="Connexion" div="Connexion">Connexion </a>

  <a href="..\page.inscription\creation_compte.php" class="Inscription" div="Inscription">Inscription </a>
	

  <div id="conteneur">    
    <h1 id="header"><a href="#" title="Free Medecine - Accueil"><span>Free Medecine</span></a>  </h1>
    <nav>
      <ul id="menu"></ul>
    </nav>	

    <div id="contenu">
      <h2>Bienvenue sur Free Medecine !</h2>
      <p>Premier site de France en médecine </p>
    </div>
    
    <p id="footer">Réaliser par Enes, Thibaut, Pierrick, Paul, Alexis</p>
  </div>
  </body>
</html>