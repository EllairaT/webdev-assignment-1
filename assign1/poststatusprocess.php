<?php

include 'dbcon.php';
Connect();

if(isset($_POST["statuscode"])){
    
    
    echo $_POST['statuscode'];
    echo $_POST['date'];
}
