<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.min.js" integrity="sha512-8Y8eGK92dzouwpROIppwr+0kPauu0qqtnzZZNEF8Pat5tuRNJxJXCkbQfJ0HlUG3y1HB3z18CSKmUo7i2zcPpg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <!-- Animation PlugIn-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- JQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Swiper JS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="" type="text/css"/>
    
</head>
<body>
<style>
.dropdown-btn-li {
    color: #fff;
    text-decoration: none;
    font-size: 1.5rem;
    padding: 0 20px;    
    background: none;
    border: none;
}

.dropdown-menu-linkCategory {
    
  margin-left: 100px;
}

.dropdown-menu-content {
  display: none;
  position: absolute;
  background-color: #130e0e;
  right: 0px;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-menu-content a {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-btn-li:hover{
    background: none;
    color: rgb(50, 31, 100);
    transition: all 0.2s ease-in-out;
}

.dropdown-menu-content a:hover {
    background-color: #382f66;
    transition: all .2s ease-in-out;
}

.dropdown-menu-linkCategory:hover .dropdown-menu-content {
  display: block;
}

  
.dropdown-menu-linkCategory:hover .dropdown-menu-content {
    display: block;
}

/* Admin button*/
.admin-side {
    background-color: #110352; 
    border: none;
    position: absolute;
    top: 13px;
    right: 65px;
    border-radius: 24px;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
} 
</style>
        <!-- Side bar-->
        <div class="menu-btn" style="position: fixed; color: white;font-size: 20px;margin: 20px;left: 20px;cursor: pointer;z-index: 9999;">
            <i class="fas fa-bars"></i>
        </div>
        <div class="side-bar">
            <div class="menu">
                <div class="close-btn">
                    <i class="fas fa-times"></i>
                </div>

                <div class="side-logo">
                    <!--- Logo/White--->
                    <img src="./clientImage/clientLogo/WhiteSuitableSizeLogo.png" alt="side-logo" >
                </div>
    
                <div class="item"><a href="./index.php"><i class="fas fa-desktop"></i>Home</a></div>
                <div class="item"><a href="./eventbrowser.php"><i class="fas fa-desktop"></i>Browse Event</a></div>
                <div class="item"><a href="./searchEvent.php"><i class="fas fa-desktop"></i>Search Event</a></div>

                <div class="item">
                    <a class="sub-btn"><i class="fas fa-cogs"></i>Reservation<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <a href="./profile.php" class="sub-item">Profile & Bookings</a>
                        
                    </div>
                </div>
                <div class="item"><a href="./aboutUS.php"><i class="fas fa-info-circle"></i>About Us</a></div>
            </div>
        </div>
    
        <!--End Side bar-->

        <!-- Navigatin Bar-->
    <header>
            <img class="logo-img" src="./clientImage/clientLogo/WhiteSuitableSizeLogo.png" alt="nav_logo">
            <?php
            if(isset($_GET['submit'])){
                $input = $_GET['searchbox'];
            }
            ?>
            <div class="container" id="searchbar">
                <form action="searchEvent.php" method="get" class="search-bar">
                    <input type="text" placeholder="search anything" name="searchbox">
                    <button type="submit" name="submit" value="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            
            <?php 
                
                require_once('database-connector.php');
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($conn->connect_error);
                if(isset($_SESSION['username'])){
                    $username = $_SESSION['username'];
                    $query = "SELECT username, is_admin FROM nitro_user WHERE username = '{$username}' ";
                    $result = $conn->query($query);
                    while($row = $result->fetch_object()){
                        printf(' 
                        <div class="admin-button">
                            <a href="./admin/index.php" class="admin-side"><i class="fa-solid fa-user-plus"></i></a>
                        </div>   
                            ');
                    }
                }
                ?>
            
           
           
        <div class="navigation">
            <input type="checkbox" id="nav-checkbox">
            <lable for="nav-checkbox" class="nav-toggle">
                <img src="" alt="open menu" class="open">
                <img src="" alt="close menu" class="close">
            </lable>
            
                    

            <div class="dropdown-menu-linkCategory">
                <button class="dropdown-btn-li"><i class="far fa-user-circle"></i></button>
                <div class="dropdown-menu-content">
                    <a href="signin.php">Login</a>
                    <a href="profile.php">Profile & History</a>
                    
                    <form action="action" method="POST">
                        <a href="logout.php">Log Out</a>
                    </form>
                </div>
            </div>
        </div>
       
    </header>

    <!-- End Navigation Bar-->


</body>
</html>