<?php
    session_start();
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Creative Event - Login Page</title>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        
        <?php
            if(isset($_COOKIE['username'])){
                //HTTP_HOST = localhost:3000 
                //SCRIPT_NAME = /signin.php
                header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['SCRIPT_NAME']}/../profile.php");
                die();
            }

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['signin'])){
                    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
                    $password = isset($_POST['password']) ? $_POST['password'] : null;
                    $rememberme = isset($_POST['rememberMe']) ? $_POST['rememberMe'] : null;

                    echo '
                        <div class="modal fade" tabindex="-1" id="result">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Login Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.href=\'../index.php\'"></button>
                                </div>
                                <div class="modal-body">
                                    
                                
                        ';
                    
                    require_once('./admin/includes/sql_connection.php');
                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    if($conn->connect_error){
                        die("Connection Error :".$conn->connect_error);
                    }
                    $login_success = 0;
                    $is_admin = 0;
                    $query = "SELECT username, password, is_admin, is_banned FROM nitro_user WHERE username = '{$username}'";
                    $result = $conn->query($query);
                    if($result->num_rows > 0 ){
                        if($username != null && $password != null){
                            while($row = $result->fetch_object()){
                                if($row->username === $username){
                                    if($row->password === $password){//Login Success
                                        if($row->is_banned == 0){
                                            if($rememberme == null){
                                                echo "<p><strong>Login Successfully TEST 123</strong></p>";
                                                $_SESSION['ExpTime'] = time()+3600;
                                                $_SESSION['username'] = $username;
                                                $login_success = 1;
                                            }else{
                                                $_SESSION['ExpTime'] = time()+10800;
                                                $_SESSION['username'] = $username;
                                                echo "<p><strong>Login Successfully Test 123</strong></p>";
                                                echo "<p>Remember Me : 3 Hours</p>";
                                                $login_success = 1;
                                            }
                                            if($row->is_admin == 1){
                                                $is_admin = 1;
                                            } 
                                        }else{
                                            echo "<p>Account Is Banned, You are not able to login.</p>";
                                        }
                                                                         
                                    } else {
                                        echo "<p>Username Or Password Is Incorrect</p>";
                                    }
                                } else {
                                    echo "<p>Username Or Password Is Incorrect</p>";
                                }
                            }
                        } else {
                            echo "<p>Username Or Password Cannot Be Empty</p>";
                        }
                        
                    } else {
                        echo '<p>User Not Found</p>';
                    }

                    echo '
                        </div>
                            <div class="modal-footer">
                        ';
                    if($login_success == 1){
                        if($is_admin == 1){
                            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href=\'./admin/index.php\' ">Close</button>';
                        }else{
                            echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href=\'./index.php\' ">Close</button>';
                        }
                        
                    } else {
                        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ">Close</button>';
                    }
                    echo '
                    </div>
                            </div>
                            </div>
                        </div>
                        <script>
                            const myModal = new bootstrap.Modal("#result", {
                                keyboard: false
                                })
                            myModal.show()
                        </script>
                    ';
                    $result->free();
                    $conn->close();
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
                               <button class="btn-icon" onclick="location.href = 'index.php'">
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
                                <p class="text-start fs-5 fw-semibold">Login Page</p>
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                                    <div class="mb-3 input-group input-group-lg">
                                        <span style="background-color: white; " class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input class="form-control" type="text" id="username" name="username" placeholder="Username"/>
                                    </div>
                                    <div class="input-group input-group-lg mb-3">
                                        <span style="background-color: white; " class="input-group-text"><i class="bi bi-key"></i></span>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Password"/>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-check form-switch form-check-lg">
                                        <input class="form-check-input btn-switch" role="switch" type="checkbox" value="Y" id="remmemberMe" name="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <a href="" class="link-dark text-decoration-none">Forgot Your Password ?</a>
                                        </div>
                                    </div>
                                    <input type="submit" id="signin" name="signin" value="Sign In" class="btn-check"/>
                                </form>
                            </div>
                        </div>
                        <div class="row d-grid gap-2 col-10 mx-auto mb-3">
                            <label class="btn btn-primary btn-lg fw-semibold" for="signin"><i class="bi bi-box-arrow-in-right"></i>&nbsp;&nbsp;Sign In</label>
                        </div>
                        <div class="row d-grid gap-2 col-10 mx-auto mb-5">
                            <button class="btn btn-outline-primary btn-lg fw-semibold" type="button" onclick="location.href='signup.php'"><i class="bi bi-people-fill"></i>&nbsp;&nbsp;Sign Up</button>
                        </div>
                        <div class="row px-5 mb-3">
                            <hr class="hr-style"/>
                        </div>
                        <div class="row d-grid gap-2 col-10 mx-auto">
                            <button class="btn btn-facebook btn-lg fw-semibold" type="button"><i class="bi bi-facebook"></i></i>&nbsp;&nbsp;Facebook Sign  In</button>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-8 right-panel d-lg-block d-none d-md-none">
                    <img src='image/login_background.png' />
                </div>
            </div>
        </div>

    </body>
    
</html>
