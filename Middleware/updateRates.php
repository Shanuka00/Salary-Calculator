<?php

include_once '../Functions/functions.php';

if (isset($_POST['add_record'])) {
    
    $lowerValue = $_POST['lowervalue'];
    $upperValue = $_POST['uppervalue'];
    $taxRate = $_POST['taxrate'];

    echo addTaxRate($lowerValue, $upperValue, $taxRate);

    // Start the session and send the message to the rates.php
    /*
        Please write the code ASAP
    */

   header('Location:../rates.php');
        
}elseif(isset($_POST['delete_record'])){
    $lowerValue = $_POST['lowervalue'];
    $upperValue = $_POST['uppervalue'];
    echo deleteTaxRate($lowerValue, $upperValue);

    header('Location:../rates.php');
}

?>