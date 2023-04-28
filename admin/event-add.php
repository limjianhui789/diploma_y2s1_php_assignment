<?php 
    require_once("./includes/permision_checker.php");
    require_once("./includes/getServerAddr.php");
    require_once("./includes/modal_msg.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            require_once("./includes/validation.php");

            validateImage();
            validateForm();
            
        }
    }
?>

<html lang="en">
    <head>
        <title>Nitro Society - Add New Event</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/style.css">
    
    </head>
    <body style="background-image: url('./image/add_page_background.png');">
        
        <?php
            require_once("./includes/header.php");


            //Handle Event Adding Request
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['submit'])){
                    if(empty($errors)){//If Got No Error
                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        if (move_uploaded_file($_FILES["event_poster"]["tmp_name"], $target_file)) {
                            $query = "INSERT INTO nitro_poster(posterURL, posterUniq, posterDesc) VALUES('{$full_path}', '{$uniq_key}', '{$today}')";
                            $conn->query($query);
                            $eventName = $_POST['eventName'];
                            $eventDesc = $_POST['eventDesc'];
                            $eventStartDate = $_POST['eventStartDate'];
                            $eventStartTime = $_POST['eventStartTime'];
                            $eventEndDate = $_POST['eventEndDate'];
                            $eventEndTime = $_POST['eventEndTime'];
                            $eventSeat = $_POST['eventSeat'];
                            $eventPrice = $_POST['eventPrice'];
        
                            //Get Poster ID
                            $query = "SELECT posterID FROM nitro_poster WHERE posterUniq = '{$uniq_key}'";
                            $result = $conn->query($query);
                            while($row = $result->fetch_object()){
                                $posterID = $row->posterID;
                            }
        
                            $categoryName = $_POST['category'];
                            $venueName = $_POST['eventVenue'];
                            
                            
                            $query = "INSERT INTO nitro_event(eventName,eventDesc,eventStartDate,eventStartTime,eventEndDate,eventEndTime,eventSeats,seatAvailable,pricePerPax,posterID,categoryName,venueName,is_deleted,is_draft) VALUES('{$eventName}', '{$eventDesc}', '{$eventStartDate}', '{$eventStartTime}', '{$eventEndDate}', '{$eventEndTime}', {$eventSeat}, {$eventSeat}, {$eventPrice},'{$posterID}','{$categoryName}','{$venueName}', 0, 0)";
                            $conn->query($query);
                            
                            modal_msg(array("Successfully Added The Event"), "Message", "event-list.php");


        
                            //echo "The file ". htmlspecialchars( basename( $_FILES["event_poster"]["name"])). " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                            die();
                        }
                        $conn->close();
                    } else {
                        modal_msg($errors, "Errors", "");
                    }
                }
            }
        ?>

        <!-- Navigate -->
        <div class="cotainer-fluid">
            <div class=" row m-5">
                <div class="col">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb align-self-center">
                            <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                            <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Event</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navigate -->

        <div class="container my-5 rounded-3 h-100" style="background-color: #F9FAFC;">
                <!-- Outside -->
                <div class="row justify-content-between px-5 pt-5 pb-3">
                    <div class="col">
                        <p class="fs-3 fw-bold m-0">Add Event</p>
                    </div>
                    <div class="col-auto">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-back px-4" onclick="location.href = 'event-list.php'"><i class="bi bi-escape"></i> Back</button>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <form class="needs-validation" action="" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="row px-lg-5 px-0">
                            <div class="col pb-5 rounded-3" style="background-color: white">
                                <!-- Main  -->
                                <div class="row mt-4 mx-4 justify-content-between">
                                    <div class="col">
                                        <p class="m-0 fs-5 fw-semibold">Event Category</p>
                                    </div>
                                    <div class="col-auto">
                                        <p class="m-0 fs-6 text-success text-end" onclick="location.href='./category-management.php'" style="cursor: pointer;">Add New Category ></p>
                                    </div>
                                </div>

                                <div class="row mt-4 mx-4 g-2">
                                    <!-- Category Checkboxes -->
                                    <?php 
                                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                        $query = "SELECT * FROM nitro_category WHERE is_delete = 0";
                                        $result = $conn->query($query);
                                        if($result->num_rows == 0){
                                            printf('
                                            <!-- Category Checkbox (Unknown) -->
                                            <div class="col-12 col-lg-3 d-grid rounded-4" style="background-color: #F9FAFC;">
                                                <input type="radio" class="btn-check" name="category" value="unknown" id="cat_unknown" autocomplete="off" checked>
                                                    <label class="btn btn-outline-select" for="cat_unknown">
                                                        <div class="row p-1 ">
                                                            <div class="col-12 col-lg-auto align-self-center">
                                                                <i class="bi bi-columns-gap fs-5"></i>
                                                            </div>
                                                            <div class="col">
                                                                <p class="m-0 fs-5 fw-semibold text-lg-start text-center">Unknown</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                            </div>
                                            ');
                                        } else {
                                            $first = true;
                                            if(isset($_POST['category'])){
                                                $first = false;
                                            }
                                            
                                            while($row = $result->fetch_object()){
                                                $checked_status = isset($_POST['category']) ? ($_POST['category'] == $row->categoryName ? "checked" : "") : "";
                                                printf('
                                                <div class="col-12 col-lg-3 d-grid rounded-4" style="background-color: #F9FAFC;">
                                                    <input type="radio" class="btn-check" name="category" value="%s" id="cat_%s" onclick="chg_value(\'preview_category\', this.value);" autocomplete="off" %s %s>
                                                        <label class="btn btn-outline-select" for="cat_%s">
                                                            <div class="row p-1 ">
                                                                <div class="col-12 col-lg-auto align-self-center">
                                                                    <i class="%s fs-5"></i>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="m-0 fs-5 fw-semibold text-lg-start text-center">%s</p>
                                                                </div>
                                                            </div>
                                                        </label>
                                                </div>
                                                ', $row->categoryName, $row->categoryName, $first == true ? "checked" : null, $checked_status , $row->categoryName, $row->categoryIcon, $row->categoryName);  
                                                $first = false;
                                            }
                                        }

                                    ?>    
                                </div>
                                
                                <div class="row mt-4 mx-4 g-2">
                                    <!-- Choose Image -->
                                    <div class="col-12 col-lg-3">
                                        <input class="btn-check" type="file" name="event_poster" id="event_poster" onchange="loadFile(event);">
                                        <label for="event_poster">
                                            <img class="img-fluid rounded-5 mb-2" src="./image/add_poster_green.png" alt="Add Poster" style="border-style: dashed; border-color: #00983A; cursor: pointer;">
                                        </label>
                                        <p class="m-0 fw-semibold">Upload Event Poster</p>
                                        <p class="m-0 text-black-50 fw-light">Image format only allow .jpg .png .jpeg and please follow the image size ratio (1587px * 2245px)</p>
                                        <p class="m-0 mt-3 text-black-75 fw-light" id="preview_selected_img">Selected Image : None</p>
                                        
                                    </div>
                                    <!-- Input -->
                                    <div class="col">
                                        <!-- Event Name -->
                                        <div class="row px-lg-3 px-0">
                                            <div class="col">
                                                <div class="mb-3 mb-lg-3">
                                                    <label for="eventName" class="form-label">Event Name</label>
                                                    <input type="text" class="form-control" value="<?php echo (isset($_POST['eventName']) ? $_POST['eventName'] : ''); ?>" name="eventName" id="eventName" placeholder="Eg. Game Development Training" oninput="chg_value('preview_title', this.value)" required>
                                                </div>
                                            </div>
                                            <div class="valid-feedback">
                                            Looks good!
                                            </div>
                                        <!-- Event Name -->
                                        </div>

                                        <!-- Event Description -->
                                        <div class="row px-lg-3 px-0">
                                            <div class="col">
                                                <div class="mb-3 mb-lg-3">
                                                    <label for="eventDesc" class="form-label">Event Description</label>
                                                    <textarea class="form-control" id="eventDesc" name="eventDesc" rows="3" placeholder="Eg. Penang Youth Development Corporation in collabrating with TARUC..." oninput="chg_value('preview_desc', this.value)" required><?php echo (isset($_POST['eventDesc']) ? $_POST['eventDesc'] : ''); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Event Description -->
                                        <div class="valid-feedback">
                                        Looks good!
                                        </div>

                                        <!-- Event Start Date Time -->
                                        <div class="row px-lg-3 px-0">
                                            <div class="col">
                                                <div class="mb-3 mb-lg-3">
                                                    <div class="row">
                                                        
                                                        <div class="col-lg-6">
                                                            <label for="eventStartDate" class="form-label">Event Start Date</label>
                                                            <input class="form-control" type="date" value="<?php echo (isset($_POST['eventStartDate']) ? $_POST['eventStartDate'] : ''); ?>" name="eventStartDate" id="eventStartDate" oninput="chg_value('preview_startDate', this.value)" required>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label for="eventStartTime" class="form-label">Event Start Time</label>
                                                            <input class="form-control" type="time" value="<?php echo (isset($_POST['eventStartTime']) ? $_POST['eventStartTime'] : ''); ?>" name="eventStartTime" id="eventStartTime" oninput="chg_value('preview_startTime', this.value)" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Event Start Date Time-->

                                        <!-- Event End Date Time-->
                                        <div class="row px-lg-3 px-0">
                                            <div class="col">
                                                <div class="mb-3 mb-lg-3">
                                                    <div class="row">
                                                        
                                                        <div class="col-lg-6">
                                                            <label for="eventEndDate" class="form-label">Event End Date</label>
                                                            <input class="form-control" type="date" value="<?php echo (isset($_POST['eventEndDate']) ? $_POST['eventEndDate'] : ''); ?>" name="eventEndDate" id="eventEndDate" oninput="chg_value('preview_endDate', this.value)" required>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-lg-6">
                                                            <label for="eventEndTime" class="form-label">Event End Time</label>
                                                            <input class="form-control" type="time" value="<?php echo (isset($_POST['eventEndTime']) ? $_POST['eventEndTime'] : ''); ?>" name="eventEndTime" id="eventEndTime" oninput="chg_value('preview_endTime', this.value)" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Event End Date Time -->
                                        <!-- Event Seat Available & Price-->
                                        <div class="row px-lg-3 px-0">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-4 mb-lg-4">
                                                            <label for="eventSeat"  class="form-label">Event Seats</label> 
                                                            <input type="number" class="form-control" value="<?php echo (isset($_POST['eventSeat']) ? $_POST['eventSeat'] : 1); ?>" min="1" max="500" id="eventSeat" name="eventSeat" oninput="chg_value('preview_seat', this.value);chg_value('preview_maxSeat', this.value); ">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <label for="eventPrice" class="form-label">Price Per Person</label> 
                                                        <div class="input-group mb-4 mb-lg-4">
                                                            <span class="input-group-text">RM</span>
                                                            <input type="number" name="eventPrice" class="form-control"min="0" value="<?php echo (isset($_POST['eventPrice']) ? $_POST['eventPrice'] : 0); ?>" id="eventPrice" oninput="chg_value('preview_price', this.value)">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                        </div>
                                    </div>  
                                    <!-- Event Seat Available & Price-->
                                            
                                    <!-- Event Category -->
                                    <div class="row px-lg-3 px-0">
                                        <div class="col mb-3 mb-lg-3">
                                            <select class="form-select" id="eventVenue" name="eventVenue" oninput="chg_value('preview_location', this.value)" required>
                                            <?php 
                                                if(isset($_POST['eventVenue'])){
                                                    echo '<option disabled>Event Venue</option>';
                                                }else{
                                                    echo '<option selected disabled value="">Event Venue</option>';
                                                }
                                                $query = "SELECT * FROM nitro_venue WHERE is_delete = 0";
                                                    $result = $conn->query($query);
                                                    while($row = $result->fetch_object()){
                                                        printf('
                                                            <option value="%s" %s>%s</option>
                                                        ', $row->venueName, $row->venueName == $_POST['eventVenue'] ? "selected" : null, $row->venueName);
                                                    }
                                                    $conn->close();
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Event Category -->

                                    <!-- Preview Modal -->
                                    <div class="row d-flex justify-content-end">
                                        <div class="d-grid col-lg-3 mb-3">
                                            <input type="reset" class="btn btn-primary-bg" value="Reset">
                                        </div>
                                        <div class="d-grid col-lg-3 mb-3">
                                            <button type="button" class="btn btn-primary-bg" data-bs-toggle="modal" data-bs-target="#preview_modal">
                                                Preview
                                            </button>
                                        </div>
                                        <div class="d-grid col-lg-3 mb-lg-3">
                                            <input class="btn btn-primary-bg" type="submit" name="submit" value="Submit"/>
                                        </div>
                                    </div>
                                    <!-- Preview Modal -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="preview_modal" tabindex="-1" >
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container">
                        <div class="row m-3">
                            <div class="col">
                                <div class="card mb-3" >
                                    <div class="row g-0">
                                        <div class="col-lg-4">
                                            <img src="./image/img_invalid.jpg" id="preview_img" class="img-fluid rounded-start" alt="Preview Image">
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="card-body">
                                                    <h5 class="card-title" id="preview_title">Preview Title</h5>
                                                    <p class="card-text" id="preview_desc">Preview Description</p>
                                                    
                                                    <!-- General Info -->
                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <i class="bi bi-bookmark-star"></i>
                                                                <strong>Event Category</strong>
                                                                <br class="d-lg-none">
                                                                <span id="preview_category" class="badge rounded-pill text-bg-secondary">
                                                                    None
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <i class="bi bi-geo-alt"></i>
                                                                <strong>Event Location</strong>
                                                                <br class="d-lg-none">
                                                                <span id="preview_location" class="badge rounded-pill text-bg-secondary">
                                                                    None
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <i class="bi bi-people"></i>
                                                                <strong>Event Seats</strong>
                                                                <br class="d-lg-none">
                                                                <span class="badge rounded-pill text-bg-secondary">
                                                                    <output id="preview_seat">1</output>/<output id="preview_maxSeat">1</output>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <i class="bi bi-clock"></i>
                                                                <strong>Event Status</strong>
                                                                <br class="d-lg-none">
                                                                <span id="preview_status" class="badge rounded-pill text-bg-secondary">
                                                                    Upcoming
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <p>
                                                                <i class="bi bi-currency-dollar"></i>
                                                                <strong class="d-none d-lg-inline">Price Per Person</strong>
                                                                <strong class="d-lg-none">Price/Person</strong>
                                                                <br class="d-lg-none">
                                                                <span class="badge rounded-pill text-bg-secondary">
                                                                RM <output id="preview_price">0</output>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <!-- General Info -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <ul class="list-group">
                                                                <li class="list-group-item list-group-item-dark ">Start Date & Time <i class="bi bi-calendar-week"></i></li>
                                                                <li class="list-group-item" id="preview_startDate">00-00-0000 </li>
                                                                <li class="list-group-item" id="preview_startTime">00:00:00 AM</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <ul class="list-group">
                                                                <li class="list-group-item list-group-item-dark ">End Date & Time <i class="bi bi-calendar-week"></i></li>
                                                                <li class="list-group-item" id="preview_endDate">00-00-0000 </li>
                                                                <li class="list-group-item" id="preview_endTime">00:00:00 AM</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal -->
                
        </div>
        
        <script>
        var loadFile = function(event) {
            var image = document.getElementById('preview_img');
            image.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('preview_selected_img').innerHTML = "<strong>Selected File : </strong>" + event.target.files[0].name;
        };


        function chg_value(id,title_value){
            document.getElementById(id).innerText = title_value;
        }
        

        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            //const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {

                    if (!form.checkValidity()) { //If Invalid

                        event.preventDefault()
                        event.stopPropagation()
                    }
                
                    
                    form.classList.add('was-validated')
                }, false)
            })
        })()  
    </script>
        
    </body>
</html>