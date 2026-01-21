<?php
require_once '../app/libs/Database.php';
require_once("../app/libs/Model.php");
require_once '../app/models/User.php';

class UserRepository extends Model
{
    public function getUsers()
    {
        $sql = "SELECT * FROM user";

        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function RegisterUser(User $u)
    {
        $sql = "INSERT INTO users (hashed_pass, mail, telf, role) 
                VALUES(:pass, :email ,:telfNumber, 'user')";

        try {
            $stmt = $this->db->prepare($sql);
            $res = $stmt->execute([
            ':pass' => $u->getHashedPass(),
            ':email'   => $u->getEmail(),
            ':telfNumber' => $u->getNumber(),
        ]);

        // Si ha ido bien, devolvemos el ID generado. Si no, false.
        return $res ? $this->db->lastInsertId() : false;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
        
    }

    protected function deleteUserById(int $id)  {
        $sql = 'DELETE FROM users WHERE id = :id';

        try {
            $stmt = $this->db->prepare($sql);
            $res = $stmt->execute([
            ':id' => $id]);
            return $res ? $this->db->lastInsertId() : false;
        }catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
}
}