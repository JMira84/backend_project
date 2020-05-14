<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/article.php");

$articleModel = new Article();

if($url_parts[2] === "category") {
    if(empty($url_parts[3])) {
        header("HTTP/1.1 400 Bad Request");
        die("Request Inválido");
    }
    
    if(is_numeric($url_parts[3])) {
        $articles = $articleModel->getByCategory($url_parts[3]);
    }

    if(empty($articles)) {
        header("HTTP/1.1 404 Not Found");
        die("Categoria inexistente");
    }
}

$latestArticles = $articleModel->getLatestArticles();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();

require("views/home.php");