<?php
include 'dbcon.php';

Connect();
//session_start();
//sometimes the server is set up for a different timezone. This is to make sure the timezone is correct (for us)
date_default_timezone_set('Pacific/Auckland');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Post Status</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="scss/style.css" type="text/css">
    <script src="js/script.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            initializePoppers();
        });
    </script>
</head>

<body>
    <div class="content center-block text-center">
        <!-- Header -->
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">whispurr</h1>
                <p class="lead">keep meowing</p>
                <hr class="my-4">
            </div>
            <form action="poststatusprocess.php" method="POST">
                <!------------------------ START OF CARD ------------------------>
                <div class="card main-card text-md-start mx-auto my-auto" style="width: 50%;">
                    <!--Card Header contains status code and date -->

                    <div class="card-header navbar">
                        <!-- Status Code -->
                        <div class="d-inline statcode">
                            <div class="input-group mx-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text float-end px-0" id="sc">S</span>
                                </div>
                                <input type="text" class="form-inline px-1 w-25" name="statuscode" maxlength="4" pattern="[0-9]{4}" placeholder=" 0000" data-bs-toggle="popover" title="Status Code" data-bs-content="Kinda like a diary entry, make a unique 4 digit number! (e.g. 0123)" data-bs-trigger="hover" autocomplete="off" />
                            </div>

                        </div>

                        <!--Date-->
                        <div class="form-inline w-25">
                            <div class="input-group">
                                <input type="date" class="form-control bg-transparent px-0" name="date" id="postdate" value="<?php echo date('Y-m-d'); ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- Start of card body -->
                    <div class="card-body">

                        <!--Visibility; show to friends is the default option-->
                        <div>
                            <div class="btn-group dropend">
                                <button type="button" id="share-with" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Friends
                                </button>
                                <span class="d-inline-flex mx-3" data-bs-toggle="popover" title="Who can see this?" data-bs-content="By default, only your friends can see what you post." data-bs-trigger="hover">
                                    <i class="bi bi-info-circle" style="font-size:20px; color: cornflowerblue; " width="auto" height="auto"></i>
                                </span>

                                <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="sharedropdownmenu">
                                    <input type="radio" class="btn-check" name="share-options" id="onlyme" autocomplete="off" value="Only Me" onClick="shareOptions('onlyme')">
                                    <label class="btn btn-secondary dropdown-item" for="onlyme">
                                        <img src="..\node_modules\bootstrap-icons\icons\person-circle.svg" width="auto" height="auto">
                                        Only me
                                    </label>

                                    <input type="radio" class="btn-check" name="share-options" id="onlyfriends" autocomplete="off" value="Friends" onClick="shareOptions('onlyfriends')" checked>
                                    <label class="btn btn-secondary dropdown-item" for="onlyfriends">
                                        <img src="..\node_modules\bootstrap-icons\icons\people-fill.svg" width="auto" height="auto">
                                        Friends
                                    </label>

                                    <input type="radio" class="btn-check" name="share-options" id="public" autocomplete="off" value="Public" onClick="shareOptions('public')">
                                    <label class="btn btn-secondary dropdown-item" for="public">
                                        <img src="..\node_modules\bootstrap-icons\icons\globe.svg" width="auto" height="auto">
                                        Public
                                    </label>
                                </div>
                            </div>

                            <!-- Permission badges tell the user which permissions are enabled -->
                            <div class="d-inline">
                                <div class="badge rounded-pill bg-warning text-dark float-end mx-1" id="share-badge" style="display: none;">
                                    <i class="bi bi-share text-light" style="font-size:20px;" width="auto" height="auto"></i>
                                </div>
                                <div class="badge rounded-pill bg-info float-end mx-1" id="comment-badge" style="display: none;">
                                    <i class="bi bi bi-chat-square-dots text-light" style="font-size:20px;" width="auto" height="auto"></i>
                                </div>
                                <div class="badge rounded-pill bg-danger float-end mx-1" id="like-badge" style="display: none;">
                                    <i class="bi bi-heart text-light" style="font-size:20px;" width="auto" height="auto"></i>
                                </div>
                            </div>
                        </div>
                        <!-- end of visibility -->


                        <!--Status field -->
                        <div>
                            <div class="form-group" id="stat-field">
                                <div class="input-group form-group">
                                    <input type="text" class="form-control mt-3" name="status" id="statustext" pattern="[A-Za-z0-9\(\)._\-‘\?!]+" placeholder="Got something to say?" autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <!--collapse button -->
                        <button class="btn " type="button" data-bs-toggle="collapse" data-bs-target="#collapsePermissions" aria-expanded="false" aria-controls="collapsePermissions">
                            <span><small class="text-muted" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="You can choose if you want your audience to like, comment or even share your post!" title="Permissions!" data-bs-placement="left">Permissions
                                    <i class="bi bi-caret-right" width="auto" height="auto"></i>
                                </small></span>
                        </button>

                        <!--permissions here. for every tick, add relevant icon to the right side -->
                        <div class="collapse mx-3" id="collapsePermissions">
                            <div id="permissionslist" class="align-self-start">

                                <div>
                                    <div class="form-check form-check-inline" data-bs-toggle="tooltip" title="Like">
                                        <label>
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="like" id="likeCheck" onClick="addPermission('like')">
                                            <i class="bi bi-heart-fill text-danger" style="font-size:20px;" width="auto" height="auto"></i>
                                    </div>

                                    <div class="form-check form-check-inline" data-bs-toggle="tooltip" title="Comment">
                                        <label>
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="comment" id="commentCheck" onClick="addPermission('comment')">
                                            <i class="bi bi bi-chat-square-dots-fill text-info" style="font-size:20px;" width="auto" height="auto"></i>
                                        </label>
                                    </div>

                                    <div class="form-check  form-check-inline" data-bs-toggle="tooltip" title="Share">
                                        <label>
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="share" id="shareCheck" onClick="addPermission('share')">
                                            <i class="bi bi-share text-warning " style="font-size:20px;" width="auto" height="auto"></i>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--Submit button -->

                        <div class="d-grid gap-2 mt-2">
                            <input type="submit" class="btn btn-primary btn-submit" name="submit" value="Submit">
                        </div>
                    </div>
                </div>
        </div>
        <!------------------------ End of card ------------------------>
        </form>
    </div>
</body>
</div>

</html>