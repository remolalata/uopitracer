<?php
include'../db_connection.php';
$email = $_POST['id'];
$query = mysqli_query($conn, "select * from tbl_admin where email='$email'");
$count = mysqli_num_rows($query);
echo json_encode(array(
    'count' => $count
	));
?>