<?php
session_start();
session_unset();    // Clear session variables
session_destroy();  // Destroy the session
header("Location: index.php"); // Redirect to homepage/login page
exit();
