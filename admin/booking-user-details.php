<?php 
    require_once("./includes/sql_connection.php");
    require_once("./includes/permision_checker.php");
    require_once("./includes/modal_msg.php");
?>
<html lang="en">
    <head>
        <title>Nitro Society - Booking User Details</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <?php 
            require_modal();
        ?>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
    </head>
    <body style="background-image: url('./image/add_page_background.png');">
        <?php
            require_once("./includes/header.php");
            if(!isset($_GET['bookingID'])){
                modal_msg(array("Illegal Access"), "Error", "history.back()");
                die();
            }
        ?>
        
        <!-- Navigate -->
        <div class="cotainer-fluid">
            <div class="row mt-5 mx-5">
                <div class="col">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb align-self-center">
                            <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                            <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="./booking-management.php">Check Booking</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="javascript:onclick=history.back()">Booking Details</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Booking User Details</li>
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
                    <img class="img-fluid rounded d-block mx-auto" width="200px" src="./image/profile.jpg" alt="Profile Pic">
                </div>
                <div class="col">
                <form action="">
                    <table class="table align-middle table-striped h-100">
                        <thead>
                            <tr>
                                <td colspan="2" ><i>User Details</i></td>
                            </tr>
                        </thead>
                        
                        <?php 
                            $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                            $query = "
                            SELECT U.username, first_name, last_name, emailAddress, contactNum, gender, is_admin 
                            FROM nitro_user U, nitro_booking B
                            WHERE B.bookingID = {$_GET['bookingID']}
                            AND (B.username = U.username)
                            ";
                            $result = $conn->query($query);

                            while($row = $result->fetch_object()){
                                if($row->gender == 'M'){
                                    $gender = "Male";
                                } else if($row->gender == "F"){
                                    $gender = "Female";
                                } else{
                                    $gender = "Other";
                                }
                                if($row->is_admin == 1){
                                    $role = "Administrator";
                                }else{
                                    $role = "User";
                                }
                                printf('
                                <tbody>
                                    <tr>
                                        <th>Username</th>
                                        <td>%s</td>
                                    </tr>
                                    <tr>
                                        <th>First Name</th>
                                        <td>
                                            %s
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>
                                            %s
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email Address</th>
                                        <td>
                                            %s
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <td>
                                            %s
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>
                                            %s
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>
                                            %s
                                        </td>
                                    </tr>
                                </tbody>
                                ', $row->username, $row->first_name, $row->last_name, $row->emailAddress, $row->contactNum, $gender, $role);
                            }
                            
                        ?>
                        
                        
                    </table>
                </form>
                        
                </div>
            </div>
            <!-- User Details -->
            <hr>
            <div class="row">
                <div class="col-6">
                    <div class="d-grid">
                        <button class="btn btn-primary-bg" onclick="location.href = '../invoice.php'">Check Invoice</button>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-grid">
                        <button class="btn btn-primary-bg" onclick="location.href = '../ticket.php?bookingID=<?php echo $_GET['bookingID'];?>'">Check Ticket</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        
    </body>
</html>