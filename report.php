<?php
include "header.php";
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-left: 18em;
        }
        h2 {
            text-align: center;
            color: #007BFF;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        select, input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 80em;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: 4em;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Generate Reports</h2>
    <form action="#" method="POST">
        <div class="form-group">
            <label for="report_type">Select Report Type:</label>
            <select id="report_type" name="report_type" required>
                <option value="" disabled selected>Choose Report</option>
                <option value="employees">Employee Report</option>
                <option value="schools">School Report</option>
                <option value="students">Student ID Report</option>
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">
        </div>

        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">
        </div>

        <button type="submit" name="generate">Generate Report</button>
    </form>

    <?php
    if (isset($_POST['generate'])) {
        $report_type = $_POST['report_type'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Query based on report type
        if ($report_type == "employees") {
            $query = "SELECT * FROM employees";
        } elseif ($report_type == "schools") {
            $query = "SELECT * FROM customers";
        } elseif ($report_type == "students") {
            $query = "SELECT * FROM student_ids";
        }

        // Apply date range filter if provided
        if (!empty($start_date) && !empty($end_date)) {
            $query .= " WHERE created_at BETWEEN '$start_date' AND '$end_date'";
        }

        $result = $connect->query($query);

        if ($result->num_rows > 0) {
            echo "<table><tr>";

            // Dynamically fetch table headers
            while ($fieldinfo = $result->fetch_field()) {
                echo "<th>{$fieldinfo->name}</th>";
            }
            echo "</tr>";

            // Fetch and display rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $data) {
                    echo "<td>$data</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color:red; text-align:center;'>No records found for this report.</p>";
        }
    }
    ?>
</div>

</body>
</html>

<?php include "footer.php"; ?>
