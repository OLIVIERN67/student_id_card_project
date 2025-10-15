<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRAT Welcome Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            transition: all 0.3s ease;
            color: #333;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #e0e0e0;
        }

        /* Header Section */
        .header-section {
            text-align: center;
            padding: 4em 2em 2em;
            animation: slideDownFade 0.8s ease-out;
        }

        .header-section h1 {
            font-size: 3.5em;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            letter-spacing: -1px;
        }

        .header-section .tagline {
            font-size: 1.3em;
            color: rgba(255,255,255,0.9);
            font-weight: 300;
            margin-bottom: 1.5em;
        }

        .greeting-box {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 1em 2em;
            border-radius: 50px;
            color: white;
            font-size: 1.2em;
            margin-bottom: 2em;
            border: 1px solid rgba(255,255,255,0.3);
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        body.dark-mode .greeting-box {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
        }

        /* Navigation Controls */
        .controls {
            position: fixed;
            top: 2em;
            right: 2em;
            display: flex;
            gap: 1em;
            z-index: 1000;
            animation: slideInRight 0.6s ease-out;
        }

        .theme-toggle {
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.4);
            color: white;
            padding: 0.8em 1.5em;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5em;
            backdrop-filter: blur(10px);
        }

        .theme-getstarted {
            background: rgba(31, 235, 41, 0.2);
            border: 2px solid rgba(255,255,255,0.4);
            color: white;
            padding: 0.8em 1.5em;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5em;
            backdrop-filter: blur(10px);
    
        }












        .theme-toggle:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Cards Container */
        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            max-width: 1200px;
            margin: 4em auto;
            gap: 2.5em;
            padding: 0 2em;
            perspective: 1000px;
        }

        /* Feature Cards */
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2.5em;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out both;
        }

        .feature-card:nth-child(1) { animation-delay: 0.2s; }
        .feature-card:nth-child(2) { animation-delay: 0.4s; }
        .feature-card:nth-child(3) { animation-delay: 0.6s; }

        body.dark-mode .feature-card {
            background: #2d2d44;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
        }

        .feature-icon {
            font-size: 3em;
            margin-bottom: 1em;
            animation: iconFloat 3s ease-in-out infinite;
        }

        .feature-card:nth-child(1) .feature-icon { color: #667eea; }
        .feature-card:nth-child(2) .feature-icon { color: #764ba2; }
        .feature-card:nth-child(3) .feature-icon { color: #f093fb; }

        body.dark-mode .feature-icon {
            filter: brightness(1.2);
        }

        .feature-card h3 {
            font-size: 1.5em;
            margin-bottom: 0.8em;
            color: #333;
            font-weight: 600;
        }

        body.dark-mode .feature-card h3 {
            color: #e0e0e0;
        }

        .feature-card p {
            font-size: 1em;
            line-height: 1.8;
            color: #666;
        }

        body.dark-mode .feature-card p {
            color: #b0b0b0;
        }

        /* Footer */
        .footer-section {
            text-align: center;
            padding: 3em 2em;
            color: rgba(255,255,255,0.7);
            margin-top: 4em;
            border-top: 1px solid rgba(255,255,255,0.1);
            animation: fadeIn 1.2s ease-out;
        }

        /* Animations */
        @keyframes slideDownFade {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 2.5em;
            }

            .header-section .tagline {
                font-size: 1.1em;
            }

            .features-container {
                grid-template-columns: 1fr;
                margin: 2em auto;
                gap: 1.5em;
            }

            .controls {
                top: 1em;
                right: 1em;
                gap: 0.5em;
            }

            .theme-toggle {
                padding: 0.6em 1.2em;
                font-size: 0.9em;
            }
        }



        .getstarted{
            text-decoration: none;
        }




        
    .welcome-message {
      position: relative;
      right: 450px;
      top: -15  px;
      font-size: clamp(40px, 5vw, 32px);
      color: #333;
      text-align: center;
      font-weight: 600;
      animation: fadeInUp 0.8s ease-out 0.3s both;
    }

    .welcome-message {
      color: #ffffffff;
    }
    </style>
</head>
<body>

<div class="controls">
    <button class="theme-toggle" onclick="toggleDarkMode()">
        <i class="fas fa-moon"></i>
        <span>Dark Mode</span>
    </button>


       <a href="header.php" class="getstarted">  <button class="theme-getstarted">
<i class="fas fa-arrow-right text-blue-300 text-6xl"></i>
        <span>Get Started</span>
    </button></a>
</div>

<div class="header-section">


  <div class="main-content">
    <div class="welcome-message">
      Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! 👋
    </div>

    <h1 style=" margin-top: -70px; margin-left: 20px;" >CRAT System</h1>
    <p class="tagline">Empowering Your Digital Future</p>
    <div class="greeting-box">
        <span id="greeting">Welcome!</span>
    </div>
</div>

<div class="features-container">
    <div class="feature-card">
        <div class="feature-icon">
            <i class="fas fa-lightbulb"></i>
        </div>
        <h3>Innovation at the Core</h3>
        <p>We stay ahead of the curve, embracing emerging technologies to deliver solutions that stand out in a dynamic market.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">
            <i class="fas fa-users"></i>
        </div>
        <h3>Client-Centric Approach</h3>
        <p>Your success is our priority. We collaborate closely with you, understanding your unique needs to provide personalized, effective solutions.</p>
    </div>

    <div class="feature-card">
        <div class="feature-icon">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h3>Security You Can Trust</h3>
        <p>Safeguard your digital assets with our top-notch cybersecurity measures. Your data integrity and privacy are non-negotiable for us.</p>
    </div>
</div>

<div class="footer-section">
    <p>&copy; 2025 CRAT System. All rights reserved.</p>
</div>

<script>
function setGreeting() {
    const greetingElement = document.getElementById('greeting');
    const currentHour = new Date().getHours();

    if (currentHour < 12) {
        greetingElement.textContent = 'Good Morning! 🌅';
    } else if (currentHour < 18) {
        greetingElement.textContent = 'Good Afternoon! ☀️';
    } else {
        greetingElement.textContent = 'Good Evening! 🌙';
    }
}

function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

window.onload = function() {
    setGreeting();
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }
};
</script>

</body>
</html>