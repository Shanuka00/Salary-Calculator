<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Rates</title>
    <link rel="stylesheet" href="Styles/employees.css">
</head>

<body>

    <div class="headerT">
        <h2 class="topic">Calculate Salary</h2>
        <button class="dash" id="dashboard_button">Dashboard</button>
    </div>

    <br><br><br>
    <form action="Middleware/updateRates.php" method="post">
        <label>Lower Salary Value : </label>
        <input type="number" step="0.01" min="0" max="99999999.99" name="lowervalue" id="l_val" />
        <label>Upper Salary Value : </label>
        <input type="number" step="0.01" min="0" max="99999999.99" name="uppervalue" id="u_val" />
        <label>Tax Rate : </label>
        <input type="number" step="0.01" min="0" max="999.99" name="taxrate" id="tax" />
        <label>%</label>
        <input type="submit" name="add_record" value="Add/Update Range" />
        <input type="submit" name="delete_record" value="Delete Range" />
        <input type="reset" />
    </form>
    <br><br>

    <?php 
      include_once 'Functions/functions.php';
      echo showTaxRates();   
    ?>


    <script>
    // Function to handle row click
    function handleRowClick(row) {
        // Extract cell values from the clicked row
        var lowerValue = row.cells[1].innerText;
        var upperValue = row.cells[2].innerText;
        var taxRate = row.cells[3].innerText;

        // Combine values into a string and set it to the textbox
        document.getElementById('l_val').value = lowerValue;
        document.getElementById('u_val').value = upperValue;
        document.getElementById('tax').value = taxRate;
    }

    // Attach click event listeners to each row
    var tableRows = document.querySelectorAll('table tr');
    tableRows.forEach(function(row) {
        row.addEventListener('click', function() {
            handleRowClick(this);
        });
    });
    </script>

    <script>
        document.getElementById('dashboard_button').addEventListener('click', function() {
        window.location.href = 'dashboard.php';
        });
    </script>

</body>

</html>