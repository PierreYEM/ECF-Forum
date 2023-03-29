<?php


/* require_once('./src/lib/database.php'); */
require_once('src/models/Category.php');
require_once('src/models/Topic.php');
require_once('./src/lib/functions.php');

$category = new Category();
$category->connection = new DatabaseConnection();
$categories = $category->get_categories();

$topic = new Topic();
$topic->connection = new DatabaseConnection();
$topics = $topic->get_topics();


if (isset($_POST['new_topic'])) {
    if ($_POST["category_id"] == "Choisissez votre catégorie") {
        throw new Exception("Choississez une catégorie");

    }
    if (empty(check($_POST['topic_name']))) {
        throw new Exception("Un topic est requis");
    } else {
        $topic->topic_name = check(filter_var($_POST['topic_name'], FILTER_SANITIZE_SPECIAL_CHARS));
    }

    $topic->user_id = $_SESSION['id'];
    $topic->topic_author = $_SESSION['name'];
    $topic->category_id = $_POST['category_id'];

    $topic->createTopic($topic->category_id, $topic->user_id, $topic->topic_name, $topic->topic_author);
    header("Refresh:0");
    exit();
}
require('./templates/homepage_template.php');