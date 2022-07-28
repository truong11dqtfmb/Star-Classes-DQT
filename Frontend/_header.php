<?php
session_start();
include('../Database/config.php');
define('VER', '2.0');

?>

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
    <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo VER; ?>">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-light top-menu navbar-fixed-top mb-5 col-md-12 col-sm-6">
        <div class="container">
            <ul class="navbar-nav navbar-toggler-right">
                <li><a href="index.php"><img src="images/logo_project.png" width="100px"></a></li>
            </ul>
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="mynavbar">
                    <ul class="navbar-nav navbar-toggler-left me-auto mb-2 mb-lg-0">
                        <li class="nav-item mr-5">
                            <form class="form-inline" method="get" action="Search.php">
                                <input class="form-control" type="text" placeholder="Tìm khóa học" style="width: 28em" required name="key_search">
                                <input class="btn btn-primary" type="submit" name="button_search" value="Tìm"></input>
                            </form>
                        </li>
                        <ul>
                            <li class="nav-item">
                                <a href="Khoa_hoc_cua_toi.php" class="btn btn-primary">Khóa học của tôi &nbsp;
                                    <i class="fa-solid fa-unlock" style="font-size: 18px;"></i>
                                </a>
                            </li>
                        </ul>
                        <li class="nav-item">
                            <a href="Cart.php" style="font-size: 30px; color: #0e59b3e8; font-weight: bold">&ensp;<span class="glyphicon glyphicon-shopping-cart">&ensp;</a>
                        </li>
                    </ul>
                    <ul class=" nav float-end" style="margin-right: -30px;">
                        <?php
                        if (isset($_SESSION['mail']) && isset($_SESSION['phone'])) {
                        ?>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-crown"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="Khoa_hoc_cua_toi.php">Khóa học của tôi</a></li>
                                    <li><a class="dropdown-item" href="Doi_mat_khau.php">Đổi mật khẩu</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="Dang_xuat.php">Đăng xuất</a></li>
                                </ul>
                            </div>
                        <?php
                        } else {
                        ?>
                            <li>
                                <a href="Dang_ky.php"><span class="glyphicon glyphicon-user">&ensp;ĐĂNG KÝ</a>
                            </li>
                            <li>
                                <a href="Dang_nhap.php"><span class="glyphicon glyphicon-log-in">&ensp;ĐĂNG NHẬP</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>