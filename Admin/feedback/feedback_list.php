<?php
include_once("../_header_feedback.php");
?>
<div class="container mt-5">
    <h1 class="text-center">FEEBACK LIST</h1>
    <table class="table table-hover " style="width: 900px; margin: auto;" border="3px">
        <tr>
            <th>No</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Notes</th>
            <th>Create At</th>
            <th>Update At</th>
            <th>View</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        include_once('../../Database/config.php');
        $sql = "SELECT * FROM feedback order by feedback_id DESC";
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
                <td><?= $row['adress'] ?></td>
                <td><?= $row['notes'] ?></td>
                <td><?= $row['create_at'] ?></td>
                <td><?= $row['update_at'] ?></td>
                <td> <a class="btn btn-primary" href="feedback_view.php?feedback_id=<?= $row['feedback_id'] ?>">Xem</a> </td>
                <td> <a class="btn btn-primary" href="feedback_edit.php?feedback_id=<?= $row['feedback_id'] ?>">Sửa</a> </td>
                <td><a class="btn btn-primary" href="feedback_delete.php?feedback_id=<?= $row['feedback_id'] ?>">Xóa</a></td>
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