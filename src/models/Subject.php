<?php
require_once('src/models/Topic.php');
class Subject extends Topic
{
    public string $subject_id;
    public string $subject_name;
    public string $subject_category;
    public string $subject_author;
    public string $subject_date;

    public DatabaseConnection $connection;

    /* Méthode pour créer un sujet */
    public function createSubject($user_id, $topic_id, $subject_name, $subject_author)
    {
        $query = $this->connection->getConnection()->prepare(
            "INSERT INTO `subjects`(`user_id`, `topic_id`, `subject_name`,`subject_author`) VALUES (:user_id,:topic_id,:subject_name,:subject_author)"
        );

        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':topic_id', $topic_id);
        $query->bindParam(':subject_name', $subject_name);
        $query->bindParam(':subject_author', $subject_author);
        $query->execute();

    }

    /* Méthode pour récupérer tous les sujets d'un topic*/
    public function get_subjects_by_topic($topic_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT s.*,t.id AS topic_id,t.topic_name
              FROM `subjects` AS s
              INNER JOIN `topics` AS t ON s.topic_id = t.id
             WHERE t.id=:topic_id
             ORDER by s.subject_date "
        );

        $result->bindParam(':topic_id', $topic_id);
        $result->execute();
        return $result->fetchall(PDO::FETCH_ASSOC);

    }

    /* Méthode pour supprimer un sujet */
    public function deleteSubject($subject_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "DELETE FROM `subjects` WHERE id=:subject_id"
        );
        $query->bindParam(':subject_id', $subject_id);

        $query->execute();

    }

    /* Méthode pour modifier un sujet */
    public function updateSubject($subject_name, $subject_id)
    {
        $query = $this->connection->getConnection()->prepare(
            "UPDATE `subjects` SET `subject_name`=:subject_name WHERE id=:subject_id"
        );
        $query->bindParam(':subject_name', $subject_name);
        $query->bindParam(':subject_id', $subject_id);
        $query->execute();

    }

    /* Méthode pour récupérer tous les sujets d'un utilisateur*/
    public function get_subjects_by_user($user_id)
    {
        $result = (new DatabaseConnection())->getConnection()->prepare(

            "SELECT 		
            s.*,
            t.category_id,
            t.user_id AS topic_user_id,
            t.topic_name,
            t.topic_author,
            t.topic_date,
            c.category_name
            
            FROM `subjects` AS s
            INNER JOIN `topics` AS t ON s.topic_id=t.id
            INNER JOIN `categories` AS c ON t.category_id=c.id
            WHERE s.user_id=:id
            ORDER by s.subject_date "

        );
        $result->bindParam(':id', $user_id);
        $result->execute();

        return $result->fetchall(PDO::FETCH_ASSOC);

    }
}