<?php

?>

<!DOCTYPE html>
<html>
<div class="content">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Post Status</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="scss/style.css" type="text/css">
    </head>

    <body>
        <div class="container-fluid">
            <div id="main-cont">
                <h1>Budget Facebook</h1>

                <!--Asks user to input a status code. The S is added for the user.-->
                <div class="form-group">
                    <label for="statcode">Status Code</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="sc">S</span>
                        </div>
                        <input type="text" name="statuscode" id="statcode" maxlength="4" pattern="[0-9]{4}" size=3 />
                    </div>
                </div>

                <!--input field accepts alphanumerical numbers and comma, space, period, exclamation point and question marks -->
                <div class="form-group">
                    <label for="stattext">Status</label>
                    <div class="input-group mb-3">
                        <input type="text" name="status" id="stattext" pattern="[a-zA-Z0-9 ,.!\?]" />
                    </div>
                </div>

                <div class="form-group">
                    <label>Share:</label>

                    <label for="public">Public</label>
                    <input type="radio" name="visibility" id="public" value="public" />

                    <label for="friends">Friends</label>
                    <input type="radio" name="visibility" id="friends" value="friends" />

                    <label for="me">Only Me</label>
                    <input type="radio" name="visibility" id="me" value="me" />
                </div>
            </div>
        </div>
    </body>
</div>

</html>