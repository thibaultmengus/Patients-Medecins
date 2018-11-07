<?php
$id = $_SESSION['id'];
if ($age == "oui")
{
// header("HTTP/1.1 301 Moved Permanently");
header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.patient/accueil.php');
}
else
{
header('Location: http://localhost/mesFichiersPHP/Patients-Medecins/page.medecin/accueil.php');
}
//ob_end_flush()
?> 