<?php
session_start();
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please enter both username and password.'); window.location.href='index.php';</script>";
        exit();
    }

    $stmt = $connect->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        if ($password === $stored_password) {
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            header("Location: userhome.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password'); window.location.href='index.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('User not found'); window.location.href='index.php';</script>";
        exit();
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            width: 60%;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .left-section {
            width: 50%;
            padding: 40px;
        }

        .left-section h2 {
            margin-bottom: 20px;
            font-family: Castella, serif;
            margin-left: 2em;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .register {
            margin-top: 10px;
        }

        .right-section {
            width: 50%;
            background: #007bff;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .right-section img {
            width: 11em;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        #support {
            color: white;
            display: block;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }

            .left-section, .right-section {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <h2>Login to get access in CRAT</h2>
            <form  method="POST">
                <label for="username">Email</label>
                <input type="text" id="username" name="username" placeholder="Enter your username here" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password here" required minlength="6">

                <button type="submit">Login</button>
                <p class="register">Don't have an account? <a href="registration.php">Sign up</a></p>
            </form>
        </div>

        <div class="right-section">
            <img src="crat.png" alt="CRAT Logo">
            <p>Welcome to our company! We offer the best services to help you succeed.</p>
            <br><br>
            <a href="mailto:ndiholivier2@gmail.com" id="support" target="_blank">Email: ndiholivier2@gmail.com</a>
            <a href="tel:+250786718716" id="support" target="_blank">Phone: 0786718716</a>
        </div>
    </div>
</body>
</html>
