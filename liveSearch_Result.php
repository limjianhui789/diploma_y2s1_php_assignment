<?php
require_once("./includes/database-connector.php");

if(isset($_POST['input'])){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($con->connect_error);
    
    $searchbox = $_POST['input'];
    
    
    $query = "
        SELECT *
        FROM nitro_event E, nitro_poster P
        WHERE E.posterID = P.posterID 
        AND is_deleted = 0
        AND is_draft = 0
        AND (E.eventName LIKE '%{$searchbox}%' OR E.eventDesc LIKE '%{$searchbox}%')
    ";
    
    $result = $conn->query($query);
    
    while($row = $result->fetch_object()){
        
        $eventID = $row->eventID;
        $eventName = $row->eventName;
        $eventDesc = $row->eventDesc;
        $posterURL =$row->posterURL;
        $seatAvailable =$row->seatAvailable;
        
        //print_r($row);

        printf('
                <div class="search-result-container container mt-3 ">
                    <div class="row col-12 border">
                        <div class="col-sm-2 col-md-3 col-lg-3 col-xl-3 d-flex flex-row-reverse p-3" style="width: 170px;">
                            <img src="%s" alt="" style="width: 140px; height: auto;">
                        </div>

                        <div class="col-sm-3 col-md-7 col-lg-7 col-xl-7 text-white p-3">
                          <div class="row">
                            <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                             <h2><span>%s</span></h2>
                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 d-flex  align-self-center flex-row-reverse">
                             <h5><span>Seat Available :%s</span></h5>
                            </div>
                          </div>
                            <div class="row mt-4">
                                <p>%s</p>
                            </div>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 p-5" style="width: 190px;">
                            <div class="row">
                              <form action="joinEvent.php" method="POST">
                                <input type="submit" class="poster-button text-center mt-4" value="Join In">
                                <input type="hidden" name="eventID" value="%s">
                                <input type="hidden" name="eventName" value="%s">
                                <input type="hidden" name="eventPrice" value="%s">
                              </form>
                            </div>

                        </div>
                    </div>
                </div>
            ',$posterURL,$eventName,$seatAvailable,$eventDesc,$eventID, $row->eventName, $row->pricePerPax);
    }
    
    $conn->close();
    $result->free();
}

?>