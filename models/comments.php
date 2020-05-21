<?php
require_once("base.php");

class Comment extends Base {
    public function createComment($data) {
        $query = $this->db->prepare("
            INSERT INTO comments
            (article_id, comment_content, user_id)
            VALUES(?, ?, ?)
        ");

        $result = $query->execute([
            $data["article_id"],
            $data["comment_content"],
            $_SESSION["user_id"]
        ]);

        return $result;
    }

    public function viewComments() {
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

        $query = $this->db->prepare('
            SELECT c.comment_content, c.created_at, u.username, u.profile_img
            FROM comments c
            INNER JOIN users u USING(user_id)
            ORDER BY c.created_at DESC
            LIMIT ' . $page . ', ' . $per_page . '
        ');

        $query->execute();

        $comments = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = $this->db->prepare("
            SELECT comment_id, article_id, comment_content, created_at, user_id
            FROM comments
        ");

        $query->execute();

        $count = $query->rowCount();

        $paginations = ceil($count / $per_page);

        return array($page, $page_counter, $next, $prev, $comments, $count, $paginations);
    }
}