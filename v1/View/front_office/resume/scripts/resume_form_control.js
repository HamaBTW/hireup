/* CV Error */
var nameError = document.getElementById("name_error");
var phoneError = document.getElementById("phone_error");
var emailError = document.getElementById("email_error");
var jobError = document.getElementById("job_error");
var adressError = document.getElementById("adresse_error");
var aboutError = document.getElementById("aboutMe_error");

/* Skills Error */
var skillError = document.getElementById("skill_error");
var progressError = document.getElementById("progress_error");

/* Work Experience Error */
var jobNameError = document.getElementById("jobName_error");
var workStartError = document.getElementById("work_start_error");
var workEndError = document.getElementById("work_end_error");
var companyError = document.getElementById("company_error");
var workDescError = document.getElementById("work_desc_error");

/* Education Experience Error */
var institutError = document.getElementById("institut_error");
var eduStartError = document.getElementById("edu_start_error");
var eduEndError = document.getElementById("edu_end_error");
var degreeError = document.getElementById("degree_error");
var eduDescError = document.getElementById("edu_desc_error");

/* Submit Error */
var addSkillError = document.getElementById("submit_skill_error");
var addEduError = document.getElementById("submit_edu_error");
var addCVError = document.getElementById("submit_cv_error");
var addWorkError = document.getElementById("submit_work_error");

function validateName() {
    var fname = document.getElementById("resume_name").value;

    if (fname.trim().split(" ").length < 2) {
        nameError.innerHTML = "Full Name must contain at least two words.";
        return false;
    }
    if (fname.length < 2) {
        nameError.innerHTML = "Full Name must be at least 2 characters.";
        return false;
    }
    if (!/^[a-zA-Z ]+$/.test(fname)) {
        nameError.innerHTML = "Full Name must contain only alphabets.";
        return false;
    }
    nameError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validatePhone() {
    var phone = document.getElementById("resume_phone").value;

    if (phone.length == 0) {
        phoneError.innerHTML = "Phone number is required.";
        return false;
    }
    if (!/^\d+$/.test(phone)) {
        phoneError.innerHTML = "Phone number must contain only numbers.";
        return false;
    }
    phoneError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateEmail() {
    var email = document.getElementById("email").value;

    if (email.length == 0) {
        emailError.innerHTML = "Email address is required.";
        return false;
    }
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        emailError.innerHTML = "Please enter a valid email address.";
        return false;
    }
    emailError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateJob() {
    var job = document.getElementById("resume_job").value;

    if (job.length == 0) {
        jobError.innerHTML = "Job sector is required.";
        return false;
    }
    jobError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateAdress() {
    var adress = document.getElementById("resume_adresse").value;

    if (adress.length == 0) {
        adressError.innerHTML = "Address is required.";
        return false;
    }
    adressError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateAbout() {
    var about = document.getElementById("resume_about_me").value;

    if (about.length == 0) {
        aboutError.innerHTML = "About Me section is required.";
        return false;
    }
    aboutError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateSkills() {
    var skills = document.getElementById("resume_skills").value;

    if (skills.length == 0) {
        skillError.innerHTML = "Skills are required.";
        return false;
    }
    skillError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateProgress() {
    var progress = document.getElementById("resume_progress").value;

    if (progress.length == 0) {
        progressError.innerHTML = "Progress is required.";
        return false;
    }
    if (progress < 0 || progress > 100) {
        progressError.innerHTML = "Progress must be between 0 and 100.";
        return false;
    }
    progressError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateJobExperience() {
    var jobExp = document.getElementById("job_exp").value;

    if (jobExp.length == 0) {
        jobNameError.innerHTML = "Job Experience is required.";
        return false;
    }
    jobNameError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateWorkStart() {
    var workStart = document.getElementById("exp_start").value;

    if (workStart.length == 0) {
        workStartError.innerHTML = "Start Date is required.";
        return false;
    }
    var startDatePattern = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!startDatePattern.test(workStart)) {
        workStartError.innerHTML = "Start Date format should be DD/MM/YYYY.";
        return false;
    }
    workStartError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateCompany() {
    var company = document.getElementById("exp_company").value;

    if (company.length == 0) {
        companyError.innerHTML = "Company is required.";
        return false;
    }
    companyError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateWorkEnd() {
    var workEnd = document.getElementById("exp_end").value;

    if (workEnd.length == 0) {
        workEndError.innerHTML = "End Date is required.";
        return false;
    }
    var endDatePattern = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!endDatePattern.test(workEnd)) {
        workEndError.innerHTML = "End Date format should be DD/MM/YYYY.";
        return false;
    }
    var workStart = document.getElementById("exp_start").value;
    if (new Date(workEnd.split('/').reverse().join('-')) < new Date(workStart.split('/').reverse().join('-'))) {
        workEndError.innerHTML = "End Date cannot be before Start Date.";
        return false;
    }
    workEndError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateWorkDescription() {
    var workDesc = document.getElementById("exp_description").value;

    if (workDesc.length == 0) {
        workDescError.innerHTML = "Description is required.";
        return false;
    }
    workDescError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateInstitution() {
    var institution = document.getElementById("edu_institution").value;

    if (institution.length == 0) {
        institutError.innerHTML = "Institution is required.";
        return false;
    }
    institutError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateEduStart() {
    var eduStart = document.getElementById("edu_start").value;

    if (eduStart.length == 0) {
        eduStartError.innerHTML = "Start Date is required.";
        return false;
    }
    var startDatePattern = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!startDatePattern.test(eduStart)) {
        eduStartError.innerHTML = "Start Date format should be DD/MM/YYYY.";
        return false;
    }
    eduStartError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateEduEnd() {
    var eduEnd = document.getElementById("edu_end").value;

    if (eduEnd.length == 0) {
        eduEndError.innerHTML = "End Date is required.";
        return false;
    }
    var endDatePattern = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!endDatePattern.test(eduEnd)) {
        eduEndError.innerHTML = "End Date format should be DD/MM/YYYY.";
        return false;
    }
    var eduStart = document.getElementById("edu_start").value;
    if (new Date(eduEnd.split('/').reverse().join('-')) < new Date(eduStart.split('/').reverse().join('-'))) {
        eduEndError.innerHTML = "End Date cannot be before Start Date.";
        return false;
    }
    eduEndError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateDegree() {
    var degree = document.getElementById("edu_degree").value;

    if (degree.length == 0) {
        degreeError.innerHTML = "Degree is required.";
        return false;
    }
    degreeError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateEduDescription() {
    var eduDesc = document.getElementById("edu_description").value;

    if (eduDesc.length == 0) {
        eduDescError.innerHTML = "Description is required.";
        return false;
    }
    eduDescError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateAddSkill() {
    var addSkill = document.getElementById("resume_skills").value;

    if (addSkill.length == 0) {
        addSkillError.innerHTML = "Skill field is required.";
        return false;
    }
    addSkillError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateAddEdu() {
    var addEdu = document.getElementById("edu_institution").value;

    if (addEdu.length == 0) {
        addEduError.innerHTML = "Institution field is required.";
        return false;
    }
    addEduError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateAddCV() {
    var fname = document.getElementById("resume_name").value;
    var phone = document.getElementById("resume_phone").value;
    var email = document.getElementById("email").value;
    var job = document.getElementById("resume_job").value;
    var adress = document.getElementById("resume_adresse").value;
    var about = document.getElementById("resume_about_me").value;

    if (fname.length == 0 || phone.length == 0 || email.length == 0 || job.length == 0 || adress.length == 0 || about.length == 0) {
        addCVError.innerHTML = "Please fill out all required fields.";
        return false;
    }
    addCVError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

function validateAddWork() {
    var jobExp = document.getElementById("job_exp").value;

    if (jobExp.length == 0) {
        addWorkError.innerHTML = "Job Experience field is required.";
        return false;
    }
    addWorkError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

/* Function to validate Skills form submission */
function validateSkillSubmit() {
    var skillsValid = validateSkills();
    var progressValid = validateProgress();

    if (!skillsValid || !progressValid) {
        addSkillError.innerHTML = "Please fill out all required fields correctly.";
        return false;
    }
    addSkillError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

/* Function to validate Work Experience form submission */
function validateWorkSubmit() {
    var jobExpValid = validateJobExperience();
    var workStartValid = validateWorkStart();
    var workEndValid = validateWorkEnd();
    var companyValid = validateCompany();
    var workDescValid = validateWorkDescription();

    if (!jobExpValid || !workStartValid || !workEndValid || !companyValid || !workDescValid) {
        addWorkError.innerHTML = "Please fill out all required fields correctly.";
        return false;
    }
    addWorkError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

/* Function to validate Education form submission */
function validateEduSubmit() {
    var institutionValid = validateInstitution();
    var eduStartValid = validateEduStart();
    var eduEndValid = validateEduEnd();
    var degreeValid = validateDegree();
    var eduDescValid = validateEduDescription();

    if (!institutionValid || !eduStartValid || !eduEndValid || !degreeValid || !eduDescValid) {
        addEduError.innerHTML = "Please fill out all required fields correctly.";
        return false;
    }
    addEduError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}



/* **************************************************** */
/* **************************************************** */
/* **************************************************** */



/* INPUT TEXT -> DATE */

// Function to validate the date format and range
function validateDateFormatAndRange(dateString) {
    // Date format regular expression: DD/MM/YYYY
    var dateFormatPattern = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!dateFormatPattern.test(dateString)) {
        return false; // Invalid format
    }

    // Extracting day, month, and year from the date string
    var parts = dateString.split('/');
    var day = parseInt(parts[0], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[2], 10);

    // Validating year range (1900 to current year)
    var currentYear = new Date().getFullYear();
    if (year < 1900 || year > currentYear) {
        return false; // Invalid year range
    }

    // Validating month range (01 to 12)
    if (month < 1 || month > 12) {
        return false; // Invalid month
    }

    // Validating day range based on the month
    var daysInMonth = new Date(year, month, 0).getDate();
    if (day < 1 || day > daysInMonth) {
        return false; // Invalid day
    }

    return true; // Date format and range are valid
}

// Function to format the date input as the user types
function formatDateInput(event) {
    var input = event.target;
    var value = input.value.replace(/\D/g, ''); // Remove all non-digit characters
    var formattedValue = '';

    if (value.length > 0) {
        formattedValue = value.substring(0, 2);
    }
    if (value.length > 2) {
        formattedValue += '/' + value.substring(2, 4);
    }
    if (value.length > 4) {
        formattedValue += '/' + value.substring(4, 8);
    }

    input.value = formattedValue;
}

// Function to validate the work start date
function validateWorkStart() {
    var workStart = document.getElementById("exp_start").value;
    var workStartError = document.getElementById("work_start_error");

    if (!validateDateFormatAndRange(workStart)) {
        workStartError.innerHTML = "Invalid Start Date. Please enter a valid date in the format DD/MM/YYYY.";
        return false;
    }

    workStartError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

// Function to validate the work end date
function validateWorkEnd() {
    var workEnd = document.getElementById("exp_end").value;
    var workEndError = document.getElementById("work_end_error");

    if (!validateDateFormatAndRange(workEnd)) {
        workEndError.innerHTML = "Invalid End Date. Please enter a valid date in the format DD/MM/YYYY.";
        return false;
    }

    // Additional validation logic if needed

    workEndError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

// Function to validate the education start date
function validateEduStart() {
    var eduStart = document.getElementById("edu_start").value;
    var eduStartError = document.getElementById("edu_start_error");

    if (!validateDateFormatAndRange(eduStart)) {
        eduStartError.innerHTML = "Invalid Start Date. Please enter a valid date in the format DD/MM/YYYY.";
        return false;
    }

    eduStartError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}

// Function to validate the education end date
function validateEduEnd() {
    var eduEnd = document.getElementById("edu_end").value;
    var eduEndError = document.getElementById("edu_end_error");

    if (!validateDateFormatAndRange(eduEnd)) {
        eduEndError.innerHTML = "Invalid End Date. Please enter a valid date in the format DD/MM/YYYY.";
        return false;
    }

    // Additional validation logic if needed

    eduEndError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
    return true;
}








// Add event listeners to format the date inputs
document.getElementById("exp_start").addEventListener('input', formatDateInput);
document.getElementById("exp_end").addEventListener('input', formatDateInput);
document.getElementById("edu_start").addEventListener('input', formatDateInput);
document.getElementById("edu_end").addEventListener('input', formatDateInput);
