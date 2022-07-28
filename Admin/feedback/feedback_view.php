<?php
include_once("../_header_feedback.php");
?>
<div class="container mt-5">
    <h1 class="text-center">FEEBACK DETAIL</h1>
    <table class="table table-hover " style="width: 100%; margin: auto;" border="3px">
        <tr>
            <th>Fullname</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Notes</th>
            <th>Create At</th>
            <th>Update At</th>
        </tr>
        <?php
        include_once('../../Database/config.php');
        if (isset($_GET['feedback_id'])) {
            $id = $_GET['feedback_id'];
        }
        $sql = "SELECT * FROM feedback WHERE feedback_id = $id order by feedback_id DESC";
        $result = $con->query($sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['mail'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['adress'] ?></td>
                <td><?= $row['notes'] ?></td>
                <td><?= $row['create_at'] ?></td>
                <td><?= $row['update_at'] ?></td>
            </tr>

        <?php
        }
        ?>
    </table>

    <a class="btn btn-primary mt-5" href="feedback_list.php">FEEBACK LIST</a>




    <?php
    include_once("../_footer.php");
    ?>