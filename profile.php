<?php include'php/header.php'; ?>

<?php
	$query = mysqli_query($conn, "select * from tbl_employment where student_number=".$_SESSION['student_number']);
	$row = mysqli_fetch_assoc($query);

  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
    echo "
      <script>
         bootbox.alert('You successfully updated your account')
      </script>
    ";
    $_SESSION['alert'] = 0;
  }
  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
    echo "
      <script>
         bootbox.alert('You successfully updated your employment status')
      </script>
    ";
    $_SESSION['alert'] = 0;
  }
?>


<section class="content-header">
  <h1>
   Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Profile</li>
  </ol>
</section>

<section class="content">

          <div class="row">
            <div class="col-md-3">

              <div class="box box-success">
                <div class="box-body box-profile">
                  	<img class="profile-user-img img-responsive img-circle" src="<?php echo $row_prof_img; ?>" alt="User profile picture" style="width: 160px; height: 160px">
                  	<h3 class="profile-username text-center"><?php echo $row_prof['firstname']." ".$row_prof['lastname']; ?></h3>
                  	<p class="text-muted text-center"><?php echo $row_prof['email_add']; ?></p>
                  	<p class="text-muted text-center">Class of <?php echo $row_prof['year_graduated']; ?></p>
					<p class="text-muted text-center"><?php echo $row_prof['coursecode']; ?></p>
                </div>
              </div>

              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                  <div class="box-tools pull-right">
	                    <span class="pull-right"><a href="edit_employment.php" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit Employment Detail"><i class="fa fa-edit"></i></a></span>
	               </div>
                </div>
                <div class="box-body">
                  <strong><i class="fa fa-black-tie margin-r-5"></i>  Work</strong>
                  <p class="text-muted">
                    <?php
                    	if(empty($row['job_title']) && empty($row['company_name']) && empty($row['year_employed'])){
                    		if($row['employment_status'] == "Unemployed"){
                    			echo "Unemployed";
                    		}else{
                    			echo "<h4><strong><em>not set</em></strong></h4>";
                    		}
                    	}else{
                    		echo "Working as ".$row['job_title']." from ".$row['company_name']." since ".$row['year_employed'];
                    	}
                    ?>
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                  <p class="text-muted">
                  	<?php
                  		if(empty($row['company_address'])){
                  			echo "<h4><strong><em>not set</em></strong></h4>";
                  		}else{
                  			if($row['employment_status'] == "Unemployed"){
                  				echo "N/A";
                  			}else{
                  				echo $row['company_address'];
                  			}
                  		}
                  	?>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-md-9">
              <div class="box box-success">
              	<div class="box-header with-border">
					<h3 class="box-title">Personal Information</h3>
					<div class="box-tools pull-right">
	                    <span class="pull-right"><a href="edit_profile.php" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Add/Edit Profile"><i class="fa fa-edit"></i></a></span>
	                </div>
				</div>
                <div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<p>Student Number</p>
							<h4><?php echo $row_prof['student_number']; ?></h4>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-4 col-sm-4">
							<p>Gender</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['gender'])){
										echo "not set";
									}else{
										echo $row_prof['gender'];
									}
								?>
							</em></strong></h4>
						</div>
						<div class="col-md-4 col-sm-4">
							<p>Birthdate</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['birthdate'])){
										echo "not set";
									}else{
										echo $row_prof['birthdate'];
									}
								?>
							</em></strong></h4>
						</div>
						<div class="col-md-4 col-sm-4">
							<p>Religion</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['religion'])){
										echo "not set";
									}else{
										echo $row_prof['religion'];
									}
								?>
							</em></strong></h4>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-8 col-sm-8">
							<p>Address</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['address'])){
										echo "not set";
									}else{
										echo $row_prof['address'];
									}
								?>
							</em></strong></h4>
						</div>

						<div class="col-md-4 col-sm-4">
							<p>Mobile Number</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['mobile_number'])){
										echo "not set";
									}else{
										echo $row_prof['mobile_number'];
									}
								?>
							</em></strong></h4>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-4 col-sm-4">
							<p>Father's Name</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['father_name'])){
										echo "not set";
									}else{
										echo $row_prof['father_name'];
									}
								?>
							</em></strong></h4>
						</div>
						<div class="col-md-4 col-sm-4">
							<p>Father's Birthdate</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['father_birthdate'])){
										echo "not set";
									}else{
										echo $row_prof['father_birthdate'];
									}
								?>
							</em></strong></h4>
						</div>
						<div class="col-md-4 col-sm-4">
							<p>Father's Occupation</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['father_occupation'])){
										echo "not set";
									}else{
										echo $row_prof['father_occupation'];
									}
								?>
							</em></strong></h4>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-4 col-sm-4">
							<p>Mother's Name</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['mother_name'])){
										echo "not set";
									}else{
										echo $row_prof['mother_name'];
									}
								?>
							</em></strong></h4>
						</div>
						<div class="col-md-4 col-sm-4">
							<p>Mother's Birthdate</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['mother_birthdate'])){
										echo "not set";
									}else{
										echo $row_prof['mother_birthdate'];
									}
								?>
							</em></strong></h4>
						</div>
						<div class="col-md-4 col-sm-4">
							<p>Mother's Occupation</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['mother_occupation'])){
										echo "not set";
									}else{
										echo $row_prof['mother_occupation'];
									}
								?>
							</em></strong></h4>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-8 col-sm-8">
							<p>Secondary School</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['secondary_school'])){
										echo "not set";
									}else{
										echo $row_prof['secondary_school'];
									}
								?>
							</em></strong></h4>
						</div>
						<div class="col-md-4 col-sm-4">
							<p>Year Graduated</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['secondary_year_graduated'])){
										echo "not set";
									}else{
										echo $row_prof['secondary_year_graduated'];
									}
								?>
							</em></strong></h4>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-8 col-sm-8">
							<p>Primary School</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['primary_school'])){
										echo "not set";
									}else{
										echo $row_prof['primary_school'];
									}
								?>
							</em></strong></h4>
						</div>
						<div class="col-md-4 col-sm-4">
							<p>Year Graduated</p>
							<h4><strong><em>
								<?php
									if(empty($row_prof['primary_year_graduated'])){
										echo "not set";
									}else{
										echo $row_prof['primary_year_graduated'];
									}
								?>
							</em></strong></h4>
						</div>
					</div>

                </div>
              </div>
            </div>
          </div>

        </section>

<?php include'php/footer.php'; ?>