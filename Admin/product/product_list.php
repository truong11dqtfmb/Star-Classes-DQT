<?php
include_once("../_header_product.php");
?>
<?php
if (isset($_POST['search'])) {
    $product_key_search = $_POST['product_key_search'];
    $carid = $_POST['carid'];
} else {
    $product_key_search = '';
    $carid = 0;
}

?>
<?php
include('../../Database/config.php');

$sql = "SELECT product.product_id,product.cartegory_id ,product.title,product.thumbnail,product.decription,
product.price, product.update_at as product_ud_at,introduce,content,author_name,author_thumbnail,author_introduce,
                product.create_at as product_cr_at, cartegory.name as car_name FROM product join cartegory
                on product.cartegory_id = cartegory.cartegory_id WHERE 1";


if ($product_key_search != '') {
    $sql .= " and product.title like '%" . $product_key_search . "%'";
}

if ($carid != 0) {
    $sql .= " and product.cartegory_id = '" . $carid . "' ";
}
// var_dump($sql);

$sql .= " order by product_id DESC";
$result = $con->query($sql);
?>


<div class="container-fluid">
    <h1 class="text-center"><strong>PRODUCT LIST</strong></h1>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="product_key_search" class="form-control" placeholder="Tìm khóa học">
        </div>
        <div class="form-group">
            <select name="carid" class="form-control">
                <option value="0">--ALL--</option>
                <?php
                $sql_cartegory = "SELECT * FROM cartegory";
                $result_cartegory = mysqli_query($con, $sql_cartegory);
                while ($row_cartegory = mysqli_fetch_assoc($result_cartegory)) { ?>
                    <option value="<?php echo $row_cartegory['cartegory_id']; ?>"><?php echo $row_cartegory['name']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="search" value="Search" class="btn btn-primary">
        </div>
    </form>


    <table class="table table-hover mt-5 mb-5" style="width: 100%; margin: auto;" border="3px">
        <thead>
            <tr>
                <th>No</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Mô tả ngắn</th>
                <th>Danh mục sản phẩm</th>
                <th>Tên tác giả</th>
                <th>Ảnh tác giả</th>
                <th>Create At</th>
                <th>Update At</th>
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
                    <td><?= $row['title'] ?></td>
                    <td>
                        <img src="../../Frontend/images/<?= $row['thumbnail'] ?>" alt="" style="width: 80px; height: 50px">
                    </td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['decription'] ?></td>
                    <td><?= $row['car_name'] ?></td>
                    <td><?= $row['author_name'] ?></td>
                    <td>
                        <img src="../../Frontend/images/<?= $row['author_thumbnail'] ?>" alt="" style="width: 80px; height: 50px">
                    </td>
                    <td><?= $row['product_cr_at'] ?></td>
                    <td><?= $row['product_ud_at'] ?></td>
                    <td><a class="btn btn-primary" href="product_view.php?product_id=<?= $row['product_id'] ?>">Xem</a> </td>
                    <td><a class="btn btn-primary" href="product_edit.php?product_id=<?= $row['product_id'] ?>">Sửa</a> </td>
                    <td><a class="btn btn-primary" href="product_delete.php?product_id=<?= $row['product_id'] ?>">Xóa</a></td>

                </tr>
            <?php
            }

            ?>

        </tbody>
    </table>

    <?php
    include_once("../_footer.php");
    ?>