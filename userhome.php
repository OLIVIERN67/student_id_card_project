<?php


include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRAT Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f2f2f2;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.dark-mode {
            background-color: #333;
            color: white;
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

        .dark-mode-button {
            background-color: #4fa1ed;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: -50em;
            margin-left: -130em;
        }

        .dark-mode-button:hover {
            background-color: #3578d2;
        }

    </style>
</head>
<body>

<h1>Welcome to CRAT System - Empowering Your Digital Future</h1>

<br><br><br><br><br><br><br><br><br><br><br><br>
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

<!-- Dark Mode Toggle Button -->
<button class="dark-mode-button" onclick="toggleDarkMode()">Toggle Dark Mode</button>

<script>
// Displaying dynamic greeting based on the time of day
function setGreeting() {
    const greetingElement = document.getElementById('greeting');
    const currentHour = new Date().getHours();

    if (currentHour < 12) {
        greetingElement.textContent = 'Good Morning!';
    } else if (currentHour < 18) {
        greetingElement.textContent = 'Good Afternoon!';
    } else {
        greetingElement.textContent = 'Good Evening!';
    }
}

// Toggle Dark Mode
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}

// Initialize
window.onload = function() {
    setGreeting();
};
</script>

</body>
</html>
<?php include "footer.php"; ?>
