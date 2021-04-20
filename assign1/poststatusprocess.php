<?php
header("Content-type: application/json");
include 'dbcon.php';
$conn = Connect();

function insertToTable($d)
{
    global $conn;

    //for added security, sql statements are in prepared statements.
    //query to insert data content into posts table:
    $insert_cont = $conn->prepare("INSERT INTO `posts` VALUES (?,?,?, (SELECT `visibility`.`id` FROM `visibility` WHERE `visibility`.`name` = ? ))");
    $insert_cont->bind_param("ssss", $status_code, $status_content, $status_date, $status_visibility);

    //query to insert data into post_permissions table:
    $insert_perm = $conn->prepare("INSERT INTO `post_permissions` (`post_permissions`.`code`,`post_permissions`.`permission_id`) VALUES (?, (SELECT `permissions`.`id` FROM `permissions` WHERE `permissions`.`name` = ?))");
    $insert_perm->bind_param("ss", $status_code, $p);

    $status_code = "S" . $d['statuscode'];
    $status_content = $d['status'];
    $status_date =  $d['Date'];
    $status_visibility = $d['shareoptions'];

    if (!validateDate($status_date)) {
        return false;
    }

    if ($insert_cont->execute()) {
        if (isset( $d['permissions'])) {
            foreach ( $d['permissions'] as $p) {
                $insert_perm->execute();
             }
        }
        return true;
    } else {
        return false;
    }
}

function validateDate($d)
{
    $date = $d;
    list($y, $m, $d) = explode('-', $date);
    return checkdate($m, $d, $y);
}

function isPostValid($text)
{
    $pattern = "/[^A-Za-z0-9.,\?! ]+/";
    return !preg_match($pattern, $text);
}

function doesCodeExist($c)
{
    global $conn;

    //search for the status code in the database
    $check_code_query = $conn->prepare('SELECT * FROM posts WHERE posts.status_code = ?');
    $check_code_query->bind_param("s", $status_code);

    $status_code = $c;

    $check_code_query->execute();

    $check_code_query->store_result();
    $num_result =  $check_code_query->num_rows();
    if ($num_result > 0) {
        return true;
    } else {
        return false;
    }
}

function isCodeValid($code)
{
    if (is_numeric($code) && strlen($code) >= 4) {
        return true;
    } else {
        return false;
    }
}
//creating and initialising an array to store the server response in, which will then be sent back to the client. 
$response = array('status' => 'Error', 'statusmessage' => '', 'submitmessage' => 'Post not submitted.', 'redirect' => '');

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "1":
            if (isCodeValid($_POST['statuscode'])) { //if code is valid, 
                $status_code = "S" . $_POST['statuscode']; //insert uppercase S at the start. 

                if (doesCodeExist($status_code)) { //then check if the full status code exists
                    $response['statusmessage'] = "Status Code already exists!";
                } else {
                    $response['status'] = 'Success';
                }
            } else {
                $response['statusmessage'] = "Invalid code. Only numbers are allowed!";
            }
            break;
        case "2":
            if (strlen(trim($_POST['statuspost'])) <= 0) {
                $response['statusmessage'] = "The post can't be empty!";
            } elseif (isPostValid($_POST['statuspost'])) {
                $response['status'] = 'Success';
            } else {
                $response['statusmessage'] = "There are invalid characters in the post.";
            }
            break;

        case "3":
            parse_str($_POST['formdata'], $form_data);

            if (insertToTable($form_data)) {
                $response['status'] = 'Success';
            } else {
                $response['statusmessage'] = "Something went wrong.";
            }
            $response['redirect'] =  'poststatusform.php';
        default:
            break;
    }
}


echo json_encode($response);
