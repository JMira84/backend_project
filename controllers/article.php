<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/article.php");

$articleModel = new Article();
$latestArticles = $articleModel->getLatestArticles();
$datesList = $articleModel->dateList();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();

require("models/comments.php");
$commentModel = new Comment();

if(empty($url_parts[2])) {
    header("HTTP/1.1 400 Bad Request");
    die("ID Inválido");
}

if(is_numeric($url_parts[2])) {
    $article = $articleModel->getSingleArticle($url_parts[2]);

    list($page, $page_counter, $next, $prev, $comments, $count, $paginations) = $commentModel->viewComments($url_parts[2]);

    if(isset($_POST["send"])) {
        if(!empty($_POST["comment_content"])) {
            $commentModel->createComment($_POST);
            header("Location: " . HOME_PATH . "article/" . $url_parts[2]);
        } else {
            $comments_message = "Por favor, preencha a área de texto.";
        }
    }

    if(empty($article)) {
        header("HTTP/1.1 404 Not Found");
        die("Artigo inexistente");
    }
    
    require("views/article.php");
}