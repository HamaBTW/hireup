


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

//skills
function makeSkill(id, skill, skill_progress) {
    return {id: id, name: skill, progress: skill_progress};
}

function clearSkill() {
    document.getElementById('resume_skills').value = '';
    document.getElementById('resume_progress').value = '';
}

function loadSkill(id) {
    current_button = document.getElementById('skill_edit_button_'+id);
    skill = current_button.dataset.skill;
    skill_progress = current_button.dataset.skillProgress;
    return {id: id, name: skill, progress: skill_progress};
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
    //generateSkills(JSON.stringify(resume_data.skills), 'skills-output');
}

function removeSkill(id) {
    resume_data = loadResumeData();
    resume_data.skills = resume_data.skills.filter(skill => skill.id != id);
    saveResumeData(resume_data);
}

function editSkill(id) {
    resume_data = loadResumeData();
    skill = makeSkill(id);
    resume_data.skills[id] = skill;
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
}

function loadWork(id) {
    current_button = document.getElementById('work_edit_button_'+id);
    job_exp = current_button.dataset.jobExp;
    company = current_button.dataset.company;
    start_date = current_button.dataset.startDate;
    end_date = current_button.dataset.endDate;
    description = current_button.dataset.desc;

    return {id: id, job_exp: job_exp, company: company, start_date: start_date, end_date: end_date, description: description};
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
    //generateSkills(JSON.stringify(resume_data.skills), 'skills-output');
}

function removeWork(id) {
    resume_data = loadResumeData();
    resume_data.experiences = resume_data.experiences.filter(experience => experience.id != id);
    saveResumeData(resume_data);
}

function editWork(id) {
    resume_data = loadResumeData();
    experience = makeWork(id);
    resume_data.experiences[id] = experiences;
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
}

function loadEducation(id) {
    current_button = document.getElementById('education_edit_button_'+id);
    inst = current_button.dataset.inst;
    start_date = current_button.dataset.sDate;
    end_date = current_button.dataset.eDate;
    educ_degree = current_button.dataset.degree;
    educ_desc = current_button.dataset.desc;

    return {id: id, inst: inst, start_date: start_date, end_date: end_date, degree: educ_degree, description: educ_desc};
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
    //generateSkills(JSON.stringify(resume_data.skills), 'skills-output');
}

function removeEducation(id) {
    resume_data = loadResumeData();
    resume_data.educations = resume_data.educations.filter(education => education.id != id);
    saveResumeData(resume_data);
}

function editEducation(id) {
    resume_data = loadResumeData();
    education = makeEducation(id);
    resume_data.educations[id] = education;
    saveResumeData(resume_data);
}

// generators
function generateSkills(jsonData, outputElementId) {


    // Parse JSON data
    const categories = JSON.parse(jsonData);

    // Check if data contains categories
    if (!categories || !Array.isArray(categories)) {
        console.error('Invalid JSON data');
        return;
    }

    let html = `
<section class="ls s-py-lg-50 main_blog">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-header text-center">
                    <h5>My</h5>
                    <h4>Skills</h4>
                </div>
                <div class="d-none d-lg-block divider-20"></div>
                <div class="owl-carousel" data-responsive-lg="3" data-responsive-md="2" data-responsive-sm="2" data-nav="false" data-dots="false">
`;

    // Loop through categories
    categories.forEach(category => {
        console.log('category');
        const categoryName = category.name;
        const categoryId = category.id;
        const categoryValue = category.progress;

        html += `
    <article class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail">
        <div class="item-content" style="min-height: 280px !important;">
            <header class="blog-header ">
                <a href="javascript:void(0)" rel="bookmark">
                    <h4>${categoryName}</h4>
                </a>
            </header>
            <div class="blog-item-icons" id="blog-item-icons-catid-${categoryId}">
                <div class="col-sm-4 pr-5" onclick="editSkill('${categoryId}')">
                    <a href="javascript:void(0)" class="Interested-btns-like" id="like-a-with-catid-${categoryId}">
                        <i class="fa-solid fa-pen-to-square" id="skill_edit_button_${categoryId}" data-skill="${categoryName}" data-skill-progress="${categoryValue}"></i> Edit
                    </a>
                </div>
                <div class="col-sm-4 pr-5" onclick="removeSkill('${categoryId}')">
                    <a href="javascript:void(0)" class="Interested-btns-dislike" id="dislike-a-with-catid-${categoryId}">
                        <i class="fa-solid fa-circle-xmark Interested-btns-dislike" id="skill_remove_button_${categoryId}"></i> Remove
                    </a>
                </div>
            </div>
        </div>
    </article>
`;
    });

    html += `
                </div>
            </div>
        </div>
    </div>
</section>
`;

    // Output HTML
    document.getElementById(outputElementId).innerHTML = html;
    current_div = document.getElementById(outputElementId);
    console.log(current_div);
}

function generateWork(jsonData, outputElementId) {

    profileId = '1';

    // Parse JSON data
    const categories = JSON.parse(jsonData);

    // Check if data contains categories
    if (!categories || !Array.isArray(categories)) {
        console.error('Invalid JSON data');
        return;
    }

    let html = `
    <section class="ls s-py-lg-50 main_blog">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-header text-center">
                    <h5>My Work</h5>
                    <h4>Experiences</h4>
                </div>
                <div class="d-none d-lg-block divider-20"></div>
                <div class="owl-carousel" data-responsive-lg="3" data-responsive-md="2" data-responsive-sm="2" data-nav="false" data-dots="false">
    `;

    // Loop through categories
    categories.forEach(category => {
        const categoryName = category.name_category;
        const categoryId = category.id_category;

        html += `
        <article class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail">
            <div class="item-content" style="min-height: 280px !important;">
                <header class="blog-header ">
                    <a href="javascript:void(0)" rel="bookmark">
                        <h4>${categoryName}</h4>
                    </a>
                </header>
                <div class="blog-item-icons" id="blog-item-icons-catid-${categoryId}">
                    <div class="col-sm-4 pr-5" onclick="likeCategory('${categoryId}', '${profileId}')">
                        <a href="javascript:void(0)" class="Interested-btns-like" id="like-a-with-catid-${categoryId}">
                            <i class="fa-solid fa-pen-to-square" id="like-i-with-catid-${categoryId}"></i> Edit
                        </a>
                    </div>
                    <div class="col-sm-4 pr-5" onclick="dislikeCategory('${categoryId}', '${profileId}')">
                        <a href="javascript:void(0)" class="Interested-btns-dislike" id="dislike-a-with-catid-${categoryId}">
                            <i class="fa-solid fa-circle-xmark Interested-btns-dislike" id="dislike-i-with-catid-${categoryId}"></i> Remove
                        </a>
                    </div>
                </div>
            </div>
        </article>
        `;
    });

    html += `
                </div>
            </div>
        </div>
    </div>
    </section>
    `;

    // Output HTML
    document.getElementById(outputElementId).innerHTML = html;
}

function generateEducation(jsonData, outputElementId) {

    profileId = '1';

    // Parse JSON data
    const categories = JSON.parse(jsonData);

    // Check if data contains categories
    if (!categories || !Array.isArray(categories)) {
        console.error('Invalid JSON data');
        return;
    }

    let html = `
    <section class="ls s-py-lg-50 main_blog">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-header text-center">
                    <h5>My Work</h5>
                    <h4>Experiences</h4>
                </div>
                <div class="d-none d-lg-block divider-20"></div>
                <div class="owl-carousel" data-responsive-lg="3" data-responsive-md="2" data-responsive-sm="2" data-nav="false" data-dots="false">
    `;

    // Loop through categories
    categories.forEach(category => {
        const categoryName = category.name_category;
        const categoryId = category.id_category;

        html += `
        <article class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail">
            <div class="item-content" style="min-height: 280px !important;">
                <header class="blog-header ">
                    <a href="javascript:void(0)" rel="bookmark">
                        <h4>${categoryName}</h4>
                    </a>
                </header>
                <div class="blog-item-icons" id="blog-item-icons-catid-${categoryId}">
                    <div class="col-sm-4 pr-5" onclick="likeCategory('${categoryId}', '${profileId}')">
                        <a href="javascript:void(0)" class="Interested-btns-like" id="like-a-with-catid-${categoryId}">
                            <i class="fa-solid fa-pen-to-square" id="like-i-with-catid-${categoryId}"></i> Edit
                        </a>
                    </div>
                    <div class="col-sm-4 pr-5" onclick="dislikeCategory('${categoryId}', '${profileId}')">
                        <a href="javascript:void(0)" class="Interested-btns-dislike" id="dislike-a-with-catid-${categoryId}">
                            <i class="fa-solid fa-circle-xmark Interested-btns-dislike" id="dislike-i-with-catid-${categoryId}"></i> Remove
                        </a>
                    </div>
                </div>
            </div>
        </article>
        `;
    });

    html += `
                </div>
            </div>
        </div>
    </div>
    </section>
    `;

    // Output HTML
    document.getElementById(outputElementId).innerHTML = html;
}





function makeDataResume() {
    makeBasicInfos();
    console.log(loadResumeData())
}

function makeData0() {
    const data = {
        profile_image: img_base64,
        first_name: 'John',
        last_name: 'Doe',
        title: 'Web Developer',
        about_me: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet facilisis lectus. Nullam nec nunc vitae libero luctus ultricies. Nullam nec nunc vitae libero luctus ultricies. Nullam nec nunc vitae libero luctus ultricies.',
        age: '25',
        email: '',
        phone: '',
        address: '',
        skills: [
          { name: 'HTML', progress: 90 },
          { name: 'CSS', progress: 80 },
          { name: 'JavaScript', progress: 70 },
          { name: 'PHP', progress: 60 },
          { name: 'Python', progress: 50 },
          { name: 'Ruby', progress: 40 },
          { name: 'Java', progress: 30 },
          { name: 'C++', progress: 20 },
        ],
        experiences: [
          {
            title: 'Frontend Developer',
            company: 'Creative Agency',
            duration: 'May, 2015 - Present',
            description: 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.'
          },
          {
            title: 'Graphic Designer',
            company: 'Design Studio',
            duration: 'June, 2013 - May, 2015',
            description: 'Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.'
          },
          {
            title: 'Junior Web Developer',
            company: 'Indie Studio',
            duration: 'Jan, 2011 - May, 2013',
            description: 'User generated content in real-time will have multiple touchpoints for offshoring. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.'
          }
        ],
        educations: [
          {
            degree: 'Masters in Information Technology',
            institution: 'International University',
            duration: '2011 - 2013',
            description: 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.'
          },
          {
            degree: 'Bachelor of Computer Science',
            institution: 'Regional College',
            duration: '2007 - 2011',
            description: 'Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.'
          },
          {
            degree: 'Science and Mathematics',
            institution: 'Mt. High School',
            duration: '1995 - 2007',
            description: 'User generated content in real-time will have multiple touchpoints for offshoring. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.'
          }
        ]
      };
      
      // Example usage
      console.log(data);
      
}


document.addEventListener('DOMContentLoaded', function() {
    // Function to execute on page load
    initBasicInfos();
})






