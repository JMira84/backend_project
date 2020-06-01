<aside>
    <div class="sidebar">
        <div class="about-me display-flex flex-column align-center">
            <h2>Sobre mim</h2>
            <div class="about-me-img">
<?php
    if(empty($mainAdmin["profile_img"])) {
?>
                <img class="sub-list-trigger" src="/assets/images/generic_profile_img.png" alt="">
<?php
    } else {
?>
                <img src="/uploads/users/<?=$mainAdmin["profile_img"]?>" alt="">
<?php
    }
?>
            </div>
            <div class="about-text">
                <p><?php echo $mainAdmin["about"];?></p>
            </div>
        </div>

        <div class="latest-articles-container display-flex flex-column align-center">
            <h2>Artigos recentes</h2>
<?php
    foreach($latestArticles as $latestArticle) {
        echo '
            <div class="latest-articles-mq display-flex flex-column align-center">
                <div class="latest-articles display-flex align-center relative">
                    <div class="latest-articles-info display-flex flex-column">
                        <h3>
                            <a class="stretched-link" href="' . HOME_PATH . 'article/' . $latestArticle["article_id"] . '">' . $latestArticle["title"] . '</a>
                        </h3>
                        <time datetime="' . date("Y-m-d H:i:s", strtotime($latestArticle["created_at"])) . '">' . strftime("%e %B %Y", strtotime($latestArticle["created_at"])) . '</time>
                    </div>
                    <div class="latest-articles-img display-flex justify-center">
                        <img src="/uploads/articles/' . $latestArticle["article_img"] . '" alt="">
                    </div>
                </div>
                <!--end latest-articles-->
            </div>
        ';
    }
?>
        </div>
        <!--end latest-articles-container-->

        <div class="archive display-flex flex-column align-center">
            <h2>Arquivos</h2>
            <div class="date-list">
                <ul>
<?php
    foreach($datesList as $date) {
        echo '
                    <li>
                        <a href="' . HOME_PATH . 'browse/date/' . date('n', strtotime($date["created_at"])) . '/' . date('Y', strtotime($date["created_at"])) . '">' . ucfirst(strftime('%B %Y', strtotime($date["created_at"]))) . '</a>
                    </li>
        ';
    }
?>
                </ul>
            </div><!--end date-list-->
        </div><!--end archive-->
    </div>
    <!--end sidebar-->
</aside>