<?php
// This block handles the form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'db_connect.php';

    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Basic Validation
    if (empty($fullName) || empty($email) || empty($password)) {
        $message = "Please fill out all fields.";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
    } else {
        // Check if user already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "An account with this email already exists.";
        } else {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $insertStmt = $conn->prepare("INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)");
            $insertStmt->bind_param("sss", $fullName, $email, $hashedPassword);
            
            if ($insertStmt->execute()) {
                // Redirect to login page on success
                header("Location: login.php?status=success");
                exit();
            } else {
                $message = "Error: Could not register. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up Page</title>
  <link rel="stylesheet" href="signup.css" />
</head>
<body>
  <div class="container">
    <form class="signup-box" method="POST" action="signup.php">
      <h2>Create an Account</h2>
      <p class="subtitle">Please fill in the information below</p>
      
      <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
      <?php endif; ?>

      <div class="form-group">
        <input type="text" name="fullName" placeholder="Full Name" required />
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Email Address" required />
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" required />
      </div>
      <div class="form-group">
        <input type="password" name="confirmPassword" placeholder="Confirm Password" required />
      </div>

      <button type="submit" class="signup-btn">Sign Up</button>

      <p class="login-link">
        Already have an account? <a href="login.php">Log in</a>
      </p>
    </form>
  </div>
</body>
</html>