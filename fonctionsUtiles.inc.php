<?php

// Mettre du JS
// Si l'utilisateur ne laisse pas les champs vides ou seulement avec des espaces
// ou égale à null, la fonction renvoie false, sinon true
function formulaireBienRempli($tabPost)
{
    foreach ($tabPost as $val) {
        if (empty(trim($val)) || $val == null)
            return false;
    }
    return true;
}

function debug_to_console($data) {
 	$output = $data;
 	if (is_array($output))
 		$output = implode(',', $output);
	echo "<script>console.log('Debug Objects:" . $output . "');</script>";
}
?>