<?php

/* Appel du modèle User pour instancier la classe USER */
require_once('./src/models/User.php');
/* Appel du modèle functions pour vérifier les inputs */
require_once('./src/lib/functions.php');


/* Instructions si le formulaire d'inscription est rempli et soumis */
if (isset($_POST) && !empty($_POST)) {

    /* On instancie la classe User pour créer un nouvel utilisateur */
    $newUser = new User();

    /* On vérifie chaque entrée de chaque input avec la fonction check (trim+ htmlspecialchars) et l'on valide avec un filter_var */
    if (empty(check($_POST['name']))) {
        throw new Exception("Le pseudo de l'utilisateur est requis");
    } else {
        /* On défini une propriété de la classe en lui donnant comme valeur la valeur de l'input après vérification et validation */
        $newUser->name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if (empty(check($_POST['mail']))) {
        throw new Exception("L'email de l'utilisateur est requis");
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
    $newUser->createUser($newUser->name, $newUser->mail, $newUser->password);

    /* Indicateur d'inscription réussie */
    $success = "Votre compte a été créé avec succès";

}



require_once('./templates/register_template.php');