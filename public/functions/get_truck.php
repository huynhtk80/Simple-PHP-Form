<?php
                                    require_once("../private/mysql_connection.php");
                                    
                                   // Fetch equipment names from the database
                                    $sql = "SELECT equipment_id, equipment_name, rental_rate FROM equipment"; 
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option  value="' . $row['equipment_id'] . '" data-rental-rate="'.$row['rental_rate'].'">' . $row['equipment_name'] . '</option>';
                                        }
                                    }

                                ?>