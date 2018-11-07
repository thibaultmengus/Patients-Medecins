<?php 
include '/opt/lampp/htdocs/mesFichiersPHP/SEA-/fonctionsBdd.php';
include '/opt/lampp/htdocs/mesFichiersPHP/SEA-/fonctionsUtiles.inc.php';

$bdd = new fonctionsBdd();
print_r($bdd->droitsCompte('thibaut_mengus@hotmail.fr'));
if(estEtudiant($bdd->droitsCompte('thibaut_mengus@hotmail.fr')))
    echo '<p>Tu es un étudiant</p>';
else
    echo '<p>Tu n\'es pas un étudiant</p>';
?>