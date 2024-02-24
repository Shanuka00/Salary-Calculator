<!DOCTYPE html>
<html>
<head>
    <title>Salary Calculator</title>
    <link rel="stylesheet" href="Styles/employees.css">
</head>

<body>

    <div class="headerT">
        <h2 class="topic">Calculate Salary</h2>
        <button class="dash" id="dashboard_button">Dashboard</button>
    </div>

    <div class="container">

        <div class="input-group">
        <label for="emp_id">Employee ID:</label>
        <input type="text" id="emp_id" name="emp_id" autocomplete="off">
        <button type="button" id="load_button">Load</button>
        <br>
        </div>

        <br>

        <form action="backPHP/calculate_sal.php" method="post">

        <div class="input-group">
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" readonly autocomplete="off">
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" readonly autocomplete="off">
            <br>
        </div>

        <div class="input-group">
            <label for="first_name">First name:</label>
            <input type="text" id="first_name" name="first_name" readonly>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="last_name">Last name:</label>
            <input type="text" id="last_name" name="last_name" readonly>
            <br>
        </div>

        <div class="input-group">
            <label for="phone_number">Phone number:</label>
            <input type="text" id="phone_number" name="phone_number" readonly>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label for="gross_salary">Gross salary:</label>
            <input type="text" id="gross_salary" name="gross_salary" readonly>
            <br>
        </div>

        <br>
        <div class="input-group">
            <br>
            <label for="select_month">Month:</label>
            <select id="select_month" name="select_month">
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
            </select>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <button type="submit" id="calculate" style="float: right; margin-right: 5px;">Calculate</button>
            <br>
        </div>

        </form>
        
        </div>

        <div class="salary-det">
            <br>
            <label for="month">Month:</label>
            <input type="text" id="month" name="month" readonly>
            <br><br>
            <label for="gross">Gross salary:</label>
            <input type="text" id="gross" name="gross" readonly>
            <br><br>
            <label for="tax_deduc">Tax deductions:</label>
            <input type="text" id="tax_deduc" name="tax_deduc" readonly>
            <br><br>
            <label for="employer_con">Employer contribution:</label>
            <input type="text" id="employer_con" name="employer_con" readonly>
            <br><br>
            <label for="employee_con">Employee contribution:</label>
            <input type="text" id="employee_con" name="employee_con" readonly>
            <br><br>
            <label for="tot_epf">Total EPF:</label>
            <input type="text" id="tot_epf" name="tot_epf" readonly>
            <br><br>
            <label for="etf_deduc">ETF deductions:</label>
            <input type="text" id="etf_deduc" name="etf_deduc" readonly>
            <br><br>
            <label for="take_home">Take home salary:</label>
            <input type="text" id="take_home" name="take_home" readonly>
            <br><br><br>
            <button type="button" id="pay_button">Pay</button>
        </div>

    </div>
    
    </form>

    <script src="Scripts/paymentscript.js"></script>

    <script src="Scripts/employeescript.js"></script>

    <script src="Scripts/salaryscript.js"></script>

    <script>
        document.getElementById('dashboard_button').addEventListener('click', function() {
        window.location.href = 'dashboard.php';
        });
    </script>

    <?php
    if (isset($_SESSION['delete_message'])) {
        echo "<script>alert('" . $_SESSION['delete_message'] . "');</script>";
        unset($_SESSION['delete_message']); // Remove the message from session to prevent displaying it again on page reload
    }
    ?>
    
</body>
</html>