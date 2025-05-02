<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CRAT Homepage</title>
  <style>
    body {
      margin-left: 10em;
      font-family: Arial, sans-serif;
    }

    nav {
      position: fixed;
      left: 0;
      top: 0;
      margin-left: 0.3em;
      width: 10em; 
      height: 100vh;
      background-color: #4fa1ed;
      padding-top: 40px;
    }

    nav ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    nav ul li {
      text-align: center;
      margin-bottom: 10px;
    }

    nav ul li a {
      display: block;
      color: white;
      text-decoration: none; 
      padding: 12px;
      font-size: 1.1em;
      letter-spacing: 2px; 
      transition: all 0.3s ease;
    }

    nav ul li a:hover {
      background-color: white;
      color: #001f3f;
      font-size: 1.2em;
    }

    nav ul li select {
      width: 90%;
      padding: 10px;
      font-size: 1em;
      border: none;
      background-color: #4fa1ed;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
      cursor: pointer;
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
  </style>
</head>
<body>
  <nav>
    <ul>
      <li><a href="userhome.php">Home</a></li><hr>

      <li>
        <select onchange="if (this.value) window.location.href = this.value;">
          <option selected disabled>Customers</option>
          <option value="customers.php">New Customers</option>
          <option value="view_customers.php">Our Customers</option>
        </select>
      </li><hr>

      <li>
        <select onchange="if (this.value) window.location.href = this.value;">
          <option selected disabled>students</option>
          <option value="formcard.php">new students</option>
          <option value="view_student.php">show students</option>
        </select>
      </li><hr>

      <li><a href="employees.php">Employees</a></li><hr>
      <li><a href="report.php">Report</a></li><hr>
      <li><a href="logout.php">Logout</a></li><hr>
    </ul>
  </nav>
</body>
</html>
