<?php
session_start(); // Start the session to track user login status

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

include "header.php";
include "connection.php";

// Handle Delete Action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($connect, "DELETE FROM customers WHERE id=$id");
    echo "<script>alert('Record deleted!'); window.location.href='view_customers.php';</script>";
}

// Handle Update Action
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($connect, $_POST['school_name']);
    $location = mysqli_real_escape_string($connect, $_POST['school_location']);
    $leader = mysqli_real_escape_string($connect, $_POST['school_leader']);
    $contact = mysqli_real_escape_string($connect, $_POST['school_contacts']);

    $logoUpdate = "";
    if (!empty($_FILES['school_logo']['name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["school_logo"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        $allowTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["school_logo"]["tmp_name"], $targetFilePath)) {
                $logoUpdate = ", school_logo='$fileName'";
            } else {
                echo "<script>alert('Failed to upload logo.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type for logo.');</script>";
        }
    }

    $query = "UPDATE customers SET 
        school_name='$name', 
        school_location='$location', 
        school_leader='$leader', 
        school_contacts='$contact' 
        $logoUpdate 
        WHERE id=$id";

    if (!mysqli_query($connect, $query)) {
        die("Error updating record: " . mysqli_error($connect));
    }

    echo "<script>alert('Record updated!'); window.location.href='view_customers.php';</script>";
}

// Fetch data
$query = "SELECT id, school_name, school_location, school_leader, school_contacts, school_logo FROM customers";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>School Records</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }
    .table-container {
      width: 73%;
      margin: 50px auto;
      background-color: white;
      padding: 20px;
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      margin-top: -2em;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #007BFF;
      color: white;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    img.logo {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    .update-form {
      width: 80%;
      margin: 20px auto;
      background-color: white;
      padding: 20px;
      border: 1px solid #007BFF;
      border-radius: 8px;
    }
    .update-form input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #007BFF;
      border-radius: 4px;
    }
    .update-form button {
      padding: 10px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .update-form button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="table-container">
  <h2 style="text-align:center;">School Information Records</h2>
  <table>
    <thead>
      <tr>
        <th>Logo</th>
        <th>School Name</th>
        <th>Location</th>
        <th>Leader</th>
        <th>Contacts</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          // Display logo only if it exists
          if (!empty($row['school_logo']) && file_exists("uploads/{$row['school_logo']}")) {
              echo "<td><img class='logo' src='uploads/{$row['school_logo']}' alt='logo'></td>";
          } else {
              echo "<td><span>No Image</span></td>";
          }
          echo "<td>" . htmlspecialchars($row['school_name']) . "</td>";
          echo "<td>" . htmlspecialchars($row['school_location']) . "</td>";
          echo "<td>" . htmlspecialchars($row['school_leader']) . "</td>";
          echo "<td>" . htmlspecialchars($row['school_contacts']) . "</td>";
          echo "<td>
                  <a href='#' onclick='showEditForm({$row['id']}, \"{$row['school_name']}\", \"{$row['school_location']}\", \"{$row['school_leader']}\", \"{$row['school_contacts']}\")' style='color: green;'>Edit</a> |
                  <a href='?delete={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")' style='color: red;'>Delete</a>
                </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No records found</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Update Form -->
<div id="updateFormContainer" class="update-form" style="display:none;">
  <h2>Edit School Record</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" id="editId" name="id">
    <label>School Name</label>
    <input type="text" id="editName" name="school_name" required>
    <label>Location</label>
    <input type="text" id="editLocation" name="school_location" required>
    <label>Leader</label>
    <input type="text" id="editLeader" name="school_leader" required>
    <label>Contacts</label>
    <input type="text" id="editContacts" name="school_contacts" required>
    <label>Update Logo</label>
    <input type="file" name="school_logo">
    <button type="submit" name="update">Update</button>
    <button type="button" onclick="closeEditForm()">Cancel</button>
  </form>
</div>

<script>
  function showEditForm(id, name, location, leader, contacts) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editLocation').value = location;
    document.getElementById('editLeader').value = leader;
    document.getElementById('editContacts').value = contacts;
    document.getElementById('updateFormContainer').style.display = 'block';
  }

  function closeEditForm() {
    document.getElementById('updateFormContainer').style.display = 'none';
  }
</script>

</body>
</html>

<?php include "footer.php"; ?>
