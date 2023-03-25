<?php

class Post
{
    public string $id;
    public string $comment;
    public string $topic_id;
    public string $user_id;
    public string $avatar;
    public string $author;

    public DatabaseConnection $connection;

    /* Méthode pour créer un sujet */
    public function createPost($user_id, $topic_id, $comment,$post_author)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO `post`( `user_id`, `topic_id`, `comment`, `post_author`) VALUES (:user_id,:topic_id,:comment,:post_author)"
        );
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':topic_id', $topic_id);
        $query->bindParam(':comment', $comment);
        $query->bindParam(':post_author', $post_author);
        $query->execute();

    }

     /* Méthode pour supprimer un post */
     public function deletePost($post_id)
     {
         $query = $this->connection->getConnection()->prepare(
             "DELETE FROM `post` WHERE id=:post_id"
         );
         $query->bindParam(':post_id', $post_id);
       
         $query->execute();
 
     }

 /* Méthode pour modifier un post */
 public function updatePost($modified_comment,$post_id)
 {
     $query = $this->connection->getConnection()->prepare(
         "UPDATE `post` SET `comment`=:modified_comment WHERE id=:post_id"
     );
     $query->bindParam(':modified_comment', $modified_comment);
     $query->bindParam(':post_id', $post_id);
     $query->execute();

 }
}