<?php


/* require_once('./src/lib/database.php'); */
require_once('src/models/topic.php');

$topic = new Topic();
$topic->connection = new DatabaseConnection();

$topics = $topic->get_topics();
require('./templates/homepage_template.php');