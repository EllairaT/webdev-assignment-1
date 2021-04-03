<?php

Connect();


$status_code = $_POST['statuscode'];
$status_content = $_POST['status'];
$status_date = $_POST['date'];
$status_visibility = $_POST['share-options'];
$status_permissions = $_POST['permissions'];

$sql_insert = "INSERT INTO posts()";
// $status_permissions may be empty(NULL)!

if(isset($status_code, $status_content, $status_date, $status_visibility)){

}


