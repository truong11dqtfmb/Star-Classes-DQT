<?php
include_once("../_header_product.php");
?>
<?php
if (isset($_POST['search'])) {
    $order_key_search = $_POST['order_key_search'];
} else {
    $order_key_search = '';
}

?>
<?php
include('../../Database/config.php');

// $_sql = "SELECT  orders.update_at as orders_ud_at, orders.create_at as orders_cr_at, FROM orders join users on orders.user_id = users.user_id";

// SELECT orders.update_at as orders_ud_at, orders.create_at as orders_cr_at, FROM orders join users on orders.user_id = users.user_id

// $sql = "SELECT product.product_id,product.cartegory_id ,product.title,product.thumbnail,product.decription,
// product.price, product.update_at as product_ud_at,introduce,content,author_name,author_thumbnail,author_introduce,
//                 product.create_at as product_cr_at, cartegory.name as car_name FROM product join cartegory
//                 on product.cartegory_id = cartegory.cartegory_id WHERE 1";



// if ($order_key_search != '') {
//     $sql .= " and product.title like '%" . $order_key_search . "%'";
// }
$sql = "SELECT * FROM orders WHERE 1 ";

if ($order_key_search != '') {
    $sql .= " and orders.order_id like '%" . $order_key_search . "%'";
}

$sql .= " order by create_at DESC";

$result = $con->query($sql);
?>


<div class="container-fluid">
    <h1 class="text-center"><strong>ORDER LIST</strong></h1>
    <form action="" method="post" width="100%">
        <div class="form-inline">
            <input type="text" name="order_key_search" class="form-control" placeholder="Nhập Mã đơn hàng">
            <input type="submit" name="search" value="Search" class="btn btn-primary">
        </div>
    </form>


    <table class="table table-hover mt-5 mb-5" style="width: 100%; margin: auto;" border="3px">
        <thead>
            <tr>
                <th>No</th>
                <th>Mã đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Địa chỉ giao hàng</th>
                <th>Số điện thoại</th>
                <th>Tình trạng đơn hàng</th>
                <th>Ngày đặt hàng</th>
                <th>XEM</th>
                <th>SỬA</th>
                <th>XÓA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $i++;
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>MA_<?= $row['order_id'] ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= $row['mail'] ?></td>
                    <td><?= $row['adress'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?php
                        if ($row['sta_tus'] == 0) {
                            echo "Đang xử lý";
                        } elseif ($row['sta_tus'] == 1) {
                            echo "Đã hoàn thành";
                        }
                        ?></td>
                    <td><?= $row['create_at'] ?></td>
                    <td><a class="btn btn-primary" href="order_view.php?order_id=<?= $row['order_id'] ?>">Xem</a> </td>
                    <td><a class="btn btn-primary" href="order_edit.php?order_id=<?= $row['order_id'] ?>">Sửa</a> </td>
                    <td><a class="btn btn-primary" href="order_delete.php?order_id=<?= $row['order_id'] ?>">Xóa</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <?php
    include_once("../_footer.php");
    ?>