<?php
require('../ch09/mysqli_connect.php'); // Adjust the path if needed

$action = $_POST['action'] ?? 'save';

if ($action === 'save') {
    // Update the only announcement
    $announcement_title = $_POST['announcement_title'];
    $announcement_description = $_POST['announcement_description'];

    // Check if the announcement row exists
    $result = $dbc->query("SELECT * FROM announcement");
    if ($result->num_rows > 0) {
        // Update the existing row
        $stmt = $dbc->prepare("UPDATE announcement SET title = ?, description = ?");
        $stmt->bind_param("ss", $announcement_title, $announcement_description);
    } else {
        // Insert a new row if no announcement exists
        $stmt = $dbc->prepare("INSERT INTO announcement (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $announcement_title, $announcement_description);
    }

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Announcement saved successfully.']);
    } else {
        echo json_encode(['message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
}

$dbc->close();
