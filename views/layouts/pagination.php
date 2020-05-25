<div class="page-container">
    <ul class="pages display-flex align-center space-between">
<?php
    if (isset($url_parts[2]) && $url_parts[2] === "category") {
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
                            Seguinte
                            <span>&rarr;</span>
                        </a>
                    </li>
                ';
        }
    } else if (isset($url_parts[2]) && $url_parts[2] === "date") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'browse/date/' . $articles[0]['created_at'] . '/?page=' . $prev . '>
                            <span>&larr;</span>
                            Anterior
                        </a>
                    </li>
                ';
        }
    
        if($page < $count - 4) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . 'browse/date/' . $articles[0]['created_at'] . '/?page=' . $next . '>
                        Seguinte
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    }else if (isset($url_parts[2]) && $url_parts[2] === "author") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'browse/author/' . $articles[0]['user_id'] . '/?page=' . $prev . '>
                            <span>&larr;</span>
                            Anterior
                        </a>
                    </li>
                ';
        }
    
        if($page < $count - 4) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . 'browse/author/' . $articles[0]['user_id'] . '/?page=' . $next . '>
                        Seguinte
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    } else if (isset($url_parts[2]) && $url_parts[2] === "delete_article") {
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
                        Seguinte
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    } else if (isset($url_parts[2]) && $url_parts[2] === "edit_article") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'admin/edit_article/?page=' . $prev .'>
                            <span>&larr;</span>
                            Anterior
                        </a>
                    </li>
                ';
        }
    
        if($page < $count - 4) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . 'admin/edit_article/?page=' . $next . '>
                        Seguinte
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    } else if (isset($url_parts[2]) && $url_parts[2] === "delete_user") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'admin/delete_user/?page=' . $prev .'>
                            <span>&larr;</span>
                            Menos
                        </a>
                    </li>
                ';
        }
    
        if($page < $count - 10) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . 'admin/delete_user/?page=' . $next . '>
                        Mais
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    } else if (isset($url_parts[2]) && $url_parts[2] === "add_admin") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'admin/add_admin/?page=' . $prev .'>
                            <span>&larr;</span>
                            Menos
                        </a>
                    </li>
                ';
        }
    
        if($page < $count - 10) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . 'admin/add_admin/?page=' . $next . '>
                        Mais
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    } else if (isset($url_parts[2]) && $url_parts[2] === "remove_admin") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'admin/remove_admin/?page=' . $prev .'>
                            <span>&larr;</span>
                            Menos
                        </a>
                    </li>
                ';
        }
    
        if($page < $count - 10) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . 'admin/remove_admin/?page=' . $next . '>
                        Mais
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    } else if (isset($url_parts[1]) && $url_parts[1] === "article") {
        if ($page >= 2) {
            echo '
                    <li>
                        <a class="prev-page inline-block" href=' . HOME_PATH . 'article/' . $url_parts[2] . '/comments/?page=' . $prev .'>
                            <span>&larr;</span>
                            Menos
                        </a>
                    </li>
                ';
        }
    
        if($page < $count - 5) {
            echo '
                <li>
                    <a class="next-page inline-block" href=' . HOME_PATH . 'article/' . $url_parts[2] . '/comments/?page=' . $next . '>
                        Mais
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
                        Seguinte
                        <span>&rarr;</span>
                    </a>
                </li>
            ';
        }
    }
?>
    </ul>
</div>