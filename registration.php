<?php
include "connection.php";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if user already exists
    $check = $connect->prepare("SELECT * FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists'); window.location.href='registration.php';</script>";
    } else {
        // Insert user
        $stmt = $connect->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! You can now log in.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Try again.'); window.location.href='registration.php';</script>";
        }
    }
}
?>

<!-- HTML Registration Form with Description -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            flex-wrap: wrap;
            max-width: 900px;
            margin: 50px auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
        }

        .form-section {
            flex: 1;
            padding: 30px;
            background-color: #ffffff;
        }

        .description-section {
            flex: 1;
            padding: 30px;
            background-color: #0056b3;
            color: white;
        }

        .description-section h3 {
            margin-top: 0;
        }

        h2 {
            text-align: center;
            color: #0056b3;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #0056b3;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #0056b3;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #004085;
        }

        .message {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        .message a {
            color: #0056b3;
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .description-section {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Registration Form -->
    <div class="form-section">
        <h2>User Registration</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="register">Register</button>
        </form>

        <div class="message">
            <p>Already have an account? <a href="index.php">Login here</a></p>
        </div>
    </div>

    <!-- Description Section -->
    <div class="description-section">
        <h3>Why Register?</h3>
        <p>By creating an account, you'll be able to access exclusive features, save your preferences, and enjoy a personalized experience across our platform.</p>
        <p>Your account ensures secure access and keeps your data protected.</p>
        <ul>
            <li>Access secure content</li>
            <li>Save your progress</li>
            <li>Get personalized notifications</li>
        </ul>
        <p>Join our community today and get started with ease!</p>
    </div>
</div>

</body>
</html>
