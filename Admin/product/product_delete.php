<?php
include_once('../../Database/config.php');

if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
}

$sql = "DELETE FROM product WHERE product_id = $id";
$con->query($sql);
header("Location: product_list.php");
