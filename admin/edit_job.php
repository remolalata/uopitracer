<?php include'php/header.php'; ?>

<style>
  .content{padding: 15px 150px 0 150px;}
  .content-header{padding-left: 150px; padding-right: 150px}
  .bg-white{background: #fff;border: 1px solid;border-color: #e5e6e9 #dfe0e4 #d0d1d5;border-radius: 3px;}
  .locsal{padding: 0;margin: 0;color: #95a5a6;padding-left: 10px}
</style>

<section class="content-header">
	<h1>Edit Job</h1>
	<ol class="breadcrumb">
		<li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
		<li><a href="jobs.php?do=1"><i class="fa fa-black-tie"> </i> Job Posts</a></li>
		<li class="active">Edit Job</li>
	</ol>
</section>

<?php
	$query = mysqli_query($conn, "select * from tbl_job_posts where job_post_id='".$_GET['id']."'");
	$row = mysqli_fetch_assoc($query);
	$db_salary = $row['salary'];
	$part = explode("- ", $db_salary);
	$db_range1 = $part[0];
	$db_range2 = $part[1];

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

		$log = $_SESSION['user_level']." ".$row_prof['firstname']." ".$row_prof['lastname']." updated a job post at ".date('M d Y - h:i A');
		mysqli_query($conn, "insert into tbl_admin_logs(log_history) values('$log')");
		$query4 = "update tbl_job_posts set job_title='$job_title', salary='$salary', company_name='$company_name', company_email='$email', company_number='$company_number', location='$location', address='$address', category='$category', description='$description' where job_post_id='".$_GET['id']."'";
		mysqli_query($conn, $query4);
		$_SESSION['alert'] = 5;
		header('Location: jobs.php?do=1');
	}
?>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
		      <div class="box-body">
		        <form method="post" id="addJobForm">
		          <input type="hidden" name="addJobIni" value="haha">
		          <div class="form-group" id="job_title_error_a">
		            <label>Job Title</label>
		            <input type="text" class="form-control" name="job_title" id="job_title_a" value="<?php echo $row['job_title']; ?>" placeholder="Job Title">
		          </div>
		          <div class="form-group" id="category_error_a">
		            <label>Category</label>
		            <select name="category" class="form-control" id="category_a">
		              <option value="">Select Category</option>
		              <?php
		                $query2 = mysqli_query($conn, "select * from tbl_job_categories");
		                while($row2 = mysqli_fetch_assoc($query2)){
		                  ?>
		                    <option value="<?php echo $row2['category_name']; ?>" <?php if($row2['category_name'] == $row['category']){ echo "selected"; } ?> ><?php echo $row2['category_name']; ?></option>
		                  <?php
		                }
		              ?>
		            </select>
		          </div>
		          <div class="form-group" id="salary_error_a">
		            <label>Salary Range</label>
		            <div class="row">
		              <div class="col-md-3">
		                <input type="text" name="range1" id="range1" value="<?php echo $db_range1; ?>" class="form-control" onkeypress="return numbersonly(event)">
		              </div>
		              <div class="col-md-3">
		                <input type="text" name="range2" id="range2" value="<?php echo $db_range2; ?>" class="form-control" onkeypress="return numbersonly(event)">
		              </div>
		            </div>
		          </div>
		          <div class="form-group" id="company_name_error_a">
		            <label>Company Name</label>
		            <input type="text" class="form-control" name="company_name" id="company_name_a" value="<?php echo $row['company_name']; ?>" placeholder="Company Name">
		          </div>
		          <div class="form-group" id="email_error_a">
		            <label>Company Email</label>
		            <input type="text" class="form-control" name="email" id="email_a" value="<?php echo $row['company_email']; ?>" placeholder="Company Email">
		          </div>
		          <div class="form-group" id="contact_number_error_a">
		            <label>Company Number</label>
		            <input type="text" class="form-control" name="contact_number" id="contact_number_a" value="<?php echo $row['company_number']; ?>" placeholder="Company Number" onkeypress="return numbersonly(event)">
		          </div>
		          <div class="form-group" id="address_error_a">
		            <label>Company Address</label>
		            <input type="text" class="form-control" name="address" id="address_a" value="<?php echo $row['address']; ?>" placeholder="Company Address">
		          </div>
		          <div class="form-group" id="location_error_a">
		            <label>Location</label>
		            <select name="location" class="form-control" id="location_a">
		              <option value="">Select Location</option>
		              <?php
		                $query3 = mysqli_query($conn, "select * from tbl_job_locations");
		                while($row3 = mysqli_fetch_assoc($query3)){
		                  ?>
		                    <option value="<?php echo $row3['location_name']; ?>" <?php if($row3['location_name'] == $row['location']){ echo "selected"; } ?> ><?php echo $row3['location_name']; ?></option>
		                  <?php
		                }
		              ?>
		            </select>
		          </div>
		          <div class="form-group" id="description_error_a">
		            <label>Description</label>
		            <input type="text" class="form-control" name="description" id="description_a" value="<?php echo $row['description']; ?>" placeholder="Description">
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
	</div>
    
</section>

<?php include'php/footer.php'; ?>