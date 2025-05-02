<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Check if the user clicked the logout confirmation
if (isset($_POST['logout']) && $_POST['logout'] == 'yes') {
    // Destroy all session data if logged out
    session_unset();  // Clears all session variables
    session_destroy(); // Destroys the session

    // Redirect to the login page after logout
    header("Location: index.php");
    exit();
}

// Display the logout confirmation message
if (!isset($_POST['logout'])) {
    // Confirmation for logout (this is handled purely by PHP without HTML)
    echo "Are you sure you want to log out? <br>";
    echo "<form action='' method='post'>
            <input type='hidden' name='logout' value='yes'>
            <input type='submit' value='Yes, Log Out'>
          </form>";

    echo "<form action='userhome.php' method='get'>
            <input type='submit' value='No, Stay Logged In'>
          </form>";
}
?>
