<?php

require_once('./src/models/User.php');

require_once('./src/lib/functions.php');

if (isset($_POST) && !empty($_POST)) {

    /* On instancie la classe User pour créer un nouvel utilisateur */
    $newUser = new User();


    if (empty(check($_POST['name']))) {
        $newUser->name = $_SESSION["name"];
    } else {

        $newUser->name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if (empty(check($_POST['mail']))) {
        $newUser->mail = $_SESSION["mail"];
    } else {
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'adresse e-mail n'est pas valide");
        }
        $newUser->mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    }

    if (empty(check($_POST['password']))) {
        throw new Exception("Le mot de passe est requis");
    } else {
        $password = check($_POST['password']);
        $passwordConfirm = check($_POST['passwordConfirm']);

        /* Si les 2 mots de passes ne sont pas identiques */
        if ($password !== $passwordConfirm) {
            throw new Exception("Les mots de passe ne correspondent pas.");
        }
        /* Si le mot de passe contient moins de 8 caractères */
        if (strlen($password) < 8) {
            throw new Exception("Le mot de passe doit contenir au moins 8 caractères.");
        } else {
            $newUser->password = password_hash($password, PASSWORD_DEFAULT);

        }
    }

    /* On définie la propriété connection  */
    $newUser->connection = new DatabaseConnection();

    /* On créer l'utilisateur dans la base de données en passant par la méthode de classe */
    $newUser->updateUser($newUser->name, $newUser->mail, $newUser->password);
    $success = "Modifications enregistrées";
 
}
  require_once('./templates/account_template.php');