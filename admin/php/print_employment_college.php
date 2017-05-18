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
		    <div class="col-md-12">
		        <div class="box-body">
		        	<h3>
		        		Employment per College
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
							$query = mysqli_query($conn, "select * from tbl_college");
							while($row = mysqli_fetch_assoc($query)){
								?>
										<th><?php echo $row['collegecode']; ?></th>
								<?php
							}
						?>
							<th>Total</th>
						</tr>
						
						<tr>
							<td>Employed</td>
							<td id="cea_e"></td>
							<td id="chs_e"></td>
							<td id="cite_e"></td>
							<td id="cma_e"></td>
							<td id="css_e"></td>
							<td id="e_t"></td>
						</tr>

						<tr>
							<td>Unemployed</td>
							<td id="cea_u"></td>
							<td id="chs_u"></td>
							<td id="cite_u"></td>
							<td id="cma_u"></td>
							<td id="css_u"></td>
							<td id="u_t"></td>
						</tr>
						
						<tr>
							<td>Grand Total</td>
							<td colspan="6"></td>
							<td id="g_t"></td>
						</tr>
						<tr>
							<td>Did Not Respond</td>
							<td colspan="6"></td>
							<td id="d_n_r"></td>
						</tr>
						<tr>
							<td>Registered Alumni</td>
							<td colspan="6"></td>
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
	        $cea_employed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CEA' and employment_status!='Unemployed' "));
	        $cea_unemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CEA' and employment_status='Unemployed' "));
	        $cma_employed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CMA' and employment_status!='Unemployed' "));
	        $cma_unemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CMA' and employment_status='Unemployed' "));
	        $css_employed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CSS' and employment_status!='Unemployed' "));
	        $css_unemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CSS' and employment_status='Unemployed' "));
	        $chs_employed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CHS' and employment_status!='Unemployed' "));
	        $chs_unemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CHS' and employment_status='Unemployed' "));
	        $cite_employed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CITE' and employment_status!='Unemployed' "));
	        $cite_unemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where college='CITE' and employment_status='Unemployed' "));
	      	$cite_total = $cite_employed + $cite_unemployed;
	      	$e_total = $cas_employed+$cea_employed+$cma_employed+$css_employed+$chs_employed+$cite_employed;
	      	$u_total = $cas_unemployed+$cea_unemployed+$cma_unemployed+$css_unemployed+$chs_unemployed+$cite_unemployed;
	      	$all_alumni = mysqli_num_rows(mysqli_query($conn, "select * from tbl_alumni"));
	      ?>
	      $("#cea_e").html("<?php echo $cea_employed; ?>");
	      $("#cma_e").html("<?php echo $cma_employed; ?>");
	      $("#css_e").html("<?php echo $css_employed; ?>");
	      $("#chs_e").html("<?php echo $chs_employed; ?>");
	      $("#cite_e").html("<?php echo $cite_employed; ?>");
	      $("#cea_u").html("<?php echo $cea_unemployed; ?>");
	      $("#cma_u").html("<?php echo $cma_unemployed; ?>");
	      $("#css_u").html("<?php echo $css_unemployed; ?>");
	      $("#chs_u").html("<?php echo $chs_unemployed; ?>");
	      $("#cite_u").html("<?php echo $cite_unemployed; ?>");
	      $("#e_t").html("<?php echo $e_total; ?>");
	      $("#u_t").html("<?php echo $u_total; ?>");
	      $("#g_t").html("<?php echo $e_total+$u_total; ?>");
	      $("#d_n_r").html("<?php echo $all_alumni-($e_total+$u_total); ?>");
	      $("#r_a").html("<?php echo $all_alumni; ?>");
	      var areaChartData = {
	        labels: ["CEA", "CMA", "CSS", "CHS", "CITE"],
	        datasets: [
	          {
	            label: "Electronics",
	            fillColor: "rgba(210, 214, 222, 1)",
	            strokeColor: "rgba(210, 214, 222, 1)",
	            pointColor: "rgba(210, 214, 222, 1)",
	            pointStrokeColor: "#c1c7d1",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(220,220,220,1)",
	            data: [<?php echo $cea_unemployed; ?>, <?php echo $cma_unemployed; ?>, <?php echo $css_unemployed; ?>, <?php echo $chs_unemployed; ?>, <?php echo $cite_unemployed; ?>]
	          },
	          {
	            label: "Digital Goods",
	            fillColor: "rgba(60,141,188,0.9)",
	            strokeColor: "rgba(60,141,188,0.8)",
	            pointColor: "#3b8bba",
	            pointStrokeColor: "rgba(60,141,188,1)",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(60,141,188,1)",
	            data: [<?php echo $cea_employed; ?>, <?php echo $cma_employed; ?>, <?php echo $css_employed; ?>, <?php echo $chs_employed; ?>, <?php echo $cite_employed; ?>]
	          }
	        ]
	      };

	      var pieOptions = {
			animation : false,  // Edit: correction typo: from 'animated' to 'animation'
			}

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
	    });
	</script>
</body>
</html>