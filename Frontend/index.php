<?php
include_once("_header.php");
?>


<!-- Banner -->
<div class="banner margintop">
  <div class="container">
    <div class="row">
      <div class="col-md-3 banner-left">
        <h3> <a href="index.php">STAR CLASSES</a></h3>
        <!--  -->
        <ul class="cartegory menu menu-gia">
          <?php
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
        <!-- Carousel -->
        <div id="demo" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/_banner2.png" alt="Los Angeles" class="d-block" style="width:100%; height: 400px">
            </div>
            <div class="carousel-item">
              <img src="images/_banner1.png" alt="Chicago" class="d-block" style="width:100%;  height: 400px">
            </div>
            <div class="carousel-item">
              <img src="images/_banner3.png" alt="New York" class="d-block" style="width:100%;  height: 400px">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Product -->
<div class="container">
  <div class="row  product">
    <h3>Khóa Học Mới Nhất</h3>
    <?php

    $item_per_page = 16;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page  - 1) * $item_per_page;
    $sql_total = "SELECT*FROM product";
    $result_total_pages = $con->query($sql_total);
    $total_records = $result_total_pages->num_rows;
    $total_pages = ceil($total_records / $item_per_page);

    $sql = "SELECT * FROM product order by product_id DESC LIMIT " . $item_per_page . " OFFSET  " . $offset . "";
    $result = $con->query($sql);

    while ($row = mysqli_fetch_array($result)) {

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
              <a href="product.php"><strong class=" float-end btn btn-success"><?= $row['price'] . '<sup>đ</sup>' ?></strong></a>
            </div>
            </p>
          </div>
          <p><?= $row['author_name'] ?></p>
        </div>
      </div>
    <?php } ?>

    <?php
    include_once('Page.php');
    ?>

  </div>
</div>

<!-- Dịch vụ -->
<div class="container text-center " id="mydichvu">
  <div class="container alo">
    <h1>LÝ DO BẠN CHỌN CHÚNG TÔI</h1>
    <div class="row mt-5 ">
      <div class="col-sm-4">
        <i class="fa-solid fa-users-rectangle" style="font-size: 200px;"></i>
        <h3>Phần mềm dạy học trực tuyến</h3>
      </div>
      <div class="col-sm-4">
        <i class="fa-solid fa-computer" style="font-size: 200px;"></i>
        <h3>Học trực tuyến</h3>
      </div>
      <div class="col-sm-4">
        <i class="fa-solid fa-circle-user" style="font-size: 200px;"></i>
        <h3>Giảng viên tâm huyết</h3>
      </div>
    </div>
  </div>
</div>

<?php
include_once("_footer.php");
?>