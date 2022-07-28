<?php
include_once("_header.php");
// include_once("../Database/config.php");
session_start();
?>

<!-- Main -->
<main class="main margintop">
  <div class="container">
    <div class="row">
      <div class="col-md-3 banner-left">
        <h3>STAR CLASSES</h3>
        <!--  -->
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
      <div class="col-md-9">
        <div class="product">
          <ol class="breadcrumb">
            <li><a href="index.php">Trang chủ</a></li>
            <li class="active"><a href="">Giỏ hàng</a></li>
          </ol>
          <div class="cart">
            <?php
            if (isset($_SESSION['success'])) {
            ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong style="font-size: 20px"><?php echo $_SESSION['success']; ?></strong>
              </div>
            <?php
            }
            ?>


            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Hình ảnh</th>
                  <th>Tên sản phẩm</th>
                  <th>Giá</th>
                  <th>Tổng tiền</th>
                  <th>Xóa</th>
                </tr>
              </thead>
              <tbody>
                <?php


                if (isset($_SESSION['mycart'])) {
                  $i = 1;
                  $sum = 0;
                  foreach ($_SESSION['mycart'] as $cart) {
                    // var_dump($cart);
                    // exit;
                    $image = 'images/' . $cart[2];
                    $sum += $cart[3];
                ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><img src="<?php echo $image; ?>" width="100px" height="100px" alt=""></td>
                      <td><?php echo $cart[1]; ?></td>
                      <td><?php echo $cart[3]; ?></td>
                      <td><?php echo $cart[3]; ?></td>
                      <td><a href="Cart_delete.php?product_id=<?php echo $cart[0]; ?>">XÓA</i></a></td>
                    </tr>
                  <?php
                    $i++;
                  }
                  ?>
                  <tr>
                    <td colspan="4" class="text-center" style="font-weight: bold; font-size: 18px">Tổng đơn hàng</td>
                    <td><?php echo $sum; ?></td>
                    <td></td>
                  </tr>
                <?php
                }


                ?>
              </tbody>
            </table>
          </div>
          <div class="text-right">

            <p>
              <?php
              if (isset($_SESSION['mycart'])) {

              ?>
                <a href="index.php" class="btn btn-primary"><i class="fas fa-cart-arrow-down"></i>Tiếp tục mua hàng</a>
                <!-- <a href="" class="btn btn-danger"><i class="fas fa-minus-circle"></i>Xóa tất cả</a> -->
                <a href="Dat_hang.php" class="btn btn-success"><i class="fas fa-shopping-bag"></i>Mua ngay</a>
              <?php
              }
              ?>
            </p>
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