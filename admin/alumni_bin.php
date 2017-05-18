<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<style>
  .no-sort::after { display: none!important; }
</style>

<?php

if(isset($_POST['restoreBtn'])){
  $student_number = $_POST['student_number'];
  $query2 =  mysqli_query($conn, "select * from tbl_alumni_backup_list where student_number='$student_number'");
  $row2 = mysqli_fetch_assoc($query2);
  mysqli_query($conn, "insert into tbl_alumni values('".$row2['student_number']."', '".$row2['password']."', '".$row2['lastname']."', '".$row2['firstname']."', '".$row2['middlename']."', '".$row2['email_add']."', '".$row2['coursecode']."', '".$row2['college']."', '".$row2['year_graduated']."', '".$row2['alumni_picture']."', '".$row2['gender']."', '".$row2['birthdate']."', '".$row2['mobile_number']."', '".$row2['religion']."', '".$row2['address']."', '".$row2['father_name']."', '".$row2['father_birthdate']."', '".$row2['father_birthdate']."', '".$row2['mother_name']."', '".$row2['mother_birthdate']."', '".$row2['mother_occupation']."', '".$row2['secondary_school']."', '".$row2['secondary_year_graduated']."', '".$row2['primary_school']."', '".$row2['primary_year_graduated']."', '".$row2['date_updated']."')");
  mysqli_query($conn, "delete from tbl_alumni_backup_list where student_number='$student_number'");
  $_SESSION['alert'] = 6;
  header('Location: alumni_manage.php');
}

if(isset($_POST['restoreAllBtn'])){
  foreach ($_POST['check'] as $key => $value) {
    $query2 =  mysqli_query($conn, "select * from tbl_alumni_backup_list where student_number='$value'");
    $row2 = mysqli_fetch_assoc($query2);
    mysqli_query($conn, "insert into tbl_alumni values('".$row2['student_number']."', '".$row2['password']."', '".$row2['lastname']."', '".$row2['firstname']."', '".$row2['middlename']."', '".$row2['email_add']."', '".$row2['coursecode']."', '".$row2['college']."', '".$row2['year_graduated']."', '".$row2['alumni_picture']."', '".$row2['gender']."', '".$row2['birthdate']."', '".$row2['mobile_number']."', '".$row2['religion']."', '".$row2['address']."', '".$row2['father_name']."', '".$row2['father_birthdate']."', '".$row2['father_birthdate']."', '".$row2['mother_name']."', '".$row2['mother_birthdate']."', '".$row2['mother_occupation']."', '".$row2['secondary_school']."', '".$row2['secondary_year_graduated']."', '".$row2['primary_school']."', '".$row2['primary_year_graduated']."', '".$row2['date_updated']."')");
    mysqli_query($conn, "delete from tbl_alumni_backup_list where student_number='$value'");
  }
  $_SESSION['alert'] = 6;
  header('Location: alumni_manage.php');
}

?>

<section class="content-header">
  <h1>
    Alumni Trash
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li><a href="alumni_manage.php"><i class="fa fa-user"> </i> Alumni List</a></li>
    <li class="active">Alumni Bin</li>
  </ol>
</section>

<section class="content">

  <div class="box box-success">

    <div class="box-body">
      <table id="alumniTbl" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th align="center" class="no-sort" style="text-align: right"></th>
            <th>Student Number</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Course</th>
            <th>College</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php

          $query = mysqli_query($conn, "select * from tbl_alumni_backup_list");
          while($row = mysqli_fetch_assoc($query)){
            ?>
            <tr>
              <td align="center"><input type="checkbox" name="check[]" value="<?php echo $row['student_number']; ?>" form="restoreAll"></td>
              <td><?php echo $row['student_number']; ?></td>
              <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
              <td><?php echo $row['year_graduated']; ?></td>
              <td><?php echo $row['coursecode']; ?></td>
              <td>
                <?php 
                  $college = mysqli_fetch_assoc(mysqli_query($conn, "select * from tbl_courses where coursecode='".$row['coursecode']."'")) or die(mysqli_error());
                  echo $college['college'];
                ?>
              </td>
              <td align="center">
                <form method="post">
                  <input type="hidden" name="student_number" value="<?php echo $row['student_number']; ?>">
                  <button type="submit" name="restoreBtn" class="btn btn-success btn-sm"><i class="fa fa-repeat"></i></button>
                </form>
              </td>
            </tr>
            <?php
          }

          ?>
        </tbody>
        <tfoot>
          <th align="center" style="text-align: center">
            <input type="checkbox" class="flat-red" id="select-all" name="select-all">
          </th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <td align="center">
            <form id="restoreAll" method="post">
              <button type="submit" name="restoreAllBtn" class="btn btn-success btn-sm"><i class="fa fa-repeat"></i></button>
            </form>
          </td>
        </tfoot>
      </table>
    </div>

  </div>

</section>


<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<?php include'php/footer.php'; ?>
      
