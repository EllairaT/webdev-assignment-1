<?php

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
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">Budget Facebook</h1>
                <p class="lead">Or is it budget twitter? They're pretty much the same thing.</p>
                <hr class="my-4">
            </div>
          
            <div class="card main-card text-md-start" style="width: 50%;">
                <div class="card-body">

                    <!--Status Code-->
                    <div class="form-group">
                        <label for="statcode">Status Code</label>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="sc">S</span>
                            </div>
                            <input type="text" name="statuscode" id="statcode" maxlength="4" pattern="[0-9]{4}" size=3/>
                        </div>
                        <small id="passwordHelpBlock" class="form-text text-muted">Your status code must be a unique number e.g. 0001.</small>
                    </div>

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

                    <!--Date-->
                    <div class="form-group mb-3">
                        <label>Date</label>
                        <input type="date" name="Date" id="postdate" />
                    </div>

                    <!--Permissions-->
                    <div class="form-group mb-3">
                        <label>Permissions</label>
                        <input type="checkbox" name="permission" value="like">Allow Like
                        <input type="checkbox" name="permission" value="comment">Allow Comments
                        <input type="checkbox" name="permission" value="share">Allow Share
                    </div>
                </div>
            </div>
        </div>
    </body>
</div>

</html>