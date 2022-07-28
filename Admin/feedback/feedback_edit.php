<?php
include_once("../_header_feedback.php");
?>
<?php
include_once('../../Database/config.php');
if (isset($_GET['feedback_id'])) {
    $id = $_GET['feedback_id'];
}

$sql = "SELECT * FROM feedback WHERE feedback_id = $id";
$result = $con->query($sql);
$row = mysqli_fetch_array($result);

if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];
    $notes = $_POST['notes'];
    if (!empty($fullname)) {
        $sql_update = sprintf("UPDATE feedback SET fullname = '%s',mail = '%s',
        phone = '%s',adress = '%s',  notes = '%s',update_at = '%s' 
        WHERE feedback_id = '%s'", $fullname, $mail, $phone, $adress, $notes, date('Y-m-d H:i:s'), $id);
        $con->query($sql_update);
        header("Location: feedback_list.php");
    }
}
?>
<div class="container mt-5" style="width: 700px; margin: auto;">
    <form action="" method="post" enctype="multipart/form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input class="form-control" type="text" placeholder="Input" name="fullname" required value="<?= $row['fullname'] ?>">
                    </input>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="text" placeholder="Input" name="mail" required value="<?= $row['mail'] ?>">
                    </input>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input class="form-control" type="text" placeholder="Input" name="phone" required value="<?= $row['phone'] ?>">
                    </input>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input class="form-control" type="text" placeholder="Input" name="adress" required value="<?= $row['adress'] ?>">
                    </input>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea class="form-control" rows="10" required name="notes" placeholder="Input"><?= $row['notes'] ?></textarea>
                </div>
            </div>
        </div>
        <input class="btn btn-primary btn-block" type="submit" value="UPDATE" name="update"></input>
    </form>
</div>
</div>
</div>
</div>
</body>

</html>