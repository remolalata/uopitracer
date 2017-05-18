<?php
include'../db_connection.php';
$student_number = $_POST['id'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$query = mysqli_query($conn, "select * from tbl_alumni where student_number='$student_number'");
$count = mysqli_num_rows($query);
$query2 = mysqli_query($conn, "select * from tbl_alumni where mobile_number='$contact_number'");
$count2 = mysqli_num_rows($query2);
$query3 = mysqli_query($conn, "select * from tbl_alumni where email_add='$email'");
$count3 = mysqli_num_rows($query3);
echo json_encode(array(
    'count' => $count,
    'count2' => $count2,
    'count3' => $count3,
	));
?>