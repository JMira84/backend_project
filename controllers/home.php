<?php
require("models/article.php");

$articleModel = new Article();
$articles = $articleModel->getList();
$latestArticles = $articleModel->getLatestArticles();

require("views/home.php");