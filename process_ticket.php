<?php
require('../ch09/mysqli_connect.php');
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$payment_method = $_POST['payment_method'];
$ticket_quantity = (int)$_POST['ticket_quantity'];
$event_id = (int)$_POST['artist_time'];

// Insert into tickets table
$stmt = $dbc->prepare("INSERT INTO tickets (first_name, last_name, email, payment_method, ticket_quantity, event_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssii", $first_name, $last_name, $email, $payment_method, $ticket_quantity, $event_id);

if ($stmt->execute()) {
    echo "Ticket purchased successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$dbc->close();
?>