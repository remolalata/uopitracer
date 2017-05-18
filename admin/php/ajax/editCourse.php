<?php
include'../db_connection.php'; 
$course = $_GET['q'];
$query = mysqli_query($conn, "select * from tbl_courses where coursecode='$course'");
$row = mysqli_fetch_assoc($query);
?>
<input type="hidden" name="course_hdn" value="<?php echo $row['coursecode']; ?>">
<div class="form-group">
  <label for="coursecode">Course Code</label>
  <input type="text" name="coursecode" id="coursecode" class="form-control" value="<?php echo $row['coursecode']; ?>" placeholder="Course Code">
</div>
<div class="form-group">
  <label for="coursename">Course Name</label>
  <input type="text" name="coursename" id="coursename" class="form-control" value="<?php echo $row['coursename']; ?>" placeholder="Course Name">
</div>