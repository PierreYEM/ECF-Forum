<?php

require_once('./src/models/User.php');
/* Appel du modèle functions pour vérifier les inputs */
require_once('./src/lib/functions.php');

if (isset($_POST) && !empty($_POST)) {
    if ($_POST['answer'] == 11) { 
        $success="Bonne réponse !";
    } else {
        
        $failed="La réponse est incorrecte.";
    }
}

require_once('./templates/test_register_template.php');