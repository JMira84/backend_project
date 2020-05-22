<?php
require_once("base.php");

class Comment extends Base {
    public function createComment($data) {
        $query = $this->db->prepare("
            INSERT INTO comments
            (article_id, comment_content, user_id, parent_id)
            VALUES(?, ?, ?, ?)
        ");

        $result = $query->execute([
            $data["article_id"],
            $data["comment_content"],
            $_SESSION["user_id"],
            $data["parent_id"]
        ]);

        return $result;
    }

    public function viewComments($article_id) {
        $page = 0;
        $per_page = 5;
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
            SELECT 
                c.comment_id, c.comment_content, c.created_at, c.parent_id, u.username, u.profile_img, 
                u.user_id, co.user_id AS parent_user_id, us.username AS parent_username 
            FROM comments c INNER JOIN users u USING(user_id) 
            LEFT JOIN comments co ON(co.comment_id = c.parent_id) 
            LEFT JOIN users us ON(us.user_id = co.user_id)
            WHERE c.article_id = ?
            ORDER BY c.created_at DESC 
            LIMIT " . $page . ", " . $per_page . "
        ");

        $query->execute([ $article_id ]);

        $comments = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = $this->db->prepare("
            SELECT comment_id, article_id, comment_content, created_at, user_id
            FROM comments
            WHERE article_id = ?
        ");

        $query->execute([ $article_id ]);

        $count = $query->rowCount();

        $paginations = ceil($count / $per_page);

        return array($page, $page_counter, $next, $prev, $comments, $count, $paginations);
    }
}