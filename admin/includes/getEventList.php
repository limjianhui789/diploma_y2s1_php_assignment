<?php
    require_once("sql_connection.php");
    function request_events(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "
            SELECT posterURL, eventID, eventName, eventDesc, eventStartDate, eventStartTime, eventEndDate, eventEndTime, is_deleted
            FROM nitro_event E, nitro_poster P 
            WHERE is_draft = 0 
            AND E.posterID = P.posterID
            ORDER BY is_deleted ASC, eventStartDate DESC, eventStartTime DESC
        ";         
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }
?>