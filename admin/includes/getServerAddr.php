<?php   
        require_once("permision_checker.php");
    	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM serverconfig";
        $result = $conn->query($query);
        $record = $result->fetch_object();
        if($record->ssl_enabled == 0){
            $serverAddress = "http://du538vf139l5a.cloudfront.net:80{$record->defaultPath}";
        }else{
            $serverAddress = "https://du538vf139l5a.cloudfront.net:443{$record->defaultPath}";
        }
        $result->free();
        $conn->close();
?>