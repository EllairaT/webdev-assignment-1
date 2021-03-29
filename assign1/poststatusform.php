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
                            <input type="date" class="form-control" name="Date" id="postdate" />
                        </div>
                    </form>
                </div>

                <!-- Start of card body -->
                <div class="card-body">

                    <!--Visibility-->

                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-secondary">Friends only</button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </div>



                    <div class="form-group mb-3 mt-3">
                        <label for="public">Public</label>
                        <input type="radio" name="visibility" id="public" value="public" />

                        <label for="friends">Friends</label>
                        <input type="radio" name="visibility" id="friends" value="friends" />

                        <label for="me">Only Me</label>
                        <input type="radio" name="visibility" id="me" value="me" />
                    </div>

                    <!--Status field -->
                    <div class="form-group" id="stat">
                        <div class="input-group form-group">
                            <input type="text" class="form-control mt-3" name="status" id="statustext" pattern="[a-zA-Z0-9 ,.!\?]" placeholder="Got something to say?" />
                        </div>
                    </div>

                    <!--Permissions version 1 (default checkbox look)
                    
                        <div class="form-group mb-3">
                        <label>Permissions:</label>
                        <input type="checkbox" name="permission" value="like">Allow Like
                        <input type="checkbox" name="permission" value="comment">Allow Comments
                        <input type="checkbox" name="permission" value="share">Allow Share

                    </div> -->

                    <!-- permissions version 2 (checkbox buttons)-->
                    <div class="btn-group permissions-group d-flex" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="btnlike" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnlike">Allow Like</label>

                        <input type="checkbox" class="btn-check" id="btncomment" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btncomment">Allow Comments</label>

                        <input type="checkbox" class="btn-check" id="btnshare" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnshare">Allow Share</label>
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