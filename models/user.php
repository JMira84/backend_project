<?php
require("base.php");

class User extends Base {
    public function getMainAdmin() {
        $query = $this->db->prepare("
            SELECT profile_img, about
            FROM users
            WHERE username = ?
        ");

        $query->execute(["PéDeCereja"]);

        $main_admin = $query->fetch(PDO::FETCH_ASSOC);

        return $main_admin;
    }
}