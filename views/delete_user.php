<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar Utilizador</title>
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
                        <h2 class="admin-heading">Eliminar Utilizador</h2>
                        <div class="admin-menu-flex-container display-flex flex-column align-center">
<?php
    foreach($usersPaginations as $user) {
        echo '
                            <div class="delete-user field-container delete-field display-flex flex-row space-between" data-user_id="' . $user["user_id"] . '">
                                <span>' . $user["username"] . '</span>
                                <button class="delete-button las la-trash" type="button" aria-label="Delete"></button>
                            </div>
        ';
    }
?>
                        </div><!--admin-menu-flex-container-->

                        <?php require("layouts/pagination.php")?>
                    </div><!--end admin-container-->
                </div><!--end admin-flex-container-->
            </main>
        </div><!--end cointainer-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php require("layouts/footer.php")?>
    </body>
</html>