<?php
include_once('../../Database/config.php');

if (isset($_GET['cartegory_id'])) {
    $id = $_GET['cartegory_id'];
}

$sql = "DELETE FROM cartegory WHERE cartegory_id = $id";
$con->query($sql);
header("Location: cartegory_list.php");
