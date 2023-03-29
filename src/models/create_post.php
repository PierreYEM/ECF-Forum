<?php

$data = json_decode(file_get_contents('php://input'), true);
$subject_id = $_POST["subject_id"];
$user_id=$_POST['user_id'];
$comment=$_POST['comment'];
$post_author=$_POST['post_author'];
$parent_post_id=$_POST['parent_post_id'];

$database = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
$create_post_query = "INSERT INTO `posts`( `user_id`, `subject_id`, `comment`, `post_author`,`parent_post_id`) VALUES (:user_id,:subject_id,:comment,:post_author,:parent_post_id)";
$create_post = $database->prepare($create_post_query);

$create_post->bindParam(':user_id', $user_id);
$create_post->bindParam(':subject_id', $subject_id);
$create_post->bindParam(':comment', $comment);
$create_post->bindParam(':post_author', $post_author);
$create_post->bindParam(':parent_post_id', $parent_post_id);
$create_post->execute();