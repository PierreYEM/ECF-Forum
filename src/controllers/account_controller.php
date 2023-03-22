<?php

require_once('./src/models/User.php');
/* Appel du modèle functions pour vérifier les inputs */
require_once('./src/lib/functions.php');

if (isset($_SESSION) && !empty($_SESSION)) {
    $userId = check($_SESSION["id"]);
    // Remplir automatiquement le formulaire avec les informations de l'utilisateur
    $user = new User();
    $user->connection = new DatabaseConnection();
    $result = $user->getUser($userId);

    require_once('./templates/account_template.php');
} else {
    header("Location: index.php?action=connect");
    exit;
}