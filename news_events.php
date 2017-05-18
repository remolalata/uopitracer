<?php include'php/header.php'; ?>
<link rel="stylesheet" href="admin/plugins/fullcalendar/fullcalendar.min.css">

<style>
  .fc-today-button, .fc-prev-button, .fc-next-button{display: none}
  .fc-left h2{font-size: 20px}
  .fc-toolbar{padding: 5px 0 5px 0;margin-bottom: 5px;}
</style>

<section class="content-header">
  <h1>
    News & Events
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">News & Events</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-3">

      <div class="box box-success">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo $row_prof_img; ?>" alt="User profile picture" style="width: 160px; height: 160px">
          <h3 class="profile-username text-center"><?php echo $row_prof['firstname']." ".$row_prof['lastname']; ?></h3>
          <p class="text-muted text-center"><?php echo $row_prof['email_add']; ?></p>
          <p class="text-muted text-center">Class of <?php echo $row_prof['year_graduated']; ?></p>
          <p class="text-muted text-center"><?php echo $row_prof['coursecode']; ?></p>
        </div>
      </div>

      <div class="box box-success" style="padding-left: 5px; padding-right: 5px">
        <div class="box-body no-padding">
          <div id="calendar"></div>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <?php
        $query = mysqli_query($conn, "select * from tbl_news_events where news_events_id='".$_GET['id']."'");
        if(empty(mysqli_num_rows($query))){
          ?>
          <div class="box" style="border-top: none; padding: 15px 25px 15px 25px">
            <div class="box-body">
              <h1>No News & Events Post</h1>
            </div>
          </div>
          <?php
        }else{
          while($row = mysqli_fetch_assoc($query)){
           ?>
            <div class="box" style="border-top: none; padding: 15px 25px 15px 25px">
              <div class="box-body">
                <div class="media">
                  <?php if($row['image'] != "images/news_events/"){ ?>
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object" src="admin/<?php echo $row['image']; ?>" width="200" height="200">
                    </a>
                  </div>
                  <?php } ?>
                  <div class="media-body">
                    <h3 class="media-heading"><a href=""><?php echo $row['title']; ?></a><br><small><?php echo $row['date_time_posted']; ?></small></h3><br>
                    <p><?php echo $row['content']; ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php 
          }
        }
      ?>
      
    </div>
  </div>
  
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="admin/plugins/fullcalendar/fullcalendar.min.js"></script>
<script>
  $('#calendar').fullCalendar();
</script>

<?php include'php/footer.php'; ?>