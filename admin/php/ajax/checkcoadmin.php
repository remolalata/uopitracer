<?php
include'../db_connection.php';
$username = $_POST['id'];
$email = $_POST['email'];
$query = mysqli_query($conn, "select * from tbl_admin where username='$username'");
$count = mysqli_num_rows($query);

$query2 = mysqli_query($conn, "select * from tbl_admin where email='$email'");
$count2 = mysqli_num_rows($query2);
echo json_encode(array(
    'count' => $count,
    'count2' => $count2
	));
?>