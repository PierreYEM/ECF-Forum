<?php
require_once('src/models/Category.php');
class Topic extends Category
{
    public string $topic_id;
    public string $topic_name;
    public string $topic_category;
    public string $topic_author;
    public string $topic_date;
    public string $user_id;

    /* Méthode pour créer un topic */
    public function createTopic($category_id, $user_id, $topic_name, $topic_author)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO `topics`( `category_id`, `user_id`, `topic_name`,`topic_author`) VALUES (:category_id,:user_id,:topic_name,:topic_author)"
        );
        $query->bindParam(':category_id', $category_id);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':topic_name', $topic_name);
        $query->bindParam(':topic_author', $topic_author);
        $query->execute();

    }

    /* Méthode pour récupérer tous les topics sur la page d'accueil*/
    public function get_topics()
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT t.*,c.id AS category_id,c.category_name
            FROM `topics` AS t
            INNER JOIN `categories` AS c ON t.category_id = c.id"

        );

        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour récupérer tous les topics d'une catégorie*/
    public function get_topics_by_category($category_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT t.*,c.id AS category_id,c.category_name
             FROM `topics` AS t
             INNER JOIN `categories` AS c ON t.category_id = c.id
            WHERE c.id=:category_id"
        );

        $result->bindParam(':category_id', $category_id);
        $result->execute();
        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour récupérer tous les sujets d'un utilisateur*/
    public function get_topics_by_user($user_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT 		
                    t.*,
                    c.category_name,
                    c.id AS category_id
            FROM `topics` AS t
            INNER JOIN `categories` AS c ON t.category_id=c.id
            WHERE t.user_id=:id"

        );
        $result->bindParam(':id', $user_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour supprimer un topic */
    public function deleteTopic($topic_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "DELETE FROM `topics` WHERE id=:topic_id"
        );
        $query->bindParam(':topic_id', $topic_id);

        $query->execute();

    }

    /* Méthode pour modifier un topic */
    public function updateTopic($topic_name, $topic_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "UPDATE `topics` SET `topic_name`=:topic_name WHERE id=:topic_id"
        );
        $query->bindParam(':topic_name', $topic_name);
        $query->bindParam(':topic_id', $topic_id);
        $query->execute();

    }
}