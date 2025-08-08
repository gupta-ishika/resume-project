<?php session_start(); // This must be at the very top ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Skillfolio Resume Builder</title>
    <link rel="stylesheet" href="main.css" />
</head>
<body>
  <div class="navbar">
    <div class="logo">
      <img src="assets/logo.png" alt="Skillfolio Logo" />
    </div>
    <div class="nav-links">
      <a href="main.php">Home</a>
      <a href="#about">About Us</a>
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

  <section class="hero-section">
    <p class="tagline">Smart Online Resume Builder</p>
    <h1 class="headline">
      <span class="highlight-word">SKILLFOLIO</span> – Build Your Future Resume Today
    </h1>
    <p class="subtext">
      Design a stunning CV in minutes. Just pick a template, fill in your details,
      and let Skillfolio bring your professional profile to life.
    </p>
    <a href="index.php" class="cta-button">Create My Resume</a>
  </section>

  <div class="main" id="features">
    <div class="main-box">
      <img src="assets/image.avif" alt="Choose Template" />
      <h3>Pick a CV Template</h3>
      <h4>Select a design that suits your style and industry.</h4>
    </div>
    <div class="main-box">
      <img src="assets/image2.avif" alt="Fill Details" />
      <h3>Fill in Details</h3>
      <h4>Simple fields to describe your skills and experiences.</h4>
    </div>
    <div class="main-box">
      <img src="assets/image3.avif" alt="Customize Resume" />
      <h3>Customize Freely</h3>
      <h4>Control every section — color, layout, text — all yours.</h4>
    </div>
  </div>

  <section class="info-section" id="about">
    <h2>About Skillfolio</h2>
    <p>Skillfolio is a modern, user-friendly resume builder designed to help job seekers
      showcase their talent with confidence and clarity. Whether you're a student, fresher,
      or experienced professional — we've got the right templates and tools to impress recruiters.
    </p>
  </section>

  <section class="info-section" id="contact">
    <h2>Contact Us</h2>
    <p>Email: support@skillfolio.com</p>
    <p>Phone: +91-9876543210</p>
  </section>

  <footer class="footer">
    <p>&copy; 2025 Skillfolio. All Rights Reserved.</p>
  </footer>
</body>
</html>