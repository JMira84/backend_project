<?php
require_once("base.php");

class Category extends Base {
    public function getList() {
        $query = $this->db->prepare("
            SELECT category_id, category_name
            FROM categories
            ORDER BY category_name DESC
        ");

        $query->execute();

        $categories = $query->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }
}