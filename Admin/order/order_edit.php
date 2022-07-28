<?php
include('../../Database/config.php');

if (isset($_GET['order_id'])) {
    $id = $_GET['order_id'];
}

$sql = "SELECT * FROM orders WHERE order_id = $id";
$result = $con->query($sql);
$row = mysqli_fetch_array($result);

if (isset($_POST['update'])) {
    $fullname = htmlspecialchars($_POST['fullname']);
    $mail = htmlspecialchars($_POST['mail']);
    $phone = htmlspecialchars($_POST['phone']);
    $adress = htmlspecialchars($_POST['adress']);
    $sta_tus = htmlspecialchars($_POST['sta_tus']);

    if ($sta_tus == 0) {
        $sta_tus = 0;
    } else if ($sta_tus == 1) {
        $sta_tus = 1;
    }


    $sql_update = sprintf("UPDATE orders SET fullname = '%s',mail = '%s',phone='%s',adress = '%s',sta_tus= %d,update_at='%s'
        WHERE order_id = %d ", $fullname, $mail, $phone, $adress, $sta_tus, date('Y-m-d H:i:s'), $id);
    $con->query($sql_update);
    header('Location: order_list.php');
    return;
}


?>
<?php
include_once("../_header_product.php");
?>
<h1 class="text-center">ORDER EDIT</h1>
<div class="container product_add" style="margin-top: auto; width: 100%;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Fullname: </label>
            <input type="text" name="fullname" placeholder="Fullname" class="form-control" required value="<?= $row['fullname'] ?>">
        </div>

        <div class="form-group">
            <label>Email: </label>
            <input type="text" name="mail" class="form-control" placeholder="Email" required value="<?= $row['mail'] ?>">
        </div>

        <div class="form-group">
            <label>Phone Number: </label>
            <input type="text" name="phone" placeholder="Phone" class="form-control" required value="<?= $row['phone'] ?>">
        </div>

        <div class="form-group">
            <label>Address: </label>
            <input type="text" name="adress" placeholder="Address" class="form-control" required value="<?= $row['adress'] ?>">
        </div>
        <div class="form-group">
            <label>STATUS: </label><br>
            <label><input type="radio" name="sta_tus" value="0" <?php if ($row['sta_tus'] == 0) {
                                                                    echo "checked";
                                                                } ?> /> Đang xử lý</label> <br />
            <label><input type="radio" name="sta_tus" value="1" <?php if ($row['sta_tus'] == 1) {
                                                                    echo "checked";
                                                                } ?> /> Đã hoàn thành</label> <br />

        </div>
        <div class="form-group">
            <input class="btn btn-primary btn-block" type="submit" name="update" value="EDIT"></input>
        </div>

    </form>
</div>

<?php
include_once("../_footer.php");
?>