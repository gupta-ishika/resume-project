function formatDate(dateStr) {
    if (!dateStr) return "";
    const [year, month, day] = dateStr.split("-");
    return `${day}/${month}/${year}`;
}

function generateResume() {
    document.getElementById("resume-name").innerText =
        `${document.getElementById("first-name").value} ${document.getElementById("middle-name").value} ${document.getElementById("last-name").value}`;
    document.getElementById("resume-designation").innerText = document.getElementById("designation").value;
    document.getElementById("resume-email").innerText = document.getElementById("email").value;
    document.getElementById("resume-phone").innerText = document.getElementById("phone-number").value;
    document.getElementById("resume-address").innerText = document.getElementById("address").value;
    document.getElementById("resume-summary").innerText = document.getElementById("summary").value;
    document.getElementById("resume-achievement-title").innerText = document.getElementById("achievement-title").value;
    document.getElementById("resume-achievement-description").innerText = document.getElementById("achievement-description").value;

    document.getElementById("resume-experience-title").innerText = `${document.getElementById("experience-title").value} (${formatDate(document.getElementById("experience-start-date").value)} - ${formatDate(document.getElementById("experience-end-date").value)})`;
    document.getElementById("resume-experience-company").innerText = document.getElementById("experience-company").value + ", " + document.getElementById("experience-location").value;
    document.getElementById("resume-experience-description").innerText = document.getElementById("experience-description").value;

    document.getElementById("resume-education-school").innerText = `${document.getElementById("school").value}, ${document.getElementById("city").value}`;
    document.getElementById("resume-education-degree").innerText = `${document.getElementById("degree").value} (${formatDate(document.getElementById("start-date").value)} - ${formatDate(document.getElementById("end-date").value)})`;
    document.getElementById("resume-education-description").innerText = document.getElementById("des").value;
    document.getElementById("resume-skills-list").innerText = document.getElementById("skills").value;

    const photoInput = document.getElementById("your-image").files[0];
    if (photoInput) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById("resume-photo").src = e.target.result;
        };
        reader.readAsDataURL(photoInput);
    }

    document.getElementById("form-section").classList.add("hidden");
    document.getElementById("resume-section1").classList.remove("hidden");
}

function goBack() {
    document.getElementById("form-section").classList.remove("hidden");
    document.getElementById("resume-section1").classList.add("hidden");
}
