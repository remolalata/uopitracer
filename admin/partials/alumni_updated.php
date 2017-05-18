<section class="content">

  <div class="box box-success"> 

    <div class="box-body">
      <table id="alumniUpdatedTbl" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Student Number</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Course</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $co_query = mysqli_query($conn, "select a.* from tbl_alumni a left join tbl_employment b on a.student_number = b.student_number where b.student_number is null and a.college='".$row_prof['college']."'");
            while($co_row = mysqli_fetch_assoc($co_query)){
              ?>
                <tr>
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