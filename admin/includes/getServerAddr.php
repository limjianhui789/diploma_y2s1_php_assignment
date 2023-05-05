<?php   
        require_once("permision_checker.php");
    	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM serverconfig";
        $result = $conn->query($query);
        $record = $result->fetch_object();
        if($record->ssl_enabled == 0){
            $serverAddress = "http://{$record->domain}:{$record->port}{$record->defaultPath}";
        }else{
            $serverAddress = "https://{$record->domain}:{$record->port}{$record->defaultPath}";
        }
        $result->free();
        $conn->close();
?>