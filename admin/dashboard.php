<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/ionicons/css/ionicons.min.css">
<?php
  $query = mysqli_query($conn, "select * from tbl_alumni");
  if($row_prof['user_level'] == "Co-admin"){
    $query = mysqli_query($conn, "select * from tbl_alumni where college='".$row_prof['college']."'");
  }
  $count = mysqli_num_rows($query);

  $query2 = mysqli_query($conn, "select * from tbl_employment");
  if($row_prof['user_level'] == "Co-admin"){
    $query2 = mysqli_query($conn, "select * from tbl_employment where college='".$row_prof['college']."'");
  }
  $count2 = mysqli_num_rows($query2);

  $query3 = mysqli_query($conn, "select * from tbl_employment where employment_status='Unemployed'");
  if($row_prof['user_level'] == "Co-admin"){
    $query3 = mysqli_query($conn, "select * from tbl_employment where employment_status='Unemployed' and college='".$row_prof['college']."'");
  }
  $count3 = mysqli_num_rows($query3);

  $query4 = mysqli_query($conn, "select * from tbl_employment where employment_status!='Unemployed'");
  if($row_prof['user_level'] == "Co-admin"){
    $query4 = mysqli_query($conn, "select * from tbl_employment where employment_status!='Unemployed' and college='".$row_prof['college']."'");
  }
  $count4 = mysqli_num_rows($query4);

?>

<section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"> </i> Dashboard</li>
  </ol>
</section>

<?php if($row_prof['user_level'] == "Co-admin"){ include'partials/dashboard.php'; }else{ ?>
<section class="content">

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $count; ?></h3>
          <p>Registered Alumni</p>
        </div>
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <a href="alumni_manage.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>
            <?php
              if($count2>0 && $count>0){
                //echo round((($count2/$count)*100));
                echo $count2."/".$count;
              }else{
                echo "0";
              }
            ?>
            
          </h3>
          <p>Updated Profile</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-sync"></i>
        </div>
        <a href="alumni_updated.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>
            <?php
              if($count4>0 && $count2>0){
                //echo round((($count4/$count2)*100));
                echo $count4."/".$count2; 
              }else{
                echo "0";
              }
            ?>
          </h3>
          <p>Employed Alumni</p>
        </div>
        <div class="icon">
          <i class="ion ion-briefcase"></i>
        </div>
        <a href="alumni_employed.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>
            <?php 
            if($count3>0 && $count2>0){
              echo $count3."/".$count2;
            }else{
              echo "0";
            }
            ?>
          </h3>
          <p>Unemployed Alumni</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="alumni_unemployed.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Employment Status per College</h3>
          <div class="box-tools pull-right">
            <span class="label bg-green" style="background: #bdc3c7 !important">Unemployed</span>
            <span class="label bg-green">Employed</span>
            <a href="php/print_employment_college.php" class="btn btn-default btn-xs" data-toggle="tooltip" title="Print Report"><i class="fa fa-print"> </i> </a>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart" style="height:250px"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Employment Status per Batch</h3>
          <div class="box-tools pull-right">
            <span class="label bg-green" style="background: #bdc3c7 !important">Unemployed</span>
            <span class="label bg-green">Employed</span>
            <a href="php/print_employment_batch.php" class="btn btn-default btn-xs" data-toggle="tooltip" title="Print Report"><i class="fa fa-print"> </i> </a>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart2" style="height:250px"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Employment Status per Course</h3>
          <div class="box-tools pull-right">
            <form style="display: inline-block" method="post" id="changeChartForm"> 
              <select name="courseChart" class="input-sm" onchange="changeCourse()">
                <option value="">Select</option>
              <?php
                $query5 = mysqli_query($conn, "select * from tbl_courses");
                while($row5 = mysqli_fetch_assoc($query5)){
                  ?>
                    <option value="<?php echo $row5['coursecode']; ?>" <?php if(isset($_POST['courseChart'])){if($_POST['courseChart'] == $row5['coursecode']){echo "selected";}} ?> ><?php echo $row5['coursecode']; ?></option>
                  <?php
                }
              ?>
            </select>
            </form>&emsp;
            <?php
              if(isset($_POST['courseChart'])){
                $courseLink = "php/print_employment_course.php?course=".$_POST['courseChart']."";
              }else{
                $courseLink = "php/print_employment_course.php";
              }
            ?>
            <a href="<?php echo $courseLink; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Print Report"><i class="fa fa-print"> </i> </a>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart3" style="height:250px"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="ah"></div>

</section>
<?php } ?>

<script src="plugins/chartjs/Chart.min.js"></script>
<script>
    $(function () {
      <?php if($row_prof['user_level'] == "Superadmin"){ ?>
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
      ?>
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
      <?php }else{ ?>

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
      ?>
      var areaChartData = {
        labels: [
          <?php
            $val = [];
            $query6 = mysqli_query($conn, "select * from tbl_courses where college='".$row_prof['college']."'") or die(mysql_error());
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

      <?php } ?>

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
        }
      ?>
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

      <?php
        if(isset($_POST['courseChart'])){
          $courseVal = $_POST['courseChart'];
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

      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas);
      var barChartData = areaChartData;
      barChartData.datasets[1].fillColor = "#00a65a";
      barChartData.datasets[1].strokeColor = "#00a65a";
      barChartData.datasets[1].pointColor = "#00a65a";
      var barChartOptions = {
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

      var barChartCanvas2 = $("#barChart2").get(0).getContext("2d");
      var barChart2 = new Chart(barChartCanvas2);
      var barChartData2 = areaChartData2;
      barChartData2.datasets[1].fillColor = "#00a65a";
      barChartData2.datasets[1].strokeColor = "#00a65a";
      barChartData2.datasets[1].pointColor = "#00a65a";
      var barChartOptions2 = {
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

      var barChartCanvas3 = $("#barChart3").get(0).getContext("2d");
      var barChart3 = new Chart(barChartCanvas3);
      var barChartData3 = areaChartData3;
      barChartData3.datasets[0].fillColor = "#00a65a";
      barChartData3.datasets[0].strokeColor = "#00a65a";
      barChartData3.datasets[0].pointColor = "#00a65a";
      var barChartOptions3 = {
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
    });
  </script>

<?php include'php/footer.php'; ?>
      
