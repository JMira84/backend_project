<?php
require("models/article.php");

$articleModel = new Article();
list($articles, $paginations) = $articleModel->getList();

require("views/home.php");
