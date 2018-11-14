<?php
session_start();

require_once '../../fonctionsUtiles.inc.php';
require_once '../../fonctionsBdd.php';

$bdd = new \fonctionsBdd();
$bdd->ajouteRendezVous($_POST['idMedecin'], $_POST['Date'].' '.$_POST['Horaire'].':00');
header('Location: ./accueil.php');
exit;
?> 