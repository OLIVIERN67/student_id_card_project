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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CRAT Homepage</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Reset and General Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background: #f2f2f2;
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    body.dark-mode {
      background: #1a1a1a;
      color: #e0e0e0;
    }

    /* Header Top Bar */
    .header-top {
      background: linear-gradient(135deg, #4fa1ed 0%, #3578d2 100%);
      color: white;
      padding: 1em 2em;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 200;
      animation: slideDown 0.6s ease-out;
    }

    body.dark-mode .header-top {
      background: linear-gradient(135deg, #5a5a5a 0%, #4a4a4a 100%);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .logo-section {
      display: flex;
      align-items: center;
      gap: 1em;
      font-size: clamp(18px, 4vw, 24px);
      font-weight: 700;
      letter-spacing: 1px;
    }

    .logo-icon {
      font-size: clamp(24px, 5vw, 32px);
      animation: iconFloat 3s ease-in-out infinite;
    }

    @keyframes iconFloat {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 2em;
    }

    .username-display {
      font-size: clamp(14px, 3vw, 16px);
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.8em;
      animation: fadeInRight 0.8s ease-out 0.2s both;
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .user-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      transition: all 0.3s ease;
    }

    .user-icon:hover {
      background: rgba(255, 255, 255, 0.5);
      transform: scale(1.1);
    }

    .header-controls {
      display: flex;
      gap: 1em;
      align-items: center;
    }

    .theme-toggle,
    .mobile-menu-btn {
      background: rgba(255, 255, 255, 0.2);
      border: 2px solid rgba(255, 255, 255, 0.4);
      color: white;
      padding: 0.6em 1.2em;
      border-radius: 50px;
      cursor: pointer;
      font-size: clamp(13px, 2.5vw, 15px);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.5em;
    }

    .theme-toggle:hover,
    .mobile-menu-btn:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .mobile-menu-btn {
      display: none;
      font-size: 18px;
    }

    /* Navigation Styles */
    nav {
      background: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      padding: 0;
      animation: slideDown 0.6s ease-out 0.1s both;
    }

    body.dark-mode nav {
      background: #2d2d2d;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    nav ul {
      list-style-type: none;
      display: flex;
      flex-wrap: wrap;
      padding: 0;
      margin: 0;
      gap: 0;
    }

    nav ul li {
      position: relative;
      flex: 0 1 auto;
    }

    nav ul li a {
      display: flex;
      align-items: center;
      gap: 0.6em;
      color: #333;
      text-decoration: none;
      padding: 1em 1.5em;
      font-size: clamp(13px, 2.5vw, 15px);
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
      white-space: nowrap;
    }

    body.dark-mode nav ul li a {
      color: #e0e0e0;
    }

    nav ul li a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 3px;
      background: linear-gradient(90deg, #4fa1ed, #3578d2);
      transition: width 0.3s ease;
    }

    nav ul li a:hover::after {
      width: 100%;
    }

    nav ul li a:hover {
      background: rgba(79, 161, 237, 0.1);
      color: #4fa1ed;
    }

    body.dark-mode nav ul li a:hover {
      background: rgba(79, 161, 237, 0.2);
    }

    /* Select Dropdowns */
    nav ul li select {
      width: 95%;
      padding: 0.8em;
      font-size: clamp(13px, 2.5vw, 15px);
      border: 2px solid #4fa1ed;
      background-color: white;
      color: #333;
      cursor: pointer;
      border-radius: 5px;
      margin: 0.5em auto;
      display: block;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    body.dark-mode nav ul li select {
      background-color: #2d2d2d;
      color: #e0e0e0;
      border-color: #5a5a5a;
    }

    nav ul li select:hover {
      border-color: #3578d2;
      box-shadow: 0 2px 8px rgba(79, 161, 237, 0.2);
    }

    nav ul li select option {
      color: black;
      background-color: white;
      padding: 0.5em;
    }

    body.dark-mode nav ul li select option {
      background-color: #2d2d2d;
      color: #e0e0e0;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      padding: 2em 1em;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .welcome-message {
      font-size: clamp(20px, 5vw, 32px);
      color: #333;
      margin-bottom: 2em;
      text-align: center;
      font-weight: 600;
      animation: fadeInUp 0.8s ease-out 0.3s both;
    }

    body.dark-mode .welcome-message {
      color: #e0e0e0;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Feature Buttons */
    .features-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5em;
      width: 100%;
      max-width: 1000px;
      padding: 2em;
    }

    .feature-btn {
      background: white;
      border: 2px solid #4fa1ed;
      color: #333;
      padding: 1.5em;
      border-radius: 10px;
      text-decoration: none;
      text-align: center;
      font-size: clamp(14px, 3vw, 16px);
      font-weight: 600;
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100px;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      animation: slideUp 0.6s ease-out both;
    }

    .feature-btn:nth-child(1) { animation-delay: 0.4s; }
    .feature-btn:nth-child(2) { animation-delay: 0.5s; }
    .feature-btn:nth-child(3) { animation-delay: 0.6s; }
    .feature-btn:nth-child(4) { animation-delay: 0.7s; }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    body.dark-mode .feature-btn {
      background: #2d2d2d;
      border-color: #5a5a5a;
      color: #e0e0e0;
    }

    .feature-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(79, 161, 237, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .feature-btn:hover::before {
      left: 100%;
    }

    .feature-btn:hover {
      background: linear-gradient(135deg, #4fa1ed 0%, #3578d2 100%);
      color: white;
      border-color: #3578d2;
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(79, 161, 237, 0.3);
    }

    /* Logout Link Styling */
    nav ul li a[href*="logout"] {
      color: #e74c3c;
    }

    nav ul li a[href*="logout"]:hover {
      color: #c0392b;
      background: rgba(231, 76, 60, 0.1);
    }

    body.dark-mode nav ul li a[href*="logout"] {
      color: #ff6b6b;
    }

    body.dark-mode nav ul li a[href*="logout"]:hover {
      background: rgba(255, 107, 107, 0.15);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .header-right {
        gap: 1.5em;
      }

      nav ul {
        gap: 0;
      }

      nav ul li a {
        padding: 0.9em 1.2em;
      }

      .features-container {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.2em;
        padding: 1.5em;
      }
    }

    @media (max-width: 768px) {
      .header-top {
        padding: 1em;
        flex-wrap: wrap;
      }

      .logo-section {
        gap: 0.5em;
      }

      .header-right {
        gap: 1em;
        order: 3;
        width: 100%;
        margin-top: 0.8em;
        justify-content: center;
      }

      .mobile-menu-btn {
        display: flex;
      }

      .theme-toggle {
        flex: 1;
      }

      nav {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
      }

      nav.active {
        max-height: 600px;
      }

      nav ul {
        flex-direction: column;
        padding: 1em;
      }

      nav ul li {
        width: 100%;
      }

      nav ul li a {
        padding: 1em;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
      }

      body.dark-mode nav ul li a {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      nav ul li select {
        width: 100%;
        margin: 0.8em 0;
      }

      .main-content {
        padding: 1.5em 0.8em;
      }

      .welcome-message {
        margin-bottom: 1.5em;
      }

      .features-container {
        grid-template-columns: 1fr;
        gap: 1em;
        padding: 1em;
        width: 100%;
      }

      .feature-btn {
        padding: 1.2em;
        min-height: 80px;
      }
    }

    @media (max-width: 480px) {
      .header-top {
        padding: 0.8em;
      }

      .logo-section {
        font-size: 16px;
      }

      .logo-icon {
        font-size: 22px;
      }

      .username-display {
        font-size: 13px;
        display: none;
      }

      .header-right {
        flex-wrap: wrap;
        gap: 0.8em;
      }

      .theme-toggle,
      .mobile-menu-btn {
        padding: 0.5em 1em;
        font-size: 12px;
      }

      nav ul li a {
        padding: 0.9em;
        font-size: 14px;
      }

      .main-content {
        padding: 1em 0.5em;
      }

      .welcome-message {
        font-size: 20px;
        margin-bottom: 1.2em;
      }

      .features-container {
        grid-template-columns: 1fr;
        gap: 0.8em;
        padding: 0.8em;
      }

      .feature-btn {
        padding: 1em;
        min-height: 70px;
        font-size: 14px;
      }
    }

  </style>
  <script>
    // Mobile Menu Toggle
    function toggleMobileMenu() {
      const nav = document.querySelector('nav');
      nav.classList.toggle('active');
    }

    // Confirm logout function
    function confirmLogout() {
      return confirm("Are you sure you want to logout?");
    }

    // Dark Mode Toggle
    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
      localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
    }

    // Initialize dark mode from localStorage
    window.addEventListener('DOMContentLoaded', function() {
      if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
      }
    });

    // Close mobile menu when clicking on a link
    document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.querySelectorAll('nav a, nav select');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          document.querySelector('nav').classList.remove('active');
        });
      });
    });
  </script>
</head>
<body>

  <!-- Header Top Bar -->
  <div class="header-top">
    <div class="logo-section">
      <i class="fas fa-rocket logo-icon"></i>
      <span>CRAT System</span>
    </div>

    <div class="header-right">
      <div class="username-display">
        <i class="fas fa-user user-icon"></i>
        <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
      </div>

      <div class="header-controls">
        <button class="theme-toggle" onclick="toggleDarkMode()" title="Toggle Dark Mode">
          <i class="fas fa-moon"></i>
          <span>Dark</span>
        </button>
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()" title="Toggle Menu">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav>
    <ul>
      <li><a href="userhome.php"><i class="fas fa-home"></i> Home</a></li>

      <li>
        <select onchange="if (this.value) window.location.href = this.value;">
          <option selected disabled>👥 Customers</option>
          <option value="customers.php">New Customers</option>
        </select>
      </li>

      <li>
        <select onchange="if (this.value) window.location.href = this.value;">
          <option selected disabled>🎓 Students</option>
          <option value="formcard.php">New Students</option>
        </select>
      </li>

      <li><a href="employees.php"><i class="fas fa-briefcase"></i> Employees</a></li>
      <li><a href="report.php"><i class="fas fa-file-alt"></i> Report</a></li>
      <li><a href="logout.php" onclick="return confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </nav>

  <!-- Main Content -->
  <div class="main-content">
    <div class="welcome-message">
      Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! 👋
    </div>

    <div class="features-container">
      <a class="feature-btn" href="view_customers.php">
        <i class="fas fa-users" style="margin-right: 0.5em;"></i> Customers
      </a>
      <a class="feature-btn" href="view_student.php">
        <i class="fas fa-graduation-cap" style="margin-right: 0.5em;"></i> Students
      </a>
      <a class="feature-btn" href="view_employees.php">
        <i class="fas fa-user-tie" style="margin-right: 0.5em;"></i> Employees
      </a>
      <a class="feature-btn" href="view_users.php">
        <i class="fas fa-user-shield" style="margin-right: 0.5em;"></i> Users
      </a>
    </div>
  </div>

</body>
</html>