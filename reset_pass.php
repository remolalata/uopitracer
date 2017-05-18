<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UPANG Alumni Tracer</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">

    <script src="admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/plugins/bootbox/bootbox.min.js"></script>
    <style>
      .login-page{background: #00601c}
    </style>
  </head>
  <body class="hold-transition login-page">

  	<?php
		session_start();
		include'admin/php/db_connection.php';

		if(isset($_POST['password'])){
			$id_email = $_GET['id'];
			$password = md5($_POST['password']);
			$query = mysqli_query($conn, "select * from tbl_alumni");
			while($row = mysqli_fetch_assoc($query)){
				if(md5($row['email_add']) == $id_email){
					mysqli_query($conn, "update tbl_alumni set password = '$password' where student_number = '".$row['student_number']."' ");
					echo "
						<script>
					  		$(document).ready(function($) {
					  			$('#myModal').modal('show');
					  		})
					  	</script>
					";
				}
			}
		}
	?>
    <div class="login-box" style="margin-top: 20px">
      <div class="login-logo" style="visibility: hidden">
        <img src="images/logo.png" width="200" height="100">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Reset Your Password</p>
        <div class="form-group has-error hidden" id="error">
        	<label></label>
        </div>
        <form method="post" id="resetPassForm">
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirm New Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-6">
            </div><!-- /.col -->
            <div class="col-xs-6">
              <button type="button" onclick="checkPass()" class="btn btn-success btn-block btn-flat">Reset Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Reset Password</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="php/forgotpass.php">
            <p>You have successfully change your password.</p>
          </div>
          <div class="modal-footer">
            <a href="login.php" class="btn btn-success">Go to Login Page</a>
          </div>
        </div>
      </div>
    </div>

    <script>
    	function checkPass(){
    		if(document.getElementById("password").value == ""){
    			$("#error").removeClass("hidden");
    			$("#error label").html("Password is empty");
    		}else if(document.getElementById("confirmpassword").value == ""){
    			$("#error").removeClass("hidden");
    			$("#error label").html("Confirm Password is empty");
    		}else if(document.getElementById("password").value != document.getElementById("confirmpassword").value){
    			$("#error").removeClass("hidden");
    			$("#error label").html("Password did not match.");
    		}else{
    			document.getElementById("resetPassForm").submit();
    		}    		
    	}
    </script>
  </body>
</html>

