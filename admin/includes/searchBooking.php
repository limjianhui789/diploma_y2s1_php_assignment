<?php 
    require_once('sql_connection.php');
    require_once("getEventList.php");
    require_once("getEventStatus.php");
    require_once("getServerAddr.php");
    if(isset($_GET['search'])){
        $content = $_GET['search'];
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "
        SELECT DISTINCT posterURL, E.eventID, eventName, eventDesc, eventStartDate, eventStartTime, eventEndDate, eventEndTime, is_deleted
        FROM nitro_event E, nitro_poster P, nitro_booking B
        WHERE is_draft = 0
        AND E.posterID = P.posterID
        AND B.eventID = E.eventID
        AND (B.username LIKE '%{$content}%' OR B.studentID LIKE '%{$content}%')
        ORDER BY is_deleted ASC, eventStartDate DESC, eventStartTime DESC
        ";
        $result = $conn->query($query);
        //Update Title
        $totalEvent = $result->num_rows;
        printf( '<output id="totalEvent" class="btn-check">%d</output>', $totalEvent);

        while($row = $result->fetch_object()){
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
        $conn->close();
    }
?>