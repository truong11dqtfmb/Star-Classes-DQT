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
    <!-- <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script> -->
    <title></title>
    <style type="text/css">
        .product_add label {
            font-size: 16px;
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }

        .banner-right {
            width: 75%;
        }

        .banner-left {
            width: 15%;
        }

        .margintop {
            margin-top: 80px;
        }

        .cartegory li:hover .sub-menu {
            display: block;
        }

        .sub-menu {
            display: none;
        }

        ul.cartegory {
            padding: 0 0 15px 0;
        }

        ul.cartegory li a {
            color: #333;
            text-decoration: none;
            padding: 10px;
            display: inline-block;
            width: 100%;
            transition: 0.5s all;
        }

        ul.cartegory li a:hover {
            background: #f38356;
            color: #fff;
            padding-left: 15px;
            padding-right: 10px;
        }

        ul.cartegory .icon {
            margin-top: 5px;
            font-size: 10px;
        }

        ul,
        li {
            text-decoration: none;
            list-style-type: none;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        ul li {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Banner -->
    <div class="banner">
        <div class="container-fluid">
            <div class="col-md-3 banner-left">
                <a href="../index.php">
                    <h3><i class="fa-solid fa-house-chimney"></i>DASHBOARD</h3>
                </a>
                <ul class="cartegory menu">
                    <li><a href="../cartegory/cartegory_list.php">Danh Mục<i class="fas fa-chevron-right float-end icon"></i></a>
                        <ul class="sub-menu">
                            <li><a href="../cartegory/cartegory_add.php">Thêm danh mục</a></li>
                            <li><a href="../cartegory/cartegory_list.php">Danh sách danh mục</a></li>
                        </ul>
                    </li>

                    <li><a href="product_list.php">Sản Phẩm<i class="fas fa-chevron-right float-end icon"></i></a>
                        <ul class="sub-menu">
                            <li><a href="product_add.php">Thêm sản phẩm</a></li>
                            <li><a href="product_list.php">Danh sách sản phẩm</a></li>
                        </ul>
                    </li>

                    <li><a href="../order/order_list.php"><i class="fa-solid fa-cart-circle-check"></i>Quản Lý Đơn Hàng<i class="fas fa-chevron-right float-end icon"></i></a>
                        <ul class="sub-menu">
                            <li><a href="../order/order_add.php">Thêm đơn hàng</a></li>
                            <li><a href="../order/order_list.php">Danh sách dơn hàng</a></li>
                        </ul>
                    </li>

                    <li><a href="../feedback/feedback_list.php">Quản Lý Phản Hồi<i class="fas fa-chevron-right float-end icon"></i></a></li>

                    <li><a href="../user/user_list.php">Quản Lý Người Dùng<i class="fas fa-chevron-right float-end icon"></i></a></li>
                </ul>
            </div>
            <div class="col-md-9 banner-right">