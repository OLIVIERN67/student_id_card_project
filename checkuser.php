<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "connection.php";

if (isset($_POST['check'])) {
    $user = mysqli_real_escape_string($connect, $_POST['username']);
    $pass = $_POST['password'];

    // Prepare the SQL query
    $stmt = $connect->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if query execution was successful
    if ($result === false) {
        die("Error in SQL query: " . $connect->error);  // Show error if any
    }

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user;
            echo "<script>alert('Login successful!'); window.location.href='userhome.php';</script>";
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
