<?php

function Connect()
{
    $host = "localhost";
    $username = "root";
    $password = "";

    //creating connection 
    $conn = new mysqli($host, $username, $password);

    //checking connection   
    if (!$conn) {
        die("Something went wrong. " . $conn->error);
    }

    return $conn;
}

