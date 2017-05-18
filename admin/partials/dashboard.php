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
          <h3 class="box-title">Employment Status per Course</h3>
          <div class="box-tools pull-right">
            <span class="label bg-green" style="background: #bdc3c7 !important">Unemployed</span>
            <span class="label bg-green">Employed</span>
            <a href="php/print_employment_course_co_admin.php" class="btn btn-default btn-xs" data-toggle="tooltip" title="Print Report"><i class="fa fa-print"> </i> </a>
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
                $query5 = mysqli_query($conn, "select * from tbl_courses where college='".$row_prof['college']."'");
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
</section>