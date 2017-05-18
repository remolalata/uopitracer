<?php
include'../db_connection.php';
$key = $_GET['q'];

$query = mysqli_query($conn, "select * from tbl_college where collegecode='$key'");
$row = mysqli_fetch_assoc($query);
?>
<input type="hidden" name="editCollegeSubmit" value="<?php echo $row['collegecode']; ?>">
<div class="form-group">
	<label>Collegecode</label>
	<input type="text" name="collegecode" class="form-control" value="<?php echo $row['collegecode']; ?>">
</div>
<div class="form-group">
	<label>Collegename</label>
	<input type="text" name="collegename" class="form-control" value="<?php echo $row['collegename']; ?>">
</div>