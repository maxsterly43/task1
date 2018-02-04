<?php
    $host = "host1";
    $user = "root";
    $pass = "";
    $dbase = "one_bd";
    $connection = mysqli_connect($host , $user, $pass, $dbase);
    if(!$connection){
        print("connect db error: ".mysqli_connect_error()."<br>");
        exit();
    }
?>