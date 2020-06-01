<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pé de Cereja - HOME</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>
<?php
    if(empty($articles) && empty($latestArticles)) {
        if(isset($_SESSION["user_id"]) && $_SESSION["is_admin"]) {
            echo '
                <div class="empty-articles-div display-flex flex-column align-center justify-center">
                    <p>Olá <span>' . $_SESSION["username"] . '</span>!</p>
                    <p>Carrega <a href="' . HOME_PATH . 'admin/create_article">aqui</a> para criares o teu primeiro artigo.</p>
                </div><!--end empty-articles-div-->
            ';
        } else if(isset($_SESSION["user_id"]) && !$_SESSION["is_admin"]) {
            echo '
                <div class="empty-articles-div display-flex flex-column align-center justify-center">
                    <p>Olá <span>' . $_SESSION["username"] . '</span>!</p>
                    <p>Este blog ainda não tem artigos. Volta mais tarde.</p>
                </div><!--end empty-articles-div-->
            ';
        } else {
            echo '
                <div class="empty-articles-div display-flex flex-column align-center justify-center">
                    <p>Bem-vindo(a) ao Pé de Cereja!</p>
                    <p>Este blog ainda não tem artigos. Volta mais tarde.</p>
                </div><!--end empty-articles-div-->
            ';
        }
    } else  {
?>
        <div class="carousel relative">
<?php
foreach($latestArticles as $latestArticle) {
        echo '
            <div class="slides carousel-content fade flex-column justify-center align-center relative">
                <div class="carousel-img">
                    <img src="/uploads/articles/'. $latestArticle["article_img"] . '" alt="">
                </div>
                <div class="carousel-elements absolute display-flex flex-column align-center">
                    <div class="carousel-category">
                        <a class="carousel-cat-link relative" href="' . HOME_PATH . 'browse/category/' . $latestArticle["category_id"] . '">' . $latestArticle["category_name"] . '</a>
                    </div>
                    <div class="carousel-text">
                        <h2>
                            <a href="' . HOME_PATH . 'article/' . $latestArticle["article_id"] . '">' . $latestArticle["title"] . '</a>
                        </h2>
                    </div>
                    <div class="carousel-link">
                        <a href="' . HOME_PATH . 'article/' . $latestArticle["article_id"] . '">Ler mais</a>
                    </div>
                </div><!--end carousel-elements-->
            </div><!--end carousel-content-->
        ';
    }
?>

            <div class="next-arrow">
                <i class="next las la-arrow-right justify-center align-center absolute"></i>
            </div>

            <div class="prev-arrow">
                <i class="prev las la-arrow-left justify-center align-center absolute"></i>
            </div>
        </div><!--end carousel-->

        <div class="container">
            <div class="main-aside-container display-flex">
                <main>
                    <div class="article-list-container display-flex flex-row">
<?php
    foreach($articles as $article) {
        echo '
                        <article class="article-list display-flex flex-column align-center">
                            <figure>
                                <a href="' . HOME_PATH . 'article/' . $article["article_id"] . '">
                                    <img src="/uploads/articles/' . $article["article_img"] . '" alt="">
                                </a>
                            </figure>
                            <div class="article-list-category">
                                <a class="category-link relative" href="' . HOME_PATH . 'browse/category/' . $article["category_id"] . '">' . $article["category_name"] . '</a>
                            </div>
                            <div class="article-list-title">
                                <h2>
                                    <a class="title-link" href="' . HOME_PATH . 'article/' . $article["article_id"] . '" title="' . $article["title"] . '">' . substr($article["title"], 0, 20) . '...</a>
                                </h2>
                            </div>
                            <div class="article-list-content display-flex flex-column align-center">
                                ' . substr($article["content"], 0, 180) . '...
                            </div>
                            <div class="read-more-container">
                                <a class="read-more-link" href="' . HOME_PATH . 'article/' . $article["article_id"] . '">Ler mais</a>
                            </div>
                            <div class="date-and-author display-flex space-between">
                                <div class="article-list-date">
                                    <time datetime="' . strtotime($article["created_at"]) . '">' . strftime('%e %B %Y', strtotime($article["created_at"])) . '</time>
                                </div>
                                <div class="article-list-author">
                                    <p>por <a href="' . HOME_PATH . 'browse/author/' . $article["user_id"] . '" title="Artigos de ' . $article["username"] . '">' . $article["username"] . '</a></p>
                                </div>
                            </div>
                        </article>
        ';
    }
?>
                    </div>
                    <!--end article-list-container-->
                    <?php require("layouts/pagination.php")?>
                    <!--end pagination-->
                </main>

                <?php require("layouts/aside.php")?>

            </div><!--end main-aside-container-->
        </div><!--end container-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php
    }
?>
        <?php require("layouts/footer.php")?>

    </body>
</html>