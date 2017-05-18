<?php
session_start();
include'db_connection.php'; 
$row_prof = mysqli_fetch_assoc(mysqli_query($conn, "select * from tbl_admin where id=".$_SESSION['id']));
?>
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
		        		Employment per Course
		        		<span class="label pull-right bg-green" style="font-size: 14px">Employed</span>
		        		<span class="label pull-right bg-green" style="background: #bdc3c7 !important; margin-right: 10px ; font-size: 14px">Unemployed</span>
		        		
		        	</h3>
					<div class="chart">
						<canvas id="barChart" style="height:250px"></canvas>
					</div><br><br>
					<table class="table table-bordered">
						<tr>
							<th></th>
							<?php
								$query = mysqli_query($conn, "select * from tbl_courses where college='".$row_prof['college']."'");
								$count = mysqli_num_rows($query);
								$va = [];
								while($row = mysqli_fetch_assoc($query)){
									$va[] = $row['coursecode'];
									?>
										<th><?php echo $row['coursecode']; ?></th>
									<?php
								}
							?>
							<th>Total</th>
						</tr>
						<tr>
							<td>Employed</td>
							<?php
								$e_t = 0;
								foreach ($va as $key => $value) {
									if(!empty(mysqli_num_rows(mysqli_query($conn, "select a.*, b.employment_status from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='".$value."' and b.employment_status!='Unemployed'")))){
										$e_t = $e_t+1;
									}
									?>
										<td>
											<?php echo mysqli_num_rows(mysqli_query($conn, "select a.*, b.employment_status from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='".$value."' and b.employment_status!='Unemployed'")); ?>
										</td>
									<?php
								}
							?>
							<td><?php echo $e_t; ?></td>
						</tr>
						<tr>
							<td>Unemployed</td>
							<?php
								$u_t = 0;
								foreach ($va as $key => $value) {
									if(!empty(mysqli_num_rows(mysqli_query($conn, "select a.*, b.employment_status from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='".$value."' and b.employment_status='Unemployed'")))){
										$u_t = $u_t+1;
									}
									?>
										<td>
											<?php echo mysqli_num_rows(mysqli_query($conn, "select a.*, b.employment_status from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.coursecode='".$value."' and b.employment_status='Unemployed'")); ?>
										</td>
									<?php
								}
							?>
							<td><?php echo $u_t; ?></td>
						</tr>
						<tr>
							<td>Grand Total</td>
							<td colspan="<?php echo $count; ?>"></td>
							<td><?php echo mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='".$row_prof['college']."'")); ?></td>
						</tr>
						<tr>
							<td>Did Not Respond</td>
							<td colspan="<?php echo $count; ?>"></td>
							<td><?php echo mysqli_num_rows(mysqli_query($conn, "select * from tbl_alumni where college='".$row_prof['college']."'"))-mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='".$row_prof['college']."'")); ?></td>
						</tr>
						<tr>
							<td>Registered Alumni</td>
							<td colspan="<?php echo $count; ?>"></td>
							<td><?php echo mysqli_num_rows(mysqli_query($conn, "select * from tbl_alumni where college='".$row_prof['college']."'")); ?></td>
						</tr>
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
		var areaChartData = {
	        labels: [
	          <?php
	            $val = [];
	            $query6 = mysqli_query($conn, "select * from tbl_courses where college='".$row_prof['college']."'") or die(mysqli_error());
	            while($row6 = mysqli_fetch_assoc($query6)){
	              $val[] = $row6['coursecode'];
	              ?>
	                "<?php echo $row6['coursecode']; ?>",
	              <?php
	            }
	          ?>
	        ],
	        datasets: [
	          {
	            label: "Electronics",
	            fillColor: "rgba(210, 214, 222, 1)",
	            strokeColor: "rgba(210, 214, 222, 1)",
	            pointColor: "rgba(210, 214, 222, 1)",
	            pointStrokeColor: "#c1c7d1",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(220,220,220,1)",
	            data: [
	              <?php
	                foreach ($val as $key => $value) {
	                  ?>
	                    <?php echo mysqli_num_rows(mysqli_query($conn, "select a.*, b.employment_status from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and coursecode = '".$value."' and b.employment_status='Unemployed'")); ?>,
	                  <?php
	                }
	              ?>
	            ]
	          },
	          {
	            label: "Digital Goods",
	            fillColor: "rgba(60,141,188,0.9)",
	            strokeColor: "rgba(60,141,188,0.8)",
	            pointColor: "#3b8bba",
	            pointStrokeColor: "rgba(60,141,188,1)",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(60,141,188,1)",
	            data: [
	              <?php
	                foreach ($val as $key => $value) {
	                  ?>
	                    <?php echo mysqli_num_rows(mysqli_query($conn, "select a.*, b.employment_status from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and coursecode = '".$value."' and b.employment_status!='Unemployed'")); ?>,
	                  <?php
	                }
	              ?>
	            ]
	          }
	        ]
	    };
	    var barChartCanvas = $("#barChart").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas);
      var barChartData = areaChartData;
      barChartData.datasets[1].fillColor = "#00a65a";
      barChartData.datasets[1].strokeColor = "#00a65a";
      barChartData.datasets[1].pointColor = "#00a65a";
      var barChartOptions = {
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
        barDatasetSpacing: 1,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true,
        maintainAspectRatio: true
      };

      barChartOptions.datasetFill = false;
      barChart.Bar(barChartData, barChartOptions);
	</script>
</body>
</html>