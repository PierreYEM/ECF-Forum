<?php

require_once('./src/models/User.php');
/* Appel du modèle functions pour vérifier les inputs */
require_once('./src/lib/functions.php');

if (isset($_SESSION['logged']) && $_SESSION['logged'] = 1) {
    throw new Exception("Vous êtes déjà connecté");
}

if (isset($_POST) && !empty($_POST)) {
    $user = new User();

    if (empty(check($_POST['mail']))) {
        throw new Exception("L'email de l'utilisateur est requis");
    } else {
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'adresse e-mail n'est pas valide");
        }
        $user->mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    }
    if (empty(check($_POST['password']))) {
        throw new Exception("Le mot de passe est requis");
    } else {
        $user->password = check($_POST['password']);
    }

    $user->connection = new DatabaseConnection();
    $user->connectUser($user->mail, $user->password);
}

require_once('./templates/connection_template.php');