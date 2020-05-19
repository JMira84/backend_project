<div class="page-container">
    <ul class="pages display-flex align-center space-between">
<?php
    if ($url_parts[1] === "browse") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'browse/category/' . $articles[0]['category_id'] . '/?page=' . $prev . '>
                            <span>&larr;</span>
                            Anterior
                        </a>
                    </li>
                ';
        }

        if ($page < $count - 4) {
            echo '
                    <li>
                        <a class="next-page inline-block" href=' . HOME_PATH . 'browse/category/' . $articles[0]['category_id'] . '/?page=' . $next . '>
                            Próxima
                            <span>&rarr;</span>
                        </a>
                    </li>
                ';
        }
    } else if ($url_parts[1] === "admin") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'admin/delete_article/?page=' . $prev .'>
                            <span>&larr;</span>
                            Anterior
                        </a>
                    </li>
                ';
        }
    
        if($page < $count - 4) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . 'admin/delete_article/?page=' . $next . '>
                        Próxima
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    } else {
        if($page >= 2) {
            echo '
                <li>
                    <a class="prev-page inline-block" href=' . HOME_PATH . '?page=' . $prev .'>
                        <span>&larr;</span>
                        Anterior
                    </a>
                </li>
            ';
        }
    
        if($page < $count - 4) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . '?page=' . $next . '>
                        Próxima
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    }
?>
    </ul>
</div>