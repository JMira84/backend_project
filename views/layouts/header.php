<header>
    <div class="container">
        <div class="header-flex-container display-flex align-center relative">
            <div class="logo">
                <h1>
                    <img src="../assets/images/logo/logo2.png" alt="This is the blog's logo">
                </h1>
            </div>

            <div class="hamburger">
                <div class="top"></div>
                <div class="middle"></div>
                <div class="bottom"></div>
            </div>
            <nav class="navbar display-flex align-center space-evenly">
                <div class="nav-menu display-flex justify-center">
                    <ul class="nav-list display-flex flex-no-wrap justify-center">
                        <li><a class="display-block" href="/">Home</a></li>
                        <li class="dropdown relative">
                            <a class="sub-list-trigger display-flex align-center space-between" href="">
                                Categorias
                                <i class="sub-menu-arrow header-arrow las la-angle-right"></i>
                            </a>
                            <ul class="sub-list absolute">
<?php
    foreach($categories as $category) {
        echo '
                                <li><a class="dropdown-links display-block" href="' . HOME_PATH . 'browse/category/' . $category["category_id"] . '">' . $category["category_name"] . '</a></li>
        ';
    }
?>
                            </ul>
                        </li>
                        <li><a class="display-block" href="">Contacto</a></li>
                    </ul>
                </div>
                <!--end navbar-->
                <div class="login-container">
                    <a class="action-button header-login-button" href="">Login</a>
                </div>
            </nav>
        </div>
        <!--end header-flex-container-->
    </div>
    <!--end container-->
</header>