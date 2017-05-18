<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<style>
  .no-sort::after { display: none!important; }
  #alumniTbl_filter{display: none;}
</style>

<?php

function courses(){
  include'php/db_connection.php';
  $result = array();
  $query = mysqli_query($conn, "select * from tbl_courses");
  while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
  }
  return $result;
}

function colleges(){
  include'php/db_connection.php';
  $result = array();
  $query = mysqli_query($conn, "select * from tbl_college");
  while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
  }
  return $result;
}

if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
  echo "
    <script>
      bootbox.alert('Alumni Registered')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
  echo "
    <script>
      bootbox.alert('Alumni Deactivated')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 3){
  echo "
    <script>
      bootbox.alert('Alumni Record Updated')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 4){
  echo "
    <script>
      bootbox.alert('File Type not Supported')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 5){
  echo "
    <script>
      bootbox.alert('You file has imported successfully')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 6){
  echo "
    <script>
      bootbox.alert('Alumni Record Restored.')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 7){
  echo "
    <script>
      bootbox.alert('New Course Registered.')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 8){
  echo "
    <script>
      bootbox.alert('Alumni Reactivated');
    </script>
  ";
  $_SESSION['alert'] = 0;
}

if(isset($_POST['deleteAllBtn'])){
  foreach ($_POST['check'] as $key => $value) {
    $query4 = mysqli_query($conn, "select * from tbl_alumni where student_number='".$value."'");
    $row4 = mysqli_fetch_assoc($query4);
    mysqli_query($conn, "insert into tbl_alumni_backup_list values('".$row4['student_number']."', '".$row4['password']."', '".$row4['lastname']."', '".$row4['firstname']."', '".$row4['middlename']."', '".$row4['email_add']."', '".$row4['coursecode']."', '".$row4['college']."', '".$row4['year_graduated']."', '".$row4['alumni_picture']."', '".$row4['gender']."', '".$row4['birthdate']."', '".$row4['mobile_number']."', '".$row4['religion']."', '".$row4['address']."', '".$row4['father_name']."', '".$row4['father_birthdate']."', '".$row4['father_birthdate']."', '".$row4['mother_name']."', '".$row4['mother_birthdate']."', '".$row4['mother_occupation']."', '".$row4['secondary_school']."', '".$row4['secondary_year_graduated']."', '".$row4['primary_school']."', '".$row4['primary_year_graduated']."', '".$row4['date_updated']."')");
    mysqli_query($conn, "update tbl_alumni set status=0 where student_number='".$value."' ") or die(mysqli_error());
  }
  $_SESSION['alert'] = 2;
  header('Location: alumni_manage.php');
}

?>

<section class="content-header">
  <h1>
    Alumni
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li class="active">Alumni</li>
  </ol>
</section>

<?php if($row_prof['user_level'] == "Co-admin"){ include'partials/alumni_manage.php'; }else{ ?>

<section class="content">

  <div class="box box-success">

    <div class="box-header with-border">
      <h3 class="box-title">&nbsp;</h3>
      <div class="box-tools pull-right">
      <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus"> </i> Add Alumni</a>
      <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importModal"><i class="fa fa-upload"> </i> Import Alumni List</a>
      <a href="#" onclick="printAlumni()" class="btn btn-success btn-sm" id="print_all_alumni" data-toggle="tooltip" title="Print Report"><i class="fa fa-print"></i></a>
      <!--<a href="alumni_bin.php" class="btn btn-info btn-sm" data-toggle="tooltip" title="See Deleted Alumni"><i class="fa fa-recycle"></i></a>-->
      </div>
    </div>

    <div class="box-body">
      <div class="row" style="margin-bottom: 10px">
        <div class="col-md-12 text-right">
          Search: 
          <select id="course" class="form-control" style="width: auto; display: inline-block">
            <option value="">Select Course</option>
            <?php
              foreach (courses() as $value) {
                ?>
                  <option value="<?php echo $value['coursecode']; ?>"><?php echo $value['coursecode']; ?></option>
                <?php
              }
            ?>
          </select>

          <select id="batch" class="form-control" style="width: auto; display: inline-block">
            <option value="">Select Batch</option>
            <?php
              for ($i=2011; $i <= date('Y'); $i++) { 
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php
              }
            ?>
          </select>

          <select id="college" class="form-control" style="width: auto; display: inline-block">
            <option value="">Select College</option>
            <?php
              foreach (colleges() as $value) {
                ?>
                  <option value="<?php echo $value['collegecode']; ?>"><?php echo $value['collegecode']; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-right">
          Search:
          <select id="studentnumbername" class="form-control" style="width: auto; display: inline-block">
            <option value="1">Student Number</option>
            <option value="2">Name</option>
          </select>
          <input type="text" id="searchQuery" class="form-control" placeholder="Enter Name or Student Number" style="display: inline-block; width: auto">
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <table id="alumniTbl" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th align="center" class="no-sort" style="text-align: right"></th>
                <th>Student Number</th>
                <th>Name</th>
                <th>Batch</th>
                <th>Course</th>
                <th>College</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = mysqli_query($conn, "select * from tbl_alumni where student_number is not null");
                while($row = mysqli_fetch_assoc($query)){
                  ?>
                    <tr>
                      <td align="center">
                        <input type="checkbox" name="check[<?php echo $row['student_number']; ?>]" value="<?php echo $row['student_number']; ?>" form="deleteAll">
                      </td>
                      <td><?php echo $row['student_number']; ?></td>
                      <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                      <td><?php echo $row['year_graduated']; ?></td>
                      <td><?php echo $row['coursecode']; ?></td>
                      <td><?php echo $row['college']; ?></td>
                      <td align="center">
                        <a href="alumni_profile.php?id=<?php echo $row['student_number']; ?>" class="btn btn-success btn-sm" title="View Alumni"><i class="fa fa-eye"></i></a>
                      </td>
                      <td align="center">
                        <a href="#" class="btn btn-default btn-sm" title="Edit Alumni" data-toggle="modal" data-target="#editModal" data-noo="<?php echo $row['student_number']; ?>"><i class="fa fa-pencil"> </i></a>
                      </td>
                      <td align="center">
                        <?php if($row['status'] == 0){ ?>
                        <form method="post">
                          <input type="hidden" name="reactivateAccount" value="<?php echo $row['student_number']; ?>">
                          <button type="submit" class="btn btn-success btn-sm" data-toggle="toolitp" title="Reactivate Alumni"><i class="fa fa-user-plus"></i></button>
                        </form>
                        <?php }else{ ?>
                        <a href="#" class="btn btn-danger btn-sm" title="Delete Alumni" data-toggle="modal" data-target="#deleteModal" data-no="<?php echo $row['student_number']; ?>"><i class="fa fa-user-times" data-toggle="tooltip" title="Deactivate Alumni"></i></a>
                        <?php } ?>
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
              <th colspan="7"></th>
              <td align="center">
                <form id="deleteAll" method="post">
                  <button type="submit" name="deleteAllBtn" class="btn btn-danger btn-sm"><i class="fa fa-user-times" data-toggle="tooltip" title="Deactivate Alumni"></i></button>
                </form>
              </td>
            </tfoot>
          </table>
        </div>
      </div>
      
    </div>

  </div>

</section>

<?php } ?>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Alumni Account</h4>
      </div>
      <div class="modal-body">
        <form method="post" class="form-horizontal" id="addAlumniForm">
        <input type="hidden" name="addAlumniIni" value="add">
        <div class="form-group" id="student_number_error">
          <label class="col-sm-3 control-label">Student Number</label>
          <div class="col-sm-9">
            <input type="text" name="student_number" id="student_number" class="form-control" placeholder="Student Number">
          </div>
        </div>
        <div class="form-group" id="lastname_error">
          <label class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name">
          </div>
        </div>
        <div class="form-group" id="firstname_error">
          <label class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name">
          </div>
        </div>
        <div class="form-group" id="middlename_error">
          <label class="col-sm-3 control-label">Middle Name</label>
          <div class="col-sm-9">
            <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Middle Name">
          </div>
        </div>
        <div class="form-group" id="contact_number_error">
          <label class="col-sm-3 control-label">Contact Number</label>
          <div class="col-sm-9">
            <input type="text" name="contact_number" id="contact_number" onkeypress="return numbersonly(event)" class="form-control" placeholder="Contact Number">
          </div>
        </div>
        <div class="form-group" id="email_error">
          <label class="col-sm-3 control-label">Email Address</label>
          <div class="col-sm-9">
            <input type="text" name="email" id="email" class="form-control" placeholder="Email Address">
          </div>
        </div>
        <div class="form-group" id="course_error">
          <label class="col-sm-3 control-label">Course</label>
          <div class="col-sm-9">
            <select name="course" id="select_course" class="form-control">
              <option value="">Select</option>
              <?php
                $query2 = mysqli_query($conn, "select * from tbl_courses");
                if(empty(mysqli_num_rows($query2))){
                  ?>
                    <option value="1">Create New Course</option>
                  <?php
                }else{
                  while($row2 = mysqli_fetch_assoc($query2)){
                    ?>
                      <option value="<?php echo $row2['coursecode']; ?>"><?php echo $row2['coursecode']; ?></option>
                    <?php
                  }
                }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group" id="year_graduated_error">
          <label class="col-sm-3 control-label">Year Graduated</label>
          <div class="col-sm-9">
            <select class="form-control" name="year_graduated" id="year_graduated">
              <option value="">Select</option>
                <?php
                  for($x=2011;$x<=date('Y');$x++){
                    echo "<option value='$x'>$x</option>";
                  }
                ?>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default">Clear</button>
        <button type="button" onclick="addAlumniBtn()" class="btn btn-success">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Alumni Account</h4>
      </div>
      <div class="modal-body">
        <form method="post" class="form-horizontal" id="editAlumniForm">
        <div id="editAlumniBox"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" onclick="editAlumniBtn()" class="btn btn-success">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Import Alumni List</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="import_excel.php">
        <p class="text-yellow">Important! Excel file imports only.</p>
        <input type="file" name="file">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name="importBtn" class="btn btn-primary">Import</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form method="post">
        <input type="hidden" id="student_number_hdn" name="student_number_hdn">
        <p>Are you sure you want to deactivate this alumni?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">No</button>
        <button type="submit" name="deleteAlumni" class="btn btn-primary btn-xs">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="createCourse" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Course</h4>
      </div>
      <div class="modal-body">
        <form method="post">   
        <div class="form-group">
          <label class="control-label">College</label>
            <select name="college" class="form-control">
              <option value="">Select</option>
              <?php
                $college_query = mysqli_query($conn, "select * from tbl_college");
                while($college_row = mysqli_fetch_assoc($college_query)){
                  ?>
                  <option value="<?php echo $college_row['collegecode']; ?>"><?php echo $college_row['collegecode']; ?></option>
                  <?php
                }
            ?>
            </select>
        </div>
        <div class="form-group">
          <label class="control-label">Coursecode</label>
          <input type="text" name="coursecode" class="form-control" placeholder="Course Code">
        </div>
        <div class="form-group">
          <label class="control-label">Course Name</label>
          <input type="text" name="coursename" class="form-control" placeholder="Course Name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name="createCourseBtn" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_POST['addAlumniIni'])){
  $student_number = $_POST['student_number'];
  $lastname = strtoupper($_POST['lastname']);
  $firstname = strtoupper($_POST['firstname']);
  $middlename = strtoupper($_POST['middlename']);
  $contact_number = $_POST['contact_number'];
  $email = $_POST['email'];
  $course = $_POST['course'];
  $year_graduated = $_POST['year_graduated'];

  $query3 = mysqli_query($conn, "select * from tbl_courses where coursecode='".$course."'") or die(mysqli_error());
  $row3 = mysqli_fetch_assoc($query3);
  $college = $row3['college'];

  mysqli_query($conn, "insert into tbl_alumni(student_number,password,lastname,firstname,middlename,email_add,coursecode,college,year_graduated,mobile_number) values('$student_number',md5('$lastname'),'$lastname','$firstname','$middlename','$email','$course','$college','$year_graduated','$contact_number')") or die(mysqli_error());
  $name = $_SESSION['firstname']." ".$_SESSION['lastname'];
  $date = date('M d Y - h:i A');
  mysqli_query($conn, "insert into tbl_admin_logs(name, user_level, action, date) values('$name', '".$row_prof['user_level']."', 'registered an alumni', '$date')") or die(mysqli_error());
  $_SESSION['alert'] = 1;
  header("Location: alumni_manage.php");
}

if(isset($_POST['stud_hdn'])){
  $hdn = $_POST['stud_hdn'];
  $student_number = $_POST['student_number'];
  $lastname = strtoupper($_POST['lastname']);
  $firstname = strtoupper($_POST['firstname']);
  $middlename = strtoupper($_POST['middlename']);
  $email = $_POST['email'];
  $course = $_POST['course'];
  $year_graduated = $_POST['year_graduated'];
  $mobile_number = $_POST['mobile_number'];

  $query5 = mysqli_query($conn, "select * from tbl_courses where coursecode='$course'");
  $row5 = mysqli_fetch_assoc($query5);
  $college = $row5['college'];

  mysqli_query($conn, "update tbl_alumni set student_number='$student_number', lastname='$lastname', firstname='$firstname', middlename='$middlename', email_add='$email', coursecode='$course', college='$college', year_graduated='$year_graduated', mobile_number='$mobile_number' where student_number=".$hdn) or die(mysqli_error());
  mysqli_query($conn, "update tbl_employment set college='$college' where student_number='$hdn'");
  $_SESSION['alert'] = 3;
  header('Location: alumni_manage.php');
}

if(isset($_POST['deleteAlumni'])){
  $hdn_no = $_POST['student_number_hdn'];

  mysqli_query($conn, "update tbl_alumni set status=0 where student_number='".$hdn_no."'");
    
  $_SESSION['alert'] = 2;
  header("Location: alumni_manage.php");
}

if(isset($_POST['reactivateAccount'])){
  $stud_no = $_POST['reactivateAccount'];
  mysqli_query($conn, "update tbl_alumni set status=1 where student_number='$stud_no'");
  $_SESSION['alert'] = 8;
  header("Location: alumni_manage.php");
}

if(isset($_POST['createCourseBtn'])){
  $college = $_POST['college'];
  mysqli_query($conn, "insert into tbl_courses(coursecode, coursename, college) values('".$_POST['coursecode']."', '".$_POST['coursename']."', '$college')") or die(mysqli_error());
  $_SESSION['alert'] = 7;
  header('Location: alumni_manage.php');
}
?>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  var table = $("#alumniTbl").DataTable({
    "paging": false,
    "searching": true,
    "search": {
      "smart": false
    },
    "scrollY": "400px",
    columnDefs: [{
      targets: [0], orderable: false
    }]
  });

  $('#studentnumbername').on('change', function() {
    table
     .search( '' )
     .columns().search( '' )
     .draw();
    var studentnumbername = document.getElementById("studentnumbername").value;
    if(studentnumbername == 1){
      table.column(4).search($('#course').val()).draw();
      table.column(3).search($('#batch').val()).draw();
      table.column(5).search($('#college').val()).draw();
      table.column(1).search($('#searchQuery').val()).draw();
    }else{
      table.column(4).search($('#course').val()).draw();
      table.column(3).search($('#batch').val()).draw();
      table.column(5).search($('#college').val()).draw();
      table.column(2).search($('#searchQuery').val()).draw();
    }
  });

  $('#course').on('change', function(){
    table.column(4).search($(this).val()).draw();
  });

  $('#batch').on('change', function(){
    table.column(3).search($(this).val()).draw();
  });

  $('#college').on('change', function(){
    table.column(5).search($(this).val()).draw();
  });


  $('#searchQuery').keyup(function(){
    var studentnumbername = document.getElementById("studentnumbername").value;
    if(studentnumbername == 1){
      table.column(4).search($('#course').val()).draw();
      table.column(3).search($('#batch').val()).draw();
      table.column(5).search($('#college').val()).draw();
      table.column(1).search($(this).val()).draw();
    }else{
      table.column(4).search($('#course').val()).draw();
      table.column(3).search($('#batch').val()).draw();
      table.column(5).search($('#college').val()).draw();
      table.column(2).search($(this).val()).draw();
    }
  });

  var print_link = "php/print_alumni.php?student_number=&name=&course=&college=&batch=";
  var student_number = "";
  var name = "";
  var course = "";
  var college = "";
  var batch = "";

  function printAlumni(){
    if(document.getElementById("studentnumbername").value == 1){
      if(document.getElementById("searchQuery") != ""){
        student_number = document.getElementById("searchQuery").value;
      }else{
        student_number = "";
      }
    }else{
      if(document.getElementById("searchQuery") != ""){
        name = document.getElementById("searchQuery").value;
      }else{
        name = "";
      }
    }

    if(document.getElementById("course").value != ""){
      course = document.getElementById("course").value;
    }else{
      course = "";
    }

    if(document.getElementById("batch").value != ""){
      batch = document.getElementById("batch").value;
    }else{
      batch = "";
    }

    if(document.getElementById("college").value != ""){
      college = document.getElementById("college").value;
    }else{
      college = "";
    }

    print_link = "php/print_alumni.php?student_number="+ student_number +"&name="+ name +"&course="+ course +"&college="+ college +"&batch=" + batch;
    console.log(print_link);
    window.location = print_link;
  }
</script>


<?php include'php/footer.php'; ?>
      

