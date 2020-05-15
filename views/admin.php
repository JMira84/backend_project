<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pé de Cereja</title>
        <?php require("layouts/head.php")?>
    </head>
    <body>
        <?php require("layouts/header.php")?>

        <div class="container">
            <main>
                <div class="admin-flex-container display-flex flex-column justify-center align-center">
                    <div class="admin-container">
                        <h2 class="admin-heading">Área de Administração</h2>
                        <div class="admin-menu-flex-container display-flex align-center">
                            <ul class="admin-menu display-flex flex-column">
                                <li class="menu-list">
                                    <div class="sub-menu-trigger display-flex align-center">
                                        <i class="sub-menu-arrow las la-angle-right"></i>
                                        <h3>Artigos</h3>
                                    </div>
                                    <ul class="sub-menu">
                                        <li>
                                            <div class="display-flex align-center">
                                                <i class="sub-menu-arrow las la-angle-right"></i>
                                                <h4>
                                                    <a href="<?=HOME_PATH?>admin/create_article">Criar Artigo</a>
                                                </h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="display-flex align-center">
                                                <i class="sub-menu-arrow las la-angle-right"></i>
                                                <h4>
                                                    <a href="<?=HOME_PATH?>admin/edit_article">Editar Artigo</a>
                                                </h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="display-flex align-center">
                                                <i class="sub-menu-arrow las la-angle-right"></i>
                                                <h4>
                                                    <a href="<?=HOME_PATH?>admin/delete_article">Eliminar Artigo</a>
                                                </h4>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-list">
                                    <div class="sub-menu-trigger display-flex align-center">
                                        <i class="sub-menu-arrow las la-angle-right"></i>
                                        <h3>Utilizadores</h3>
                                    </div>
                                    <ul class="sub-menu">
                                        <li>
                                            <div class="display-flex align-center">
                                                <i class="sub-menu-arrow las la-angle-right"></i>
                                                <h4>
                                                    <a href="<?=HOME_PATH?>admin/add_admin">Adicionar Administrador</a>
                                                </h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="display-flex align-center">
                                                <i class="sub-menu-arrow las la-angle-right"></i>
                                                <h4>
                                                    <a href="<?=HOME_PATH?>admin/delete_user">Eliminar Utilizador</a>
                                                </h4>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
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