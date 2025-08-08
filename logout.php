<?php
session_start();    // 1. Access the current session

session_destroy();  // 2. Destroy all session data (this logs the user out)

// 3. Redirect the user back to the main landing page
header("Location: main.php");
exit();
?>