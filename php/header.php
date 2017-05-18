<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
ob_start();
session_start();
include'admin/php/db_connection.php';
if(!$_SESSION['student_number']){
  header("location:index.php");
}

$prof = mysqli_query($conn, "select * from tbl_alumni where student_number=".$_SESSION['student_number']);
$row_prof = mysqli_fetch_assoc($prof);

if(empty($row_prof['alumni_picture'])){
  $row_prof_img = "admin/images/alumni_default.png";
}else{
  $row_prof_img = $row_prof['alumni_picture'];
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UPang Alumni Tracer</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="admin/dist/css/skins/skin-green-light.min.css">

    <script src="admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/plugins/bootbox/bootbox.min.js"></script>


    <style>
      .strength_meter{text-align: center;text-transform: capitalize;font-size: 13px;color: #fff;}
      .strength_meter div{margin-top: 5px;border-radius: 2px;}
      .veryweak{background: #c0392b;border-color: #c0392b!important;width: 25% !important;}
      .weak{background-color: #f39c12;border-color: #f39c12!important;width:50%!important;}
      .medium{background-color: #f1c40f;border-color: #f1c40f!important;width:75%!important;}
      .strong{background-color: #2ecc71;border-color: #2ecc71!important;width:100%!important;}
      #map {height: 100%;}
      #pac-input {background-color: #fff;font-family: Roboto;font-size: 15px;font-weight: 300;margin-left: 12px;padding: 0 11px 0 13px;text-overflow: ellipsis;width: 300px;}
      #pac-input:focus {border-color: #4d90fe;}
      .pac-container {font-family: Roboto;}
      .controls {margin-top: 10px;border: 1px solid transparent;border-radius: 2px 0 0 2px;box-sizing: border-box;-moz-box-sizing: border-box;height: 32px;outline: none;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);}
      .bg-white{background: #fff;border: 1px solid;border-color: #e5e6e9 #dfe0e4 #d0d1d5;border-radius: 3px;}
      .locsal{padding: 0;margin: 0;color: #95a5a6;padding-left: 10px}
    </style>

  </head>

  <body class="hold-transition skin-green-light layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="dashboard.php" class="navbar-brand"><b>UPang</b> iTracer</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="profile.php">Profile <span class="sr-only">(current)</span></a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="#" data-toggle="modal" data-target="#changePass">Password</a></li>
                <li><a href="help.php">Help</a></li>
              </ul>
            </div>
              <div class="navbar-custom-menu">
                <?php
                $task_query_alumni = mysqli_query($conn, "select * from tbl_alumni where student_number='".$_SESSION['student_number']."' and gender='' ") or die(mysqli_error());
                $task_query_employment = mysqli_query($conn, "select * from tbl_employment where student_number=".$_SESSION['student_number']);
                if(!empty(mysqli_num_rows($task_query_employment))){
                  $task_query_employment_count = 0;
                }else{
                  $task_query_employment_count = 1;
                }
                ?>
                <ul class="nav navbar-nav">
                  <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-flag-o"></i>
                      <span class="label label-danger"><?php echo mysqli_num_rows($task_query_alumni)+$task_query_employment_count; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have <?php echo mysqli_num_rows($task_query_alumni)+$task_query_employment_count; ?> tasks</li>
                      <li>
                        <ul class="menu">
                          <?php if(!empty(mysqli_num_rows($task_query_alumni))){ ?>
                          <li>
                            <a href="edit_profile.php">
                              <h3>
                                Update Your Profile
                              </h3>
                            </a>
                          </li>
                          <?php } ?>

                          <?php if(empty(mysqli_num_rows($task_query_employment))){ ?>
                          <li>
                            <a href="edit_employment.php">
                              <h3>
                                Update You Present Employment
                              </h3>
                            </a>
                          </li>
                          <?php } ?>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <?php
                    $notif_query = mysqli_query($conn, "select * from tbl_job_posts where student_number = '".$row_prof['student_number']."' and job_status<>0 ");
                  ?>
                  <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning"><?php echo mysqli_num_rows($notif_query); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have <?php echo mysqli_num_rows($notif_query); ?> notifications</li>
                      <li>
                        <ul class="menu">
                          <?php
                            if(!empty(mysqli_num_rows($notif_query))){
                              while($notif_row = mysqli_fetch_assoc($notif_query)){
                                ?>
                                  <li>
                                    <a href="#" style="white-space: inherit" data-toggle="modal" data-target="#notifModal" data-id="<?php echo $notif_row['job_post_id']; ?>">
                                      <i class="fa fa-black-tie text-green"></i>
                                      <?php if($notif_row['job_status'] == '1'){
                                        echo "Your Job Post request dated ".$notif_row['date_posted']." was approved.";
                                      }elseif($notif_row['job_status'] == '2'){
                                        echo "Your Job Post request dated ".$notif_row['date_posted']." was declined. Please review your post for some undesirable or invalid content";
                                      }
                                      ?>
                                    </a>
                                  </li>
                                <?php
                              }
                            }
                          ?>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="<?php echo $row_prof_img; ?>" class="user-image" alt="User Image">
                      <span class="hidden-xs"><?php echo $row_prof['firstname']." ".$row_prof['lastname']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="user-header">
                        <img src="<?php echo $row_prof_img; ?>" class="img-circle" alt="User Image">
                        <p>
                          <?php echo $row_prof['firstname']." ".$row_prof['lastname']; ?> - <?php echo $row_prof['coursecode']; ?>
                          <small>Class of <?php echo $row_prof['year_graduated']; ?></small>
                        </p>
                      </li>
                      <li class="user-footer">
                        <div>
                          <a href="php/logout.php" class="btn btn-default btn-block btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
          </div>
        </nav>
      </header>

      <div class="content-wrapper">
        <div class="container">
