<?php
include"connection.php";
if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $class = isset($_POST['class']) ? $_POST['class'] : '';
    $leader = isset($_POST['leader']) ? $_POST['leader'] : '';
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $trade = isset($_POST['trade']) ? $_POST['trade'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $academic_year = isset($_POST['academic_year']) ? $_POST['academic_year'] : '';

    // Handle File Upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Folder to store images
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create folder if it doesn't exist
        }

        $photo_name = basename($_FILES["photo"]["name"]);
        $photo_tmp = $_FILES["photo"]["tmp_name"];
        $photo_path = $target_dir . time() . "_" . $photo_name; // Rename image to prevent duplicates

        if (move_uploaded_file($photo_tmp, $photo_path)) {
            // Insert Data into Database
            $stmt = $conn->prepare("INSERT INTO students (name, class, leader, sex, trade, dob, academic_year, photo) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $name, $class, $leader, $sex, $trade, $dob, $academic_year, $photo_path);

            if ($stmt->execute()) {
                echo "Student record saved successfully!";
                header("Location: success.php"); // Redirect to a success page
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Please upload a valid image file.";
    }
}

$connect->close();
    ?>