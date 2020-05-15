<?php
require_once("base.php");

class User extends Base {
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

    public function getLoggedUser() {
        $query = $this->db->prepare("
            SELECT username, profile_img, about
            FROM users
            WHERE user_id = ?
        ");

        $query->execute([ $_SESSION["user_id"] ]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
    
    public function register($data) {
        foreach ($data as $key => $value) {
            $data[$key] = strip_tags(trim($value));
        }
        
        if(isset($data["send"]) && $_SESSION["csrf_token"] === $data["csrf_token"]) {

            // $data = $this->sanitizer($data);
            
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

        $_SESSION["csrf_token"] = sha1(mt_rand(10000, 99999) + mt_rand(10000, 99999));
    }

    public function login($data) {
        foreach ($data as $key => $value) {
            $data[$key] = strip_tags(trim($value));
        }

        // $data = $this->sanitizer($data);

        if(
            !empty($data["email"]) &&
            !empty($data["password"]) &&
            filter_var($data["email"], FILTER_VALIDATE_EMAIL) &&
            mb_strlen($data["password"]) <= 1000
        ) {
            $query = $this->db->prepare("
                SELECT user_id, email, password, is_admin
                FROM users
                WHERE email = ?
            ");

            $query->execute([ $data["email"] ]);

            $user = $query->fetch(PDO::FETCH_ASSOC);

            if(!empty($user) && password_verify($data["password"], $user["password"])) {
                $_SESSION["is_admin"] = $user["is_admin"];
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["email"] = $user["email"];

                return true;
            }

            return false;
        }
    }
}