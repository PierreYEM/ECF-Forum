<?php
require_once('src/models/Subject.php');
class Post extends Subject
{
    public string $post_id;
    public string $comment;
    public string $post_author;
    public string $post_date;
    public string $parent_post_id;
    public string $user_avatar;

    public DatabaseConnection $connection;

    /* Méthode pour récupérer tous les posts*/
    public function get_posts()
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT 		
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
                t.topic_date
        FROM `posts` AS p
        INNER JOIN `subjects` AS s ON p.subject_id = s.id
        INNER JOIN `topics` AS t ON s.topic_id=t.id"

        );

        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour récupérer tous les posts d'un sujet*/
    public function get_posts_by_subject($subject_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT 		
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
            WHERE s.id=:id"

        );
        $result->bindParam(':id', $subject_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour créer un post */
    public function createPost($user_id, $subject_id, $comment, $post_author, $parent_post_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO `posts`( `user_id`, `subject_id`, `comment`, `post_author`,`parent_post_id`) VALUES (:user_id,:subject_id,:comment,:post_author,:parent_post_id)"
        );
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':subject_id', $subject_id);
        $query->bindParam(':comment', $comment);
        $query->bindParam(':post_author', $post_author);
        $query->bindParam(':parent_post_id', $parent_post_id);
        $query->execute();

    }

    /* Méthode pour supprimer un post */
    public function deletePost($post_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "DELETE FROM `posts` WHERE id=:post_id"
        );
        $query->bindParam(':post_id', $post_id);

        $query->execute();

    }

    /* Méthode pour modifier un post */
    public function updatePost($modified_comment, $post_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "UPDATE `posts` SET `comment`=:modified_comment WHERE id=:post_id"
        );
        $query->bindParam(':modified_comment', $modified_comment);
        $query->bindParam(':post_id', $post_id);
        $query->execute();

    }

    /* Méthode pour récupérer tous les posts d'un utilisateur*/
    public function get_posts_by_user($user_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT 		
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
                c.category_name
        FROM `posts` AS p
        INNER JOIN `subjects` AS s ON p.subject_id = s.id
        INNER JOIN `topics` AS t ON s.topic_id=t.id
        INNER JOIN `categories` AS c ON t.category_id=c.id
        WHERE p.user_id=:id"

        );
        $result->bindParam(':id', $user_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }

}