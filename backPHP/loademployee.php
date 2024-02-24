<?php
// Include the functions file
include_once 'Functions/functions.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add/Update Employee</title>
    <link rel="stylesheet" href="Styles/employees.css">
</head>
<body>

<?php

// Include the functions file
include_once 'Functions/functions.php';

// Fetch data from the database
$conn = dbConn();
$query = "SELECT emp_id, email, f_name, l_name, phone, role, gross_sal FROM employee";
$result = $conn->query($query);

// Start generating the HTML table
echo "<table border='1'>
        <tr>
            <th>Employee ID</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Role</th>
            <th>Gross Salary</th>
            <th>Actions</th>
        </tr>";

// Display data in table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['emp_id'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['f_name'] . "</td>";
        echo "<td>" . $row['l_name'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td>" . $row['gross_sal'] . "</td>";
        // Add delete and update buttons
        echo "<td>";
        // Delete button with form submission
        echo "<form action='backPHP/deleteemployee.php' method='post'>";
        echo "<input type='hidden' name='emp_id' value='" . $row['emp_id'] . "'>";
        echo "<button class='delete-button' type='submit'>Delete&nbsp</button>";
        echo "</form>";
        // Update button with form submission
        echo "<form action='backPHP/updateemployee.php' method='post'>";
        echo "<input type='hidden' name='emp_id' value='" . $row['emp_id'] . "'>";
        echo "<button class='update-button' type='submit'>Update</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No data found</td></tr>";
}

// Close the database connection
$conn->close();

// Close the HTML table
echo "</table>";

?>