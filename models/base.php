<?php
class Base {
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=blog;charset=utf8mb4", "root", "");
    }

    public function sanitizer($input) {
        foreach($input as $key => $value) {
            $input[$key] = strip_tags(trim($value));
        }
        return $input;
    }

    public function uploadImage() {
        $accepts = [
            "png" => "image/png",
            "jpeg" => "image/jpeg",
            "jpg" => "image/jpeg"
        ];

        if (isset($_FILES["article_img"])) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $detected_type = finfo_file($finfo, $_FILES["article_img"]["tmp_name"]);

            if (
                $_FILES["article_img"]["error"] === 0 &&
                in_array($detected_type, $accepts) &&
                $_FILES["article_img"]["size"] > 0 &&
                $_FILES["article_img"]["size"] < 20000000
            ) {

                $file_name = date('YmdHis') . "_" . mt_rand(100000, 999999) . "." . array_search($detected_type, $accepts);
                move_uploaded_file($_FILES["article_img"]["tmp_name"], "uploads/articles/" . $file_name);
            } else {
                die("O upload falhou");
            }
        } else if(isset($_FILES["profile_img"])) {
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
            } else {
                die("O upload falhou");
            }
        }

        return $file_name;
    }
}