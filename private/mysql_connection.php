<?php
$servername = "localhost:3306";
$username = "admin";
$password = "Admin123$$";
$dbname = "edit_ticket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>