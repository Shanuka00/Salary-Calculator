<?php

include_once '../Functions/functions.php';

if (isset($_POST['set_id_button'])) {
    // Get the selected employee role
    $employee_role = $_POST['employee_role'];

    // Map employee roles to their corresponding prefixes
    $roleToPrefix = [
        'manager' => 'PRM',
        'supervisor' => 'SUP',
        'maintenance' => 'MTE',
        'quality' => 'QAC',
        'sewing' => 'SEW',
        'finishing' => 'FIN',
        'packaging' => 'PAC'
    ];

    // Get the prefix for the selected role
    $prefix = $roleToPrefix[$employee_role];

    // Generate the initial employee ID
    $employee_id = $prefix . '1';

    // Connect to the database
    $conn = dbConn();

    // Check if connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to check for existing IDs
    $query = "SELECT emp_id FROM employee WHERE emp_id LIKE ?";

    $stmt = $conn->prepare($query);

    // Define the pattern for the given prefix
    $pattern = $prefix . '%';
    $stmt->bind_param("s", $pattern);

    // Execute the statement
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($existing_id);

    // Fetch the result
    $existing_ids = [];
    while ($stmt->fetch()) {
        $existing_ids[] = $existing_id;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Find the next available ID
    $count = 1;
    while (in_array($employee_id, $existing_ids)) {
        $count++;
        $employee_id = $prefix . $count;
    }

    // Return the employee ID as response
    echo $employee_id;
}

?>