<!DOCTYPE html>
<html>
<head>
    <title>Salary Calculator</title>
    <link rel="stylesheet" href="Styles/employees.css">
</head>

<body>

    <div class="headerT">
        <h2 class="topic">View History</h2>
        <button class="dash" id="dashboard_button">Dashboard</button>
    </div>

    <div class="container">

        <div class="input-group">
            <label for="emp_id">Employee ID:</label>
            <input type="text" id="emp_id" name="emp_id" autocomplete="off">
            <button type="button" id="filter_button">Filter</button>
            <br>
        </div>

        <div class="input-table">
            <br><br>
            <div id="history_table"></div>
        </div>
    
    </div>

    <script>
        // Function to fetch all employees' data initially
        function fetchAllEmployees() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // If request is successful, update the history table
                        document.getElementById('history_table').innerHTML = xhr.responseText;
                    } else {
                        // If request fails, display an error message
                        document.getElementById('history_table').innerHTML = "Enter employee ID and filter to view payment history";
                    }
                }
            };
            xhr.open('POST', 'backPHP/filtered.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(); // No parameters needed for fetching all employees
        }

        // Fetch all employees' data initially when the page loads
        window.onload = fetchAllEmployees;

        // Event listener for the Filter button
        document.getElementById('filter_button').addEventListener('click', function() {
            // Get the Employee ID from the input field
            var emp_id = document.getElementById('emp_id').value;

            // Make an AJAX request to filtered.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // If request is successful, update the history table
                        document.getElementById('history_table').innerHTML = xhr.responseText;
                    } else {
                        // If request fails, display an error message
                        document.getElementById('history_table').innerHTML = "Failed to fetch history data.";
                    }
                }
            };
            xhr.open('POST', 'backPHP/loadhistory.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('emp_id=' + emp_id);
        });
    </script>

    <script>
        document.getElementById('dashboard_button').addEventListener('click', function() {
        window.location.href = 'dashboard.php';
        });
    </script>
    
</body>
</html>