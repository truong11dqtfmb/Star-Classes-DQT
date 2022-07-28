<?php
include('../../Database/config.php');

$user_id = $fullname = $mail = $phone = $adress = $create_at = $sta_tus = '';
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];

    $sql_users = "SELECT user_id FROM users WHERE mail = '$mail' || phone = '$phone'";
    $query_user_id = mysqli_query($con, $sql_users);
    $row_user_id = mysqli_fetch_assoc($query_user_id);
    $user_id =  $row_user_id['user_id'];

    $sql_insert = sprintf(
        "INSERT INTO orders (user_id,fullname,mail,phone,adress,create_at)
        VALUES (%d,'%s', '%s', '%s', '%s', '%s')",
        $user_id,
        $fullname,
        $mail,
        $phone,
        $adress,
        date('Y-m-d H:i:s')
    );
    $query = mysqli_query($con, $sql_insert);
    header('Location: order_list.php');
    return;
}
?>
<?php
include_once("../_header_product.php");
?>
<h1 class="text-center">ORDER ADD</h1>
<div class="container product_add" style="margin-top: auto; width: 100%;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Fullname: </label>
            <input type="text" name="fullname" placeholder="Fullname" class="form-control" required value="<?php echo $fullname; ?>">
        </div>

        <div class="form-group">
            <label>Email: </label>
            <input type="text" name="mail" class="form-control" placeholder="Email" required value="<?php echo $mail; ?>">
        </div>

        <div class="form-group">
            <label>Phone Number: </label>
            <input type="text" name="phone" placeholder="Phone" class="form-control" required value="<?php echo $phone; ?>">
        </div>

        <div class="form-group">
            <label>Address: </label>
            <input type="text" name="adress" placeholder="Address" class="form-control" required value="<?php echo $adress; ?>">
        </div>

        <div class="form-group">
            <input class="btn btn-primary btn-block" type="submit" name="submit" value="ADD"></input>
        </div>

    </form>
</div>

<?php
include_once("../_footer.php");
?>