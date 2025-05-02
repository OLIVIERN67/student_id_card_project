<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student ID Card Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f1f7ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
            max-width: 1500px;
           
            margin: 50px auto;
            padding: 20px;
            background-color: #f1f7ff; /* Ensure background color matches page */
        }

        .info-panel {
            background-color: #0056b3;
            color: white;
            padding: 25px;
             width: 56em;
            border-radius: 15px;
            flex: 1;
            max-width: 400px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .container {
            background:white;
            padding: 30px 35px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            flex: 1;
            max-width: 600px;
            position: relative;
            height: 40em;
            width: 10em;
           margin-right: -40em;
        }

        h1 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5em;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1 1 45%;
            min-width: 45%;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #003366;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cce0ff;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="file"]:focus,
        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            font-weight: bold;
            margin-top: 15px;
            padding: 12px;
            border-radius: 8px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .revi {
            margin-top: -24em;
            margin-left: -57em;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            position: absolute; /* Fix position under the form */
            width: 40em;
            height: 16em;
            top: 100%; /* Ensure it stays below the form */
            left: 0;
            padding-top: 15px;
        }

        @media (max-width: 900px) {
            .main-wrapper {
                flex-direction: column;
                align-items: center;
            }
            .info-panel,
            .container {
                max-width: 100%;
            }
            .form-group {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="main-wrapper" style="width:90em; margin-left: 7em;">
    <div class="info-panel" >
        <h2>Form Instructions</h2>
        <ul>
            <li>Fill in the student's full legal name.</li>
            <li>Select the correct class level (S1 to S6).</li>
            <li>Choose the student's gender.</li>
            <li>Provide accurate date of birth.</li>
            <li>Upload a clear passport-style photo (JPG, PNG, max 5MB).</li>
            <li>Click "Generate ID Card" to submit.</li>
        </ul>
    </div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="container">
        <h1>Student Information</h1><br><br><br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Student Name:</label>
                    <input type="text" id="name" name="name" required placeholder="Enter full name">
                </div>
                <div class="form-group">
                    <label for="class">Class:</label>
                    <select id="class" name="class" required>
                        <option value="" disabled selected>Select class</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="S4">S4</option>
                        <option value="S5">S5</option>
                        <option value="S6">S6</option>
                    </select>
                </div>
            </div>
             <br><br><br>
            <div class="form-row">
                <div class="form-group">
                    <label for="sex">Sex:</label>
                    <select id="sex" name="sex" required>
                        <option value="" disabled selected>Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
            </div>
              <br><br><br>
            <div class="form-row">
                <div class="form-group">
                    <label for="academic_year">Academic Year:</label>
                    <input type="text" id="academic_year" name="academic_year" value="2024/2025" readonly>
                </div>
                <div class="form-group">
                    <label for="student_image">Student Image:</label>
                    <input type="file" id="student_image" name="student_image" accept="image/*" required>
                </div>
            </div>
            <br><br>
            <input type="submit" value="Generate ID Card">
        </form>

        <?php
        include "connection.php";
        $message = "";
        $message_type = "";
        $summary = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $class = trim($_POST['class']);
            $sex = trim($_POST['sex']);
            $dob = $_POST['dob'];
            $academic_year = $_POST['academic_year'];

            // Check if student already exists in the database
            $check_sql = "SELECT * FROM students WHERE name = ? AND class = ? AND dob = ?";
            $check_stmt = $connect->prepare($check_sql);
            $check_stmt->bind_param("sss", $name, $class, $dob);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                $message = "Data already exists in the database.";
                $message_type = "error";
            } else {
                if (isset($_FILES['student_image'])) {
                    $image = $_FILES['student_image'];
                    $image_name = $image['name'];
                    $image_tmp_name = $image['tmp_name'];
                    $image_size = $image['size'];
                    $image_error = $image['error'];

                    if ($image_error === 0) {
                        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

                        if (in_array($image_ext, $allowed_exts)) {
                            if ($image_size <= 5000000) {
                                $image_new_name = uniqid('IMG_', true) . '.' . $image_ext;
                                $image_upload_path = 'uploads/' . $image_new_name;

                                if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
                                    $sql = "INSERT INTO students (name, class, sex, dob, academic_year, image) VALUES (?, ?, ?, ?, ?, ?)";
                                    $stmt = $connect->prepare($sql);

                                    if ($stmt) {
                                        $stmt->bind_param("ssssss", $name, $class, $sex, $dob, $academic_year, $image_upload_path);
                                        if ($stmt->execute()) {
                                            $message = "Student ID Card generated successfully!";
                                            $message_type = "success";

                                            $summary = "
                                            <div class='revi'>
                                                <h3 style='margin-bottom: 15px;'>Student Info Summary</h3>
                                                <p><strong>Name:</strong> $name</p>
                                                <p><strong>Class:</strong> $class</p>
                                                <p><strong>Sex:</strong> $sex</p>
                                                <p><strong>Date of Birth:</strong> $dob</p>
                                                <p><strong>Academic Year:</strong> $academic_year</p>
                                                
                                                <img src='$image_upload_path' alt='Uploaded Image' style='max-width: 200px; border-radius: 8px; border: 1px solid #888; margin-left:27em;margin-top:-16em' />
                                            </div>
                                            ";
                                        } else {
                                            $message = "Execution failed: " . $stmt->error;
                                            $message_type = "error";
                                        }
                                        $stmt->close();
                                    } else {
                                        $message = "Preparation failed: " . $connect->error;
                                        $message_type = "error";
                                    }
                                } else {
                                    $message = "Error uploading image.";
                                    $message_type = "error";
                                }
                            } else {
                                $message = "Image too large. Max is 5MB.";
                                $message_type = "error";
                            }
                        } else {
                            $message = "Invalid image type.";
                            $message_type = "error";
                        }
                    } else {
                        $message = "Error uploading the image.";
                        $message_type = "error";
                    }
                }
            }

            if ($message) {
                echo "<div class='message $message_type'>$message</div>";
            }

            if (!empty($summary)) {
                echo $summary;
            }
        }
        ?>
    </div>
</div>

<script>
    const studentImageInput = document.getElementById("student_image");
    const previewContainer = document.createElement("div");
    previewContainer.style.marginTop = "15px";
    studentImageInput.parentElement.appendChild(previewContainer);

    studentImageInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                previewContainer.innerHTML = 
                    <label style="display:block; margin-bottom: 8px; font-weight: bold;">Preview:</label>
                    <img src="${reader.result}" style="max-width: 100px; border-radius: 10px; border: 2px solid #007bff;" />
                ;
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.innerHTML = "";
        }
    });
</script>

</body>
</html>
<?php include "footer.php"; ?>