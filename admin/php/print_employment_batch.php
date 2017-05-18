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
		        	<h3>
		        		Employment per Batch
		        		<span class="label pull-right bg-green" style="font-size: 14px">Employed</span>
		        		<span class="label pull-right bg-green" style="background: #bdc3c7 !important; margin-right: 10px ; font-size: 14px">Unemployed</span>
		        		
		        	</h3>
					<div class="chart">
						<canvas id="barChart2" style="height:250px"></canvas>
					</div><br><br>

					<table class="table table-bordered">
						<tr>
							<th></th>
							<th>2011</th>
							<th>2012</th>
							<th>2013</th>
							<th>2014</th>
							<th>2015</th>
							<th>Total</th>
						</tr>

						<tr>
							<td>Employed</td>
							<td><span id="b_11_e"></span></td>
							<td><span id="b_12_e"></span></td>
							<td><span id="b_13_e"></span></td>
							<td><span id="b_14_e"></span></td>
							<td><span id="b_15_e"></span></td>
							<td><span id="b_e_t"></span></td>
						</tr>

						<tr>
							<td>Unemployed</td>
							<td><span id="b_11_u"></span></td>
							<td><span id="b_12_u"></span></td>
							<td><span id="b_13_u"></span></td>
							<td><span id="b_14_u"></span></td>
							<td><span id="b_15_u"></span></td>
							<td><span id="b_u_t"></span></td>
						</tr>

						<tr>
							<td>Grand Total</td>
							<td colspan="5"></td>
							<td id="g_t"></td>
						</tr>
						<tr>
							<td>Did Not Respond</td>
							<td colspan="5"></td>
							<td id="d_n_r"></td>
						</tr>
						<tr>
							<td>Registered Alumni</td>
							<td colspan="5"></td>
							<td id="r_a"></td>
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
		$(function () {
	      <?php
	        $batch_11_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2011' and a.employment_status<>'Unemployed'"));
	        $batch_11_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2011' and a.employment_status='Unemployed'"));
	        $batch_12_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2012' and a.employment_status<>'Unemployed'"));
	        $batch_12_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2012' and a.employment_status='Unemployed'"));
	        $batch_13_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2013' and a.employment_status<>'Unemployed'"));
	        $batch_13_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2013' and a.employment_status='Unemployed'"));
	        $batch_14_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2014' and a.employment_status<>'Unemployed'"));
	        $batch_14_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2014' and a.employment_status='Unemployed'"));
	        $batch_15_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2015' and a.employment_status<>'Unemployed'"));
	        $batch_15_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.year_graduated = '2015' and a.employment_status='Unemployed'"));
	      	$gtotal = $batch_11_e+$batch_12_e+$batch_13_e+$batch_14_e+$batch_15_e+$batch_11_u+$batch_12_u+$batch_13_u+$batch_14_u+$batch_15_u;
	      	$all_alumni = mysqli_num_rows(mysqli_query($conn, "select * from tbl_alumni"));
	      	if($row_prof['user_level'] == "Co-admin"){
				$batch_11_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2011' and a.employment_status<>'Unemployed'"));
				$batch_11_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2011' and a.employment_status='Unemployed'"));
				$batch_12_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2012' and a.employment_status<>'Unemployed'"));
				$batch_12_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2012' and a.employment_status='Unemployed'"));
				$batch_13_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2013' and a.employment_status<>'Unemployed'"));
				$batch_13_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2013' and a.employment_status='Unemployed'"));
				$batch_14_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2014' and a.employment_status<>'Unemployed'"));
				$batch_14_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2014' and a.employment_status='Unemployed'"));
				$batch_15_e = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2015' and a.employment_status<>'Unemployed'"));
				$batch_15_u = mysqli_num_rows(mysqli_query($conn, "select a.employment_status,b.student_number, b.year_graduated from tbl_employment a, tbl_alumni b where a.student_number = b.student_number and b.college='".$row_prof['college']."' and b.year_graduated = '2015' and a.employment_status='Unemployed'"));
				$gtotal = $batch_11_e+$batch_12_e+$batch_13_e+$batch_14_e+$batch_15_e+$batch_11_u+$batch_12_u+$batch_13_u+$batch_14_u+$batch_15_u;
	      		$all_alumni = mysqli_num_rows(mysqli_query($conn, "select * from tbl_alumni where college='".$row_prof['college']."'"));
	        }
	      ?>

	      $("#b_11_e").html("<?php echo $batch_11_e; ?>");
	      $("#b_12_e").html("<?php echo $batch_12_e; ?>");
	      $("#b_13_e").html("<?php echo $batch_13_e; ?>");
	      $("#b_14_e").html("<?php echo $batch_14_e; ?>");
	      $("#b_15_e").html("<?php echo $batch_15_e; ?>");
	      $("#b_11_u").html("<?php echo $batch_11_u; ?>");
	      $("#b_12_u").html("<?php echo $batch_12_u; ?>");
	      $("#b_13_u").html("<?php echo $batch_13_u; ?>");
	      $("#b_14_u").html("<?php echo $batch_14_u; ?>");
	      $("#b_15_u").html("<?php echo $batch_15_u; ?>");
	      $("#b_e_t").html("<?php echo $batch_11_e+$batch_12_e+$batch_13_e+$batch_14_e+$batch_15_e; ?>");
	      $("#b_u_t").html("<?php echo $batch_11_u+$batch_12_u+$batch_13_u+$batch_14_u+$batch_15_u; ?>");
	      $("#g_t").html("<?php echo $gtotal; ?>");
	      $("#d_n_r").html("<?php echo $all_alumni-$gtotal; ?>");
	      $("#r_a").html("<?php echo $all_alumni; ?>");

	      var areaChartData2 = {
        labels: ["2011", "2012", "2013", "2014", "2015"],
        datasets: [
          {
            label: "Electronics",
            fillColor: "rgba(210, 214, 222, 1)",
            strokeColor: "rgba(210, 214, 222, 1)",
            pointColor: "rgba(210, 214, 222, 1)",
            pointStrokeColor: "#c1c7d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [<?php echo $batch_11_u; ?>, <?php echo $batch_12_u; ?>, <?php echo $batch_13_u; ?>, <?php echo $batch_14_u; ?>, <?php echo $batch_15_u; ?>]
          },
          {
            label: "Digital Goods",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: [<?php echo $batch_11_e; ?>, <?php echo $batch_12_e; ?>, <?php echo $batch_13_e; ?>, <?php echo $batch_14_e; ?>, <?php echo $batch_15_e; ?>]
          }
        ]
      };

	      var barChartCanvas2 = $("#barChart2").get(0).getContext("2d");
	      var barChart2 = new Chart(barChartCanvas2);
	      var barChartData2 = areaChartData2;
	      barChartData2.datasets[1].fillColor = "#00a65a";
	      barChartData2.datasets[1].strokeColor = "#00a65a";
	      barChartData2.datasets[1].pointColor = "#00a65a";
	      var barChartOptions2 = {
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

	      barChartOptions2.datasetFill = false;
	      barChart2.Bar(barChartData2, barChartOptions2);
	    });
	</script>
</body>
</html>