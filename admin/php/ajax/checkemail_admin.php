<?php
include'../db_connection.php';
$email = $_POST['id'];
//$query = mysql_query("select * from tbl_admin where email='$email'");
//$count = mysql_num_rows($query);
echo json_encode(array(
    'count' => $email
	));
?>