<?php
// Include the functions file
include_once '../Functions/functions.php';

// Check if emp_id is set
if (isset($_POST['emp_id'])) {
    // Get emp_id from the POST data
    $emp_id = $_POST['emp_id'];
    
    // Fetch employee details from the database based on emp_id
    $conn = dbConn();
    $query = "SELECT * FROM employee WHERE emp_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if employee exists
    if ($result->num_rows > 0) {
        // Fetch employee data
        $employee = $result->fetch_assoc();
        
        // Close the statement
        $stmt->close();
    } else {
        // Employee not found, handle error or redirect
        // For now, I'll redirect back to the employees.php page
        header("Location: ../employees.php");
        exit();
    }
} else {
    // emp_id is not set, handle error or redirect
    // For now, I'll redirect back to the employees.php page
    header("Location: ../employees.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add/Update Employee</title>
    <link rel="stylesheet" href="../Styles/employees.css">
</head>
<body>

<h2><u>Update Employee</u></h2>

<form action="update_employee.php" method="post">
    <div class="container">
        <div class="input-group">
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" value="<?php echo $employee['emp_id']; ?>" readonly>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" value="<?php echo $employee['email']; ?>">
        </div>

        <div class="input-group">
            <label for="first_name">First name:</label>
            <input type="text" id="first_name" name="first_name" pattern="[A-Za-z]+" title="Please enter a valid first name (only letters)" value="<?php echo $employee['f_name']; ?>" required>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="last_name">Last name:</label>
            <input type="text" id="last_name" name="last_name" pattern="[A-Za-z]+" title="Please enter a valid first name (only letters)" value="<?php echo $employee['l_name']; ?>">
        </div>

        <div class="input-group">
            <label for="phone_number">Phone number:</label>
            <input type="text" id="phone_number" name="phone_number" pattern="\d{10}" title="Please enter a valid phone number (should be 10 digits)" value="<?php echo $employee['phone']; ?>" required>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="gross_salary">Gross salary:</label>
            <input type="text" id="gross_salary" name="gross_salary" pattern="\d+" title="Please enter a valid gross salary (positive integer)" value="<?php echo $employee['gross_sal']; ?>" required >
        </div>

        <div class="input-save">
            <button type="submit" id="update_button">Update</button>
        </div>
    </div>
</form>

</body>
</html>