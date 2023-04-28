<?php 
    require_once("permision_checker.php");
    require_once("modal_msg.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        require_modal();
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if(isset($_POST['add'])){
            $categoryName = trim(ucwords($_POST['cat_name']));
            $categoryIcon = $_POST['cat_icon'];
            $is_delete = 0;

            $query = "SELECT categoryName FROM nitro_category WHERE categoryName = '{$categoryName}'";
            $result = $conn->query($query);
            if($result->num_rows != 0){
                modal_msg(array("Duplicated Category Name, Please Change To Another Category Name"), "Duplicated Category", "../category-management.php");
                die();
            }

            $query = "INSERT INTO nitro_category VALUES(?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssi', $categoryName, $categoryIcon , $is_delete);
            $stmt->execute();
            $stmt->close();
            modal_msg(array("Successfully Added The Category ({$categoryName})"), "Success", "../category-management.php");
        }elseif(isset($_POST['delete'])){
            $query = "UPDATE nitro_category SET is_delete = 1 WHERE categoryName = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $_POST['target']);
            $stmt->execute();
            $stmt->close();
            modal_msg(array("Successfully Deleted The Category ({$_POST['target']})"), "Success", "../category-management.php");
        } elseif(isset($_POST['update'])){
            $query = "SELECT * FROM nitro_category WHERE categoryName = '{$_POST['oriCatName']}'";
            $result = $conn->query($query);
            $record = $result->fetch_object();
            $oriCatName = $record->categoryName;
            $oriCatIcon = $record->categoryIcon;
            $is_delete = $record->is_delete;
            $query = "ALTER TABLE nitro_event DISABLE KEYS;";
            $conn->query($query);
            if(trim($_POST['new_cat_name']) != "" && trim($_POST['new_cat_icon']) != ""){
                $query = "UPDATE nitro_event SET categoryName = {$_POST['new_cat_name']}, categoryIcon = '{$_POST['new_cat_icon']}' WHERE categoryName = '{$oriCatName}'";
                $conn->query($query);
                $query = "UPDATE nitro_category SET categoryName = '{$_POST['new_cat_name']}', categoryIcon = '{$_POST['new_cat_icon']}' WHERE categoryName = '{$oriCatName}'";
                
            }elseif(trim($_POST['new_cat_name']) != ""){
                $query = "UPDATE nitro_event SET categoryName = '{$_POST['new_cat_name']}' WHERE categoryName = '{$oriCatName}';";
                $conn->query($query);
                $query = "UPDATE nitro_category SET categoryName = '{$_POST['new_cat_name']}', categoryIcon = '{$oriCatIcon}' WHERE categoryName = '{$oriCatName}'";
            }elseif(trim($_POST['new_cat_icon']) != ""){
                $query = "UPDATE nitro_category SET categoryName = '{$oriCatName}', categoryIcon = '{$_POST['new_cat_icon']}' WHERE categoryName = '{$oriCatName}'";
            } else {
                $query = "UPDATE nitro_category SET categoryName = '{$oriCatName}', categoryIcon = '{$oriCatIcon}' WHERE categoryName = '{$oriCatName}'";
            }
            $conn->query($query);
            $query = "ALTER TABLE nitro_event ENABLE KEYS;";
            $conn->query($query);
            modal_msg(array("Successfully Updated The Category"), "Success", "../category-management.php");
        }else{
            modal_msg(array("Illegal Action Access"), "Illegal Access", "../category-management.php");
            die("Illegal Action Access");
        }
        $conn->close();
    }
?>