<?php
// This must be at the VERY TOP of the file
session_start();

$message = '';

// Check if a user is already logged in, if so, redirect them to the resume builder
if (isset($_SESSION['user_id'])) {
    header("Location: main.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'db_connect.php';

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $message = "Please enter both email and password.";
    } else {
        // Fetch user from the database
        $stmt = $conn->prepare("SELECT id, fullName, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the password against the stored hash
            if (password_verify($password, $user['password'])) {
                // Password is correct! Start the session.
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullName'];
                
                // Redirect to the main resume builder page
                header("Location: main.php");
                exit();
            } else {
                $message = "Invalid email or password.";
            }
        } else {
            $message = "Invalid email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css" />
</head>
<body>
  <div class="container">
    <form class="login-box" method="POST" action="login.php">
      <h2>Welcome Back!</h2>
      <p>Please enter your details</p>
      
      <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
      <?php elseif (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
        <p style="color: green;">Registration successful! Please log in.</p>
      <?php endif; ?>

      <input type="email" name="email" placeholder="Email address" required />
      <input type="password" name="password" placeholder="Password" required />

      <button type="submit" class="signup-btn">Sign in</button>

      <p class="signup-link">Don’t have an account? <a href="signup.php">Sign up</a></p>
    </form>
  </div>
</body>
</html>