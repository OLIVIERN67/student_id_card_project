<?php
include "header.php";
include "connection.php";

$sql = "SELECT * FROM students";
$result = $connect->query($sql);
?>
<br><br><br><br><br>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 80%;
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
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
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
      color: #333;
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
      cursor: pointer;
      border: none;
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

    .action {
      width: 20em;
      text-align: center;
    }

    #downloadAll {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      font-size: 15px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    #downloadAll:hover {
      background-color: #0056b3;
    }

    .hidden-card {
      position: fixed;
      top: -9999px;
      left: -9999px;
    }
    .txt{
      margin-left: 7em;
    }
  </style>
</head>
<body>

<div class="container">
 
  <h1>Student List</h1>
  <button id="downloadAll">Download All Cards</button>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Class</th>
      <th>Sex</th>
      <th>Date of Birth</th>
      <th>Academic Year</th>
      <th>Image</th>
      <th>Actions</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['class']) . "</td>
                <td>" . htmlspecialchars($row['sex']) . "</td>
                <td>" . htmlspecialchars($row['dob']) . "</td>
                <td>" . htmlspecialchars($row['academic_year']) . "</td>
                <td><img src='" . htmlspecialchars($row['image']) . "' width='60' style='border-radius:5px;'></td>
                <td class='action'>
                  <a href='edit_student.php?id=" . $row['id'] . "' class='btn btn-edit'>Edit</a>
                  <a href='delete_student.php?id=" . $row['id'] . "' class='btn btn-delete' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>
                  <button class='btn btn-edit btn-download' data-id='" . $row['id'] . "'>Download</button>
                </td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='8' style='text-align:center;'>No students found</td></tr>";
    }
    ?>
  </table>
</div>

<!-- html2canvas Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  // Single download
  document.querySelectorAll(".btn-download").forEach(btn => {
    btn.addEventListener("click", function () {
      const row = this.closest("tr");
      generateAndDownloadCard(row);
    });
  });

  // Download all
  document.querySelector("#downloadAll").addEventListener("click", function () {
    const rows = document.querySelectorAll("table tr:not(:first-child)");
    let delay = 0;
    rows.forEach((row, index) => {
      setTimeout(() => generateAndDownloadCard(row), delay);
      delay += 1200; // Wait a bit between downloads
    });
  });

  // Generate card dynamically and download
  function generateAndDownloadCard(row) {
    const card = document.createElement("div");
    card.classList.add("hidden-card");
    card.innerHTML = `
      <div style="width:345px; height:192px; color:black; padding:10px; font-family:Georgia; box-sizing:border-box;">
        <div style='display:flex;justify-content:space-between;align-items:center;background:#ffff;padding:5px; margin-top:-1em;
        
        margin-left:-3em;margin-right:-3em;width:40em,'>
          <img src='rwanda-logo.png' style='width:40px;'>
          <div style='text-align:center; font-size:9px; line-height:1.2; color:black;'>
            <div>MINISTRY OF EDUCATION</div>
            <div>WESTERN PROVINCE</div>
            <div>RUBAVU DISTRICT</div>
            <div style='font-size:11px; font-weight:bold;'>COLLEGE BAPTISTE GACUBA II TVET SCHOOL</div>
            <div style='font-size:12px; color:#b300b3; font-weight:bold;'>STUDENT ID CARD</div>
          </div>
          <img src='cratt.png' style='width:40px;'>
        </div>
        <div style='display:flex;justify-content:space-between;margin-top:10px;font-size:9px;'>
          <div>
            <p><b>Student Name:</b> ${row.children[1].textContent}</p>
            <p><b>Class:</b> ${row.children[2].textContent}</p>
            <p><b>Sex:</b> ${row.children[3].textContent}</p>
            <p><b>Date of Birth:</b> ${row.children[4].textContent}</p>
            <p><b>Academic Year:</b> ${row.children[5].textContent}</p>
          </div>
          <div>
            <img src='${row.querySelector("img").src}' style='width:60px;height:60px;border:2px solid #000;border-radius:10px;'>
          </div>
        </div>
        <div style='
        
        
        margin-left:-1.6em;margin-right:-5em;
        background:#ffeb3b;margin-top:7.7em;padding:2px;display:flex;justify-content: space-between;font-size:6px;'>
         <div class='txt'>
          <span>Date of Issue: 01 Nov 2024 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Emergency Call: +250781508248</span>
          &nbsp;&nbsp;Date of Expiry: 2027</span>
         </div>
        </div>
      </div>
    `;
    document.body.appendChild(card);

    html2canvas(card.firstElementChild, {
      scale: 3,
      useCORS: true,
      logging: false,
      backgroundColor: "#ffffff"
    }).then(canvas => {
      const link = document.createElement("a");
      const studentName = row.children[1].textContent.replace(/\s+/g, "_");
      link.download = `${studentName}_ID_Card.jpg`;
      link.href = canvas.toDataURL("image/jpeg", 1.0);
      link.click();
      card.remove();
    });
  }
});
</script>

</body>
</html>

<?php include "footer.php"; ?>
