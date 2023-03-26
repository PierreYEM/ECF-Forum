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

$topic = new Topic();
$topic->connection = new DatabaseConnection();
$topics = $topic->get_topics_by_user($user->id);

$subject = new Subject();
$subject->connection = new DatabaseConnection();
$subjects = $subject->get_subjects_by_user($user->id);

$post = new Post();
$post->connection = new DatabaseConnection();
$posts = $post->get_posts_by_user($user->id);
$globalPosts = $post->get_posts();


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

/* Supprimer un topic */
if (isset($_POST["delete_topic"])) {

    $topic->topic_id = $_POST["topic_id"];
    $topic->deleteTopic($topic->topic_id);
    header("Refresh:0");
    exit();
}

/* Supprimer un sujet */
if (isset($_POST["delete_subject"])) {

    $subject->subject_id = $_POST["subject_id"];
    $subject->deleteSubject($subject->subject_id);
    header("Refresh:0");
    exit();
}

/* Supprimer un post */
if (isset($_POST["delete_post"])) {

    $post->post_id = $_POST["post_id"];
    $post->deletePost($post->post_id);
    header("Refresh:0");
    exit();
}

/* Modifier un topic */
if (isset($_POST["modify_topic"])) {

    $topic->topic_id = $_POST["topic_id"];

    /* Vérification du nouveau topic modifié */
    if (empty(check($_POST['edit_topic']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $topic->topic_name = filter_var($_POST['edit_topic'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    $topic->updateTopic($topic->topic_name, $topic->topic_id);
    header("Refresh:0");
    exit();
}

/* Modifier un sujet */
if (isset($_POST["modify_subject"])) {

    $subject->subject_id = $_POST["subject_id"];

    /* Vérification du nouveau sujet modifié */
    if (empty(check($_POST['edit_subject']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $subject->subject_name = filter_var($_POST['edit_subject'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    $subject->updateSubject($subject->subject_name, $subject->subject_id);
    header("Refresh:0");
    exit();
}

/* Modifier un post */
if (isset($_POST["modify_post"])) {

    $post->post_id = $_POST["post_id"];

    /* Vérification du nouveau commentaire modifié */
    if (empty(check($_POST['edit_comment']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $post->comment = filter_var($_POST['edit_comment'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    $post->updatePost($post->comment, $post->post_id);
 
    header("Refresh:0");
    exit();
}


/* Appel à la vue */
require_once('./templates/account_template.php');