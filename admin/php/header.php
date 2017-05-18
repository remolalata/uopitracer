<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Manila');
include'php/db_connection.php';
include'php/functions.php';
if(!$_SESSION['id']){
  header("location:index.php");
}

$row_prof = mysqli_fetch_assoc(mysqli_query($conn, "select * from tbl_admin where id=".$_SESSION['id'])) or die(mysqli_error());
$url = "/admin/";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UPANG Alumni Tracer</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="../images/logo.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/bootbox/bootbox.min.js"></script>
  </head>
  <body class="hold-transition skin-green sidebar-mini">

    <div class="wrapper">

      <header class="main-header">

        <a href="#" class="logo">

          <span class="logo-mini"><b>UoP</b></span>

          <span class="logo-lg"><b>UPang iTracer</b></span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <?php
                $notif_query = mysqli_query($conn, "select a.*, b.student_number, b.firstname, b.lastname from tbl_job_posts a, tbl_alumni b where a.if_job_posted_by_alumni=1 and a.student_number = b.student_number and job_status=0  order by a.job_post_id desc") or die(mysqli_error());
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
                        if(empty(mysqli_num_rows($notif_query))){
                          while($notif_row = mysqli_fetch_assoc($notif_query)){
                            ?>
                            <li>
                              <a href="jobs.php?do=2&show=<?php echo $notif_row['job_post_id']; ?>" style="white-space: inherit">
                                <i class="fa fa-black-tie text-green"></i> <strong><?php echo $notif_row['firstname']." ".$notif_row['lastname']; ?></strong> requested for job post approval.
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
                  <img src="<?php echo $row_prof['user_image']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $row_prof['firstname']." ".$row_prof['lastname']; ?></span>
                </a>
                <ul class="dropdown-menu">

                  <li class="user-header" style="height: 145px">
                    <img src="<?php echo $row_prof['user_image']; ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $row_prof['firstname']." ".$row_prof['lastname']; ?>
                    </p>
                  </li>

                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="account.php" class="btn btn-default btn-flat">Account</a>
                    </div>
                    <div class="pull-right">
                      <a href="php/logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">

        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li <?php if($_SERVER['PHP_SELF'] == $url."dashboard.php"){ echo "class='active'"; } ?> ><a href="dashboard.php"><i class="fa fa-dashboard"> </i> <span>Dashboard</span></a></li>
            <li <?php if($_SERVER['PHP_SELF'] == $url."alumni_manage.php" || $_SERVER['PHP_SELF'] == $url."alumni_profile.php"){ echo "class='active'"; } ?> ><a href="alumni_manage.php"><i class="fa fa-user"> </i> <span>Alumni</span></a></li>
            <li <?php if($_SERVER['PHP_SELF'] == $url."news_events.php"){ echo "class='active'"; } ?> ><a href="news_events.php"><i class="fa fa-newspaper-o"> </i> <span>News & Events</span></a></li>
            <li <?php if($_SERVER['PHP_SELF'] == $url."map.php"){ echo "class='active'"; } ?> ><a href="map.php"><i class="fa fa-map"> </i> <span>Map</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-institution"></i> <span>College</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php
                  $college_query = mysqli_query($conn, "select * from tbl_college");
                  if($row_prof['user_level'] == "Co-admin"){
                    $college_query = mysqli_query($conn, "select * from tbl_college where collegecode='".$row_prof['college']."'");
                  }
                  while($college_row = mysqli_fetch_assoc($college_query)){
                    $count_college_courses = mysqli_query($conn, "select * from tbl_courses where college='".$college_row['collegecode']."' ");
                    ?>
                      <li><a href="college.php?college=<?php echo strtolower($college_row['collegecode']); ?>"><i class="fa fa-circle-o"> </i> <span><?php echo $college_row['collegecode']; ?></span> <small class="label pull-right bg-green"><?php echo mysqli_num_rows($count_college_courses); ?></small></a></li>
                    <?php
                  }
                ?>
                <?php if($row_prof['user_level'] == "Superadmin"){ ?>
                <li><a href="add_college.php"><i class="fa fa-plus"> </i> Add College</a></li>
                <li><a href="view_college.php"><i class="fa fa-eye"> </i> View All</a></li>
                <?php } ?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-black-tie"></i> <span>Jobs</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="jobs.php?do=1"><i class="fa fa-circle-o"></i> View Jobs</a></li>
                <?php if($row_prof['user_level'] == "Superadmin"){ ?>
                <li><a href="jobs.php?do=2"><i class="fa fa-circle-o"></i> <span>View Pending Jobs</span> <small class="label pull-right bg-green"><?php echo mysqli_num_rows(mysqli_query($conn, "select * from tbl_job_posts where job_status=0")); ?></small></a></li>
                <?php } ?>
                <li><a href="jobs.php?do=3"><i class="fa fa-circle-o"></i> Post a Job</a></li>
              </ul>
            </li>

            <?php if($row_prof['user_level'] == "Superadmin"){ ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Setting</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="php/db_backup.php"><i class="fa fa-circle-o"> </i> <span>Back Up DB</span></a>
                <li><a href="user_admin.php"><i class="fa fa-circle-o"> </i> <span>Admin Users</span></a>
                <li><a href="php/admin_logs.php"><i class="fa fa-circle-o"> </i><span>Admin Logs</span></a></li>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </section>

      </aside>

      <div class="content-wrapper">