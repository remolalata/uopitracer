<section class="content">

  <style>
    #alumniTbl_crit option:nth-child(5){display: none}
  </style>

  <div class="box box-success">

    <div class="box-header with-border text-right">
      <a href="#" id="print_all_alumni" class="btn btn-success btn-sm" id="print_all_alumni" data-toggle="tooltip" title="Print Report"><i class="fa fa-print"></i></a>
    </div>

    <div class="box-body">
      <table id="alumniTbl" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="display: none"></th>
            <th>Student Number</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Course</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $co_query = mysqli_query($conn, "select * from tbl_alumni where college='".$row_prof['college']."'");
            while($co_row = mysqli_fetch_assoc($co_query)){
              ?>
                <tr>
                  <td style="display: none"></td>
                  <td><?php echo $co_row['student_number']; ?></td>
                  <td><?php echo $co_row['firstname']." ".$co_row['lastname']; ?></td>
                  <td><?php echo $co_row['year_graduated']; ?></td>
                  <td><?php echo $co_row['coursecode']; ?></td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>

  </div>

</section>