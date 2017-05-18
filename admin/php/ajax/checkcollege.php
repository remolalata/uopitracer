<?php
include'../db_connection.php';
$id = strtoupper($_POST['id']);
$query = mysqli_query($conn, "select * from tbl_college where collegecode='$id'");
$count = mysqli_num_rows($query);
echo json_encode(array(
    'count' => $count,
	));
?>