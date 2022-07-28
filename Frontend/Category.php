<?php
include_once("_header.php");
?>

<!-- Main -->
<main class="main margintop">
    <div class="container">
        <div class="row">
            <div class="col-md-3 banner-left">
                <h3> <a href="index.php">STAR CLASSES</a></h3>
                <ul class="cartegory menu menu-gia">
                    <?php
                    include_once("../Database/config.php");

                    $sql = "SELECT * FROM cartegory ";
                    $result = $con->query($sql);
                    while ($row_cartegory = mysqli_fetch_array($result)) {
                        $link_cartegory = "Category.php?cartegory_id=" . $row_cartegory['cartegory_id'];
                    ?>
                        <li class="menu-gia"><a href="<?= $link_cartegory ?>"><?= $row_cartegory['name'] ?><i class="fas fa-chevron-right float-end icon"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <div class="col-md-9 banner-right">
                <div class="product_detail">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Trang chủ</a></li>
                        <li class="active"><a href="">Danh mục</a></li>
                    </ol>
                    <div class="product-detail product">
                        <div class="row">
                            <?php
                            if (isset($_GET['cartegory_id'])) {
                                $id = $_GET['cartegory_id'];
                            }
                            ?>
                            <div class="row ">
                                <?php
                                $sql_cartegory = "SELECT name from cartegory where cartegory_id = $id";
                                $result_cartegory = $con->query($sql_cartegory);
                                $row_cartegory = mysqli_fetch_array($result_cartegory);
                                $row_cartegory_name = $row_cartegory['name'];
                                ?>

                                <h3 class="">Khóa học <?php echo $row_cartegory_name; ?></h3>
                                <?php

                                // $item_per_page = 2;
                                // $current_page = 1;
                                $item_per_page = 16;
                                $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                                $offset = ($current_page  - 1) * $item_per_page;
                                $sql_total = "SELECT*FROM product WHERE cartegory_id = $id";
                                $result_total_pages = $con->query($sql_total);
                                $total_records = $result_total_pages->num_rows;
                                $total_pages = ceil($total_records / $item_per_page);

                                $sql = "SELECT * FROM product WHERE cartegory_id = $id  order by product_id DESC LIMIT " . $item_per_page . " OFFSET  " . $offset . "";
                                $result = $con->query($sql);

                                while ($row = mysqli_fetch_array($result)) {

                                ?>
                                    <div class="col-md-4 pro-item">
                                        <div class="thumbnail thumbnail_product">
                                            <a href="Product.php?product_id=<?= $row['product_id'] ?>"><img src="images/<?= $row['thumbnail'] ?>" alt="" style="width: 100%; height: 150px"></a>
                                            <div class="caption">
                                                <a href="Product.php?product_id=<?= $row['product_id'] ?>">
                                                    <h4 class="title"><?= $row['title'] ?></h4>
                                                </a>
                                                <p>
                                                <div>
                                                    <a href="Product.php?product_id=<?= $row['product_id'] ?>" class="btn btn-primary">XEM</a>
                                                    <a href="product.php"><strong class=" float-end btn btn-success"><?= $row['price'] . '<sup>đ</sup>' ?></strong></a>
                                                </div>
                                                </p>
                                            </div>
                                            <p><?= $row['author_name'] ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php
                                include_once('Page_Cartegory.php');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once('_footer.php');
?>