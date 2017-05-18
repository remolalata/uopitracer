<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php

function colleges(){
  $result = array();
  include'php/db_connection.php';
  $query = mysqli_query($conn, "select * from tbl_college") or die(mysqli_error($conn));
  while($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
  }
  return $result;
}

if(isset($_POST['addCollegeSubmit'])){
  $collegecode = strtoupper($_POST['collegecode']);
  $collegename = $_POST['collegename'];

  mysqli_query($conn, "insert into tbl_college(collegecode, collegename) values('$collegecode', '$collegename')") or die(mysqli_error());
  $_SESSION['alert'] = 2;
}

if(isset($_POST['collegecodehdn'])){
  $college = $_POST['collegecodehdn'];
  mysqli_query($conn, "delete from tbl_college where collegecode='$college'");
  $_SESSION['alert'] = 1;
}

if(isset($_POST['editCollegeSubmit'])){
  $collegecodehdn = $_POST['editCollegeSubmit'];
  $collegecode = $_POST['collegecode'];
  $collegename = $_POST['collegename'];
  mysqli_query($conn, "update tbl_college set collegecode='$collegecode', collegename='$collegename' where collegecode='$collegecodehdn'");
  $_SESSION['alert'] = 3;
}

if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
  echo "
  <script>
    bootbox.alert('You successfully delete a college');
  </script>";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
  echo "
  <script>
    bootbox.alert('You successfully add a new college');
  </script>";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 3){
  echo "
  <script>
    bootbox.alert('You successfully updated a college');
  </script>";
  $_SESSION['alert'] = 0;
}
?>

<section class="content-header">
  <h1>
    College
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li class="active">View All College</li>
  </ol>
</section>

<section class="content">

  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">College</h3>
      <div class="box-tools pull-right">
        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCollegeModal"><i class="fa fa-plus"> </i> Add College</a>
      </div>
    </div>
    <div class="box-body">
      <table id="courseTbl" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>College Code</th>
            <th>College Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (colleges() as $key => $value) { ?>

            <tr>
              <td><?php echo $value['collegecode']; ?></td>
              <td><?php echo $value['collegename']; ?></td>
              <td align="center">
                <form method="post">
                  <input type="hidden" name="collegecodehdn" value="<?php echo $value['collegecode']; ?>">
                  <a href="college.php?college=<?php echo strtolower($value['collegecode']); ?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="View College"><i class="fa fa-eye"></i></a>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editCollegeModal" data-collegecode="<?php echo $value['collegecode']; ?>"><i class="fa fa-pencil"></i></button>
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"> </i></button>
                </form>
              </td>
            </tr>

          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</section>

<div class="modal fade" tabindex="-1" role="dialog" id="addCollegeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add College</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="addCollegeForm">
          <input type="hidden" name="addCollegeSubmit" >
          <div class="form-group" id="collegecode_error">
            <label>College Code</label>
            <input type="text" name="collegecode" id="collegecode" class="form-control" placeholder="Collegecode">
          </div>
          <div class="form-group" id="collegename_error">
            <label>Collegename</label>
            <input type="text" name="collegename" id="collegename" class="form-control" placeholder="Collegename">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="addCollegeBtn()" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="editCollegeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit College</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="editCollegeForm">
          <div id="editCollegeDiv"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="editCollegeBtn()">Update</button>
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

<script>
  function addCollegeBtn(){
    var collegecode = document.getElementById("collegecode").value;
    var error = [];
    $.ajax({
      type: "POST",
      url: "php/ajax/checkcollege.php",
      data: 'id='+collegecode,
      dataType: 'json',
      success: function(msg){
        if(document.getElementById("collegecode").value == ""){
          error.push("error");
          $("#collegecode_error").addClass("has-error");
          $("#collegecode_error label").html("Collegecode is empty");
        }else if(msg.count >= 1){
          error.push("error");
          $("#collegecode_error").addClass("has-error");
          $("#collegecode_error label").html("Collegecode is not available");
        }else{
          $("#collegecode_error").removeClass("has-error");
          $("#collegecode_error label").html("Collegecode");
        }

        if(document.getElementById("collegename").value == ""){
          error.push("error");
          $("#collegename_error").addClass("has-error");
          $("#collegename_error label").html("Collegename is empty");
        }else{
          $("#collegename_error").removeClass("has-error");
          $("#collegename_error label").html("Collegename");
        }

        if(error.length == 0){
          document.getElementById("addCollegeForm").submit();
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert(errorThrown); 
      }
    });
  }

  function editCollegeBtn(){
    document.getElementById("editCollegeForm").submit();
  }

  $('#editCollegeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var collegecode = button.data('collegecode');
    $("#editCollegeDiv").load("php/ajax/editcollege.php?q=" + collegecode);
  });
</script>

<?php include'php/footer.php'; ?>
      
