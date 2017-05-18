<?php include'php/header.php'; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<?php
if(isset($_POST['add'])){
  $title = $_POST['title'];
  $content = $_POST['content'];
  $storedFile="images/news_events/".basename($_FILES["file"]["name"]);
  move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
  $date_time = date("M d Y - h:i A");
  $posted_by = $row_prof['firstname']." ".$row_prof['lastname'];
  $posted_by_id = $_SESSION['id'];

  $log = $_SESSION['user_level']." ".$row_prof['firstname']." ".$row_prof['lastname']." posted news & events at ".date('M d Y - h:i A');
  mysqli_query($conn, "insert into tbl_admin_logs(log_history) values('$log')");
  mysqli_query($conn, "insert into tbl_news_events(title, content, image, posted_by_id, posted_by, date_time_posted) values('$title', '$content', '$storedFile', '$posted_by_id', '$posted_by', '$date_time')");
  $_SESSION['alert'] = 1;
}

if(isset($_POST['edit'])){
  $title = $_POST['edit_title'];
  $content = $_POST['edit_content'];
  $image_hdn = $_POST['edit_image'];
  $storedFile="images/news_events/".basename($_FILES["file"]["name"]);
  if($storedFile == "images/news_events/"){
    $storedFile = $image_hdn;
  }else{
    move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
  }
  mysqli_query($conn, "update tbl_news_events set title='$title', content='$content', image='$storedFile' where news_events_id='".$_GET['edit']." '");
  $_SESSION['alert'] = 3;
}

if(isset($_POST['deleteBtn'])){
  $news_events_id = $_POST['news_events_id'];
  mysqli_query($conn, "delete from tbl_news_events where news_events_id=".$news_events_id);
  $_SESSION['alert'] = 2;
}

if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
  echo "
    <script>
      bootbox.alert('News & Events added')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 2){
  echo "
    <script>
      bootbox.alert('News & Events deleted')
    </script>
  ";
  $_SESSION['alert'] = 0;
}
if(isset($_SESSION['alert']) && $_SESSION['alert'] == 3){
  echo "
    <script>
      bootbox.alert('News & Events updated')
    </script>
  ";
  $_SESSION['alert'] = 0;
}

?>

<section class="content-header">
  <h1>
    News & Events
  </h1>
  <ol class="breadcrumb">
    <?php if(isset($_GET['view'])){ ?>
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li><a href="news_events.php"><i class="fa fa-newspaper-o"> </i> News & Events</a></li>
    <li class="active">View News & Events</li>
    <?php }elseif(isset($_GET['edit'])){ ?>
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li><a href="news_events.php"><i class="fa fa-newspaper-o"> </i> News & Events</a></li>
    <li class="active">Edit News & Events</li>
    <?php }else{ ?>
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li class="active">News & Events</li>
    <?php } ?>
  </ol>
</section>

<?php if(isset($_GET['view'])){ ?>

  <?php
    $query2 = mysqli_query($conn, "select * from tbl_news_events where news_events_id='".$_GET['view']."'");
    if(empty(mysqli_num_rows($query2))){
      include'404.html';
    }else{
      $row2 = mysqli_fetch_assoc($query2);
      ?>
      <section class="content">
        <div class="box">
          <div class="box-body">
            <div class="media">
              <?php if($row2['image'] != "images/news_events/"){ ?>
              <div class="media-left">
                <a href="#">
                  <img class="media-object" src="<?php echo $row2['image']; ?>" width="200" height="200">
                </a>
              </div>
              <?php } ?>
              <div class="media-body">
                <h3 class="media-heading"><a href=""><?php echo $row2['title']; ?></a><br><small><?php echo $row2['date_time_posted']; ?></small></h3><br>
                <p><?php echo $row2['content']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php
    }
  ?>
  
<?php }elseif(isset($_GET['edit'])){ ?>

  <?php
    $query3 = mysqli_query($conn, "select * from tbl_news_events where news_events_id='".$_GET['edit']."'");
    if(empty(mysqli_num_rows($query3))){
      include'404.html';
    }else{
      $row3 = mysqli_fetch_assoc($query3);
      ?>
      <section class="content">
        <div class="box">
          <div class="box-body">
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="edit_image" value="<?php echo $row3['image']; ?>">
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="edit_title" class="form-control" placeholder="News & Events Title" value="<?php echo $row3['title']; ?>">
              </div>
              <div class="form-group">
                <textarea name="edit_content" id="editor" style="height: 500px"><?php echo $row3['content']; ?></textarea>
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="file">
              </div>
              <hr>
              <div class="form-group text-right">
                <button type="submit" name="edit" class="btn btn-success">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <?php
    }
  ?>

<?php }else{ ?>

  <section class="content">

    <div class="box box-success">

      <div class="box-header with-border">
        <h3></h3>
        <div class="box-tools pull-right">
          <a href="" data-toggle="modal" data-target="#addModal" class="btn btn-success btn-sm">Post News & Events</a>
        </div>
      </div>

      <div class="box-body">
        <table id="newseventsTbl" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Title</th>
              <th>Posted By</th>
              <th>Date & Time Posted</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $query = mysqli_query($conn, "select * from tbl_news_events");
              if($row_prof['user_level'] == "Co-admin"){
                $query = mysqli_query($conn, "select * from tbl_news_events where posted_by_id='".$_SESSION['id']."'");
              }
              while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['posted_by']; ?></td>
                  <td><?php echo $row['date_time_posted']; ?></td>
                  <td align="center">
                    <form method="post">
                      <input type="hidden" name="news_events_id" value="<?php echo $row['news_events_id']; ?>">
                      <a href="news_events.php?view=<?php echo $row['news_events_id']; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                      <?php if($row['posted_by_id'] == $_SESSION['id']){ ?>
                      <a href="news_events.php?edit=<?php echo $row['news_events_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
                      <?php }else{ ?>
                      <a href="#" class="btn btn-default btn-sm" disabled ><i class="fa fa-pencil"></i></a>
                      <?php } ?>
                      <button type="submit" name="deleteBtn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
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

<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add News & Events</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="News & Events Title">
          </div>
          <div class="form-group">
            <textarea name="content" id="editor" cols="30" rows="10">Content Here..</textarea>
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" name="file">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="plugins/ckeditor/ckeditor.js"></script>
<script src="plugins/ckeditor/sample.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  initSample();
</script>
<?php include'php/footer.php'; ?>
      
