function setEmployeeID() {
    // Get the selected employee role
    var employee_role = document.getElementById('employee_role').value;
    
    // Send AJAX request to employeeback.php
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'backPHP/employeeid.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Set the employee ID textbox value with the response from the server
            document.getElementById('employee_id').value = xhr.responseText;
        }
    };
    // Send the request with the selected employee role
    xhr.send('employee_role=' + employee_role + '&set_id_button=1');
}

