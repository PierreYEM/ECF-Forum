<?php

require_once('./src/models/Post.php');
require_once('./src/lib/functions.php');

/* Obtention de tous les sujets de la catégorie */
$post = new Post();
$post->connection = new DatabaseConnection();
$post->subject_id = $_GET["subject_id"];
$post->subject_name = $_GET["subject_name"];
$post->user_id = $_SESSION['id'];
$post->post_author = $_SESSION['name'];
$posts = $post->get_posts_by_subject($post->subject_id);


if (isset($_POST['new_post'])) {

    if (empty(check($_POST['comment']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $post->comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
    $post->parent_post_id = 0;
    $post->createPost($post->user_id, $post->subject_id, $post->comment, $post->post_author, $post->parent_post_id);
    header("Refresh:0");
    exit();
}

if (isset($_POST['response'])) {

    if (empty(check($_POST['comment']))) {
        throw new Exception("Veuillez remplir le champs ");
    } else {
        $post->comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
    $post->parent_post_id = $_POST['parent_post_id'];
    $post->createPost($post->user_id, $post->subject_id, $post->comment, $post->post_author, $post->parent_post_id);
    header("Refresh:0");
    exit();
}

require('./templates/subject_template.php');