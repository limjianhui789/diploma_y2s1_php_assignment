<?php 
    require_once("./includes/permision_checker.php");
?>
<html lang="en">
    <head>
        <title>Nitro Society - Add New Event</title>
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
            require_once("includes/getServerAddr.php");
        ?>

        <!-- Navigate -->
        <div class="cotainer-fluid">
            <div class=" row m-5">
                <div class="col">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb align-self-center">
                            <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                            <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category Management</li>
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
                        <p class="fs-3 fw-bold m-0">Category Management</p>
                    </div>
                    <div class="col-auto">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-back px-4" onclick="history.back()"><i class="bi bi-escape"></i> Back</button>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <form action="<?php echo $serverAddress; ?>/admin/includes/category_request.php" method="POST">
                        <div class="row px-lg-5 px-0">
                            <div class="col pb-5 rounded-3" style="background-color: white">
                                <div class="row mt-4 mx-4 g-2">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-add" id="cat_add" data-bs-toggle="modal" data-bs-target="#add_modal">
                                            <span class="bi bi-plus-circle-dotted fs-4 p-1"></span>
                                        </button>
                                    </div>
                                    
                                    <!-- List Category -->
                                    <?php 
                                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                        $query = "SELECT * FROM nitro_category WHERE is_delete = 0";
                                        $result = $conn->query($query);
                                        while($row = $result->fetch_object()){
                                            if($row->categoryName == "Unknown"){
                                                printf('
                                                <!-- Unknown Category -->
                                                <div class="col-auto d-grid">
                                                    <input type="button" class="btn-check" name="category" id="cat_workshop" disabled>
                                                    <label class="btn btn-select" for="cat_workshop">
                                                        <div class="row p-1">
                                                            <div class="col-auto align-self-center pe-0">
                                                                <i class="bi bi-columns-gap fs-4"></i>
                                                            </div>
                                                            <div class="col align-self-center">
                                                                <p class="m-0 fs-5 text-start">Unknown</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                ');
                                            } else {
                                            printf('
                                                <div class="col-auto d-grid">
                                                <input type="button" class="btn-check" name="category" value="%s" id="cat_%s" data-bs-toggle="modal" data-bs-target="#ED_modal" 
                                                onclick="
                                                change_icon(\'iconEdit_preview\', \'%s\');
                                                change_name(\'iconEdit_preview_text\', this.value); 
                                                change_value(\'floatEdit_cat_name\', this.value);
                                                change_value(\'floatEdit_font_name\', \'%s\');
                                                select_element(\'selected_element\', \'%s\');
                                                select_element(\'oriCatName\', \'%s\');
                                                ">
                                                <label class="btn btn-select" for="cat_%s">
                                                    <div class="row p-1">
                                                        <div class="col-auto align-self-center pe-0">
                                                            <i class="%s fs-4"></i>
                                                        </div>
                                                        <div class="col align-self-center">
                                                            <p class="m-0 fs-5 text-start">%s</p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            ', $row->categoryName,$row->categoryName,$row->categoryIcon,$row->categoryIcon,$row->categoryName,$row->categoryName,$row->categoryName,$row->categoryIcon, $row->categoryName);
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        
                        <!--Add Modal -->
                            <div class="modal fade" id="add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Cateogry</h5>
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
                                                            
                                                        </div>
                                                        <div class="col align-self-center" id="icon_preview_text">
                                                            
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="float_cat_name" name="cat_name" placeholder="Sing" oninput="change_name('icon_preview_text', this.value)">
                                            <label for="float_cat_name">Category Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="float_font_name" name="cat_icon" placeholder="bi-1-circle" oninput="change_icon('icon_preview', this.value)">
                                            <label for="float_font_name">Icon Font Name</label>
                                        </div>
                                        <div id="passwordHelpBlock" class="form-text">
                                            Enter The Icon Font Name Eg. bi bi-columns-gap<br>You are able refer to Bootstrap Icons <a href="https://icons.getbootstrap.com/">https://icons.getbootstrap.com/</a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary-bg" value="Submit" name="add">
                                    </div>
                                    </div>
                                </div>
                            </div>
                        
                        <!--Edit & Delete Modal -->
                        <div class="modal fade" id="ED_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cat_label">Edit & Remove Cateogry</h5>
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
                                                        
                                                    </div>
                                                    <div class="col align-self-center" id="iconEdit_preview_text">
                                                        
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="hidden" name="oriCatName" id="oriCatName" value="">
                                        <input type="text" class="form-control" id="floatEdit_cat_name" value="" oninput="change_name('iconEdit_preview_text', this.value); select_element('newCatname', this.value)">
                                        <label for="floatEdit_cat_name">Category Name</label>
                                        <input type="hidden" name="new_cat_name" id="newCatname" value="">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatEdit_font_name" value="" oninput="change_icon('iconEdit_preview', this.value); select_element('newCaticon', this.value)">
                                        <label for="floatEdit_font_name">Icon Font Name</label>
                                        <input type="hidden" name="new_cat_icon" id="newCaticon" value="">
                                    </div>
                                    <div id="passwordHelpBlock" class="form-text">
                                        Enter The Icon Font Name Eg. bi bi-columns-gap<br>You are able refer to Bootstrap Icons <a href="https://icons.getbootstrap.com/">https://icons.getbootstrap.com/</a>
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
                                    <h5 class="modal-title" id="cat_remove_confirm">Remove Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Dynamic Content : Are you sure want to remove (Talk) Category ?-->
                                    Are you sure you want to delete this category ?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ED_modal">Cancel</button>
                                    <input type="submit" class="btn btn-danger" value="Remove" name="delete">
                                    <input type="hidden" name="target" id="selected_element" value="">
                                </div>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
        <script>
            function change_icon(id, value){
                document.getElementById(id).innerHTML = "<i class=\""+value+" fs-4\"></i>";
            }
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