<!DOCTYPE html>
<html>

<head>
    <title>Edit Ticket</title>
    <link href="./assets/index.css" rel="stylesheet">
    <link href="./assets/favicon.ico" rel="icon">
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

    <div class="form-container">


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
                    plugins: 'anchor autolink charmap codesample emoticons image link lists advlist media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode fullscreen preview textcolor print',
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
                        <col span="1">
                        <col span="1" style="width:15%">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:7.5%">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:7.5%">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:5%">

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
                                    <option value=""> Select Staff First..</option>
                                </select>
                            </td>
                            <td>
                                <select type="text" class="uomStaff" name="uomStaff" class="uomStaff">
                                    <option value="1"> Hourly</option>
                                    <option value="8"> Daily(8h)</option>
                                    <option value="40"> Weekly(40h)</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="regularRate" name="regularRate" step=".01" value=""
                                    disabled />
                            </td>
                            <td>
                                <input type="number" class="regularHours" value=0.00 step=".01" />
                            </td>
                            <td>
                                <input type="number" class="overtimeRate" name="overtimeRate" value=0.00 step=".01"
                                    disabled />
                            </td>
                            <td>
                                <input type="number" class="overtimeHours" value=0.00 step=".01" />
                            </td>
                            <td>
                                <input type="number" class="total rowTotal" value="0.00" step=".01" disabled />
                            </td>
                            <td>
                                <button class="addRow addLabourRow">+</button>
                                <button class="removeRow">x</button>
                            </td>

                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="1"><label for="labourSubtotal">Sub-Total</label></th>
                            <th colspan="4"></th>
                            <td colspan="4" class="align-right"><input type="number" id="labourSubtotal"
                                    class="sumSubTotal" step=".01" disabled /></td>
                        </tr>



                    </tfoot>
                </table>
            </div>
            <hr>
            <div class="form-section-container">
                <h2>Truck</h2>

                <table>
                    <colgroup>

                        <col span="1">
                        <col span="1" style="width:15%">
                        <col span="1" style="width:15%">
                        <col span="1" style="width:15%">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:5%">

                    </colgroup>
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
                                <select type="text" name="truckLabel" class="truckLabel">
                                    <option value=""> Select truck...</option>
                                    <?php
                                    // Fetch equipment names from the database
                                    $sql = "SELECT equipment_id, equipment_name, rental_rate FROM equipment"; 
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option  value="' . $row['equipment_id'] . '" data-rental-rate="'.$row['rental_rate'].'">' . $row['equipment_name'] . '</option>';
                                        }
                                    }
                                ?>

                                </select>
                            </td>
                            <td><input type="number" class="truckQty"></td>
                            <td>
                                <select type="text" name="uomTruck" class="uomTruck">
                                    <option value="1"> Hourly</option>
                                    <option value="8"> Daily(8h)</option>
                                    <option value="40"> Weekly(40h)</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="truckRate" step=".01" disabled />
                            </td>
                            <td>
                                <input type="number" class="totalTruck rowTotal" step=".01" disabled />
                            </td>
                            <td><button class="addRow">+</button>
                                <button class="removeRow">x</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="1"><label for="truckSubtotal">Sub-Total</label></th>
                            <th colspan="2"></th>
                            <th colspan="4" class="align-right"><input type="number" id="truckSubtotal"
                                    class="sumSubTotal" step=".01" disabled /></th>
                        </tr>

                    </tfoot>
                </table>

            </div>
            <hr>

            <div class="form-section-container">
                <h2>Miscellaneous</h2>

                <table id="miscTable">
                    <colgroup>

                        <col span="1">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:10%">
                        <col span="1" style="width:5%">

                    </colgroup>
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
                            <td><input type="text" name="miscDescription" id="miscDescription" /></td>
                            <td><input type="number" class="miscCost" step=".01" /></td>
                            <td><input type="number" class="miscPrice" step=".01" /></td>
                            <td><input type="number" class="miscQty" step=".01" /></td>
                            <td><input type="number" class="miscTotal rowTotal" step=".01" disabled /></td>
                            <td>
                                <button class="addRow">+</button>
                                <button class="removeRow">x</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="1"><label for="miscSubtotal">Sub-Total</label></th>
                            <th colspan="1"></th>
                            <th colspan="4" class="align-right"><input type="number" id="miscSubtotal"
                                    class="sumSubTotal" step=".01" disabled /></th>

                        </tr>

                    </tfoot>
                </table>
            </div>
            <hr>

            <div class="form-footer-container">
                <div class="form-group-total">
                    <label for="formTotal">Total: </label>
                    <input type="number" class="formTotal" value="0.00" />
                </div>
                <input type="submit" class="submitBtn" value="Finish">
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

        // Add a new row to table
        $(document).on('click', '.addRow', function(event) {
            event.preventDefault();
            var newRow = $(this).closest('table tbody').find("tr:last").clone();
            $(this).closest('table tbody').append(newRow);
            newRow.find('input').val("")
            newRow.find('select').trigger('change')
        });

        // Remove a row from the table
        $(document).on('click', '.removeRow', function(event) {
            event.preventDefault();
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
                            '<option data-something="hi" value="' + positions
                            .position_id + '" data-regular-rate="' + positions
                            .hourly_rate + '" data-overtime-rate="' +
                            positions.overtime_rate + '">' + positions
                            .position_name +
                            '</option>');
                    });
                }, 'json');
            } else {
                targetPositionId.empty();
                targetPositionId.append(
                    '<option value="">Select staff first...</option>');
            }

        });

        //populates rates based on positions selection
        $(document).on('change', '.position', function() {
            var selectedPositionOption = $(this).find('option:selected')
            const regularRate = selectedPositionOption.data("regular-rate")
            const overtimeRate = selectedPositionOption.data("overtime-rate")
            const targetRegId = $(this).closest("tr").find('.regularRate')
            const targetOverId = $(this).closest("tr").find('.overtimeRate')

            targetRegId.val(parseFloat(regularRate).toFixed(2))
            targetOverId.val(parseFloat(overtimeRate).toFixed(2))

        });

        //populates equipment rates based on truck selection
        $(document).on('change', '.truckLabel', function() {
            var selectedPositionOption = $(this).find('option:selected')
            const regularRate = selectedPositionOption.data("rental-rate")
            const targetRegId = $(this).closest("tr").find('.truckRate')
            targetRegId.val(parseFloat(regularRate).toFixed(2))
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
            const uomStaff = parseInt(row.find('.uomStaff').val()) || 1
            const regularRate = parseFloat(row.find('.regularRate').val()) || 0;
            const regularHours = parseFloat(row.find('.regularHours').val()) || 0;
            const overtimeRate = parseFloat(row.find('.overtimeRate').val()) || 0;
            const overtimeHours = parseFloat(row.find('.overtimeHours').val()) || 0;

            const total = (regularRate * regularHours * uomStaff) + (overtimeRate * overtimeHours * uomStaff);

            // Update the Total input field
            row.find('.total').val(total.toFixed(2)); // Assuming 2 decimal places
        }

        // calculate the truck row total based on qty,rate and UOM
        function calculateTruckTotal(row) {
            const uomTruck = parseInt(row.find('.uomTruck').val()) || 1
            const truckRate = parseFloat(row.find('.truckRate').val()) || 0;
            const truckQty = parseFloat(row.find('.truckQty').val()) || 0;

            const total = (truckRate * truckQty * uomTruck)

            // Update the Total input field
            row.find('.totalTruck').val(total.toFixed(2)); // Assuming 2 decimal places
        }

        // calculate the truck row total based on qty,rate and UOM
        function calculateMiscTotal(row) {
            const miscPrice = parseFloat(row.find('.miscPrice').val()) || 0;
            const miscQty = parseFloat(row.find('.miscQty').val()) || 0;
            const total = (miscQty * miscPrice);

            // Update the Total input field
            row.find('.miscTotal').val(total.toFixed(2)); // Assuming 2 decimal places
        }

        // on input change calculate new labour total
        $(document).on('change', 'table tr input, table tr select', function() {
            const row = $(this).closest('tr');
            const firstColName = row.find('select, input').first().attr('name')
            console.log("input change", firstColName)
            if (firstColName == "staff") {
                calculateLabourTotal(row);
            }
            if (firstColName == "truckLabel") {
                calculateTruckTotal(row)
            }
            if (firstColName == "miscDescription") {
                calculateMiscTotal(row)
            }

        });

        //round all number input to 2 digits
        $(document).on('change', 'input[type=number]', function() {
            $(this).val(parseFloat($(this).val()).toFixed(2) || 0.00)
        });

        //get sub totals
        $(document).on('change', 'table input, table select', function() {
            const tableBody = $(this).closest("tbody")
            let subtotal = 0
            tableBody.find("tr").each(function() {
                subtotal += parseFloat($(this).find(".rowTotal").val())

            })
            const subtotalTargetId = $(this).closest('table').find('.sumSubTotal');
            console.log("sub", subtotalTargetId)
            subtotalTargetId.val(subtotal.toFixed(2))
        });

    });
    </script>
</body>

</html>