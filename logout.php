<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// If confirmed via GET parameter, perform the logout
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    // Clear all session data
    $_SESSION = [];

    // Destroy session cookie if used
    if (ini_get("session.use_cookies")) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: index.php?logged_out=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logout Confirmation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .confirm-box {
      background-color: white;
      padding: 2em;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      text-align: center;
    }

    h2 {
      color: #333;
    }

    .buttons {
      margin-top: 1.5em;
    }

    .buttons a {
      text-decoration: none;
      padding: 10px 20px;
      margin: 0 10px;
      color: white;
      background-color: #007BFF;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .buttons a:hover {
      background-color: #0056b3;
    }

    .buttons .cancel {
      background-color: gray;
    }

    .buttons .cancel:hover {
      background-color: #444;
    }
  </style>
</head>
<body>

  <div class="confirm-box">
    <h2>Are you sure you want to logout?</h2>
    <div class="buttons">
      <a href="logout.php?confirm=yes">Yes, Logout</a>
      <a href="userhome.php" class="cancel">Cancel</a>
    </div>
  </div>

</body>
</html>
