<?php

// Include the functions file
include_once '../Functions/functions.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the employee ID and other details from the form
    $emp_id = $_POST['employee_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $gross_salary = $_POST['gross_salary'];

    // Validate the data (you can add validation if needed)

    // Update the employee details in the database
    $conn = dbConn();
    $query = "UPDATE employee SET email=?, f_name=?, l_name=?, phone=?, gross_sal=? WHERE emp_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $email, $first_name, $last_name, $phone_number, $gross_salary, $emp_id);

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect back to the employees.php page after successful update
        header("Location: ../employees.php");
        exit;
    } else {
        // Handle update failure
        echo "Error updating employee details: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted via POST, redirect back to the form page
    header("Location: ../employees.php");
    exit;
}

?>