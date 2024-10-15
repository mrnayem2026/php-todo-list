<?php
include "db.php";

if (isset($_POST['id']) && isset($_POST['task'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE task SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $task, $id);

    if ($stmt->execute()) {
        // Redirect to the main page after successful update
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid input.";
}

$conn->close();
?>