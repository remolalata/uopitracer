<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <style>
		th, td{
			text-align: center;
		}
    </style>
</head>
<body onload="window.print()">
	<?php session_start(); include'db_connection.php'; ?>
	<?php $row_prof = mysqli_fetch_assoc(mysqli_query($conn, "select * from tbl_admin where id=".$_SESSION['id'])); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3 class="text-green">PHINMA - University Of Pangasinan</h3>
				<p>Arellano St. Dagupan City, Philippines 2400 | https://www.up.phinma.edu.ph</p>
				<p>63.75.522.5635</p>
			</div>
			<div class="col-md-4" style="position: absolute; top: 0; right: 0">
				<img src="../images/logo.png" width="100" height="100">
			</div>
		</div>

		<hr>

		<div class="row">
		    <div class="col-md-9 col-md-offset-1">
		        <div class="box-body">
					<table class="table table-bordered">
						<tr>
							<th>Name</th>	
							<th>Student Number</th>
							<th>Email Address</th>
							<th>Contact Number</th>
							<th>Course</th>
							<th>Batch</th>
						</tr>

						<?php
							$query = mysqli_query($conn, "select a.*, b.student_number, b.employment_status from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and b.employment_status='Unemployed'");
							if($row_prof['user_level'] == "Co-admin"){
								$query = mysqli_query($conn, "select a.*, b.student_number, b.employment_status from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.college='".$row_prof['college']."' and b.employment_status='Unemployed'");
							}
							while($row = mysqli_fetch_assoc($query)){
								?>
									<tr>
										<td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
										<td><?php echo $row['student_number']; ?></td>
										<td><?php echo $row['email_add']; ?></td>
										<td><?php echo $row['mobile_number']; ?></td>
										<td><?php echo $row['coursecode']; ?></td>
										<td><?php echo $row['year_graduated']; ?></td>
									</tr>
								<?php
							}
						?>
					</table>
		        </div>
		    </div>
		</div><br><br><br><br>

		<p>
			Prepared By: <br>
			<?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>
		</p>

	</div>
</body>
</html>