<?php
include'../db_connection.php';
$course = strtoupper($_POST['id']);
$query = mysqli_query($conn, "select * from tbl_courses where coursecode='$course'");
$count = mysqli_num_rows($query);
echo json_encode(array(
    'count' => $count
	));
?>