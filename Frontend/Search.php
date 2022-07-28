<?php
include_once("_header.php");
?>
<?php
if (isset($_GET['button_search'])) {
    $key_search = $_GET['key_search'];
} else {
    $key_search = 'aloalo';
}

$sql = "SELECT * FROM product  WHERE 1";

if ($key_search != '') {
    $sql .= " and title like '%" . $key_search . "%'";
}

$sql .= " order by product_id DESC";
$result = $con->query($sql);


?>

<?php
?>
<!-- Product -->
<div class="container margintop">
    <div class="row  product">
        <?php
        if ($result->num_rows > 0) {
            echo "<h2><strong style: 'color: red'>$result->num_rows</strong> Khóa học được tìm thấy!</h2>";
        } else {
            echo "<h2>Không có khóa học được tìm thấy!<br></h2><h3>Vui lòng nhập khóa học khác!</h3>";
        }
        while ($row = mysqli_fetch_assoc($result)) {

        ?>
            <div class="col-md-3 pro-item">
                <div class="thumbnail thumbnail_product">
                    <a href="Product.php?product_id=<?= $row['product_id'] ?>"><img src="images/<?= $row['thumbnail'] ?>" alt="" style="width: 100%; height: 150px"></a>
                    <div class="caption">
                        <a href="Product.php?product_id=<?= $row['product_id'] ?>">
                            <h4 class="title"><?= $row['title'] ?></h4>
                        </a>
                        <p>
                        <div>
                            <a href="Product.php?product_id=<?= $row['product_id'] ?>" class="btn btn-primary">XEM</a>
                            <strong class=" float-end btn btn-success"><?= $row['price'] . '<sup>đ</sup>' ?></strong>
                        </div>
                        </p>
                    </div>
                    <p><?= $row['author_name'] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include_once('_footer.php');
?>