<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration_system";
    $port = "4306";


    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

    mysqli_set_charset($conn,"utf8");

    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    } 
?>