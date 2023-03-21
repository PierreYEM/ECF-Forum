<?php


/* require_once('./src/lib/database.php'); */
require_once('src/models/topic.php');

$topic = new Topic();
$topic->connection = new DatabaseConnection();
$topic->get_topics();
