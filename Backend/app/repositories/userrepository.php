<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class UserRepository extends Repository
{
    function login($user)
    {
        try {
            $stmt = $this->connection->prepare("SELECT  id, password, role FROM users WHERE email = ?");
            $stmt->execute([
                $user->email
            ]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\\User');
            $returneduser = $stmt->fetch();

            $result = $this->verifyPassword($user->password , $returneduser->password);

            if (!$result) {
                return false;
            }
            // elseif($returneduser->role == "customer") {
            //     return "customer";
            // }
            // elseif($returneduser->role == "admin") {
            //     return "admin";
            // }
            return $returneduser;
        }
         catch (PDOException $e) {
            echo $e;
        }
    }

    public function register($user) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO users (firstname, email, password, role) VALUES (?, ?, ?, ?)");
            $defaultrole = "customer";
            
            $stmt->execute([
                $user->firstname,
                $user->email,
                $this->hashPassword($user->password),
                $defaultrole
            ]);
    
            return $this->connection->lastInsertId(); 
        } catch (PDOException $e) {
            error_log("Something went wrong in register: " . $e->getMessage());
            return false; // Return false instead of null
        }
    }

    // hash the password (currently uses bcrypt)
    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // verify the password hash
    function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }

    public function updateRefreshToken($user, $refreshToken) {
        $sql = "UPDATE users SET refresh_token = :refresh_token WHERE id = :user_id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':refresh_token', $refreshToken);
        $stmt->bindParam(':user_id', $user->id);

        return $stmt->execute(); 
    }

    public function checkRefreshToken($userid, $token) {

    }
}
