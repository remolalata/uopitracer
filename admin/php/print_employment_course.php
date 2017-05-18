<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
		        	<h3>
		        		Employment per Batch
		        		<span class="label pull-right bg-green" style="font-size: 14px">Employed</span>
		        		<span class="label pull-right bg-green" style="background: #bdc3c7 !important; margin-right: 10px ; font-size: 14px">Unemployed</span>
		        		
		        	</h3>
					<div class="chart">
						<canvas id="barChart3" style="height:250px"></canvas>
					</div><br><br>

					<table class="table table-bordered">
						<?php
							if(isset($_GET['course'])){
								$course = $_GET['course'];
								?>
									<tr>
										<th></th>
										<th>Regular/Permanent</th>
										<th>Contractual</th>
										<th>Temporary</th>
										<th>Casual</th>
										<th>Self-Employed</th>
										<th>Unemployed</th>
									</tr>
									<tr>
										<td><?php echo $_GET['course']; ?></td>
										<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course' and b.employment_status='Regular/Permanent' ")); ?></td>
										<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course' and b.employment_status='Contractual' ")); ?></td>
										<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course' and b.employment_status='Temporary' ")); ?></td>
										<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course' and b.employment_status='Casual' ")); ?></td>
										<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course' and b.employment_status='Self-Employed' ")); ?></td>
										<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course' and b.employment_status='Unemployed' ")); ?></td>
									</tr>
								<?php
							}else{
								?>
									<tr>
										<th></th>
										<th>Regular/Permanent</th>
										<th>Contractual</th>
										<th>Temporary</th>
										<th>Casual</th>
										<th>Self-Employed</th>
										<th>Unemployed</th>
									</tr>
								<?php
								$query = mysqli_query($conn, "select * from tbl_courses");
								if($row_prof['user_level'] == "Co-admin"){
									$query = mysqli_query($conn, "select * from tbl_courses where college='".$row_prof['college']."'");
								}
								while($row = mysqli_fetch_assoc($query)){
									$course2 = $row['coursecode'];
									?>
										<tr>
											<td><?php echo $row['coursecode']; ?></td>
											<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course2' and b.employment_status='Regular/Permanent' ")); ?></td>
											<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course2' and b.employment_status='Contractual' ")); ?></td>
											<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course2' and b.employment_status='Temporary' ")); ?></td>
											<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course2' and b.employment_status='Casual' ")); ?></td>
											<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course2' and b.employment_status='Self-Employed' ")); ?></td>
											<td><?php echo mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$course2' and b.employment_status='Unemployed' ")); ?></td>
										</tr>
									<?php
								}
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

	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../plugins/chartjs/Chart.min.js"></script>
	<script src="../dist/js/app.min.js"></script>

	<script>
		<?php
	        if(isset($_GET['course'])){
	          $courseVal = $_GET['course'];
	          $regular = mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$courseVal' and b.employment_status='Regular/Permanent'"));
	          $contractual = mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$courseVal' and b.employment_status='Contractual'"));
	          $temporary = mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$courseVal' and b.employment_status='Temporary'"));
	          $casual = mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$courseVal' and b.employment_status='Casual'"));
	          $selfemployed = mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$courseVal' and b.employment_status='Self-Employed'"));
	          $unemployed = mysqli_num_rows(mysqli_query($conn, "select a.coursecode, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='$courseVal' and b.employment_status='Unemployed'"));
	        }else{
	          $regular = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Regular/Permanent'"));
	          $contractual = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Contractual'"));
	          $temporary = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Temporary'"));
	          $casual = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Casual'"));
	          $selfemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Self-Employed'"));
	          $unemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Unemployed'"));
	          if($row_prof['user_level'] == "Co-admin"){
	            $regular = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Regular/Permanent' and college='".$row_prof['college']."'"));
	            $contractual = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Contractual' and college='".$row_prof['college']."'"));
	            $temporary = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Temporary' and college='".$row_prof['college']."'"));
	            $casual = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Casual' and college='".$row_prof['college']."'"));
	            $selfemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Self-Employed' and college='".$row_prof['college']."'"));
	            $unemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Unemployed' and college='".$row_prof['college']."'"));
	          }
	        }
	      ?>

      var areaChartData3 = {
        labels: ["Regular/Permanent", "Contractual", "Temporary", "Casual", "Self-Employed", "Unemployed"],
        datasets: [
          {
            label: "Electronics",
            fillColor: "rgba(210, 214, 222, 1)",
            strokeColor: "rgba(210, 214, 222, 1)",
            pointColor: "rgba(210, 214, 222, 1)",
            pointStrokeColor: "#c1c7d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [<?php echo $regular; ?>, <?php echo $contractual; ?>, <?php echo $temporary; ?>, <?php echo $casual; ?>, <?php echo $selfemployed; ?>, <?php echo $unemployed; ?>]
          }
        ]
      };

      var barChartCanvas3 = $("#barChart3").get(0).getContext("2d");
      var barChart3 = new Chart(barChartCanvas3);
      var barChartData3 = areaChartData3;
      barChartData3.datasets[0].fillColor = "#00a65a";
      barChartData3.datasets[0].strokeColor = "#00a65a";
      barChartData3.datasets[0].pointColor = "#00a65a";
      var barChartOptions3 = {
      	animation: false,
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        barShowStroke: true,
        barStrokeWidth: 2,
        barValueSpacing: 5,
        barDatasetSpacing: 0,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true,
        maintainAspectRatio: true
      };

      barChartOptions3.datasetFill = false;
      barChart3.Bar(barChartData3, barChartOptions3);
	</script>

</body>
</html>