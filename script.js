// Helper function to create new form entries with a remove button
function createEntry(innerHTML) {
    const wrapper = document.createElement('div');
    wrapper.className = 'entry';
    wrapper.innerHTML = innerHTML;

    const remove = document.createElement('button');
    remove.type = 'button';
    remove.className = 'remove-btn';
    remove.textContent = '×';
    remove.setAttribute('aria-label', 'Remove entry');
    remove.addEventListener('click', () => wrapper.remove());
    wrapper.appendChild(remove);

    return wrapper;
}

// Functions to add new input fields for each section
function addAchievement() {
    const html = `
        <div class="box">
          <label>Title</label>
          <input type="text" name="ach_title[]" class="box1 ach-title" placeholder="Achievement Title">
        </div>
        <div class="box">
          <label>Description</label>
          <input type="text" name="ach_desc[]" class="box1 ach-desc" placeholder="Achievement Description">
        </div>`;
    document.getElementById('achievements-container').appendChild(createEntry(html));
}

function addExperience() {
    const html = `
        <div class="entry-grid">
          <div class="box">
            <label>Title</label>
            <input type="text" name="exp_title[]" class="box1 exp-title" placeholder="Role/Title">
          </div>
          <div class="box">
            <label>Company</label>
            <input type="text" name="exp_company[]" class="box1 exp-company" placeholder="Company">
          </div>
          <div class="box">
            <label>Location</label>
            <input type="text" name="exp_location[]" class="box1 exp-location" placeholder="Location">
          </div>
        </div>
        <div class="entry-grid entry-grid-row">
          <div class="box">
            <label>Start Date</label>
            <input type="date" name="exp_start[]" class="box1 exp-start">
          </div>
          <div class="box">
            <label>End Date</label>
            <input type="date" name="exp_end[]" class="box1 exp-end">
          </div>
        </div>
        <div class="box entry-grid-row">
          <label>Description</label>
          <input type="text" name="exp_desc[]" class="box1 exp-desc" placeholder="Responsibilities">
        </div>`;
    document.getElementById('experience-container').appendChild(createEntry(html));
}

function addEducation() {
    const html = `
        <div class="entry-grid">
          <div class="box">
            <label>School</label>
            <input type="text" name="edu_school[]" class="box1 edu-school" placeholder="Institute">
          </div>
          <div class="box">
            <label>City</label>
            <input type="text" name="edu_city[]" class="box1 edu-city" placeholder="City">
          </div>
        </div>
        <div class="entry-grid entry-grid-row">
          <div class="box">
            <label>Degree</label>
            <input type="text" name="edu_degree[]" class="box1 edu-degree" placeholder="Degree">
          </div>
          <div class="box">
            <label>Start</label>
            <input type="date" name="edu_start[]" class="box1 edu-start">
          </div>
          <div class="box">
            <label>End</label>
            <input type="date" name="edu_end[]" class="box1 edu-end">
          </div>
        </div>
        <div class="box entry-grid-row">
          <label>Description</label>
          <input type="text" name="edu_desc[]" class="box1 edu-desc" placeholder="Details">
        </div>`;
    document.getElementById('education-container').appendChild(createEntry(html));
}

function addSkills() {
    const html = `
        <div class="box">
          <label>Skill</label>
          <input type="text" name="skills[]" class="box1 skill-input" placeholder="e.g., JavaScript">
        </div>`;
    document.getElementById('skills-container').appendChild(createEntry(html));
}

// Add one of each field when the page first loads for a better user experience
document.addEventListener('DOMContentLoaded', () => {
    addAchievement();
    addExperience();
    addEducation();
    addSkills();
});