<?php 
    require_once("permision_checker.php");
    require_once("modal_msg.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        require_modal();
        
        if(isset($_POST['add'])){
            $query = "SELECT venueName FROM nitro_venue WHERE venueName = '{$_POST['venue_name']}'";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                modal_msg(array("The Venue Name Is Duplicated Or Existed, Please Change To Another Venue Name"), "Venue Request", "../venue-management.php");
                $conn->close();
                die();
            }
            $result->free();
            if(trim($_POST['venue_name'] != "")){
                $venueName = trim($_POST['venue_name']);
                $query = "INSERT INTO nitro_venue VALUES('{$venueName}', 0)";
                $conn->query($query);
                modal_msg(array("Successfully Added Venue Called ({$_POST['venue_name']})"), "Success", "../venue-management.php");
            } else {
                modal_msg(array("You are not able to enter empty venue name"), "Venue Request", "../venue-management.php");
                $conn->close();
                die();
            }
        }elseif(isset($_POST['delete'])){
            $query = "UPDATE nitro_venue SET is_delete = 1 WHERE venueName = '{$_POST['target']}' ";
            $conn->query($query);
            modal_msg(array("Successfully Deleted Venue Called ({$_POST['target']})"), "Delete", "../venue-management.php");
        }elseif(isset($_POST['update'])){
            $query = "ALTER TABLE nitro_event DISABLE KEYS;";
            $conn->query($query);

            $query = "UPDATE nitro_event SET venueName = '{$_POST['new_venue_name']}' WHERE venueName = '{$_POST['target']}' ";
            $conn->query($query);

            $query = "UPDATE nitro_venue SET venueName = '{$_POST['new_venue_name']}' WHERE venueName = '{$_POST['target']}' ";
            $conn->query($query);

            $query = "ALTER TABLE nitro_event ENABLE KEYS;";
            $conn->query($query);
            modal_msg(array("Successfully Updated The Venue Name From ({$_POST['target']}) To ({$_POST['new_venue_name']})"), "Venue Request", "../venue-management.php");
        }

        $conn->close();
    }
?>