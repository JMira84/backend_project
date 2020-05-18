<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pé de Cereja - Contacto</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <main>
                <div class="contact-flex-container">
                    <div class="contact-container display-flex flex-column align-center">
                        <h2 class="contact-heading">Contacto</h2>
                        <form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>">
                            <div class="name-subject-email display-flex flex-row">
                                <div class="field-container display-flex flex-column contact-field">
                                    <label for="name">Nome</label>
                                    <input id="name" type="text" name="name" minlength="2" maxlength="120" required autofocus autocomplete="off">
                                </div>
                                <div class="field-container display-flex flex-column contact-field">
                                    <label for="subject">Assunto</label>
                                    <input id="subject" type="text" name="subject" minlength="3" maxlength="120" required autocomplete="off">
                                </div>
                                <div class="field-container display-flex flex-column contact-field">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" maxlength="252" required autocomplete="off">
                                </div><!--end name-subject-email-->
                            </div>
                            <div class="field-container display-flex flex-column">
                                <label for="message">Mensagem</label>
                                <textarea id="message" name="content" maxlength="65535" cols="58" rows="6" required></textarea>
                            </div>
                            <div class="inline-block">
                                <button class="action-button" type="submit" name="send">Enviar</button>
                            </div>
                        </form>
                    </div><!--end contact-container-->
                </div>
            </main>
        </div><!--end cointainer-->

        <?php require("layouts/back_to_top.php")?>

        <?php require("layouts/background.php")?>

        <?php require("layouts/footer.php")?>
    </body>
</html>