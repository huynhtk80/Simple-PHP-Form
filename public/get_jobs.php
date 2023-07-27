<?php

// Include the database connection file
require_once("../private/mysql_connection.php");

// Get the selected staff ID from AJAX POST request
$selectedCustomerId = $_POST['customer_id'];

// Query to fetch positions associated with the selected staff
$sql = "SELECT job_id, job_name FROM job WHERE customer_id = " . $selectedCustomerId;
$result = $conn->query($sql);

// Prepare the data for JSON response
$jobs = array();
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$jobs[] = $row;
}
}

// Close the database connection
$conn->close();

// Return positions as a JSON response
header('Content-Type: application/json');
echo json_encode($jobs);
?>