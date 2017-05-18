            <?php
              if(isset($_POST['changeOldPass'])){
                $changeOldPass = $_POST['changeOldPass'];
                $changeNewPass = md5($_POST['changeNewPass']);

                mysqli_query($conn, "update tbl_alumni set password='$changeNewPass' where student_number=".$_SESSION['student_number']);
                echo "
                  <script>
                    bootbox.alert('You successfully change your password');
                  </script>
                ";
              }
            ?>
            <div class="modal fade" id="changePass" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Password</h4>
                  </div>
                  <div class="modal-body">
                    <form method="post" id="changePassForm">
                      <input type="hidden" id="change_pass_hdn_id" value="<?php echo $row_prof['student_number']; ?>">
                      <div class="form-group" id="old_pass_error">
                        <label>Old Password</label>
                        <input type="password" class="form-control" name="changeOldPass" id="old_pass" placeholder="Old Password">
                      </div>

                      <div class="form-group" id="new_pass_error">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="changeNewPass" id="changeNewPass" placeholder="New Password">
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="changePassBtn()" class="btn btn-success">Save Password</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="notifModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Job Post Info</h4>
                  </div>
                  <div class="modal-body">
                    <p id="notifModalDiv"></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Okay</button>
                    <a href="edit_post_job.php" class="btn btn-primary" id="notifModalBtn">Review</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      <footer class="main-footer">
        <div class="container text-center">
          &copy; Copyright PHINMA - University of Pangasinan, 2016. All rights reserved.
        </div>
      </footer>
    </div>

    <script src="admin/dist/js/app.min.js"></script>
    <script src="js/strength.min.js"></script>

    <script>
    $(document).ready(function($) {

      $('#notifModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var xmlhttp = new XMLHttpRequest();
        var link = document.getElementById("notifModalBtn");
        link.setAttribute("href", "edit_post_job.php?id="+id);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("notifModalDiv").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "php/ajax/getnotif.php?q=" + id, true);
        xmlhttp.send();
      });
  
      $('#changeNewPass').strength({
        strengthClass: 'strength',
        strengthMeterClass: 'strength_meter',
        strengthButtonClass: '',
        strengthButtonText: '',
        strengthButtonTextToggle: ''
      });

    });

      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#image_upload_preview').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#inputFile").change(function () {
          readURL(this);
      });

      $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      $("#datemask2").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      $("#datemask3").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

      function checkEmploymentStatus(e){
        if(e == "Unemployed"){
          document.getElementById("job_level").disabled = true;
          document.getElementById("job_title").disabled = true;
          document.getElementById("year_employed").disabled = true;
          document.getElementById("company_name").disabled = true;
          document.getElementById("company_number").disabled = true;
          document.getElementById("pac-input").disabled = true;
        }else{
          document.getElementById("job_level").disabled = false;
          document.getElementById("job_title").disabled = false;
          document.getElementById("year_employed").disabled = false;
          document.getElementById("company_name").disabled = false;
          document.getElementById("company_number").disabled = false;
          document.getElementById("pac-input").disabled = false;
        }
      }

    </script>
    <script src="js/md5.min.js"></script>
    <script src="js/validation.js"></script>
  </body>
</html>
