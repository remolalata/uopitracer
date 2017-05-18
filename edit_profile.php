<?php include'php/header.php'; ?>

<?php
  if(isset($_POST['lastname'])){
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $address = $_POST['address'];
    $mobile_number = $_POST['mobile_number'];
    $father_name = $_POST['father_name'];
    $father_occupation = $_POST['father_occupation'];
    $mother_name = $_POST['mother_name'];
    $mother_occupation = $_POST['mother_occupation'];
    $secondary_school = $_POST['secondary_school'];
    $secondary_year_graduated = $_POST['secondary_year_graduated'];
    $primary_school = $_POST['primary_school'];
    $primary_year_graduated = $_POST['primary_year_graduated'];
    $birthdate = $_POST['birthdate'];
    $father_birthdate = $_POST['father_birthdate'];
    $mother_birthdate = $_POST['mother_birthdate'];
    $date = date('M d Y');

    $storedFile = "images/alumni/".basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"],$storedFile);
    if($storedFile == "images/alumni/"){
      $storedFile = $row_prof_img;
    }
    mysqli_query($conn, "update tbl_alumni set lastname='$lastname', firstname='$firstname', middlename='$middlename', email_add='$email', alumni_picture='$storedFile', gender='$gender', birthdate='$birthdate', mobile_number='$mobile_number', religion='$religion', address='$address', father_name='$father_name', father_birthdate='$father_birthdate', father_occupation='$father_occupation', mother_name='$mother_name', mother_birthdate='$mother_birthdate', mother_occupation='$mother_occupation', secondary_school='$secondary_school', secondary_year_graduated='$secondary_year_graduated', primary_school='$primary_school', primary_year_graduated='$primary_year_graduated', date_updated='$date' where student_number=".$_SESSION['student_number']) or die(mysqli_error($conn));
    $_SESSION['alert'] = 1;
    header('location: profile.php');
  }
?>
<section class="content-header">
  <h1>
    Edit Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
    <li class="active">Edit Profile</li>
  </ol>
</section>

<section class="content">
  <div class="box box-success">
    <div class="box-body">
      <form method="post" enctype="multipart/form-data" id="editProfileForm">

        <div class="row">
          <div class="col-md-3 text-center">
            <img src="<?php echo $row_prof_img ?>" id="image_upload_preview" width="160" height="160" class="img-circle" alt="User Image" style="border: 3px solid #d2d6de"><br><br>
            <input type="file" name="file" id="inputFile">

            <hr class="hidden-md hidden-lg">
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="lastname_error">
                  <label>Last Name</label>
                  <div></div>
                  <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $row_prof['lastname']; ?>" placeholder="Last Name">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="firstname_error">
                  <label>First Name</label>
                  <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $row_prof['firstname']; ?>" placeholder="First Name">
                </div>
              </div>
              <div class="col-md-4 col-sm-4 ">
                <div class="form-group" id="middlename_error">
                  <label>Middle Name</label>
                  <input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo $row_prof['middlename']; ?>" placeholder="Middle Name">
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="email_error">
                  <label>Email Add</label>
                  <input type="text" name="email" id="email" class="form-control" value="<?php echo $row_prof['email_add']; ?>" placeholder="Email Address" >
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="gender_error">
                  <label>Gender</label>
                  <select name="gender" id="gender" class="form-control">
                  <option value="">Select</option>
                  <option value="Male" <?php if($row_prof['gender'] == "Male"){ echo "selected"; } ?> >Male</option>
                  <option value="Female" <?php if($row_prof['gender'] == "Female"){ echo "selected"; } ?> >Female</option>
                </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="datemask_error">
                  <label>Birthdate</label>
                  <input type="text" name="birthdate" class="form-control" id="datemask" value="<?php echo $row_prof['birthdate']; ?>">
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="religion_error">
                  <label>Religion</label>
                  <input type="text" name="religion" id="religion" class="form-control" value="<?php echo $row_prof['religion']; ?>" placeholder="Religion">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="address_error">
                  <label>Address</label>
                  <input type="text" name="address" id="address" class="form-control" value="<?php echo $row_prof['address']; ?>" placeholder="Address">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="mobile_error">
                  <label>Mobile</label>
                  <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="<?php echo $row_prof['mobile_number']; ?>" placeholder="(63) 977-000-0000" title="e.g. (63) 977-000-0000" pattern="^\([0-9]{3}\)\s[0-9]{3}-[0-9]{3}-[0-9]{4}$" onkeypress="return numbersonly(event)">
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="father_name_error">
                  <label>Father's Name</label>
                  <input type="text" name="father_name" id="father_name" class="form-control" value="<?php echo $row_prof['father_name']; ?>" placeholder="Father's Name">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="father_birthdate_error">
                  <label>Father's Birthdate</label>
                  <input type="text" name="father_birthdate" id="datemask2" class="form-control" value="<?php echo $row_prof['father_birthdate']; ?>" id="datemask2">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="father_occupation_error">
                  <label>Father's Occupation</label>
                  <input type="text" name="father_occupation" id="father_occupation" class="form-control" value="<?php echo $row_prof['father_occupation']; ?>" placeholder="Father's Occupation">
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="mother_name_error">
                  <label>Mother's Name</label>
                  <input type="text" name="mother_name" id="mother_name" class="form-control" value="<?php echo $row_prof['mother_name']; ?>" placeholder="Mother's Name">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="mother_birthdate_error">
                  <label>Mother's Birthdate</label>
                  <input type="text" name="mother_birthdate" id="datemask3" class="form-control" value="<?php echo $row_prof['mother_birthdate']; ?>">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="mother_occupation_error">
                  <label>Mother's Occupation</label>
                  <input type="text" name="mother_occupation" id="mother_occupation" class="form-control" value="<?php echo $row_prof['mother_occupation']; ?>" placeholder="Mother's Occupation">
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-8 col-sm-8">
                <div class="form-group" id="secondary_school_error">
                  <label>Secondary School</label>
                  <input type="text" name="secondary_school" id="secondary_school" class="form-control" value="<?php echo $row_prof['secondary_school']; ?>" placeholder="Secondary School">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="secondary_year_graduated_error">
                  <label>Year Graduated</label>
                  <select class="form-control" name="secondary_year_graduated" id="secondary_year_graduated">
                  <option value="">Select</option>
                    <?php
                      for($x=1995;$x<=2013;$x++){
                        ?>
                          <option value='<?php echo $x; ?>' <?php if($row_prof['secondary_year_graduated'] == $x){ echo "selected"; } ?> <?php if($row_prof['year_graduated']-6 < $x ){echo "disabled";} ?>>
                            <?php echo $x; ?>
                          </option>
                        <?php
                      }
                    ?>
                </select>
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-8 col-sm-8">
                <div class="form-group" id="primary_school_error">
                  <label>Primary School</label>
                  <input type="text" name="primary_school" id="primary_school" class="form-control" value="<?php echo $row_prof['primary_school']; ?>" placeholder="Primary School">
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="form-group" id="primary_year_graduated_error">
                  <label>Year Graduated</label>
                  <select class="form-control" name="primary_year_graduated" id="primary_year_graduated">
                  <option value="">Select</option>
                    <?php
                      for($x=1995;$x<=2013;$x++){
                        ?>
                          <option value='<?php echo $x; ?>' <?php if($row_prof['primary_year_graduated'] == $x){ echo "selected"; } ?> <?php if($row_prof['year_graduated']-2 < $x ){echo "disabled";} ?>>
                            <?php echo $x; ?>
                          </option>
                        <?php
                      }
                    ?>
                </select>
                </div>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md 3 col-md-offset-9 text-right" style="padding-right: 15px">
                <button type="button" onclick="editProfileBtn()" class="btn btn-success">Update Profile</button>
              </div>
            </div>

          </div>
        </div>

      </form>
    </div>
  </div>
</section>

<script src="admin/plugins/input-mask/jquery.inputmask.js"></script>
<script src="admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
function validate_int(myEvento) {
  if ((myEvento.charCode >= 48 && myEvento.charCode <= 57) || myEvento.keyCode == 9 || myEvento.keyCode == 10 || myEvento.keyCode == 13 || myEvento.keyCode == 8 || myEvento.keyCode == 116 || myEvento.keyCode == 46 || (myEvento.keyCode <= 40 && myEvento.keyCode >= 37)) {
    dato = true;
  } else {
    dato = false;
  }
  return dato;
}

function phone_number_mask() {
  var myMask = "(63) ___-___-____";
  var myCaja = document.getElementById("mobile_number");
  var myText = "";
  var myNumbers = [];
  var myOutPut = ""
  var theLastPos = 1;
  myText = myCaja.value;
  //get numbers
  for (var i = 0; i < myText.length; i++) {
    if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
      myNumbers.push(myText.charAt(i));
    }
  }
  //write over mask
  for (var j = 0; j < myMask.length; j++) {
    if (myMask.charAt(j) == "_") { //replace "_" by a number
      if (myNumbers.length == 0)
        myOutPut = myOutPut + myMask.charAt(j);
      else {
        myOutPut = myOutPut + myNumbers.shift();
        theLastPos = j + 1; //set caret position
      }
    } else {
      myOutPut = myOutPut + myMask.charAt(j);
    }
  }
  document.getElementById("mobile_number").value = myOutPut;
  document.getElementById("mobile_number").setSelectionRange(theLastPos, theLastPos);
}

document.getElementById("mobile_number").onkeypress = validate_int;
document.getElementById("mobile_number").onkeyup = phone_number_mask;
</script>
<?php include'php/footer.php'; ?>
