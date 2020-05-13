<?php
require("base.php");

class Article extends Base {
    public function getList() {
        $query = $this->db->prepare('
            SELECT a.title, a.content, a.article_img, a.created_at, u.username, u.profile_img, c.category_name
            FROM articles a
            INNER JOIN users u USING(user_id)
            INNER JOIN categories c USING(category_id)
            ORDER BY created_at DESC
        ');

        $query->execute();

        $articles = $query->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }
}