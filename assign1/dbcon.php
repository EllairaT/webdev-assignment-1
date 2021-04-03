<?php

function Connect()
{
    require_once('../../../conf/sqlinfo.inc.php');

    //creating connection 
    $conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);

    //checking connection   
    if (!$conn) {
        die("Something went wrong.");
    }
    return $conn;
}

