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
            $co_query = mysqli_query($conn, "select a.*, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.college='".$row_prof['college']."' and b.employment_status='Unemployed'");
            while($co_row = mysqli_fetch_assoc($co_query)){
              ?>
                <tr>
                  <td><?php echo $co_row['firstname']." ".$co_row['lastname']; ?></td>
                  <td><?php echo $co_row['employment_status']; ?></td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
      
    </div>

  </div>

</section>