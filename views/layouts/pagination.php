<div class="page-container">
    <ul class="pages display-flex align-center space-between">
<?php
    if($page >= 2) {
        echo '
            <li>
                <a class="prev-page inline-block" href=' . HOME_PATH . '?page=' . $prev .'>
                    <span>&larr;</span>
                    Previous
                </a>
            </li>
        ';
    }

    if($page < $count - 4) {
        echo '
            <li>
                <a class="next-page inline-block" href=' . HOME_PATH . '?page=' . $next . '>
                    Next
                    <span>&rarr;</span>
                </a>
            </li>
        ';
    }
?>
    </ul>
</div>