<?php
session_start();
include_once("../Database/config.php");
if (isset($_GET['product_id'])) {
    $product_id = (int)$_GET['product_id'];
    var_dump($_SESSION['mycart']);
    if (is_array($_SESSION['mycart'])) {
        foreach ($_SESSION['mycart'] as $key => $cart) {
            if ($cart[0] == $product_id) {
                unset($_SESSION['mycart'][$key]);
            }
        }
    }
} else {
    $_SESSION['mycart'] = [];
    echo 'false';
    exit;
}
header('Location: Cart.php');
