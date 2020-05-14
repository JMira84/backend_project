<?php
require_once("base.php");

class Article extends Base {
    public function getList() {
        $per_page = 4;

        if(isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        $page_1 = ($page * $per_page) - $per_page;

        $query = $this->db->prepare('
            SELECT a.article_id, a.title, a.content, a.article_img, a.created_at, u.username, u.profile_img, c.category_name,
            c.category_id
            FROM articles a
            INNER JOIN users u USING(user_id)
            INNER JOIN categories c USING(category_id)
            ORDER BY created_at DESC
            LIMIT ' . $page_1 . ', ' . $per_page . '
        ');

        $query->execute();

        $articles = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = $this->db->prepare('
            SELECT *
            FROM articles
        ');

        $query->execute();

        $count = $query->rowCount();

        $paginations = ceil($count / $per_page);

        return array($articles, $paginations);
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
}