<!DOCTYPE html>
<html>

<head>
    <title>Edit Ticket</title>
    <link href="./assets/index.css" rel="stylesheet">
    <link href="./assets/favicon.ico" rel="icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/scripts.js"></script>
    <script src="https://cdn.tiny.cloud/1/qoevcjkx2rtw4bgxm09619mnpdystv5fiaexxxybxx9hl2mn/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body onload="document.ticketForm.reset(); tinyMCE.activeEditor.setContent('');">
    <div class="header">
        <h1>Edit Ticket</h1>
    </div>

    <div class="form-container">
        <form action="./functions/save_entry.php" method="post" id="ticketForm" name="ticketForm">
            <div class="form-section-container">
                <h2>Project</h2>
                <div class="form-column-container">
                    <div class="form-column">
                        <div class="form-group-h">
                            <label for="customerName">Customer Name:</label>
                            <select type="text" name="customerName" id="customerName" required>
                                <option value=""> Select Customer...</option>
                                <?php include("./functions/get_customers.php")?>
                            </select>

                        </div>
                        <div class="form-group-h">
                            <label for="jobName">Job Name:</label>
                            <select type="text" name="jobName" id="jobName" required>
                                <option value=""> Select Customer first..</option>

                            </select>
                        </div>
                        <div class="form-group-h">
                            <label for="status">Status:</label>
                            <select name="status" id="status" required>
                                <option value=""> Select status..</option>
                                <option value="Active"> Active</option>
                                <option value="Pending"> Pending</option>
                                <option value="Invoiced"> Invoiced</option>
                                <option value="Archived"> Archived</option>
                            </select>
                        </div>

                        <div class="form-group-h">
                            <label for="location">Location/LSD:</label>
                            <select name="location" id="location" required>
                                <option value=""> Select Job First...</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <div class="form-group-h">
                            <label for="orderedBy">Ordered By:</label>
                            <input type="text" name="orderedBy" id="orderedBy" required />
                        </div>

                        <div class="form-group-h">
                            <label for="ticketDate">Date:</label>
                            <input type="date" name="ticketDate" id="ticketDate" required />
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
                    plugins: 'anchor autolink charmap codesample emoticons image link lists advlist media searchreplace table visualblocks wordcount linkchecker fullscreen preview textcolor print',
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
                                <select name="staff[]" class="staff">
                                    <option value="">Select Staff...</option>
                                    <?php include("./functions/get_staff.php")?>
                                </select>
                            </td>
                            <td>
                                <select name="position[]" class="position">
                                    <option value=""> Select Staff First..</option>

                                </select>
                            </td>
                            <td>
                                <select class="uomStaff" name="uomStaff[]" class="uomStaff">
                                    <option value="1"> Hourly</option>
                                    <option value="8"> Daily(8h)</option>
                                    <option value="40"> Weekly(40h)</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="regularRate" name="regularRate[]" step=".01" value=""
                                    readonly />
                            </td>
                            <td>
                                <input type="number" class="regularHours" name="regularHours[]" value=0.00 step=".01" />
                            </td>
                            <td>
                                <input type="number" class="overtimeRate" name="overtimeRate[]" value=0.00 step=".01"
                                    readonly />
                            </td>
                            <td>
                                <input type="number" class="overtimeHours" name="overtimeHours[]" value=0.00
                                    step=".01" />
                            </td>
                            <td>
                                <input type="number" class="total rowTotal" name='labourRowTotal[]' value="0.00"
                                    step=".01" readonly />
                            </td>
                            <td>
                                <button class="addRow">+</button>
                                <button class="removeRow">x</button>
                            </td>

                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="1"><label for="labourSubtotal">Sub-Total</label></th>
                            <th colspan="4"></th>
                            <td colspan="4" class="align-right"><input type="number" name="labourSubtotal"
                                    id="labourSubtotal" class="sumSubTotal" step=".01" readonly /></td>
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
                                <select type="text" name="truckLabel[]" class="truckLabel">
                                    <option value=""> Select truck...</option>
                                    <?php include("./functions/get_truck.php")?>
                                </select>
                            </td>
                            <td><input type="number" class="truckQty" name="truckQty[]"></td>
                            <td>
                                <select type="text" name="uomTruck[]" class="uomTruck">
                                    <option value="1"> Hourly</option>
                                    <option value="8"> Daily(8h)</option>
                                    <option value="40"> Weekly(40h)</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="truckRate" name="truckRate[]" step=".01" readonly />
                            </td>
                            <td>
                                <input type="number" class="totalTruck rowTotal" name="truckRowTotal[]" step=".01"
                                    readonly />
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
                                    class="sumSubTotal" step=".01" readonly /></th>
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
                            <td><input type="text" name="miscDescription[]" id="miscDescription" /></td>
                            <td><input type="number" class="miscCost" name="miscCost[]" step=".01" /></td>
                            <td><input type="number" class="miscPrice" name="miscPrice[]" step=".01" /></td>
                            <td><input type="number" class="miscQty" name='miscQty[]' step=".01" /></td>
                            <td><input type="number" class="miscTotal rowTotal" name="miscRowTotal[]" step=".01"
                                    readonly /></td>
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
                                    class="sumSubTotal" name="miscSubtotal" step=".01" readonly /></th>

                        </tr>

                    </tfoot>
                </table>
            </div>
            <hr>

            <div class="form-footer-container">
                <div class="form-group-total">
                    <label for="formTotal">Total: </label>
                    <input type="number" class="formTotal" step=".01" value="0.00" />
                </div>
                <input type="submit" class="submitBtn" value="Finish">
            </div>
        </form>
    </div>


</body>

</html>