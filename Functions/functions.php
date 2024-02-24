<?php

function validCheck($user, $pass){

    $pass = passwordEncrypter($pass);
    echo $pass;

    define("NOT_VALIDATED", "Hello, World!Username and Password Doesn\'t match");
    define("VALIDATED", "Valid");

    $validationStatus = NOT_VALIDATED;

    $conn = dbConn();  // Database connection

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();

    if ($stmt->fetch()) {
        $validationStatus = VALIDATED;
    } 
    $conn->close();
    return $validationStatus;
}

function addTaxRate($lowerValue, $upperValue, $taxRate){

    define("DATABASE_ERROR", "There is an error on our side. Please try again later."); //  Database Error Messege

    define("NEW_RANGE_ADDED", "New range added successfully."); //  New Range Added Messege
    define("NEW_RANGE_ERROR", "Cannot add a new range.");       //  New Range Error Messege
    
    define("RANGE_UPDATED", "Range updated successfully.");     //  Update Range Messege
    define("NEW_UPDATE_ERROR", "Cannot update this range.");    //  Update Error Messege


    $conn = dbConn();

    if ($conn->connect_error) {
        return DATABASE_ERROR;
    }

    
    // Check if data is available in the table
    $checkQuery = "SELECT * FROM taxes WHERE (lower_value=? OR upper_value=?) AND status = 'A'";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("dd", $lowerValue, $upperValue);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows > 0) {


        // Data is available, update the record
        $updateQuery = "UPDATE taxes SET lower_value=?, upper_value=?, tax_rate=? WHERE lower_value=? OR upper_value=?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ddddd", $lowerValue, $upperValue, $taxRate, $lowerValue, $upperValue);
        
        if ($updateStmt->execute()) {
            return RANGE_UPDATED;

        } else {
            return NEW_UPDATE_ERROR;
        }

        $updateStmt->close();
    } else {

        // Data is not available, insert a new record
        $insertQuery = "INSERT INTO taxes (lower_value, upper_value, tax_rate) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ddd", $lowerValue, $upperValue, $taxRate);

        if ($insertStmt->execute()) {
            return NEW_RANGE_ADDED;
            
        } else {
            return NEW_RANGE_ERROR;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();
}

function deleteTaxRate($lowerValue, $upperValue){

    define("DATABASE_ERROR", "There is an error on our side. Please try again later."); //  Database Error Messege

    define("DELETED_RANGE", "Record deleted successfully."); //  New Range Added Messege
    define("DELETE_ERROR", "Cannot delete the record.");       //  New Range Error Messege
    

    $conn = dbConn();

    if ($conn->connect_error) {
        return DATABASE_ERROR;
    }

    
    // Check if data is available in the table
    $checkQuery = "SELECT * FROM taxes WHERE lower_value=? OR upper_value=?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("dd", $lowerValue, $upperValue);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows > 0) {


        // Data is available, update the record
        $updateQuery = "UPDATE taxes SET status='D' WHERE lower_value=? OR upper_value=?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("dd", $lowerValue, $upperValue);
        
        if ($updateStmt->execute()) {
            return DELETED_RANGE;

        } else {
            return DELETE_ERROR;
        }

        $updateStmt->close();
    } 
    $checkStmt->close();
    $conn->close();
}

function showTaxRates(){
    // Create connection
    $conn = dbConn();

    define("ENTER_TAX_RATES", "Enter Tax Rates");   //  Empty table Message
    define("DATABASE_ERROR", "There is an error on our side. Please try again later."); //  Database Error Messege
    define("TABLE_HEAD", "<table>
                <tr>
                    <th>#</th>
                    <th>Lower Value</th>
                    <th>Upper Value</th>
                    <th>Tax Rate</th>
                </tr>");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch data from the table
    $sql = "SELECT ID, lower_value, upper_value, tax_rate FROM taxes WHERE status = 'A'";
    $result = $conn->query($sql);

    $table = ENTER_TAX_RATES;

    if ($result->num_rows > 0) {
        // Output data in an HTML table
        $table = TABLE_HEAD;

        $count = 0;
        while($row = $result->fetch_assoc()) {

            ++$count;
            $table = $table."<tr>
                    <td>" . $count . "</td>
                    <td>" . $row["lower_value"] . "</td>
                    <td>" . $row["upper_value"] . "</td>
                    <td>" . $row["tax_rate"] . "</td>
                </tr>";
        }

        $table = $table."</table>";

        return $table;

    } else {
        return $table;
    }

    // Close the connection
    $conn->close();
}

function dbConn(){

    define("SERVERNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "salary_calculator");

    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

    return $conn;
}

function passwordEncrypter($pass){
    $encryptedPassword = "HI Valiasta".$pass."123";
    $encryptedPassword = md5($encryptedPassword);
    return $encryptedPassword;
}

?>