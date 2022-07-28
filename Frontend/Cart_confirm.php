<!-- order table -->
<?php
include_once("_header.php");
session_start();
?>
<?php
$fullname = $mail = $phone = $adress = '';
if (isset($_POST['dong_y_dat_hang'])) {
    $fullname = $_POST['fullname'];
    $adress = $_POST['adress'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];

    header('Location: Cart_confirm.php');
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
                        <input class="btn btn-success" value="XÁC NHẬN ĐẶT HÀNG" name="xac_nhan_dat_hang" type="submit"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>