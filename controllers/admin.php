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

require("views/admin.php");