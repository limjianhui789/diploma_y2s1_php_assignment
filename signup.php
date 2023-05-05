<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Creative Event - Register Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="./image/favicon.ico">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/login.css">
        <link rel="icon" type="image/x-icon" href="image/favicon.ico">

    </head>
    <body>     
        
        
        
        <?php

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                require_once("./admin/includes/signup-request.php");
                require_once("./admin/includes/sql_connection.php");
                require_once('./admin/includes/email-request.php');
                require_once("./admin/includes/modal_msg.php");
                
                if(isset($_POST['submit'])){
                    
                    $username = isset($_POST['username']) ? trim($_POST['username']) : null;

                    $password = isset($_POST['password']) ? $_POST['password'] : null;

                    $cfm_password = $_POST['cfm-password'] ? $_POST['cfm-password'] : null;

                    $email = isset($_POST['email']) ? trim($_POST['email']) : null ;

                    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : null;

                    $first_name = isset($_POST['first_name']) ? trim(ucfirst($_POST['first_name'])) : null;

                    $last_name = isset($_POST['last_name']) ? trim(ucfirst($_POST['last_name'])) : null;

                    $gender = isset($_POST['gender']) ? trim(strtoupper($_POST['gender'])) : null;

                    if(empty($error=validateRegister())){
                        
                        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        if($conn->connect_error){
                            die("SQL Connection Error, Please Contact Admin<br>Error : ".$conn->connect_error);
                        }
                        $query = "INSERT INTO nitro_user VALUES(?, ?, ?, ?, ?, ?, ?, 0, 0)";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('sssssss', $username, $password, $email, $contact, $first_name, $last_name, $gender);
                        $stmt->execute();

                        $plain_html = "Successfully Register As a Member in Creative Event";
                        sendMail($email, "Hi, {$last_name}" , file_get_contents("admin/includes/email-template/register.html") , $plain_html);
                        modal_msg(array("Register Successfully"), "Success", "signin.php");
                        $stmt->close();
                        $conn->close();
                        
                    }
                      
                    else{
                        
                        modal_msg($error, "Errors", "");
                        $error = array();
                    }
                    
                }
            }

            
        ?>
        
        <!-- Side Content -->
        <div class="container-fluid ">
            <div class="row min-vh-100">
                <div class="col-12 col-lg-4 side-panel justify-content-center">
                    <div style="padding:30px;" class="container-fluid">
                        <div class="row mb-5">
                            <div class="col">
                               <button class="btn-icon" onclick="location.href = './signin.php'">
                                    <i style="font-size: 2rem;" class="bi bi-arrow-left-circle"></i>
                                </button> 
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col overflow-hidden">
                                <img src="image/logo.png" class="mx-auto d-block logo-cropped img-fluid" alt="logo"/>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col">
                                <form class="needs-validation" method="POST" action="" novalidate>
                                    <div class="row">
                                        <div class="col">
                                            <p class="text-start fs-5 fw-semibold">Register Page</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="col">
                                                <div class="mb-3 input-group input-group-lg">
                                                    <label style="background-color: white; " for="username" class="input-group-text"><i class="bi bi-person"></i></label>
                                                    <input class="form-control" type="text" id="username" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? trim($_POST['username']) : ""; ?>" maxlength="20"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3 input-group input-group-lg">
                                                <label style="background-color: white; " for="password" class="input-group-text"><i class="bi bi-key"></i></label>
                                                <input class="form-control" type="password" id="password" name="password" placeholder="Password" maxlength="20"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3 input-group input-group-lg">
                                                <label style="background-color: white;" for="cfm-password" class="input-group-text"><i class="bi bi-key"></i></label>
                                                <input class="form-control" type="password" id="cfm-password" name="cfm-password" placeholder="Confirm Password" maxlength="20"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3 input-group input-group-lg">
                                                <label style="background-color: white;" for="email" class="input-group-text"><i class="bi bi-envelope"></i></label>
                                                <input class="form-control" type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? trim($_POST['email']) : "" ; ?>" placeholder="Email Address" maxlength="50"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3 input-group input-group-lg">
                                                <label style="background-color: white;" for="contact" class="input-group-text"><i class="bi bi-phone"></i></label>
                                                <input class="form-control" type="tel" id="contact" name="contact" value="<?php echo isset($_POST['contact']) ? trim($_POST['contact']) : "" ?>" placeholder="019-9999999(9)" maxlength="20"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3 input-group input-group-lg">
                                                <label style="background-color: white;" for="first_name" class="input-group-text"><i class="bi bi-person"></i></label>
                                                <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name" value="<?php echo isset($_POST['first_name']) ? trim($_POST['first_name']) : ""; ?>" maxlength="20"/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3 input-group input-group-lg">
                                                <label style="background-color: white;" for="last_name" class="input-group-text"><i class="bi bi-person"></i></label>
                                                <input class="form-control" type="text" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo isset($_POST['last_name']) ? trim($_POST['last_name']) : ""; ?>" maxlength="30"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="input-group input-group-lg">
                                                <label style="background-color: white; " class="input-group-text" for="gender"><i class="bi bi-gender-trans"></i></label>
                                                <select id="gender" name="gender" class="form-select form-select-lg">
                                                    <?php
                                                        if(isset($_POST['gender'])){
                                                            $gender = trim(strtoupper($_POST['gender']));
                                                            echo '<option value="" disabled>Gender</option>';
                                                            if($gender == 'M'){
                                                                echo '
                                                                    <option value="M" selected>Male</option>
                                                                    <option value="F">Female</option>
                                                                    <option value="O">Other</option>
                                                                ';
                                                            }
                                                            elseif($gender == 'F'){
                                                                echo '
                                                                    <option value="M">Male</option>
                                                                    <option value="F" selected>Female</option>
                                                                    <option value="O">Other</option>
                                                                ';
                                                            }else{
                                                                echo '
                                                                    <option value="M">Male</option>
                                                                    <option value="F">Female</option>
                                                                    <option value="O" selected>Other</option>
                                                                ';
                                                            }

                                                        }else{
                                                            echo '
                                                                <option value="" selected disabled>Gender</option>
                                                                <option value="M">Male</option>
                                                                <option value="F">Female</option>
                                                                <option value="O">Other</option>
                                                            ';
                                                        }
                                                        
                                                    ?>
                                                  </select>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row d-grid gap-2 col-12 mx-auto mb-3">
                                        <button class="btn btn-primary btn-lg fw-semibold" type="submit" name="submit" value="Submit"><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;Register Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="d-none d-lg-block col-lg-8 right-panel">
                    <img src='image/login_background.png' />
                </div>
            </div>
        </div>
        
    </body>
    
</html>
