<?php

session_start();

/* Appel du modèle contenant la classe Database */
require_once('./src/lib/database.php');




try {
    if (isset($_GET["action"]) && $_GET["action"] !== "") {
        if ($_GET["action"] === "register") {
            require('./src/controllers/register_controller.php');
        } /* elseif ($_GET["action"] === "submitRegistration") {
         } */elseif ($_GET["action"] === "connect") {
            require('./src/controllers/connection_controller.php');
        } elseif ($_GET["action"] === "account") {
            // Accéder au compte utilisateur
            if (isset($_SESSION) && !empty($_SESSION)) {
             /*    (new Account())->execute(); */
            } else {
               /*  (new Account())->notConnect(); */
            }
        }
    } else {
        // Renvoyer vers la homepage
        require('./src/controllers/homepage_controller.php');
    }
} catch (Exception $e) {
    // Gestion des exceptions
    $errorMessage = $e->getMessage();
    require('templates/error.php');
}