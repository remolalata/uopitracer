<?php
include'../../admin/php/db_connection.php';
$id = $_GET['q'];

$query = mysqli_query($conn, "select * from tbl_job_posts where job_post_id='$id'") or die(mysqli_error());
$row = mysqli_fetch_assoc($query);

?>

<?php if($row['job_status'] != 2){ ?>
<style>
	#notifModalBtn{display: none}
</style>
<?php } ?>

<h3><?php echo $row['job_title']; ?></h3>
<h4><?php echo $row['company_name']; ?></h4>
<p class="locsal"><i class="fa fa-dollar"> </i> <?php echo $row['salary']; ?></p>
<p class="locsal"><i class="fa fa-map-marker"> </i> <?php echo $row['address']." - ".$row['location']; ?></p>
<p class="locsal"><i class="fa fa-envelope-square"> </i> <?php echo $row['company_email']; ?></p>
<p class="locsal"><i class="fa fa-phone"> </i> <?php echo $row['company_number']; ?></p>
<p style="margin-top: 10px"><?php echo $row['description']; ?></p>