<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();
$users = $userModel->getList();

if (isset($_SESSION["user_id"])) {
    $user = $userModel->getLoggedUser();
}

require("models/article.php");

$articleModel = new Article();
list($page, $page_counter, $next, $prev, $articles, $count, $paginations) = $articleModel->getList();

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

} else if ($url_parts[2] === "edit_article") {
    if(empty($url_parts[4])) {
        if (!isset($_SESSION["user_id"])) {
            header("Location: ../access/login");
            exit;
        }
    
        require("views/edit_article_list.php");

    } else if (isset($url_parts[4]) && is_numeric($url_parts[4])) {

        $article = $articleModel->getSingleArticle($url_parts[4]);
        
        if (empty($article)) {
            header("HTTP/1.1 404 Not Found");
            die("Artigo inexistente");
        }

        if (isset($_POST["send"])) {
            $post_id = $articleModel->update($_POST, $url_parts[4]);
            if (!empty($post_id)) {
                header("Location: " . HOME_PATH . "article/" . $post_id);
            }
        }
        
        require("views/edit_article.php");
    }
    
} else if ($url_parts[2] === "delete_article") {
    if(!isset($_SESSION["user_id"])) {
        header("Location: ../access/login");
        exit;
    }
    
    if(isset($_POST["article_id"])) {
        $res = $articleModel->delete($_POST);
        if(!empty($res)) {
            header("Location: " . HOME_PATH . "admin/delete_article");
        }
    }
    
    require("views/delete_article.php");

} else if ($url_parts[2] === "add_admin") {
    if (!isset($_SESSION["user_id"])) {
        header("Location: ../access/login");
        exit;
    }

    if(isset($_POST["send"])) {
        $res = $userModel->addAdmin($_POST);
        if(!empty($res)) {
            header("Location: " . HOME_PATH . "admin/add_admin");
        }
    }

    require("views/add_admin.php");

} else if ($url_parts[2] === "remove_admin") {
    if (!isset($_SESSION["user_id"])) {
        header("Location: ../access/login");
        exit;
    }

    if (isset($_POST["send"])) {
        $res = $userModel->removeAdmin($_POST);
        if (!empty($res)) {
            header("Location: " . HOME_PATH . "admin/remove_admin");
        }
    }

    require("views/remove_admin.php");

} else if ($url_parts[2] === "delete_user") {
    if (!isset($_SESSION["user_id"])) {
        header("Location: ../access/login");
        exit;
    }

    if(isset($_POST["user_id"])) {
        $res = $userModel->delete($_POST);
        if(!empty($res)) {
            header("Location: " . HOME_PATH . "admin/delete_user");
        }
    }

    require("views/delete_user.php");
}