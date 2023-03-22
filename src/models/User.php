<?php

class User
{
    public string $id;
    public string $name;
    public string $mail;
    public string $password;

    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->id = "";
        $this->name = "";
        $this->mail = "";
        $this->password = "";

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

    }

    /* Méthode pour connecter un utilisateur */
    public function connectUser($mail, $password)
    {
        $query = $this->connection->getConnection()->prepare(
            "SELECT * FROM users WHERE mail = :mail"
        );
        $query->bindParam(':mail', $mail);
        $query->execute();

        $result = $query->fetch();
        $user = new User();
        $user->id = $result["id"];
        $user->name = $result["name"];
        $user->mail = $result['mail'];
        $user->password = $result['password'];

        if ($query->rowCount() == 0) {
            throw new Exception("L'utilisateur n'existe pas dans la base de données.");
        } else {

            if (password_verify($password, $user->password)) {
                session_start();
                $_SESSION['connecte'] = 1;
                $_SESSION['mail'] = $user->mail;
                $_SESSION['id'] = $user->id;
                header("Location: index.php?action=account");
                exit;
            } else {
                throw new Exception("Le mot de passe n'est pas valide.");
            }
        }

    }
    /* Méthode pour déconnecter un utilisateur */
    public function disconnectUser()
    {
       
        session_destroy();
        header('Location: index.php');
        exit;
    }

    /*  Méthode pour récupérer un utilisateur et ses informations */
    public function getUser($id)
    {
        $query = $this->connection->getConnection()->prepare(
            "SELECT * FROM users WHERE id = :id"
        );
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch();
        // Variables pour modifier les informations
        return $result;
    }
}