<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php

if(isset($_POST['addAdminIni'])){
  $firstname = strtoupper($_POST['firstname']);
  $lastname = strtoupper($_POST['lastname']);
  $password = md5($lastname);
  $username = $_POST['username'];
  $college = $_POST['college'];
  $email = $_POST['email'];

  $storedFile="images/admin/".basename($_FILES["file"]["name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
  if($storedFile == "images/admin/"){
    $storedFile = "images/admin_default.png";
  }
  $name = $_SESSION['firstname']." ".$_SESSION['lastname'];
  $date = date('M d Y - h:i A');
  mysqli_query($conn, "insert into tbl_admin_logs(name, user_level, action, date) values('$name', '".$auser_level."', 'logged out', '$date')") or die(mysqli_error());
  mysqli_query($conn, "insert into tbl_admin(username, password, firstname, lastname, email, user_level, college, user_image) values('$username', '$password', '$firstname', '$lastname', '$email', 'Co-admin', '$college', '$storedFile')") or die(mysqli_error());
  $_SESSION['alert'] = 1;
}

if(isset($_POST['adminDeleteBtn'])){
  $id = $_POST['id'];
  mysqli_query($conn, "delete from tbl_admin where id=".$id);
  $_SESSION['alert'] = 2;
}

if(isset($_POST['editAdminBtn'])){
  $id = $_GET['edit'];
  $firstname = strtoupper($_POST['firstname']);
  $lastname = strtoupper($_POST['lastname']);
  $password = md5($_POST['lastname']);
  $username = $_POST['username'];
  $college = $_POST['college'];

  $storedFile="images/admin/".basename($_FILES["file"]["name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);

  if($storedFile == "images/admin/"){
    $storedFile = $_POST['img'];
  }

  mysqli_query($conn, "update tbl_admin set username='$username', firstname='$firstname', lastname='$lastname', college='$college', user_image='$storedFile' where id=".$_GET['edit']);
  $_SESSION['alert'] = 3;
}

if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
  echo "
    <script>
    bootbox.alert('Co Admin Registered')
    </script>
    ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
  echo "
    <script>
    bootbox.alert('Co Admin Deleted')
    </script>
    ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 3){
  echo "
    <script>
    bootbox.alert('Co Admin Record Updated')
    </script>
    ";
  $_SESSION['alert'] = 0;
}

?>

<?php if(isset($_GET['edit'])){ ?>

  <?php
    $query2 = mysqli_query($conn, "select * from tbl_admin where id=".$_GET['edit']);
    if(empty(mysqli_num_rows($query2))){
      include'404.html';
    }else{
      $row2 = mysqli_fetch_assoc($query2);
      ?>
        <div class="row">
          <div class="col-md-9 col-md-offset-1">
            <section class="content-header">
              <h1>
                Admin Users
              </h1>
              <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
                <li><a href="user_admin.php"><i class="fa fa-user"> </i> Admin User</a></li>
                <li class="active">Edit Admin User</li>
              </ol>
            </section>
          </div>
        </div>
      
        <section class="content">
          <div class="row">
            <div class="col-md-9 col-md-offset-1">
              <div class="box box-success">
                <div class="box-body">
                  <form method="post" enctype="multipart/form-data">
                    
                  <div class="col-md-3">
                    <input type="hidden" name="img" value="<?php echo $row2['user_image']; ?>">
                    <img src="<?php echo $row2['user_image']; ?>" id="image_upload_preview" width="160" height="160" class="img-circle" alt="User Image"><br><br>
                    <input type="file" name="file" id="inputFile">
                  </div>

                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="firstname">First Name</label>
                      <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row2['firstname']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="lastname">Last Name</label>
                      <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row2['lastname']; ?>">
                    </div>  

                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" value="<?php echo $row2['username']; ?>">
                    </div>  

                    <div class="form-group">
                      <label for="username">College</label>
                      <select name="college" class="form-control">
                        <option value="">Select</option>
                        <?php
                          $query3 = mysqli_query($conn, "select * from tbl_college");
                          while($row3 = mysqli_fetch_assoc($query3)){
                            ?>
                            <option value="<?php echo $row3['collegecode']; ?>" <?php if($row3['collegecode'] == $row2['college']){ echo "selected"; } ?> ><?php echo $row3['collegecode']; ?></option>
                            <?php
                          }
                        ?>
                      </select>
                    </div>  

                    <div class="text-right">
                      <button type="submit" name="editAdminBtn" class="btn btn-success" style="margin-right: 15px;" >Update</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </section>
      <?php
    }
  ?>

<?php }else{ ?>

  <section class="content">
    <div class="box box-success">
      <div class="box-header with-border">
            <h3></h3>
            <div class="box-tools pull-right">
              <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAdminModal">Add Admin</a>
            </div>
          </div>
      <div class="box-body">
        <table id="adminUserTbl" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>User Level</th>
              <th>College</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <?php
              $query = mysqli_query($conn, "select * from tbl_admin where id<>".$_SESSION['id']);
              while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                  <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                  <td><?php echo $row['user_level']; ?></td>
                  <td><?php echo $row['college']; ?></td>
                  <td align="center">
                    <form method="post">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                      <a href="user_admin.php?edit=<?php echo $row['id']; ?>" class="btn btn-default btn-sm" ><i class="fa fa-pencil"></i></a>
                      <button type="submit" name="adminDeleteBtn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
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
 
<div class="modal fade" tabindex="-1" role="dialog" id="addAdminModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Admin</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="addAdminForm">
          <input type="hidden" name="addAdminIni" value="add">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="firstname_error_a">
                <label>First Name</label>
                <input type="text" name="firstname" id="firstname_a" class="form-control" placeholder="First Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="lastname_error_a">
                <label>Last Name</label>
                <input type="text" name="lastname" id="lastname_a" class="form-control" placeholder="Last Name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="username_error_a">
                <label>Username</label>
                <input type="text" name="username" id="username_a" class="form-control" placeholder="Username">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" id="college_error_a">
                <label>College</label>
                <select name="college" id="college_a" class="form-control">
                  <option value="">Select</option>
                  <?php
                    $col_query = mysqli_query($conn, "select * from tbl_college");
                    while($col_row = mysqli_fetch_assoc($col_query)){
                      echo "<option value='".$col_row['collegecode']."'>".$col_row['collegecode']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="email_error_a">
                <label>Email Address</label>
                <input type="text" name="email" id="email_a" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="file">
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addAdminBtn()" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<?php include'php/footer.php'; ?>




