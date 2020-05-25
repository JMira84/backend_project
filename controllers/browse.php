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
        list($page, $page_counter, $next, $prev, $articles, $count, $paginations) = $articleModel->getByCategory($url_parts[3]);
    }

    if(empty($articles)) {
        header("HTTP/1.1 404 Not Found");
        die("Categoria inexistente");
    }

} else if($url_parts[2] === "date") {
    if (empty($url_parts[3])) {
        header("HTTP/1.1 400 Bad Request");
        die("Request Inválido");
    }

    if (is_numeric($url_parts[3]) && is_numeric($url_parts[4])) {
        list($page, $page_counter, $next, $prev, $articles, $count, $paginations) = $articleModel->getByDate($url_parts[3], $url_parts[4]);
    }

    if (empty($articles)) {
        header("HTTP/1.1 404 Not Found");
        die("Categoria inexistente");
    }

} else if($url_parts[2] === "author") {
    if (empty($url_parts[3])) {
        header("HTTP/1.1 400 Bad Request");
        die("Request Inválido");
    }

    if (is_numeric($url_parts[3])) {
        list($page, $page_counter, $next, $prev, $articles, $count, $paginations) = $articleModel->getByAuthor($url_parts[3]);
    }

    if (empty($articles)) {
        header("HTTP/1.1 404 Not Found");
        die("Categoria inexistente");
    }
}

$latestArticles = $articleModel->getLatestArticles();

$datesList = $articleModel->dateList();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();

require("views/home.php");