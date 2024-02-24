// Add event listener to Pay button
document.getElementById('pay_button').addEventListener('click', function() {
    // Fetch values from the form fields
    var emp_id = document.getElementById('employee_id').value;
    var gross_salary = document.getElementById('gross_salary').value;
    var tax_deduc = document.getElementById('tax_deduc').value;
    var employer_con = document.getElementById('employer_con').value;
    var employee_con = document.getElementById('employee_con').value;
    var etf_deduc = document.getElementById('etf_deduc').value;
    var year = new Date().getFullYear(); // Get the current year
    var month = document.getElementById('select_month').value;

    // Create a FormData object to send data to process_payment.php
    var formData = new FormData();
    formData.append('emp_id', emp_id);
    formData.append('gross_salary', gross_salary);
    formData.append('tax_deduc', tax_deduc);
    formData.append('employer_con', employer_con);
    formData.append('employee_con', employee_con);
    formData.append('etf_deduc', etf_deduc);
    formData.append('year', year);
    formData.append('month', month);

    // Make an AJAX request to process the payment
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Payment successful
                alert('Payment successful!');
            } else {
                // Payment failed
                alert('Already paid!');
            }
        }
    };
    xhr.open('POST', 'backPHP/process_payment.php', true);
    xhr.send(formData); // Send form data
});