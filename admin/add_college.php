<?php include'php/header.php'; ?>

<?php

if(isset($_POST['addCollegeHidden'])){
  $collegecode = strtoupper($_POST['collegecode']);
  $collegename = $_POST['collegename'];
  mysqli_query($conn, "insert into tbl_college(collegecode, collegename) values('$collegecode','$collegename')") or die(mysqli_error());

  $_SESSION['alert'] = 1;
  //header("Location: add_college.php");
}

if(isset($_SESSION['alert']) && $_SESSION['alert'] == 1){
  echo "
    <script>
      bootbox.alert('New College Registered')
    </script>
  ";
  $_SESSION['alert'] = 0;
  echo "<script>open('add_college.php','_self')</script>";
}

?>

<section class="content-header">
  <h1>
    College
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li class="active">Add College</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="box box-success">
        <div class="box-body">
          <form action="add_college.php" method="post" id="addCollegForm">
          <input type="hidden" name="addCollegeHidden" value="asd">
          <div class="form-group" id="collegecode_error">
            <label>College Code</label>
            <input type="text" name="collegecode" id="collegecode" placeholder="College Code" class="form-control">
          </div>
          <div class="form-group" id="collegename_error">
            <label>College Name</label>
            <input type="text" name="collegename" id="collegename" placeholder="College Name" class="form-control">
          </div>
          <div class="text-right">
            <button type="button" onclick="addCollegeBtn()" class="btn btn-success">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function addCollegeBtn(){
  var error_a = [];
  var collegecode = document.getElementById("collegecode").value;
  var collegename = document.getElementById("collegename").value;
  $.ajax({
    type: "POST",
    url: "php/ajax/checkcollege.php",
    data: 'id='+collegecode,
    dataType: 'json',
    success: function(msg){
      if(msg.count >= 1){
        error_a.push("error");
        $("#collegecode_error").addClass("has-error");
        $("#collegecode_error label").html("<i class='fa fa-times-circle-o'></i> College Code is already exist");
      }else if(collegecode == ""){
        error_a.push("error");
        $("#collegecode_error").addClass("has-error");
        $("#collegecode_error label").html("<i class='fa fa-times-circle-o'></i> College Code is empty");
      }else{
        $("#collegecode_error").removeClass("has-error");
        $("#collegecode_error label").html("College Code");
      }

      if(collegename == ""){
        error_a.push("error");
        $("#collegename_error").addClass("has-error");
        $("#collegename_error label").html("<i class='fa fa-times-circle-o'></i> College Name is empty");
      }else{
        $("#collegename_error").removeClass("has-error");
        $("#collegename_error label").html("College Name");
      }

      if(error_a.length == 0){
        document.getElementById("addCollegForm").submit();
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
  });
}
</script>

<?php include'php/footer.php'; ?>
      
