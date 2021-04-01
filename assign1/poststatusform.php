<?php
include 'dbcon.php';

Connect();
session_start();

?>

<!DOCTYPE html>
<html>
<div class="content center-block text-center">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="scss/style.css" type="text/css">

        <title>Post Status</title>
    </head>

    <body>
        <!-- Header -->
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">pls no more php</h1>
                <p class="lead">it's so bad.</p>
                <hr class="my-4">
            </div>

            <!------------------------ START OF CARD ------------------------>
            <div class="card main-card text-md-start mx-auto" style="width: 50%;">
                <!--Card Header contains status code and date -->

                <div class="card-header navbar">
                    <!-- Status Code -->
                    <form class="form-inline statcode">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text float-end px-0" id="sc">S</span>
                            </div>
                            <input type="text" class="form-control px-1" name="statuscode" maxlength="4" pattern="[0-9]{4}" placeholder="0000" />
                        </div>
                    </form>

                    <!--Date-->
                    <form class="form-inline w-25">
                        <div class="input-group">
                            <input type="date" class="form-control px-0" name="Date" id="postdate" />
                        </div>
                    </form>
                </div>

                <!-- Start of card body -->
                <div class="card-body">

                    <!--Visibility-->

                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Share
                        </button>

                        <!-- These are STILL technically radio buttons. -->
                        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="sharedropdownmenu">
                            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off">
                            <label class="btn btn-secondary dropdown-item" for="option1">
                                <img src="..\node_modules\bootstrap-icons\icons\person-circle.svg" alt="Bootstrap" width="auto" height="auto">
                                Only me
                            </label>

                            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                            <label class="btn btn-secondary dropdown-item" for="option1">
                                <img src="..\node_modules\bootstrap-icons\icons\people-fill.svg" alt="Bootstrap" width="auto" height="auto">
                                Friends
                            </label>

                            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                            <label class="btn btn-secondary dropdown-item" for="option1">
                                <img src="..\node_modules\bootstrap-icons\icons\globe.svg" alt="Bootstrap" width="auto" height="auto">
                                Public
                            </label>
                        </div>
                    </div>

                    <!--Status field -->
                    <div class="form-group" id="stat">
                        <div class="input-group form-group">
                            <input type="text" class="form-control mt-3" name="status" id="statustext" pattern="[a-zA-Z0-9 ,.!\?]" placeholder="Got something to say?" />
                        </div>
                    </div>

                    <!--permissions dropdown here. for every tick, add relevant icon to the right side -->
                    <div class="d-grid">
                        <button class="btn btn-sm pbtn mt-3 d-flex" id="permsbtn" data-bs-toggle="collapse" href="#permissionslist" role="button">
                            <span class="align-self-start d-inline">Permissions
                                <img src="..\node_modules\bootstrap-icons\icons\caret-right.svg" alt="Bootstrap" width="auto" height="auto">
                            </span>
                        </button>
                    </div>

                    <div class="collapse" id="permissionslist">
                        <div class="d-flex justify-content-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <img src="..\node_modules\bootstrap-icons\icons\heart-fill.svg" alt="Bootstrap" width="auto" height="auto">
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <img src="..\node_modules\bootstrap-icons\icons\chat-square-dots-fill.svg" alt="Bootstrap" width="auto" height="auto">
                            </div>

                            <div class="form-check  form-check-inline">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <img src="..\node_modules\bootstrap-icons\icons\share-fill.svg" alt="Bootstrap" width="auto" height="auto">
                            </div>
                        </div>
                    </div>
                    <!--Submit button -->
                    <div class="d-grid gap-2 mt-2">
                        <button type="button" class="btn btn-primary btn-submit" value="Submit">Post</button>
                    </div>
                </div>
            </div>
            <!------------------------ End of card ------------------------>
        </div>
    </body>
</div>

</html>