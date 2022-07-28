<?php
include_once('../../Database/config.php');

if (isset($_GET['feedback_id'])) {
    $id = $_GET['feedback_id'];
}

$sql = "DELETE FROM feedback WHERE feedback_id = $id";
$con->query($sql);
header("Location: feedback_list.php");
