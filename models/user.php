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
    
    public function register($data) {
        $data = $this->sanitizer($data);

        if(isset($data["send"]) && $_SESSION["csrf_token"] === $data["csrf_token"]) {
            if(
                !empty($data["username"]) &&
                mb_strlen($data["username"]) > 2 ||
                mb_strlen($data["username"]) <=120 &&
                !empty($data["password"]) &&
                mb_strlen($data["password"]) > 6 ||
                mb_strlen($data["password"]) <= 1000 &&
                $data["password"] === $data["rep_password"] &&
                filter_var($data["email"], FILTER_VALIDATE_EMAIL)
            ) {
                $query = $this->db->prepare("");
    
                $query->execute();
    
                return true;
            }
    
            return false;
        }

        $_SESSION["csrf_token"] = sha1(mt_rand(10000, 99999) + mt_rand(10000, 99999));
    }
}