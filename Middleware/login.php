<?php

include_once '../Functions/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $userAvailability = validCheck($username, $password);

    if($userAvailability == "Valid"){
        header('Location:../dashboard.php');
    }else{
        header('Location:../index.php');
    }
    
}
?>