<?php
    require_once("./includes/sql_connection.php");
    require_once("./includes/permision_checker.php");
    require_once("./includes/modal_msg.php");
?>
<html lang="en">

    <head>
        <title>Creative Event - Booking Management</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <?php
            require_modal();
        ?>
        <link type="text/css" rel="stylesheet" href="css/style.css">

    </head>
    <body style="background-image: url('./image/add_page_background.png');">
        <?php
            require_once("./includes/header.php");
            if(!isset($_GET['eventID'])){
                modal_msg(array("Illegal Access"), "Error", "history.back()");
                die();
            }

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['remove_booking'])){
                    //Update Booking is_delete = 1
                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $bookingID = $_POST['remove_booking'];
                    $query = "
                        UPDATE nitro_booking SET is_delete = 1 WHERE bookingID = {$bookingID}
                    ";
                    $conn->query($query);
                    modal_msg(array("Booking Successfully Deleted"), "Success", "");
                    $conn->close();

                }else if(isset($_POST['undo_booking'])){
                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $bookingID = $_POST['undo_booking'];
                    $query = "
                        UPDATE nitro_booking SET is_delete = 0 WHERE bookingID = {$bookingID}
                    ";
                    $conn->query($query);
                    modal_msg(array("Booking Successfully Recovered"), "Success", "");
                    $conn->close();
                }
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
                                <li class="breadcrumb-item" aria-current="page"><a href="./booking-management.php">Check Booking</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Booking Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        <!-- Navigate -->
        <?php
            if(isset($_GET['eventID'])){
                require_once("./includes/sql_connection.php");
                require_once("./includes/getServerAddr.php");
                require_once("./includes/getEventStatus.php");
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $query = "
                    SELECT *
                    FROM nitro_event E, nitro_poster P
                    WHERE eventID = {$_GET['eventID']}
                    AND E.posterID = P.posterID;
                ";
                $result = $conn->query($query);
                while($row = $result->fetch_object()){
                    //Handle Status
                    $eventStartDate = date('d-m-Y',strtotime($row->eventStartDate));
                    $eventEndDate = date('d-m-Y',strtotime($row->eventEndDate));
                    $eventStartTime = date('h:i A', strtotime($row->eventStartTime));
                    $eventEndTime = date('h:i A', strtotime($row->eventEndTime));
                    $eventStatus = getStatus($eventStartDate, $eventEndDate, $eventStartTime, $eventEndTime); //It will define $eventStatus 
                    $eventStatusColor = getStatusColor($eventStatus);
                    //Handle Image
                    $image = "/".$row->posterURL;
                    echo '<div class="container rounded-3 p-lg-5 p-3" style="background-color: #F9FAFC;">';

                    printf('
                    <div class="row justify-content-between">
                        <div class="col-auto align-self-center">
                            <p class="m-0 fw-semibold fs-4 d-inline" style="color: #4A6C73;">Booking Details</p>
                        </div>
                        <div class="col-auto align-self-center">
                            <span class="badge bg-%s fs-6">%s</span>
                        </div>
                        <hr class="my-3">
                    </div>
                    ', $eventStatusColor,$eventStatus);

                    printf('
                    <div class="row">
                        <div class="col-lg-3">
                            <img class="img-fluid rounded-3" src="%s" alt="Event Image">
                        </div>
                        <div class="col">
                            <table class="table h-100 align-middle">
                                <tbody>
                                    <tr>
                                        <th class="w-25">Event Title</th>
                                        <td>%s</td>
                                    </tr>
                                    <tr>
                                        <th>Event Description</th>
                                        <td>%s</td>
                                    </tr>
                                    <tr>
                                        <th>Event Category</th>
                                        <td>%s</td>
                                    </tr>
                                    <tr>
                                        <th>Event Seat</th>
                                        <td>%s/%s</td>
                                    </tr>
                                    <tr>
                                        <th>Event Status</th>
                                        <td>%s</td>
                                    </tr>
                                    <tr>
                                        <th>Price Per Person</th>
                                        <td>%s</td>
                                    </tr>
                                    <tr>
                                        <th>Start Date & Time</th>
                                        <td>%s %s</td>
                                    </tr>
                                    <tr>
                                        <th>End Date & Time</th>
                                        <td>%s %s</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    ',$image, $row->eventName, $row->eventDesc, $row->categoryName, $row->seatAvailable,$row->eventSeats, $eventStatus, $row->pricePerPax > 0 ? "RM ".$row->pricePerPax : "Free", $eventStartDate, $eventStartTime, $eventEndDate, $eventEndTime);
                }
                $conn->close();


            }
        ?>

            <div class="row">
                <div class="col">
                    <p class="fs-3 fw-semibold" style="color: #4A6C73;">Event Booking Users</p>
                        <div class="table-responsive-sm">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Student ID</th>
                                    <th>Booking Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $eventID = $_GET['eventID'];
                                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                    $query = "
                                    SELECT bookingID, username, studentID, bookingDate, bookingTime, is_delete
                                    FROM nitro_booking
                                    WHERE eventID = {$eventID}
                                    ORDER BY is_delete ASC,bookingID ASC
                                    ";
                                    $result = $conn->query($query);
                                    while($row = $result->fetch_object()){
                                        $bookingDate = $row->bookingDate;
                                        $bookingTime = $row->bookingTime;
                                        $date = date_create("{$bookingDate} {$bookingTime}");
                                        if($row->is_delete == 0){
                                            printf('
                                            <tr>
                                                <td>%s</td>
                                                <td>%s</td>
                                                <td>%s</td>
                                                <td class="w-25">
                                                    <div class="col">
                                                        <form action="booking-user-details.php" method="GET" class="m-0">
                                                            <div class="row g-2">
                                                                <div class="col d-grid">
                                                                    
                                                                    <input type="hidden" name="bookingID" value="%s">
                                                                    <input type="submit" class="btn btn-primary-bg" value="Details">
                                                                </div>
                                                                <div class="col d-grid">
                                                                    <input type="button" class="btn btn-danger" value="Remove" data-bs-toggle="modal" data-bs-target="#delete_modal" onclick="chg_value(\'remove_booking\', %d)">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            ', $row->username, $row->studentID, date_format($date, 'd-m-Y h:i A'), $row->bookingID, $row->bookingID);
                                        } else{
                                            printf('
                                            <tr class="table-secondary" style="cursor: not-allowed;">
                                                <td>%s</td>
                                                <td>%s</td>
                                                <td>%s</td>
                                                <td class="w-25">
                                                    <div class="col">
                                                        <form action="booking-user-details.php" method="GET" class="m-0">
                                                            <div class="row g-2">
                                                                <div class="col d-grid">
                                                                    <input type="hidden" name="bookingID" value="%s">
                                                                    <input type="submit" class="btn btn-secondary" value="Details">
                                                                </div>
                                                                
                                                                <div class="col d-grid">
                                                                <input type="button" class="btn btn-secondary" value="Undo" data-bs-toggle="modal" data-bs-target="#undo_modal" onclick="chg_value(\'undo_booking\', %d)">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                        </tr>
                                        ', $row->username, $row->studentID, date_format($date, 'd-m-Y h:i A'), $row->bookingID, $row->bookingID);

                                        }
                                        
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                        </div>
                </div>
            </div>

            <br><hr>
            <!-- Ticket List -->
            <div class="row">
                    <div class="col">
                        <p class="fs-3 fw-semibold" style="color: #4A6C73;">Ticket List</p>
                            <div class="table-responsive-sm">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Booking ID</th>
                                        <th>Ticket ID</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $eventID = $_GET['eventID'];
                                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                        $query = "
                                        SELECT B.bookingID, B.username, T.ticketID, T.is_used
                                        FROM nitro_ticket T
                                        INNER JOIN nitro_booking B ON T.bookingID = B.bookingID
                                        WHERE B.eventID = {$eventID}
                                        ORDER BY T.is_used ASC, T.TicketID
                                        ";
                                        $result = $conn->query($query);
                                        while($row = $result->fetch_object()){
                                            if($row->is_used == 1){
                                                $ticket_status = '<h5><span class="badge bg-danger">Used</span></h5>';
                                                printf('
                                                    <tr>
                                                        <td>%s</td>
                                                        <td>%s</td>
                                                        <td>%s</td>
                                                        <td>%s</td>
                                                        <td class="w-25">
                                                            <div class="col">
                                                                <div class="row g-2">
                                                                    <div class="col d-grid">
                                                                        <input type="button" class="btn btn-primary-bg" value="Ticket" onclick="location.href = \'../ticket.php?bookingID=%s#ticket_%d\'">
                                                                    </div>
                                                                    <div class="col d-grid">
                                                                        <input type="button" class="btn btn-secondary" style="cursor: not-allowed;" value="Use">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    ', $row->username, $row->bookingID, $row->ticketID, $ticket_status, $row->bookingID, $row->ticketID);

                                            } else{
                                                $ticket_status = '<h5><span class="badge bg-success">Available</span></h5>';
                                                printf('
                                                    <tr>
                                                        <td>%s</td>
                                                        <td>%s</td>
                                                        <td>%s</td>
                                                        <td>%s</td>
                                                        <td class="w-25">
                                                            <div class="col">
                                                                <form action="booking-user-details.php" method="GET" class="m-0">
                                                                    <div class="row g-2">
                                                                        <div class="col d-grid">
                                                                            <input type="button" class="btn btn-primary-bg" value="Ticket" onclick="location.href = \'../ticket.php?bookingID=%s#ticket_%d\'">
                                                                        </div>
                                                                        <div class="col d-grid">
                                                                            <input type="button" class="btn btn-success" value="Use" data-bs-toggle="modal" data-bs-target="#use_modal" onclick="chg_value(\'use_ticket\', %d);chg_value(\'use_booking\', %d)">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    ', $row->username, $row->bookingID, $row->ticketID, $ticket_status,$row->bookingID, $row->ticketID, $row->ticketID, $row->bookingID);
                                            }

                                            
                                        }
                                        $conn->close();
                                    ?>
                                </tbody>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Use Ticket Confirmation Modal -->
        <form action="../ticket.php" method="GET">
            <div class="modal fade" id="use_modal" tabindex="-1" >
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to use this ticket ? 
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="1" name="from_other">
                        <input type="hidden" value="" name="bookingID" id="use_booking">
                        <input class="btn-check" type="submit" value="" name="ticketID" id="use_ticket">
                        <label for="use_ticket" class="btn btn-success">Confirm</label>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Use Ticket Confirmation Modal -->

        <!-- Delete Confirmation Modal -->
        <form action="" method="POST">
            <div class="modal fade" id="delete_modal" tabindex="-1" >
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete this booking ?
                    </div>
                    <div class="modal-footer">
                        <input class="btn-check" type="submit" value="" name="remove_booking" id="remove_booking">
                        <label for="remove_booking" class="btn btn-danger">Confirm</label>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Delete Confirmation Modal -->

        <!-- Undo Confirmation Modal -->
        <form action="" method="POST">
            <div class="modal fade" id="undo_modal" tabindex="-1" >
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Undo Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to recover this booking ?
                    </div>
                    <div class="modal-footer">
                        <input class="btn-check" type="submit" value="" name="undo_booking" id="undo_booking">
                        <label for="undo_booking" class="btn btn-warning">Confirm</label>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Undo Confirmation Modal -->

        <script>
            function chg_value(id, Tvalue){
                document.getElementById(id).value = Tvalue;
            }
        
        </script>
    </body>
</html>