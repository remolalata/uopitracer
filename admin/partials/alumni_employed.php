<section class="content">

  <div class="box box-success">

    <!--<div class="box-header with-border">
      <h3></h3>
      <div class="box-tools pull-right">
            <span class="pull-right"><a href="">Notify all user</a></span>
      </div>
    </div>-->

    <div class="box-body">
      <table id="alumniEmployedTbl" class="table table-bordered table-striped">
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
            $co_query = mysqli_query($conn, "select a.*, b.* from tbl_alumni a, tbl_employment b where a.student_number = b.student_number and a.college='".$row_prof['college']."' and b.employment_status<>'Unemployed'");
            while($co_row = mysqli_fetch_assoc($co_query)){
              ?>
                <tr>
                  <td><?php echo $co_row['firstname']." ".$co_row['lastname']; ?></td>
                  <td><?php echo $co_row['job_title']; ?></td>
                  <td><?php echo $co_row['employment_status']; ?></td>
                  <td><?php echo $co_row['company_name']; ?></td>
                  <td><?php echo $co_row['company_address']; ?></td>
                  <td><?php echo $co_row['year_employed']; ?></td>
                </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
      
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Donut Chart</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <canvas id="pieChart" style="height:250px"></canvas>
        </div>
      </div>  
    </div>
  </div>

</section>