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

    public function uploadArticleImage($data) {
        $accepts = [
            "png" => "image/png",
            "jpg" => "image/jpeg"
        ];

        if (!empty($_FILES["article_img"]["tmp_name"])) {
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

                $image = $file_name;
            } else {
                die("O upload falhou");
            }
        } else {
            $image = $data["article_img"];
        }

        return $image;
    }   
}