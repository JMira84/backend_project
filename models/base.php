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
    }
}