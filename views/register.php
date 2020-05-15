<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pé de Cereja - Criar Conta</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <main>
                <div class="form-flex-container display-flex flex-column justify-center align-center">
                    <div class="form-container">
                        <h2 class="form-heading">Criar Conta</h2>
                        <form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>">
                            <div class="field-container display-flex flex-column">
                                <label for="username">Username</label>
                                <input id="username" type="text" name="username" minlength="2" maxlength="120" autofocus required autocomplete="off">
                            </div>
                            <div class="field-container display-flex flex-column">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" maxlength="252" required autocomplete="off">
                            </div>
                            <div class="field-container display-flex flex-column">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" minlength="6" maxlength="1000" required autocomplete="off">
                            </div>
                            <div class="field-container display-flex flex-column">
                                <label for="rep_password">Confirmar Password</label>
                                <input id="rep_password" type="password" name="rep_password" minlength="6" maxlength="1000" required autocomplete="off">
                            </div>
                            <div class="submit-container display-block">
                                <input type="hidden" name="csrf_token" value="<?=$_SESSION["csrf_token"]?>">
                                <button class="action-button" type="submit" name="send">Criar Conta</button>
                            </div>
                        </form>
                    </div><!--end form-container-->
                </div>
            </main>
        </div><!--end cointainer-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php require("layouts/footer.php")?>
    </body>
</html>