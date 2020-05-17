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
                        <h2 class="admin-heading">Eliminar Artigo</h2>
                        <div class="admin-menu-flex-container display-flex align-center">
                            <ul class="delete-list">
<?php
    foreach($articles as $article) {
        echo '
                                <li class="display-flex align-center space-between">
                                    ' . $article["title"] . '
                                    <i class="delete-icon las la-trash-alt"></i>
                                </li>
        ';
    }
?>
                            </ul>
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