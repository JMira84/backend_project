<?php
require("models/user.php");

$userModel = new User();

if (isset($_SESSION["user_id"])) {
    $user = $userModel->getLoggedUser();
}

require("views/contact.php");