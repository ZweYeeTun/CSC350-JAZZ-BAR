<?php
// Database connection details
require ('../ch09/mysqli_connect.php');

// Check connection

// SQL query to fetch data from the `announcement` table
$sql = "SELECT title, description FROM announcement";
$result = $dbc->query($sql);

$announcements = [];

// Fetch data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
}

// Close connection
$dbc->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($announcements);
?>
