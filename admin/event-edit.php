<?php 
    require_once("./includes/permision_checker.php");
?>
<html lang="en">
    <head>
        <title>Nitro Society - Event Edit</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        
    </head>
<body style="background-image: url('./image/add_page_background.png');">
    
    <?php
        require_once("./includes/header.php");
    ?>
    <!-- Navigate -->
    <div class="cotainer-fluid">
            <div class="row mt-5 mx-5">
                <div class="col">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb align-self-center">
                            <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                            <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                            <li class="breadcrumb-item"><a href="./event-list.php">Event List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navigate -->
        <?php 
        //Showing Event Details ( Sticky Form )
            require_once("./includes/eventUpdate.php");
            require_once("./includes/getServerAddr.php");
            if($_SERVER['REQUEST_METHOD'] == "GET"){
                if(isset($_GET['eventID'])){
                    $target_id = $_GET['eventID'];
                    $result = getEventDetails($target_id);
                    while($row = $result->fetch_object()){

                        //Image , Title and Desc
                        printf('
                        <div class="container-fluid">
                        <form action="./includes/eventUpdate.php" method="POST" enctype="multipart/form-data">
                            <div class="row m-3 justify-content-center">
                                    <div class=" col-lg-10 col-12">
                                        <div class="card mb-3" >
                                            <div class="row g-0">
                                                <div class="col-lg-4 px-3 ps-lg-3 my-3">
                                                    <label for="update_img" style="cursor: pointer;">
                                                        <img src="%s" id="preview_img" class="img-fluid rounded" alt="Preview Image" >
                                                    </label>
                                                    <input class="btn-check" type="file" name="event_poster" id="update_img" onchange="loadFile(event);">
                                                    <input type="hidden" name="event_old_poster" value="%s">
                                                    <input type="hidden" name="event_old_posterID" value="%d">
                                                    <div class="row">
                                                        <div class="col rounded-3 my-3">
                                                            <p class="m-0 fw-semibold">Upload Event Poster</p>
                                                            <p class="m-0 text-black-50 fw-light">Image format only allow .jpg .png .jpeg and please follow the image size ratio (1587px * 2245px)</p>
                                                            <p class="m-0 mt-3 text-black-75 fw-light" id="preview_selected_img">Selected Image : None</p>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                <div class="col-lg-8">
                                                        <div class="card-body">
                                                            <i class="bi bi-bookmark-star"></i>
                                                            <strong>Event Title</strong>
                                                            <h5 class="card-title" id="preview_title"><input type="text" class="form-control" id="eventName" name="eventName" value="%s" placeholder="Eg. Game Development Training" required></h5>
                                                            <i class="bi bi-bookmark-star"></i>
                                                            <strong>Event Description</strong>
                                                            <textarea class="form-control" id="eventDesc" name="eventDesc" rows="3" placeholder="Eg. Penang Youth Development Corporation in collabrating with TARUC..."  required>%s</textarea>
                                                            <br>
                                                            <!-- General Info -->
                                                            
                        ', $serverAddress.$row->posterURL, $row->posterURL, $row->posterID, $row->eventName, $row->eventDesc);
                        
                        //Handle Category 
                        $categoryList = getCategoryList();
                        echo '
                        <div class="row">
                            <div class="col">
                                <p>
                                    <i class="bi bi-bookmark-star"></i>
                                    <strong>Event Category</strong>
                                    <select class="form-select" name="category" required>
                                        <option disabled value="">Event Category</option>
                                    ';

                        while($row_cat = $categoryList->fetch_object()){
                            if($row_cat->categoryName == $row->categoryName){
                                printf('
                                    <option value="%s" selected>%s</option>
                                ', $row_cat->categoryName, $row_cat->categoryName);
                            } else {
                                printf('
                                    <option value="%s">%s</option>
                                ', $row_cat->categoryName, $row_cat->categoryName);
                            }
                        }
                        echo '
                                </select>
                                </p>
                            </div>
                        </div>
                        ';

                        //Handle Event Venue
                        $venueList = getVenueList();
                        echo '
                        <div class="row">
                            <div class="col">
                                <p>
                                    <i class="bi bi-bookmark-star"></i>
                                    <strong>Event Venue</strong>
                                    <select class="form-select" name="eventVenue" required>
                                        <option disabled value="">Event Venue</option>
                        ';
                        while($row_venue = $venueList->fetch_object()){
                            if($row_venue->venueName == $row->venueName){
                                printf('
                                    <option value="%s" selected>%s</option>
                                ', $row_venue->venueName,$row_venue->venueName );
                            }else{
                                printf('
                                    <option value="%s">%s</option>
                                ', $row_venue->venueName,$row_venue->venueName );
                            }
                        }
                        echo '
                                </select>
                                </p>
                            </div>
                        </div>
                        ';

                        //Event Seats
                        printf('
                            <div class="row">
                                <div class="col">
                                    <p>
                                        <i class="bi bi-people-fill"></i>
                                        <strong>Event Seats</strong>
                                        <input type="number" class="form-control" value="%d" min="1" max="500" name="eventSeat" id="eventSeat">
                                    </p>
                                </div>
                            </div>
                        ', $row->eventSeats);

                        //Price
                        printf('
                        <div class="row">
                            <div class="col">
                                <p class="mb-0">
                                    <i class="bi bi-currency-dollar"></i>
                                    <strong class="d-none d-lg-inline">Price Per Pex</strong>
                                    <strong class="d-lg-none">Price/Person</strong>
                                    <div class="input-group mb-4 mb-lg-4">
                                        <span class="input-group-text">RM</span>
                                        <input type="number" class="form-control"min="0" value="%s" max="99999" id="eventPrice" name="eventPrice" oninput="chg_value(\'preview_price\', this.value)">
                                    </div>
                                </p>
                            </div>
                        </div>
                        <br>
                        ', $row->pricePerPax);

                        //Start Date and Time & End Date and Time
                        printf('
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-dark ">Start Date & Time <i class="bi bi-calendar-week"></i></li>
                                    <li class="list-group-item" id="preview_startDate"><input class="form-control" value="%s" type="date" name="eventStartDate" id="eventStartDate" required></li>
                                    <li class="list-group-item" id="preview_startTime"><input class="form-control" type="time" value="%s" name="eventStartTime" id="eventStartTime" required></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-dark ">End Date & Time <i class="bi bi-calendar-week"></i></li>
                                    <li class="list-group-item" id="preview_endDate"><input class="form-control" type="date" value="%s" name="eventEndDate" id="eventEndDate" required></li>
                                    <li class="list-group-item" id="preview_endTime"><input class="form-control" type="time" value="%s" name="eventEndTime" id="eventEndTime" required></li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        ', $row->eventStartDate, $row->eventStartTime, $row->eventEndDate, $row->eventEndTime);
                        
                        echo '     
                                                <div class="d-grid">
                                                    <input class="btn btn-primary-bg" name="update" type="submit" value="Save"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        '.
                        printf('<input type="hidden" name="target" value="%s" >', $row->eventID)
                        .'</form>'; 
                    }
                    
                }
            }
        ?>
    <script>
        var loadFile = function(event) {
                var image = document.getElementById('preview_img');
                image.src = URL.createObjectURL(event.target.files[0]);
                document.getElementById('preview_selected_img').innerHTML = "<strong>Selected File : </strong>" + event.target.files[0].name;
            };
    </script>
</body>
</html>