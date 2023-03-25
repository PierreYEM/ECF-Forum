<?php

class Category
{
    public string $category_id;
    public string $category_name;

    public DatabaseConnection $connection;

    /*  Méthode pour obtenir toutes les catégories existantes*/
    public function get_categories()
    {

        $query = $this->connection->getConnection()->prepare(
            "SELECT  * FROM `categories`;"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);


    }

}