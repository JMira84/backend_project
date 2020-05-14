<?php
require("models/article.php");

$articleModel = new Article();
list($articles, $paginations) = $articleModel->getList();
$latestArticles = $articleModel->getLatestArticles();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();

require("views/home.php");