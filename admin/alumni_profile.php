<?php include'php/header.php'; ?>

<style>
  hr{
    border: 0;
    height: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    margin: 10px 0 10px 0;
  }

  h4{
    font-weight: 700;
    font-style: italic;
  }
</style>

<section class="content-header">
  <h1>
    Alumni Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li><a href="alumni_manage.php"><i class="fa fa-user"> </i> Alumni List</a></li>
    <li class="acive">Alumni Profile</li>
  </ol>
</section>

<?php
  $query = mysqli_query($conn, "select * from tbl_alumni where student_number=".$_GET['id']);
  $row = mysqli_fetch_assoc($query);

  if(empty($row['alumni_picture'])){
    $alumni_image = "images/alumni_default.png";
  }else{
    $alumni_image = "../".$row['alumni_picture'];
  }

  $query2 = mysqli_query($conn, "select * from tbl_employment where student_number=".$_GET['id']);
  $row2 = mysqli_fetch_assoc($query2);
  $count2 = mysqli_num_rows($query2);
?>

<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo $alumni_image; ?>" alt="User profile picture">
          <h3 class="profile-username text-center"><?php echo $row['firstname']." ".$row['lastname']; ?></h3>
          <p class="text-muted text-center"><em><?php echo $row['email_add']; ?></em></p>
          <p class="text-muted text-center"><?php echo "Class of ".$row['year_graduated']; ?></p>
          <p class="text-muted text-center"><strong><?php echo $row['coursecode']; ?></strong></p>
        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a href="#personal" data-toggle="tab">Personal Information</a></li>
          <li><a href="#professional" data-toggle="tab">Professional Background</a></li>
        </ul>
        <div class="tab-content">
          
          <div class="active tab-pane" id="personal" style="padding: 10px">
            <div class="row">
              <div class="col-md-8">
                <p>Student Number</p>
                <h4><?php echo $row['student_number']; ?></h4>
              </div>
              <div class="col-md-4">
                <?php
                  if(!empty($row['date_updated'])){
                    echo "Last Updated: ".$row['date_updated'];
                  }
                ?>
              </div>
            </div>
            
            <hr>

            <div class="row">
              <div class="col-md-4">
                <p>Gender</p>
                <h4><?php if(empty($row['gender'])){ echo "not set"; }else{ echo $row['gender']; } ?></h4>
              </div>
              <div class="col-md-4">
                <p>Birthdate</p>
                <h4><?php if(empty($row['birthdate'])){ echo "not set"; }else{ echo $row['birthdate']; } ?></h4>
              </div>
              <div class="col-md-4">
                <p>Religion</p>
                <h4><?php if(empty($row['religion'])){ echo "not set"; }else{ echo $row['religion']; } ?></h4>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-8">
                <p>Address</p>
                <h4><?php if(empty($row['address'])){ echo "not set"; }else{ echo $row['address']; } ?></h4>
              </div>
              <div class="col-md-4">
                
              </div>
              <div class="col-md-4">
                <p>Contact Number</p>
                <h4><?php if(empty($row['mobile_number'])){ echo "not set"; }else{ echo $row['mobile_number']; } ?></h4>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-4">
                <p>Father's Name</p>
                <h4><?php if(empty($row['father_name'])){ echo "not set"; }else{ echo $row['father_name']; } ?></h4>
              </div>
              <div class="col-md-4">
                <p>Father's Birtdate</p>
                <h4><?php if(empty($row['father_birthdate'])){ echo "not set"; }else{ echo $row['father_birthdate']; } ?></h4>
              </div>
              <div class="col-md-4">
                <p>Father's Occupation</p>
                <h4><?php if(empty($row['father_occupation'])){ echo "not set"; }else{ echo $row['father_occupation']; } ?></h4>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-4">
                <p>Mother's Name</p>
                <h4><?php if(empty($row['mother_name'])){ echo "not set"; }else{ echo $row['mother_name']; } ?></h4>
              </div>
              <div class="col-md-4">
                <p>Mother's Birtdate</p>
                <h4><?php if(empty($row['mother_birthdate'])){ echo "not set"; }else{ echo $row['mother_birthdate']; } ?></h4>
              </div>
              <div class="col-md-4">
                <p>Mother's Occupation</p>
                <h4><?php if(empty($row['mother_occupation'])){ echo "not set"; }else{ echo $row['mother_occupation']; } ?></h4>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-8">
                <p>Secondary School</p>
                <h4><?php if(empty($row['secondary_school'])){ echo "not set"; }else{ echo $row['secondary_school']; } ?></h4>
              </div>
              <div class="col-md-4">
                <p>Year Graduated</p>
                <h4><?php if(empty($row['secondary_year_graduated'])){ echo "not set"; }else{ echo $row['secondary_year_graduated']; } ?></h4>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-8">
                <p>Primary School</p>
                <h4><?php if(empty($row['primary_school'])){ echo "not set"; }else{ echo $row['primary_school']; } ?></h4>
              </div>
              <div class="col-md-4">
                <p>Year Graduated</p>
                <h4><?php if(empty($row['primary_year_graduated'])){ echo "not set"; }else{ echo $row['primary_year_graduated']; } ?></h4>
              </div>
            </div>

          </div>

          <div class="tab-pane" id="professional" style="padding: 10px">
            <?php if(empty($count2)){ ?>

            <h3>No Employment Data Updates Yet.</h3>

            <?php }else{ ?>
              <div class="row">
                <div class="col-md-8">
                  <p>Employment Status</p>
                  <h4><?php echo $row2['employment_status']; ?></h4>
                </div>
                <div class="col-md-4">
                  <?php
                    if(!empty($row2['date_updated'])){
                      echo "Last Updated: ".$row2['date_updated'];
                    }
                  ?>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-4">
                  <p>Job Title</p>
                  <h4><?php echo $row2['job_title']; ?></h4>
                </div>
                <div class="col-md-4">
                  <p>Year Employed</p>
                  <h4><?php echo $row2['year_employed']; ?></h4>
                </div>
                <div class="col-md-4">
                  <p>Job Level</p>
                  <h4><?php echo $row2['job_level']; ?></h4>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-8">
                  <p>Employer Name</p>
                  <h4><?php echo $row2['company_name']; ?></h4>
                </div>
                <div class="col-md-4">
                  <p>Contact Number</p>
                  <h4><?php echo $row2['company_number']; ?></h4>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-12">
                  <p>Addres</p>
                  <h4><?php echo $row2['company_address']; ?></h4>
                  <div id="map" class="col-md-12"></div>
                </div>
              </div>

            <?php } ?>
          </div>

        </div>
      </div>
    </div>
  </div>

</section>

<script>
  function initMap() {
    <?php
      if(!empty($query2)){
        $latlong = $row2['company_address_lat_long'];
        $part = explode(", ", $latlong);
        $lat = $part[0];
        $long = $part[1];

        if(empty($row2['company_address'])){
          $contentStringPhp = 'Philippines';
        }else{
          $contentStringPhp = $row2['company_address'];
        }
      }
    ?>
    var latlng = {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>},
    });
    var geocoder = new google.maps.Geocoder();
    var center = map.getCenter();

    var contentString = '<?php echo $contentStringPhp; ?>';

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });
    var marker = new google.maps.Marker({
      position: latlng,
      map: map,
    });
    infowindow.open(map, marker);

    

    $('a[href="#professional"]').on('shown.bs.tab', function(e) {
        google.maps.event.trigger(map, 'resize');
        map.setCenter(center);
    });
    $("#map").css("height", 400);
    
  }

</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmeiOJoIToVoOEM7jJFMQn9rSDH_BvRlg&callback=initMap">
</script>

<?php include'php/footer.php'; ?>
      
