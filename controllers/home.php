<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/article.php");

$articleModel = new Article();
list($page, $page_counter, $next, $prev, $articles, $count, $paginations) = $articleModel->getList();

if ($page > $count) {
    header('HTTP/1.1 404 Not Found');
    die('Erro 404: Página inexistente');
}

$latestArticles = $articleModel->getLatestArticles();

$datesList = $articleModel->dateList();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();

require("views/home.php");