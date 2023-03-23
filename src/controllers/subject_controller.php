<?php

require_once('./src/models/Post.php');
require_once('./src/models/Subject.php');
require_once('./src/lib/functions.php');

/* Obtention de tous les sujets de la catégorie */
$subject = new Subject();
$subject->id = $_GET["subject_id"];
$subject->name = $_GET["subject_name"];
$subject->connection = new DatabaseConnection();
$posts = $subject->get_posts($subject->id);

if (isset($_POST) && !empty($_POST)) {

    $newPost = new Post();

    if (empty(check($_POST['commentaire']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $newPost->comment = filter_var($_POST['commentaire'], FILTER_SANITIZE_SPECIAL_CHARS);
    }


    $newPost->connection = new DatabaseConnection();
    $newPost->subject_id = $_GET["subject_id"];
    $newPost->user_id = $_SESSION["id"];
    $newPost->author = $_SESSION["name"];
    $newPost->createPost($newPost->user_id, $newPost->subject_id, $newPost->comment, $newPost->author);
    header("Refresh:0");
    exit();
}

require('./templates/subject_template.php');