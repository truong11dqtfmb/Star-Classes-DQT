<?php
include_once('../../Database/config.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = "SELECT * FROM users WHERE user_id = $id";
$result = $con->query($sql);
$row = mysqli_fetch_array($result);

if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];

    if (empty($fullname) || empty($mail) ||  empty($phone)) {
        echo "Vui lòng nhập đầy đủ thông tin!";
    }
    if (!empty($fullname) && !empty($mail) &&  !empty($phone)) {
        echo "Đào Quốc Trượng!";
        $sql_update = sprintf("UPDATE users SET fullname = '%s', mail = '%s', phone = '%s',update_at = '%s' 
        WHERE user_id = '%d'", $fullname, $mail, $phone, date('Y-m-d H:i:s'), $id);
        $con->query($sql_update);
        header("Location: user_list.php");
    }
}
?>
<?php
include_once("../_header_admin.php");
?>
<div class="container mt-5" style="width: 700px; margin: auto;">
    <form action="" method="post" enctype="multipart/form">
        <div class="form-group">
            <label>Fullname: </label>
            <input type="text" name="fullname" placeholder="Fullname" class="form-control" required value="<?= $row['fullname'] ?>">
        </div>
        <div class="form-group">
            <label>Email: </label>
            <input type="email" name="mail" placeholder="Email" class="form-control" required value="<?= $row['mail'] ?>">
        </div>
        <div class="form-group">
            <label>Phone Number: </label>
            <input type="text" name="phone" placeholder="Phone Number" class="form-control" required value="<?= $row['phone'] ?>">
        </div>
        <input class="btn btn-primary btn-block" type="submit" name="update" value="UPDATE"></input>
    </form>
</div>
</div>
</div>
<?php
include_once('../_footer.php');
?>