<?php
/* <?php echo date("d-m-Y", strtotime($value["date"])) ?> */
session_start();

/* Appel du modèle contenant la classe Database */
require_once('./src/lib/database.php');

try {
    if (isset($_GET["action"]) && $_GET["action"] !== "") {

        if ($_GET["action"] === "test_register") {
            require('./src/controllers/test_register_controller.php');

        } elseif ($_GET["action"] === "register") {
            require('./src/controllers/register_controller.php');

        } elseif ($_GET["action"] === "connect") {
            require('./src/controllers/connection_controller.php');

        } elseif ($_GET["action"] === "account") {
            require('./src/controllers/account_controller.php');

        } elseif ($_GET["action"] === "disconnect") {
            require('./src/controllers/disconnect_controller.php');

        } else {
            throw new Exception("ERROR 404");
        }

    } elseif (isset($_GET['topic_id'])) {

        require('./src/controllers/topic_controller.php');

    } elseif (isset($_GET['subject_id'])) {
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
            require('./src/controllers/subject_controller.php');
        } else {
            throw new Exception("Vous devez être inscrit pour accéder au contenu du site");
        }

    } elseif (isset($_GET['close'])) {
        header('Location: index.php?action=connect');
        exit;

    } elseif (empty($_GET)) {
        // Renvoyer vers la homepage
        require('./src/controllers/homepage_controller.php');
    } else {
        throw new Exception("ERROR 404");
    }
} catch (Exception $e) {
    // Gestion des exceptions
    $errorMessage = $e->getMessage();
    require('templates/error.php');
}