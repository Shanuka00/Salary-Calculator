<?php

include_once '../Functions/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the form
    $employee_id = $_POST['employee_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone_number'];
    $role = $_POST['employee_role'];
    $gross_salary = $_POST['gross_salary'];

    // Validate the data (you can add validation logic here)

    // Insert data into the database
    $conn = dbConn();

    // Check if connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $query = "INSERT INTO employee (emp_id, email, f_name, l_name, phone, role, gross_sal) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssd", $employee_id, $email, $first_name, $last_name, $phone, $role, $gross_salary);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the employees.php page after successful add
        header("Location: ../employees.php");
        echo "<script>alert('New employee details added successfully!');</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}


?>