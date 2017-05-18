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

function editProfileBtn(){
  var errors = [];
  if(document.getElementById("lastname").value == ""){
    errors.push("error");
    $("#lastname_error").addClass("has-error");
    $("#lastname_error label").html("<i class='fa fa-times-circle-o'></i> Last Name is empty");
  }else{
    $("#lastname_error").removeClass("has-error");
    $("#lastname_error label").html("Last Name");
  }

  if(document.getElementById("firstname").value == ""){
    errors.push("error");
    $("#firstname_error").addClass("has-error");
    $("#firstname_error label").html("<i class='fa fa-times-circle-o'></i> First Name is empty");
  }else{
    $("#firstname_error").removeClass("has-error");
    $("#firstname_error label").html("First Name");
  }

  if(document.getElementById("middlename").value == ""){
    errors.push("error");
    $("#middlename_error").addClass("has-error");
    $("#middlename_error label").html("<i class='fa fa-times-circle-o'></i> Middle Name is empty");
  }else{
    $("#middlename_error").removeClass("has-error");
    $("#middlename_error label").html("Middle Name");
  }

  if(document.getElementById("email").value == ""){
    errors.push("error");
    $("#email_error").addClass("has-error");
    $("#email_error label").html("<i class='fa fa-times-circle-o'></i> Email Add is empty");
  }else if(validateEmail(document.getElementById("email").value) == false){
    errors.push("error");
    $("#email_error").addClass("has-error");
    $("#email_error label").html("<i class='fa fa-times-circle-o'></i> Email Add is invalid");
  }else{
    $("#email_error").removeClass("has-error");
    $("#email_error label").html("Email Add");
  }

  if(document.getElementById("gender").value == ""){
    errors.push("error");
    $("#gender_error").addClass("has-error");
    $("#gender_error label").html("<i class='fa fa-times-circle-o'></i> Select your gender");
  }else{
    $("#gender_error").removeClass("has-error");
    $("#gender_error label").html("Gender");
  }

  if(document.getElementById("datemask").value == ""){
    errors.push("error");
    $("#datemask_error").addClass("has-error");
    $("#datemask_error label").html("<i class='fa fa-times-circle-o'></i> Birthdate is empty");
  }else{
    $("#datemask_error").removeClass("has-error");
    $("#datemask_error label").html("Birthdate");
  }

  if(document.getElementById("religion").value == ""){
    errors.push("error");
    $("#religion_error").addClass("has-error");
    $("#religion_error label").html("<i class='fa fa-times-circle-o'></i> Religion is empty");
  }else{
    $("#religion_error").removeClass("has-error");
    $("#religion_error label").html("Religion");
  }

  if(document.getElementById("address").value == ""){
    errors.push("error");
    $("#address_error").addClass("has-error");
    $("#address_error label").html("<i class='fa fa-times-circle-o'></i> Address is empty");
  }else{
    $("#address_error").removeClass("has-error");
    $("#address_error label").html("Address");
  }

  //alert(document.getElementById("mobile_number").value.substring(0,6));

  if(document.getElementById("mobile_number").value == ""){
    errors.push("error");
    $("#mobile_error").addClass("has-error");
    $("#mobile_error label").html("<i class='fa fa-times-circle-o'></i> Mobile is empty");
  }else if(document.getElementById("mobile_number").value.substring(0,6) != "(63) 9"){
    errors.push("error");
    $("#mobile_error").addClass("has-error");
    $("#mobile_error label").html("<i class='fa fa-times-circle-o'></i> Mobile number is incorrect.");
  }else{
    $("#mobile_error").removeClass("has-error");
    $("#mobile_error label").html("Mobile");
  }

  if(document.getElementById("father_name").value == ""){
    errors.push("error");
    $("#father_name_error").addClass("has-error");
    $("#father_name_error label").html("<i class='fa fa-times-circle-o'></i> Father's Name is empty");
  }else{
    $("#father_name_error").removeClass("has-error");
    $("#father_name_error label").html("Father's Name");
  }

  if(document.getElementById("datemask2").value == ""){
    errors.push("error");
    $("#father_birthdate_error").addClass("has-error");
    $("#father_birthdate_error label").html("<i class='fa fa-times-circle-o'></i> Father's Birthdate is empty");
  }else{
    $("#father_birthdate_error").removeClass("has-error");
    $("#father_birthdate_error label").html("Father's Birthdate");
  }

  if(document.getElementById("father_occupation").value == ""){
    errors.push("error");
    $("#father_occupation_error").addClass("has-error");
    $("#father_occupation_error label").html("<i class='fa fa-times-circle-o'></i> Father's Occupation is empty");
  }else{
    $("#father_occupation_error").removeClass("has-error");
    $("#father_occupation_error label").html("Father's Occupation");
  }

  if(document.getElementById("mother_name").value == ""){
    errors.push("error");
    $("#mother_name_error").addClass("has-error");
    $("#mother_name_error label").html("<i class='fa fa-times-circle-o'></i> Mother's Name is empty");
  }else{
    $("#mother_name_error").removeClass("has-error");
    $("#mother_name_error label").html("Mother's Name");
  }

  if(document.getElementById("datemask3").value == ""){
    errors.push("error");
    $("#mother_birthdate_error").addClass("has-error");
    $("#mother_birthdate_error label").html("<i class='fa fa-times-circle-o'></i> Mother's Birthdate is empty");
  }else{
    $("#mother_birthdate_error").removeClass("has-error");
    $("#mother_birthdate_error label").html("Mother's Birthdate");
  }

  if(document.getElementById("mother_occupation").value == ""){
    errors.push("error");
    $("#mother_occupation_error").addClass("has-error");
    $("#mother_occupation_error label").html("<i class='fa fa-times-circle-o'></i> Mother's Occupation is empty");
  }else{
    $("#mother_occupation_error").removeClass("has-error");
    $("#mother_occupation_error label").html("Mother's Occupation");
  }

  if(document.getElementById("secondary_school").value == ""){
    errors.push("error");
    $("#secondary_school_error").addClass("has-error");
    $("#secondary_school_error label").html("<i class='fa fa-times-circle-o'></i> Secondary School is empty");
  }else{
    $("#secondary_school_error").removeClass("has-error");
    $("#secondary_school_error label").html("Secondary School");
  }

  if(document.getElementById("secondary_year_graduated").value == ""){
    errors.push("error");
    $("#secondary_year_graduated_error").addClass("has-error");
    $("#secondary_year_graduated_error label").html("<i class='fa fa-times-circle-o'></i> Year Graduated is empty");
  }else{
    $("#secondary_year_graduated_error").removeClass("has-error");
    $("#secondary_year_graduated_error label").html("Year Graduated");
  }

  if(document.getElementById("primary_school").value == ""){
    errors.push("error");
    $("#primary_school_error").addClass("has-error");
    $("#primary_school_error label").html("<i class='fa fa-times-circle-o'></i> Primary School is empty");
  }else{
    $("#primary_school_error").removeClass("has-error");
    $("#primary_school_error label").html("Primary School");
  }

  if(document.getElementById("primary_year_graduated").value == ""){
    errors.push("error");
    $("#primary_year_graduated_error").addClass("has-error");
    $("#primary_year_graduated_error label").html("<i class='fa fa-times-circle-o'></i> Year Graduated is empty");
  }else{
    $("#primary_year_graduated_error").removeClass("has-error");
    $("#primary_year_graduated_error label").html("Year Graduated");
  }

  if(errors.length == 0){
    document.getElementById("editProfileForm").submit();
  }else{
    $('html, body').animate({ scrollTop: 0 }, 'slow');
  }
}

function editEmploymentBtn(){
  var errorss = [];
  var student_number = document.getElementById("student_number1").value;
  $.ajax({
    type: "POST",
    url: "php/ajax/checkyeargraduateemployed.php",
    data: 'id='+student_number,
    dataType: 'json',
    success: function(msg){
      if(document.getElementById("employment_status").value == ""){
        errorss.push("error");
        $("#employment_status_error").addClass("has-error");
        $("#employment_status_error label").html("<i class='fa fa-times-circle-o'></i> Select Employment Status");
      }else{
        $("#employment_status_error").removeClass("has-error");
        $("#employment_status_error label").html("Employment Status");
      }

      if(document.getElementById("job_level").value == ""){
        errorss.push("error");
        $("#job_level_error").addClass("has-error");
        $("#job_level_error label").html("<i class='fa fa-times-circle-o'></i> Select Present Job Level");
      }else{
        $("#job_level_error").removeClass("has-error");
        $("#job_level_error label").html("Present Job Level");
      }

      if(document.getElementById("job_title").value == ""){
        errorss.push("error");
        $("#job_title_error").addClass("has-error");
        $("#job_title_error label").html("<i class='fa fa-times-circle-o'></i> Job Title is empty");
      }else{
        $("#job_title_error").removeClass("has-error");
        $("#job_title_error label").html("Job Title (e.g. Teacher, Engineer)");
      }

      if(msg.year_graduated >= document.getElementById("year_employed").value){
        $("#year_employed_error").addClass("has-error");
        $("#year_employed_error label").html("<i class='fa fa-times-circle-o'></i> Year Employed is invalid");
      }else if(document.getElementById("year_employed").value == ""){
        errorss.push("error");
        $("#year_employed_error").addClass("has-error");
        $("#year_employed_error label").html("<i class='fa fa-times-circle-o'></i> Year Employed is empty");
      }else{
        $("#year_employed_error").removeClass("has-error");
        $("#year_employed_error label").html("Year Employed");
      }

      if(document.getElementById("company_name").value == ""){
        errorss.push("error");
        $("#company_name_error").addClass("has-error");
        $("#company_name_error label").html("<i class='fa fa-times-circle-o'></i> Company Name is empty");
      }else{
        $("#company_name_error").removeClass("has-error");
        $("#company_name_error label").html("Company Name");
      }

      if(document.getElementById("company_number").value == ""){
        errorss.push("error");
        $("#company_number_error").addClass("has-error");
        $("#company_number_error label").html("<i class='fa fa-times-circle-o'></i> Company Contact Number is empty");
      }else{
        $("#company_number_error").removeClass("has-error");
        $("#company_number_error label").html("Company Contact Number");
      }

      if(errorss.length == 0 || document.getElementById("employment_status").value == "Unemployed"){
        document.getElementById("editEmploymentForm").submit();
      }else{
        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
  });
}

function changePassBtn(){
  var errorsss = [];

  var id = document.getElementById("change_pass_hdn_id").value;
  var oldpass = md5(document.getElementById("old_pass").value);

  $.ajax({
    type: "POST",
    url: "php/ajax/checkpass.php",
    data: 'id='+encodeURIComponent(id),
    dataType: 'json',
    success: function(msg){

      if(document.getElementById("old_pass").value == ""){
        errorsss.push("error");
        $("#old_pass_error").addClass("has-error");
        $("#old_pass_error label").html("<i class='fa fa-times-circle-o'></i> Old Password is empty");
      }else if(msg.old != oldpass){
        errorsss.push("error");
        $("#old_pass_error").addClass("has-error");
        $("#old_pass_error label").html("<i class='fa fa-times-circle-o'></i> Old Password is incorrect");
      }else{
        $("#old_pass_error").removeClass("has-error");
        $("#old_pass_error label").html("Old Password");
      }

      if(document.getElementById("changeNewPass").value == ""){
        errorsss.push("error");
        $("#new_pass_error").addClass("has-error");
        $("#new_pass_error label").html("<i class='fa fa-times-circle-o'></i> New Password is empty");
      }else{
        $("#new_pass_error").removeClass("has-error");
        $("#new_pass_error label").html("New Password");
      }

      if(errorsss.length == 0){
        document.getElementById("changePassForm").submit();
      }

    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown); 
    }
   });
}

function addJobBtn(){
  var errorssss = [];
  if(document.getElementById("job_title").value == ""){
    errorssss.push("error");
    $("#job_title_error").addClass("has-error");
    $("#job_title_error label").html("<i class='fa fa-times-circle-o'></i> Job Title is empty");
  }else{
    $("#job_title_error").removeClass("has-error");
    $("#job_title_error label").html("Job Title");
  }

  if(document.getElementById("category").value == ""){
    errorssss.push("error");
    $("#category_error").addClass("has-error");
    $("#category_error label").html("<i class='fa fa-times-circle-o'></i> Category is empty");
  }else{
    $("#category_error").removeClass("has-error");
    $("#category_error label").html("Category");
  }

  if(document.getElementById("range1").value == "" && document.getElementById("range2").value == ""){
    errorssss.push("error");
    $("#salary_error").addClass("has-error");
    $("#salary_error label").html("<i class='fa fa-times-circle-o'></i> Salary Range per Month is empty");
  }else if(document.getElementById("range1").value >= document.getElementById("range2").value){
    errorssss.push("error");
    $("#salary_error").addClass("has-error");
      $("#salary_error label").html("<i class='fa fa-times-circle-o'></i> Salary Range per Month is invalid");
  }else{
    $("#salary_error").removeClass("has-error");
    $("#salary_error label").html("Salary Range per Month");
  }

  if(document.getElementById("company_name").value == ""){
    errorssss.push("error");
    $("#company_name_error").addClass("has-error");
    $("#company_name_error label").html("<i class='fa fa-times-circle-o'></i> Company Name is empty");
  }else{
    $("#company_name_error").removeClass("has-error");
    $("#company_name_error label").html("Company Name");
  }

  if(document.getElementById("contact_number").value == ""){
    errorssss.push("error");
    $("#contact_number_error").addClass("has-error");
    $("#contact_number_error label").html("<i class='fa fa-times-circle-o'></i> Company Number is empty");
  }else{
    $("#contact_number_error").removeClass("has-error");
    $("#contact_number_error label").html("Company Number");
  }

  if(document.getElementById("email").value == ""){
    errorssss.push("error");
    $("#company_email_error").addClass("has-error");
    $("#company_email_error label").html("<i class='fa fa-times-circle-o'></i> Company Email Add is empty");
  }else if(validateEmail(document.getElementById("email").value) == false){
    errorssss.push("error");
    $("#company_email_error").addClass("has-error");
    $("#company_email_error label").html("<i class='fa fa-times-circle-o'></i> Company Email Add is invalid");
  }else{
    $("#company_email_error").removeClass("has-error");
    $("#company_email_error label").html("Company Email");
  }

  if(document.getElementById("address").value == ""){
    errorssss.push("error");
    $("#address_error").addClass("has-error");
    $("#address_error label").html("<i class='fa fa-times-circle-o'></i> Company Address is empty");
  }else{
    $("#address_error").removeClass("has-error");
    $("#address_error label").html("Company Address");
  }

  if(document.getElementById("location").value == ""){
    errorssss.push("error");
    $("#location_error").addClass("has-error");
    $("#location_error label").html("<i class='fa fa-times-circle-o'></i> Location is empty");
  }else{
    $("#location_error").removeClass("has-error");
    $("#location_error label").html("Location");
  }

  if(document.getElementById("description").value == ""){
    errorssss.push("error");
    $("#description_error").addClass("has-error");
    $("#description_error label").html("<i class='fa fa-times-circle-o'></i> Description is empty");
  }else{
    $("#description_error").removeClass("has-error");
    $("#description_error label").html("Description");
  }

  if(errorssss.length == 0){
    document.getElementById("addJobForm").submit();
  }else{
    $('html, body').animate({ scrollTop: 0 }, 'slow');
  }
}
