<?php 
    require_once("sql_connection.php");
    require_once("getServerAddr.php");
    require_once("getEventStatus.php");
    $currentTimeInSec = time();
    $year = date("Y", $currentTimeInSec);
    $month = date("m", $currentTimeInSec);
    $day = date("d", $currentTimeInSec);
    $today = date("d-m-Y");
    $target_dir = "uploads/{$year}/{$month}/{$day}/";
    if(isset($_FILES['event_poster'])){
        $imageFileType = strtolower(pathinfo($target_dir.basename($_FILES['event_poster']['name']),PATHINFO_EXTENSION));
        $uniq_key = uniqid();
        $target_file = $target_dir.$uniq_key.'.'.$imageFileType;
        $full_path = "admin/".$target_file;
    }

    //Globals
    $errors = array();

    function validateImage($insideInlcude = false){
        global $serverAddress, $errors, $target_dir, $imageFileType, $target_file;
        //Check Image Is Uploaded Or Not
        /*if($_FILES['event_poster']['error'] > 0){
            switch ($_FILES['event_poster']['error']) {
                case UPLOAD_ERR_NO_FILE: //Code 4
                    $err = "NO FILE SELECTED";
                    
                    break;
                case UPLOAD_ERR_FORM_SIZE: //Code 2
                    $err = "File selected exceeded the limit.";
                    break;
                default:
                    $err = "Error Detected, please try again.";
                    break;
            }
        }*/
        if(isset($_FILES['event_poster'])){
            if(file_exists($_FILES['event_poster']['tmp_name'])){
                $check = getimagesize($_FILES['event_poster']['tmp_name']);
            } else {
                $check = false;
                array_push($errors, "Please Select <strong>Poster</strong>");
                return $errors;
            }
        } else {
            $check = false;
            array_push($errors, "Please Select <strong>Poster</strong>");
            return $errors;
        }

        if($insideInlcude == false){
            if (!file_exists($target_dir))/* Check folder exists or not */
            {
                @mkdir($target_dir, 0777, true);
            }
        } else{
            if (!file_exists("../".$target_dir))/* Check folder exists or not */
            {
                @mkdir("../".$target_dir, 0777, true);
            }
        }
        
        
        if($check !== false){
            //echo "File is an image - " . $check["mime"] . ".";
        } else {
            //echo "File is not an image.";
            array_push($errors, "Uploaded File Is Not An Image.");
            return $errors;
        }

        //Check File Exists Or Not
        if (file_exists($target_file)) {
            array_push($errors, "Sorry, poster already exists.");
            return $errors;

        }
        // Check file size (in byte) = 1*1024*1024
        if ($_FILES["event_poster"]["size"] > 5242880) {
            array_push($errors, "Sorry, your poster is too large.");
            return $errors;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            array_push($errors, "Sorry, only JPG, JPEG, PNG files are allowed.");
            return $errors;
        }
    }
    function validateForm(){
        global $errors;
        //Validate Event Name
        if(strlen($_POST['eventName']) > 50 || strlen($_POST['eventName']) <= 0){
            array_push($errors, "<strong>Event Name</strong> Cannot More Than 50 Or Less Than 1 Character");
        }

        //Validate Event Description
        if(strlen($_POST['eventDesc']) > 500 || strlen($_POST['eventDesc']) <= 0){
            array_push($errors, "<strong>Event Description</strong> Cannot More Than 500 Or Less Than 1 Character");
        }

        //Validate Start Date and End Date , End Date Cannot Less Than Start Date (ALSO THE TIME)
        // getStatus($eventStartDate, $eventEndDate, $eventStartTime, $eventEndTime)
        $eventStartDate = $_POST['eventStartDate'];
        $eventStartTime = $_POST['eventStartTime'];
        $eventEndDate = $_POST['eventEndDate'];
        $eventEndTime = $_POST['eventEndTime'];
        $eventStatus = getStatus($eventStartDate, $eventEndDate, $eventStartTime, $eventEndTime);
        if($eventStatus == "Error"){
            array_push($errors, "<strong>Event Time</strong> Please fill in the valid event start & end date");
        }

        //Event Seats
        $eventSeat_pattern = '/^[0-9]{1,11}$/';
        if($_POST['eventSeat'] <= 0 ){
            array_push($errors, "<strong>Event Seat</strong> Cannot Be 0 Or Less Than 0");
        } elseif(!preg_match($eventSeat_pattern, $_POST['eventSeat'])){
            array_push($errors, "<strong>Event Seat</strong> Must Be Numberic And Between 1-11 Digit");
        }

        //Event Price
        $eventPrice_pattern = '/^[0-9]{1,5}[.]?[0-9]{0,2}$/';
        if($_POST['eventPrice'] < 0){
            array_push($errors, "<strong>Event Price</strong> Cannot Be Less Than 0");
        }elseif(!preg_match($eventPrice_pattern, $_POST['eventPrice'])){
            array_push($errors, "<strong>Event Price</strong> Format Must Be 99999.99");
        }

        //Validate Event Venue
        $venue = false;
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM nitro_venue WHERE is_delete = 0";
        $result = $conn->query($query);
        if(isset($_POST['eventVenue'])){
            while($row = $result->fetch_object()){
                if($row->venueName === $_POST['eventVenue']){
                    $venue = true;
                    break;
                }
            }
        } else {
            $venue = false;
        }
        
        if($venue == false){
            array_push($errors, "<strong>Venue</strong> Is Not Exists");
        }

        ////Validate Event Category
        $category = false;
        $query = "SELECT categoryName FROM nitro_category WHERE is_delete = 0";
        $result = $conn->query($query);
        while($row = $result->fetch_object()){
            if($row->categoryName === $_POST['category']){
                $category = true;
                break;
            }
        }
        if($category == false){
            array_push($errors, "<strong>Category</strong> Is Not Exists");
        }

    }
?>