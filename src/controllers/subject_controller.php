<?php

require_once('./src/models/Post.php');
require_once('./src/models/Subject.php');
require_once('./src/lib/functions.php');

/* Obtention de tous les sujets de la catégorie */
$subject = new Subject();
$subject->connection = new DatabaseConnection();
$subject->id = $_GET["subject_id"];
$subject->name = $_GET["subject_name"];
$posts = $subject->get_posts($subject->id);

$post = new Post();
$post->connection = new DatabaseConnection();
$post->subject_id = $_GET["subject_id"];
    $post->user_id = $_SESSION["id"];
    $post->author = $_SESSION["name"];

if (isset($_POST['new_post'])) {

    if (empty(check($_POST['commentaire']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $post->comment = filter_var($_POST['commentaire'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    $post->createPost($post->user_id, $post->subject_id, $post->comment, $post->author);
    header("Refresh:0");
    exit();
}

require('./templates/subject_template.php');