<?php
require("models/article.php");

$articleModel = new Article();
$articles = $articleModel->getList();

require("views/home.php");