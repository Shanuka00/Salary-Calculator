// Function to fetch and fill employee data when the "Calculate" button is clicked
document.getElementById('load_button').addEventListener('click', function() {
    var emp_id = document.getElementById('emp_id').value;

    // Make AJAX request to fetch employee data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Parse the JSON response
                var employeeData = JSON.parse(xhr.responseText);

                // Fill the relevant textboxes with the retrieved data
                document.getElementById('employee_id').value = employeeData.emp_id;
                document.getElementById('email').value = employeeData.email;
                document.getElementById('first_name').value = employeeData.f_name;
                document.getElementById('last_name').value = employeeData.l_name;
                document.getElementById('phone_number').value = employeeData.phone;
                document.getElementById('gross_salary').value = employeeData.gross_sal;
                // Similarly fill other textboxes with relevant data
            } else {
                // Handle error if AJAX request fails
                console.error('Failed to fetch employee data');
            }
        }
    };
    xhr.open('POST', 'backPHP/load_employee_data.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('emp_id=' + emp_id);
});

// Function to fetch and fill employee data when the "Calculate" button is clicked
document.getElementById('calculate').addEventListener('click', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the gross salary and selected month from the form
    var grossSalary = document.getElementById('gross_salary').value;
    var month = document.getElementById('select_month').value;

    // Make AJAX request to calculate tax deduction
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Parse the JSON response
                var response = JSON.parse(xhr.responseText);

                // Fill relevant textboxes with calculated data
                document.getElementById('month').value = response.month;
                document.getElementById('gross').value = response.gross_salary;
                document.getElementById('tax_deduc').value = response.tax_deduc;
                // Fill other textboxes with calculated data
            } else {
                // Handle error if AJAX request fails
                console.error('Failed to calculate salary');
            }
        }
    };
    xhr.open('POST', 'backPHP/calculate_salary.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('gross_salary=' + grossSalary + '&select_month=' + month);
});

//fill other
// Function to fetch and fill employee data when the "Calculate" button is clicked
document.getElementById('calculate').addEventListener('click', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get the gross salary and selected month from the form
    var grossSalary = document.getElementById('gross_salary').value;
    var month = document.getElementById('select_month').value;

    // Make AJAX request to calculate salary
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Parse the JSON response
                var response = JSON.parse(xhr.responseText);

                // Fill relevant textboxes with calculated data
                document.getElementById('month').value = response.month;
                document.getElementById('gross').value = response.gross_salary;
                document.getElementById('tax_deduc').value = response.tax_deduc;

                // Calculate and fill remaining textboxes
                var employerContribution = response.gross_salary * 12 / 100;
                var employeeContribution = response.gross_salary * 8 / 100;
                var totalEpf = employerContribution + employeeContribution;
                var etfDeductions = response.gross_salary * 3 / 100;
                var takeHomeSalary = response.gross_salary - (response.tax_deduc + employeeContribution + etfDeductions);

                // Fill other textboxes with calculated data
                document.getElementById('employer_con').value = employerContribution.toFixed(2);
                document.getElementById('employee_con').value = employeeContribution.toFixed(2);
                document.getElementById('tot_epf').value = totalEpf.toFixed(2);
                document.getElementById('etf_deduc').value = etfDeductions.toFixed(2);
                document.getElementById('take_home').value = takeHomeSalary.toFixed(2);
            } else {
                // Handle error if AJAX request fails
                console.error('Failed to calculate salary');
            }
        }
    };
    xhr.open('POST', 'backPHP/calculate_salary.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('gross_salary=' + grossSalary + '&select_month=' + month);
});