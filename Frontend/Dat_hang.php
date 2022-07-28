<?php
include_once("_header.php");
session_start();

// include_once("../Database/config.php");
?>
<?php
$fullname = $mail = $phone = $adress = '';
if (isset($_POST['dong_y_dat_hang'])) {
    $fullname = $_POST['fullname'];
    $adress = $_POST['adress'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];

    $sql_users = "SELECT user_id FROM users WHERE mail = '$mail' || phone = '$phone'";
    $query_user_id = mysqli_query($con, $sql_users);
    $row_user_id = mysqli_fetch_assoc($query_user_id);

    $user_id =  $row_user_id['user_id'];

    $sql_insert_orders = sprintf(
        "INSERT INTO orders (user_id,fullname,mail,phone,adress,create_at)
        VALUES (%d,'%s', '%s', '%s', '%s', '%s')",
        $user_id,
        $fullname,
        $mail,
        $phone,
        $adress,
        date('Y-m-d H:i:s')
    );
    $query_orders = mysqli_query($con, $sql_insert_orders);

    $order_id = $con->insert_id;

    $total = 0;
    $num = 0;
    if (is_array($_SESSION['mycart'])) {
        foreach ($_SESSION['mycart'] as $cart) {
            $product_id = $cart[0];
            $total = $cart[3];
            $num = 1;
            $sql_insert_order_details = sprintf(
                "INSERT INTO order_details (order_id,product_id,total,num,create_at)
                VALUES (%d,%d, %d, %d,'%s')",
                $order_id,
                $product_id,
                $total,
                $num,
                date('Y-m-d H:i:s')
            );
            $query_order_details = mysqli_query($con, $sql_insert_order_details);

            if (is_array($_SESSION['mycart'])) {
                foreach ($_SESSION['mycart'] as $key => $cart) {
                    if ($cart[0] == $product_id) {
                        unset($_SESSION['mycart'][$key]);
                        $_SESSION['success'] = 'Chúc mừng Bạn đã đặt hàng thành công!';
                        echo $_SESSION['success'];
                    }
                }
            }
        }
    }

    header('Location: Cart.php');
    return;
}
?>
<main class="main margintop">
    <div class="container">
        <div class="thumbnail">
            <div class="m-5">
                <h2 class="text-secondary text-center">Thông Tin Giỏ Hàng</h2>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $i = 1;
                        $sum = 0;
                        foreach ($_SESSION['mycart'] as $cart) {
                            $image = 'images/' . $cart[2];
                            $sum += $cart[3];
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="<?php echo $image; ?>" width="100px" height="100px" alt=""></td>
                                <td><?php echo $cart[1]; ?></td>
                                <td><?php echo $cart[3]; ?></td>
                                <td><?php echo $cart[3]; ?></td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                        <tr>
                            <td colspan="4" class="text-center" style="font-weight: bold; font-size: 18px">Tổng đơn hàng</td>
                            <td><?php echo $sum; ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                if (isset($_SESSION['mail']) && isset($_SESSION['phone'])) {
                ?>
                    <h2 class="text-secondary mt-5 text-center">Thông Tin Đặt Hàng</h2>
                    <form action="" method="post" enctype="multipart/form">
                        <div class="form-group">
                            <label>Người đặt hàng: </label>
                            <input type="text" name="fullname" required placeholder="Họ và tên" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ: </label>
                            <input type="text" name="adress" required placeholder="Địa chỉ" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email: </label>
                            <input type="email" name="mail" required placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Phone Number: </label>
                            <input type="text" name="phone" required placeholder="Số điện thoại" class="form-control">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success" value="ĐỒNG Ý ĐẶT HÀNG" name="dong_y_dat_hang" type="submit"></input>
                        </div>
                    </form>
                <?php
                } else {
                ?>
                    <div class="container">
                        <h3>VUI LÒNG ĐĂNG NHẬP </h3>
                        <a href="Dang_nhap.php"><span class="glyphicon glyphicon-log-in">&ensp;ĐĂNG NHẬP</a>

                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</main>