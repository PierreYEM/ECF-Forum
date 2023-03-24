<?php

class User
{
    public string $id;
    public string $name;
    public string $mail;
    public string $password;
    public string $avatar;

    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->id = "";
        $this->name = "";
        $this->mail = "";
        $this->password = "";
        $this->avatar = "";
    }

    public function createUser($name, $mail, $password)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO users (user_name, mail, password) VALUES (:name,:mail,:password)"
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

        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user = new User();
        $user->id = $result["id"];
        $user->name = $result["user_name"];
        $user->mail = $result['mail'];
        $user->password = $result['password'];
        $user->avatar = $result['avatar'];

        if ($query->rowCount() == 0) {
            throw new Exception("L'utilisateur n'existe pas dans la base de données.");
        } else {

            if (password_verify($password, $user->password)) {
                session_start();
                $_SESSION['logged'] = 1;
                $_SESSION['id'] = $user->id;
                $_SESSION['name'] = $user->name;
                $_SESSION['mail'] = $user->mail;
                $_SESSION['avatar'] = $user->avatar;
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

    /* Méthode pour modifier un utilisateur */
    public function updateUser($name, $mail, $password)
    {
        $query = $this->connection->getConnection()->prepare(
            "UPDATE users SET user_name = :name, mail = :mail, password = :password WHERE id = :id"
        );
        $query->bindParam(':name', $name);
        $query->bindParam(':mail', $mail);
        $query->bindParam(':password', $password);
        $query->bindParam(':id', $_SESSION['id']);
        $query->execute();
        /* header("Location: ./index.php?action=account");
        exit; */
    }
}