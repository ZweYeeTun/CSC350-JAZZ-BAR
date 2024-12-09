_<?php
require ('../ch09/mysqli_connect.php');

$action = $_POST['action'] ?? 'save';

if ($action === 'save') {
    // Add or Update Event
    $event_id = $_POST['event_id'] ?? null;
    $event_date = $_POST['event_date'];
    $artist_name = $_POST['artist_name'];
    $event_time = $_POST['event_time'];
    $available_tickets = $_POST['available_tickets'];

    if ($event_id) {
        // Update existing event
        $stmt = $dbc->prepare("UPDATE events SET event_date = ?, artist_name = ?, event_time = ?, available_tickets = ? WHERE id = ?");
        $stmt->bind_param("sssii", $event_date, $artist_name, $event_time, $available_tickets, $event_id);
    } else {
        // Insert new event
        $stmt = $dbc->prepare("INSERT INTO events (event_date, artist_name, event_time, available_tickets) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $event_date, $artist_name, $event_time, $available_tickets);
    }

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Event saved successfully.']);
    } else {
        echo json_encode(['message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
} elseif ($action === 'delete') {
    // Delete Event
    $event_id = $_POST['event_id'];
    $stmt = $dbc->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Event deleted successfully.']);
    } else {
        echo json_encode(['message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
}

$dbc->close();
