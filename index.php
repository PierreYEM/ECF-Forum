<?php

session_start();

/* Appel du modèle contenant la classe Database */
require_once('./src/lib/database.php');

try {
    if (isset($_GET["action"]) && $_GET["action"] !== "") {

        if ($_GET["action"] === "register") {
            require('./src/controllers/register_controller.php');

        } elseif ($_GET["action"] === "connect") {
            require('./src/controllers/connection_controller.php');

        } elseif ($_GET["action"] === "account") {
            require('./src/controllers/account_controller.php');

        } elseif ($_GET["action"] === "disconnect") {
            require('./src/controllers/disconnect_controller.php');

        }

    } elseif (isset($_GET['close'])) {
        header('Location: index.php?action=connect');
        exit;

    } else {
        // Renvoyer vers la homepage
        require('./src/controllers/homepage_controller.php');
    }
} catch (Exception $e) {
    // Gestion des exceptions
    $errorMessage = $e->getMessage();
    require('templates/error.php');
}