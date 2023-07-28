<?php

// Include the database connection file
require_once("../private/mysql_connection.php");

// Get the selected staff ID from AJAX POST request
$selectedJobId = $_POST['job_id'];

// Query to fetch positions associated with the selected staff
$sql = "SELECT location_id, location_name FROM location WHERE job_id = " . $selectedJobId;
$result = $conn->query($sql);

// Prepare the data for JSON response
$locations = array();
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$locations[] = $row;
}
}

// Close the database connection
$conn->close();

// Return positions as a JSON response
header('Content-Type: application/json');
echo json_encode($locations);
?>