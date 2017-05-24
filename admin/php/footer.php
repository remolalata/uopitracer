				</div>

			<footer class="main-footer text-right">
			&copy; Copyright PHINMA - University of Pangasinan, 2016. All rights reserved.
			</footer>
		</div>


	<script src="dist/js/app.min.js"></script>

	<script>
    $(function () {

      $("#alumniUpdatedTbl").DataTable();
      $("#courseTbl").DataTable();
      $("#alumniEmployedTbl").DataTable();
      $("#newseventsTbl").DataTable();
      $("#adminUserTbl").DataTable();
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

    $('#deleteModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var no = button.data('no');
      var modal = $(this);
      modal.find('.modal-body #student_number_hdn').val(no);
    });

    $('#sendSmsModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var modal = $(this);
      modal.find('.modal-body #student_number').val(id);
    });

    $('#sendEmailModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('idd');
      var modal = $(this);
      modal.find('.modal-body #student_number').val(id);
    });

    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var noo = button.data('noo');
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("editAlumniBox").innerHTML = xmlhttp.responseText;
          }
      };
      xmlhttp.open("GET", "php/ajax/editAlumni.php?q=" + noo, true);
      xmlhttp.send();
			$("#contact_number_e").mask("(+63) 999-999-9999",{placeholder:"(+63) 000-000-0000"});
    });

    function changeCourse(){
      document.getElementById("changeChartForm").submit();
    }

    $('#deleteCourseModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('coursecode');
      var modal = $(this);
      modal.find('.modal-body #coursecode').val(id);
    });

    $('#editCourseModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('coursecode');
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("editCourseDiv").innerHTML = xmlhttp.responseText;
          }
      };
      xmlhttp.open("GET", "php/ajax/editCourse.php?q=" + id, true);
      xmlhttp.send();
    });

    $('#select-all').click(function(event) {
      if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
      }else { // Iterate each checkbox
        $(":checkbox").each(function() {
          this.checked = false;
        });
      }
    });

    $('#select_course').change(function () {
      if ($(this).val() == "1") {
        $("#addModal").modal("hide");
        $("#createCourse").modal("show");
      }
    });

    $('#editAdminModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('idd');
      console.log(id);
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              document.getElementById("editAdminDiv").innerHTML = xmlhttp.responseText;
          }
      };
      xmlhttp.open("GET", "php/ajax/editAdmin.php?q=" + id, true);
      xmlhttp.send();
    });

  </script>
  <script src="js/validation.js"></script>

	</body>
</html>
