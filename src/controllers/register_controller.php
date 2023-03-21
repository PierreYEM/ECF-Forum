<?php

/* require_once('./src/lib/database.php'); */
require_once('./src/models/User.php');
if (isset($_POST['name'])) {


    if (empty(htmlspecialchars($_POST['name']))) {
        throw new Exception("Le pseudo de l'utilisateur est requis");
    } else {
        $pseudo = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if (empty(htmlspecialchars($_POST['mail']))) {
        throw new Exception("L'email de l'utilisateur est requis");
    } else {
        $email = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    }
    if (empty(htmlspecialchars($_POST['password']))) {
        throw new Exception("Le mot de passe est requis");
    } else {
        if (htmlspecialchars($_POST['password']) === htmlspecialchars($_POST['passwordConfirm'])) {
            // vérification si les m2p correspondent
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            // $password = $post['password'];
        } else {
            throw new Exception("Les mots de passes de ne correspondent pas.");
        }
    }

    $newUser = new User();
    $newUser->connection = new DatabaseConnection();
    $newUser->createUser($name, $mail, $password);

}

require_once('./templates/register_template.php');