<?php
require_once("base.php");

class Article extends Base {
    public function getList() {
        $page = 0;
        $per_page = 4;
        $page_counter = 1;
        $next = $page_counter + 1;
        $prev = $page_counter - 1;

        if(isset($_GET["page"])) {
            $page = (int)$_GET["page"] - 1;
            $page_counter = (int)$_GET["page"];
            $page = $page * $per_page;
            $next = $page_counter + 1;
            $prev = $page_counter - 1;
        }

        $query = $this->db->prepare('
            SELECT a.article_id, a.title, a.content, a.article_img, a.created_at, u.username, u.profile_img, c.category_name,
            c.category_id
            FROM articles a
            INNER JOIN users u USING(user_id)
            INNER JOIN categories c USING(category_id)
            ORDER BY created_at DESC
            LIMIT ' . $page . ', ' . $per_page . '
        ');

        $query->execute();

        $articles = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = $this->db->prepare("
            SELECT article_id, title, content, article_img, created_at
            FROM articles
        ");

        $query->execute();

        $count = $query->rowCount();

        $paginations = ceil($count / $per_page);

        return array($page, $page_counter, $next, $prev, $articles, $count, $paginations);
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
       $page = 0;
        $per_page = 4;
        $page_counter = 1;
        $next = $page_counter + 1;
        $prev = $page_counter - 1;

        if(isset($_GET["page"])) {
            $page = (int)$_GET["page"] - 1;
            $page_counter = (int)$_GET["page"];
            $page = $page * $per_page;
            $next = $page_counter + 1;
            $prev = $page_counter - 1;
        }

        $query = $this->db->prepare('
            SELECT a.article_id, a.title, a.content, a.article_img, a.created_at, u.username, u.profile_img, c.category_name,
            c.category_id
            FROM articles a
            INNER JOIN users u USING(user_id)
            INNER JOIN categories c USING(category_id)
            WHERE a.category_id = ?
            ORDER BY created_at DESC
            LIMIT ' . $page . ', ' . $per_page . '
        ');

        $query->execute([ $category_id ]);

        $articles = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = $this->db->prepare("
            SELECT article_id, title, content, article_img, created_at
            FROM articles
            WHERE category_id = ?
        ");

        $query->execute([ $category_id ]);

        $count = $query->rowCount();

        $paginations = ceil($count / $per_page);

        return array($page, $page_counter, $next, $prev, $articles, $count, $paginations);
    }

    public function create($data) {
        if(!empty($data["title"]) && !empty($data["content"])) {
            $file_name = $this->uploadImage();

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

    public function update($data) {
        $file_name = $this->uploadImage();

        $query = $this->db->prepare("
            UPDATE articles
            SET 
                category_id = ?,
                title = ?, 
                article_img = ?, 
                content = ?
            WHERE article_id = ?
        ");

        $query->execute([
            $data["category_id"],
            $data["title"],
            $file_name,
            $data["content"],
            $data["article_id"]
        ]);

        $article_id = $this->db->lastInsertId();

        return $article_id;
    }

    public function delete($data) {
        $query = $this->db->prepare("
            DELETE
            FROM articles
            WHERE article_id = ?
        ");

        $query->execute([
            $data["article_id"]
        ]);
    }
}