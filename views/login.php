<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pé de Cereja - Login</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <main>
                <div class="form-flex-container display-flex flex-column justify-center align-center">
                    <div class="form-container">
                        <h2 class="form-heading">Login</h2>
                        <form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>">
                            <div class="field-container display-flex flex-column">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" maxlength="252" autofocus required autocomplete="off">
                            </div>
                            <div class="field-container display-flex flex-column">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" minlength="6" maxlength="1000" required autocomplete="off">
                            </div>
                            <div class="submit-container display-block">
                                <button class="action-button" type="submit" name="send">Entrar</button>
                            </div>
                        </form>
                    </div><!--end form-container-->
                    <div class="register-info-container">
                        <p class="register-info">Ainda não tem conta? Registe-se <a class="register-link" href="<?=HOME_PATH?>access/register">aqui</a>.</p>
                    </div>
                </div>
            </main>
        </div><!--end cointainer-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php require("layouts/footer.php")?>
    </body>
</html>