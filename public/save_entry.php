<?php
 //connect to db
 require_once("../private/mysql_connection.php");

 // Get the form data
 $customerId = $_POST['customerName'];
 $jobId = $_POST['jobName'];
 $status = $_POST['status'];
 $locationId = $_POST['location'];
 $orderedBy = $_POST['orderedBy'];
 $ticketDate = $_POST['ticketDate'];
 $area = $_POST['area'];
 $workDesc = str_replace(['<p>', '</p>'], '',$_POST['workDesc']);
 
// Process labour data
$staffArr = $_POST['staff'];
$positionArr = $_POST['position'];
$uomStaffArr = $_POST['uomStaff'];
$regularRateArr = $_POST['regularRate'];
$regularHoursArr = $_POST['regularHours'];
$overtimeRateArr = $_POST['overtimeRate'];
$overtimeHoursArr = $_POST['overtimeHours'];

// Process truck data
$truckLabelArr = $_POST['truckLabel'];
$truckQtyArr = $_POST['truckQty'];
$uomTruckArr = $_POST['uomTruck'];
$uomTruckArr = $_POST['truckRate'];

// Process miscellaneous data
$miscDescriptionArr = $_POST['miscDescription'];
$miscCostArr = $_POST['miscCost'];
$miscPriceArr = $_POST['miscPrice'];
$miscQtyArr = $_POST['miscQty'];

// Insert data into the main ticket table
$sql = "INSERT INTO ticket (customer_id, job_id, job_status, location_id, ordered_by, ticket_date, area, work_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisissss", $customerId, $jobId, $status, $locationId, $orderedBy, $ticketDate, $area, $workDesc);
$stmt->execute();
$ticketId = $stmt->insert_id; // Get the inserted ticket ID for later use

?>