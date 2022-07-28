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
    if (isset($_GET['product_id'])) {
        $id = $_GET['product_id'];
    }

    $sql = "SELECT product.product_id,product.cartegory_id ,product.title,product.thumbnail,product.decription,
product.price, product.update_at as product_ud_at,introduce,content,author_name,author_thumbnail,author_introduce,
                product.create_at as product_cr_at, cartegory.name as car_name FROM product join cartegory
                on product.cartegory_id = cartegory.cartegory_id WHERE product_id = $id ORDER BY product_id DESC";
    $result = $con->query($sql);
    ?>

    <div class="container-fluid">
        <a class="btn btn-primary mt-5 " href="product_list.php">PODUCT LIST</a>
        <h1 class="text-center"><strong>PRODUCT DETAIL</strong></h1>
        <table class="table table-hover mt-5 mb-5" style="width: 100%; margin: auto;" border="3px">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Mô tả ngắn</th>
                    <th>Danh mục sản phẩm</th>
                    <th>Giới thiệu sản phẩm</th>
                    <th>Nội dung sản phẩm</th>
                    <th>Tên tác giả</th>
                    <th>Ảnh tác giả</th>
                    <th>Giới thiệu tác giả</th>
                    <th>Create At</th>
                    <th>Update At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?= $row['title'] ?></td>
                        <td>
                            <img src="../../Frontend/images/<?= $row['thumbnail'] ?>" alt="" style="width: 80px; height: 50px">
                        </td>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['decription'] ?></td>
                        <td><?= $row['car_name'] ?></td>
                        <td><?= $row['introduce'] ?></td>
                        <td><?= $row['content'] ?></td>
                        <td><?= $row['author_name'] ?></td>
                        <td>
                            <img src="../../Frontend/images/<?= $row['author_thumbnail'] ?>" alt="" style="width: 80px; height: 50px">
                        </td>
                        <td><?= $row['author_introduce'] ?></td>
                        <td><?= $row['product_cr_at'] ?></td>
                        <td><?= $row['product_ud_at'] ?></td>
                    </tr>
                <?php
                }

                ?>

            </tbody>
        </table>


        <?php
        include_once("../_footer.php");
        ?>