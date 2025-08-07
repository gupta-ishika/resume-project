// UTILS
function formatDate(dateStr) {
    if (!dateStr) return '';
    const [year, month, day] = dateStr.split('-');
    return `${day}/${month}/${year}`;
}

//changes
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

// ADDERS
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
    const entry = createEntry(html);
    document.getElementById('achievements-container').appendChild(entry);
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
    const entry = createEntry(html);
    document.getElementById('experience-container').appendChild(entry);
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
    const entry = createEntry(html);
    document.getElementById('education-container').appendChild(entry);
}

function addSkills() {
    const html = `
        <div class="box">
          <label>Skill</label>
          <input type="text" name="skills[]" class="box1 skill-input" placeholder="e.g., JavaScript">
        </div>`;
    const entry = createEntry(html);
    document.getElementById('skills-container').appendChild(entry);
}

// GENERATE RESUME

function goBack() {
    document.getElementById('resume-section1').classList.add('hidden');
    document.getElementById('form-section').classList.remove('hidden');
}

// UPDATED downloadPDF function
function downloadPDF() {
    const resumeElement = document.querySelector('.main');
    const firstName = document.getElementById('first-name').value.trim() || 'Resume';
    const lastName = document.getElementById('last-name').value.trim();
    const fileName = `${firstName}_${lastName}.pdf`.replace(/_$/, '');

    const opt = {
      // margin:       0.04, // Margin in inches
      filename:     fileName,
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2, useCORS: true },
      jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    // Store original styles to reset them later
    const originalStyle = resumeElement.style.cssText;
    
    // Temporarily apply styles for 1:1 scaling.
    // This width in pixels corresponds to the A4 content area.
    resumeElement.style.width = '794px';
    // resumeElement.style.width = '1123px';
    resumeElement.classList.add('pdf-export-layout');

    // Add a brief delay to ensure the DOM updates before the PDF is created
    setTimeout(() => {
        html2pdf().from(resumeElement).set(opt).save().then(() => {
          // Reset styles after download is complete
          resumeElement.style.cssText = originalStyle;
          resumeElement.classList.remove('pdf-export-layout');
        });
    }, 10); // 10 millisecond delay
}


document.addEventListener('DOMContentLoaded', () => {
    addAchievement();
    addExperience();
    addEducation();
    addSkills();
});