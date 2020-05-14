<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/article.php");

$articleModel = new Article();
$latestArticles = $articleModel->getLatestArticles();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();

if(empty($url_parts[2])) {
    header("HTTP/1.1 400 Bad Request");
    die("ID Inválido");
}

if(is_numeric($url_parts[2])) {
    $article = $articleModel->getSingleArticle($url_parts[2]);

    if(empty($article)) {
        header("HTTP/1.1 404 Not Found");
        die("Artigo inexistente");
    }
    
    require("views/article.php");
}