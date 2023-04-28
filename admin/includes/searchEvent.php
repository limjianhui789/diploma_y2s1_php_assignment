<?php 
    require_once("getEventStatus.php");
    require_once("getServerAddr.php");
    require_once("getEventList.php");
    if(!isset($_GET['search'])){
        die("Illegal Access");
    }
    $search_content = rawurldecode($_GET['search']);
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "
        SELECT posterURL, eventID, eventName, eventDesc, eventStartDate, eventStartTime, eventEndDate, eventEndTime, is_deleted
        FROM nitro_event E, nitro_poster P 
        WHERE is_draft = 0 
        AND E.posterID = P.posterID
        AND (eventName LIKE '%{$search_content}%' OR categoryName LIKE '%{$search_content}%')
        ORDER BY is_deleted ASC
        ";
    $result = $conn->query($query);
    //Showing Event List 
    while($row = $result->fetch_object()){
        //Handle Image
        $image = "/" + $row->posterURL;
        
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

    $conn->close();
?>