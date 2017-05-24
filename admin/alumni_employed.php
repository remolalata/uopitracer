<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<section class="content-header">
  <h1>
    Alumni
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li><a href="alumni_manage.php"><i class="fa fa-user"> </i> Alumni List</a></li>
    <li class="active">Employed Alumni</li>
  </ol>
</section>

<?php if($row_prof['user_level'] == "Co-admin"){ include'partials/alumni_employed.php'; }else{ ?>
<section class="content">

  <div class="box box-success">

    <div class="box-header with-border">
      <h3></h3>
      <div class="box-tools pull-right">
        <a href="php/print_employed_alumni.php" class="btn btn-success btn-sm" target="_blank" data-toggle="tooltip" title="Print Employed Alumni"><i class="fa fa-print"></i></a>
      </div>
    </div>

    <div class="box-body">
      <table id="alumniEmployedTbl" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Job Title</th>
            <th>Employment Status</th>
            <th>Company Name</th>
            <th>Company Address</th>
            <th>Year Employed</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($conn, "select a.*, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and employment_status<>'Unemployed'");
            while($row = mysqli_fetch_assoc($query)){
              ?>
                <tr>
                  <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                  <td><?php echo $row['job_title']; ?></td>
                  <td><?php echo $row['employment_status']; ?></td>
                  <td><?php echo $row['company_name']; ?></td>
                  <td><?php echo $row['company_address']; ?></td>
                  <td><?php echo $row['year_employed']; ?></td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>

    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Donut Chart</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <canvas id="pieChart" style="height:250px"></canvas>
        </div>
      </div>
    </div>
  </div>

</section>
<?php } ?>

<script src="plugins/chartjs/Chart.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  <?php
    $regular = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Regular/Permanent'"));
    $contractual = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Contractual'"));
    $temporary = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Temporary'"));
    $casual = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Casual'"));
    $selfemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Self-Employed'"));

    if($row_prof['user_level'] == "Co-admin"){
      $regular = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Regular/Permanent' and college='".$row_prof['college']."'"));
      $contractual = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Contractual' and college='".$row_prof['college']."'"));
      $temporary = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Temporary' and college='".$row_prof['college']."'"));
      $casual = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Casual' and college='".$row_prof['college']."'"));
      $selfemployed = mysqli_num_rows(mysqli_query($conn, "select * from tbl_employment where employment_status='Self-Employed' and college='".$row_prof['college']."'"));
    }
  ?>
  var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
    {
      value: <?php echo $regular; ?>,
      color: "#f56954",
      highlight: "#f56954",
      label: "Regular/Permanent"
    },
    {
      value: <?php echo $contractual; ?>,
      color: "#00a65a",
      highlight: "#00a65a",
      label: "Contractual"
    },
    {
      value: <?php echo $temporary; ?>,
      color: "#f39c12",
      highlight: "#f39c12",
      label: "Temporary"
    },
    {
      value: <?php echo $casual; ?>,
      color: "#00c0ef",
      highlight: "#00c0ef",
      label: "Casual"
    },
    {
      value: <?php echo $selfemployed; ?>,
      color: "#3c8dbc",
      highlight: "#3c8dbc",
      label: "Self-Employed"
    }
  ];
  var pieOptions = {
    segmentShowStroke: true,
    segmentStrokeColor: "#fff",
    segmentStrokeWidth: 2,
    percentageInnerCutout: 50,
    animationSteps: 100,
    animationEasing: "easeOutBounce",
    animateRotate: true,
    animateScale: false,
    responsive: true,
    maintainAspectRatio: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
  };
  pieChart.Doughnut(PieData, pieOptions);

</script>
<?php include'php/footer.php'; ?>
