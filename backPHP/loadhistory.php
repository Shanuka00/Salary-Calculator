<?php

// Include the functions file and connect to the database
include_once '../Functions/functions.php';
$conn = dbConn();

// Check if Employee ID is set in the POST request
if (isset($_POST['emp_id'])) {
    // Sanitize and store the Employee ID
    $emp_id = $_POST['emp_id'];

    // Query to fetch history data for the given Employee ID
    $query = "SELECT * FROM payment WHERE emp_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Start building the HTML table with CSS styling
        echo "<style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>";
        echo "<table>";
        echo "<tr><th>Employee ID</th><th>Gross Salary</th><th>Tax Deduction</th><th>Employer Contribution</th><th>Employee Contribution</th><th>ETF</th><th>Year</th><th>Month</th></tr>";

        // Loop through the rows and display each record in a table row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['emp_id'] . "</td>";
            echo "<td>" . $row['gross_sal'] . "</td>";
            echo "<td>" . $row['deduc_tax'] . "</td>";
            echo "<td>" . $row['employer_con'] . "</td>";
            echo "<td>" . $row['employee_con'] . "</td>";
            echo "<td>" . $row['etf'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['month'] . "</td>";
            echo "</tr>";
        }

        // Close the table
        echo "</table>";
    } else {
        // No rows returned, display a message
        echo "No history found for the provided Employee ID.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If Employee ID is not set, return an error message
    echo "Employee ID not provided.";
}

?>