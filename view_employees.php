<?php
include "header.php";
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Employee Records</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 2em;
    }

    h2 {
      text-align: center;
      color: #007BFF;
    }

    table {
      width: 80%;
      margin: auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
      margin-left: 20em;
      margin-top: 4em;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #007BFF;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .no-data {
      text-align: center;
      color: red;
      margin-top: 2em;
    }
  </style>
</head>
<body>

  <h2>Employee Records</h2>

  <?php
  $sql = "SELECT * FROM employees ORDER BY id DESC";
  $result = $connect->query($sql);

  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>#</th>
            <th>Full Names</th>
            <th>ID Card</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Position</th>
            <th>Category</th>
          </tr>";

    $count = 1;
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>{$count}</td>
              <td>{$row['full_names']}</td>
              <td>{$row['identity_card']}</td>
              <td>{$row['email']}</td>
              <td>{$row['phone']}</td>
              <td>{$row['address']}</td>
              <td>{$row['position']}</td>
              <td>{$row['category']}</td>
            </tr>";
      $count++;
    }

    echo "</table>";
  } else {
    echo "<p class='no-data'>No employee records found.</p>";
  }

  $connect->close();
  ?>

</body>
</html>

<?php
include "footer.php";
?>
