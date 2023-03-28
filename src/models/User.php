<?php
require_once('src/models/Post.php');
class User extends Post
{
    public string $user_name;
    public string $user_mail;
    public string $user_password;

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
        if ($result == null) {
            throw new Exception("Profil inexistant");
        }

        if ($query->rowCount() == 0) {
            throw new Exception("L'utilisateur n'existe pas dans la base de données.");
        } else {

            if (password_verify($password, $result['password'])) {
                session_start();
                $_SESSION['logged'] = 1;
                $_SESSION['id'] = $result["id"];
                $_SESSION['name'] = $result["user_name"];
                $_SESSION['mail'] = $result['mail'];
                $_SESSION['avatar'] = $result['avatar'];
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
       
        // Variables pour modifier les informations
        return $result = $query->fetch(PDO::FETCH_ASSOC);
    }

    /* Méthode pour modifier un utilisateur */
    public function updateUser($name, $mail, $password, $avatar)
    {
        $query = $this->connection->getConnection()->prepare(
            "UPDATE users SET user_name = :name, mail = :mail, password = :password, avatar=:avatar WHERE id = :id"
        );
        $query->bindParam(':name', $name);
        $query->bindParam(':mail', $mail);
        $query->bindParam(':password', $password);
        $query->bindParam(':avatar', $avatar);
        $query->bindParam(':id', $_SESSION['id']);
        $query->execute();
        /* header("Location: ./index.php?action=account");
        exit; */
    }
}