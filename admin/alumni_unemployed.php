<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<section class="content-header">
  <h1>
    Alumni
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li><a href="alumni_manage.php"><i class="fa fa-user"> </i> Alumni List</a></li>
    <li class="active">Unemployed Alumni</li>
  </ol>
</section>

<?php if($row_prof['user_level'] == "Co-admin"){ include'partials/alumni_unemployed.php'; }else{ ?>
<section class="content">

  <div class="box box-success">

    <div class="box-header with-border">
      <h3 class="box-title">&nbsp;</h3>
      <div class="box-tools pull-right">
        <a href="php/print_unemployed.php" class="btn btn-default btn-xs"><i class="fa fa-print"> </i> Print Report</a>
      </div>
    </div>

    <div class="box-body">
      <table id="alumniEmployedTbl" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Employment Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($conn, "select a.*, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and employment_status='Unemployed'");
            while($row = mysqli_fetch_assoc($query)){
              ?>
                <tr>
                  <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                  <td><?php echo $row['employment_status']; ?></td>
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

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<?php include'php/footer.php'; ?>
      
