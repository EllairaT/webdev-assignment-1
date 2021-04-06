<?php
include 'dbcon.php';
$conn = Connect();

//to prevent SQL injection attacks, sql statements are in prepared statements.
//the data from the forms are inserted into two tables. posts and post_permissions
//Inserting data into posts table:
$insert_cont = $conn->prepare('INSERT INTO posts VALUES (?,?,?, (SELECT visibility.id FROM visibility WHERE visibility.name = ? ))');
$insert_cont->bind_param("ssss", $status_code, $status_content, $status_date, $status_visibility);

//inserting data into post_permissions table:
$insert_perm = $conn->prepare('INSERT INTO post_permissions (post_permissions.code, post_permissions.permission_id) VALUES (?, (SELECT permissions.id FROM permissions WHERE permissions.name = ?))');
$insert_perm->bind_param("ss", $status_code, $p);


if (($_POST['statuscode'] && $_POST['status'] && $_POST['date'] && $_POST['share-options'])) {
    $status_code = "S" . $_POST['statuscode']; //status codes are prefixed with a capital S
    $status_content = $_POST['status'];
    $status_date =  $_POST['date'];
    $status_visibility = $_POST['share-options'];

    if (!isset($_POST['permissions'])) {
        $status_permissions = "";
    } else {
        $status_permissions = $_POST['permissions'];
        foreach ($status_permissions as $p) {
            $insert_perm->execute();
        }
    }



    $insert_cont->execute();

    $insert_cont->close();
    $insert_perm->close();
}
