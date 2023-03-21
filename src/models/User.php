<?php

class User
{
    public string $id;
    public string $user_id;
    public string $title;
    public string $creationDate;
    public string $content;
    public string $author;
    public string $category;

    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->id = "";
        $this->user_id = "";
        $this->title = "";
        $this->creationDate = "";
        $this->content = "";
        $this->author = "";
        $this->category = "";
    }



    public function display()
    {

        $query = $this->connection->getConnection()->prepare(
            "SELECT  `name` FROM `topic`;"
        );
        $query->execute();

        /*  $row = $query->fetch(PDO::FETCH_ASSOC); */
        require('./templates/homepage.php');
        return $row;
    }


    public function createUser($name, $mail, $password)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO users (name, mail, password) VALUES (:name,:mail,:password)"
        );
        $query->bindParam(':name', $name);
        $query->bindParam(':mail', $mail);
        $query->bindParam(':password', $password);
        $query->execute();
        header("Location: index.php?action=account");
        exit;
    }



}