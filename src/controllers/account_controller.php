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
    $user->user_id = check($_SESSION["id"]);
    $user->connection = new DatabaseConnection();
    $data = $user->getUser($user->user_id);
    $user->user_name = $data["user_name"];
    $user->user_mail = $data["mail"];
    $user->user_avatar = $data["avatar"];

} else {
    header("Location: index.php?action=connect");
    exit;
}

$topics = $user->get_topics_by_user($user->user_id);

$subjects = $user->get_subjects_by_user($user->user_id);

$posts = $user->get_posts_by_user($user->user_id);
$globalPosts = $user->get_posts();

/* Instructions pour modification de profil */
if (isset($_POST["modify_profil"])) {

    /* On instancie la classe User pour créer un nouvel utilisateur */
    if (empty(check($_POST['name']))) {
        $user->user_name = $_SESSION["name"];
    } else {

        $user->user_name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if (empty(check($_POST['mail']))) {
        $user->user_mail = $_SESSION["mail"];
    } else {
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'adresse e-mail n'est pas valide");
        }
        $user->user_mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
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
            $user->user_password = password_hash($password, PASSWORD_DEFAULT);

        }
    }
    if (empty($_FILES['avatar']['tmp_name'])) {
        $user->user_avatar = $data["avatar"];
    } else {
        /* Traitement du fichier uploadé */
        $avatar_temp = $_FILES['avatar']['tmp_name'];
        $avatar_name = $_FILES['avatar']['name'];
        $url_avatar = './src/images/avatar/' . $avatar_name;
        $pattern = '/^.*\.(jpeg|jpg|png)$/';
        if (preg_match($pattern, $avatar_name)) {
            $user->user_avatar = $url_avatar;
            move_uploaded_file($avatar_temp, $url_avatar);

            if ($_FILES['avatar']['error']) {
                switch ($_FILES['avatar']['error']) {
                    case 1: // UPLOAD_ERR_INI_SIZE
                        throw new Exception("Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !");

                    case 2: // UPLOAD_ERR_FORM_SIZE
                        throw new Exception("Le fichier dépasse la limite autorisée dans le formulaire HTML !");

                    case 3: // UPLOAD_ERR_PARTIAL
                        throw new Exception("L'envoi du fichier a été interrompu pendant le transfert !");

                    case 4: // UPLOAD_ERR_NO_FILE
                        throw new Exception("Le fichier que vous avez envoyé a une taille nulle !");

                }
            }
        } else {
            throw new Exception("Fichier invalide (seuls jpeg,jpg,png autorisés)");
        }
    }


    /* On créer l'utilisateur dans la base de données en passant par la méthode de classe */
    $user->updateUser($user->user_name, $user->user_mail, $user->user_password, $user->user_avatar);
    
   /*  header("Refresh:0");
    exit(); */
}

/* Supprimer un topic */
if (isset($_POST["delete_topic"])) {

    $user->topic_id = $_POST["topic_id"];
    $user->deleteTopic($user->topic_id);
    header("Refresh:0");
    exit();
}

/* Supprimer un sujet */
if (isset($_POST["delete_subject"])) {

    $user->subject_id = $_POST["subject_id"];
    $user->deleteSubject($user->subject_id);
    header("Refresh:0");
    exit();
}

/* Supprimer un post */
if (isset($_POST["delete_post"])) {

    $user->post_id = $_POST["post_id"];
    $user->deletePost($user->post_id);
    header("Refresh:0");
    exit();
}

/* Modifier un topic */
if (isset($_POST["modify_topic"])) {

    $user->topic_id = $_POST["topic_id"];

    /* Vérification du nouveau topic modifié */
    if (empty(check($_POST['edit_topic']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $user->topic_name = filter_var($_POST['edit_topic'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    $user->updateTopic($user->topic_name, $user->topic_id);
    header("Refresh:0");
    exit();
}

/* Modifier un sujet */
if (isset($_POST["modify_subject"])) {

    $user->subject_id = $_POST["subject_id"];

    /* Vérification du nouveau sujet modifié */
    if (empty(check($_POST['edit_subject']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $user->subject_name = filter_var($_POST['edit_subject'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    $user->updateSubject($user->subject_name, $user->subject_id);
    header("Refresh:0");
    exit();
}

/* Modifier un post */
if (isset($_POST["modify_post"])) {

    $user->post_id = $_POST["post_id"];

    /* Vérification du nouveau commentaire modifié */
    if (empty(check($_POST['edit_comment']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $user->comment = filter_var($_POST['edit_comment'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    $user->updatePost($user->comment, $user->post_id);

    header("Refresh:0");
    exit();
}


/* Appel à la vue */
require_once('./templates/account_template.php');