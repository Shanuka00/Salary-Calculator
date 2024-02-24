<?php

// Include the functions file
include_once '../Functions/functions.php';

// Check if the emp_id is set in the POST request
if (isset($_POST['emp_id'])) {
    // Get the employee ID from the POST data
    $emp_id = $_POST['emp_id'];

    // Connect to the database
    $conn = dbConn();

    // Prepare and execute the delete query
    $query = "DELETE FROM employee WHERE emp_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emp_id);

    // If deletion is successful, return success message
    if ($stmt->execute()) {
        session_start();
        $_SESSION['delete_message'] = "Employee deleted successfully!";
        header("Location: ../employees.php");
        exit;
    } else {
        // If deletion fails, return error message
        echo json_encode(array("status" => "error", "message" => "Failed to delete employee."));
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If emp_id is not set in the POST request, return error message
    echo json_encode(array("status" => "error", "message" => "Employee ID not provided."));
}

?>