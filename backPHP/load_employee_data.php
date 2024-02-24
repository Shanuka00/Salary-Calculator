<?php
// Include the functions file
include_once '../Functions/functions.php';

// Check if the emp_id is set in the POST request
if (isset($_POST['emp_id'])) {
    // Get the employee ID from the POST data
    $emp_id = $_POST['emp_id'];

    // Connect to the database
    $conn = dbConn();

    // Prepare and execute the query to fetch employee data
    $query = "SELECT * FROM employee WHERE emp_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the data
    $employee = $result->fetch_assoc();

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();

    // Output the fetched data as JSON
    echo json_encode($employee);
} else {
    // If emp_id is not set in the POST request, return error message
    echo json_encode(array("status" => "error", "message" => "Employee ID not provided."));
}
?>