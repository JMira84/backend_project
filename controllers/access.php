<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

if(!isset($url_parts[2])) {
    header("HTTP/1.1 400 Bad Request");
    die("Request Inválido");
}

require("models/user.php");

$userModel = new User();

if($url_parts[2] === "register") {
    if(isset($_POST["send"])) {
        $res = $userModel->register($_POST);

        if($res) {
            header("Location: ../access/login");
            exit;
        }
    }

    require("views/register.php");
} else if($url_parts[2] === "login") {
    if(isset($_POST["send"])) {
        $res = $userModel->login($_POST);

        if($res) {
            header("Location: ../");
            exit;
        }

        $message = "Dados Incorrectos";
    }

    require("views/login.php");
} else if($url_parts[2] === "logout") {
    session_destroy();
    header("Location: ../");
}