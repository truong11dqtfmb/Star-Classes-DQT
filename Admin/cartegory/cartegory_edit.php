<?php
include_once('../../Database/config.php');
if (isset($_GET['cartegory_id'])) {
    $id = $_GET['cartegory_id'];
}

$sql = "SELECT * FROM cartegory WHERE cartegory_id = $id";
$result = $con->query($sql);
$row = mysqli_fetch_array($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];

    if (empty($name)) {
        echo "Vui lòng nhập đầy đủ thông tin!";
    }
    if (!empty($name)) {
        $sql_update = sprintf("UPDATE cartegory SET name = '%s',update_at = '%s' 
        WHERE cartegory_id = '%s'", $name, date('Y-m-d H:i:s'), $id);
        $con->query($sql_update);
        header("Location: cartegory_list.php");
    }
}
?>
<?php
include_once("../_header_cartegory.php");
?>
<div class="container mt-5" style="width: 700px; margin: auto;">
    <form action="" method="post" enctype="multipart/form">
        <div class="form-group">
            <label>Cartegory Name: </label>
            <input type="text" name="name" placeholder="Name" class="form-control" required value="<?= $row['name'] ?>">
        </div>
        <input class="btn btn-primary btn-block" type="submit" name="update" value="UPDATE"></input>
    </form>
</div>
</div>
</div>
<?php
include_once("../_footer.php");
?>