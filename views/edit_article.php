<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Artigo</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <main>
                <div class="admin-flex-container display-flex flex-column justify-center align-center">
                    <div class="admin-container">
                        <h2 class="admin-heading">Editar Artigo</h2>
                        <div class="admin-menu-flex-container display-flex align-center">
                            <form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>" enctype="multipart/form-data">
                                <div class="field-container display-flex flex-column">
                                    <label for="article_id">Artigo</label>
                                    <select id="article_id" name="article_id">
                                        <option value="ARTICLE ID">ARTICLE NAME</option>
                                    </select>
                                </div>
                                <div class="field-container display-flex flex-column">
                                    <label for="title">Editar Título</label>
                                    <input id="tite" type="text" name="title" maxlength="200" autocomplete="off">
                                </div>
                                <div class="field-container">
                                    <label for="article_img">Editar Imagem</label>
                                    <input class="img-upload" id="article_img" type="file" name="article_img" accept=".png, .jpeg, .jpg">
                                </div>
                                <div class="field-container display-flex flex-column">
                                    <label for="content">Editar Conteúdo</label>
                                    <textarea id="content" name="content" maxlength="65535"></textarea>
                                </div>
                                <div class="field-container submit-container">
                                    <button class="create-btn" type="submit" name="send">Editar Artigo</button>
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