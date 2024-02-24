<!DOCTYPE html>
<html>
<head>
    <title>Add/Update Employee</title>
    <link rel="stylesheet" href="Styles/employees.css">
</head>

<body>

    <div class="headerT">
        <h2 class="topic">Add/Update Employee</h2>
        <button class="dash" id="dashboard_button">Dashboard</button>
    </div>

    <form action="backPHP/addemployee.php" method="post">

    <div class="container">

        <div class="input-group">
        <label for="employee_role">Employee role:</label>
        <select id="employee_role" name="employee_role"><br>
                <option value="manager">Production Manager</option>
                <option value="supervisor">Supervisor</option>
                <option value="maintenance">Maintenance Technician</option>
                <option value="quality">Quality Controller</option>
                <option value="sewing">Sewing Machine Operator</option>
                <option value="finishing">Finishing Operator</option>
                <option value="packaging">Packaging Staff</option>
        </select>
        <button type="button" id="set_id_button" style="margin-left: 25px;" onclick="setEmployeeID()">Set ID</button>
        <br>
        </div>

        <div class="input-group">
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" readonly><br><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required><br>
            <br>
        </div>

        <div class="input-group">
            <label for="first_name">First name:</label>
            <input type="text" id="first_name" name="first_name" pattern="[A-Za-z]+" title="Please enter a valid first name (only letters)" required><br><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="last_name">Last name:</label>
            <input type="text" id="last_name" name="last_name" pattern="[A-Za-z]+" title="Please enter a valid first name (only letters)"><br>
            <br>
        </div>

        <div class="input-group">
            <label for="phone_number">Phone number:</label>
            <input type="text" id="phone_number" name="phone_number" name="phone_number" pattern="\d{10}" title="Please enter a valid phone number (should be 10 digits)" required><br><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="gross_salary">Gross salary:</label>
            <input type="text" id="gross_salary" name="gross_salary" pattern="\d+" title="Please enter a valid gross salary (positive integer)" required><br>
            <br>
        </div>

        <div class="input-save">
            <br>
            <button type="submit" id="save_button" style="float: right; margin-right: 5px;">Save</button>
            <br>
        </div>

        <div class="input-table">
            <br><br>
            <?php include_once 'backPHP/loademployee.php'; ?>
        </div>

    </div>
    
    </form>

    <script src="Scripts/employeescript.js"></script>

    <script>
        document.getElementById('dashboard_button').addEventListener('click', function() {
        window.location.href = 'dashboard.php';
        });
    </script>

    <?php
    if (isset($_SESSION['delete_message'])) {
        echo "<script>alert('" . $_SESSION['delete_message'] . "');</script>";
        unset($_SESSION['delete_message']); // Remove the message from session to prevent displaying it again on page reload
    }
    ?>
    
</body>
</html>