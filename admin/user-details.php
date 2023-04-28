<?php 
    if(!isset($_GET['username'])){
        die("Illegal Direct Access");
    }
    require_once("./includes/sql_connection.php");
    require_once("./includes/permision_checker.php");
    require_once("./includes/modal_msg.php");
?>
<html lang="en">
    <head>
        <title>Nitro Society - User Details</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
    </head>
    <body style="background-image: url('./image/add_page_background.png');">
        <?php
            require_once("./includes/header.php");

            //Get User Banned Status
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "SELECT is_banned FROM nitro_user WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $_GET['username']);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                while($row = $result->fetch_object()){
                    $banned_status = $row->is_banned;
                }
            } else {
                die("Error Occur, Username Repeated");
            }
            

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                
                //Ban User
                if(isset($_POST['ban_confirm'])){
                    $query ="UPDATE nitro_user SET is_banned = ? WHERE username = ?";
                    $stmt = $conn->prepare($query);
                    $change_status = $banned_status == 1 ? 0 : 1 ;
                    $stmt->bind_param('is', $change_status ,$_POST['ban_confirm']);
                    $stmt->execute();
                    $stmt->close();
                    $banned_status = $change_status;

                //Update User Info
                } else if(isset($_POST['update'])){
                    $check_pw = "SELECT password FROM nitro_user WHERE username = ?";
                    $stmt = $conn->prepare($check_pw);
                    $stmt->bind_param('s',$_GET['username']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    while($row = $result->fetch_object()){
                        if(isset($_POST['password'])){
                            if("" == trim($_POST['password'])){
                                $new_password = $row->password;
                            } else {
                                $new_password = $_POST['password'];
                            }
                        } else {
                            $new_password = $row->password;
                        }
                        
                    }
                    $result->free();
                    
                    $query = "UPDATE nitro_user SET password = ?, emailAddress = ?, contactNum = ?, first_name = ?, last_name = ?, gender = ?, is_admin = ? WHERE username = ?";
                    $stmt = $conn->prepare($query);
                    
                    $first_name = ucwords(trim($_POST['first_name']));
                    $last_name = ucwords(trim($_POST['last_name']));
                    $contact = trim($_POST['contactNum']);
                    $is_admin = $_POST['role'] == 'A' ? 1 : 0;

                    $stmt->bind_param('ssssssis',$new_password, $_POST['email_addr'], $contact,$first_name,$last_name, $_POST['gender'], $is_admin, $_GET['username']);
                    $stmt->execute();
                    $stmt->close();

                    modal_msg(array("Successfully Updated The User Information"), "Success", "");
                //Quit Event
                }else if(isset($_POST['quit_confirm'])){
                    //Update Database Booking is_delete = 1
                    $username = $_GET['username'];
                    $eventID = $_POST['quit_confirm'];
                    $bookingID = $_POST['quit_confirm_bookID'];
                    $query = "UPDATE nitro_booking SET is_delete = 1 WHERE username = '{$username}' AND eventID = '{$eventID}' AND bookingID = '{$bookingID}'";
                    $conn->query($query);

                    modal_msg(array("Successfully Deleted Booking From The User"), "Success", "");
                    
                //Recover Booking
                }else if(isset($_POST['undo_confirm'])){
                    //Update Database Booking is_delete = 1
                    $username = $_GET['username'];
                    $eventID = $_POST['undo_confirm'];
                    $bookingID = $_POST['undo_confirm_bookID'];
                    $query = "UPDATE nitro_booking SET is_delete = 0 WHERE username = '{$username}' AND eventID = '{$eventID}' AND bookingID = '{$bookingID}'";
                    $conn->query($query);

                    modal_msg(array("Successfully Recovered Booking From The User"), "Success", "");
                    
                }else{
                    die("Illegal Access");
                }

                
            }
            //Get User Info
            $query = "SELECT * FROM nitro_user WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $_GET['username']);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows == 1){
                $row = $result->fetch_object();
                $username = $row->username;
                $first_name = $row->first_name;
                $last_name = $row->last_name;
                $email = $row->emailAddress;
                $contact = $row->contactNum;
                $gender = $row->gender;
                $is_admin = $row->is_admin;
            } else {
                die("More than 1 primary key is occur, please contact admin");
            }
            $result->free();
            $stmt->close();
            $conn->close();
        ?>
        <!-- Navigate -->
        <div class="cotainer-fluid">
            <div class=" row m-5">
                <div class="col">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb align-self-center">
                            <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                            <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="./user-management.php">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navigate -->

        <!-- User Details -->

        <div class="container">
            <div class="row">
                <div class="col-auto align-self-center">
                    <img class="img-fluid rounded d-block mx-auto mb-3" width="200px" src="./image/profile.jpg" alt="Profile Pic">
                </div>
                <div class="col">
                <form action="<?php echo $_SERVER['PHP_SELF']."?username={$_GET['username']}"; ?>" method="POST">
                    <table class="table align-middle table-striped">
                        <thead>
                            <tr>
                                <td colspan="2" ><i>User Details</i></td>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                                printf('
                                <tr>
                                <th>Username</th>
                                <td>%s</td>
                                </tr>
                                <tr>

                                <th>Password</th>
                                    <td>
                                        <input class="form-control" type="text" name="password" placeholder="(Default)" id="password" %s>  
                                    </td>
                                </tr>

                                <tr>
                                    <th>First Name</th>
                                    <td>
                                        <input class="form-control" type="text" name="first_name" id="first_name" value="%s" %s>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td>
                                        <input class="form-control" type="text" name="last_name" id="last_name" value="%s" %s>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email Address</th>
                                    <td>
                                        <input class="form-control" type="email" name="email_addr" id="email_addr" value="%s" %s>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Contact Number</th>
                                    <td>
                                        <input class="form-control" type="tel" name="contactNum" id="contactNum" value="%s" %s>
                                    </td>
                                </tr>
                                ',$username, $banned_status == 1 ? "disabled" : null , $first_name, $banned_status == 1 ? "disabled" : null, $last_name, $banned_status == 1 ? "disabled" : null, $email, $banned_status == 1 ? "disabled" : null, $contact, $banned_status == 1 ? "disabled" : null);

                                printf('
                                <tr>
                                <th>Gender</th>
                                <td>
                                    <div class="input-group">
                                        <select id="gender" name="gender" class="form-select" %s>
                                ', $banned_status == 1 ? "disabled" : null);
                                if($gender == "M"){
                                    echo '
                                        <option value="0" disabled>Gender</option>
                                        <option value="M" selected>Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Other</option>
                                    ';
                                } else if($gender == "F"){
                                    echo '
                                        <option value="0" disabled>Gender</option>
                                        <option value="M">Male</option>
                                        <option value="F" selected>Female</option>
                                        <option value="O">Other</option>
                                    ';
                                } else{
                                    echo '
                                        <option value="0" disabled>Gender</option>
                                        <option value="M" >Male</option>
                                        <option value="F">Female</option>
                                        <option value="O" selected>Other</option>
                                    ';
                                }

                                echo '
                                                </select>
                                            </div>
                                    </td>
                                </tr>
                                
                                ';

                                printf('
                                <tr>
                                <th>Role</th>
                                <td>
                                    <div class="input-group">
                                        <select id="role" name="role" class="form-select" %s>
                                ', $banned_status == 1 ? "disabled" : null);
                                
                                if($is_admin == 1){
                                    echo '
                                        <option value="0" disabled>Role</option>
                                        <option value="A" selected>Administrator</option>
                                        <option value="U">User</option>
                                    ';
                                } else {
                                    echo '
                                        <option value="0" disabled>Role</option>
                                        <option value="A" >Administrator</option>
                                        <option value="U" selected>User</option>
                                    ';
                                }

                                echo'
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                ';

                                printf('
                                <tr>

                                    <td colspan="2" class="text-end py-3" >
                                    <input type="button" name="delete" class="btn btn-danger" value="%s" data-bs-toggle="modal" data-bs-target="#confirmation">
                                    <input type="submit" name="update" class="btn btn-success" value="Update">
                                    <input type="reset" name="cancel" class="btn btn-secondary" value="Reset">
                                    </td>
                                </tr>
                                ', $banned_status == 1 ? "Unban User" : "Ban User");
                            ?>
                        </tbody>
                        
                    </table>
                </form>
                        
                </div>
            </div>
        </div>

        <div class="container my-3">
            <div class="row">
                <div class="col">
                    <!-- Section 1-->
                    <div class="row">
                        <div class="col-auto">
                            <p class="fs-3">User Booking Details</p>
                            <hr>
                        </div>
                    </div>
                     <!-- Section 1 -->
                    
                    <!-- Section 2 -->
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-success" role="alert">
                            <i class="bi bi-award"></i> Booking List
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <?php 
                                    //Get Event Status
                                    require_once("./includes/getEventStatus.php");
                                    //Get Username
                                    $username = $_GET['username'];

                                    //Prepare Request Data from Database
                                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                    $query = "
                                    SELECT B.bookingID, B.eventID, B.bookingDate, B.bookingTime, eventName, eventStartDate, eventEndDate, eventStartTime, eventEndTime, posterURL
                                    FROM nitro_booking B 
                                    INNER JOIN nitro_event E ON B.eventID = E.eventID
                                    INNER JOIN nitro_poster P ON E.posterID = P.posterID
                                    WHERE B.username = '{$username}' AND B.is_delete = 0
                                    ORDER BY eventStartDate DESC, eventStartTime DESC
                                    ";
                                    $result = $conn->query($query);
                                    if($result->num_rows == 0){
                                        //Show Event Not Found 
                                        echo '
                                            <div class="row">
                                                <div class="col">
                                                    <div class="alert alert-danger" role="alert">
                                                    <i class="bi bi-award"></i> User No Apply For Any Event Yet
                                                </div>
                                            </div>
                                        ';
                                    }else{
                                        while($row = $result->fetch_object()){
                                            $status = getStatus($row->eventStartDate, $row->eventEndDate, $row->eventStartTime, $row->eventEndTime);
                                            if($status != "Expired"){
                                                printf('
                                                    <div class="col-lg-auto my-3">
                                                        <div class="card h-100" style="width: 18rem;">
                                                            <div class="row position-absolute w-100 mx-3 p-3">
                                                                <div class="col text-end">
                                                                    <span class="badge rounded-pill text-bg-danger ">%s</span>
                                                                </div>
                                                            </div>
                                                            <img src="../%s" class="card-img-top" alt="Poster Image">
                                                            <div class="card-body">
                                                                <h5 class="card-title">%s</h5>
                                                                <p>Booking ID : %s</p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="row g-2 mx-auto">
                                                                    <div class="col">
                                                                        <div class="d-grid">
                                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#quit_confirmation" onclick="change_value(\'quit_confirm\', %d);change_value(\'quit_confirm_bookID\', %d);change_text(\'bookingDate\', \'%s\');change_text(\'bookingTime\', \'%s\');">Quit Event</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ', $status, $row->posterURL, $row->eventName,$row->bookingID, $row->eventID, $row->bookingID, $row->bookingDate, $row->bookingTime);
                                            } else {

                                                printf('
                                                    <div class="col-lg-auto my-3">
                                                        <div class="card h-100" style="width: 18rem;">
                                                            <div class="row position-absolute w-100 mx-3 p-3">
                                                                <div class="col text-end">
                                                                    <span class="badge rounded-pill text-bg-secondary ">%s</span>
                                                                </div>
                                                            </div>
                                                            <img src="../%s" class="card-img-top" alt="Poster Image">
                                                            <div class="card-body">
                                                                <h5 class="card-title">%s</h5>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                ', $status, $row->posterURL, $row->eventName, $row->eventID);
                                            }
                                        }
                                    }
                                   
                                ?>
                                                

                            </div>
                        </div>
                    </div>
                    <!-- Section 2 -->
                    
                    <!-- Section 3-->
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-secondary" role="alert">
                            <i class="bi bi-award"></i> Deleted Booking List
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <?php 
                                    //Get Event Status
                                    require_once("./includes/getEventStatus.php");
                                    //Get Username
                                    $username = $_GET['username'];

                                    //Prepare Request Data from Database
                                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                    $query = "
                                    SELECT B.bookingID, B.eventID, eventName, eventStartDate, eventEndDate, eventStartTime, eventEndTime, posterURL
                                    FROM nitro_booking B 
                                    INNER JOIN nitro_event E ON B.eventID = E.eventID
                                    INNER JOIN nitro_poster P ON E.posterID = P.posterID
                                    WHERE B.username = '{$username}' AND B.is_delete = 1
                                    ";
                                    $result = $conn->query($query);
                                    if($result->num_rows == 0){
                                        //Show Event Not Found 
                                        echo '
                                            <div class="row">
                                                <div class="col">
                                                    <div class="alert alert-danger" role="alert">
                                                    <i class="bi bi-award"></i> User No Apply For Any Event Yet
                                                </div>
                                            </div>
                                        ';
                                    }else{
                                        while($row = $result->fetch_object()){
                                            $status = getStatus($row->eventStartDate, $row->eventEndDate, $row->eventStartTime, $row->eventEndTime);
                                            if($status != "Expired"){
                                                printf('
                                                    <div class="col-lg-auto my-3">
                                                        <div class="card h-100" style="width: 18rem;">
                                                            <div class="row position-absolute w-100 mx-3 p-3">
                                                                <div class="col text-end">
                                                                    <span class="badge rounded-pill text-bg-secondary ">%s</span>
                                                                </div>
                                                            </div>
                                                            <img src="../%s" class="card-img-top" alt="Poster Image">
                                                            <div class="card-body">
                                                                <h5 class="card-title">%s</h5>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="row g-2 mx-auto">
                                                                    <div class="col">
                                                                        <div class="d-grid">
                                                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#undo_confirmation" onclick="change_value(\'undo_confirm\', %d);change_value(\'undo_confirm_bookID\', %d);">Undo</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ', $status, $row->posterURL, $row->eventName, $row->eventID, $row->bookingID);
                                            }
                                        }
                                    }
                                   
                                ?>
                                                

                            </div>
                        </div>
                    </div>
                    <!-- Section 3-->

                </div>
            </div>
        </div>
        <!-- Ban Confirmation Modal -->
        <?php 
            printf('
                <form action="%s?username=%s" method="POST">
                    <div class="modal fade" id="confirmation" tabindex="-1" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">%s Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure want to %s ?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="ban_confirm" value="%s" class="btn btn-danger" data-bs-dismiss="modal">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>

                </form>
            ', $_SERVER['PHP_SELF'],$_GET['username'] ,$banned_status == 1 ? "Unban User" : "Ban User", $banned_status == 1 ? "unban the account ({$_GET['username']})" : "ban the account ({$_GET['username']})", $_GET['username']);
        ?>
        
        <!-- Ban Confirmation Modal -->

        <!-- Quit Event Confirmation Modal -->
        <?php 
            printf('
                <form action="%s?username=%s" method="POST">
                    <div class="modal fade" id="quit_confirmation" tabindex="-1" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Quit Event Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure want to quit this event ?
                                <br><br>
                                Booking Date: <output class="fw-bold" id="bookingDate"></output>
                                <br>
                                Booking Time: <output class="fw-bold" id="bookingTime"></output>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="quit_confirm_bookID" name="quit_confirm_bookID" value="">
                                <button type="submit" id="quit_confirm" name="quit_confirm" value="" class="btn btn-danger" data-bs-dismiss="modal">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>

                </form>
            ', $_SERVER['PHP_SELF'],$_GET['username']);
        ?>
        <!-- Quit Event Confirmation Modal -->

        <!-- Undo Confirmation Modal -->
        <?php 
            printf('
                <form action="%s?username=%s" method="POST">
                    <div class="modal fade" id="undo_confirmation" tabindex="-1" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Undo Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure want to recover this booking ?
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="undo_confirm_bookID" name="undo_confirm_bookID" value="">
                                <button type="submit" id="undo_confirm" name="undo_confirm" value="" class="btn btn-warning" data-bs-dismiss="modal">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>

                </form>
            ', $_SERVER['PHP_SELF'],$_GET['username']);
        ?>
        <!-- Undo Confirmation Modal -->
        <script>
            function change_value(id,title_value){
                document.getElementById(id).value = title_value;
            }
            function change_text(id,title_value){
                document.getElementById(id).innerText = title_value;
            }
        </script>
    </body>
    
</html>