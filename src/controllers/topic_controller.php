<?php

require_once('./src/models/Subject.php');
require_once('./src/lib/functions.php');

/* Obtention de tous les sujets de la catégorie */
$subject = new Subject();
$subject->connection = new DatabaseConnection();
$subject->topic_id = $_GET["topic_id"];
$subject->topic_name = $_GET["topic_name"];

$subjects = $subject->get_subjects_by_topic($subject->topic_id);

if (isset($_POST['new_subject'])) {

    if (empty(check($_POST['subject_name']))) {
        throw new Exception("Un sujet est requis");
    } else {
        $subject->subject_name = filter_var($_POST['subject_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
    $subject->user_id = $_SESSION["id"];
    $subject->subject_author = $_SESSION["name"];
    $subject->createSubject($subject->user_id, $subject->topic_id, $subject->subject_name, $subject->subject_author);
    header("Refresh:0");
    exit();
}

require('./templates/topic_template.php');