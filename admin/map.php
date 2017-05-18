<?php include'php/header.php'; ?>

<section class="content-header">
  <h1>
    Map
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li class="active">Map</li>
  </ol>
</section>

<section class="content">

  <div class="box box-success">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div id="map" style="height: 500px"></div>
        </div>
      </div>
    </div>
  </div>

</section>

<script>
  var map;
  function initMap() {
    var myLatLng = {lat: 12.879721, lng: 121.774017};
    map = new google.maps.Map(document.getElementById('map'), {
      center:  myLatLng,
      zoom: 5
    });

    var locations = [
      <?php
        $query = mysqli_query($conn, "select * from tbl_employment");
        if($row_prof['user_level'] == "Co-admin"){
          $query = mysqli_query($conn, "select * from tbl_employment where college='".$row_prof['college']."'");
        }
        while($row = mysqli_fetch_assoc($query)){
          $latlong = $row['company_address_lat_long'];
          $part = explode(", ", $latlong);
          $lat = $part[0];
          $long = $part[1];
          ?>
            ['<?php echo $row["company_address"]; ?>', <?php echo $lat; ?>, <?php echo $long; ?>, 4],
          <?php
        }
      ?>
    ];

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmeiOJoIToVoOEM7jJFMQn9rSDH_BvRlg&callback=initMap">
</script>

<?php include'php/footer.php'; ?>
      
