<?php
require_once("base.php");

class Article extends Base {
    public function getList() {
        $query = $this->db->prepare('
            SELECT a.article_id, a.title, a.content, a.article_img, a.created_at, u.username, u.profile_img, c.category_name,
            c.category_id
            FROM articles a
            INNER JOIN users u USING(user_id)
            INNER JOIN categories c USING(category_id)
            ORDER BY created_at DESC
        ');

        $query->execute();

        $articles = $query->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

    public function getSingleArticle($id) {
        $query = $this->db->prepare('
            SELECT a.article_id, a.title, a.content, a.article_img, a.created_at, u.username, u.profile_img, u.about, c.category_name, c.category_id
            FROM articles a
            INNER JOIN users u USING(user_id)
            INNER JOIN categories c USING(category_id)
            WHERE a.article_id = ?
        ');

        $query->execute([ $id ]);

        $article = $query->fetch(PDO::FETCH_ASSOC);

        return $article;
    }

    public function getLatestArticles() {
        $query = $this->db->prepare('
            SELECT a.article_id, a.title, a.created_at, a.article_img, c.category_name, c.category_id
            FROM articles a
            INNER JOIN categories c USING(category_id)
            ORDER BY created_at DESC
            LIMIT 3
        ');

        $query->execute();

        $latestArticles = $query->fetchAll(PDO::FETCH_ASSOC);

        return $latestArticles;
    }

    public function getByCategory($category_id) {
        $query = $this->db->prepare("
            SELECT a.article_id, a.title, a.content, a.article_img, a.created_at, u.username, u.profile_img, c.category_name,
            c.category_id
            FROM articles a
            INNER JOIN users u USING(user_id)
            INNER JOIN categories c USING(category_id)
            WHERE a.category_id = ?
            ORDER BY created_at DESC
        ");

        $query->execute([ $category_id ]);

        $articles = $query->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

    public function create($data) {
        $accepts = [
            "png" => "image/png",
            "jpeg" => "image/jpeg",
            "jpg" => "image/jpeg"
        ];

        if(isset($data["send"]) && isset($_FILES["article_img"])) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $detected_type = finfo_file($finfo, $_FILES["article_img"]["tmp_name"]);

            if(
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

            if(!empty($data["title"]) && !empty($data["content"])) {
                $query = $this->db->prepare("
                    INSERT INTO articles
                    (title, article_img, content, user_id, category_id)
                    VALUES(?, ?, ?, ?, ?)
                ");

                $query->execute([
                    $data["title"],
                    $file_name,
                    $data["content"],
                    $_SESSION["user_id"],
                    $data["category_id"]
                ]);

                $article_id = $this->db->lastInsertId();

                return $article_id;
            }
        }
    }
}