


function loadResumeData() {
    resume_data = localStorage.getItem('resumeData-cv');
    resume_data_json = JSON.parse(resume_data);
    return resume_data_json;
}

function saveResumeData(resume_data) {
    localStorage.setItem('resumeData-cv', JSON.stringify(resume_data));
}

function initBasicInfos() {

    data = {
        profile_image: '',
        first_name: '',
        last_name: '',
        title: '',
        about_me: '',
        age: '',
        email: '',
        phone: '',
        address: '',
        skills: [],
        experiences: [],
        educations: [],
      };
    

    saveResumeData(data);
}

async function makeBasicInfos() {

    resume_data = loadResumeData();
    
    //base64String = await getBase64FromInput('resume_picture');
    full_name = document.getElementById('resume_name').value;
    first_name = full_name.split(' ')[0];
    last_name = full_name.split(' ')[1];
    title = document.getElementById('resume_job').value;
    about_me = document.getElementById('resume_about_me').value;
    age = '0';
    email = document.getElementById('email').value;
    phone = document.getElementById('resume_phone').value;
    address = document.getElementById('resume_adresse').value;

    
    resume_data.profile_image = 'base64String',
    resume_data.first_name = first_name,
    resume_data.last_name = last_name,
    resume_data.title = title,
    resume_data.about_me = about_me,
    resume_data.age = age,
    resume_data.email = email,
    resume_data.phone = phone,
    resume_data.address = address,

    console.log('resume_data');
    console.log(resume_data);
    
    saveResumeData(resume_data);
}

function clearBasic() {
    document.getElementById('resume_picture').value = '';
    document.getElementById('resume_name').value = '';
    document.getElementById('resume_job').value = '';
    document.getElementById('resume_about_me').value = '';
    document.getElementById('resume_phone').value = '';
    document.getElementById('resume_adresse').value = '';
    document.getElementById('email').value = '';

    document.getElementById('name_error').innerHTML = '';
    document.getElementById('phone_error').innerHTML = '';
    document.getElementById('email_error').innerHTML = '';
    document.getElementById('job_error').innerHTML = '';
    document.getElementById('adresse_error').innerHTML = '';
    document.getElementById('pic_error').innerHTML = '';
    document.getElementById('aboutMe_error').innerHTML = '';

}

//skills
function makeSkill(id, skill, skill_progress) {
    return {id: id, name: skill, progress: skill_progress};
}

function clearSkill() {
    document.getElementById('resume_skills').value = '';
    document.getElementById('resume_progress').value = '';

    progressBar = document.getElementById('progress-bar');
    progressBar.style.width = 0 + '%';

    document.getElementById('skill_error').innerHTML = '';
    document.getElementById('progress_error').innerHTML = '';
}

function loadSkill(id) {
    resume_data = loadResumeData();
    skill = resume_data.skills[id];
    return skill;
}

function addSkill() {
    resume_data = loadResumeData();
    id = resume_data.skills.length;
    skill = document.getElementById('resume_skills').value;
    skill_progress = document.getElementById('resume_progress').value;
    skill = makeSkill(id, skill, skill_progress);
    resume_data.skills.push(skill);
    console.log("pusshed skill");
    console.log(resume_data.skills);
    saveResumeData(resume_data);
    clearSkill();
    loadSkillsToDropDown(resume_data.skills);
    //generateSkills(JSON.stringify(resume_data.skills), 'skills-output');
}

function removeSkill(id) {
    resume_data = loadResumeData();
    resume_data.skills = resume_data.skills.filter(skill => skill.id != id);
    console.log("removed skill");
    console.log(resume_data.skills);
    saveResumeData(resume_data);
    loadSkillsToDropDown(resume_data.skills);
}

function editSkill(id) {
    resume_data = loadResumeData();
    //skill = makeSkill(id);
    //resume_data.skills[id] = skill;
    showModal();
    saveResumeData(resume_data);
}


//work
function makeWork(id, job_exp, company, start_date, end_date, description) {
    return {id: id, job_exp: job_exp, company: company, start_date: start_date, end_date: end_date, description: description};
}

function clearWork() {
    document.getElementById('job_exp').value = '';
    document.getElementById('exp_company').value = '';
    document.getElementById('exp_start').value = '';
    document.getElementById('exp_end').value = '';
    document.getElementById('exp_description').value = '';

    document.getElementById('jobName_error').innerHTML = '';
    document.getElementById('company_error').innerHTML = '';
    document.getElementById('work_start_error').innerHTML = '';
    document.getElementById('work_end_error').innerHTML = '';
    document.getElementById('work_desc_error').innerHTML = '';
}

function loadWork(id) {
    resume_data = loadResumeData();
    experience = resume_data.experiences[id];
    return experience;
}

function addWork() {
    resume_data = loadResumeData();
    id = resume_data.experiences.length;

    job_exp = document.getElementById('job_exp').value;
    company = document.getElementById('exp_company').value;
    start_date = document.getElementById('exp_start').value;
    end_date = document.getElementById('exp_end').value;
    desc = document.getElementById('exp_description').value;
    
    experiences = makeWork(id, job_exp, company, start_date, end_date, desc);

    resume_data.experiences.push(experiences);
    console.log("pusshed experiences");
    console.log(resume_data.experiences);
    saveResumeData(resume_data);
    clearWork();
    loadWorksToDropDown(resume_data.experiences);
    //generateSkills(JSON.stringify(resume_data.skills), 'skills-output');
}

function removeWork(id) {
    resume_data = loadResumeData();
    resume_data.experiences = resume_data.experiences.filter(experience => experience.id != id);
    saveResumeData(resume_data);
    loadWorksToDropDown(resume_data.experiences);
}

function editWork(id) {
    resume_data = loadResumeData();
    experience = makeWork(id);
    //resume_data.experiences[id] = experiences;
    saveResumeData(resume_data);
}

//education
function makeEducation(id, inst, start_date, end_date, degree, description) {
    return {id: id, inst: inst, start_date: start_date, end_date: end_date, degree: degree, description: description};
}

function clearEducation() {
    document.getElementById('edu_institution').value = '';
    document.getElementById('edu_start').value = '';
    document.getElementById('edu_end').value = '';
    document.getElementById('edu_degree').value = '';
    document.getElementById('edu_description').value = '';

    document.getElementById('institut_error').innerHTML = '';
    document.getElementById('degree_error').innerHTML = '';
    document.getElementById('edu_start_error').innerHTML = '';
    document.getElementById('edu_end_error').innerHTML = '';
    document.getElementById('edu_desc_error').innerHTML = '';

}

function loadEducation(id) {
    resume_data = loadResumeData();
    education = resume_data.educations[id];
    return education;
}

function addEducation() {
    resume_data = loadResumeData();
    id = resume_data.educations.length;

    eduIns = document.getElementById('edu_institution').value;
    eduStart = document.getElementById('edu_start').value;
    eduEnd = document.getElementById('edu_end').value;
    eduDegree = document.getElementById('edu_degree').value;
    eduDesc = document.getElementById('edu_description').value;
    
    education = makeEducation(id, eduIns, eduStart, eduEnd, eduDegree, eduDesc);

    resume_data.educations.push(education);
    console.log("pusshed educations");
    console.log(resume_data.educations);
    saveResumeData(resume_data);
    clearEducation();
    loadEducationToDropDown(resume_data.educations);
    //generateSkills(JSON.stringify(resume_data.skills), 'skills-output');
}

function removeEducation(id) {
    resume_data = loadResumeData();
    resume_data.educations = resume_data.educations.filter(education => education.id != id);
    saveResumeData(resume_data);
    loadEducationToDropDown(resume_data.educations);
}

function editEducation(id) {
    resume_data = loadResumeData();
    education = makeEducation(id);
    resume_data.educations[id] = education;
    saveResumeData(resume_data);
}

// generators
function loadSkillsToDropDown(skills) {
    dropdownMenu_s = document.getElementById('dropdownMenu');

    //clear the dropdown menu
    document.getElementById('dropdownMenu').innerHTML = '';

    if (skills.length < 1) {
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.innerHTML = `
                                        <span>You haven't added anything.</span>
                                    `;
        dropdownMenu_s.appendChild(item);
    }

    skills.forEach((skill) => {
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.innerHTML = `
                                        <span>${skill.name}</span>
                                        <div>
                                            <a href="javascript:void(0);" onclick="editSkill(${skill.id})"><i class="fa fa-edit text-primary"></i></a>
                                            <a href="javascript:void(0);" onclick="removeSkill(${skill.id})"><i class="fa fa-x text-danger"></i></a>
                                        </div>
                                    `;
        dropdownMenu_s.appendChild(item);
    });
}

function loadWorksToDropDown(works) {
    dropdownMenu_w = document.getElementById('dropdownMenu2');

    //clear the dropdown menu
    document.getElementById('dropdownMenu2').innerHTML = '';

    if (works.length < 1) {
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.innerHTML = `
                                        <span>You haven't added anything.</span>
                                    `;
        dropdownMenu_w.appendChild(item);
    }

    works.forEach((work) => {
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.innerHTML = `
                                        <span>${work.job_exp}</span>
                                        <div>
                                            <a href="javascript:void(0);" onclick="editWork(${work.id})"><i class="fa fa-edit text-primary"></i></a>
                                            <a href="javascript:void(0);" onclick="removeWork(${work.id})"><i class="fa fa-x text-danger"></i></a>
                                        </div>
                                    `;
        dropdownMenu_w.appendChild(item);
    });
}

function loadEducationToDropDown(educs) {
    console.log("loadEducationToDropDown");
    console.log(educs);
    dropdownMenu_e = document.getElementById('dropdownMenu3');

    //clear the dropdown menu
    document.getElementById('dropdownMenu3').innerHTML = '';

    if (educs.length < 1) {
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.innerHTML = `
                                        <span>You haven't added anything.</span>
                                    `;
        dropdownMenu_e.appendChild(item);
    }

    educs.forEach((educ) => {
        console.log("educ");
        console.log(educ);
        const item = document.createElement('div');
        item.className = 'dropdown-item';
        item.innerHTML = `
                                        <span>${educ.inst}</span>
                                        <div>
                                            <a href="javascript:void(0);" onclick="editEducation(${educ.id})"><i class="fa fa-edit text-primary"></i></a>
                                            <a href="javascript:void(0);" onclick="removeEducation(${educ.id})"><i class="fa fa-x text-danger"></i></a>
                                        </div>
                                    `;
        dropdownMenu_e.appendChild(item);
    });
}



function makeDataResume() {
    makeBasicInfos();
    console.log(loadResumeData())
}

//modale

document.addEventListener('DOMContentLoaded', function() {
    // Function to execute on page load
    initBasicInfos();
    clearBasic();
    clearSkill();
    clearWork();
    clearEducation();
    data = loadResumeData();
    loadSkillsToDropDown(data.skills);
    loadWorksToDropDown(data.experiences);
    loadEducationToDropDown(data.educations);

})






