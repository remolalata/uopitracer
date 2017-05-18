<?php
include'../../admin/php/db_connection.php';
$student_number = $_POST['id'];
$query = mysqli_query($conn, "select * from tbl_alumni where student_number='$student_number'");
$row = mysqli_fetch_assoc($query);
echo json_encode(array(
    'old' => $row['password']
	));
?>