<!-- Lưu ý: 
Carousel product liên quan
 -->

<?php
include_once("_header.php");
?>
<?php

if (!isset($_SESSION['mycart'])) {
	$_SESSION['mycart'] = [];
}
if (!isset($_SESSION['khoa_hoc_cua_toi'])) {
	$_SESSION['khoa_hoc_cua_toi'] = [];
}

$product_id = $title = $thumbnail = $price = '';
if (isset($_POST['addtocart'])) {
	$product_id = $_POST['product_id'];
	$title = $_POST['title'];
	$thumbnail = $_POST['thumbnail'];
	$price = $_POST['price'];

	$product_add = [$product_id, $title, $thumbnail, $price];
	array_push($_SESSION['mycart'], $product_add);

	array_push($_SESSION['khoa_hoc_cua_toi'], $product_add);
	header('Location: Cart.php');
}
?>


<!-- Main -->
<main class="main margintop">
	<div class="container">
		<div class="row">
			<div class="col-md-3 banner-left">
				<h3> <a href="index.php">STAR CLASSES</a></h3>
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

			<div class="col-md-9 banner-right">
				<div class="product_detail">
					<!-- <img src="images/cong_nghe_thong_tin.png" width="100%" height="200px"> -->
					<ol class="breadcrumb">
						<li><a href="index.php">Trang chủ</a></li>
						<li class="active"><a href="">Sản phẩm</a></li>
					</ol>
					<div class="product-detail ">
						<div class="row">
							<?php
							if (isset($_GET['product_id'])) {
								$id = $_GET['product_id'];
							}
							$sql = "SELECT product.product_id,product.cartegory_id ,product.title,product.thumbnail,product.decription,
		product.price, product.update_at as product_ud_at,introduce,content,author_name,author_thumbnail,author_introduce,
                product.create_at as product_cr_at, cartegory.name as car_name FROM product join cartegory
                on product.cartegory_id = cartegory.cartegory_id WHERE product.product_id = $id ";
							$result = $con->query($sql);

							while ($row = mysqli_fetch_assoc($result)) {
							?>
								<div class="col-md-7 col-sm-12">
									<img src="images/<?= $row['thumbnail'] ?>" alt="" width="100%">
								</div>
								<div class="col-md-5 col-sm-12">
									<h3><?= $row['title'] ?></h3>
									<p><strong>Price: <?= $row['price'] . '<sup style="font-size: 12px">đ</sup>' ?></strong></p>
									<p><?= $row['decription'] ?></p>
									<div class="clearfix">
										<!-- <a href="Dang_ky.php" class="btn btn-danger btn-block">Đăng ký học</a> -->

										<form class="form-inline mt-3" action="" method="POST">
											<input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
											<input type="hidden" name="title" value="<?= $row['title'] ?>">
											<input type="hidden" name="thumbnail" value="<?= $row['thumbnail'] ?>">
											<input type="hidden" name="price" value="<?= $row['price'] ?>">

											<input class="btn  btn-success btn-block" type="submit" value="THÊM VÀO GIỎ HÀNG" name="addtocart"></input>
										</form>
									</div>
								</div>
								<nav class="navbar navbar-expand-sm bg-light navbar-light mt-5">
									<div class="container-fluid">
										<ul class="navbar-nav">
											<li class="nav-item">
												<a class="nav-link" href="#id_introduce"><strong>Giới thiệu</strong></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#id_content"><strong>Nội dung</strong></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#id_about_author"><strong>Giảng viên</strong></a>
											</li>
										</ul>
									</div>
								</nav>
								<div id="id_introduce" class="container-fluid thumbnail">
									<h3>Giới thiệu khóa học</h3>
									<p><?= $row['introduce'] ?></p>
								</div>
								<div id="id_content" class="container-fluid thumbnail">
									<h3>Nội dung khóa học</h3>
									<p><?= $row['content'] ?></p>
								</div>
								<div id="id_about_author" class="container-fluid thumbnail">
									<h3>Thông tin giảng viên</h3>
									<div class="row">
										<div class="col-md-3">
											<img src="images/<?= $row['author_thumbnail'] ?>" alt="" width="100%">
										</div>
										<div class="col-md-9">
											<h4><?= $row['author_name'] ?></h4>
											<p><?= $row['author_introduce'] ?></p>
										</div>
									</div>
								</div>
							<?php
							}
							?>

							<div class="row mt-5 product">

								<?php
								$sql_car = "SELECT product.cartegory_id FROM product join cartegory
									on product.cartegory_id = cartegory.cartegory_id WHERE product_id = $id ";
								$result_car = $con->query($sql_car);
								$row_car_id = mysqli_fetch_array($result_car);
								$row_car_id_product = $row_car_id['cartegory_id'];
								?>

								<h3 class="ml-5">Khóa học liên quan</h3>
								<?php
								$sql = "SELECT * FROM product WHERE cartegory_id =  " . $row_car_id_product . " and product_id <> " . $id . " order by product_id DESC LIMIT 6";
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