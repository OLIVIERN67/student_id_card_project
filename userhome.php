<?php
session_start();

// Block access if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include "header.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRAT Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            color: #333;
            margin-top: 2em;
        }

        .username {
            text-align: center;
            font-size: 20px;
            color: #444;
            margin-top: 0.5em;
        }

        .username strong {
            color: #1d75bd;
        }

        .username a {
            color: #4fa1ed;
            text-decoration: underline;
            margin-left: 10px;
            font-size: 16px;
        }

        .container-wrapper {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 3em;
            gap: 2em;
            padding: 0 1em;
        }

        .container {
            background-color: #4fa1ed;
            color: white;
            width: 320px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .container h3 {
            margin-top: 0;
            font-size: 20px;
        }

        .container p {
            font-size: 16px;
            line-height: 1.5;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Welcome to CRAT  System - where we Empower Your Digital Future</h1>
<div class="username">
    Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!
    
</div>

<div class="container-wrapper">
    <div class="container">
        <h3>Innovation at the Core</h3>
        <p>We stay ahead of the curve, embracing emerging technologies to deliver solutions that stand out in a dynamic market.</p>
    </div>

    <div class="container">
        <h3>Client-Centric Approach</h3>
        <p>Your success is our priority. We collaborate closely with you, understanding your unique needs to provide personalized, effective solutions.</p>
    </div>

    <div class="container">
        <h3>Security You Can Trust</h3>
        <p>Safeguard your digital assets with our top-notch cybersecurity measures. Your data integrity and privacy are non-negotiable for us.</p>
    </div>
</div>

</body>
</html>
<?php include "footer.php"; ?>
