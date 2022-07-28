<?php
include_once("../_header_cartegory.php");
?>
<div class="container mt-5">
    <h1 class="text-center">CATEGORY LIST</h1>

    <table class="table table-hover " style="width: 900px; margin: auto;" border="3px">
        <tr>
            <th>No</th>
            <th>Cartegory Name</th>
            <th>Create At</th>
            <th>Update At</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        include_once('../../Database/config.php');
        $sql = "SELECT * FROM cartegory order by cartegory_id DESC";
        $result = $con->query($sql);
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $i++;
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['create_at'] ?></td>
                <td><?= $row['update_at'] ?></td>
                <td> <a class="btn btn-primary" href="cartegory_edit.php?cartegory_id=<?= $row['cartegory_id'] ?>">Sửa</a> </td>
                <td><a class="btn btn-primary" href="cartegory_delete.php?cartegory_id=<?= $row['cartegory_id'] ?>">Xóa</a></td>
            </tr>

        <?php
        }
        ?>
    </table>
</div>
</div>
</div>

<?php
include_once("../_footer.php");
?>