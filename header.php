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
  <style>
    /* General Styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background: #f2f2f2; /* Original background color */
      color: #333;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .username {
      position: absolute;
      top: 10px;
      right: 20px;
      font-size: 1.2em;
      color: #3498db;
    }

    .welcome-message {
      font-size: 1.5em;
      color: #333;
      margin-top: 3em;
      text-align: center;
    }

    /* Navigation Styles */
    nav {
      position: fixed;
      left: 0;
      top: 0;
      width: 15em;
      height: 50vh;
      background-color: #2c3e50;
      padding-top: 40px;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
      z-index: 100;
      transition: all 0.3s ease-in-out;
      margin-top: 8em;
      margin-left: 1em;
      border-radius: 1em;
    }

    nav ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    nav ul li {
      text-align: center;
      margin-bottom: 15px;
    }

    nav ul li a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 12px;
      font-size: 1.1em;
      letter-spacing: 2px;
      transition: all 0.3s ease;
      border-radius: 5px;
    }

    nav ul li a:hover {
      background-color: #3498db;
      color: white;
      font-size: 1.15em;
      padding: 15px;
    }

    nav ul li select {
      width: 80%;
      padding: 10px;
      font-size: 1em;
      border: none;
      background-color: #3498db;
      color: white;
      text-align: center;
      cursor: pointer;
      border-radius: 5px;
      margin-top: 10px;
    }

    nav ul li select option {
      color: black;
      background-color: white;
    }

    hr {
      margin: 0;
      border: 0;
      border-top: 1px solid #ffffff60;
    }

    /* Main Content */
    .show {
      margin-left: 18em;
      padding: 2em;
      width: 80%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .show ol {
      list-style: none;
      display: flex;
      gap: 2em;
      flex-wrap: wrap;
      padding: 0;
      justify-content: center;
    }

    .show ol li a.btn {
      background-color: #3498db;
      color: white;
      text-decoration: none;
      padding: 1.2em 2.5em;
      border-radius: 0.5em;
      font-family: 'Tahoma', sans-serif;
      font-size: 1.2em;
      transition: all 0.3s ease;
    }

    .show ol li a.btn:hover {
      background-color: #2980b9;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      nav {
        width: 100%;
        height: auto;
        position: static;
      }

      body {
        margin-left: 0;
      }

      .show {
        margin-left: 0;
        padding: 1em;
      }

      .show ol {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
  <script>
    // Confirm logout function
    function confirmLogout() {
      return confirm("Are you sure you want to logout?");
    }

    // Smooth scroll behavior on click
    window.onload = function () {
      let links = document.querySelectorAll('a[href^="#"]');
      links.forEach(link => {
        link.addEventListener('click', function (e) {
          e.preventDefault();
          let target = document.querySelector(this.getAttribute('href'));
          window.scrollTo({
            top: target.offsetTop - 60, 
            behavior: 'smooth'
          });
        });
      });
    }
  </script>
</head>
<body>
  
  <div class="username">
    <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
  </div>

 

  <div class="show">
    <ol>
      <li><a class="btn" href="view_customers.php">Customers</a></li>
      <li><a class="btn" href="view_student.php">Students</a></li>
      <li><a class="btn" href="view_employees.php">Employees</a></li>
      <li><a class="btn" href="view_users.php">Users</a></li>
    </ol>
  </div>

  <nav>
    <ul>
      <li><a href="userhome.php">Home</a></li><hr>

      <li>
        <select onchange="if (this.value) window.location.href = this.value;">
          <option selected disabled>Customers</option>
          <option value="customers.php">New Customers</option>
        </select>
      </li><hr>

      <li>
        <select onchange="if (this.value) window.location.href = this.value;">
          <option selected disabled>Students</option>
          <option value="formcard.php">New Students</option>
        </select>
      </li><hr>

      <li><a href="employees.php">Employees</a></li><hr>
      <li><a href="report.php">Report</a></li><hr>
      <li><a href="logout.php" onclick="return confirmLogout()">Logout</a></li><hr>
    </ul>
  </nav>
</body>
</html>
