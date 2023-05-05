<?php 
    require_once("./includes/permision_checker.php");
?>
<html lang="en">
    <head>
        <title>Creative Event - Venue Management</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
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
            <div class=" row m-5">
                <div class="col">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb align-self-center">
                            <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                            <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Venue Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navigate -->
        
        <div class="container h-75 rounded-3" style="background-color: #F9FAFC;">
            <!-- Outside -->
            <div class="row justify-content-between px-5 pt-5 pb-3">
                <div class="col">
                    <p class="fs-3 fw-bold m-0">Venue Management</p>
                </div>
                <div class="col-auto">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-back px-4" onclick="history.back()"><i class="bi bi-escape"></i> Back</button>
                    </div>
                </div>
            </div>

            <!-- Inside -->
            <div class="container rounded-3">
                <div class="row px-lg-5 px-0">
                    <div class="col pb-5 rounded-3 bg-white">
                    <!-- Main  -->
                    <div class="row mt-4 mx-4">
                        <div class="col">
                            <p class="m-0 fs-5 fw-semibold">Existing Venue</p>
                        </div>
                    </div>
                    <div class="row mt-4 mx-4">
                        <form action="/admin/includes/venue_request.php" method="POST">
                            
                            <div class="row">
                                <!-- Add Venue Button -->
                                <div class="col-12 col-lg-3 d-grid mb-3 rounded-4" style="background-color: #F9FAFC;">

                                    <input type="button" class="btn-check" id="venue_add" data-bs-toggle="modal" data-bs-target="#add_modal" oninput="change_name('venue_add', this.value)">
                                    <label class="btn btn-add" for="venue_add">
                                        <div class="row p-1 ">
                                            <div class="col-12 col-lg-auto align-self-center">
                                                <span class="bi bi-plus-circle-dotted fs-5 p-1"></span>
                                            </div>
                                            <div class="col">
                                                <p class="m-0 fs-5 fw-semibold text-lg-start text-center">Add Venue</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <!-- Venue List -->
                                <?php 
                                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                    $query = "SELECT * FROM nitro_venue WHERE is_delete = 0";
                                    $result = $conn->query($query);
                                    $currentVenue = 2;
                                    while($row = $result->fetch_object()){
                                        if($row->venueName == "Unknown"){
                                            printf('
                                            <div class="col-12 col-lg-3 d-grid rounded-4 mb-3" style="background-color: #F9FAFC;">

                                            <input type="button" class="btn-check" disabled>
                                            <label class="btn btn-outline-select" for="venue_1" >
                                                <div class="row p-1 ">
                                                    <div class="col-12 col-lg-auto align-self-center">
                                                        <i class="bi bi-building fs-5"></i>
                                                    </div>
                                                    <div class="col">
                                                        <p class="m-0 fs-5 fw-semibold text-lg-start text-center">Unknown</p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                            ');
                                        }else{
                                            printf('
                                            <div class="col-12 col-lg-3 d-grid rounded-4 mb-3" style="background-color: #F9FAFC;">
        
                                            <input type="button" class="btn-check" value="admin_a_lab_a" name="venue_list" id="venue_%d" data-bs-toggle="modal" data-bs-target="#ED_modal"
                                            onclick="
                                                change_value(\'floatEdit_venue_name\', \'%s\');
                                                change_name(\'venueEdit_preview_text\', \'%s\');
                                                select_element(\'target\', \'%s\');
                                            ">
                                            <label class="btn btn-outline-select" for="venue_%d">
                                                <div class="row p-1 ">
                                                    <div class="col-12 col-lg-auto align-self-center">
                                                        <i class="bi bi-building fs-5"></i>
                                                    </div>
                                                    <div class="col">
                                                        <p class="m-0 fs-5 fw-semibold text-lg-start text-center">%s</p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                            ',$currentVenue, $row->venueName, $row->venueName, $row->venueName,$currentVenue, $row->venueName);
                                        }
                                        $currentVenue++;
                                    }
                                        
                                    
                                ?>


                            
                        <!--Add Modal -->
                        <div class="modal fade" id="add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Venue</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <p class="fs-4">Preview</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-auto mb-3">
                                            <label class="btn btn-select">
                                                <div class="row p-1">
                                                    <div class="col-auto align-self-center pe-0" id="icon_preview">
                                                        <i class="bi bi-building fs-5"></i>
                                                    </div>
                                                    <div class="col align-self-center" id="icon_preview_text">
                                                        
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="float_venue_name" name="venue_name" placeholder="Sing" oninput="change_name('icon_preview_text', this.value)">
                                        <label for="float_venue_name">Venue Name</label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary-bg" name="add" value="Submit">
                                </div>
                                </div>
                            </div>
                        </div>
                            <!--Add Modal -->
    

                            <!--Edit & Delete Modal -->
                            <div class="modal fade" id="ED_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="venue_label">Edit & Remove Venue</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row justify-content-center">
                                            <div class="col-auto">
                                                <p class="fs-4">Preview</p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-auto mb-3">
                                                <label class="btn btn-select">
                                                    <div class="row p-1">
                                                        <div class="col-auto align-self-center pe-0" id="iconEdit_preview">
                                                            <i class="bi bi-building fs-5"></i>
                                                        </div>
                                                        <div class="col align-self-center" id="venueEdit_preview_text">
                                                            
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatEdit_venue_name" name="new_venue_name" value="" oninput="change_name('venueEdit_preview_text', this.value);">
                                            <label for="floatEdit_venue_name">Venue Name</label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary-bg" name="update" value="Update">
                                        <input type="button" class="btn btn-danger" value="Remove" data-bs-toggle="modal" data-bs-target="#confirmation_modal">
                                    </div>

                                    </div>
                                </div>
                            </div>

                            <!--Delete Confirmation Modal -->
                            <div class="modal fade" id="confirmation_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="venue_delete_label">Remove Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Dynamic Content : Are you sure want to remove (Talk) Category ?-->
                                        Are you sure you want to delete this venue ?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ED_modal">Cancel</button>
                                        <input type="submit" class="btn btn-danger" name="delete" value="Remove">
                                    </div>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="target" id="target" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function change_name(id, value){
                document.getElementById(id).innerHTML = "<p class='m-0 fs-5 d-inline-block text-start'>"+value+"</p>";
            }
            function change_value(id,value){
                document.getElementById(id).value = value;
            }
            function select_element(id,value){
                document.getElementById(id).value = value;
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>