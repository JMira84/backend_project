<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pé de Cereja</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="carousel relative">
<?php
    foreach($latestArticles as $latestArticle) {
        echo '
            <div class="slides carousel-content fade flex-column justify-center align-center relative">
                <div class="carousel-img">
                    <img src="assets/images/'. $latestArticle["article_img"] .'" alt="">
                </div>
                <div class="carousel-elements absolute display-flex flex-column align-center">
                    <div class="carousel-category">
                        <a class="carousel-cat-link relative" href="">' . $latestArticle["category_name"] . '</a>
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
                                <a href="article.html">
                                    <img src="assets/images/' . $article["article_img"] . '" alt="">
                                </a>
                            </figure>
                            <div class="article-list-category">
                                <a class="category-link relative" href="">' . $article["category_name"] . '</a>
                            </div>
                            <div class="article-list-title">
                                <h2>
                                    <a class="title-link" href="' . HOME_PATH . 'article/' . $article["article_id"] . '">' . $article["title"] . '</a>
                                </h2>
                            </div>
                            <div class="article-list-content">
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
                                    <p>por <a href="" title="Artigos de ' . $article["username"] . '">' . $article["username"] . '</a></p>
                                </div>
                            </div>
                        </article>
        ';
    }
?>
                    </div>
                    <!--end article-list-container-->
                    <div class="pagination">
                        <ul class="page-list display-flex justify-center flex-no-wrap">
<?php
    if(count($articles === 4)) {
        for($i = 1; $i < $paginations; $i++) {
            echo '
                            <li>
                                <a class="pages display-flex justify-center align-center" href="' . HOME_PATH . '?page=' . $i . '">' . $i . '</a>
                            </li>
            ';
        }

        if($paginations > 4) {
            echo '
                            <li>...</li>
            ';
        }

        if($paginations > 3) {
            echo '
                            <li>
                                <a class="pages display-flex justify-center align-center" href="' . HOME_PATH . '?page=' . $paginations . '">' . $paginations . '</a>
                            </li>
            ';
        }
    }
?>
                            <li>
                                <a class="pages display-flex justify-center align-center" href="">
                                    <i class="las la-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--end pagination-->
                </main>

                <?php require("layouts/aside.php")?>

            </div><!--end main-aside-container-->
        </div><!--end container-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php require("layouts/footer.php")?>
    </body>
</html>