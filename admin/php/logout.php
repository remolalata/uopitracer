<?php
	session_start();
	require("db_connection.php");
	date_default_timezone_set('Asia/Manila');
	$name = $_SESSION['firstname']." ".$_SESSION['lastname'];
	$date = date('M d Y - h:i A');
	mysqli_query($conn, "insert into tbl_admin_logs(name, user_level, action, date) values('$name', '".$_SESSION['user_level']."', 'logged out', '$date')") or die(mysqli_error());
	mysqli_close($conn);

	

session_destroy();

if(isset($_SESSION["id"])) {
	
	header("Location:../index.php");
}


	



?>
 <script type="text/javascript">
 
  window.location.href='../index.php';
  </script>