<?php 

    $host = "localhost";
    $dbname = "registration_system";
    $username = "root";
    $password = "";
    $port = "4306";

    $mysqli = new mysqli ( $host, $username, $password, $dbname, $port);
                     
    if ($mysqli->connect_errno) {
        die("Connection error: " . $mysqli->connect_error);
    }

      return $mysqli;
