<!DOCTYPE html>
<html>
<head>
    <title>Edit Ticket</title>
    <link rel="stylesheet" href="./assets/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/qoevcjkx2rtw4bgxm09619mnpdystv5fiaexxxybxx9hl2mn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="https://cdn.tiny.cloud/1/qoevcjkx2rtw4bgxm09619mnpdystv5fiaexxxybxx9hl2mn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

<?php include("../private/init_dotenv.php")?>
<?php include("../private/mysql_connection.php")?>

<h1>Edit Ticket</h1>
    
    <div>
        <h2>Project:</h2>
        <form id="ticketForm">
            <label for="customerName">Customer Name:</label>
            <select type="text" name="customerName" id="customerName">
                <option value=""> choose</option>
                <?php
                    // Fetch customer names from the database
                    $sql = "SELECT staff_name, position name FROM staff"; // Replace 'customer_table' with the actual table name
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                         while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['staff_name'] . '">' . $row['staff_name'] . '</option>';
                        }
                    }
                ?>
            </select>

            <label for="jobName">Job Name:</label>
            <select type="text" name="jobName" id="jobName">
                <option value=""> choose</option>
            </select>

            <label for="status">Status:</label>
            <select type="text" name="status" id="status">
                <option value=""> choose</option>
                <option value=""> Pending Approval</option>
                <option value=""> Active</option>
                <option value=""> Completed</option>
            </select>

            <label for="location">Location/LSD:</label>
            <select type="text" name="location" id="location">
                <option value=""> Select LSD...</option>
                <option value=""> Pending Approval</option>
                <option value=""> Active</option>
                <option value=""> Completed</option>
            </select>

            <label for="orderedBy">Ordered By:
            <input type="text" name="orderedBy" id="orderedBy"/>

            <label for="ticketDate">Date:</label>
            <input type="date" name="ticketDate" id="ticketDate"/>

            <hr></hr>
            <h2>Description of Work</h2>
            <textarea name="workDesc" id="workDesc">
                 Welcome to TinyMCE!
            </textarea>
            <script>
                tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists advlist media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tableofcontents footnotes mergetags autocorrect typography inlinecss fullscreen preview textcolor print',
                toolbar: 'fullscreen | undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor',
                elementpath: false
                });
            </script>

            <hr></hr>
            <h2>Labour</h2>

            <table>
                <tr>
                    <th>Staff</th>
                    <th>Position</th>
                    <th>UOM</th>
                    <th>Regular Rate</th>
                    <th>Reg Hours</th>
                    <th>Overtime Rate</th>
                    <th>Overtime</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <select type="text" name="staff" id="staff">
                <option value=""> choose</option>
                <option value=""> Pending Approval</option>
                <option value=""> Active</option>
                <option value=""> Completed</option>
            </select>
        </td>
                    <td>
                    <select type="text" name="position" id="position">
                <option value=""> choose</option>
                <option value=""> Pending Approval</option>
                <option value=""> Active</option>
                <option value=""> Completed</option>
            </select>
                    </td>
                    <td>
                    <select type="text" name="uomStaff" id="uomStaff">
                <option value=""> choose</option>
                <option value=""> Pending Approval</option>
                <option value=""> Active</option>
                <option value=""> Completed</option>
            </select>
                    </td>
                    <td>
                    <input type="number" id="regularRate" step=".01" disabled/>
                    </td>
                    <td>
                    <input type="number" id="regularHours" step=".01"/>
                    </td>
                    <td>
                    <input type="number" id="overtimeRate" step=".01" disabled/>
                    </td>
                    <td>
                    <input type="number" id="overtimeHours" step=".01"/>
                    <td>
                    <button class="addRowButt">+</button>
            <button class="removeRowButt">x</button>
                    </td>
                    
                </tr>
            </table>
          
            
            <label for="labourSubtotal">Sub-Total</label>
            <input type="number" id="labourSubtotal" step=".01" disabled/>

            <hr>
            <h2>Truck</h2>

            <table>
                <tr>
                    <th>Label</th>
                    <th>Qty</th>
                    <th>UOM</th>
                    <th>Rate($)</th>
                    <th>Total</th>
                    <th></th>
                                </tr>
                <tr>
                    <td> 
                        <select type="text" name="truckLabel" id="truckLabel">
                            <option value=""> choose</option>
                            <option value=""> Pending Approval</option>
                            <option value=""> Active</option>
                            <option value=""> Completed</option>
                    </select>
                </td>
                <td><input type="number" id="truckQty"></td>
                    <td>
                    <select type="text" name="uomTruck" id="uomTruck">
                <option value=""> choose</option>
                <option value=""> Pending Approval</option>
                <option value=""> Active</option>
                <option value=""> Completed</option>
            </select>
        </td>
        <td>
        <input type="number" id="truckRate" step=".01" disabled/>
        </td>
        <td>
            <input type="number" id="truckTotal" step=".01" disabled/>
        </td>
        <td><button class="addRowButt">+</button>
        <button class="removeRowButt">x</button></td>
    </tr>
            </table> 


            <label for="labourSubtotal">Sub-Total</label>
            <input type="number" id="labourSubtotal" step=".01" disabled/>
            <hr>


            <h2>Miscellaneous</h2>

            <table>
                <tr>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                <tr>
                    <td><input type="text" id="miscDescription"/></td>
                    <td><input type="number" id="miscCost" step=".01"/></td>
                    <td><input type="number" id="miscPrice" step=".01"/></td>
                    <td><input type="number" id="miscQty" step=".01"/></td>
                    <td><input type="number" id="miscTotal" step=".01" disabled/></td>
                    <td>
                    <button class="addRowButt">+</button>
        <button class="removeRowButt">x</button>
                    </td>
                </tr>
            </table>

           <label for="miscSubtotal">Sub-Total</label>
            <input type="number" id="miscSubtotal" step=".01" disabled/>
            
            <hr>
            <input type="submit" value="Finish">
        </form>
    </div>
    

    <script>
        // jQuery function to handle form submission
        $('#ticketForm').submit(function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            $.post('save_entry.php', { name: name, email: email }, function(data) {
                if (data.success) {
                    $('#entriesList').append('<li>' + name + ' - ' + email + '</li>');
                    $('#name, #email').val('');
                }
            }, 'json');
        });

        // jQuery function to load entries on page load
        $(document).ready(function() {
            $.get('get_entries.php', function(data) {
                data.entries.forEach(function(entry) {
                    $('#entriesList').append('<li>' + entry.name + ' - ' + entry.email + '</li>');
                });
            }, 'json');
        });
    </script>
</body>
</html>