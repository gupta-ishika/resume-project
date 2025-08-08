<?php session_start(); // This must be at the very top ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Features - Skillfolio Resume Builder</title>
    <link rel="stylesheet" href="features.css" />
</head>
<body>
  <div class="navbar">
    <div class="logo">
      <img src="assets/logo.png" alt="Skillfolio Logo" />
    </div>
    <div class="nav-links">
      <a href="main.php">Home</a>
      <a href="main.php#about">About Us</a>
      <a href="features.php">Features</a>
      <a href="ourteam.php">Our Team</a>
    </div>
    <div class="nav-buttons">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="logout-btn">Log Out</a>
      <?php else: ?>
        <a href="signup.php" class="signin-btn">Sign Up</a>
        <a href="login.php" class="logout-btn">Log In</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="content-wrapper">
    <header class="features-header">
      <h1>Powerful Features, Effortless Results</h1>
      <p>Everything you need to create a standout resume that gets noticed.</p>
    </header>

    <section class="features-grid">
      <div class="feature-card">
        <img src="https://placehold.co/64x64/795757/FFF0D1?text=T" alt="Templates Icon" class="feature-icon">
        <h2>Professional Templates</h2>
        <p>Choose from a variety of modern, field-tested resume templates designed to impress recruiters.</p>
      </div>
      <div class="feature-card">
        <img src="https://placehold.co/64x64/795757/FFF0D1?text=C" alt="Customization Icon" class="feature-icon">
        <h2>Full Customization</h2>
        <p>Adjust colors, fonts, layouts, and sections to perfectly match your personal brand.</p>
      </div>
      <div class="feature-card">
        <img src="https://placehold.co/64x64/795757/FFF0D1?text=P" alt="Preview Icon" class="feature-icon">
        <h2>Real-Time Preview</h2>
        <p>See your changes instantly as you type, so you can focus on your content without surprises.</p>
      </div>
      <div class="feature-card">
        <img src="https://placehold.co/64x64/795757/FFF0D1?text=PDF" alt="PDF Icon" class="feature-icon">
        <h2>PDF Download</h2>
        <p>Download a pixel-perfect, high-resolution PDF of your resume anytime, ready for employers.</p>
      </div>
      <div class="feature-card">
        <img src="https://placehold.co/64x64/795757/FFF0D1?text=S" alt="Security Icon" class="feature-icon">
        <h2>Secure & Private</h2>
        <p>Your data is yours. With a personal account, your resumes are saved securely and are accessible only to you.</p>
      </div>
      <div class="feature-card">
        <img src="https://placehold.co/64x64/795757/FFF0D1?text=UI" alt="User-Friendly Icon" class="feature-icon">
        <h2>Easy-to-Use Interface</h2>
        <p>Our intuitive builder guides you step-by-step, making resume creation simple and fast.</p>
      </div>
    </section>

    <section class="cta-section">
      <h2>Ready to Build Your Future?</h2>
      <p>Join thousands of professionals who trust Skillfolio to create their perfect resume.</p>
      <a href="index.php" class="cta-button">Get Started Now</a>
    </section>
  </div>

  <footer class="footer">
    <p>&copy; 2025 Skillfolio. All Rights Reserved.</p>
  </footer>

</body>
</html>
