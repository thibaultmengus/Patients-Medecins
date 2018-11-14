<?php

// Mettre du JS
// Si l'utilisateur ne laisse pas les champs vides ou seulement avec des espaces
// ou égale à null, la fonction renvoie false, sinon true
function formulaireBienRempli($tabPost) {
    foreach ($tabPost as $val) {
        if (empty(trim($val)) || $val == null)
            return false;
    }
    return true;
}
?>