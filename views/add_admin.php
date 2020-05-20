<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adicionar Administrador</title>
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
                        <h2 class="admin-heading">Adicionar Administrador</h2>
                        <div class="admin-menu-flex-container display-flex align-center">
                            <form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>" enctype="multipart/form-data">
<?php
    foreach($users as $user) {
        if(empty($user["is_admin"])) {
            echo '
                                    <div class="add-admin-field field-container display-flex flex-row space-between">
                                        <label for="add_admin' . $user["user_id"] . '">' . $user["username"] . '</label>
                                        <input id="add_admin' . $user["user_id"] . '" type="checkbox" name="is_admin" value="1">
                                        <input type="hidden" name="user_id" value="' . $user["user_id"] . '">
                                    </div>
            ';
        }
    }
?>
                                <div class="field-container submit-container">
                                    <button class="create-btn" type="submit" name="send">Adicionar</button>
                                </div>
                            </form>
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