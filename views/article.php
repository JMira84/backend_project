<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php $article["title"]?></title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <div class="main-aside-container display-flex">
                <main>
                    <div class="article-and-comments-container">
                        <article class="single-article display-flex flex-column align-center">
<?php
    echo '
                            <div class="article-category">
                                <a class="category-link relative" href="' . HOME_PATH . 'browse/category/' . $article["category_id"] . '">' . $article["category_name"] . '</a>
                            </div>
                            <div class="article-title">
                                <h2>' . $article["title"] . '</h2>
                            </div>
                            <div class="article-date">
                                <time datetime="' . date("j M Y, H:i", strtotime($article["created_at"])) . '">' . strftime('%e %B, %Y', strtotime($article["created_at"])) . '</time>
                            </div>
                            <figure>
                                <img src="/uploads/articles/' . $article["article_img"] . '" alt="">
                            </figure>
                            <div class="article-content">
                                ' . $article["content"] . '
                    </div><!--end article-content-->
    
    ';
?>
<?php
    if(isset($article["about"]) && isset($article["profile_img"])) {
?>
                            <section class="author-container">
                                <div class="author-box display-flex flex-column align-center">
                                    <div class="author-photo">
                                        <img src="/uploads/users/<?php echo $article["profile_img"];?>" alt="">
                                    </div>
                                    <div class="author-description">
                                        <h3 class="author-title">
                                            <a href=""><?php echo $article["username"];?></a>
                                        </h3>
                                        <div class="author-bio">
                                            <p><?php echo $article["about"];?></p>
                                        </div>
                                    </div><!--end author-description-->
                                </div><!--end author-box-->
                            </section><!--author-container-->
<?php
    }
?>
                            <section class="comments-container">
                                <h3 class="comments-title relative">Comentários</h3>
                                <div class="comments-list-container">
                                    <ul class="comments-list">
<?php
    foreach($comments as $comment) {
        echo '
                                        <li>
                                            <div class="comment-body display-flex flex-no-wrap">
                                                <div class="author-avatar display-flex justify-center">
                                                    <img src="/uploads/users/' . $comment["profile_img"] . '" alt="">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="author-and-date display-flex align-center flex-no-wrap space-between">
                                                        <div class="comment-author">
                                                            <h3>' . $comment["username"] . '</h3>
                                                        </div>
                                                        <div class="comment-date-and-reply display-flex align-center relative">
                                                            <time datetime="' . date("j M Y, H:i", strtotime($comment["created_at"])) . '">' . strftime('%e %B, %Y', strtotime($comment["created_at"])) . '</time>
                                                            <a class="comment-reply-link" href="#comments-form">
                                                                Responder
                                                            </a>
                                                        </div>
                                                    </div><!--end author-and-date-->
                                                    <div class="text">
                                                        <p>' . $comment["comment_content"] . '.</p>
                                                    </div>
                                                </div><!--end comment-text-->
                                            </div><!--end comment-body-->
                                        </li>
        ';
    }
?>
                                    </ul>
                                </div><!--end comments-list-->

<?php
    if(isset($_SESSION["user_id"])) {
?>
                                <div class="comment-response">
                                    <form id="comments-form" method="POST" action="<?=$_SERVER["REQUEST_URI"]?>">
                                        <div class="field-container display-flex flex-column">
                                            <label for="comment-area">Deixe um comentário</label>
<?php
    if(isset($comments_message)) {
        echo'
                                            <div class="alert-message-container display-flex justify-center" role="alert">
                                                <div class="alert-message display-flex align-center">
                                                    <span>' . $comments_message . '</span>
                                                </div>
                                            </div>
        ';
    }
?>
                                            <textarea class="comment-area" id="comment-area" name="comment_content" maxlength="65535" cols="58" rows="6"></textarea>
                                        </div>
                                        <div class="inline-block">
                                            <input type="hidden" name="article_id" value="<?=$article["article_id"]?>">
                                            <button class="action-button" type="submit" name="send">Comentar</button>
                                        </div>
                                    </form>
                                </div><!--end comment-response-->
<?php
    } else {
?>
                                <p>Para escrever um comentário, faça <a class="to-login" href="<?=HOME_PATH?>access/login">login</a>.</p>
<?php
    }
?>
                            </section><!--end comments-container-->
                        </article>
                    </div><!--end article-and-comments-container-->
                </main>

                <?php require("layouts/aside.php")?>
            </div><!--end main-aside-container-->
        </div><!--end container-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php require("layouts/footer.php")?>
    </body>
</html>