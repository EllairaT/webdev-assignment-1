<?php
header('Content-type: application/json');
include 'dbcon.php';
$conn = Connect();

function insertToTable()
{
    global $conn;

    //for added security, sql statements are in prepared statements.
    //query to insert data content into posts table:
    $insert_cont = $conn->prepare('INSERT INTO posts VALUES (?,?,?, (SELECT visibility.id FROM visibility WHERE visibility.name = ? ))');
    $insert_cont->bind_param("ssss", $status_code, $status_content, $status_date, $status_visibility);

    //query to insert data into post_permissions table:
    $insert_perm = $conn->prepare('INSERT INTO post_permissions (post_permissions.code, post_permissions.permission_id) VALUES (?, (SELECT permissions.id FROM permissions WHERE permissions.name = ?))');
    $insert_perm->bind_param("ss", $status_code, $p);

    if (($_POST['statuscode'] && $_POST['status'] && $_POST['date'] && $_POST['share-options'])) {
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
}

function doesCodeExist($code_string)
{
    global $conn, $status_code;

    //search for the status code in the database
    $check_code_query = $conn->prepare('SELECT * FROM posts WHERE posts.status_code = ?');
    $check_code_query->bind_param("s", $status_code);
    $check_code_query->execute(); 

    $result = $check_code_query->get_result();
    $check_code_query->close();

    if ($result->num_rows > 0) {
        return true;
    }
}

function isCodeValid($code)
{
    if (is_numeric($code) && strlen($code) >= 4) {
        return true;
    }
    return false;
}

//global variable 
$status_code = "S" . $_POST['statuscode'];

//creating and  initialising an array to store the server response in, which will then be sent back to the client. 
$response_array['status'] = 'error';
$response_array['status_message'] = "Invalid input";

if (isCodeValid($_POST['statuscode'])) {
    if (doesCodeExist($status_code)) {
        $response_array['status_message'] = "Status Code already exists!";
    } else {
        $response_array['status'] = 'success';
        $response_array['status_message'] = "Valid Status Code.";        
    }
}
echo json_encode($response_array);
