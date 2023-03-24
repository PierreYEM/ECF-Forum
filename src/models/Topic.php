<?php

class Topic
{
    public string $id;
    public string $name;

    public DatabaseConnection $connection;

    /*  Méthode pour obtenir tous les topics existants*/
    public function get_topics()
    {

        $query = $this->connection->getConnection()->prepare(
            "SELECT  * FROM `categories`;"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);


    }

    /* Méthode pour récupérer tous les sujets*/
    public function get_subjects($category_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT s.*,c.id AS category_id,c.category_name
            FROM `subject` AS s
            INNER JOIN `categories` AS c ON s.category_id = c.id
            WHERE c.id=:id
            "

        );
        $result->bindParam(':id', $category_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour récupérer tous les sujets d'un utilisateur*/
    public function get_userSubjects($user_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT s.*,c.category_name
            FROM `subject` AS s
          INNER JOIN categories AS c ON s.category_id=c.id
            WHERE s.user_id=:id"


        );
        $result->bindParam(':id', $user_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }



}