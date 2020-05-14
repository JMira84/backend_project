<?php
require("models/article.php");

$articleModel = new Article();
list($articles, $paginations) = $articleModel->getList();
$latestArticles = $articleModel->getLatestArticles();

require("views/home.php");