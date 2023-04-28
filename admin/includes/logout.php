<?php 
    require_once("modal_msg.php");
    require_once("permision_checker.php");
    require_once("getServerAddr.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_modal();
        if(isset($_POST['logout'])){
            $username = $_SESSION['username'];
            modal_msg(array("Successfully Logout ({$username})"), "Logout Message", "/signin.php");
            //printf("<meta http-equiv=\"refresh\" content=\"0; url='http://%s/index.php'\" />", $_SERVER['HTTP_HOST']);
            $_SESSION = array();
            session_destroy();
        } else {
            modal_msg(array("Illegal Direct Access"), "Error", "/index.php");
        }
    } else {
        modal_msg(array("Illegal Direct Access"), "Error", "/index.php");
    }
?>