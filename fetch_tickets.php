<?php
require('../ch09/mysqli_connect.php'); // Ensure this path is correct

header('Content-Type: application/json');

// Decode JSON input
$input = json_decode(file_get_contents('php://input'), true);
$first_name = $input['first_name'];
$email = $input['email'];

// Prepare and execute the query
$sql = "SELECT 
tickets.first_name,
tickets.last_name,
tickets.email,
tickets.payment_method,
tickets.ticket_quantity,
tickets.event_id,
events.artist_name,
events.event_time,
events.event_date
FROM 
tickets
INNER JOIN 
events
ON 
tickets.event_id = events.id
 WHERE tickets.first_name = ? AND tickets.email = ?;";
$stmt = $dbc->prepare($sql);

//$stmt = $dbc->prepare("SELECT * FROM tickets WHERE first_name = ? AND email = ?");
$stmt->bind_param("ss", $first_name, $email);
$stmt->execute();
$result = $stmt->get_result();

// Fetch tickets as an array
$tickets = [];
while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
}

// Return tickets as JSON
echo json_encode($tickets);

$stmt->close();
$dbc->close();
?>