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
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Employment Status</th>
                    <th>Company Name</th>
                    <th>Company Address</th>
                    <th>Year Employed</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = mysqli_query($conn, "select a.*, b.* from tbl_alumni a, tbl_employment b where a.student_number=b.student_number") or die(mysqli_error($conn));
                    while($row = mysqli_fetch_assoc($query)){
                      ?>
                        <tr>
                          <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                          <td><?php echo ucfirst($row['job_title']); ?></td>
                          <td><?php echo $row['employment_status']; ?></td>
                          <td><?pph echo $row['company_name']; ?></td>
                          <td><?php echo $row['company_address']; ?></td>
                          <td><?php echo $row['year_employed']; ?></td>
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
var table = $('#alumniTbl').DataTable({
  "paging": false,
  "lengthChange": false,
  "searching": true,
  "ordering": false,
  "info": false,
  "autoWidth": false,
});
</script>
</body>
</html>
