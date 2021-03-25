<?php
session_start();
?>

<!DOCTYPE html>
<html>
<div class="content center-block text-center">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Post Status</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="scss/style.css" type="text/css">
    </head>

    <body>
        <!-- Header -->
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">Simpbook</h1>
                <p class="lead">For simps, by simps.</p>
                <hr class="my-4">
            </div>

            <!-- Start of card -->
            <div class="card main-card text-md-start" style="width: 50%;">
                <!--Card Header contains status code and date -->
                <!--Status Code-->
                <div class="card-header row">
                    <div class="form-group col-md">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="sc">S</span>
                            </div>
                            <input type="text" class="input-special" name="statuscode" id="statcode" maxlength="4" pattern="[0-9]{4}" size="3" />
                        </div>
                        <small id="passwordHelpBlock" class="form-text text-muted">Your status code must be a unique number e.g. 0001.</small>
                    </div>

                    <!--Date-->
                    <div class="form-group mb-3 col-md float-right">
                        <input type="date" name="Date" id="postdate" />
                    </div>
                </div>

                <!-- Start of card body -->
                <div class="card-body">
                    <!--Status field -->
                    <div class="form-group" id="stat">
                        <div class="input-group form-group">
                            <input type="text" class="form-control mb-3 mt-3" name="status" id="statustext" pattern="[a-zA-Z0-9 ,.!\?]" placeholder="Got something to say?" />
                        </div>
                    </div>

                    <!--Visibility-->
                    <div class="form-group mb-3">
                        <label>Share:</label>

                        <label for="public">Public</label>
                        <input type="radio" name="visibility" id="public" value="public" />

                        <label for="friends">Friends</label>
                        <input type="radio" name="visibility" id="friends" value="friends" />

                        <label for="me">Only Me</label>
                        <input type="radio" name="visibility" id="me" value="me" />
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
            <!-- End of card -->
        </div>
    </body>
</div>

</html>