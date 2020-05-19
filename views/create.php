<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Criar Artigo</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <main>
                <div class="admin-flex-container display-flex flex-column justify-center align-center">
                    <div class="admin-container">
                        <h2 class="admin-heading">Criar Artigo</h2>
                        <div class="admin-menu-flex-container display-flex align-center">
                            <form method="POST" action="<?=$_SERVER["REQUEST_URI"]?>" enctype="multipart/form-data">
                                <div class="field-container display-flex flex-column">
                                    <label for="categories">Categoria</label>
                                    <select id="categories" name="category_id">
<?php
    foreach($categories as $category) {
        echo '
                                        <option value="' . $category["category_id"] . '">' . $category["category_name"] . '</option>
        ';
    }
?>
                                    </select>
                                </div>
                                <div class="field-container display-flex flex-column">
                                    <label for="title">Título</label>
                                    <input id="tite" type="text" name="title" maxlength="200" required autocomplete="off">
                                </div>
                                <div class="field-container">
                                    <label for="article_img">Imagem</label>
                                    <input class="img-upload" id="article_img" type="file" name="article_img" required accept=".png, .jpeg, .jpg">
                                </div>
                                <div class="field-container display-flex flex-column">
                                    <label for="content">Conteúdo</label>
                                    <textarea id="content" name="content" maxlength="65535"></textarea>
                                </div>
                                <div class="field-container submit-container">
                                    <button class="create-btn" type="submit" name="send">Criar Artigo</button>
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