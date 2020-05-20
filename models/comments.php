<?php
require_once("base.php");

class Comment extends Base {
    public function createComment($data) {
        $query = $this->db->prepare("
            INSERT INTO comments
            (article_id, comment_content, user_id)
            VALUES(?, ?, ?)
        ");

        $query->execute([
            $data["article_id"],
            $data["comment_content"],
            $_SESSION["user_id"]
        ]);
    }

    public function viewComments() {
        $query = $this->db->prepare("
            SELECT c.comment_content, c.created_at, u.username, u.profile_img
            FROM comments c
            INNER JOIN users u USING(user_id)
            ORDER BY c.created_at DESC
        ");

        $query->execute();

        $comments = $query->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }
}