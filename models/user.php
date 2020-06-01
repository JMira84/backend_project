<?php
require_once("base.php");

class User extends Base {
    public function getList()
    {
        $query = $this->db->prepare("
            SELECT user_id, username, email, password, profile_img, about, is_admin, created_at
            FROM users
        ");

        $query->execute();

        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function getPaginationList() {
        $page = 0;
        $per_page = 10;
        $page_counter = 1;
        $next = $page_counter + 1;
        $prev = $page_counter - 1;

        if (isset($_GET["page"])) {
            $page = (int) $_GET["page"] - 1;
            $page_counter = (int) $_GET["page"];
            $page = $page * $per_page;
            $next = $page_counter + 1;
            $prev = $page_counter - 1;
        }

        $query = $this->db->prepare("
            SELECT user_id, username, email, password, profile_img, about, is_admin, created_at
            FROM users
            LIMIT " . $page . ", " . $per_page . "
        ");
        
        $query->execute();

        $usersPaginations = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = $this->db->prepare("
            SELECT user_id, username, email, password, profile_img, about, is_admin, created_at
            FROM users
        ");

        $query->execute();

        $count = $query->rowCount();

        $paginations = ceil($count / $per_page);

        return array($page, $page_counter, $next, $prev, $usersPaginations, $count, $paginations);
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
            (mb_strlen($data["username"]) > 2 ||
            mb_strlen($data["username"]) <= 120) &&
            !empty($data["password"]) &&
            (mb_strlen($data["password"]) > 6 ||
            mb_strlen($data["password"]) <= 1000) &&
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

        $accepts = [
            "png" => "image/png",
            "jpg" => "image/jpeg"
        ];

        if (!empty($_FILES["profile_img"]["tmp_name"])) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $detected_type = finfo_file($finfo, $_FILES["profile_img"]["tmp_name"]);

            if (
                $_FILES["profile_img"]["error"] === 0 &&
                in_array($detected_type, $accepts) &&
                $_FILES["profile_img"]["size"] > 0 &&
                $_FILES["profile_img"]["size"] < 20000000
            ) {

                $file_name = date('YmdHis') . "_" . mt_rand(100000, 999999) . "." . array_search($detected_type, $accepts);
                move_uploaded_file($_FILES["profile_img"]["tmp_name"], "uploads/users/" . $file_name);

                $image = $file_name;
            } else {
                die("O upload falhou");
            }
        } else {
            $image = $_SESSION["profile_img"];
        }
            
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
            (mb_strlen($data["password"]) > 6 ||
            mb_strlen($data["password"]) <= 1000) &&
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

    public function addAdmin($id) {
        $query = $this->db->prepare("
            UPDATE users
            SET is_admin = 1
            WHERE user_id = ?
        ");

        $result = $query->execute([
            $id
        ]);

        return $result;
    }

    public function removeAdmin($id)
    {
        $query = $this->db->prepare("
            UPDATE users
            SET is_admin = 0
            WHERE user_id = ?
        ");

        $result = $query->execute([
            $id
        ]);
        
        return $result;
    }

    public function delete($id)
    {
        $query = $this->db->prepare("
            DELETE
            FROM users
            WHERE user_id = ?
        ");

        $result = $query->execute([ $id ]);

        return $result;
    }
}