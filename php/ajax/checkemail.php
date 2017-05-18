<?php
include'../../admin/php/db_connection.php';
$email = $_POST['id'];
$query = mysqli_query($conn, "select * from tbl_alumni where email_add='$email'");
$count = mysqli_num_rows($query);
echo json_encode(array(
    'count' => $count
	));
?>