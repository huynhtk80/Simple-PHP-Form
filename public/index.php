<!DOCTYPE html>
<html>

<head>
    <title>Edit Ticket</title>
    <link rel="stylesheet" href="./assets/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/qoevcjkx2rtw4bgxm09619mnpdystv5fiaexxxybxx9hl2mn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="https://cdn.tiny.cloud/1/qoevcjkx2rtw4bgxm09619mnpdystv5fiaexxxybxx9hl2mn/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body onload="document.ticketForm.reset();">


    <?php include("../private/mysql_connection.php")?>

    <div class="header">
        <h1>Edit Ticket</h1>
    </div>

    <div>


        <form id="ticketForm" name="ticketForm">
            <div class="form-section-container">
                <h2>Project</h2>
                <div class="form-column-container">
                    <div class="form-column">
                        <div class="form-group-h">
                            <label for="customerName">Customer Name:</label>
                            <select type="text" name="customerName" id="customerName">
                                <option value=""> choose</option>
                                <?php
                                    // Fetch customer names from the database
                                    $sql = "SELECT customer_id, customer_name FROM customer"; // Replace 'customer_table' with the actual table name
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option  value="' . $row['customer_id'] . '">' . $row['customer_name'] . '</option>';
                                        }
                                    }
                                ?>
                            </select>

                        </div>
                        <div class="form-group-h">
                            <label for="jobName">Job Name:</label>
                            <select type="text" name="jobName" id="jobName">
                                <option value=""> choose</option>

                            </select>
                        </div>
                        <div class="form-group-h">
                            <label for="status">Status:</label>
                            <select name="status" id="status">
                                <option value=""> choose</option>
                                <option value=""> Pending Approval</option>
                                <option value=""> Active</option>
                                <option value=""> Completed</option>
                            </select>
                        </div>

                        <div class="form-group-h">
                            <label for="location">Location/LSD:</label>
                            <select name="location" id="location">
                                <option value=""> Select LSD...</option>
                                <option value=""> Pending Approval</option>
                                <option value=""> Active</option>
                                <option value=""> Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <div class="form-group-h">
                            <label for="orderedBy">Ordered By:</label>
                            <input type="text" name="orderedBy" id="orderedBy" />
                        </div>

                        <div class="form-group-h">
                            <label for="ticketDate">Date:</label>
                            <input type="date" name="ticketDate" id="ticketDate" />
                        </div>

                        <div class="form-group-h">
                            <label for="area">Area/Field:</label>
                            <input type="text" name="area" id="area" />
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            </hr>
            <div class="form-section-container">
                <h2>Description of Work</h2>
                <label for="workDesc">Description:</label>
                <textarea name="workDesc" id="workDesc">

            </textarea>
                <script>
                tinymce.init({
                    selector: 'textarea',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists advlist media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tableofcontents footnotes mergetags autocorrect typography inlinecss fullscreen preview textcolor print',
                    toolbar: 'fullscreen | undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor',
                    elementpath: false
                });
                </script>
            </div>
            <hr>
            </hr>
            <div class="form-section-container">
                <h2>Labour</h2>

                <table id="labourTable">
                    <colgroup>
                        <col span="1" style="width:15%">
                        <col span="1" style="width:15%">
                        <col span="1" style="width:15%">
                        <col span="1" style="width:15%">
                        <col span="1" style="width:5%">
                        <col span="1" style="width:15%">
                        <col span="1" style="width:5%">
                        <col span="1" style="width:5%">
                        <col span="1" style="width:3%">

                    </colgroup>
                    <thead>
                        <tr>
                            <th>Staff</th>
                            <th>Position</th>
                            <th>UOM</th>
                            <th>Regular Rate</th>
                            <th>Reg Hours</th>
                            <th>Overtime Rate</th>
                            <th>Overtime</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select type="text" name="staff" class="staff">
                                    <option value="">Select Staff...</option>
                                    <?php
                                    // Fetch staff names from the database
                                    $sql = "SELECT staff_id, staff_name FROM staff"; // Replace 'staff_table' with the actual table name
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option  value="' . $row['staff_id'] . '">' . $row['staff_name'] . '</option>';
                                        }
                                    }
                                ?>
                                </select>
                            </td>
                            <td>
                                <select type="text" name="position" class="position">
                                    <option value=""> choose</option>
                                    <option value=""> Pending Approval</option>
                                    <option value=""> Active</option>
                                    <option value=""> Completed</option>
                                </select>
                            </td>
                            <td>
                                <select type="text" name="uomStaff" class="uomStaff">
                                    <option value=""> choose</option>
                                    <option value=""> Pending Approval</option>
                                    <option value=""> Active</option>
                                    <option value=""> Completed</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="regularRate" name="regularRate" step=".01" value=""
                                    disabled />
                            </td>
                            <td>
                                <input type="number" class="regularHours" value="" step=".01" />
                            </td>
                            <td>
                                <input type="number" class="overtimeRate" name="overtimeRate" value="" step=".01"
                                    disabled />
                            </td>
                            <td>
                                <input type="number" class="overtimeHours" value="" step=".01" />
                            </td>
                            <td>
                                <input type="number" class="total" value="" step=".01" />
                            </td>
                            <td>
                                <button class="addRow addLabourRow">+</button>
                                <button class="removeRow">x</button>
                            </td>

                        </tr>
                    </tbody>
                </table>


                <label for="labourSubtotal">Sub-Total</label>
                <input type="number" id="labourSubtotal" step=".01" disabled />
            </div>
            <hr>
            <div class="form-section-container">
                <h2>Truck</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>Qty</th>
                            <th>UOM</th>
                            <th>Rate($)</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
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
                                <input type="number" id="truckRate" step=".01" disabled />
                            </td>
                            <td>
                                <input type="number" id="truckTotal" step=".01" disabled />
                            </td>
                            <td><button class="addRow">+</button>
                                <button class="removeRow">x</button>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <label for="labourSubtotal">Sub-Total</label>
                <input type="number" id="labourSubtotal" step=".01" disabled />
            </div>
            <hr>

            <div class="form-section-container">
                <h2>Miscellaneous</h2>

                <table id="miscTable">

                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" id="miscDescription" /></td>
                            <td><input type="number" id="miscCost" step=".01" /></td>
                            <td><input type="number" id="miscPrice" step=".01" /></td>
                            <td><input type="number" id="miscQty" step=".01" /></td>
                            <td><input type="number" id="miscTotal" step=".01" disabled /></td>
                            <td>
                                <button id="addRow" class="addRow">+</button>
                                <button class="removeRow">x</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <label for="miscSubtotal">Sub-Total</label>
                <input type="number" id="miscSubtotal" step=".01" disabled />

                <hr>
                <input type="submit" value="Finish">
            </div>
        </form>
    </div>


    <script>
    // jQuery function to handle form submission
    $('#ticketForm').submit(function(e) {
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        $.post('save_entry.php', {
            name: name,
            email: email
        }, function(data) {
            if (data.success) {
                $('#entriesList').append('<li>' + name + ' - ' + email + '</li>');
                $('#name, #email').val('');
            }
        }, 'json');
    });

    // jQuery function to load entries on page load
    $(document).ready(function() {


        // Update the regular rate when the staff position changes
        $(document).on('change', 'select[name="staff"]', function() {
            var regularRateInput = $(this).closest("tr").find('input[name="regularRate"');
            var overtimeRateInput = $(this).closest("tr").find('input[name="overtimeRate"');
            console.log(regularRateInput)
            regularRateInput.val(10).trigger("change")
            overtimeRateInput.val(15).trigger('change')
        });

        // Add a new row to table
        $(document).on('click', '.addRow', function() {
            var newRow = $(this).closest('table').find("tr:last").clone();
            $(this).closest('table').find('tbody').append(newRow);
            newRow.find('input').val("")
        });

        // Remove a row from the table
        $(document).on('click', '.removeRow', function() {
            var tableId = $(this).closest('table').attr('id');

            if ($('#' + tableId + ' tbody tr').length > 1) {
                if (confirm('Are you sure you want to remove this row?')) {
                    $(this).closest('tr').remove();
                }
            } else {
                alert("You cannot remove the last row.");
            }

        });

        //populates positions based on staff selection
        $(document).on('change', '.staff', function() {
            var selectedStaffId = $(this).val();
            const targetPositionId = $(this).closest("tr").find('.position')

            if (!selectedStaffId == "") {
                $.post('get_positions.php', {
                    staff_id: selectedStaffId
                }, function(data) {
                    // Clear existing options in the job dropdown
                    targetPositionId.empty();
                    targetPositionId.append(
                        '<option value="">Select job...</option>');
                    console.log("data: ", data)

                    // Populate the job dropdown options
                    $.each(data, function(index, positions) {
                        console.log(positions)
                        targetPositionId.append(
                            '<option value="' + positions
                            .position_id + '">' + positions.position_name +
                            '</option>');
                    });
                }, 'json');
            } else {
                targetPositionId.empty();
                targetPositionId.append(
                    '<option value="">Select staff first...</option>');
            }

        });

        // populate job option onchange of customer
        $('#customerName').on('change', function() {
            var selectedCustomerId = $(this).val();


            // Get the job associated with the selected customer
            if (!selectedCustomerId == "") {
                $.post('get_jobs.php', {
                    customer_id: selectedCustomerId
                }, function(data) {
                    // Clear existing options in the job dropdown
                    $('#jobName').empty();
                    $('#jobName').append('<option value="">Select job...</option>');
                    console.log(data)

                    // Populate the job dropdown options
                    $.each(data, function(index, jobs) {
                        $('#jobName').append('<option value="' + jobs
                            .job_id + '">' + jobs.job_name + '</option>');
                    });
                }, 'json');
            } else {
                $('#jobName').empty();
                $('#jobName').append('<option value="">Select customer first...</option>');
            }

        })

        // calculate the total based on regular rate and hours, and overtime rate and hours
        function calculateLabourTotal(row) {
            var regularRate = parseFloat(row.find('.regularRate').val()) || 0;
            var regularHours = parseFloat(row.find('.regularHours').val()) || 0;
            var overtimeRate = parseFloat(row.find('.overtimeRate').val()) || 0;
            var overtimeHours = parseFloat(row.find('.overtimeHours').val()) || 0;

            var total = (regularRate * regularHours) + (overtimeRate * overtimeHours);

            // Update the Total input field
            row.find('.total').val(total.toFixed(2)); // Assuming 2 decimal places
        }

        // on input change calculate new labour total
        $('#labourTable').on('change', 'input', function() {
            var row = $(this).closest('tr');
            calculateLabourTotal(row);
        });

    });
    </script>
</body>

</html>