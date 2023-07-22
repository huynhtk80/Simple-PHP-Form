<!DOCTYPE html>
<html>
<head>
    <title>Edit Ticket</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <label for="email">Email:</label>
            <select type="text" name="customerName" id="customerName">
            <input type="submit" value="Add Entry">
        </form>
    </div>
    
    <div>
        <h2>Entries:</h2>
        <ul id="entriesList"></ul>
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