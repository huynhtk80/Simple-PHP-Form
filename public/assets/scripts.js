$(document).ready(function () {
  // Add a new row to table
  $(document).on("click", ".addRow", function (event) {
    event.preventDefault();
    var newRow = $(this).closest("table tbody").find("tr:last").clone();
    $(this).closest("table tbody").append(newRow);
    newRow.find("input").val("");
    newRow.find("select").trigger("change");
  });

  // Remove a row from the table
  $(document).on("click", ".removeRow", function (event) {
    event.preventDefault();
    var tableId = $(this).closest("table").attr("id");

    if ($("#" + tableId + " tbody tr").length > 1) {
      if (confirm("Are you sure you want to remove this row?")) {
        $(this).closest("tr").remove();
      }
    } else {
      alert("You cannot remove the last row.");
    }
  });

  //populates positions based on staff selection
  $(document).on("change", ".staff", function () {
    var selectedStaffId = $(this).val();
    const targetPositionId = $(this).closest("tr").find(".position");

    if (!selectedStaffId == "") {
      $.post(
        "./functions/get_positions.php",
        {
          staff_id: selectedStaffId,
        },
        function (data) {
          // Clear existing options in the job dropdown
          targetPositionId.empty();
          targetPositionId.append('<option value="">Select job...</option>');

          // Populate the position dropdown options
          $.each(data, function (index, positions) {
            targetPositionId.append(
              '<option data-something="hi" value="' +
                positions.position_id +
                '" data-regular-rate="' +
                positions.hourly_rate +
                '" data-overtime-rate="' +
                positions.overtime_rate +
                '">' +
                positions.position_name +
                "</option>"
            );
          });
        },
        "json"
      );
    } else {
      targetPositionId.empty();
      targetPositionId.append(
        '<option value="">Select staff first...</option>'
      );
    }
  });

  //populates labour rates based on positions selection
  $(document).on("change", ".position", function () {
    var selectedPositionOption = $(this).find("option:selected");
    const regularRate = selectedPositionOption.data("regular-rate");
    const overtimeRate = selectedPositionOption.data("overtime-rate");
    const targetRegId = $(this).closest("tr").find(".regularRate");
    const targetOverId = $(this).closest("tr").find(".overtimeRate");

    targetRegId.val(parseFloat(regularRate).toFixed(2));
    targetOverId.val(parseFloat(overtimeRate).toFixed(2));
  });

  //populates equipment rates based on truck selection
  $(document).on("change", ".truckLabel", function () {
    var selectedPositionOption = $(this).find("option:selected");
    const regularRate = selectedPositionOption.data("rental-rate");
    const targetRegId = $(this).closest("tr").find(".truckRate");
    targetRegId.val(parseFloat(regularRate).toFixed(2));
  });

  // populate job option onchange of customer
  $("#customerName").on("change", function () {
    var selectedCustomerId = $(this).val();

    // Get the job associated with the selected customer
    if (!selectedCustomerId == "") {
      $.post(
        "./functions/get_jobs.php",
        {
          customer_id: selectedCustomerId,
        },
        function (data) {
          // Clear existing options in the job dropdown
          $("#jobName").empty();
          $("#jobName").append('<option value="">Select job...</option>');

          // Populate the job dropdown options
          $.each(data, function (index, location) {
            $("#jobName").append(
              '<option value="' +
                location.job_id +
                '">' +
                location.job_name +
                "</option>"
            );
          });
        },
        "json"
      );
    } else {
      $("#jobName").empty();
      $("#jobName").append(
        '<option value="">Select customer first...</option>'
      );
    }
  });

  // populate location option onchange of job
  $("#jobName").on("change", function () {
    var selectedJobId = $(this).val();

    // Get the job associated with the selected customer
    if (!selectedJobId == "") {
      $.post(
        "./functions/get_locations.php",
        {
          job_id: selectedJobId,
        },
        function (data) {
          // Clear existing options in the job dropdown
          $("#location").empty();
          $("#location").append('<option value="">Select location...</option>');

          // Populate the job dropdown options
          $.each(data, function (index, location) {
            $("#location").append(
              '<option value="' +
                location.location_id +
                '">' +
                location.location_name +
                "</option>"
            );
          });
        },
        "json"
      );
    } else {
      $("#jobName").empty();
      $("#jobName").append(
        '<option value="">Select customer first...</option>'
      );
    }
  });

  // calculate the total based on regular rate and hours, and overtime rate and hours
  function calculateLabourTotal(row) {
    const uomStaff = parseInt(row.find(".uomStaff").val()) || 1;
    const regularRate = parseFloat(row.find(".regularRate").val()) || 0;
    const regularHours = parseFloat(row.find(".regularHours").val()) || 0;
    const overtimeRate = parseFloat(row.find(".overtimeRate").val()) || 0;
    const overtimeHours = parseFloat(row.find(".overtimeHours").val()) || 0;

    const total =
      regularRate * regularHours * uomStaff +
      overtimeRate * overtimeHours * uomStaff;

    row.find(".total").val(total.toFixed(2));
  }

  // calculate the truck row total based on qty,rate and UOM
  function calculateTruckTotal(row) {
    const uomTruck = parseInt(row.find(".uomTruck").val()) || 1;
    const truckRate = parseFloat(row.find(".truckRate").val()) || 0;
    const truckQty = parseFloat(row.find(".truckQty").val()) || 0;

    const total = truckRate * truckQty * uomTruck;

    row.find(".totalTruck").val(total.toFixed(2));
  }

  // calculate the truck row total based on qty,rate and UOM
  function calculateMiscTotal(row) {
    const miscPrice = parseFloat(row.find(".miscPrice").val()) || 0;
    const miscQty = parseFloat(row.find(".miscQty").val()) || 0;
    const total = miscQty * miscPrice;

    row.find(".miscTotal").val(total.toFixed(2));
  }

  // on input change calculate new labour total
  $(document).on("change", "table tr input, table tr select", function () {
    const row = $(this).closest("tr");
    const firstColName = row.find("select, input").first().attr("name");

    if (firstColName == "staff[]") {
      calculateLabourTotal(row);
    }
    if (firstColName == "truckLabel[]") {
      calculateTruckTotal(row);
    }
    if (firstColName == "miscDescription[]") {
      calculateMiscTotal(row);
    }
  });

  //round all number input to 2 digits
  $(document).on("change", "input[type=number]", function () {
    $(this).val(parseFloat($(this).val()).toFixed(2) || 0.0);
  });

  // calculate the truck row total based on qty,rate and UOM
  function calculateFormTotal() {
    const subtotalsIds = $(document).find(".sumSubTotal");
    let formTotal = 0;

    subtotalsIds.each(function () {
      formTotal += parseFloat($(this).val()) || 0;
    });

    $(document).find(".formTotal").val(formTotal.toFixed(2));
  }

  //get sub totals
  $(document).on("change", "table input, table select", function () {
    const tableBody = $(this).closest("tbody");
    let subtotal = 0;
    tableBody.find("tr").each(function () {
      subtotal += parseFloat($(this).find(".rowTotal").val());
    });
    const subtotalTargetId = $(this).closest("table").find(".sumSubTotal");

    subtotalTargetId.val(subtotal.toFixed(2));
    calculateFormTotal();
  });
});
