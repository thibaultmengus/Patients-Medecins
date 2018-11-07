<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
</head>

<?php 
    session_start();   
    try{
        session_destroy();
    }
    catch(Exception $e)
    {
        echo'<script>Pas de connection</script>';  
    }
    echo'<script> alert("session detruite")</script>';  
    header("Location: ../page.connexion/formulaireConnexion.php");
?>

</html>