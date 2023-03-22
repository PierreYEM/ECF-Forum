<?php

class Subject
{
    public string $id;
    public string $name;
    public string $category_id;
    public string $user_id;

    public DatabaseConnection $connection;

    /* Méthode pour créer un sujet */
    public function createSubject($category_id, $user_id, $subject_name)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO `subject`( `category_id`, `user_id`, `subject_name`) VALUES (:category_id,:user_id,:subject_name)"
        );
        $query->bindParam(':category_id', $category_id);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':subject_name', $subject_name);
        $query->execute();

    }


}