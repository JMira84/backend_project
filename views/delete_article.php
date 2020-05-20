<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar Artigo</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <main>
                <div class="admin-flex-container display-flex flex-column justify-center align-center">
                    <div class="admin-container">
                        <div class="return-link-container">
                            <span>&larr;</span>
                            <a href="<?=HOME_PATH?>admin">Regressar</a>
                        </div>
                        <h2 class="admin-heading">Eliminar Artigo</h2>
                        <div class="admin-menu-flex-container display-flex flex-column align-center">
                            <form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>">
<?php
    foreach($articles as $article) {
        echo '
                                <div class="field-container delete-field display-flex flex-row space-between" data-article_id="' . $article["article_id"] . '">
                                    <span>' . $article["title"] . '</span>
                                    <input type="hidden" name="article_id" value="' . $article["article_id"] . '"> 
                                    <button class="delete-button las la-trash" id="article' . $article["article_id"] . '" type="submit"></button>
                                </div>
        ';
    }
?>
                            </form>
                            <?php require("layouts/pagination.php")?>
                        </div><!--admin-menu-flex-container-->
                    </div><!--end admin-container-->
                </div><!--end admin-flex-container-->
            </main>
        </div><!--end cointainer-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php require("layouts/footer.php")?>
    </body>
</html>