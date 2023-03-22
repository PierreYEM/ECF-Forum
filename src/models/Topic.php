<?php

class Topic
{
    public string $id;
    public string $name;

    public DatabaseConnection $connection;

    public function get_topics()
    {

        $query = $this->connection->getConnection()->prepare(
            "SELECT  * FROM `categories`;"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);


    }

    /* Méthode pour récupérer */
    public function get_subjects($category_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT *
            FROM `subject` AS s
            INNER JOIN `categories` AS c ON s.category_id = c.id
            WHERE c.id=:id
            "

        );
        $result->bindParam(':id', $category_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }
    public function createPost($title, $date, $author, $category, $userId)
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `posts`( `title`, `date`, `author`, `category`,`user_id`) VALUES (:title,:date,:author,:category,:user_id)"
        );
        $statement->bindparam(':title', $title);
        $statement->bindparam(':date', $date);
        $statement->bindparam(':author', $author);
        $statement->bindparam(':category', $category);
        $statement->bindparam(':user_id', $userId);

        $statement->execute();
    }



}