<?php

include 'dbcon.php';
Connect();

if(isset($_POST["statuscode"])){
    echo 's';
    
    echo $_POST['statuscode'];
}
