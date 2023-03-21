<?php


require_once('./src/lib/database.php');



// Classe post pour définir les topics
class Topic
{
    public DatabaseConnection $connection;

    public function get_topics()
    {

        $query = $this->connection->getConnection()->prepare(
            "SELECT  `name` FROM `topic`;"
        );
        $query->execute();

        /*  $row = $query->fetch(PDO::FETCH_ASSOC); */
        require('./templates/homepage.php');
       
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