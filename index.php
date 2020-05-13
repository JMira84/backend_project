<?php
session_start();
setlocale(LC_ALL, "pt.UTF-8");

$url_parts = explode("/", $_SERVER["REQUEST_URI"]);

// $url_parts[1] => controller 
// $url_parts[2] => action 
// $url_parts[3] => optional 

define("HOME_PATH", dirname($_SERVER["SCRIPT_NAME"]) . "/");

$controller = "home";

$controllers = ["home", "article", "browse", "admin", "access"];

if(isset($url_parts[1]) && in_array($url_parts[1], $controllers)) {
    $controller = $url_parts[1];
}

require("controllers/".$controller.".php");