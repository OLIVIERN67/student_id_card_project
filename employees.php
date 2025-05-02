<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Form</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .form-container {
      width: 35em;
      margin: 100px auto;
      padding: 3em;
      background-color: white;
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      margin-top: 9em;
    }

    h2 {
      text-align: center;
      color: #007BFF;
    }

    .form-group {
      margin-bottom: 20px; /* Space below each input */
    }

    label {
      font-weight: bold;
      color: #333;
    }

    input[type="text"], input[type="email"], input[type="tel"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-top: 5px;
    }

    /* Updated spacing between inputs in one row */
    .form-row {
      display: flex;
      justify-content: space-between;
      gap: 30px; /* Increased space between inputs */
    }

    .form-row .form-group {
      width: 50%; /* Each input takes half of the row */
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Employee Information Form</h2>
    <form action="#" method="POST">
      <div class="form-group">
        <label for="full_names">Full Names:</label>
        <input type="text" id="full_names" name="full_names" required>
      </div>
      
      <div class="form-row">
        <div class="form-group">
          <label for="identity_card">Identity Card Number:</label>
          <input type="text" id="identity_card" name="identity_card" required>
        </div>
        
        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <input type="tel" id="phone" name="phone" required>
        </div>
      </div>
      
      <div class="form-row">
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" required>
        </div>
      </div>
      
      <div class="form-row">
        <div class="form-group">
          <label for="position">Position:</label>
          <input type="text" id="position" name="position" required>
        </div>
        
        <div class="form-group">
          <label for="category">Category:</label>
          <input type="text" id="category" name="category" required>
        </div>
      </div>
      
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>

</body>
</html>

<?php
include "footer.php";
include "connection.php";

if (isset($_POST['submit'])) {
    // Sanitize input
    $full_names = mysqli_real_escape_string($connect, $_POST['full_names']);
    $identity_card = mysqli_real_escape_string($connect, $_POST['identity_card']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $position = mysqli_real_escape_string($connect, $_POST['position']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $connect->prepare("INSERT INTO `employees`(`full_names`, `identity_card`, `email`, `phone`, `address`, `position`, `category`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $full_names, $identity_card, $email, $phone, $address, $position, $category);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>window.alert('Employee data saved successfully')</script>";
    } else {
        echo "<script>window.alert('Error saving employee data')</script>";
    }
    
    $stmt->close();
}
?>
