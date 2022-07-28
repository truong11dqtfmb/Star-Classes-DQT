<?php
include_once('../../Database/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = "DELETE FROM users WHERE user_id = $id";
$con->query($sql);
header("Location: user_list.php");
