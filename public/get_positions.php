<?php

// Include the database connection file
require_once("../private/mysql_connection.php");

// Get the selected staff ID from POST request
$selectedStaffId = $_POST['staff_id'];

// Query selected staff
$sql = "SELECT position_id, position_name, hourly_rate, overtime_rate FROM position WHERE staff_id = " . $selectedStaffId;
$result = $conn->query($sql);

// Prepare the data for JSON response
$positions = array();
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$positions[] = $row;
}
}

// Close the database connection
$conn->close();

// Return positions as a JSON response
header('Content-Type: application/json');
echo json_encode($positions);
?>