<?php

require_once('./src/models/User.php');
/* Appel du modèle functions pour vérifier les inputs */
require_once('./src/lib/functions.php');

if (isset($_SESSION['logged']) && $_SESSION['logged'] = 1) {
    throw new Exception("Vous êtes déjà connecté");
}

if (isset($_POST) && !empty($_POST)) {
    $user = new User();
    $user->connection = new DatabaseConnection();

    if (empty(check($_POST['mail']))) {
        throw new Exception("L'email de l'utilisateur est requis");
    } else {
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'adresse e-mail n'est pas valide");
        }
        $user->user_mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    }
    if (empty(check($_POST['password']))) {
        throw new Exception("Le mot de passe est requis");
    } else {
        $user->user_password = check($_POST['password']);
    }

    $user->connectUser($user->user_mail, $user->user_password);
}

require_once('./templates/connection_template.php');