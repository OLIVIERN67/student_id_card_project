<?php

include"header.php";
include"connection.php";

$sql= mysqli_query($connect,"SELECT * FROM customers");

if ($sql ->num_rows>0) {
    // code...
    echo "<div class='container'>";
    echo "<h1>Schools List</h1>";
    echo "<table>";
     echo "<tr>

       <th>school code</th>
        <th>school name</th>
         <th>school_location</th>
          <th>  school_leader</th>
           <th>school_contacts</th>
           <th>school_logo</th>
      </tr>
     ";
    

    while ($data= $sql->fetch_assoc()) {
        // code...
        echo "<tr>";


   echo "<td>" . htmlspecialchars($data["id"]) ."</td>";
    echo "<td>" . htmlspecialchars($data["school_name"]) . "</td>";
    echo "<td>" . htmlspecialchars($data["school_location"]) . "</td>";
    echo "<td>" . htmlspecialchars($data["school_leader"]) . "</td>";
    echo "<td>" . htmlspecialchars($data["school_contacts"]) . "</td>";
    echo "<td> <img src='" . htmlspecialchars($data["school_logo"]) ."'width='60' style='border-radius: 75px;'></td>";

    //echo "<td><img src='" . htmlspecialchars($row["image"]) . "' width='60' style='border-radius: 5px;'></td>";
        echo"</tr>";
    }
    echo "</table>";
    echo "</div>";
}
?>

<style type="text/css">
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
        width: 95%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-left: 5em;
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

<?php
include "footer.php";
?>
