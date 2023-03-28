<?php
/* require_once('./src/models/Post.php');

$post = new Post();
$post->connection = new DatabaseConnection();

$subject=2;
$posts = $post->get_posts_by_subject($subject);
header('Content-Type: application/json');
echo json_encode($posts); */

$subject = 2;
$database = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '');
$posts_by_subject_request = "SELECT 		
p.*,
s.user_id AS subject_user_id,
s.subject_name,
s.subject_author,
s.id AS subject_id,
s.subject_date,
t.category_id,
t.user_id AS topic_user_id,
t.topic_name,
t.topic_author,
t.topic_date,
u.avatar
FROM `posts` AS p
INNER JOIN `subjects` AS s ON p.subject_id = s.id
INNER JOIN `topics` AS t ON s.topic_id=t.id
INNER JOIN `users` AS u ON p.user_id=u.id
WHERE s.id=:id
ORDER by p.date ";
$posts_by_subject = $database->prepare($posts_by_subject_request);
$posts_by_subject->bindParam(':id', $subject);
$posts_by_subject->execute();
$result = $posts_by_subject->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($result);