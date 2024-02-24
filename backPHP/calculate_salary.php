<?php
// Include the functions file and connect to the database
include_once '../Functions/functions.php';
$conn = dbConn();

// Check if gross salary and month are set in the POST request
if (isset($_POST['gross_salary']) && isset($_POST['select_month'])) {
    // Get the gross salary and month from the POST data
    $gross_salary = $_POST['gross_salary'];
    $month = $_POST['select_month'];

    // Initialize tax deduction
    $tax_deduc = 0;

    // Query to fetch tax rate based on the gross salary range
    $tax_query = "SELECT tax_rate FROM taxes WHERE lower_value <= ? AND upper_value >= ?";
    $tax_stmt = $conn->prepare($tax_query);
    $tax_stmt->bind_param("dd", $gross_salary, $gross_salary);
    $tax_stmt->execute();
    $tax_result = $tax_stmt->get_result();

    // If tax rate is found, calculate tax deduction
    if ($tax_result->num_rows > 0) {
        $tax_row = $tax_result->fetch_assoc();
        $tax_rate = $tax_row['tax_rate'];
        $tax_deduc = $gross_salary * $tax_rate / 100;
    }

    // Close tax statement
    $tax_stmt->close();

    // Output results
    echo json_encode(array(
        "gross_salary" => $gross_salary,
        "month" => $month,
        "tax_deduc" => $tax_deduc
    ));
} else {
    // If gross salary or month is not set in the POST request, return error message
    echo json_encode(array("status" => "error", "message" => "Gross salary or month not provided."));
}

// Close the database connection
$conn->close();
?>