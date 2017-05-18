<?php include'php/header.php'; ?>

<?php

if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
	echo "
		<script>
		bootbox.alert('Account Updated')
		</script>
		";
	$_SESSION['alert'] = 0;
}

?>

<style>
	h5{margin: 0;}
	.strength_meter{text-align: center;text-transform: capitalize;font-size: 13px;color: #fff;}
	.strength_meter div{margin-top: 5px;border-radius: 2px;}
	.veryweak{background: #c0392b;border-color: #c0392b!important;width: 25% !important;}
	.weak{background-color: #f39c12;border-color: #f39c12!important;width:50%!important;}
	.medium{background-color: #f1c40f;border-color: #f1c40f!important;width:75%!important;}
	.strong{background-color: #2ecc71;border-color: #2ecc71!important;width:100%!important;}
</style>

<div class="col-md-9 col-md-offset-1" style="margin-bottom: 10px;">
	<section class="content-header">
		<h1>
			My Account
		</h1>
		<ol class="breadcrumb">
			<li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
			<li class="active">Account</li>
		</ol>
	</section>	
</div>

<?php
	$query = mysqli_query($conn, "select * from tbl_admin where id=".$_SESSION['id']);
	$row = mysqli_fetch_assoc($query);
?>

<section class="content">
	<div class="row">
		<div class="col-md-9 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-body">
					<form id="updateForm" method="post" enctype="multipart/form-data"></form>
					<form id="changepasswordForm" method="post"></form>
					
					<input type="hidden" name="updateFormIni" form="updateForm" value="update">
					<div class="col-md-3">
						<img src="<?php echo $row['user_image']; ?>" id="image_upload_preview" width="160" height="160" class="img-circle" alt="User Image"><br><br>
						<input type="file" name="file" id="inputFile" form="updateForm">
					</div>

					<div class="col-md-9">
						<div class="form-group" id="firstname_error">
							<label>First Name</label>
							<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" form="updateForm">
						</div>

						<div class="form-group" id="lastname_error">
							<label for="lastname">Last Name</label>
							<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" form="updateForm">
						</div>	

						<div class="form-group" id="email_error">
							<label for="lastname">Email Address</label>
							<input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" form="updateForm">
						</div>

						<div class="form-group" id="username_error">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" form="updateForm">
						</div>	

						<div class="form-group">
							<label for="password">Password <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="font-size: 12px;">Edit</a></label>
							<input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" form="updateForm" readonly >
							<div id="collapseOne" class="panel-collapse collapse">
		                        <div class="box-body">
		                        	<blockquote>
		                        		<h5 class="text-red" id="changepasswordText"></h5>
		                        		<div class="form-group">
		                        			<label for="oldpassword"><h5>Old Password: </h5></label>
		                        			<input type="password" class="form-control input-sm" id="oldpassword" name="oldpassword" placeholder="Old Password" form="changepasswordForm">
		                        		</div>
		                        		<div class="form-group">
		                        			<label for="newpassword"><h5>New Password: </h5></label>
		                        			<input type="password" class="form-control input-sm" id="newpassword" name="newpassword" placeholder="New Password" form="changepasswordForm">
		                        		</div>
		                        		<div class="form-group">
		                        			<button type="submit" name="changepasswordBtn" class="btn btn-sm btn-danger" form="changepasswordForm">Change Password</button>
		                        		</div>
									</blockquote>
		                        </div>
		                      </div>
						</div>
					</div>

					<div class="text-right">
						<button type="button" onclick="updateAccountBtn()" class="btn btn-success" style="margin-right: 15px;" form="updateForm">Update</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	if(isset($_POST['updateFormIni'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		$storedFile="images/admin/".basename($_FILES["file"]["name"]);
		move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
		if($storedFile == "images/admin/"){
			$query2 = mysqli_query($conn, "select * from tbl_admin where id=".$_SESSION['id']);
			$row2 = mysqli_fetch_assoc($query2);
			$storedFile = $row2['user_image'];
		}
		mysqli_query($conn, "update tbl_admin set firstname='$firstname', lastname='$lastname', email='$email', username='$username', password='$password', user_image='$storedFile' where id=".$_SESSION['id']) or die(mysqli_error());
		$_SESSION['alert'] = 1;
		header('location: account.php');

	}

	if(isset($_POST['changepasswordBtn'])){
		$oldpassword = md5($_POST['oldpassword']);
		$newpassword = $_POST['newpassword'];

		if($oldpassword != $_SESSION['password']){
			echo "
			<script>
				document.getElementById('changepasswordText').innerHTML='Old Password is incorrect.';
				document.getElementById('collapseOne').className += 'in';
			</script>
			";
		}else{
			echo "
			<script>
				document.getElementById('password').value = '".md5($newpassword)."'
			</script>
			";
		}
	}
?>

<script src="../js/strength.min.js"></script>
<script>
	$(document).ready(function($) {
	
		$('#newpassword').strength({
	        strengthClass: 'strength',
	        strengthMeterClass: 'strength_meter',
	        strengthButtonClass: '',
	        strengthButtonText: '',
	        strengthButtonTextToggle: ''
	    });

	});
</script>

<?php include'php/footer.php'; ?>
      
