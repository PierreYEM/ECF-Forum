<?php


/* require_once('./src/lib/database.php'); */
require_once('src/models/Category.php');
require_once('src/models/Topic.php');

$category = new Category();
$category->connection = new DatabaseConnection();
$categories = $category->get_categories();

$topic = new Topic();
$topic->connection = new DatabaseConnection();
$topics = $topic->get_topics();

require('./templates/homepage_template.php');