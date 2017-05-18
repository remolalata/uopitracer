function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function numbersonly(e){
  var unicode=e.charCode? e.charCode : e.keyCode
  if (unicode!=8){ 
    if (unicode<48||unicode>57)
      return false 
  }
}

function addAlumniBtn(){
	var error_a = [];
	var student_number = document.getElementById("student_number").value;
	var contact_number = document.getElementById("contact_number").value;
	var email = document.getElementById("email").value;
	$.ajax({
    type: "POST",
    url: "php/ajax/checkstudentnumber.php",
    data: 'id='+encodeURIComponent(student_number)+'&contact_number='+contact_number+'&email='+email,
    dataType: 'json',
    success: function(msg){
    	if(document.getElementById("student_number").value == ""){
			error_a.push("error");
			$("#student_number_error").addClass("has-error");
	    	$("#student_number_error label").html("<i class='fa fa-times-circle-o'></i> Student Number is empty");
		}else if(msg.count == 1){
			error_a.push("error");
			$("#student_number_error").addClass("has-error");
	    	$("#student_number_error label").html("<i class='fa fa-times-circle-o'></i> Student Number is not available");
		}else{
			$("#student_number_error").removeClass("has-error");
	    	$("#student_number_error label").html("Student Number");
		}

		if(document.getElementById("lastname").value == ""){
			error_a.push("error");
			$("#lastname_error").addClass("has-error");
	    	$("#lastname_error label").html("<i class='fa fa-times-circle-o'></i> Last Name is empty");
		}else{
			$("#lastname_error").removeClass("has-error");
	    	$("#lastname_error label").html("Last Name");
		}

		if(document.getElementById("firstname").value == ""){
			error_a.push("error");
			$("#firstname_error").addClass("has-error");
	    	$("#firstname_error label").html("<i class='fa fa-times-circle-o'></i> First Name is empty");
		}else{
			$("#firstname_error").removeClass("has-error");
	    	$("#firstname_error label").html("First Name");
		}

		if(document.getElementById("middlename").value == ""){
			error_a.push("error");
			$("#middlename_error").addClass("has-error");
	    	$("#middlename_error label").html("<i class='fa fa-times-circle-o'></i> Middle Name is empty");
		}else{
			$("#middlename_error").removeClass("has-error");
	    	$("#middlename_error label").html("Middle Name");
		}

		if(document.getElementById("contact_number").value == ""){
			error_a.push("error");
			$("#contact_number_error").addClass("has-error");
	    	$("#contact_number_error label").html("<i class='fa fa-times-circle-o'></i> Contact Number is empty");
		}else if(msg.count2 >= 1){
			error_a.push("error");
			$("#contact_number_error").addClass("has-error");
	    	$("#contact_number_error label").html("<i class='fa fa-times-circle-o'></i> Contact Number is not available");
		}else{
			$("#contact_number_error").removeClass("has-error");
	    	$("#contact_number_error label").html("Contact Number");
		}

		if(document.getElementById("email").value == ""){
		    error_a.push("error");
		    $("#email_error").addClass("has-error");
		    $("#email_error label").html("<i class='fa fa-times-circle-o'></i> Email Address is empty");
		}else if(validateEmail(document.getElementById("email").value) == false){
			error_a.push("error");
			$("#email_error").addClass("has-error");
			$("#email_error label").html("<i class='fa fa-times-circle-o'></i> Email Address is invalid");
		}else if(msg.count3 >= 1){
			$("#email_error").addClass("has-error");
			$("#email_error label").html("<i class='fa fa-times-circle-o'></i> Email Address is not available");
		}else{
			$("#email_error").removeClass("has-error");
			$("#email_error label").html("Email Address");
		}

		if(document.getElementById("select_course").value == ""){
			error_a.push("error");
			$("#course_error").addClass("has-error");
	    	$("#course_error label").html("<i class='fa fa-times-circle-o'></i> Course is empty");
		}else{
			$("#course_error").removeClass("has-error");
	    	$("#course_error label").html("Course");
		}

		if(document.getElementById("year_graduated").value == ""){
			error_a.push("error");
			$("#year_graduated_error").addClass("has-error");
	    	$("#year_graduated_error label").html("<i class='fa fa-times-circle-o'></i> Year Graduated is empty");
		}else{
			$("#year_graduated_error").removeClass("has-error");
	    	$("#year_graduated_error label").html("Year Graduated");
		}



		if(error_a.length == 0){
			document.getElementById("addAlumniForm").submit();
		}else{
		    $('.modal').animate({ scrollTop: 0 }, 'slow');
		  }

    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
}

function editAlumniBtn(){
	var error_b = [];
	var student_number = document.getElementById("student_number_e").value;
	var contact_number = document.getElementById("contact_number").value;
	var email = document.getElementById("email").value;
	$.ajax({
    type: "POST",
    url: "php/ajax/checkstudentnumber.php",
    data: 'id='+encodeURIComponent(student_number)+'&contact_number='+contact_number+'&email='+email,
    dataType: 'json',
    success: function(msg){
    	if(document.getElementById("student_number_e").value == ""){
			error_b.push("error");
			$("#student_number_error_e").addClass("has-error");
	    	$("#student_number_error_e label").html("<i class='fa fa-times-circle-o'></i> Student Number is empty");
		}else{
			$("#student_number_error_e").removeClass("has-error");
	    	$("#student_number_error_e label").html("Student Number");
		}

		if(document.getElementById("lastname_e").value == ""){
			error_b.push("error");
			$("#lastname_error_e").addClass("has-error");
	    	$("#lastname_error_e label").html("<i class='fa fa-times-circle-o'></i> Last Name is empty");
		}else{
			$("#lastname_error_e").removeClass("has-error");
	    	$("#lastname_error_e label").html("Last Name");
		}

		if(document.getElementById("firstname_e").value == ""){
			error_b.push("error");
			$("#firstname_error_e").addClass("has-error");
	    	$("#firstname_error_e label").html("<i class='fa fa-times-circle-o'></i> First Name is empty");
		}else{
			$("#firstname_error_e").removeClass("has-error");
	    	$("#firstname_error_e label").html("First Name");
		}

		if(document.getElementById("middlename_e").value == ""){
			error_b.push("error");
			$("#middlename_error_e").addClass("has-error");
	    	$("#middlename_error_e label").html("<i class='fa fa-times-circle-o'></i> Middle Name is empty");
		}else{
			$("#middlename_error_e").removeClass("has-error");
	    	$("#middlename_error_e label").html("Middle Name");
		}

		if(document.getElementById("contact_number_e").value == ""){
			error_b.push("error");
			$("#contact_number_error_e").addClass("has-error");
	    	$("#contact_number_error_e label").html("<i class='fa fa-times-circle-o'></i> Contact Number is empty");
		}else{
			$("#contact_number_error_e").removeClass("has-error");
	    	$("#contact_number_error_e label").html("Contact Number");
		}

		if(document.getElementById("email_e").value == ""){
		    error_b.push("error");
		    $("#email_error_e").addClass("has-error");
		    $("#email_error_e label").html("<i class='fa fa-times-circle-o'></i> Email Address is empty");
		}else if(validateEmail(document.getElementById("email_e").value) == false){
			error_b.push("error");
			$("#email_error_e").addClass("has-error");
			$("#email_error_e label").html("<i class='fa fa-times-circle-o'></i> Email Address is invalid");
		}else{
			$("#email_error_e").removeClass("has-error");
			$("#email_error_e label").html("Email Address");
		}

		if(document.getElementById("select_course_e").value == ""){
			error_b.push("error");
			$("#course_error_e").addClass("has-error");
	    	$("#course_error_e label").html("<i class='fa fa-times-circle-o'></i> Course is empty");
		}else{
			$("#course_error_e").removeClass("has-error");
	    	$("#course_error_e label").html("Course");
		}

		if(document.getElementById("year_graduated_e").value == ""){
			error_b.push("error");
			$("#year_graduated_error_e").addClass("has-error");
	    	$("#year_graduated_error_e label").html("<i class='fa fa-times-circle-o'></i> Year Graduated is empty");
		}else{
			$("#year_graduated_error_e").removeClass("has-error");
	    	$("#year_graduated_error_e label").html("Year Graduated");
		}



		if(error_b.length == 0){
			document.getElementById("editAlumniForm").submit();
		}else{
		    $('.modal').animate({ scrollTop: 0 }, 'slow');
		}

    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
}

function updateAccountBtn(){
	var error_c = [];
	$.ajax({
	    type: "POST",
	    url: "php/ajax/checkemail_admin.php",
	    data: 'id=1',
	    dataType: 'json',
	    success: function(msg){
	    	console.log(msg.count);
	    	if(document.getElementById("firstname").value == ""){
				error_c.push("error");
				$("#firstname_error").addClass("has-error");
		    	$("#firstname_error label").html("<i class='fa fa-times-circle-o'></i> First Name is empty");
			}else{
				$("#firstname_error").removeClass("has-error");
		    	$("#firstname_error label").html("First Name");
			}

			if(document.getElementById("lastname").value == ""){
				error_c.push("error");
				$("#lastname_error").addClass("has-error");
		    	$("#lastname_error label").html("<i class='fa fa-times-circle-o'></i> Last Name is empty");
			}else{
				$("#lastname_error").removeClass("has-error");
		    	$("#lastname_error label").html("Last Name");
			}

			if(document.getElementById("email").value == ""){
				error_c.push("error");
				$("#email_error").addClass("has-error");
		    	$("#email_error label").html("<i class='fa fa-times-circle-o'></i> Email Address is empty");
			}else{
				$("#email_error").removeClass("has-error");
		    	$("#email_error label").html("Email");
			}

			if(document.getElementById("username").value == ""){
				error_c.push("error");
				$("#username_error").addClass("has-error");
		    	$("#username_error label").html("<i class='fa fa-times-circle-o'></i> Username is empty");
			}else{
				$("#username_error").removeClass("has-error");
		    	$("#username_error label").html("Username");
			}

			if(error_c.length == 0){
				document.getElementById("updateForm").submit();
			}else{
			    $('body').animate({ scrollTop: 0 }, 'slow');
			}
	    }
	})
}

function addCourseBtn(){
	var error_d = [];
	var coursecode_a = document.getElementById("coursecode_a").value;
	$.ajax({
	    type: "POST",
	    url: "php/ajax/checkcourse.php",
	    data: 'id='+coursecode_a,
	    dataType: 'json',
	    success: function(msg){

	    	if(document.getElementById("coursecode_a").value == ""){
	    		error_d.push("error");
	    		$("#coursecode_error_a").addClass("has-error");
		    	$("#coursecode_error_a label").html("<i class='fa fa-times-circle-o'></i> Course Code is empty");
			}else if(msg.count >= 1){
				error_d.push("error");
				$("#coursecode_error_a").addClass("has-error");
		    	$("#coursecode_error_a label").html("<i class='fa fa-times-circle-o'></i> Course Code is not available");
			}else{
				$("#coursecode_error_a").removeClass("has-error");
		    	$("#coursecode_error_a label").html("Course Code");
			}

			if(document.getElementById("coursename_a").value == ""){
	    		error_d.push("error");
	    		$("#coursename_error_a").addClass("has-error");
		    	$("#coursename_error_a label").html("<i class='fa fa-times-circle-o'></i> Course Name is empty");
			}else{
				$("#coursename_error_a").removeClass("has-error");
		    	$("#coursename_error_a label").html("Course Name");
			}
	    	

			if(error_d.length == 0){
				document.getElementById("addCourseForm").submit();
			}else{
			    $('.modal').animate({ scrollTop: 0 }, 'slow');
			}
	    }
	})
}

function addJobBtn(){
	var error_e = [];
	if(document.getElementById("job_title_a").value == ""){
		error_e.push("error");
		$("#job_title_error_a").addClass("has-error");
    	$("#job_title_error_a label").html("<i class='fa fa-times-circle-o'></i> Job Title is empty");
	}else{
		$("#job_title_error_a").removeClass("has-error");
    	$("#job_title_error_a label").html("Job Title");
	}

	if(document.getElementById("category_a").value == ""){
		error_e.push("error");
		$("#category_error_a").addClass("has-error");
    	$("#category_error_a label").html("<i class='fa fa-times-circle-o'></i> Category is empty");
	}else{
		$("#category_error_a").removeClass("has-error");
    	$("#category_error_a label").html("Category");
	}

	if(document.getElementById("range1").value == "" && document.getElementById("range2").value == ""){
		error_e.push("error");
		$("#salary_error_a").addClass("has-error");
    	$("#salary_error_a label").html("<i class='fa fa-times-circle-o'></i> Salary Range per Month is empty");
	}else if(document.getElementById("range1").value >= document.getElementById("range2").value){
		error_e.push("error");
		$("#salary_error_a").addClass("has-error");
    	$("#salary_error_a label").html("<i class='fa fa-times-circle-o'></i> Salary Range per Month is invalid");
	}else{
		$("#salary_error_a").removeClass("has-error");
    	$("#salary_error_a label").html("Salary Range per Month");
	}

	if(document.getElementById("company_name_a").value == ""){
		error_e.push("error");
		$("#company_name_error_a").addClass("has-error");
    	$("#company_name_error_a label").html("<i class='fa fa-times-circle-o'></i> Company Name is empty");
	}else{
		$("#company_name_error_a").removeClass("has-error");
    	$("#company_name_error_a label").html("Company Name");
	}

	if(document.getElementById("email_a").value == ""){
		error_e.push("error");
		$("#email_error_a").addClass("has-error");
    	$("#email_error_a label").html("<i class='fa fa-times-circle-o'></i> Company Email is empty");
	}else if(validateEmail(document.getElementById("email_a").value) == false){
		error_e.push("error");
		$("#email_error_a").addClass("has-error");
		$("#email_error_a label").html("<i class='fa fa-times-circle-o'></i> Company Email is invalid");
	}else{
		$("#email_error_a").removeClass("has-error");
    	$("#email_error_a label").html("Company Email");
	}

	if(document.getElementById("contact_number_a").value == ""){
		error_e.push("error");
		$("#contact_number_error_a").addClass("has-error");
    	$("#contact_number_error_a label").html("<i class='fa fa-times-circle-o'></i> Company Number is empty");
	}else{
		$("#contact_number_error_a").removeClass("has-error");
    	$("#contact_number_error_a label").html("Company Number");
	}

	if(document.getElementById("address_a").value == ""){
		error_e.push("error");
		$("#address_error_a").addClass("has-error");
    	$("#address_error_a label").html("<i class='fa fa-times-circle-o'></i> Company Address is empty");
	}else{
		$("#address_error_a").removeClass("has-error");
    	$("#address_error_a label").html("Company Address");
	}

	if(document.getElementById("location_a").value == ""){
		error_e.push("error");
		$("#location_error_a").addClass("has-error");
    	$("#location_error_a label").html("<i class='fa fa-times-circle-o'></i> Location is empty");
	}else{
		$("#location_error_a").removeClass("has-error");
    	$("#location_error_a label").html("Location");
	}

	if(document.getElementById("description_a").value == ""){
		error_e.push("error");
		$("#description_error_a").addClass("has-error");
    	$("#description_error_a label").html("<i class='fa fa-times-circle-o'></i> Description is empty");
	}else{
		$("#description_error_a").removeClass("has-error");
    	$("#description_error_a label").html("Description");
	}

	if(error_e.length == 0){
		document.getElementById("addJobForm").submit();
	}else{
	    $('body').animate({ scrollTop: 0 }, 'slow');
	}
}

function addAdminBtn(){
	var error_f = [];
	var username_a = document.getElementById("username_a").value;
	var email_a = document.getElementById("email_a").value;
	$.ajax({
	    type: "POST",
	    url: "php/ajax/checkcoadmin.php",
	    data: 'id='+username_a+'&email='+email_a,
	    dataType: 'json',
	    success: function(msg){

	    	if(document.getElementById("firstname_a").value == ""){
				error_f.push("error");
				$("#firstname_error_a").addClass("has-error");
		    	$("#firstname_error_a label").html("<i class='fa fa-times-circle-o'></i> First Name is empty");
			}else{
				$("#firstname_error_a").removeClass("has-error");
		    	$("#firstname_error_a label").html("First Name");
			}

			if(document.getElementById("lastname_a").value == ""){
				error_f.push("error");
				$("#lastname_error_a").addClass("has-error");
		    	$("#lastname_error_a label").html("<i class='fa fa-times-circle-o'></i> Last Name is empty");
			}else{
				$("#lastname_error_a").removeClass("has-error");
		    	$("#lastname_error_a label").html("Last Name");
			}

			if(document.getElementById("username_a").value == ""){
				error_f.push("error");
				$("#username_error_a").addClass("has-error");
		    	$("#username_error_a label").html("<i class='fa fa-times-circle-o'></i> Username is empty");
			}else if(msg.count >= 1){
				error_f.push("error");
				$("#username_error_a").addClass("has-error");
		    	$("#username_error_a label").html("<i class='fa fa-times-circle-o'></i> Username is not available");
			}else{
				$("#username_error_a").removeClass("has-error");
		    	$("#username_error_a label").html("Username");
			}

			if(document.getElementById("college_a").value == ""){
				error_f.push("error");
				$("#college_error_a").addClass("has-error");
		    	$("#college_error_a label").html("<i class='fa fa-times-circle-o'></i> College is empty");
			}else{
				$("#college_error_a").removeClass("has-error");
		    	$("#college_error_a label").html("College");
			}

			if(document.getElementById("email_a").value == ""){
				error_f.push("error");
				$("#email_error_a").addClass("has-error");
		    	$("#email_error_a label").html("<i class='fa fa-times-circle-o'></i> Email Address is empty");
			}else if(validateEmail(document.getElementById("email_a").value) == false){
				error_f.push("error");
				$("#email_error_a").addClass("has-error");
				$("#email_error_a label").html("<i class='fa fa-times-circle-o'></i> Email Address is invalid");
			}else if(msg.count2 >= 1){
				error_f.push("error");
				$("#email_error_a").addClass("has-error");
				$("#email_error_a label").html("<i class='fa fa-times-circle-o'></i> Email Address is not available");
			}else{
				$("#email_error_a").removeClass("has-error");
		    	$("#email_error_a label").html("Email Address");
			}

			if(error_f.length == 0){
				document.getElementById("addAdminForm").submit();
			}else{
			    $('.modal').animate({ scrollTop: 0 }, 'slow');
			}
	    }
	})
}