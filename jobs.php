<?php include'php/header.php'; ?>

<style>
  @media (max-width: 768px) {
    .col-md-9{
      padding-left: 15px !important;
    }

    .col-md-3{
      margin-bottom: 15px
    }
  }
</style>

<?php
  //add job post
  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
    echo "
    <script>
      bootbox.alert('Job');
    </script>
    ";
    $_SESSION['alert'] = 0;
  }
  //review job post
  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
    echo "
    <script>
      bootbox.alert('Job');
    </script>
    ";
    $_SESSION['alert'] = 0;
  }
?>

<section class="content-header">
  <h1>
    Jobs
  </h1>
  <ol class="breadcrumb">
    <li ><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Jobs</li>
  </ol>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-3 bg-white" style="padding-bottom: 15px">
      <h3 style="margin-bottom: 20px">Search Criteria</h3>
      <form method="get">
        <p><input type="text" name="job_title" class="form-control" placeholder="Job Title" value="<?php if(isset($_GET['job_title'])){ echo $_GET['job_title']; } ?>"></p>
        <p><select name="job_category" class="form-control">
          <option value="">All Category</option>
          <?php
            $cat_query = mysqli_query($conn, "select * from tbl_job_categories");
            while($cat = mysqli_fetch_assoc($cat_query)){
              ?>
                <option value="<?php echo $cat['category_name']; ?>" <?php if(isset($_GET['job_category']) && $_GET['job_category'] == $cat['category_name']){ echo "selected"; } ?> ><?php echo $cat['category_name']; ?></option>
              <?php
            }
          ?>
        </select></p>
        <p><select name="job_location" class="form-control">
          <option value="">All Location</option>
          <?php
            $loc_query = mysqli_query($conn, "select * from tbl_job_locations");
            while($loc = mysqli_fetch_assoc($loc_query)){
              ?>
                <option value="<?php echo $loc['location_name']; ?>" <?php if(isset($_GET['job_location']) && $_GET['job_location'] == $loc['location_name']){ echo "selected"; } ?> ><?php echo $loc['location_name']; ?></option>
              <?php
            }
          ?>
        </select></p>
        <p><input type="submit" class="btn btn-default btn-flat btn-block" value="Search" style="margin-top: 20px"></p>
        <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-default btn-flat btn-block">Clear Filter</a></p>
        <h1>
          <hr>
        </h1>
        <p><a href="post_job.php" class="btn btn-success btn-flat btn-block">Post a Job</a></p>
      </form>
    </div>

    <div class="col-md-9" style="padding-left: 40px;">
      <?php
        if(isset($_GET['job_title']) or isset($_GET['job_category']) or isset($_GET['job_location'])){
          $job_title = $_GET['job_title'];
          $job_category = $_GET['job_category'];
          $job_location = $_GET['job_location'];

          $jobs_sql = "select * from tbl_job_posts";
          if(empty($job_category)){
            $ifcategory = "category<>''";
          }else{
            $ifcategory = "category='$job_category'";
          }
          if(empty($job_location)){
            $iflocation = "location<>''";
          }else{
            $iflocation = "location='$job_location'";
          }
          if(!empty($job_title) || !empty($job_category) || !empty($job_location)){
            $jobs_sql .= " where job_title like '$job_title%' and $ifcategory and $iflocation and job_status=1 order by job_post_id desc";
          }
          
          $jobs_query = mysqli_query($conn, $jobs_sql);
        }else{
          $jobs_query = mysqli_query($conn, "select * from tbl_job_posts where (college='".$row_prof['college']."' or college='') and job_status=1 order by job_post_id desc");
        }
        if(empty(mysqli_num_rows($jobs_query))){
          ?>
            <div class="row">
              <div class="col-md-12 bg-white text-center" style="padding-bottom: 15px;">
                <h1>No Available Jobs</h1>
              </div>
            </div>
          <?php
        }
        while($jobs = mysqli_fetch_assoc($jobs_query)){
          ?>
            <div class="row">
              <div class="col-md-12 bg-white" style="padding-bottom: 15px">
                <h3><?php echo $jobs['job_title']; ?></h3>
                <h4><?php echo $jobs['company_name']; ?></h4>
                <p class="locsal"><i class="fa fa-dollar"> </i> <?php echo $jobs['salary']; ?></p>
                <p class="locsal"><i class="fa fa-map-marker"> </i> <?php echo $jobs['address']." - ".$jobs['location']; ?></p>
                <p class="locsal"><i class="fa fa-envelope-square"> </i> <?php echo $jobs['company_email']; ?></p>
                <p class="locsal"><i class="fa fa-phone"> </i> <?php echo $jobs['company_number']; ?></p>
                <p style="margin-top: 10px"><?php echo $jobs['description']; ?></p>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <h5 style="color: #95a5a6"><?php echo $jobs['category']; ?> &nbsp; &bull; &nbsp; <?php echo $jobs['date_posted']; ?></h5>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <h5 style="color: #95a5a6" class="text-right">Posted by: <?php echo $jobs['posted_by']; ?></h5>
                  </div>
                </div>
                 
              </div>
            </div><br>
          <?php
        }
      ?>
    </div>
  </div>
  
</section>

<?php include'php/footer.php'; ?>