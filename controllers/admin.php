<?php
require("models/category.php");

$categoryModel = new Category();
$categories = $categoryModel->getList();

require("models/user.php");

$userModel = new User();
$mainAdmin = $userModel->getMainAdmin();
$users = $userModel->getList();
list($page, $page_counter, $next, $prev, $usersPaginations, $count, $paginations) = $userModel->getPaginationList();

require("models/article.php");

$articleModel = new Article();
list($page, $page_counter, $next, $prev, $articles, $count, $paginations) = $articleModel->getList();

if ($page > $count) {
    header('HTTP/1.1 404 Not Found');
    die('Erro 404: Página inexistente');
}

if($_SESSION["is_admin"]) {

    if(!isset($url_parts[2])) {
        require("views/admin.php");
    
    } else if ($url_parts[2] === "create_article") {
        if(isset($_POST["send"])) {
            $post_id = $articleModel->create($_POST, $article);
            if(!empty($post_id)) {
                header("Location: " . HOME_PATH . "article/" . $post_id);
            }
        }
    
        require("views/create.php");
    
    } else if ($url_parts[2] === "edit_article") {
        if(empty($url_parts[4])) {
        
            require("views/edit_article_list.php");
    
        } else if (isset($url_parts[4]) && is_numeric($url_parts[4])) {
    
            $article = $articleModel->getSingleArticle($url_parts[4]);
            
            if (empty($article)) {
                header("HTTP/1.1 404 Not Found");
                die("Artigo inexistente");
            }
    
            if (isset($_POST["send"])) {
                $res = $articleModel->update($_POST, $url_parts[4], $article);
                if (!empty($res)) {
                    header("Location: " . HOME_PATH . "admin/edit_article");
                }
            }
            
            require("views/edit_article.php");
        }
        
    } else if ($url_parts[2] === "delete_article") {
        
        if($_SERVER["REQUEST_METHOD"] === "DELETE") {
            $res = $articleModel->delete($url_parts[3]);
            die($res);
        }
        
        require("views/delete_article.php");
    
    } else if ($url_parts[2] === "add_admin") {
    
        if($_SERVER["REQUEST_METHOD"] === "PUT") {
            $res = $userModel->addAdmin($url_parts[3]);
            die($res);
        }
    
        require("views/add_admin.php");
    
    } else if ($url_parts[2] === "remove_admin") {
    
        if ($_SERVER["REQUEST_METHOD"] === "PUT") {
            $res = $userModel->removeAdmin($url_parts[3]);
            die($res);
        }
    
        require("views/remove_admin.php");
    
    } else if ($url_parts[2] === "delete_user") {
    
        if($_SERVER["REQUEST_METHOD"] === "DELETE") {
            $res = $userModel->delete($url_parts[3]);
            die($res);
        }
    
        require("views/delete_user.php");
    }
    
} else {
    header("HTTP/1.1 403 Forbidden");
    die("Área interdita");
}
