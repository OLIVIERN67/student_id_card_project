<?php
include "header.php";
include "connection.php";

$sql = "SELECT * FROM users"; 
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='container'>";
    echo "<h1> List of users</h1>";
    echo "<table class='table'>";
    echo "<tr>
            <th>ID</th>
            <th>USERName</th>
            <th>PASSWORD</th
            <th>Image</th>
            <th>uers image</th>
            <th>Actions</th>
          </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["password"]) . "</td>";
        
        
        echo "<td><img src='" . htmlspecialchars($row["image"]) . "' width='60' style='border-radius: 5px;' alt='loading image'></td>";
        echo "<td class='action'>
                <a href='edit_student.php?id=" . $row["id"] . "' class='btn btn-edit'>Edit</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='delete_student.php?id=" . $row["id"] . "' class='btn btn-delete' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>
                 <a href='download_card.php?id=" . $row["id"] . "' class='btn btn-edit'>download</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<div class='container'><p>No students found.</p></div>";
}

$connect->close();
include "footer.php";
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }
    .action{
        width: 19em;
    }
    .container {
        width: 70%;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }
    h1 {
        text-align: center;
        color: #007bff;
        font-size: 32px;
        margin-bottom: 20px;
    }
    table {
        width: 94%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-left: 6em;
        font-size: 14px;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
        vertical-align: middle;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f1f1f1;
    }
    tr:hover {
        background-color: #e0e0e0;
    }
    .btn {
        padding: 6px 10px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        font-size: 13px;
    }
    .btn-edit {
        background-color: #28a745;
        color: white;
    }
    .btn-edit:hover {
        background-color: #218838;
    }
    .btn-delete {
        background-color: #dc3545;
        color: white;
        margin-left: 5px;
    }
    .btn-delete:hover {
        background-color: #c82333;
    }
</style>

