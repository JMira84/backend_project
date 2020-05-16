<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Perfil</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <main>
                <div class="admin-flex-container display-flex flex-column justify-center align-center">
                    <div class="admin-container">
                        <h2 class="admin-heading">Editar Perfil</h2>
                        <div class="display-flex align-center">
                            <ul class="admin-menu display-flex flex-column">
                                <li class="menu-list">
                                    <div class="sub-menu-trigger display-flex align-center">
                                        <i class="sub-menu-arrow las la-angle-right"></i>
                                        <h3>Alterar Info</h3>
                                    </div>
                                    <ul class="sub-menu">
                                        <li>
                                            <form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>" enctype="multipart/form-data">
                                                <div class="field-container display-flex flex-column">
                                                    <label for="profile_img">Imagem de Perfil</label>
                                                    <input id="profile_img" type="file" name="profile_img" accept=".png, .jpeg, .jpg">
                                                </div>
<?php
    if(isset($_SESSION["is_admin"])) {
?>
                                                <div class="field-container display-flex flex-column">
                                                    <label for="about">Sobre Ti</label>
                                                    <textarea id="about" name="about" maxlength="65535" cols="58" rows="6" autocomplete="off"></textarea>
                                                </div>
<?php
    }
?>
                                                <div class="field-container display-flex flex-column">
                                                    <label for="username">Alterar Username</label>
                                                    <input id="username" type="text" name="username" minlength="2" maxlength="120" autofocus autocomplete="off">
                                                </div>
                                                <div class="inline-block">
                                                    <button class="action-button" type="submit" name="send_new_info">Alterar</button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-list">
                                    <div class="sub-menu-trigger display-flex align-center">
                                        <i class="sub-menu-arrow las la-angle-right"></i>
                                        <h3>Alterar Password</h3>
                                    </div>
                                    <ul class="sub-menu">
                                        <li>
                                            <form method="POST" action="profile.html">
                                                <div class="field-container display-flex flex-column">
                                                    <label for="password">Nova Password</label>
                                                    <input id="password" type="password" name="password" maxlength="255" required autocomplete="off">
                                                </div>
                                                <div class="field-container display-flex flex-column">
                                                    <label for="rep_password">Confirmar Nova Password</label>
                                                    <input id="rep_password" type="password" name="rep_password" maxlength="255" required autocomplete="off">
                                                </div>
                                                <div class="inline-block">
                                                    <button class="action-button" type="submit" name="send_new_password">Alterar</button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div><!--end admin-container-->
                </div><!--end admin-flex-container-->
            </main>
        </div><!--end cointainer-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php require("layouts/footer.php")?>
    </body>
</html>