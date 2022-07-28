<ul class="pagination justify-content-end">
    <?php
    if ($current_page > 3) {
        $first_page = 1;
    ?>

        <li class="page-item"><a class="page-link" href="?cartegory_id=<?= $id ?>&page=<?= $first_page ?>"><i class="fa-solid fa-angles-left"></i></a></li>
    <?php
    }
    if ($current_page > 1) {
        $pre_page = $current_page - 1;
    ?>
        <li class="page-item"><a class="page-link" href="?cartegory_id=<?= $id ?>&page=<?= $pre_page ?>"><i class="fa-solid fa-angle-left"></i></a></li>
    <?php
    }
    ?>
    <?php
    for ($num = 1; $num <= $total_pages; $num++) {
        if ($num != $current_page) {
            if ($num > $current_page - 3 && $num < $current_page + 3) {
    ?>
                <li class="page-item"><a class="page-link" href="?cartegory_id=<?= $id ?>&page=<?= $num ?>"><?= $num ?></a></li>
            <?php
            }
        } else {
            ?>
            <li class="page-item active "><a class="page-link "><?= $num ?></a></li>
        <?php
        }
    }
    if ($current_page < $total_pages - 1) {
        $next_page = $current_page + 1;
        ?>
        <li class="page-item"><a class="page-link" href="?cartegory_id=<?= $id ?>&page=<?= $next_page ?>"><i class="fa-solid fa-angle-right"></i></a></li>

    <?php
    }
    ?>
    <?php
    if ($current_page < $total_pages - 3) {
        $end_page = $total_pages;
    ?>
        <li class="page-item"><a class="page-link" href="?cartegory_id=<?= $id ?>&page=<?= $end_page ?>"><i class="fa-solid fa-angles-right"></i></a></li>

    <?php
    }
    ?>
</ul>