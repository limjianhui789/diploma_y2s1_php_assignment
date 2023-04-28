<?php 
    require_once("./includes/permision_checker.php");
    require_once("./includes/getServerAddr.php");
?>
<html lang="en">
    <head>
        <title>Nitro Society - Event List</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/search_bar.css">
    </head>
<body style="background-image: url('./image/add_page_background.png');">
    
    <?php
        include_once("./includes/header.php");

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if(isset($_POST['details'])){
                $eventID = $_POST['target'];
                
                //Handle Event Details 
                $query = "SELECT * FROM nitro_event WHERE is_deleted = 0 AND is_draft = 0 AND eventID = {$eventID}";
                $result = $conn->query($query);
                while($row = $result->fetch_object()){
                    //Handle Image
                    $query = "SELECT posterURL FROM nitro_event E, nitro_poster P WHERE E.posterID = P.posterID AND E.eventID = {$row->eventID}";
                    $img_result = $conn->query($query);
                    while($img_row = $img_result->fetch_object()){
                        $image = $serverAddress.$img_row->posterURL;
                    }

                    //Handle Category
                    $query = "SELECT C.categoryName FROM nitro_event E, nitro_category C WHERE E.categoryName = C.categoryName AND E.eventID = {$row->eventID}";
                    $category_result = $conn->query($query);
                    while($category_row = $category_result->fetch_object()){
                        $category = $category_row->categoryName;
                    }
                    
                    //Handle Venue
                    $query = "SELECT V.venueName FROM nitro_event E, nitro_venue V WHERE E.venueName = V.venueName AND E.eventID = {$row->eventID}";
                    $venue_result = $conn->query($query);
                    while($venue_row = $venue_result->fetch_object()){
                        $venue = $venue_row->venueName;
                    }
                    
                    //Handle Date Time
                    $eventStartDate = date('Y-m-d',strtotime($row->eventStartDate));
                    $eventEndDate = date('Y-m-d',strtotime($row->eventEndDate));
                    $eventStartTime = date('h:i A', strtotime($row->eventStartTime));
                    $eventEndTime = date('h:i A', strtotime($row->eventEndTime));
                    
                    printf('
                    <!-- Event Details Modal -->
                    <div class="modal fade" id="preview_modal" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" >
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Event Details (ID: %s)</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.href = \'%s\'"></button>
                            </div>
                            <div class="modal-body">
                            <div class="container">
                                <div class="row m-3">
                                    <div class="col">
                                        <div class="card mb-3" >
                                            <div class="row g-0">
                                                <div class="col-lg-4">
                                                    <img src="%s" id="preview_img" class="img-fluid rounded-start" alt="Preview Image">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title" id="preview_title">%s</h5>
                                                            <p class="card-text" id="preview_desc">
                                                                %s
                                                            </p>
                                                            
                                                            <!-- General Info -->
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p>
                                                                        <i class="bi bi-bookmark-star"></i>
                                                                        <strong>Event Category</strong>
                                                                        <br class="d-lg-none">
                                                                        <span id="preview_category" class="badge rounded-pill text-bg-secondary">
                                                                            %s
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
        
                                                            <div class="row">
                                                                    <div class="col">
                                                                        <p>
                                                                            <i class="bi bi-geo-alt"></i>
                                                                            <strong>Event Location</strong>
                                                                            <br class="d-lg-none">
                                                                            <span id="preview_location" class="badge rounded-pill text-bg-secondary">
                                                                                %s
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
        
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p>
                                                                        <i class="bi bi-people-fill"></i>
                                                                        <strong>Event Seats</strong>
                                                                        <br class="d-lg-none">
                                                                        <span class="badge rounded-pill text-bg-secondary">
                                                                            <output id="preview_seat">%d</output>/<output id="preview_maxSeat">%d</output>
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
        
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p>
                                                                        <i class="bi bi-currency-dollar"></i>
                                                                        <strong class="d-none d-lg-inline">Price Per Person</strong>
                                                                        <strong class="d-lg-none">Price/Person</strong>
                                                                        <br class="d-lg-none">
                                                                        <span class="badge rounded-pill text-bg-secondary">
                                                                        <output id="preview_price">%s</output>
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
        
                                                            <br>
                                                            <!-- General Info -->
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item list-group-item-dark ">Start Date & Time <i class="bi bi-calendar-week"></i></li>
                                                                        <li class="list-group-item" id="preview_startDate">%s</li>
                                                                        <li class="list-group-item" id="preview_startTime">%s</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item list-group-item-dark ">End Date & Time <i class="bi bi-calendar-week"></i></li>
                                                                        <li class="list-group-item" id="preview_endDate">%s</li>
                                                                        <li class="list-group-item" id="preview_endTime">%s</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href=\'%s\'">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    ', $eventID, $_SERVER['PHP_SELF'], $image, $row->eventName, $row->eventDesc, $category, $venue,$row->seatAvailable,$row->eventSeats ,$row->pricePerPax == 0.0 ? "Free" : "RM ".$row->pricePerPax, $eventStartDate, $eventStartTime, $eventEndDate, $eventEndTime, $_SERVER['PHP_SELF']);
                }
    
                echo '
                <script>
                    const myModal = new bootstrap.Modal("#preview_modal", {
                        keyboard: false
                        })
                    myModal.show()
                </script>
                ';
                die();

            //If Delete Is Set
            }else if(isset($_POST['delete'])){
                //Delete Event
                $eventID = $_POST['target'];
                $query = "UPDATE nitro_event SET is_deleted = 1 WHERE eventID = {$eventID}";
                $conn->query($query);
                modal_msg(array("Successfully Deleted The Event "), "Event Delete", "{$_SERVER['PHP_SELF']}");
            }
            
            $conn->close();
        }
    ?>
    <!-- Navigate -->
    <div class="cotainer-fluid">
        <div class="row mt-5 mx-5">
            <div class="col">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb align-self-center">
                        <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                        <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Event List</li>
                    </ol>

                </nav>
            </div>
        </div>
    </div>
    <!-- Navigate -->
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-6">
                    <div class="form">
                        <i class="bi bi-search"></i>
                        <input type="text" id="search_bar" class="form-control form-input" placeholder="Search By Event Name Or Category" onchange="searchEvent(this.value)">
                        <span class="left-pan"><i class="bi bi-calendar3-event"></i></span>
                    </div>
                </div>
            </div>

            <div id="search_div" class="row row-cols-lg-4 mt-lg-3 g-lg-4 d-flex justify-content-center">
                <!-- Add Card -->
                <div class="col-lg-auto my-3">
                    <div class="card h-100 mx-auto" style="width: 18rem;">
                        <div class="row position-absolute w-100 mx-3 p-3">
                            <div class="col text-end">
                                <span class="badge rounded-pill text-bg-success">Add New Event</span>
                            </div>
                        </div>
                        <img src="./image/add_poster.png" class="card-img-top" alt="Poster Image" onclick="location.href = './event-add.php'" style="cursor: pointer;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Add New Event</h5>
                            <p class="card-text">
                            
                            </p>

                            
                        </div>
                        <div class="card-footer">
                            <div class="row g-2 mx-auto">
                                <div class="col">
                                    <div class="d-grid">
                                        <button class="btn btn-success" onclick="location.href='./event-add.php'">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Card -->

                <?php 
                    require_once("includes/getEventStatus.php");
                    require_once("includes/getEventList.php");
                    $result = request_events();
                    
                    //Showing Event List 
                    while($row = $result->fetch_object()){
                        //Handle Image
                        $image = $serverAddress.$row->posterURL;
                        
                        if($row->is_deleted == 0){
                            //Handle Status
                            $eventStartDate = date('Y-m-d',strtotime($row->eventStartDate));
                            $eventEndDate = date('Y-m-d',strtotime($row->eventEndDate));
                            $eventStartTime = date('h:i A', strtotime($row->eventStartTime));
                            $eventEndTime = date('h:i A', strtotime($row->eventEndTime));
                            $eventStatus = getStatus($eventStartDate, $eventEndDate, $eventStartTime, $eventEndTime); //It will define $eventStatus 
                            if($eventStatus == "Ongoing"){
                                $eventStatusColor = "success";
                            }else if($eventStatus == "Expired"){
                                $eventStatusColor = "secondary";
                            }else{
                                $eventStatusColor = "danger";
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
                                    <form method="POST" action="">
                                    <div class="card-footer">
                                        <div class="row g-2 mx-auto">
                                            <div class="col">
                                                <div class="d-grid">
                                                    <button type="submit" name="details" class="btn btn-primary-bg">Details</button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="d-grid">
                                                    <button type="button" onclick="location.href = \'./event-edit.php?eventID=%s\'" class="btn btn-primary-bg">Edit</button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="d-grid">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#qr_modal" class="btn btn-primary-bg" onclick="getQR(%d);">QR</button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="d-grid">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-danger" value="%s" onclick="change_target(\'delete\', this.value)">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="target" value="%s">
                                    </form>
                                </div>
                            </div>
                            ',$eventStatusColor ,$eventStatus, $image, $row->eventName, $row->eventDesc, $row->eventID,$row->eventID,$row->eventID ,$row->eventID);
                        }else{
                            $eventStatus = "Deleted";
                            $eventStatusColor = "secondary";
                    
                            printf('
                            <div class="col-lg-auto my-3">
                                <div class="card text-bg-secondary h-100 mx-auto" style="width: 18rem;">
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
                                </div>
                            </div>
                            ',$eventStatusColor ,$eventStatus, $image, $row->eventName, $row->eventDesc);
                        }
                    }
                ?>
            </div>
            
            <!-- QR CODE Modal -->
            <div class="modal fade" id="qr_modal" tabindex="-1" >
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">QR For Join Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mx-auto d-block w-50" id="qr_image" src="./image/qrcode.png" alt="QR CODE">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
            <!-- QR CODE Modal -->

            <form method="POST" action="">
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="delete_modal" tabindex="-1" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure want to delete this event ?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="delete" class="btn btn-danger" data-bs-dismiss="modal">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Confirmation Modal -->
                    <input type="hidden" id="delete" name="target" value="">
                </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="js/qr_accessToken.js">
        //Get the QR API Info Eg. Access Token, URL
        //Global Variable
            //var access_token > QR CODE API Access Token
            //var qrAPI_url > url to request the qr code through QR API
        </script>  
        <script>
            $(document).ready(function(){
                $("#search_bar").keypress(function(){
                    $("#search_div").fadeOut(1000, function(){
                        displayNone();
                    });
                    
                });
                $("#search_bar").mouseleave(function(){
                    $("#search_bar").blur();
                });
            });
            function displayNone(){
                $("#search_div").attr("style", "display:none!important");
            }
            function searchEvent(content){
                content = encodeURIComponent(content);
                var xmlhttp;
                if(window.XMLHttpRequest){
                    xmlhttp = new XMLHttpRequest();
                }else{
                    xmlhttp = new ActiveXObject(Microsoft.XMLHttpRequest);
                }
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        $(document).ready(function(){
                            if(xmlhttp.responseText == ""){
                                document.getElementById("search_div").innerHTML = "<h2><span class='badge text-bg-info text-white'>Event Not Found</span></h2>";
                            }else{
                                document.getElementById("search_div").innerHTML = xmlhttp.responseText;
                            }
                            
                            $("#search_div").fadeIn();
                        });
                        
                    }
                };
                xmlhttp.open("GET", `includes/searchEvent.php?search=${content}`, true);
                xmlhttp.send();
            }

            function getQR(eventID){
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
                    url = url.slice(0, index );
                }
                url = encodeURIComponent(`${url}/../../eventDetail.php?eventID=${eventID}`);
                xmlhttp.send(`frame_name=no-frame&qr_code_text=${url}&image_format=PNG&qr_code_logo=scan-me-square&image_width=600&marker_left_template=version11&marker_right_template=version11&marker_bottom_template=version11`);
                
                xmlhttp.onreadystatechange=function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        
                        document.getElementById("qr_image").src = window.URL.createObjectURL(xmlhttp.response);
                    }
                };
            }
            
            function change_target(id, value){
                document.getElementById(id).value = value;
            }
        </script>
        
</body>
</html>