<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php
  if(isset($_POST['addCourseIni'])){
    $coursecode = $_POST['coursecode'];
    $coursename = $_POST['coursename'];

    mysqli_query($conn, "insert into tbl_courses(coursecode, coursename, college) value('$coursecode', '$coursename', '".strtoupper($_GET['college'])."')");
    $_SESSION['alert'] = 1;
    //header("Location: ".$_SERVER['REQUEST_URI']);
  }

  if(isset($_POST['deleteCourseBtn'])){
    $coursecode = $_POST['coursecode'];
    mysqli_query($conn, "delete from tbl_courses where coursecode='$coursecode'");
    $_SESSION['alert'] = 2;
    //header("Location: ".$_SERVER['REQUEST_URI']);
  }

  if(isset($_POST['editCourseBtn'])){
    $course_hdn = $_POST['course_hdn'];
    $coursecode = $_POST['coursecode'];
    $coursename = $_POST['coursename'];

    mysqli_query($conn, "update tbl_courses set coursecode='$coursecode', coursename='$coursename' where coursecode='$course_hdn'") or die(mysqli_error());
    $_SESSION['alert'] = 3;
  }

?>

<?php
  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
    echo "
    <script>
      bootbox.alert('You successfully added a new course')
    </script>";
    $_SESSION['alert'] = 0;
  }
  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
    echo "
    <script>
      bootbox.alert('You successfully delete a course')
    </script>";
    $_SESSION['alert'] = 0;
  }
  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 3){
    echo "
    <script>
      bootbox.alert('You successfully updated a course')
    </script>";
    $_SESSION['alert'] = 0;
  }
?>

<?php if(isset($_GET['college'])){ ?>

  <?php
    $query = mysqli_query($conn, "select * from tbl_college where collegecode='".strtoupper($_GET['college'])."' ");
    if(empty(mysqli_num_rows($query))){
      include'404.html'; 
    }else{
      $row = mysqli_fetch_assoc($query);
  ?>

    <section class="content-header">
      <h1>
        <?php echo $row['collegename']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
        <li class="active"><?php echo strtoupper($_GET['college']); ?></li>
      </ol>
    </section>

    <section class="content">

      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Course</h3>
          <div class="box-tools pull-right">
            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCourseModal"><i class="fa fa-plus"> </i> Add Course</a>
          </div>
        </div>
        <div class="box-body">
          <table id="courseTbl" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query2 = mysqli_query($conn, "select * from tbl_courses where college='".strtoupper($_GET['college'])."'");
                while($row2 = mysqli_fetch_assoc($query2)){
                  ?>
                    <tr>
                      <td><?php echo $row2['coursecode']; ?></td>
                      <td><?php echo $row2['coursename']; ?></td>
                      <td align="center">
                        <button type="submit" name="editCourse" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editCourseModal" data-coursecode="<?php echo $row2['coursecode']; ?>" title="Edit Course"><i class="fa fa-pencil"> </i> </button>
                        <button type="submit" name="deleteCourse" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCourseModal" data-coursecode="<?php echo $row2['coursecode']; ?>" title="Delete this course."><i class="fa fa-trash"> </i></button>
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

<?php }else{ ?>

  <?php include'404.html'; ?>

<?php } ?>

<div class="modal fade" tabindex="-1" role="dialog" id="addCourseModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Course</h4>
      </div>
      <div class="modal-body">
        <p>
          <form method="post" id="addCourseForm">
            <input type="hidden" name="addCourseIni" value="add">
            <div class="form-group" id="coursecode_error_a">
              <label for="coursecode">Course Code</label>
              <input type="text" name="coursecode" id="coursecode_a" class="form-control" placeholder="Course Code">
            </div>
            <div class="form-group" id="coursename_error_a">
              <label for="coursename">Course Name</label>
              <input type="text" name="coursename" id="coursename_a" class="form-control" placeholder="Course Name">
            </div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addCourseBtn()" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="editCourseModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Course</h4>
      </div>
      <div class="modal-body">
        <form method="post">
        <p id="editCourseDiv">

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="editCourseBtn" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteCourseModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <form method="post">
          <input type="hidden" name="coursecode" id="coursecode">
        <p>Are you sure you want to delete this course?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">No</button>
        <button type="submit" name="deleteCourseBtn" class="btn btn-primary btn-xs">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<?php include'php/footer.php'; ?>
      
