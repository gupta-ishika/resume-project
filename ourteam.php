<?php session_start(); // This must be at the very top ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Team - Skillfolio</title>
    <link rel="stylesheet" href="ourteam.css" />
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

  <!-- This wrapper helps push the footer to the bottom -->
  <div class="content-wrapper">
    <header class="team-header">
        <h1>Meet Our Team</h1>
        <p>The passionate individuals behind Skillfolio</p>
    </header>

    <section class="team-section">
        <div class="team-card">
            <img src="https://placehold.co/150x150/795757/FFF0D1?text=IG" alt="Ishika Gupta">
            <h2>Ishika Gupta</h2>
            <p class="role">Project Manager</p>
            <p>Ensuring smooth workflow and timely deliveries to bring our vision to life.</p>
            <p>Email: <a href="mailto:ishika.gupta@example.com">ishika.gupta@example.com</a></p>
            <p>LinkedIn: <a href="https://www.linkedin.com/in/ishika-gupta" target="_blank">linkedin.com/in/ishika-gupta</a></p>
        </div>

        <div class="team-card">
            <img src="https://placehold.co/150x150/795757/FFF0D1?text=KS" alt="Khushi Singhal">
            <h2>Khushi Singhal</h2>
            <p class="role">Frontend Developer</p>
            <p>Focused on building beautiful, responsive, and user-friendly designs.</p>
            <p>Email: <a href="mailto:khushi.singhal@example.com">khushi.singhal@example.com</a></p>
            <p>LinkedIn: <a href="https://www.linkedin.com/in/khushi-singhal" target="_blank">linkedin.com/in/khushi-singhal</a></p>
        </div>

        <div class="team-card">
            <img src="https://placehold.co/150x150/795757/FFF0D1?text=KJ" alt="Kratika Jain">
            <h2>Kratika Jain</h2>
            <p class="role">Creative Designer</p>
            <p>Bringing a keen eye for aesthetics and detail to every pixel.</p>
            <p>Email: <a href="mailto:kratika.jain@example.com">kratika.jain@example.com</a></p>
            <p>LinkedIn: <a href="https://www.linkedin.com/in/kratika-jain" target="_blank">linkedin.com/in/kratika-jain</a></p>
        </div>
    </section>
  </div>

  <footer class="footer">
    <p>&copy; 2025 Skillfolio. All Rights Reserved.</p>
  </footer>

</body>
</html>
