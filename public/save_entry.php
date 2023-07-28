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
$truckRate = $_POST['truckRate'];

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

// Insert labour data into the labour table
for ($i = 0; $i < count($staffArr); $i++) {
    $staff = $staffArr[$i];
    $position = $positionArr[$i];
    $uomStaff = $uomStaffArr[$i];
    $regularRate = $regularRateArr[$i];
    $regularHours = $regularHoursArr[$i];
    $overtimeRate = $overtimeRateArr[$i];
    $overtimeHours = $overtimeHoursArr[$i];

    $sql = "INSERT INTO ticket_labour (ticket_id, staff_id, position_id, uom_staff, regular_rate, regular_hours, overtime_rate, overtime_hours) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiidddd", $ticketId, $staff, $position, $uomStaff, $regularRate, $regularHours, $overtimeRate, $overtimeHours);
    $stmt->execute();
}

// Insert truck data into the truck table
for ($i = 0; $i < count($truckLabelArr); $i++) {
    $truckLabel = $truckLabelArr[$i];
    $truckQty = $truckQtyArr[$i];
    $uomTruck = $uomTruckArr[$i];
    $truckRate = $truckRate[$i];

    $sql = "INSERT INTO ticket_equipment (ticket_id, equipment_id, rental_qty, uom_truck, rental_rate) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiddd", $ticketId, $truckLabel, $truckQty, $uomTruck,$truckRate);
    $stmt->execute();
}

// Insert miscellaneous data into the miscellaneous table
for ($i = 0; $i < count($miscDescriptionArr); $i++) {
    $miscDescription = $miscDescriptionArr[$i];
    $miscCost = $miscCostArr[$i];
    $miscPrice = $miscPriceArr[$i];
    $miscQty = $miscQtyArr[$i];

    $sql = "INSERT INTO ticket_misc (ticket_id, misc_description, cost, price, quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isddd", $ticketId, $miscDescription, $miscCost, $miscPrice, $miscQty);
    $stmt->execute();
}

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Redirect to a success page or display a success message
    header("Location: success_page.php");
    exit();

?>