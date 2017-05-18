<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <style>
  th, td{
    text-align: center;
  }
  .dataTables_filter{display: none;}
  </style>
</head>
<body onload="window.print()">
  <?php session_start(); include'db_connection.php'; ?>
  <?php $row_prof = mysqli_fetch_assoc(mysqli_query($conn, "select * from tbl_admin where id=".$_SESSION['id'])); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h3 class="text-green">PHINMA - University Of Pangasinan</h3>
        <p>Arellano St. Dagupan City, Philippines 2400 | https://www.up.phinma.edu.ph</p>
        <p>63.75.522.5635</p>
      </div>
      <div class="col-md-4" style="position: absolute; top: 0; right: 0">
        <img src="../images/logo.png" width="100" height="100">
      </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="box-body">
              <table class="table table-bordered" id="alumniTbl">
                <thead>
                  <tr>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>College</th>
                    <th>Batch</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = mysqli_query($conn, "select * from tbl_alumni");
                    while($row = mysqli_fetch_assoc($query)){
                      ?>
                        <tr>
                          <td><?php echo $row['student_number']; ?></td>
                          <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                          <td><?php echo $row['coursecode']; ?></td>
                          <td><?php echo $row['college']; ?></td>
                          <td><?php echo $row['year_graduated']; ?></td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
        </div>
    </div><br><br><br><br>

    <p>
      Prepared By: <br>
      <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>
    </p>

  </div>

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var student_number = getParameterByName('student_number');
var name = getParameterByName('name');
var course = getParameterByName('course');
var college = getParameterByName('college');
var batch = getParameterByName('batch');

var table = $('#alumniTbl').DataTable({
  "paging": false,
  "lengthChange": false,
  "searching": true,
  "ordering": false,
  "info": false,
  "autoWidth": false,
});

table.column(0).search(student_number).draw();
table.column(1).search(name).draw();
table.column(2).search(course).draw();
table.column(3).search(college).draw();
table.column(4).search(batch).draw();

</script>
</body>
</html>