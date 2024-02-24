<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character encoding and viewport for better rendering on various devices -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the page -->
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Internal styles -->
    <link rel="stylesheet" href="Styles/dashboard.css">
</head>

<body>
    <!-- Main container using Bootstrap -->
    <div class="container">

        <!-- Header row -->

        <div class="row justify-content-center">
            <!-- Main header with title -->
            <div class="header">        
                <h1>DASHBOARD</h1>
            </div>
        </div>

        <!-- Row for buttons -->

        <div class="row">
            <!-- Column for buttons -->
            <div class="col">
                <!-- Container for buttons -->
                <div class="btn-container">
                    <!-- Navigation Buttons -->
                    
                    <button class="btn btn-primary nav-button" onclick="window.location.href='rates.php'">Update Rates</button>
                    <button class="btn btn-primary nav-button" onclick="window.location.href='employees.php'">Add/Update Employee</button>
                    <button class="btn btn-primary nav-button" onclick="window.location.href='salary.php'">Calculate Salary</button>
                    <button class="btn btn-primary nav-button" onclick="window.location.href='history.php'">View History</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
