<?php
    require_once("sql_connection.php");
    require_once("getServerAddr.php");
    require_once("modal_msg.php");
    session_start();
    /*
    $valid = true;
    //Require SQL Connection
    if(isset($_COOKIE['username'])){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT is_admin FROM nitro_user WHERE username = '{$_COOKIE['username']}' AND is_admin = 1";
        $result = $conn->query($query);
        if($result->num_rows == 0){
            $valid = false;
        }
        $result->free();
        $conn->close();
    } else {
        $valid = false;
    }
    if(!$valid){
        printf("<meta http-equiv=\"refresh\" content=\"3; url='http://%s/index.php'\" />", $_SERVER['HTTP_HOST']);
        die("You are not admin. Illegal Access...<br>Auto Redirect After 3 Seconds");
    }
    */

    $valid = true;
    if(isset($_SESSION['ExpTime']) && isset($_SESSION['username'])){
        if($_SESSION['ExpTime'] > time()){
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "SELECT is_admin FROM nitro_user WHERE username = '{$_SESSION['username']}' AND is_admin = 1";
            $result = $conn->query($query);
            if($result->num_rows == 0){
                printf("<meta http-equiv=\"refresh\" content=\"3; url='%s/index.php'\" />", $serverAddress);
                require_modal();
                modal_msg(array("You are not admin. Illegal Access...<br>Auto Redirect After 3 Seonds"), "Illegal Access", "{$serverAddress}/index.php");
                die();
            }
            $result->free();
            $conn->close();
        } else {
            $valid = false;
        }
    } else{
        $valid = false;
    }

    if(!$valid){
        printf("<meta http-equiv=\"refresh\" content=\"3; url='%s/signin.php'\" />", $serverAddress);
        require_modal();
        modal_msg(array("You haven't logged in yet...<br>Auto Redirect After 3 Seconds"), "Please Log In", "{$serverAddress}/signin.php");
        die();
    }
?>