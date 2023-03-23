<?php

class Post
{
    public string $id;
    public string $comment;
    public string $subject_id;
    public string $user_id;
    public string $avatar;
    public string $author;

    public DatabaseConnection $connection;

    /* Méthode pour créer un sujet */
    public function createPost($user_id, $subject_id, $comment,$post_author)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO `post`( `user_id`, `subject_id`, `comment`, `post_author`) VALUES (:user_id,:subject_id,:comment,:post_author)"
        );
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':subject_id', $subject_id);
        $query->bindParam(':comment', $comment);
        $query->bindParam(':post_author', $post_author);
        $query->execute();

    }


}