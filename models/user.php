<?php
require_once("base.php");

class User extends Base {
    public function getList() {
        $query = $this->db->prepare("
            SELECT user_id, username, email, password, profile_img, about, is_admin, created_at
            FROM users
        ");
        
        $query->execute();

        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getMainAdmin() {
        $query = $this->db->prepare("
            SELECT profile_img, about
            FROM users
            WHERE username = ?
        ");

        $query->execute(["PéDeCereja"]);

        $main_admin = $query->fetch(PDO::FETCH_ASSOC);

        return $main_admin;
    }
    
    public function register($data) {
        $data = $this->sanitizer($data);

        if(
            !empty($data["username"]) &&
            mb_strlen($data["username"]) > 2 ||
            mb_strlen($data["username"]) <= 120 &&
            !empty($data["password"]) &&
            mb_strlen($data["password"]) > 6 ||
            mb_strlen($data["password"]) <= 1000 &&
            $data["password"] === $data["rep_password"] &&
            filter_var($data["email"], FILTER_VALIDATE_EMAIL)
        ) {
            $query = $this->db->prepare("
                INSERT INTO users
                (username, email, password)
                VALUES(?, ?, ?)
            ");

            $query->execute([
                $data["username"],
                $data["email"],
                password_hash($data["password"], PASSWORD_DEFAULT)
            ]);

            return true;
        }

        return false;
    }

    public function login($data) {
        $data = $this->sanitizer($data);

        if(
            !empty($data["email"]) &&
            !empty($data["password"]) &&
            filter_var($data["email"], FILTER_VALIDATE_EMAIL) &&
            mb_strlen($data["password"]) <= 1000
        ) {
            $query = $this->db->prepare("
                SELECT user_id, email, password, is_admin, profile_img, username, about
                FROM users
                WHERE email = ?
            ");

            $query->execute([ $data["email"] ]);

            $user = $query->fetch(PDO::FETCH_ASSOC);

            if(!empty($user) && password_verify($data["password"], $user["password"])) {
                $_SESSION["is_admin"] = $user["is_admin"];
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["profile_img"] = $user["profile_img"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["about"] = $user["about"];

                return true;
            }

            return false;
        }
    }

    public function updateInfo($data) {
        $data = $this->sanitizer($data);

        $image = $this->uploadImage();
            
        $query = $this->db->prepare("
            UPDATE users
            SET 
                profile_img = ?, 
                about = ?, 
                username = ?
            WHERE user_id = ?
        ");

        $result = $query->execute([
            $image,
            $data["about"],
            $data["username"],
            $_SESSION["user_id"]
        ]);

        if (!empty($result)) {
            $_SESSION["username"] = $data["username"];
            $_SESSION["about"] = $data["about"];
            $_SESSION["profile_img"] = $image;
        }

        return $result;
    }

    public function updatePassword($data) {
        $data = $this->sanitizer($data);

        if (
            !empty($data["password"]) &&
            mb_strlen($data["password"]) > 6 ||
            mb_strlen($data["password"]) <= 1000 &&
            $data["password"] === $data["rep_password"]
        ) {
            $query = $this->db->prepare("
                UPDATE users
                SET
                    password = ?
                WHERE user_id = ?
            ");

            $result = $query->execute([
                password_hash($data["password"], PASSWORD_DEFAULT),
                $_SESSION["user_id"]
            ]);

            return $result;
        }
    }

    public function addAdmin($data) {
        $query = $this->db->prepare("
            UPDATE users
            SET is_admin = ?
            WHERE user_id = ?
        ");

        $result = $query->execute([
            $data["is_admin"],
            $data["user_id"]
        ]);

        return $result;
    }

    public function removeAdmin($data)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET is_admin = ?
            WHERE user_id = ?
        ");

        $result = $query->execute([
            $data["is_admin"],
            $data["user_id"]
        ]);
        
        return $result;
    }

    public function delete($data)
    {
        $query = $this->db->prepare("
            DELETE
            FROM users
            WHERE user_id = ?
        ");

        $result = $query->execute([
            $data["user_id"]
        ]);

        return $result;
    }
}