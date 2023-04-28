<?php 
    require_once("./includes/sql_connection.php");
    require_once("./includes/permision_checker.php");
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Nitro Society - Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
        
    </head>
    <body>
        <!-- Side Menu -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 min-vh-100 side-menu">

                    <!-- Logo -->
                    <div class="row mt-3 mb-3">
                        <img src="image/transparent-logo.png" class="logo-cropped mx-auto d-block img-fluid" alt="Logo"/>
                    </div>

                    <!-- Logo -->

                    <!-- Name Card -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-3 d-flex justify-content-center px-0">
                            <i class="bi bi-person-circle fs-2"></i>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col px-0">
                                    <p class="fw-bold mb-0 px-2">
                                        <?php 
                                            echo $_SESSION['username'];
                                        ?>
                                    </p>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-auto px-0">
                                    <p class="fw-light mb-0 px-2"><span class="badge bg-secondary">Administrator</span></p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Name Card -->

                    <hr>

                    <!-- Dashboard Btn -->
                    <div class="row d-flex mb-3">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="button" class="btn btn-primary" onclick="document.location='./#dashboard';return false;">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        Dashboard
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-house"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Events Btn -->
                    <div class="row d-flex mb-3">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#events">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        Event Management
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-calendar2-event"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Events Btn -->

                    <!-- Hidden Events Btn -->
                    <div class="row collapse mb-1" id="events">
                        <div class="col d-grid mx-auto gap-2">
                            <button type="button" class="btn btn-secondary" onclick="location.href = './event-list.php'">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <i class="bi bi-arrow-right"></i> Manage Events
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-list"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="row collapse mb-1" id="events">
                        <div class="col d-grid mx-auto gap-2">
                            <button type="button" class="btn btn-secondary"  onclick="document.location='./event-add.php';return false;">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <i class="bi bi-arrow-right"></i> Add New Event
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-plus-lg"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Hidden Events Btn End -->
                    <!-- Category Management Btn -->
                    <div class="row d-flex mb-3">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="button" class="btn btn-primary" onclick="location.href = './category-management.php'">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        Category Management
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <i class="bi bi-bookmarks"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Category Management Btn -->
                    <!-- Venue Management Btn -->
                    <div class="row d-flex mb-3">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="button" class="btn btn-primary" onclick="location.href = './venue-management.php'">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        Venue Management
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <i class="bi bi-layout-text-window-reverse"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Venue Management Btn -->
                    <!-- Booking Btn -->
                    <div class="row d-flex mb-3">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="button" class="btn btn-primary" onclick="location.href = './booking-management.php'">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        Booking Management
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-building"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Booking Btn -->

                     <!-- User Management Btn -->
                     <div class="row d-flex mb-3">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="button" class="btn btn-primary" onclick="location.href = './user-management.php'">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        User Management
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-person-square "></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- User Management Btn -->

                    <!-- User Management Btn -->
                    <div class="row d-flex mb-3">
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="button" class="btn btn-primary" onclick="location.href = './load_test.php'">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        Load Test
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-speedometer"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- User Management Btn -->

                    <!-- Logout Btn -->
                    <form action="includes/logout.php" method="POST">
                        <div class="row d-flex mb-3">
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="submit" class="btn btn-primary" name="logout" id="logout" >
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <label for="logout">Logout</label>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <i class="bi bi-box-arrow-left"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                    

                </div>

                
                <!-- ## Second Col , Content Section-->
                <div class="col-lg-10 p-0">
                    <div class="container-fluid">
                        <!-- Nav -->
                        <form action="includes/logout.php" method="POST">
                            <div class="row justify-content-end bg-light">
                                <div class="col-auto d-none d-lg-flex p-0 d-flex justify-content-end pe-5">
                                    <nav class="navbar">
                                        <p class="mb-0 px-3 tw-bold">Home</p>
                                        <button type="button" class="btn btn-secondary" onclick="location.href = '../index.php'">
                                            <i class="bi bi-house"></i>
                                        </button>
                                    </nav>
                                </div>
                                <div class="col-auto d-none d-lg-flex p-0 d-flex justify-content-end pe-5 ">
                                    <nav class="navbar">
                                        <p class="mb-0 px-3 tw-bold">Logout</p>
                                        <button type="submit" class="btn btn-secondary" name="logout">
                                            <i class="bi bi-power"></i>
                                        </button>
                                    </nav>
                                </div>
                                
                            </div>
                        </form>

                        
                        
                        <!-- Nav -->

                        <!-- Dashboard -->
                        <div class="row">
                            <div class="col p-3">
                                <!-- Dashboard Header -->
                                <div class="row d-flex align-items-center" id="dashboard">
                                    <div class="col-auto">
                                        <i class="bi bi-house-fill fs-4 icon-primary"></i>
                                    </div>
                                    <div class="col-auto ps-0">
                                        <p class="fs-4 fw-bold mb-0">Dashboard</p>
                                    </div>
                                </div>
                                <!-- Dashboard Header -->

                                <!-- Dashboard Info -->
                                <div class="row m-5 d-flex justify-content-around">
                                    <!-- Total Ongoing Events -->
                                    <div class="col-lg-3 badge text-bg-info m-3">
                                        <div class="row d-flex justify-content-between p-3">
                                            <div class="col-auto">
                                                <p class="fs-6 fw-light mb-0 text-start text-white">Total Ongoing Events</p>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-bar-chart-line-fill text-white"></i>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-betweend p-3">
                                            <div class="col-auto">
                                                <p class="fs-3 fw-semibold mb-0 text-start text-white">
                                                    <?php 
                                                        require_once("./includes/getEventStatus.php");

                                                        $total_ongoing = 0;

                                                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                                        $query = "
                                                        SELECT eventID, eventName, eventDesc, eventStartDate, eventStartTime, eventEndDate, eventEndTime 
                                                        FROM nitro_event 
                                                        WHERE is_deleted = 0 AND is_draft = 0
                                                        ";
                                                        $result = $conn->query($query);

                                                        while($row = $result->fetch_object()){
                                                            $eventStartDate = date('Y-m-d',strtotime($row->eventStartDate));
                                                            $eventEndDate = date('Y-m-d',strtotime($row->eventEndDate));
                                                            $eventStartTime = date('h:i A', strtotime($row->eventStartTime));
                                                            $eventEndTime = date('h:i A', strtotime($row->eventEndTime));

                                                            $eventStatus = getStatus($eventStartDate, $eventEndDate, $eventStartTime, $eventEndTime); //It will define $eventStatus

                                                            if($eventStatus == "Ongoing"){
                                                                $total_ongoing++;
                                                            }
                                                        }

                                                        echo $total_ongoing;
                                                        $result->free();
                                                        $conn->close();
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Ongoing Events -->

                                    <!-- Total Bookings -->
                                    <div class="col-lg-3 badge text-bg-info m-3">
                                        <div class="row d-flex justify-content-between p-3">
                                            <div class="col-auto">
                                                <p class="fs-6 fw-light mb-0 text-start text-white">Total Bookings</p>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-bar-chart-line-fill text-white"></i>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-betweend p-3">
                                            <div class="col-auto">
                                                <p class="fs-3 fw-semibold mb-0 text-start text-white">
                                                    <?php 
                                                        $total_booking = 0;

                                                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                                        $query = "
                                                            SELECT bookingID
                                                            FROM nitro_booking;
                                                        ";
                                                        $result = $conn->query($query);
                                                        
                                                        $total_booking = $result->num_rows;
                                                        echo $total_booking;
                                                        $result->free();
                                                        $conn->close();
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Bookings -->

                                    <!-- Total Users -->
                                    <div class="col-lg-3 badge text-bg-info m-3">
                                        <div class="row d-flex justify-content-between p-3">
                                            <div class="col-auto">
                                                <p class="fs-6 fw-light mb-0 text-start text-white">Total Users</p>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-bar-chart-line-fill text-white"></i>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-betweend p-3">
                                            <div class="col-auto">
                                                <p class="fs-3 fw-semibold mb-0 text-start text-white">
                                                    <?php 
                                                        $total_users = 0;

                                                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                                        $query = "
                                                            SELECT username
                                                            FROM nitro_user
                                                            WHERE is_admin = 0;
                                                        ";
                                                        $result = $conn->query($query);
                                                        
                                                        $total_users = $result->num_rows;
                                                        echo $total_users;
                                                        $result->free();
                                                        $conn->close();
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Users -->
                                </div>
                                <!-- Dashboard Info -->
                            </div>
                        </div>
                        <!-- Dashboard -->

                        <!-- Chart -->
                        <?php 
                            $eventIdArr = array();
                            $eventNameArr = array();
                            $eventDataArr = array();
                            //Get Data From Database
                            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $query = "
                            SELECT E.eventID, E.eventName, count(T.ticketID) AS 'totalTicket'
                            FROM nitro_event E INNER JOIN nitro_booking B
                            ON E.eventID = B.eventID
                            INNER JOIN nitro_ticket T ON B.bookingID = T.bookingID
                            WHERE B.is_delete = 0 AND E.is_deleted = 0
                            GROUP BY E.eventID, E.eventName
                            ORDER BY count(T.ticketID) DESC, E.eventID ASC
                            LIMIT 6
                            ";
                            $result = $conn->query($query);
                            while($row = $result->fetch_object()){
                                array_push($eventIdArr, $row->eventID);
                                array_push($eventNameArr, $row->eventName);
                                array_push($eventDataArr, $row->totalTicket);
                            }
                        ?>
                        <div class="row">
                            <div class="col">
                                <canvas id="myChart" height="100"></canvas>
                                <?php 
                                echo '
                                    <script>
                                        const ctx = document.getElementById(\'myChart\').getContext(\'2d\');
                                        const myChart = new Chart(ctx, {
                                            type: \'bar\',
                                            data: {
                                    ';
                                echo "labels: ['" .implode("','", $eventNameArr) . "'],";
                                echo '
                                    datasets: [{
                                        label: \'# Of Ticket\',
                                ';
                                //data: [12, 190, 3, 5, 2, 3],
                                echo 'data :[' . implode(",", $eventDataArr) .'],';
                                echo '
                                        backgroundColor: [
                                            \'rgba(255, 99, 132, 0.2)\',
                                            \'rgba(54, 162, 235, 0.2)\',
                                            \'rgba(255, 206, 86, 0.2)\',
                                            \'rgba(75, 192, 192, 0.2)\',
                                            \'rgba(153, 102, 255, 0.2)\',
                                            \'rgba(255, 159, 64, 0.2)\'
                                        ],
                                        borderColor: [
                                            \'rgba(255, 99, 132, 1)\',
                                            \'rgba(54, 162, 235, 1)\',
                                            \'rgba(255, 206, 86, 1)\',
                                            \'rgba(75, 192, 192, 1)\',
                                            \'rgba(153, 102, 255, 1)\',
                                            \'rgba(255, 159, 64, 1)\'
                                        ],
                                        borderWidth: 1
                                    }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                                '           
                            ?>
    
                                            
                                            
                            </div>
                        </div>
                        <!-- Chart -->
                    </div>
                    
                </div>
            </div>
        </div>
        
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        
    </body>
    
</html>
