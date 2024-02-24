<?php
// Include the functions file and connect to the database
include_once '../Functions/functions.php';
$conn = dbConn();

// Check if all required fields are set in the POST request
if (
    isset($_POST['emp_id']) &&
    isset($_POST['gross_salary']) &&
    isset($_POST['tax_deduc']) &&
    isset($_POST['employer_con']) &&
    isset($_POST['employee_con']) &&
    isset($_POST['etf_deduc']) &&
    isset($_POST['year']) &&
    isset($_POST['month'])
) {
    // Get the values from the POST data
    $emp_id = $_POST['emp_id'];
    $gross_salary = $_POST['gross_salary'];
    $tax_deduc = $_POST['tax_deduc'];
    $employer_con = $_POST['employer_con'];
    $employee_con = $_POST['employee_con'];
    $etf_deduc = $_POST['etf_deduc'];
    $year = $_POST['year'];
    $month = $_POST['month'];

    // Check if a record already exists for the employee, month, and year combination
    $check_query = "SELECT * FROM payment WHERE emp_id = ? AND month = ? AND year = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ssi", $emp_id, $month, $year);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows == 0) {
        // No existing record, insert a new payment record
        $insert_query = "INSERT INTO payment (emp_id, gross_sal, deduc_tax, employer_con, employee_con, etf, year, month) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("sdddddds", $emp_id, $gross_salary, $tax_deduc, $employer_con, $employee_con, $etf_deduc, $year, $month);
        if ($insert_stmt->execute()) {
            // Payment record inserted successfully
            http_response_code(200); // OK
        } else {
            // Failed to insert payment record
            http_response_code(500); // Internal Server Error
        }
    } else {
        // Record already exists for the employee, month, and year combination
        http_response_code(409); // Conflict
    }

    // Close the database connections
    $check_stmt->close();
    $insert_stmt->close();
    $conn->close();
} else {
    // Required fields not set in the POST request
    http_response_code(400); // Bad Request
}
?>