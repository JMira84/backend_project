<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();

if (isset($_SESSION["user_id"])) {
    $user = $userModel->getLoggedUser();
}

require("models/article.php");

$articleModel = new Article();

if(!isset($url_parts[2])) {
    require("views/admin.php");
} else if ($url_parts[2] === "create_article") {
    if(!isset($_SESSION["user_id"])) {
        header("Location: ../access/login");
        exit;
    }

    if(isset($_POST["send"])) {
        $post_id = $articleModel->create($_POST);
        if(!empty($post_id)) {
            header("Location: " . HOME_PATH . "article/" . $post_id);
        }
    }

    require("views/create.php");
}