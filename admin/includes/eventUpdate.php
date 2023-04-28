<?php 
    require_once("sql_connection.php");
    //Handle Update Request
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['update'])){
            require_once("validation.php");
            require_once("modal_msg.php");
            require_modal();
            validateForm();
            if(file_exists($_FILES['event_poster']['tmp_name'])){
                validateImage(true);
            }
            //If No Error Then Update Database
            if(empty($errors)){
                //Update Datas
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $query = "
                UPDATE nitro_event 
                SET eventName = ?, 
                    eventDesc = ?,
                    categoryName = ?,
                    venueName = ?, 
                    eventSeats = ?,
                    pricePerPax = ?,
                    eventStartDate = ?,
                    eventStartTime = ?,
                    eventEndDate = ?,
                    eventEndTime = ?
                WHERE eventID = ?
                ";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssssiissssi', $_POST['eventName'], $_POST['eventDesc'], $_POST['category'],$_POST['eventVenue'], $_POST['eventSeat'], $_POST['eventPrice'], $_POST['eventStartDate'], $_POST['eventStartTime'], $_POST['eventEndDate'], $_POST['eventEndTime'], $_POST['target']);
                $stmt->execute();
                
                //Get Row Affected
                $affected_rows = $stmt->affected_rows;
                
                $stmt->close();

                if(file_exists($_FILES['event_poster']['tmp_name'])){
                    //Update Image
                    if(move_uploaded_file($_FILES["event_poster"]["tmp_name"], "../".$target_file)) {
                        //Remove Local Old Image
                        $fullPath = $_POST['event_old_poster'];
                        if(unlink("../../".$fullPath)){
                            $affected_rows++;
                        }

                        //Replace Database Poster Details To New
                        $desc = "Updated ".date("d-m-Y");
                        $query = "UPDATE nitro_poster SET posterURL = '{$full_path}', posterUniq = '{$uniq_key}', posterDesc = '{$desc}' WHERE posterID = {$_POST['event_old_posterID']}";
                        $conn->query($query);
                    }
                }

                if($affected_rows > 0){
                    modal_msg(array("Successfully Updated The Event Details"), "Success", "history.back()");
                }else{
                    modal_msg(array("Nothing Changed On The Event Details"), "Success", "history.back()");
                }

                $conn->close();
            }else{
                modal_msg($errors, "Errors", "history.back()");
            }
            
        }
    }

    //Functions
    function getEventDetails($eventID){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM nitro_event E, nitro_poster P  WHERE is_deleted = 0 AND is_draft = 0 AND E.eventID = {$eventID} AND E.posterID = P.posterID";
        $result = $conn->query($query);
        $conn->close();
        return $result;
        
    }
    function getCategoryList(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT categoryName FROM nitro_category WHERE is_delete = 0";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }
    function getVenueList(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT venueName FROM nitro_venue WHERE is_delete = 0";
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }
?>