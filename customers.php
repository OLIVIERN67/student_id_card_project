<?php
include "header.php"; 
include "connection.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Information Form</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      margin-top: 50px;
    }

    .description {
      width: 30%;
      margin-right: 20px;
      background-color: white;
    }

    .description h2 {
      color: #007BFF;
    }

    .description p {
      font-size: 16px;
      line-height: 1.5;
      color: #555;
    }

    .form-container {
      width: 40%;
      padding: 2em;
      background-color: white;
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .form-container h2 {
      text-align: center;
      color: #007BFF;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      font-weight: bold;
      color: #333;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-top: 5px;
    }

    button {
      width: 100%;
      padding: 10px;
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

  <div class="container">
    <div class="description">
      <h2>Form Description</h2>
      <p>This form is used to collect basic information about the school. Please fill out the details below and submit the form to save the data.</p>
      <p>The form will ask for the school name, location, leader, and contact information. These details are essential for creating a record for your school.</p>
      <p>After filling out the form, click the "Submit" button to save the information.</p>
    </div>

    <div class="form-container">
      <h2>School Information Form</h2>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="school_name">School Name:</label>
          <input type="text" id="school_name" name="school_name" required>
        </div>
        
        <div class="form-group">
          <label for="school_location">School Location:</label>
          <input type="text" id="school_location" name="school_location" required>
        </div>
        
        <div class="form-group">
          <label for="school_leader">School Leader:</label>
          <input type="text" id="school_leader" name="school_leader" required>
        </div>
        
        <div class="form-group">
          <label for="school_contacts">School Contacts:</label>
          <input type="text" id="school_contacts" name="school_contacts" required>
        </div>

        <div class="form-group">
          <label for="school_logo">School Logo (Optional):</label>
          <input type="file" id="school_logo" name="school_logo">
        </div>
        
        <button type="submit" name="send">Submit</button>
      </form>
    </div>
  </div>

</body>
</html>

<?php

if (isset($_POST['send'])) {
    // Sanitize input
    $school_name = mysqli_real_escape_string($connect, $_POST['school_name']);
    $school_location = mysqli_real_escape_string($connect, $_POST['school_location']);
    $school_leader = mysqli_real_escape_string($connect, $_POST['school_leader']);
    $school_contacts = mysqli_real_escape_string($connect, $_POST['school_contacts']);

    // Check if logo is uploaded
    $logo_path = "";
    if (isset($_FILES['school_logo'])) {
        $logo = $_FILES['school_logo'];
        $logo_name = $logo['name'];
        $logo_tmp_name = $logo['tmp_name'];
        $logo_size = $logo['size'];
        $logo_error = $logo['error'];

        if ($logo_error === 0) {
            $logo_ext = strtolower(pathinfo($logo_name, PATHINFO_EXTENSION));
            $allowed_exts = ['jpg', 'jpeg', 'png'];

            if (in_array($logo_ext, $allowed_exts)) {
                if ($logo_size <= 5000000) {
                    $logo_new_name = uniqid('logo_', true) . '.' . $logo_ext;
                    $logo_upload_path = 'uploads/' . $logo_new_name;
                    move_uploaded_file($logo_tmp_name, $logo_upload_path);
                    $logo_path = $logo_upload_path;
                } else {
                    echo "<script>alert('Logo too large. Max size is 5MB.');</script>";
                }
            } else {
                echo "<script>alert('Invalid logo format.');</script>";
            }
        } else {
            echo "<script>alert('Error uploading the logo.');</script>";
        }
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $connect->prepare("INSERT INTO `customers` (`school_name`, `school_location`, `school_leader`, `school_contacts`, `school_logo`) VALUES (?, ?, ?, ?, ?)");
    
    // Check if prepare() failed
    if (!$stmt) {
        die("Statement preparation failed: " . $connect->error);
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param("sssss", $school_name, $school_location, $school_leader, $school_contacts, $logo_path);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('School information saved successfully!'); window.location.href = 'customers.php';</script>";
    } else {
        echo "<script>alert('Error saving data: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

include "footer.php"; 
?>
