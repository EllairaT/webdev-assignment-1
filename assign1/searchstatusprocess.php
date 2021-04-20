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

$search_query =  $conn->prepare("SELECT posts.status_code, posts.content, posts.date, visibility.name AS 'share_with' FROM posts, post_permissions, visibility WHERE posts.content LIKE ? AND posts.visibility_id = visibility.id GROUP BY posts.status_code");
$search_query->bind_param("s", $searchvar);

$perms_query = $conn->prepare("SELECT post_permissions.code, permissions.name FROM post_permissions, permissions WHERE post_permissions.code = ? AND permissions.id = post_permissions.permission_id");
$perms_query->bind_param("s", $statuscode);

$response = array();

$output = '';

if (isset($_GET['searchpost'])) {
    $str = $_GET['searchpost'];
    $searchvar = "%" . $str . "%";

    if ($search_query->execute()) {

        $search_query->store_result();
        $search_query->bind_result($statuscode, $content, $date, $visibility);

        if ($search_query->num_rows() > 0) {
            while ($search_query->fetch()) {

                $output .= '<div class="card mb-3"><div class="card-header"><small class="text-muted">' .
                    $statuscode . " / " . $date
                    . '</small><div class="float-end">' . setIcon($visibility) .
                    '</div></div><div class="card-body"><p class="card-text">' . $content .
                    '</p></div><div class="card-footer"><div class="float-end">';

                if ($perms_query->execute()) {
                    $perms_query->store_result();
                    $perms_query->bind_result($code, $name);
                    if ($perms_query->num_rows() > 0) {
                        while ($perms_query->fetch()) {
                            $output .= setIcon($name) . ' ';
                        }
                    } else {
                        $output .= '<small class="text-muted">No permissions set</small>';
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
