<?php include'php/header.php'; ?>
<link rel="stylesheet" href="admin/plugins/fullcalendar/fullcalendar.min.css">

<style>
  .fc-today-button, .fc-prev-button, .fc-next-button{display: none}
  .fc-left h2{font-size: 20px}
  .fc-toolbar{padding: 5px 0 5px 0;margin-bottom: 5px;}
</style>

<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  </ol>
</section>

<section class="content">
  <div class="callout callout-success" id="welcomeDiv">
    <h4>Welcome <?php echo $row_prof['firstname']." ".$row_prof['lastname']; ?>!</h4>
    <p>PHINMA-UPANG continuously conducts tracer studies to determine the employment status of its graduates from various programs offered by its different schools/colleges. Hence, this online tracer system was devised to gather pertinent information from you. This will also serve as a tool to update you on the events, milestones and activities of the university.

We will be happy to know your whereabouts, connections, accomplishments and achievements, innovations, business etc. Rest assured that the information that you will provide will be kept strictly confidential. Thank you.

 </p>
  </div>

  <div class="row">
    <div class="col-md-3 hidden-xs">

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
        $query = mysqli_query($conn, "select * from tbl_news_events order by news_events_id desc");
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
                <div class="row">
                  <?php if($row['image'] == "images/news_events/"){ ?>
                  <div class="col-md-12 col-xs-12">
                    <h3 style="margin-top: 0"><a href=""><?php echo $row['title']; ?></a><br><small style="font-style: 14px"><?php echo $row['date_time_posted']; ?></small></h3><br>
                    <p><?php echo substr($row['content'], 0, 450); ?>...</p>
                    <p><a href="news_events.php?id=<?php echo $row['news_events_id']; ?>" class="btn btn-success btn-sm">See More</a></p>
                  </div>
                  <?php }else{ ?>
                  <div class="col-md-4 col-xs-12">
                    <img class="img-responsive" src="admin/<?php echo $row['image']; ?>">
                  </div>
                  <div class="col-md-8 col-xs-12">
                    <h3 style="margin-top: 0"><a href=""><?php echo $row['title']; ?></a><br><small style="font-style: 14px"><?php echo $row['date_time_posted']; ?></small></h3><br>
                    <p><?php echo substr($row['content'], 0, 450); ?>...</p>
                    <p><a href="news_events.php?id=<?php echo $row['news_events_id']; ?>" class="btn btn-success btn-sm">See More</a></p>
                  </div>
                  <?php } ?>
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
  setTimeout(function(){
    $("#welcomeDiv").hide(2000);
  }, 3000);

  $('#calendar').fullCalendar();
</script>

<?php include'php/footer.php'; ?>
