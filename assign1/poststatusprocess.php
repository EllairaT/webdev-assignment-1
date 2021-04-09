<?php
header("Content-type: application/json");

include 'dbcon.php';
$conn = Connect();

function insertToTable()
{
    global $conn, $status_code, $response_array, $form_data;

    //for added security, sql statements are in prepared statements.
    //query to insert data content into posts table:
    $insert_cont = $conn->prepare("INSERT INTO `posts` VALUES (?,?,?, (SELECT `visibility.id` FROM `visibility` WHERE `visibility.name` = ? ))");
    $insert_cont->bind_param("ssss", $status_code, $status_content, $status_date, $status_visibility);

    //query to insert data into post_permissions table:
    $insert_perm = $conn->prepare('INSERT INTO `post_permissions` (`post_permissions.code`,` post_permissions.permission_id`) VALUES (?, (SELECT `permissions.id` FROM `permissions` WHERE `permissions.name` = ?))');
    $insert_perm->bind_param("ss", $status_code, $p);

    if (!empty($form_data)) {
        $status_content = $form_data['status'];
        $status_date =  $form_data['Date'];
        $status_visibility = $form_data['shareoptions'];
    }

    $status_permissions = $form_data['permissions'];
    foreach ($status_permissions as $p) {
        $insert_perm->execute();
    }

    $insert_cont->execute();
    $insert_cont->close();
    $insert_perm->close();
    $response_array['status'] = $status_code;
    $response_array['status_message'] = $form_data['Date'] . " ;" . $form_data['status'];
}

function doesCodeExist()
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


$status_code;
$form_data = array();
//creating and initialising an array to store the server response in, which will then be sent back to the client. 
$response_array = array('status' => "", 'status_message' => "",  'response' => "");

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "1":
            if (isCodeValid($_POST['statuscode'])) { //if code is valid, 
                $status_code = "S" . $_POST['statuscode']; //insert uppercase S at the start. 

                if (doesCodeExist($status_code)) { //then check if the full status code exists
                    $response_array['status_message'] = "Status Code already exists!";
                } else {
                    $response_array['status'] = 'success';
                    $response_array['status_message'] = "Valid Status Code.";
                }
            }

            break;
        case "2":
            parse_str($_POST["formdata"], $form_data);
            insertToTable();

            break;
        default:
            break;
    }
}


echo json_encode($response_array);
