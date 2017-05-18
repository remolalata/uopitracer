<?php include'php/header.php'; ?>

<?php

if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
  echo "
  <script>
    bootbox.alert('You approve a job post.');
  </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
  echo "
  <script>
    bootbox.alert('You post a job.');
  </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 3){
  echo "
  <script>
    bootbox.alert('You delete a job post.');
  </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 4){
  echo "
  <script>
    bootbox.alert('You decline a job post.');
  </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 5){
  echo "
  <script>
    bootbox.alert('Job Post Updated.');
  </script>
  ";
  $_SESSION['alert'] = 0;
}

if(isset($_POST['approvePost'])){
  $job_post_id = $_POST['job_post_id'];
  $name = $_SESSION['firstname']." ".$_SESSION['lastname'];
  $date = date('M d Y - h:i A');
  mysqli_query($conn, "insert into tbl_admin_logs(name, user_level, action, date) values('$name', '".$row_prof['user_level']."', 'approve job post', '$date')") or die(mysqli_error());
  mysqli_query($conn, "update tbl_job_posts set job_status=1 where job_post_id=".$job_post_id);
  $_SESSION['alert'] = 1;
  header('Location: jobs.php?do=1');
}

if(isset($_POST['declinePost'])){
  $job_post_id = $_POST['job_post_id'];
  $log = $_SESSION['user_level']." ".$row_prof['firstname']." ".$row_prof['lastname']." decline a post job request at ".date('M d Y - h:i A');
  mysqli_query($conn, "insert into tbl_admin_logs(log_history) values('$log')");
  mysqli_query($conn, "update tbl_job_posts set job_status=2 where job_post_id=".$job_post_id);
  $_SESSION['alert'] = 4;
  header('Location: jobs.php?do=1');
}

if(isset($_POST['addJobIni'])){
  $job_title = $_POST['job_title'];
  $category = $_POST['category'];
  $salary = $_POST['range1']." - ".$_POST['range2'];
  $company_name = $_POST['company_name'];
  $email = $_POST['email'];
  $company_number = $_POST['contact_number'];
  $address = $_POST['address'];
  $location = $_POST['location'];
  $description = $_POST['description'];
  $college = $row_prof['college'];
  $date_posted = date("M d Y");
  $posted_by = $row_prof['firstname']." ".$row_prof['lastname'];
  $posted_by_id = $_SESSION['id'];

  $log = $_SESSION['user_level']." ".$row_prof['firstname']." ".$row_prof['lastname']." posted a new job at ".date('M d Y - h:i A');
  mysqli_query($conn, "insert into tbl_admin_logs(log_history) values('$log')");
  $query3 = "insert into tbl_job_posts(job_title, salary, company_name, company_email, company_number, location, address, category, description, date_posted, posted_by_id, posted_by) values('$job_title', '$salary', '$company_name', '$email', '$company_number', '$location', '$address', '$category', '$description', '$date_posted', '$posted_by_id', '$posted_by')";
  if($row_prof['user_level'] == "Co-admin"){
    $query3 = "insert into tbl_job_posts(job_title, salary, company_name, company_email, company_number, location, address, category, description, college, date_posted, posted_by_id, posted_by) values('$job_title', '$salary', '$company_name', '$email', '$company_number', '$location', '$address', '$category', '$description', '$college', '$date_posted', '$posted_by_id', '$posted_by')";
  }
  mysqli_query($conn, $query3);
  $_SESSION['alert'] = 2;
  header('Location: jobs.php?do=1');
}

if(isset($_POST['deletePost'])){
  $job_post_id = $_POST['job_post_id'];
  mysqli_query($conn, "delete from tbl_job_posts where job_post_id=".$job_post_id);
  $_SESSION['alert'] = 3;
  header('Location: jobs.php?do=1');
}

?>

<style>
  .content{padding: 15px 150px 0 150px;}
  .content-header{padding-left: 150px; padding-right: 150px}
  .bg-white{background: #fff;border: 1px solid;border-color: #e5e6e9 #dfe0e4 #d0d1d5;border-radius: 3px;}
  .locsal{padding: 0;margin: 0;color: #95a5a6;padding-left: 10px}
</style>

<?php

if(isset($_GET['do']) && !empty($_GET['do'])){
  if($_GET['do'] == 1 || $_GET['do'] == 2 || $_GET['do'] == 3){
    ?>
    <section class="content-header">
      <h1>
        <?php
          if($_GET['do'] == 1){
            echo "View Jobs";
          }elseif($_GET['do'] == 2){
            echo "View Pending Jobs";
          }elseif($_GET['do'] == 3){
            echo "Post Job";
          }
        ?>
      </h1>
      <ol class="breadcrumb" style="padding-right: 130px">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
        <?php
          if($_GET['do'] == 1){
            echo "<li class='active'>View Jobs</li>";
          }elseif($_GET['do'] == 2){
            echo "<li class='active'>View Pending Jobs</li>";
          }elseif($_GET['do'] == 3){
            echo "<li class='active'>Post Job</li>";
          }
        ?>
      </ol>
    </section>

    <section class="content">
      
      <!-- VIEW JOB -->
      <?php if($_GET['do'] == 1){ ?>

        <?php

        $query = mysqli_query($conn, "select * from tbl_job_posts where job_status=1 order by job_post_id desc");
        if($row_prof['user_level'] == "Co-admin"){
         $query = mysqli_query($conn, "select * from tbl_job_posts where posted_by_id='".$_SESSION['id']."' and job_status=1 order by job_post_id desc");
        }
        if(empty(mysqli_num_rows($query))){
          ?>
          <div class="row">
            <div class="col-md-12 bg-white" style="padding-bottm: 15px">
              <h1>No Availabe Jobs</h1>
            </div>
          </div>
          <?php
        }else{
          while($row = mysqli_fetch_assoc($query)){
            ?>
            <div class="row">
              <div class="col-md-12 bg-white" style="padding-bottom: 15px">
                <h3><?php echo $row['job_title']; ?></h3>
                <h4><?php echo $row['company_name']; ?></h4>
                <p class="locsal"><i class="fa fa-dollar"> </i> <?php echo $row['salary']; ?></p>
                <p class="locsal"><i class="fa fa-map-marker"> </i> <?php echo $row['address']." - ".$row['location']; ?></p>
                <p class="locsal"><i class="fa fa-envelope-square"> </i> <?php echo $row['company_email']; ?></p>
                <p class="locsal"><i class="fa fa-phone"> </i> <?php echo $row['company_number']; ?></p>
                <p style="margin-top: 10px"><?php echo $row['description']; ?></p>
                <h5 style="color: #95a5a6"><?php echo $row['category']; ?> &nbsp; &bull; &nbsp; <?php echo $row['date_posted']; ?> <span class="pull-right">Posted by: <?php echo $row['posted_by']; ?></span></h5>
                <hr>
                <div class="row">
                  <div class="col-md-12 text-right">
                    <form method="post">
                      <input type="hidden" name="job_post_id" value="<?php echo $row['job_post_id']; ?>">
                      <?php if($row['posted_by_id'] == $_SESSION['id']){ ?>
                      <a href="edit_job.php?id=<?php echo $row['job_post_id']; ?>" class="btn btn-default"><i class="fa fa-pencil "> </i> Edit</a>
                      <?php }else{ ?>
                      <a href="#" class="btn btn-default" disabled ><i class="fa fa-pencil "> </i> Edit</a>
                      <?php } ?>
                      <button type="submit" name="deletePost" class="btn btn-danger"><i class="fa fa-trash"> </i> Delete</button>
                  </div>
                </div>
              </div>
            </div><br>
            <?php
          }
        }

        ?>

      <?php } ?>

      <!-- VIEW PENDING JOB -->
      <?php if($_GET['do'] == 2){ ?>

        <?php

        $query2 = mysqli_query($conn, "select * from tbl_job_posts where job_status=0");
        if(isset($_GET['show'])){
          $query2 = mysqli_query($conn, "select * from tbl_job_posts where job_post_id='".$_GET['show']."' and job_status=0");
        }
        if(empty(mysqli_num_rows($query2))){
          ?>
          <div class="row">
            <div class="col-md-12 bg-white" style="padding-bottom: 15px">
              <h1>No Pending Job Posts.</h1>
            </div>
          </div>
          <?php
        }else{
          while($row2 = mysqli_fetch_assoc($query2)){
            ?>
            <div class="row">
              <div class="col-md-12 bg-white" style="padding-bottom: 15px">
                <h3><?php echo $row2['job_title']; ?></h3>
                <h4><?php echo $row2['company_name']; ?></h4>
                <p class="locsal"><i class="fa fa-dollar"> </i> <?php echo $row2['salary']; ?></p>
                <p class="locsal"><i class="fa fa-map-marker"> </i> <?php echo $row2['address']." - ".$row2['location']; ?></p>
                <p class="locsal"><i class="fa fa-envelope-square"> </i> <?php echo $row2['company_email']; ?></p>
                <p style="margin-top: 10px"><?php echo $row2['description']; ?></p>
                <h5 style="color: #95a5a6"><?php echo $row2['category']; ?> &nbsp; &bull; &nbsp; <?php echo $row2['date_posted']; ?></h5>
                <hr>
                <form method="post" class="text-right">
                  <input type="hidden" name="job_post_id" value="<?php echo $row2['job_post_id']; ?>">
                  <button type="submit" name="approvePost" class="btn btn-default">Approve Post</button>
                  <button type="submit" name="declinePost" class="btn btn-default">Decline Post</button>
                </form>
              </div>
            </div><br>
            <?php
          }
        }

        ?>

      <?php } ?>
      
      <!-- ADD JOBS -->
      <?php if($_GET['do'] == 3){ ?>
      <div class="row">
        <div class="box">
          <div class="box-body">
            <form method="post" id="addJobForm">
              <input type="hidden" name="addJobIni" value="haha">
              <div class="form-group" id="job_title_error_a">
                <label>Job Title</label>
                <input type="text" class="form-control" name="job_title" id="job_title_a" placeholder="Job Title">
              </div>
              <div class="form-group" id="category_error_a">
                <label>Category</label>
                <select name="category" class="form-control" id="category_a">
                  <option value="">Select Category</option>
                  <?php
                    $query = mysqli_query($conn, "select * from tbl_job_categories");
                    while($row = mysqli_fetch_assoc($query)){
                      ?>
                        <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
              <div class="form-group" id="salary_error_a">
                <label>Salary Range per Month</label>
                <div class="row">
                  <div class="col-md-3">
                    <input type="text" name="range1" id="range1" class="form-control" onkeypress="return numbersonly(event)">
                  </div>
                  <div class="col-md-3">
                    <input type="text" name="range2" id="range2" class="form-control" onkeypress="return numbersonly(event)">
                  </div>
                </div>
              </div>
              <div class="form-group" id="company_name_error_a">
                <label>Company Name</label>
                <input type="text" class="form-control" name="company_name" id="company_name_a" placeholder="Company Name">
              </div>
              <div class="form-group" id="email_error_a">
                <label>Company Email</label>
                <input type="text" class="form-control" name="email" id="email_a" placeholder="Company Email">
              </div>
              <div class="form-group" id="contact_number_error_a">
                <label>Company Number</label>
                <input type="text" class="form-control" name="contact_number" id="contact_number_a" placeholder="Company Number" onkeypress="return numbersonly(event)">
              </div>
              <div class="form-group" id="address_error_a">
                <label>Company Address</label>
                <input type="text" class="form-control" name="address" id="address_a" placeholder="Company Address">
              </div>
              <div class="form-group" id="location_error_a">
                <label>Location</label>
                <select name="location" class="form-control" id="location_a">
                  <option value="">Select Location</option>
                  <?php
                    $query2 = mysqli_query($conn, "select * from tbl_job_locations");
                    while($row2 = mysqli_fetch_assoc($query2)){
                      ?>
                        <option value="<?php echo $row2['location_name']; ?>"><?php echo $row2['location_name']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
              <div class="form-group" id="description_error_a">
                <label>Description</label>
                <input type="text" class="form-control" name="description" id="description_a" placeholder="Description">
              </div>

              <hr>

              <div class="row">
                <div class="col-md-12 text-right">
                  <input type="button" onclick="addJobBtn()" value="Submit" class="btn btn-success">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <?php } ?>

    </section>

  <?php
  }else{
    include'404.html';
  }
}else{
  include'404.html';
}

?>

<?php include'php/footer.php'; ?>
      
