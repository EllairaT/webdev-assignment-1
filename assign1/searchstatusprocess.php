<?php
header("Content-type: application/json");
include 'dbcon.php';
$conn = Connect();

function setIcon($text)
{
    $iconCode = '';
    switch ($text) {
        case "like":
            $iconCode = '<i class="bi bi-heart-fill"></i>';
            break;
        case "comment":
            $iconCode = '<i class="bi bi-chat-square-dots-fill"></i>';
            break;
        case "share":
            $iconCode = '<i class="bi bi-share"></i>';
            break;
        case "Public":
            $iconCode = '<i class="bi bi-globe"></i>';
            break;
        case "Only Me":
            $iconCode = '<i class="bi bi-person-circle"></i>';
            break;
        case "Friends":
            $iconCode = '<i class="bi bi-people-fill h3"></i>';
            break;
    }
    return $iconCode;
}


$sql_perms = "SELECT post_permissions.code, permissions.name
FROM post_permissions, permissions
WHERE post_permissions.code = ?
AND permissions.id = post_permissions.permission_id";

$search_query =  $conn->prepare("SELECT posts.status_code, posts.content, posts.date, visibility.name AS 'share_with' FROM posts, post_permissions, visibility WHERE posts.content LIKE ? AND post_permissions.code = posts.status_code AND posts.visibility_id = visibility.id GROUP BY posts.status_code");
$search_query->bind_param("s", $searchvar);

$perms_query = $conn->prepare($sql_perms);
$perms_query->bind_param("s", $statuscode);

$response = array();

$output = '';

if (isset($_GET['searchpost'])) {
    $str = $_GET['searchpost'];
    $searchvar = "%" . $str . "%";

    // $response['statusmessage'] = "Results returned: " . $result->num_rows;
    if ($search_query->execute()) {
        $result = $search_query->get_result();

        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                $output .= '<div class="card mb-3"><div class="card-header"><small class="text-muted">' .
                    $rows['status_code'] . " / " . $rows['date']
                    . '</small><div class="float-end">' . setIcon($rows['share_with']) .
                    '</div></div><div class="card-body"><p class="card-text">' . $rows['content'] .
                    '</p></div><div class="card-footer"><div class="float-end">';

                $statuscode = $rows['status_code'];

                if ($perms_query->execute()) {
                    $perms = $perms_query->get_result();

                    if ($perms->num_rows > 0) {
                        while ($p = $perms->fetch_assoc()) {
                            $output .= setIcon($p['name']) . ' ';
                        }
                    }
                }

                $output .= '</div></div></div>';
            }

            echo $output;
        } else {
            echo '
            <div class="justify-content-center d-flex">
                <div class="card w-25 border-danger bg-transparent my-auto">
                    <div class="card-body">
                        <p class="card-text text-light text-center">No posts found!</p>
                    </div>
                </div>
            </div>';
        }
    }
}
