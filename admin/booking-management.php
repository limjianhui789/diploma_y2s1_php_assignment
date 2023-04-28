<?php
    require_once("./includes/permision_checker.php");
?>
<html lang="en">
    <head>
        <title>Nitro Society - Booking Management</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/style.css">

    </head>
    <body style="background-image: url('./image/add_page_background.png');">
        <?php
            require_once("./includes/header.php");
        ?>
        <!-- Navigate -->
        <div class="cotainer-fluid">
                <div class="row mt-5 mx-5">
                    <div class="col">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb align-self-center">
                                <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                                <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Check Booking</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        <!-- Navigate -->

        <div class="container">
            <div class="row justify-content-between px-5 pt-5 pb-3 ">
                    <div class="col">
                        <p class="fs-3 fw-bold m-0" id="eventList_title">Event List</p>
                    </div>
                    <div class="col-auto">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-search px-4" onclick="jump_to('./booking-search.php')"><i class="bi bi-escape"></i> Search User Related Booking</button>
                        </div>
                    </div>
                </div>
            <div class="row row-cols-lg-4 mt-lg-3 g-lg-4 d-flex justify-content-center">
                <?php
                        require_once("./includes/sql_connection.php");
                        require_once("./includes/getEventList.php");
                        require_once("./includes/getEventStatus.php");
                        require_once("./includes/getServerAddr.php");
                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $eventList = request_events();

                        //Update Title
                        $totalEvent = $eventList->num_rows;
                        printf( '<script>document.getElementById("eventList_title").innerText = "Event List (%d)"</script>', $totalEvent);

                        while($row = $eventList->fetch_object()){
                            //Handle Status
                            $eventStartDate = date('Y-m-d',strtotime($row->eventStartDate));
                            $eventEndDate = date('Y-m-d',strtotime($row->eventEndDate));
                            $eventStartTime = date('h:i A', strtotime($row->eventStartTime));
                            $eventEndTime = date('h:i A', strtotime($row->eventEndTime));
                            $eventStatus = getStatus($eventStartDate, $eventEndDate, $eventStartTime, $eventEndTime); //It will define $eventStatus 
                            //Handle Image
                            $image = "/".$row->posterURL;
                            if($eventStatus == "Ongoing"){
                                $eventStatusColor = "success";
                            }else if($eventStatus == "Expired"){
                                $eventStatusColor = "secondary";
                            }else{
                                $eventStatusColor = "danger";
                            }
                            if($row->is_deleted == 1){
                                $eventStatus = "Deleted";
                                $eventStatusColor = "secondary";
                            }
                            printf('
                            <div class="col-lg-auto my-3">
                                <div class="card h-100 mx-auto" style="width: 18rem;">
                                    <div class="row position-absolute w-100 mx-3 p-3">
                                        <div class="col text-end">
                                            <span class="badge rounded-pill text-bg-%s ">%s</span>
                                        </div>
                                    </div>
                                    <img src="%s" class="card-img-top" alt="Poster Image">
                                    <div class="card-body">
                                        <h5 class="card-title">%s</h5>
                                        <p class="card-text">
                                        %s
                                        </p>

                                        
                                    </div>
                                    <div class="card-footer">
                                        <div class="row g-2 mx-auto">
                                            <div class="col">
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-primary-bg" onclick="location.href = \'booking-details.php?eventID=%s\'">Booking Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ',$eventStatusColor, $eventStatus, $image, $row->eventName, $row->eventDesc, $row->eventID);
                        }
                    ?>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script>
            function jump_to(url){
                $(document).ready(function(){
                    $("body").fadeOut(500, function(){
                        location.href = url;
                    });
                });
            }
        </script>
    </body>
</html>