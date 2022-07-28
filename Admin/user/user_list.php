<?php
include_once("../_header_admin.php");
?>
<div class="container mt-5">
    <h1 class="text-center">USER LIST</h1>
    <table class="table table-hover" style="width: 1100px; margin: auto;" border="3px">
        <tr>
            <th>No</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Create At</th>
            <th>Update At</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        include_once('../../Database/config.php');
        $sql = "SELECT * FROM users order by user_id DESC";
        $result = $con->query($sql);
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $i++;
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['mail'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['create_at'] ?></td>
                <td><?= $row['update_at'] ?></td>
                <td> <a class="btn btn-primary" href="user_edit.php?id=<?= $row['user_id'] ?>">Sửa</a> </td>
                <td><a class="btn btn-primary" href="user_delete.php?id=<?= $row['user_id'] ?>">Xóa</a></td>
            </tr>

        <?php
        }
        ?>
    </table>
</div>
</div>
</div>
<?php
include_once('../_footer.php');
?>