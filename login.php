<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UPANG Alumni Tracer</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/plugins/css/font-awesome.min.css">
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
    <div class="login-box" style="margin-top: 20px">
      <div class="login-logo">
        <img src="images/logo.png" width="200" height="200">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="post" action="php/alumni_login_validation.php">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="student_number" placeholder="Student Number">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6 text-right">
                <a href="#" style="font-size: 13px; margin-top: 5px" data-toggle="modal" data-target="#forgotPass">I forgot my password</a><br>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="forgotPass">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Forgot your Password?</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="php/forgotpass.php" id="resetPassForm">
            <p>If you have forgotten your password, please enter your account's email address below and click the "Reset My Password" button. You will recievean email that contains a link to set a new password.</p>
            <div class="well">
              <div class="form-group" id="email_error">
                <label>Email Address</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="resetPass()" class="btn btn-success">Reset My Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
    session_start();
    if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
      echo "
        <script>
          bootbox.alert('Invalid Login!')
        </script>
      ";
      $_SESSION['alert'] = 0;
    }
    if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
      echo "
        <script>
          bootbox.alert('Email has been Sent.')
        </script>
      ";
      $_SESSION['alert'] = 0;
    }
    ?>

    <script>
      function resetPass(){
        var emails = document.getElementById("email").value;
        $.ajax({
          type: "POST",
          url: "php/ajax/checkemail.php",
          data: 'id='+encodeURIComponent(emails),
          dataType: 'json',
          success: function(msg){

            console.log(msg.count);

            if(emails == ""){
              $("#email_error").addClass("has-error");
              $("#email_error label").html("Email Address is empty");
            }else if(msg.count == 0){
              $("#email_error").addClass("has-error");
              $("#email_error label").html("Email Address is invalid");
            }else{
              document.getElementById("resetPassForm").submit();
            }

          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
          }
         });
      }
    </script>
  </body>
</html>
