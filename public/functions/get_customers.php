<?php
    require_once("../private/mysql_connection.php");
    // Fetch customer names from the database
    $sql = "SELECT customer_id, customer_name FROM customer"; // Replace 'customer_table' with the actual table name
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option  value="' . $row['customer_id'] . '">' . $row['customer_name'] . '</option>';
        }
    }

?>