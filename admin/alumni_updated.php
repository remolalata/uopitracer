<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<?php
  if(isset($_POST['sendEmail'])){
    $student_number = $_POST['student_number'];
    $message = $_POST['message'];

    $query3 = mysqli_query($conn, "select * from tbl_alumni where student_number=".$student_number);
    $row3 = mysqli_fetch_assoc($query3);
    $email = $row3['email_add'];

    require("php/PHPMailer-master/PHPMailerAutoload.php"); 
    ini_set("SMTP","ssl://smtp.gmail.com"); 
    ini_set("smtp_port","465"); 
    $mail = new PHPMailer();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com"; 
    $mail->SMTPSecure = "ssl";
    $mail->Username = "remo.lalata2@gmail.com"; 
    $mail->Password = "remolalata1995new"; 
    $mail->FromName = 'rgaquino@up.phinma.edu.ph';
    $mail->Port = "465";
    $mail->isSMTP();
    $rec1="$email";
    $mail->AddAddress($rec1);
    $mail->Subject  = "UPang Alumni Tracer";
    $mail->Body     = "$message";
    $mail->WordWrap = 200;
    if(!$mail->Send()) {
    echo 'Message was not sent!.';
    echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
    echo
    "<script>
      bootbox.alert('Email Sent');;
      open('alumni_updated.php', '_self');
    </script>";
    }
  }

  if(isset($_POST['sendSms'])){   
    $message = $_POST['message'];

    $query2 = mysqli_query($conn, "select * from tbl_alumni where student_number=".$_POST['student_number']);
    $row2 = mysqli_fetch_assoc($query2);

    $mobile_number = $row2['mobile_number'];

    $result = itexmo("$mobile_number","$message","09778173500_RXQPA");
      if ($result == ""){
        echo "iTexMo: No response from server!!! <br>
        Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
        Please <a href=\"https://www.itexmo.com/contactus.php\">CONTACT US</a> for help. "; 
      }else if ($result == 0){
        echo "
          <script>
            bootbox.alert('Message Sent');;
            open('alumni_updated.php', '_self');
          </script>
        ";
      }
      else{ 
        echo "Error Num ". $result . " was encountered!";
      }
  }

  if(isset($_GET['sms'])){
    $query4 = mysqli_query($conn, "select a.* from tbl_alumni a left join tbl_employment b on a.student_number = b.student_number where b.student_number is null");
    while($row4 = mysqli_fetch_assoc($query4)){
      $message = "Default message for all";

      $mobile_number = $row4['mobile_number'];

      $result = itexmo("$mobile_number","$message","09778173500_RXQPA");
        if ($result == ""){
          echo "iTexMo: No response from server!!! <br>
          Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
          Please <a href=\"https://www.itexmo.com/contactus.php\">CONTACT US</a> for help. "; 
        }else if ($result == 0){
          echo "
            <script>
              bootbox.alert('Message Sent');;
              open('alumni_updated.php', '_self');
            </script>
          ";
        }
        else{ 
          echo "Error Num ". $result . " was encountered!";
        }
    }
  }

  if(isset($_GET['email'])){
    $query5 = mysqli_query($conn, "select a.* from tbl_alumni a left join tbl_employment b on a.student_number = b.student_number where b.student_number is null");
    while($row5 = mysqli_fetch_assoc($query5)){
      $email = $row5['email_add'];

      require("php/PHPMailer-master/PHPMailerAutoload.php"); 
      ini_set("SMTP","ssl://smtp.gmail.com"); 
      ini_set("smtp_port","465"); 
      $mail = new PHPMailer();
      $mail->SMTPAuth = true;
      $mail->Host = "smtp.gmail.com"; 
      $mail->SMTPSecure = "ssl";
      $mail->Username = "remo.lalata2@gmail.com"; 
      $mail->Password = "remolalata1995new";
      $mail->FromName = 'rgaquino@up.phinma.edu.ph';
      $mail->Port = "465";
      $mail->isSMTP();  
      $rec1="$email";
      $mail->AddAddress($rec1);
      $mail->Subject  = "UPang Alumni Tracer";
      $mail->Body     = "Default message for all";
      $mail->WordWrap = 200;
      if(!$mail->Send()) {
      echo 'Message was not sent!.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
      } else {
      echo
      "<script>
        bootbox.alert('Email Sent');;
        open('alumni_updated.php', '_self');
      </script>";
      }
    }
  }
?>

<section class="content-header">
  <h1>
    Alumni
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li><a href="alumni_manage.php"><i class="fa fa-user"> </i> Alumni List</a></li>
    <li class="active">Updated Profile</li>
  </ol>
</section>

<?php if($row_prof['user_level'] == "Co-admin"){ include'partials/alumni_updated.php'; }else{ ?>
<section class="content">

  <div class="box box-success">

    <div class="box-header with-border">
      <h3></h3>
      <div class="box-tools pull-right">
        <div class="dropdown">
          <button class="btn btn-success btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Notify All User
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?sms">Sms Notification</a></li>
            <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?email">Email Notification</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="box-body">
      <table id="alumniUpdatedTbl" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Student Number</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Course</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($conn, "select a.* from tbl_alumni a left join tbl_employment b on a.student_number = b.student_number where b.student_number is null");
            while($row = mysqli_fetch_assoc($query)){
              ?>
                <tr>
                  <td><?php echo $row['student_number']; ?></td>
                  <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                  <td><?php echo $row['year_graduated']; ?></td>
                  <td><?php echo $row['coursecode']; ?></td>
                  <td align="center">
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#sendSmsModal" data-id="<?php echo $row['student_number']; ?>" title="Send Message"><i class="fa fa-send"></i></button>
                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#sendEmailModal" data-idd="<?php echo $row['student_number']; ?>" title="Send Email"><i class="fa fa-envelope"></i></button>
                  </td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
      
    </div>

  </div>

</section>
<?php } ?>

<div class="modal fade" id="sendSmsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send Sms Notification</h4>
      </div>
      <div class="modal-body">
        <form method="post">
        <input type="hidden" id="student_number" name="student_number">
        <textarea class="textarea" name="message" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">Default Message</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name="sendSms" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send Email Notification</h4>
      </div>
      <div class="modal-body">
        <form method="post">
        <input type="hidden" id="student_number" name="student_number">
        <textarea class="textarea" name="message" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">Default Message</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name="sendEmail" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    $(".textarea").wysihtml5();
  });
</script>

<?php include'php/footer.php'; ?>
      
