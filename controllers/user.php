<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

if (!isset($url_parts[2])) {
    header("HTTP/1.1 400 Bad Request");
    die("Request Inválido");
}

require("models/user.php");

$userModel = new User();

if(isset($_SESSION["user_id"])) {
    if ($url_parts[2] === "edit_profile") {
        if (isset($_POST["send_new_info"])) {
            $res = $userModel->updateInfo($_POST);
    
            if ($res) {
                header("Location: /");
                exit;
            }
        } else if (isset($_POST["send_new_password"])) {
            $res = $userModel->updatePassword($_POST);
    
            if ($res) {
                header("Location: /");
                exit;
            }
        }
    
        require("views/edit_profile.php");
    }
} else {
    header("Location: /access/login");
    exit;
}