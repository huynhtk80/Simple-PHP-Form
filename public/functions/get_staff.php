<?php
                                    require_once("../private/mysql_connection.php");
                                    // Fetch staff names from the database
                                    $sql = "SELECT staff_id, staff_name FROM staff"; // Replace 'staff_table' with the actual table name
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option  value="' . $row['staff_id'] . '">' . $row['staff_name'] . '</option>';
                                        }
                                    }

                                ?>