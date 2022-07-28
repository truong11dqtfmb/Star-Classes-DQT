<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="../ckeditor/ckeditor.js"></script>

    <?php
    include('../../Database/config.php');
    session_start();
    if (isset($_GET['order_id'])) {
        $id = $_GET['order_id'];


        $sql = "SELECT  orders.order_id as or_id,orders.user_id as or_user_id,
        orders.fullname as or_name, orders.mail as or_mail, orders.adress as or_adress,
        orders.phone as or_phone,

        order_details.order_id as or_de_order_id, order_details.product_id as or_de_pro_id,
        order_details.total, order_details.num, order_details.create_at as or_de_create_at, order_details.update_at as or_de_update_at,

        product.product_id as pro_id, product.title, product.price, product.thumbnail


        FROM orders 
        join order_details on orders.order_id = order_details.order_id 
        join product on order_details.product_id = product.product_id

        WHERE order_details.order_id =(SELECT order_id FROM orders WHERE order_id = $id)  ORDER BY order_details_id DESC";

        $result = $con->query($sql);


        // $sql = "SELECT*FROM orders WHERE order_id = $id";

        // $sql_pro = "SELECT*FROM order_details WHERE product_id = (SELECT product_id FROM order_details WHERE order_id = $id)";

        $sql_order_details = "SELECT  orders.order_id as or_id,orders.user_id as or_user_id,
        orders.fullname as or_name, orders.mail as or_mail, orders.adress as or_adress,
        orders.phone as or_phone,

        order_details.order_id as or_de_order_id, order_details.product_id as or_de_pro_id,
        order_details.total, order_details.num, order_details.create_at as or_de_create_at, order_details.update_at as or_de_update_at,

        product.product_id as pro_id, product.title, product.price, product.thumbnail


        FROM orders 
        join order_details on orders.order_id = order_details.order_id 
        join product on order_details.product_id = product.product_id

        WHERE order_details.order_id =(SELECT order_id FROM orders WHERE order_id = $id)  ORDER BY order_details_id DESC";

        $result_order_details = $con->query($sql_order_details);
    }
    ?>

    <div class="container">
        <a class="btn btn-primary mt-5 " href="order_list.php">ORDER LIST</a>
        <h1 class="text-center"><strong>ORDER DETAIL</strong></h1>
        <?php
        $row_users = mysqli_fetch_assoc($result);

        ?>
        <div class="container">

            <div class="thumbnail">
                <h2 class="text-center">Thông tin khách hàng</h3>
                    <p>Mã đơn hàng: MA_<?= $row_users['or_id'] ?></p>
                    <p>Tên: <?= $row_users['or_name'] ?></p>
                    <p>Số điện thoại: <?= $row_users['or_phone'] ?></p>
                    <p>Địa chỉ: <?= $row_users['or_adress'] ?></p>
                    <p>Email: <?= $row_users['or_mail'] ?></p>
            </div>

            <div class="thumbnail">
                <h2 class="text-center">Thông tin đơn hàng</h2>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Money</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $sum = 0;
                        while ($row = mysqli_fetch_array($result_order_details)) {
                            $sum += $row['price'];
                            $image = '../../Frontend/images/' . $row['thumbnail'];
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="<?php echo $image; ?>" width="100px" height="100px" alt=""></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['price'] ?></td>
                                <td><?php echo $sum; ?></td>

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

            </div>
        </div>


        <?php
        include_once("../_footer.php");
        ?>