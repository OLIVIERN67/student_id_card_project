<?php
include "connection.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM students WHERE id = $id";

    if ($connect->query($sql)) {
        header("Location: view_student.php");
        exit;
    } else {
        echo "Error deleting student: " . $connect->error;
    }
} else {
    echo "Invalid student ID.";
}
