<?php
include_once('../../Database/config.php');

if (isset($_GET['order_id'])) {
    $id = $_GET['order_id'];
}

$sql = "DELETE FROM orders WHERE order_id = $id";
$con->query($sql);
header("Location: order_list.php");
