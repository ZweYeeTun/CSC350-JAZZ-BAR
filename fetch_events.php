<?php

require ('../ch09/mysqli_connect.php');
$result = $dbc->query("SELECT id, event_date, artist_name, event_time , available_tickets FROM events");
$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

header('Content-Type: application/json');
echo json_encode($events);
?>
