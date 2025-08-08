<?php
// ==========================================================
// NEW CODE TO ADD AT THE VERY TOP
// This block protects the page
session_start();

// If the user is not logged in, send them to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit(); // Stop the script from running further
}
// ==========================================================

// PART 1: THE PHP BRAIN - CATCHES THE FORM AND BUILDS THE RESULT
// ===================================================================

// Include your database connection file once.
include_once 'db_connect.php';

// Add this helper function at the top of your index.php
function formatDateForPreview($dateStr) {
    if (empty($dateStr)) return '';
    $date = date_create($dateStr);
    return date_format($date, 'M d, Y'); // e.g., "Aug 25, 2025"
}

// This variable will hold the final resume HTML. It's empty until the form is submitted.
$resumePreviewHtml = '';

// Check if the form was submitted by looking for the button's name 'create_resume'
if (isset($_POST['create_resume'])) {

    // --- INSERT THIS BLOCK TO HANDLE THE FILE UPLOAD ---
    $photoPath = ''; // Default to an empty path
    if (isset($_FILES['yourImage']) && $_FILES['yourImage']['error'] == 0) {
        $uploadDir = 'uploads/'; // The folder we created
        $fileName = uniqid() . '-' . basename($_FILES['yourImage']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['yourImage']['tmp_name'], $targetFilePath)) {
            $photoPath = $targetFilePath; // The path to save in the database
        }
    }

    // --- A. GET ALL DATA FROM THE $_POST PACKAGE ---
    $firstName = $_POST['firstName'] ?? '';
    $middleName = $_POST['middleName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $address = $_POST['address'] ?? '';
    $email = $_POST['email'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $summary = $_POST['summary'] ?? '';

    // --- B. SAVE THE MAIN RESUME TO THE DATABASE ---
    $user_id_from_session = $_SESSION['user_id']; // Get the logged-in user's ID
    $stmt = $conn->prepare("INSERT INTO resumes (user_id, firstName, middleName, lastName, designation, address, email, phoneNumber, summary, photoPath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssss", $user_id_from_session, $firstName, $middleName, $lastName, $designation, $address, $email, $phoneNumber, $summary, $photoPath);
    $stmt->execute();
    $resume_id = $conn->insert_id; // Get the ID of the resume we just created to link everything else

    // --- C. SAVE THE REPEATING SECTIONS ---

    // Save Achievements
    if (!empty($_POST['ach_title'])) {
        $stmt_ach = $conn->prepare("INSERT INTO achievements (resume_id, title, description) VALUES (?, ?, ?)");
        foreach ($_POST['ach_title'] as $key => $title) {
            if (!empty($title)) {
                $description = $_POST['ach_desc'][$key] ?? '';
                $stmt_ach->bind_param("iss", $resume_id, $title, $description);
                $stmt_ach->execute();
            }
        }
    }

    // Save Experience
    if (!empty($_POST['exp_title'])) {
        $stmt_exp = $conn->prepare("INSERT INTO experience (resume_id, title, company, location, startDate, endDate, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($_POST['exp_title'] as $key => $title) {
            if (!empty($title)) {
                $company = $_POST['exp_company'][$key] ?? '';
                $location = $_POST['exp_location'][$key] ?? '';
                $startDate = $_POST['exp_start'][$key] ?? null;
                $endDate = $_POST['exp_end'][$key] ?? null;
                $description = $_POST['exp_desc'][$key] ?? '';
                $stmt_exp->bind_param("issssss", $resume_id, $title, $company, $location, $startDate, $endDate, $description);
                $stmt_exp->execute();
            }
        }
    }

    // Save Education
    if (!empty($_POST['edu_school'])) {
        $stmt_edu = $conn->prepare("INSERT INTO education (resume_id, school, city, degree, startDate, endDate, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($_POST['edu_school'] as $key => $school) {
            if (!empty($school)) {
                $city = $_POST['edu_city'][$key] ?? '';
                $degree = $_POST['edu_degree'][$key] ?? '';
                $startDate = $_POST['edu_start'][$key] ?? null;
                $endDate = $_POST['edu_end'][$key] ?? null;
                $description = $_POST['edu_desc'][$key] ?? '';
                $stmt_edu->bind_param("issssss", $resume_id, $school, $city, $degree, $startDate, $endDate, $description);
                $stmt_edu->execute();
            }
        }
    }
    
    // Save Skills
    if (!empty($_POST['skills'])) {
        $stmt_skill = $conn->prepare("INSERT INTO skills (resume_id, skillName) VALUES (?, ?)");
        foreach ($_POST['skills'] as $skill) {
            if (!empty($skill)) {
                $stmt_skill->bind_param("is", $resume_id, $skill);
                $stmt_skill->execute();
            }
        }
    }

    // --- D. BUILD THE HTML PREVIEW FOR THE USER (Corrected and Complete Version) ---
$resumePreviewHtml = "
<div id='resume-section1'>
    <div class='main'>
        <div class='main-green'>";

if (!empty($photoPath)) {
    $resumePreviewHtml .= "<img src='{$photoPath}' alt='Profile Photo' style='width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 15px;'>";
}

$resumePreviewHtml .= "
            <p id='resume-name'>{$firstName} {$middleName} {$lastName}</p>
            <p id='resume-designation'>{$designation}</p>
            <div class='heading'>ABOUT</div>
            <p id='resume-phone'>{$phoneNumber}</p>
            <p id='resume-email'>{$email}</p>
            <p id='resume-address'>{$address}</p>
            <p id='resume-summary'>{$summary}</p>
            <div class='heading'>SKILLS</div>
            <div id='resume-skills-list' style='text-align:center;'>";
if (!empty($_POST['skills'])) { foreach ($_POST['skills'] as $skill) { if (!empty($skill)) { $resumePreviewHtml .= "<span class='skill-pill'>{$skill}</span>"; } } }
$resumePreviewHtml .= "</div></div><div class='main-white'>";

// Achievements Loop (This was already mostly correct)
$resumePreviewHtml .= "<div class='heading'>ACHIEVEMENTS</div><div id='resume-achievements-list'>";
if (!empty($_POST['ach_title'])) { 
    foreach ($_POST['ach_title'] as $key => $title) { 
        if(!empty($title)) { 
            $description = htmlspecialchars($_POST['ach_desc'][$key] ?? '');
            $resumePreviewHtml .= "<div class='section-item'><div><strong>{$title}</strong></div><div>{$description}</div></div>"; 
        } 
    } 
}
$resumePreviewHtml .= "</div>";

// Education Loop (MODIFIED to include all fields)
$resumePreviewHtml .= "<div class='heading'>EDUCATION</div><div id='resume-education-list'>";
if (!empty($_POST['edu_school'])) { 
    foreach ($_POST['edu_school'] as $key => $school) { 
        if(!empty($school)) {
            $city = htmlspecialchars($_POST['edu_city'][$key] ?? '');
            $degree = htmlspecialchars($_POST['edu_degree'][$key] ?? '');
            $startDate = formatDateForPreview($_POST['edu_start'][$key] ?? '');
            $endDate = formatDateForPreview($_POST['edu_end'][$key] ?? 'Present');
            $description = htmlspecialchars($_POST['edu_desc'][$key] ?? '');

            $resumePreviewHtml .= "<div class='section-item'>
                <div style='display: flex; justify-content: space-between;'><strong>{$degree}</strong> <span>{$startDate} - {$endDate}</span></div>
                <div>{$school}, {$city}</div>
                <div style='font-size: 0.9em; color: #555;'>{$description}</div>
            </div>";
        } 
    } 
}
$resumePreviewHtml .= "</div>";

// Experience Loop (MODIFIED to include all fields)
$resumePreviewHtml .= "<div class='heading'>EXPERIENCE</div><div id='resume-experience-list'>";
if (!empty($_POST['exp_title'])) { 
    foreach ($_POST['exp_title'] as $key => $title) { 
        if(!empty($title)) {
            $company = htmlspecialchars($_POST['exp_company'][$key] ?? '');
            $location = htmlspecialchars($_POST['exp_location'][$key] ?? '');
            $startDate = formatDateForPreview($_POST['exp_start'][$key] ?? '');
            $endDate = formatDateForPreview($_POST['exp_end'][$key] ?? 'Present');
            $description = htmlspecialchars($_POST['exp_desc'][$key] ?? '');

            $resumePreviewHtml .= "<div class='section-item'>
                <div style='display: flex; justify-content: space-between;'><strong>{$title}</strong> <span>{$startDate} - {$endDate}</span></div>
                <div>{$company} | {$location}</div>
                <div style='font-size: 0.9em; color: #555; padding-left: 10px; border-left: 2px solid #eee; margin-top: 5px;'>{$description}</div>
            </div>";
        } 
    } 
}
$resumePreviewHtml .= "</div></div></div>"; // Closes main-white and main
$resumePreviewHtml .= "<div style='display:flex; gap:12px; flex-wrap:wrap; margin-top:20px; justify-content:center;'><button class='primary' onclick='window.print()'>Download/Print</button></div></div>";

    // This CSS hides the original form, so the user only sees their final resume
    echo "<style>#form-section { display: none; }</style>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resume Generator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
        // PART 2: THE DISPLAY AREA - This is where the completed resume appears.
        // ===================================================================
        echo $resumePreviewHtml;
    ?>

    <div id="form-section">
        <form method="POST" action="index.php" enctype="multipart/form-data">
            <div class="heading-form">About</div>
            <div class="fill">
                <div class="box"><label for="first-name">First Name</label><input type="text" id="first-name" name="firstName" class="box1"></div>
                <div class="box"><label for="middle-name">Middle Name</label><input type="text" id="middle-name" name="middleName" class="box1"></div>
                <div class="box"><label for="last-name">Last Name</label><input type="text" id="last-name" name="lastName" class="box1"></div>
                <div class="box"><label for="your-image">Photo</label><input type="file" id="your-image" name="yourImage" class="box1" accept="image/*"></div>
                <div class="box"><label for="designation">Designation</label><input type="text" id="designation" name="designation" class="box1"></div>
                <div class="box"><label for="address">Address</label><input type="text" id="address" name="address" class="box1"></div>
                <div class="box"><label for="email">Email</label><input type="email" id="email" name="email" class="box1"></div>
                <div class="box"><label for="phone-number">Phone Number</label><input type="tel" id="phone-number" name="phoneNumber" class="box1"></div>
                <div class="box"><label for="summary">Summary</label><input type="text" id="summary" name="summary" class="box1"></div>
            </div>

            <div class="section-header"><div class="heading-form">Achievements</div><button type="button" onclick="addAchievement()" class="add-button">+ Add Achievement</button></div>
            <div id="achievements-container"></div>

            <div class="section-header"><div class="heading-form">Experience</div><button type="button" onclick="addExperience()" class="add-button">+ Add Experience</button></div>
            <div id="experience-container"></div>

            <div class="section-header"><div class="heading-form">Education</div><button type="button" onclick="addEducation()" class="add-button">+ Add Education</button></div>
            <div id="education-container"></div>

            <div class="section-header"><div class="heading-form">Skills</div><button type="button" onclick="addSkills()" class="add-button">+ Add Skill</button></div>
            <div id="skills-container"></div>
            
            <button type="submit" name="create_resume" class="primary">Create Resume</button>

        </form>
    </div>
    
    <script src="script.js"></script>
</body>
</html>