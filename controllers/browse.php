<?php
require("models/category.php");

$categoryModel = new Category();

if(empty($url_parts[2])) {
    header("HTTP/1.1 400 Bad Request");
    die("Request Inválido");
}

if(is_numeric($url_parts[2])) {
    $categories = $categoryModel->getList();
}

require("views/home.php");