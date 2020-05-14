<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/article.php");

$articleModel = new Article();
$articles = $articleModel->getList();
$latestArticles = $articleModel->getLatestArticles();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();

require("views/home.php");