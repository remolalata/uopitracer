<?php
include'../db_connection.php';
$id = $_GET['q'];

$query = mysqli_query($conn, "select * from tbl_admin where id=".$id) or die(mysqli_error());
$row = mysqli_fetch_assoc($query);
?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<div class="row">
        <div class="col-md-3">
                <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                        <label>Image</label><br>
                                        <img src="<?php echo $row['user_image']; ?>" id="image_upload_preview" width="160" height="160" >
                                        <input type="file" name="file" class="inputFile" form="updateForm">
                                </div>
                        </div>
                </div>
        </div>

        <div class="col-md-9">
               <div class="form-group">
                       <label>First Name</label>
                       <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $row['firstname']; ?>">
               </div> 
               <div class="form-group">
                       <label>Last Name</label>
                       <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $row['lastname']; ?>">
               </div>
               <div class="form-group">
                       <label>Username</label>
                       <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $row['username']; ?>">
               </div> 
               <div class="form-group">
                       <label>College</label>
                       <select name="college" class="form-control">
                               <option value="">Select</option>
                               <?php
                                        $col_query = mysqli_query($conn, "select * from tbl_college");
                                        while($col_row = mysqli_fetch_assoc($col_query)){
                                                ?>
                                                <option value="<?php echo $col_row['collegecode']; ?>'" <?php if($row['college'] == $col_row['collegecode']){ echo "selected"; } ?> ><?php echo $col_row['collegecode']; ?></option>";
                                                <?php
                                        }
                               ?>
                       </select>
               </div> 
        </div>
</div>
