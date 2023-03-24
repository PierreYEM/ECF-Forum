<?php
/* Appel des classes */
require_once('./src/models/User.php');
require_once('./src/models/Topic.php');
require_once('./src/models/Subject.php');
require_once('./src/models/Post.php');


/* Appel du modèle functions pour vérifier les inputs */
require_once('./src/lib/functions.php');

/* Vérification si utilisateur inscrit */
if (isset($_SESSION) && !empty($_SESSION)) {
    /* Remplir automatiquement le formulaire avec les informations de l'utilisateur en récupérant les données de l'utilisateur et en les appelant dans la vue */

    $user = new User();
    $user->id = check($_SESSION["id"]);
    $user->connection = new DatabaseConnection();
    $data = $user->getUser($user->id);
    $user->name = $data["user_name"];
    $user->mail = $data["mail"];
} else {
    header("Location: index.php?action=connect");
    exit;
}

/* Instructions pour modification de profil */
if (isset($_POST["modify_profil"])) {

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

    header("Refresh:0");
    exit();
}

/* Supprimer un post */
if (isset($_POST["delete_post"])) {

    $post = new Post();
    $post->connection = new DatabaseConnection();
    $post->id = $_POST["post_id"];
    $post->deletePost($post->id);

}

/* Supprimer un sujet */
if (isset($_POST["delete_subject"])) {

    $deleteSubject = new Subject();
    $deleteSubject->connection = new DatabaseConnection();
    $deleteSubject->id = $_POST["subject_id"];
    $deleteSubject->deleteSubject($deleteSubject->id);

}

/* Modifier un post */
if (isset($_POST["modify_post"])) {

    $editPost = new Post();
    $editPost->connection = new DatabaseConnection();
    $editPost->id = $_POST["post_id"];

    /* Vérification du nouveau commentaire modifié */
    if (empty(check($_POST['edit_comment']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $editPost->comment = filter_var($_POST['edit_comment'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    $editPost->updatePost($editPost->comment, $editPost->id);
    $modified_post = true;
}

/* Modifier un sujet */
if (isset($_POST["modify_subject"])) {

    $editSubject = new Subject();
    $editSubject->connection = new DatabaseConnection();
    $editSubject->id = $_POST["subject_id"];

    /* Vérification du nouveau sujet modifié */
    if (empty(check($_POST['edit_subject']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $editSubject->name = filter_var($_POST['edit_subject'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

  /*   $editSubject->name = $_POST["edit_subject"]; */
    $editSubject->updateSubject($editSubject->name, $editSubject->id);

}

$topic = new Topic();
$topic->connection = new DatabaseConnection();
$subjects = $topic->get_userSubjects($user->id);

$subject = new Subject();
$subject->connection = new DatabaseConnection();
$posts = $subject->get_userPosts($user->id);

/* Appel à la vue */
require_once('./templates/account_template.php');