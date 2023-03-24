<?php

class Subject
{
    public string $id;
    public string $name;
    public string $category_id;
    public string $user_id;
    public string $author;

    public DatabaseConnection $connection;

    /* Méthode pour créer un sujet */
    public function createSubject($category_id, $user_id, $subject_name, $subject_author)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO `subject`( `category_id`, `user_id`, `subject_name`,`subject_author`) VALUES (:category_id,:user_id,:subject_name,:subject_author)"
        );
        $query->bindParam(':category_id', $category_id);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':subject_name', $subject_name);
        $query->bindParam(':subject_author', $subject_author);
        $query->execute();

    }

    /* Méthode pour récupérer tous les posts*/
    public function get_posts($subject_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT p.*,s.category_id,s.user_id,s.subject_name,s.subject_author,s.id AS subject_id
            FROM `post` AS p
            INNER JOIN `subject` AS s ON p.subject_id = s.id
            WHERE s.id=:id
        "

        );
        $result->bindParam(':id', $subject_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour récupérer tous les posts d'un utilisateur*/
    public function get_userPosts($user_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT p.*,s.category_id,s.subject_name,s.subject_author,c.category_name
            FROM `post` AS p
            INNER JOIN subject AS s ON p.subject_id=s.id
            INNER JOIN categories AS c ON s.category_id=c.id
            WHERE p.user_id=:id"

        );
        $result->bindParam(':id', $user_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour supprimer un sujet */
    public function deleteSubject($subject_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "DELETE FROM `subject` WHERE id=:subject_id"
        );
        $query->bindParam(':subject_id', $subject_id);

        $query->execute();

    }

    /* Méthode pour modifier un sujet */
    public function updateSubject($subject_name,$subject_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "UPDATE `subject` SET `subject_name`=:subject_name WHERE id=:subject_id"
        );
        $query->bindParam(':subject_name', $subject_name);
        $query->bindParam(':subject_id', $subject_id);
        $query->execute();

    }
}