<?php
include'../db_connection.php';
$id = $_GET['q'];
$query = mysqli_query($conn, "select * from tbl_alumni where student_number=".$id);
$row = mysqli_fetch_assoc($query);
?>

<input type="hidden" name="stud_hdn" value="<?php echo $row['student_number']; ?>">
<div class="form-group" id="student_number_error_e">
  <label class="col-sm-3 control-label">Student Number</label>
  <div class="col-sm-9">
    <input type="text" name="student_number" id="student_number_e" class="form-control" value="<?php echo $row['student_number']; ?>">
  </div>
</div>
<div class="form-group" id="lastname_error_e">
  <label class="col-sm-3 control-label">Last Name</label>
  <div class="col-sm-9">
    <input type="text" name="lastname" id="lastname_e" class="form-control" value="<?php echo $row['lastname']; ?>">
  </div>
</div>
<div class="form-group" id="firstname_error_e">
  <label class="col-sm-3 control-label">First Name</label>
  <div class="col-sm-9">
    <input type="text" name="firstname" id="firstname_e" class="form-control" value="<?php echo $row['firstname']; ?>">
  </div>
</div>
<div class="form-group" id="middlename_error_e">
  <label class="col-sm-3 control-label">Middle Name</label>
  <div class="col-sm-9">
    <input type="text" name="middlename" id="middlename_e" class="form-control" value="<?php echo $row['middlename']; ?>">
  </div>
</div>
<div class="form-group" id="contact_number_error_e">
  <label class="col-sm-3 control-label">Contact Number</label>
  <div class="col-sm-9">
    <input type="text" name="mobile_number" id="contact_number_e" onkeypress="return numbersonly(event)" class="form-control" value="<?php echo $row['mobile_number']; ?>">
  </div>
</div>
<div class="form-group" id="email_error_e">
  <label class="col-sm-3 control-label">Email Address</label>
  <div class="col-sm-9">
    <input type="text" name="email" id="email_e" class="form-control" value="<?php echo $row['email_add']; ?>">
  </div>
</div>
<div class="form-group" id="course_error_e">
  <label class="col-sm-3 control-label">Course</label>
  <div class="col-sm-9">
    <select name="course" class="form-control" id="select_course_e">
      <option value="">Select</option>
      <?php
        $query2 = mysqli_query($conn, "select * from tbl_courses");
        while($row2 = mysqli_fetch_assoc($query2)){
          ?>
            <option value="<?php echo $row2['coursecode']; ?>" <?php if($row['coursecode'] == $row2['coursecode']){ echo "selected"; } ?> ><?php echo $row2['coursecode']; ?></option>
          <?php
        }
      ?>
    </select>
  </div>
</div>
<div class="form-group" id="year_graduated_error_e">
  <label class="col-sm-3 control-label">Year Graduated</label>
  <div class="col-sm-9">
    <select class="form-control" name="year_graduated" id="year_graduated_e">
      <option value="">Select</option>
        <?php
          for($x=2011;$x<=date('Y');$x++){
            ?>
            	<option value='<?php echo $x; ?>' <?php if($row['year_graduated'] == $x){ echo "selected"; } ?>><?php echo $x; ?></option>
            <?php
          }
        ?>
    </select>
  </div>
</div>