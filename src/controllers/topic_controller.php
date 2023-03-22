<?php

require_once('./src/models/Topic.php');
require_once('./src/models/Subject.php');
require_once('./src/lib/functions.php');

/* Obtention de tous les sujets de la catégorie */
$topic = new Topic();
$topic->id = $_GET["topic_id"];
$topic->name = $_GET["cat"];
$topic->connection = new DatabaseConnection();
$subjects = $topic->get_subjects($topic->id);

if (isset($_POST) && !empty($_POST)) {

    $newSubject = new Subject();

    if (empty(check($_POST['subject_name']))) {
        throw new Exception("Un sujet est requis");
    } else {
        $newSubject->name = filter_var($_POST['subject_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    }


    $newSubject->connection = new DatabaseConnection();
    $newSubject->category_id = $_GET["id"];
    $newSubject->user_id = $_SESSION["id"];
    $newSubject->createSubject($newSubject->category_id, $newSubject->user_id, $newSubject->name);
    header("Refresh:0");
    exit();
}

require('./templates/topic_template.php');