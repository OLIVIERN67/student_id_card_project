<?php
include "header.php";
include "connection.php";

$sql = "SELECT * FROM students"; 
$result = $connect->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List - CRAT System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2em 1em;
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 2.5em;
            animation: slideDown 0.6s ease-out;
        }

        .page-title {
            font-size: clamp(24px, 6vw, 36px);
            color: #333;
            font-weight: 700;
            margin-bottom: 0.5em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8em;
        }

        body.dark-mode .page-title {
            color: #e0e0e0;
        }

        .page-title i {
            color: #4fa1ed;
            animation: iconFloat 3s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .subtitle {
            font-size: clamp(14px, 3vw, 16px);
            color: #666;
            margin-bottom: 1.5em;
        }

        body.dark-mode .subtitle {
            color: #b0b0b0;
        }

        /* Container */
        .container {
            max-width: 1350px;
            margin: 0 auto;
            margin-top:-3em;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        body.dark-mode .container {
            background: #2d2d2d;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Table Container */
        .table-wrapper {
            overflow-x: auto;
            padding: 0;
            width: 100%;
        }

        table {
            width: 90em;
            border-collapse: collapse;
            font-size: clamp(13px, 2.5vw, 15px);
        }

        th {
            background: linear-gradient(135deg, #4fa1ed 0%, #3578d2 100%);
            color: white;
            padding: 1.2em;
            text-align: left;
            font-weight: 600;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 10;
            transition: all 0.3s ease;
        }

        th:hover {
            background: linear-gradient(135deg, #3578d2 0%, #2560b8 100%);
        }

        td {
            padding: 1em 1.2em;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: middle;
            transition: all 0.3s ease;
            color: #333;
        }

        body.dark-mode td {
            border-bottom: 1px solid #444;
            color: #e0e0e0;
        }

        tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(79, 161, 237, 0.08);
            transform: scale(1.01);
        }

        body.dark-mode tbody tr:hover {
            background: rgba(79, 161, 237, 0.15);
        }

        /* Student Image */
        .student-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #4fa1ed;
            transition: all 0.3s ease;
        }

        td:hover .student-image {
            transform: scale(1.1);
            border-color: #3578d2;
        }

        /* Action Buttons */
        .action-cell {
            display: flex;
            gap: 0.8em;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn {
            padding: 0.6em 1em;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: clamp(12px, 2.5vw, 13px);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.4em;
            cursor: pointer;
            border: none;
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.4s ease;
            z-index: -1;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-edit {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-delete {
            background: linear-gradient(135deg, #dc3545 0%, #e74c3c 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-download {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        /* No Data Message */
        .no-data {
            text-align: center;
            padding: 4em 2em;
            color: #666;
            font-size: clamp(16px, 4vw, 20px);
        }

        body.dark-mode .no-data {
            color: #b0b0b0;
        }

        .no-data i {
            font-size: clamp(40px, 10vw, 60px);
            color: #ccc;
            margin-bottom: 1em;
            display: block;
            animation: fadeInUp 0.8s ease-out;
        }

        body.dark-mode .no-data i {
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            body {
                padding: 1.5em 0.8em;
            }

            .container {
                border-radius: 12px;
            }

            th, td {
                padding: 0.9em;
            }

            .btn {
                padding: 0.5em 0.8em;
                font-size: 12px;
            }

            .student-image {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1em 0.5em;
            }

            .page-header {
                margin-bottom: 1.5em;
            }

            .container {
                border-radius: 10px;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 0.8em;
            }

            th {
                font-size: 12px;
            }

            .action-cell {
                flex-direction: column;
                gap: 0.5em;
            }

            .btn {
                width: 100%;
                padding: 0.6em;
                justify-content: center;
                font-size: 12px;
            }

            .student-image {
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.8em 0.4em;
            }

            .page-title {
                font-size: 20px;
                flex-direction: column;
            }

            .subtitle {
                font-size: 13px;
                margin-bottom: 1em;
            }

            .container {
                border-radius: 8px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            }

            .table-wrapper {
                padding: 0;
            }

            table {
                font-size: 12px;
            }

            th {
                padding: 0.7em 0.5em;
                font-size: 11px;
                font-weight: 600;
            }

            td {
                padding: 0.7em 0.5em;
            }

            .action-cell {
                flex-direction: column;
                gap: 0.4em;
            }

            .btn {
                width: 100%;
                padding: 0.5em 0.4em;
                font-size: 11px;
                justify-content: center;
            }

            .btn i {
                font-size: 12px;
            }

            .student-image {
                width: 45px;
                height: 45px;
            }

            .no-data {
                padding: 2em 1em;
                font-size: 15px;
            }

            .no-data i {
                font-size: 40px;
            }
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>
<body>

    <div class="page-header">
        <!-- <h1 class="page-title">
            <i class="fas fa-graduation-cap"></i>
            Student List
        </h1> -->
        <br><br><br><br><br>
        <p class="subtitle">Manage and view all student records</p>
    </div>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            echo "<div class='table-wrapper'>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>
                    <th><i class='fas fa-id-card' style='margin-right: 0.5em;'></i>ID</th>
                    <th><i class='fas fa-user' style='margin-right: 0.5em;'></i>Name</th>
                    <th><i class='fas fa-book' style='margin-right: 0.5em;'></i>Class</th>
                    <th><i class='fas fa-venus-mars' style='margin-right: 0.5em;'></i>Sex</th>
                    <th><i class='fas fa-calendar' style='margin-right: 0.5em;'></i>Date of Birth</th>
                    <th><i class='fas fa-calendar-alt' style='margin-right: 0.5em;'></i>Academic Year</th>
                    <th><i class='fas fa-image' style='margin-right: 0.5em;'></i>Image</th>
                    <th><i class='fas fa-cogs' style='margin-right: 0.5em;'></i>Actions</th>
                  </tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td><strong>" . htmlspecialchars($row["name"]) . "</strong></td>";
                echo "<td>" . htmlspecialchars($row["class"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["sex"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["dob"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["academic_year"]) . "</td>";
                echo "<td><img src='" . htmlspecialchars($row["image"]) . "' class='student-image' alt='student image'></td>";
                echo "<td>";
                echo "<div class='action-cell'>";
                echo "<a href='edit_student.php?id=" . $row["id"] . "' class='btn btn-edit'><i class='fas fa-edit'></i> Edit</a>";
                echo "<a href='delete_student.php?id=" . $row["id"] . "' class='btn btn-delete' onclick=\"return confirm('Are you sure you want to delete this student?');\"><i class='fas fa-trash'></i> Delete</a>";
                echo "<a href='download_card.php?id=" . $row["id"] . "' class='btn btn-download'><i class='fas fa-download'></i> Download</a>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='no-data'>";
            echo "<i class='fas fa-inbox'></i>";
            echo "<p>No students found.</p>";
            echo "<p style='font-size: 0.9em; opacity: 0.7;'>Start by adding a new student to the system.</p>";
            echo "</div>";
        }

        $connect->close();
        ?>
    </div>

    <?php include "footer.php"; ?>

</body>
</html>