<?php
//connection
session_start();
require '../admin/php/db_connection.php';
//field variables
$student_number=$_POST['student_number'];
$password=md5($_POST['password']);
// $password = $_POST['password'];

//query
$select="SELECT * from tbl_alumni WHERE student_number='$student_number' and password='$password' and status=1 ";
$result=mysqli_query($conn, $select);
$record=mysqli_num_rows($result);

if($record==1)
{
	$select2="SELECT * from tbl_alumni WHERE student_number='$student_number' and password='$password'";
	$result2=mysqli_query($conn, $select2);
//sessions
	while(list($student_number,$password,$lastname,$firstname)=mysqli_fetch_array($result2))
	{
		$astudent_number=$student_number;
		$apassword=$password;
		$alastname=$lastname;
		$afirstname=$firstname;

	}
		$_SESSION['student_number']=$astudent_number;
		$_SESSION['password']=$apassword;
		$_SESSION['lastname']=$alastname;
		$_SESSION['firstname']=$afirstname;
		$_SESSION['student_number'];


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
header("Location: ../login.php");
}

?>
