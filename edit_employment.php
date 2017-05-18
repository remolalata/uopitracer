<?php include'php/header.php'; ?>

<style>
  .content-wrapper .container{
    padding: 0 100px 0 100px;
  }

  @media (max-width: 767px) {
    .content-wrapper .container{
      padding: 15px;
    }
  }
</style>

<?php
  if(isset($_POST['employment_status'])){
    $college = $row_prof['college'];
    $employment_status = $_POST['employment_status'];
    $job_level = $_POST['job_level'];
    $job_title = $_POST['job_title'];
    $year_employed = $_POST['year_employed'];
    $company_name = $_POST['company_name'];
    $company_number = $_POST['company_number'];
    $company_address = $_POST['company_address'];
    $company_address_lat_long = $_POST['lat'].", ".$_POST['long'];
    $date = date('M d Y');

    $query = mysqli_query($conn, "select * from tbl_employment where student_number=".$_SESSION['student_number']);
    $count = mysqli_num_rows($query);

    if(empty($count)){
      mysqli_query($conn, "insert into tbl_employment(student_number, college, employment_status, job_title, year_employed, job_level, company_name, company_address, company_address_lat_long, company_number, date_updated) values('".$_SESSION['student_number']."', '$college', '$employment_status', '$job_title', '$year_employed', '$job_level', '$company_name', '$company_address', '$company_address_lat_long', '$company_number', '$date')");
    }else{
      mysqli_query($conn, "update tbl_employment set college='$college', employment_status='$employment_status', job_title='$job_title', year_employed='$year_employed', job_level='$job_level', company_name='$company_name', company_address='$company_address', company_address_lat_long='$company_address_lat_long', company_number='$company_number', date_updated='$date' where student_number=".$_SESSION['student_number']) or die(mysqli_error());
    }
    $_SESSION['alert'] = 2;
    header('location: profile.php');
  }

  $query2 = mysqli_query($conn, "select * from tbl_employment where student_number=".$_SESSION['student_number']);
  if(!empty(mysqli_num_rows($query2))){
    $row2 = mysqli_fetch_assoc($query2);
  }else{
    $row2 = ["employment_status" => "", "job_level" => "", "job_title" => "", "year_employed" => "", "company_name" => "", "company_number" => "", "company_address" => ""];
  }
?>

<section class="content-header">
  <h1>
    Details of Present Employment
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
    <li class="active">Add/Edit Employment</li>
  </ol>
</section>

<section class="content">
  <div class="box box-success">
    <div class="box-body">
      <form method="post" id="editEmploymentForm">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="form-group" id="employment_status_error">
            <input type="hidden" id="student_number1" value="<?php echo $row_prof['student_number']; ?>">
            <label>Present Employment Status</label>
            <select name="employment_status" id="employment_status" onchange="checkEmploymentStatus(this.value)" class="form-control">
            <option value="">Select</option>
            <option value="Regular/Permanent" <?php if($row2['employment_status'] == "Regular/Permanent"){ echo "selected"; } ?> >Regular/Permanent</option>
            <option value="Contractual" <?php if($row2['employment_status'] == "Contractual"){ echo "selected"; } ?> >Contractual</option>
            <option value="Temporary" <?php if($row2['employment_status'] == "Temporary"){ echo "selected"; } ?> >Temporary</option>
            <option value="Casual" <?php if($row2['employment_status'] == "Casual"){ echo "selected"; } ?> >Casual</option>
            <option value="Self-Employed" <?php if($row2['employment_status'] == "Self-Employed"){ echo "selected"; } ?> >Self-Employed</option>
            <option value="Unemployed" <?php if($row2['employment_status'] == "Unemployed"){ echo "selected"; } ?> >Unemployed</option>
          </select>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="form-group" id="job_level_error" >
            <label>Present Job Level</label>
            <select name="job_level" id="job_level" class="form-control" <?php if($row2['employment_status'] == "Unemployed"){ echo "disabled"; } ?> >
            <option value="">Select</option>
            <option value="Rank or Clerical" <?php if($row2['job_level'] == "Rank or Clerical"){ echo "selected"; } ?> >Rank or Clerical</option>
            <option value="Professional, Technical or Supervisory" <?php if($row2['job_level'] == "Professional, Technical or Supervisory"){ echo "selected"; } ?> >Professional, Technical or Supervisory</option>
            <option value="Manager or Executive" <?php if($row2['job_level'] == "Manager or Executive"){ echo "selected"; } ?> >Manager or Executive</option>
          </select>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="form-group" id="job_title_error">
            <label>Job Title (e.g. Teacher, Engineer)</label>
            <input type="text" name="job_title" id="job_title" class="form-control" value="<?php echo $row2['job_title']; ?>" placeholder="Job Title" <?php if($row2['employment_status'] == "Unemployed"){ echo "disabled"; } ?> >
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="form-group" id="year_employed_error">
            <label>Year Employed</label>
            <select class="form-control" name="year_employed" id="year_employed" <?php if($row2['employment_status'] == "Unemployed"){ echo "disabled"; } ?> >
            <option value="">Select</option>
              <?php
                for($x=2011;$x<=date('Y');$x++){
                  if($row_prof['year_graduated'] <= $x){ ?>
                  <option value='<?php echo $x; ?>' <?php if($row2['year_employed'] == $x){ echo "selected"; } ?> ><?php echo $x; ?>
                  </option>
                  <?php
                  }
                }
              ?>
          </select>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="form-group" id="company_name_error">
            <label>Company Name</label>
            <input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $row2['company_name']; ?>" placeholder="Company Name" <?php if($row2['employment_status'] == "Unemployed"){ echo "disabled"; } ?> >
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="form-group" id="company_number_error">
            <label>Company Contact Number</label>
            <input type="text" name="company_number" id="company_number" class="form-control" value="<?php echo $row2['company_number']; ?>" placeholder="Company Number" <?php if($row2['employment_status'] == "Unemployed"){ echo "disabled"; } ?> >
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="form-groupr" id="pac-input_error">
            <label>Company Address</label>
          </div>
          <?php
            if(!empty($row2['company_address_lat_long'])){
              $alatlong = $row2['company_address_lat_long'];
              $apart = explode(", ", $alatlong);
              $alat = $apart[0];
              $along = $apart[1];
            }
          ?>
          <!--<input type="text" name="company_address" class="form-control" value="<?php echo $row2['company_address']; ?>" placeholder="Company Address">-->
          <input id="pac-input" class="controls" type="text" placeholder="Enter a location" <?php if($row2['employment_status'] == "Unemployed"){ echo "disabled"; } ?> style="display: block; width: 80%">
          <input type="hidden" id="namePlace" name="company_address" value="<?php echo $row2['company_address']; ?>">
          <input type="hidden" id="lat" name="lat" value="<?php echo $apart[0]; ?>">
          <input type="hidden" id="long" name="long" value="<?php echo $apart[1]; ?>">
          <div id="map" class="col-md-12" style="height: 400px"></div>
        </div>
      </div>

      <hr>

      <div class="text-right">
        <button type="button" onclick="editEmploymentBtn()" class="btn btn-success">Save</button>
      </div>
      </form>
    </div>
  </div>
</section>

<script>
  function initMap() {

    <?php
      if(empty($row2['company_address_lat_long'])){
        $lat = 12.879721;
        $long = 121.774017;
      }else{
        $latlong = $row2['company_address_lat_long'];
        $part = explode(", ", $latlong);
        $lat = $part[0];
        $long = $part[1];
      }
    ?>

    var latlng = {lat: <?php echo $lat; ?>, lng: <?php echo $long; ?>};
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: <?php if(empty($row2['company_address_lat_long'])){ echo 5; }else{ echo 17; } ?>,
    });


    var input = /** @type {!HTMLInputElement} */(
        document.getElementById('pac-input'));

    var types = document.getElementById('type-selector');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    <?php
      if(empty($row2['company_address'])){
        $contentStringPhp = 'Philippines';
      }else{
        $contentStringPhp = $row2['company_address'];
      }
    ?>

    var contentString = '<?php echo $contentStringPhp; ?>';

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });
    var marker = new google.maps.Marker({
      position: latlng,
      map: map,
      anchorPoint: new google.maps.Point(0, -29)
    });
    infowindow.open(map, marker);

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      document.getElementById('lat').value = place.geometry.location.lat();
      document.getElementById('long').value = place.geometry.location.lng();
      if (!place.geometry) {
        window.alert("Autocomplete's returned place contains no geometry");
        return;
      }

      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17); 
      }
      marker.setIcon(/** @type {google.maps.Icon} */({
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35)
      }));
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }
      document.getElementById('namePlace').value = place.name + ', ' + address;
      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      infowindow.open(map, marker);
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmeiOJoIToVoOEM7jJFMQn9rSDH_BvRlg&libraries=places&callback=initMap"
    async defer></script>

<?php include'php/footer.php'; ?>