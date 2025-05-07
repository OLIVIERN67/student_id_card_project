<?php
include "header.php";

include "connection.php";

$upload_dir = "uploads/";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $connect->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Student not found.";
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $class = $_POST["class"];
    $sex = $_POST["sex"];
    $dob = $_POST["dob"];
    $academic_year = $_POST["academic_year"];
    $image_name = $row["image"]; // Default to old image

    // Handle image upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_file = $upload_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_name = $target_file;
            } else {
                echo "Image upload failed.";
            }
        } else {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }

    $update = "UPDATE students SET 
                name='$name', 
                class='$class', 
                sex='$sex', 
                dob='$dob', 
                academic_year='$academic_year', 
                image='$image_name'
               WHERE id=$id";

    if ($connect->query($update)) {
        header("Location: view_student.php");
        exit;
    } else {
        echo "Update failed: " . $connect->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }
        .container {
            width: 500px;
            background-color: #fff;
            padding: 25px;
            margin: auto;
            margin-top: 2em;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        
        }
        h2 {
            color: #007bff;
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="date"], select, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        img {
            width: 115px;
            height: 115px;
            object-fit: cover;
            display: block;
            margin: 0 auto 15px;
            border-radius: 5px;
            margin-top: -1em;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Student</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>

        <label>Class:</label>
        <input type="text" name="class" value="<?= htmlspecialchars($row['class']) ?>" required>

        <label>Sex:</label>
        <select name="sex" required>
            <option value="Male" <?= $row['sex'] == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $row['sex'] == 'Female' ? 'selected' : '' ?>>Female</option>
        </select>

        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?= $row['dob'] ?>" required>

        <label>Academic Year:</label>
        <input type="text" name="academic_year" value="<?= htmlspecialchars($row['academic_year']) ?>" required>

        <label>Current Image:</label><br>
        <img src="<?= htmlspecialchars($row['image']) ?>" alt="Student Image">

        <label>Choose New Image:</label>
        <input type="file" name="image" accept="image/*">

        <input type="submit" value="Update Student">
    </form>
</div>

</body>
</html>
<?php include "footer.php"; ?>
