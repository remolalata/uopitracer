<?php include'php/header.php'; ?>

<style>
  .content-wrapper .container{
    padding: 0 150px 0 150px;
  }

  @media (max-width: 767px) {
    .content-wrapper .container{
      padding: 15px;
    }
  }
</style>

<?php
  if(isset($_POST['job_title'])){
    $job_title = $_POST['job_title'];
    $category = $_POST['category'];
    $salary = $_POST['salary'];
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $date_posted = date("M d Y");
    $contact_number = $_POST['contact_number'];
    $posted_by = $row_prof['firstname']." ".$row_prof['lastname'];

    //mysqli_query($conn, "insert into tbl_job_posts(job_title, salary, company_name, company_email, company_number, location, address, category, description, date_posted, posted_by, if_job_posted_by_alumni, student_number, job_status) values('$job_title', '$salary', '$company_name', '$email', '$contact_number', '$location', '$address', '$category', '$description', '$date_posted', '$posted_by', '1', '".$row_prof['student_number']."', 0)") or die(mysqli_error());
    mysqli_query($conn, "update tbl_job_posts set job_title='$job_title', salary='$salary', company_name='$company_name', company_email='$company_email', company_number='$company_number', location='$location', address='$address', category='$category', description='$description', date_posted='$date_posted', posted_by='$posted_by', if_job_posted_by_alumni='1', student_number='".$row_prof['student_number']."', job_status='0' where job_post_id='".$_GET['id']."'
    ");
    $_SESSION['alert'] = 1;
    header('Location: jobs.php');
  }

  if(isset($_GET['id'])){
    $job_query = mysqli_query($conn, "select * from tbl_job_posts where job_post_id='".$_GET['id']."'");
    $job = mysqli_fetch_assoc($job_query);
  }
?>

<section class="content-header">
  <h1>
    Post Job
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="jobs.php"><i class="fa fa-black-tie"></i>Jobs</a></li>
    <li class="active">Post Job</li>
  </ol>
</section>

<section class="content">

  <div class="box box-success">
    <div class="box-body">
      <form method="post" id="addJobForm">
        <div class="form-group" id="job_title_error">
          <label>Job Title</label>
          <input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $job['job_title']; ?>" placeholder="Job Title">
        </div>
        <div class="form-group" id="category_error">
          <label>Category</label>
          <select name="category" id="category" class="form-control">
            <option value="">Select Category</option>
            <?php
              $query = mysqli_query($conn, "select * from tbl_job_categories");
              while($row = mysqli_fetch_assoc($query)){
                ?>
                  <option value="<?php echo $row['category_name']; ?>" <?php if($row['category_name'] == $job['category']){ echo "selected"; } ?> ><?php echo $row['category_name']; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
        <div class="form-group" id="salary_error">
          <label>Salary</label>
          <input type="text" class="form-control" name="salary" id="salary" onkeypress="return numbersonly(event)" value="<?php echo $job['salary']; ?>" placeholder="Salary">
        </div>
        <div class="form-group" id="company_name_error">
          <label>Company Name</label>
          <input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo $job['company_name']; ?>" placeholder="Company Name">
        </div>
        <div class="form-group" id="contact_number_error">
          <label>Company Number</label>
          <input type="text" class="form-control" name="contact_number" id="contact_number" onkeypress="return numbersonly(event)" value="<?php echo $job['company_number']; ?>" placeholder="Company Number">
        </div>
        <div class="form-group" id="company_email_error">
          <label>Company Email</label>
          <input type="text" class="form-control" name="email" id="email" value="<?php echo $job['company_email']; ?>" placeholder="Company Email">
        </div>
        <div class="form-group" id="address_error">
          <label>Company Address</label>
          <input type="text" class="form-control" name="address" id="address" value="<?php echo $job['address']; ?>" placeholder="Company Address">
        </div>
        <div class="form-group" id="location_error">
          <label>Location</label>
          <select name="location" id="location" class="form-control">
            <option value="">Select Location</option>
            <?php
              $query2 = mysqli_query($conn, "select * from tbl_job_locations");
              while($row2 = mysqli_fetch_assoc($query2)){
                ?>
                  <option value="<?php echo $row2['location_name']; ?>" <?php if($row2['location_name'] == $job['location']){ echo "selected"; } ?> ><?php echo $row2['location_name']; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
        <div class="form-group" id="description_error">
          <label>Description</label>
          <input type="text" class="form-control" name="description" id="description" value="<?php echo $job['description']; ?>" placeholder="Description">
        </div>

        <hr>

        <div class="row">
          <div class="col-md-12 text-right">
            <button type="button" onclick="addJobBtn()" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</section>


<?php include'php/footer.php'; ?>