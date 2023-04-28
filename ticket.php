<?php
    session_start();
    require_once("./admin/includes/sql_connection.php");
    require_once("./admin/includes/modal_msg.php");
?>
<html>
    <head>
        <title>Nitro Society - Ticket</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <?php 
                require_modal();
            ?>
            <link rel="icon" type="image/x-icon" href="image/favicon.ico">
    </head>
    <body class="bg-black">
        <!-- Handle Illegal Access & User Not Logged In -->
        <?php 
            if(!isset($_SESSION['username'])){
                modal_msg(array("Illegal Access, Please Login"), "Error", "index.php");
                die();
            }

            if(!isset($_GET['bookingID'])){
                modal_msg(array("Illegal Access"), "Error", "history.back()");
                die();
            }else{
                //Check BookingID IS Belong to user or not
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $bookingID = $_GET['bookingID'];
                $query = "SELECT username FROM nitro_booking WHERE bookingID = {$bookingID}";
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    //If Booking Found & Check This Booking Is Belong To User Or NOT ( ADMIN ALSO CAN ACCESS )
                    $row = $result->fetch_object();
                    if($row->username !== $_SESSION['username']){
                        
                        $query = "SELECT is_admin FROM nitro_user WHERE username = '{$_SESSION['username']}'";
                        $result = $conn->query($query);
                        $row = $result->fetch_object();
                        if($row->is_admin != 1){
                            modal_msg(array("Illegal Access, This Booking Is Not Belong To You."), "Error", "history.back()");
                            die();
                        }
                    }
                }else{
                    modal_msg(array("Booking ID Not Found"), "Error", "history.back()");
                    die();
                }
                $conn->close();
            }
            
        ?>

        <!-- Handle Ticket Redeem -->
        <?php

            if($_SERVER['REQUEST_METHOD'] == "GET"){
                if(isset($_GET['ticketID'])){
                    $ticketID = $_GET['ticketID'];
                    //Check User Permission Is Admin Or Not
                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $query = "SELECT username, is_admin FROM nitro_user WHERE username = '{$_SESSION['username']}'";
                    $result = $conn->query($query);
                    $row = $result->fetch_object();
                    if($row->is_admin == 1){
                        $query = "SELECT is_used FROM nitro_ticket WHERE ticketID = {$ticketID}";
                        $result = $conn->query($query);
                        if($result->num_rows > 0){
                            $query = "UPDATE nitro_ticket SET is_used = 1 WHERE ticketID = {$ticketID}";
                            $result = $conn->query($query);
                            if($conn->affected_rows > 0){
                                if(isset($_GET['from_other'])){
                                    modal_msg(array("Ticket ID : {$ticketID}<br>Info : Successfully Use The Ticket"), "Info", "history.back()");
                                    exit();
                                }else{
                                    modal_msg(array("Ticket ID : {$ticketID}<br>Info : Successfully Use The Ticket"), "Info", "");
                                }
                            } else {
                                modal_msg(array("Ticket ID : {$ticketID}<br>Info : Already Used Before"), "Info", "history.back()");
                                exit();
                            }
                        } else {
                            modal_msg(array("Ticket ID : {$ticketID}<br>Info : Ticket Not Found"), "Info", "history.back()");
                            exit();
                        }
                    } else {
                        modal_msg(array("Ticket ID : {$ticketID}<br>Info : Permission Denied ({$row->username})"), "Info", "history.back()");
                        exit();
                    }
                    $conn->close();
                }
            }
            
        ?>
        <!-- Handle QR CODE -->
        <script src="admin/js/qr_accessToken.js">
        //Get the QR API Info Eg. Access Token, URL
        //Global Variable
            //var access_token > QR CODE API Access Token
            //var qrAPI_url > url to request the qr code through QR API
        </script>  
        <script>
            function getQR(id, ticketID){
                var xmlhttp;
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest();
                }else{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.responseType = "blob";
                xmlhttp.open("POST", qrAPI_url, true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var url = window.location.href;
                var index = url.indexOf('#');
                if(index !== -1){
                    url = url.slice(0, index);
                }
                url = encodeURIComponent(`${url}&ticketID=${ticketID}`);
                xmlhttp.send(`frame_name=no-frame&qr_code_text=${url}&image_format=PNG&qr_code_logo=scan-me-square&image_width=600&marker_left_template=version11&marker_right_template=version11&marker_bottom_template=version11`);
                xmlhttp.onreadystatechange=function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        document.getElementById(id).src = window.URL.createObjectURL(xmlhttp.response);
                    }
                };
            }
        </script>

        <!-- Showing Tickets -->
        <?php
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "
                SELECT E.eventName, E.eventStartDate, E.eventStartTime, E.eventEndDate, E.eventEndTime, E.categoryName, E.venueName, U.username, T.ticketID, T.is_used, T.bookingID
                FROM nitro_booking B
                INNER JOIN nitro_user U ON B.username = U.username
                INNER JOIN nitro_ticket T ON B.bookingID = T.bookingID
                INNER JOIN nitro_event E ON B.eventID = E.eventID
                WHERE B.bookingID = {$_GET['bookingID']};
            ";
            $result = $conn->query($query);
            while($row = $result->fetch_object()){
                
                $startDate = date_create($row->eventStartDate);
                $startDate = date_format($startDate, "d-m-Y");
                $startTime = date_create($row->eventStartTime);
                $startTime = date_format($startTime, "h:i A");

                $endDate = date_create($row->eventEndDate);
                $endDate = date_format($endDate, "d-m-Y");
                $endTime = date_create($row->eventEndTime);
                $endTime = date_format($endTime, "h:i A");

                if($row->is_used == 1){
                    $button_status = "disabled";
                    $used_status = '<span class="badge text-bg-danger"><i class="bi bi-check-all"></i></span>';
                }else{
                    $button_status = "";
                    $used_status = '<span class="badge text-bg-success"><i class="bi bi-check"></i></span>';
                }

                printf('
                    <div class="container">
                        <div class="row m-lg-5 justify-content-center">
                            <div class="col-lg-9 bg-white rounded-2">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col px-lg-5 pt-3 px-3">
                                        <p class="m-0 fs-4 fw-semibold">%s %s</p> <!-- Param 1 --> <!-- Param 1.1 -->
                                    </div>
                                    <div class="col-auto d-lg-flex d-none px-lg-5 pt-3">
                                        <p class="m-0 text-black-50 fw-semibold">Username : %s</p> <!-- Param 2 -->
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col px-lg-5 px-3">
                                        <p class="m-0 text-black-50 fw-semibold">Venue : %s</p> <!-- Param 3 -->
                                    </div>
                                    <div class="col-auto px-lg-5 px-3">
                                        <p class="m-0 fw-semibold text-black-50 fw-semibold text-end">%s</p> <!-- Param 4 -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-lg-3 justify-content-center">
                                        <img class="img-fluid mx-auto" id="img_%d" src="./image/ticket-qr.png" alt="Ticket QR CODE"> <!-- Param 4.1 -->
                                        <script>
                                            getQR("img_%d", %d) <!-- Param 4.2 --> <!-- Param 4.3 -->
                                        </script>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 d-grid">
                                        <button class="btn btn-primary" id="ticket_%d" onclick="location.href = \'./ticket.php?bookingID=%d&ticketID=%d\'" %s>Ticket ID : %d</button> <!-- Param 4.4 --> <!-- Param 4.5 --> <!-- Param 5 -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row justify-content-between">
                                    <div class="col px-5">
                                        <p class="m-0 text-dark-50 fw-semibold">Start Date</p>
                                    </div>
                                    <div class="col px-5">
                                        <p class="m-0 text-dark-50 fw-semibold">Start Time</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col px-5">
                                        <p class="text-dark-50">%s</p> <!-- Param 6 -->
                                    </div>
                                    <div class="col px-5">
                                        <p class="text-dark-50">%s</p> <!-- Param 7 -->
                                    </div>
                                </div>

                                <div class="row justify-content-between">
                                    <div class="col px-5">
                                        <p class="m-0 text-dark-50 fw-semibold">End Date</p>
                                    </div>
                                    <div class="col px-5">
                                        <p class="m-0 text-dark-50 fw-semibold">End Time</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col px-5">
                                        <p class="text-dark-50">%s</p> <!-- Param 8 -->
                                    </div>
                                    <div class="col px-5">
                                        <p class="text-dark-50">%s</p> <!-- Param 9 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                ',$row->eventName,$used_status, $row->username, $row->venueName, $row->categoryName,$row->ticketID,$row->ticketID, $row->ticketID,$row->ticketID,$row->bookingID,$row->ticketID,$button_status,$row->ticketID, $startDate, $startTime, $endDate, $endTime);
            }
            $result->free();
            $conn->close();
        ?>
        
    </body>
</html>