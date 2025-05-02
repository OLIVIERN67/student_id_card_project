<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Destroy all session data and logout the user
session_unset();  // Clears all session variables
session_destroy(); // Destroys the session
session_regenerate_id(true); // Regenerate session ID to prevent session fixation

// Redirect to the login page after logout
header("Location: index.php");
exit();
?>
