<?php
//connection
session_start();
require 'db_connection.php';
//field variables
$username=$_POST['username'];
$password=md5($_POST['password']);

//query
$select="SELECT * from tbl_admin WHERE username='$username' and password='$password'";
$result=mysqli_query($conn, $select);
$record=mysqli_num_rows($result);

if($record==1)
{
	$select2="SELECT * from tbl_admin WHERE username='$username' and password='$password'";
	$result2=mysqli_query($conn, $select2);
//sessions
	while(list($id,$username,$password,$firstname,$lastname,$email,$user_level)=mysqli_fetch_array($result2))
	{
		$aid=$id;
		$ausername=$username;
		$apassword=$password;
		$afirstname=$firstname;
		$alastname=$lastname;
		$aemail = $email;
		$auser_level=$user_level;
	}
	
		$_SESSION['id']=$aid;
		$_SESSION['username']=$ausername;
		$_SESSION['password']=$apassword;
		$_SESSION['firstname']=$afirstname;
		$_SESSION['lastname']=$alastname;
		$_SESSION['user_level']=$auser_level;

		date_default_timezone_set('Asia/Manila');
		$name = $_SESSION['firstname']." ".$_SESSION['lastname'];
		$date = date('M d Y - h:i A');
		mysqli_query($conn, "insert into tbl_admin_logs(name, user_level, action, date) values('$name', '".$auser_level."', 'logged in', '$date')") or die(mysqli_error());

		//open file
		
		echo"
		<script type='text/javascript'>
		open('../dashboard.php','_self');
		</script>
		";
}
else
{
$_SESSION['alert'] = 1;
header("Location: ../index.php");
}

?>