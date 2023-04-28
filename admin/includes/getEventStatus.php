<?php
    function getStatus($eventStartDate, $eventEndDate, $eventStartTime, $eventEndTime){
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $currentDate = date('Y-m-d');
        $currentTime = date('h:i A');
        if(trim($eventStartDate) == "" || trim($eventEndDate) == "" || trim($eventStartTime) == "" || trim($eventEndTime) == ""){
            return "Error";
            
        }else if($currentDate == $eventStartDate && $currentDate <= $eventEndDate){//If Today Is EventDate And <= EventEndDate
            //Check Time
            if($currentTime >= $eventStartTime && $currentTime <= $eventEndTime){//If CurrentTime Is >= EventStartTime And CurrentTime Is <= EventEndTime
                //Then It Is Ongoing Event
                return "Ongoing";
            }elseif($currentTime >= $eventEndTime && $currentTime >= $eventStartTime ){
                return "Expired";
            }elseif($currentTime < $eventStartTime && $currentTime < $eventEndTime){
                
                return "Upcoming";
            }else{
                return "Error";
            }
        } elseif($currentDate >= $eventStartDate && $currentDate <= $eventEndDate){
            return "Ongoing";
        } elseif($currentDate > $eventEndDate && $currentDate > $eventStartDate){
            return "Expired";
        } elseif($currentDate < $eventStartDate && $currentDate < $eventEndDate){
            return "Upcoming";
            
        } else{
            return "Error";
        }
    }
    function getStatusColor($eventStatus){
        switch($eventStatus){
            case 'Expired':
                $statusColor = "secondary";
                break;
            case 'Ongoing':
                $statusColor = "success";
                break;
            case 'Upcoming':
                $statusColor = "danger";
                break;
            case 'Error':
                $statusColor = "warning";
                break;
        }
        return $statusColor;
    }
?>