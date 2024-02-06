function wws_validation() {
    var job_type = document.getElementById("job_type").value;
    var department = document.getElementById("department").value;
    var applicant_exp = document.getElementById("applicant_exp").value;
    var applicant_qualification = document.getElementById("applicant_qualification").value;
    var applicant_specialization = document.getElementById("applicant_specialization").value;
    var applicant_name = document.getElementById("applicant_name").value;
    var applicant_email = document.getElementById("applicant_email").value;
    var applicant_email = document.getElementById("applicant_email").value;
    var applicant_mobile = document.getElementById("applicant_mobile").value;
    var applicant_detail = document.getElementById("applicant_detail").value;
    var applicant_file = document.getElementById("applicant_file").value;

    if (job_type == '') {
        document.getElementById('job_type_err').innerHTML = "Please select your job type*";
        return false;
    } else {
        document.getElementById('job_type_err').innerHTML = "";
    }

    if (department == '') {
        document.getElementById('department_err').innerHTML = "Please enter your Department*";
        return false;
    } else {
        document.getElementById('department_err').innerHTML = "";
    }
    if (applicant_exp == '') {
        document.getElementById('applicant_exp_err').innerHTML = "Please select your Experience*";
        return false;
    } else {
        document.getElementById('applicant_exp_err').innerHTML = "";
    }

    if (applicant_qualification == '') {
        document.getElementById('applicant_qualification_err').innerHTML = "Please enter your Qualification*";
        return false;
    } else {
        document.getElementById('applicant_qualification_err').innerHTML = "";
    }
    if (applicant_specialization == '') {
        document.getElementById('applicant_specialization_err').innerHTML = "Please enter your Specialization*";
        return false;
    } else {
        document.getElementById('applicant_specialization_err').innerHTML = "";
    }
    if (applicant_name == '') {
        document.getElementById('applicant_name_err').innerHTML = "Please enter your name*";
        return false;
    } else {
        document.getElementById('applicant_name_err').innerHTML = "";
    }
    if (applicant_email == '') {
        document.getElementById('applicant_email_err').innerHTML = "Please enter your email*";
        return false;
    } else {
        document.getElementById('applicant_email_err').innerHTML = "";
    }
    if (applicant_mobile == '') {
        document.getElementById('applicant_mobile_err').innerHTML = "Please enter your Mobile Number*";
        return false;
    } else {
        document.getElementById('applicant_mobile_err').innerHTML = "";
    }
    if (applicant_mobile.length != 10) {
        document.getElementById('applicant_mobile_err').innerHTML = "Mobile number must Be 10 digits*";
        return false;
    } else {
        document.getElementById('applicant_mobile_err').innerHTML = "";
    }
    if (applicant_detail == '') {
        document.getElementById('applicant_detail_err').innerHTML = "Please Write Something About yourself*";
        return false;
    } else {
        document.getElementById('applicant_detail_err').innerHTML = "";
    }
   if (applicant_file == '') {
        document.getElementById('applicant_file_err').innerHTML = "Please Upload your resume*";
        return false;
    } else {
        document.getElementById('applicant_file_err').innerHTML = "";
    }
}