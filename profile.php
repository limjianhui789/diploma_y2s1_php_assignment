<?php
    session_start();
 
                
    if(!isset($_SESSION['username'])){
         die("Illegal Access, Please Login.");
    } 
    
    //echo $_SESSION['username'];
?>
<html>
    <head>
        <title>Nitro Society - User Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="css/BookingRecord.css" type="text/css"/>
        <link rel="icon" type="image/x-icon" href="image/favicon.ico">
        <!-- JQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Swiper JS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    </head>
    <body>
        <?php include('includes/header.php');?>
        
        <?php
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($con->connect_error);
        
        $query = "SELECT username, password, emailAddress, contactNum, first_name,last_name,is_admin,
                  CASE
                     WHEN gender = 'M' THEN 'Male'
                     WHEN gender = 'F' THEN 'Female'
                     WHEN gender = 'O' THEN 'Other'
                  END AS gender,is_admin,is_banned
                  FROM nitro_user
                  WHERE username = '{$_SESSION['username']}' AND is_banned = 0
                  ";
                  
        $result = $conn->query($query);
        while($row = $result->fetch_object()){
            
            $username = $row->username;
            $emailAddress = $row->emailAddress;
            $contactNum = $row->contactNum;
            $first_name = $row->first_name;
            $last_name = $row->last_name;
            $gender = $row->gender;
            if($row->is_admin == 1){
                $role = "Admin";
            }else{
                $role = "User";
            }
            printf('
 <div class="container">
            <div class="row m-3 justify-content-center">
                <div class="col p-5" style="background-color: #EBF6FC;">

                    <div class="row h-100">
                        <div class="col-lg-3"> <!-- This col is for profile pic -->
                            <img src="./admin/image/profile.jpg" alt="Profile Picture" class="img-fluid mx-auto rounded-3">
                        </div>
                        <div class="col-lg-3"> <!-- Some Profile Info -->
                            <div class="row h-auto">
                                <div class="col">
                                    <p class="m-0 fs-3 fw-bold">%s</p>
                                </div>
                            </div>
                            <div class="row h-auto mb-3">
                                <div class="col">
                                    <p class="m-0 fs-6 fw-light text-black-50">@%s</p>
                                </div>
                            </div>
                            <div class="row h-75 align-items-end">
                                <div class="col">
                                    <table class="table table-borderless align-middle text-center">

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row h-100 justify-content-end">
                                <i class="bi bi-gear-fill text-end fs-3" style="cursor: pointer;"></i>
                                <div class="col-8 align-self-end">
                                    <table class="table table-borderless text-center align-middle">
                                        <tbody>
                                            <tr class="shadow-sm rounded-3">
                                                <td><p class="m-0 text-black-50 fs-5">%s</p></td>
                                                <td><i class="bi bi-envelope fs-3 text-black-50"></i></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            <tr class="shadow-sm rounded-3">
                                                <td><p class="m-0 fw-light text-black-50 fs-5 ">%s</p></td>
                                                <td><i class="bi bi-telephone fs-3 text-black-50"></i></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            <tr class="shadow-sm rounded-3">
                                                <td><p class="m-0 fw-light text-black-50 fs-5 ">%s</p></td>
                                                <td><i class="bi bi-gender-ambiguous fs-3 text-black-50"></i></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            <tr class="shadow-sm rounded-3">
                                                <td><p class="m-0 fw-light text-black-50 fs-5 ">%s</p></td>
                                                <td><i class="bi bi-person-rolodex fs-3 text-black-50"></i></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
                
                ',$username,$last_name,$emailAddress,$contactNum,$gender, $role);
        }
        
        $result->free();
        ?>
        
        <?php 
        
        $query = "SELECT *
                  FROM nitro_event E, nitro_booking B, nitro_user U , nitro_poster P
                  WHERE B.username = '{$_SESSION['username']}' AND U.username = B.username AND U.is_banned = 0 AND B.eventID = E.eventID AND P.posterID = E.posterID
                  ";
                  
        $result = $conn->query($query);
        
        while($row = $result->fetch_object()){
           // print_r($row);
            $username = $row->username;

            $eventID = $row->eventID;
            $eventName = $row->eventName;
            $eventDesc = $row->eventDesc;
            $eventStartDate = $row->eventStartDate;
            $eventStartTime = $row->eventStartTime;
            $eventEndDate = $row->eventEndDate;
            $eventEndTime = $row->eventEndTime;
            $eventSeats = $row->eventSeats;
            $seatAvailable = $row->seatAvailable;
            $pricePerPax = $row->pricePerPax;
            $posterID = $row->posterID;
            $categoryName = $row->categoryName;
            $venueName = $row->venueName;
            $bookingID = $row->bookingID;
            $posterURL = $row->posterURL;
            
            printf('
        <div class="container bookingResult-container mt-3">
        <div class="row col-12 border p-2">
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 d-flex flex-row-reverse justify-content-center">
                <img src="%s" class="m-3 p-2 border"  alt="event" style="width: 200px; height:auto;">
            </div>

            <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 text-white" >
                <h2 class="mt-3"><span>%s</span></h2>
                <p>%s</p>
                <div class="row mt-4">
                    <div class="col-ms-6 ocl-mb-6 col-lg-6 col-xl-6">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="startDate">Start Date</h6>
                            </div>
                            <div class="col-1">
                                <h6>:</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="startDate">%s</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h6 class="startTime">Start Time</h6>
                            </div>
                            <div class="col-1">
                                <h6>:</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="startTime">%s</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h6 class="pricePerPax">Price Per Pax </h6>
                            </div>
                            <div class="col-1">
                                <h6>:</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="pricePerPax">RM %s</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-ms-6 ocl-mb-6 col-lg-6 col-xl-6">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="startDate">End Date</h6>
                            </div>
                            <div class="col-1">
                                <h6>:</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="startDate">%s</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h6 class="startTime">End Time</h6>
                            </div>
                            <div class="col-1">
                                <h6>:</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="startTime">%s</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <h6>Category</h6>
                    </div>
                    <div class="col-auto">
                        <h6>:</h6>
                    </div>
                    <div class="col-auto">
                        <h6>%s</h6>
                    </div>
                </div>
            </div>

            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 align-self-end">
              <div class="row">
                <div class="col">
                  <form method="GET" action="ticket.php">
                      <div class="d-grid">
                        <button class="quickEvent mb-3" type="submit">VIEW TICKET</button>
                        <input type="hidden" name="bookingID" value="%s" >
                      </div>
                  </form>
                </div>
              </div>
                <div class="row">
                  <div class="col">
                    <form method="post" action="invoice.php" >
                      <div class="d-grid">
                        <button class="quickEvent mb-3" type="submit">CHECK INVOICE</button>
                        <input type="hidden" name="username" value="%s" >
                        <input type="hidden" name="eventID" value="%s" >
                        <input type="hidden" name="eventName" value="%s" >
                        <input type="hidden" name="eventPrice" value="%s" >
                        <input type="hidden" name="bookingDate" value="%s" >
                      </div>
                    </form>
                  </div>
                </div>
                
            </div>
        </div>
        </div>  
                ',$posterURL,$eventName,$eventDesc,$eventStartDate,$eventStartTime,$pricePerPax,$eventEndDate,$eventEndTime,$categoryName,$bookingID,$username,$eventID,$eventName,$pricePerPax,$eventStartDate);

        }
            
        ?>

        


    <?php
    include('includes/footer.php');
    ?>
    <!--Swiper JS-->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/homepage.js"></script>

<script type="text/javascript">
//Javascript


var swiper = new Swiper(".profile-card-slider", {
  slidesPerView: 3,
  spaceBetween: 5,
  centeredSlides: true,
  freeMode: true,
  grabCursor: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 4000,
    disableOnInteraction: false
  },
  breakpoints:{
    100:{
      slidesPerView:1
    },
    500:{
      slidesPerView:1
    },
    700:{
      slidesPerView:1
    },
    900:{
      slidesPerView:1
    },
    1000:{
      slidesPerView:3
    }
  }
});      


var swiper = new Swiper(".swiper-container", {
  slidesPerView: 5,
  spaceBetween: 40,
  slidesPerGroup: 3,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints:{
    100:{
      slidesPerView:1,
      slidesPerGroup:1
    },
    500:{
      slidesPerView:1,
      slidesPerGroup:1
    },
    700:{
      slidesPerView:1,
      slidesPerGroup:1
    },
    900:{
      slidesPerView:2,
      slidesPerGroup:1
    },
    1000:{
      slidesPerView:4,
      slidesPerGroup:1
    }
  }
}); 
//JQuery
$(document).ready(function(){
    //Query for toogle sub menus
    $(".sub-btn").click(function(){
        $(this).next(".sub-menu").slideToggle();
        $(this).find(".dropdown").toggleClass('rotate');
    });

    //Jquery fpr expand and collapse the sidebar
    $(".menu-btn").click(function(){
        $(".side-bar").addClass('active');
        $(".menu-btn").css("visibility","hidden");
    });

    $(".close-btn").click(function(){
        $(".side-bar").removeClass('active');
        $(".menu-btn").css("visibility","visible");

    });


    $(window).bind('scroll',function(){
        var gap = 50;
        if($(window).scrollTop() > gap){
            $('header').addClass('activeScroll');
        }else{
            $('header').removeClass('activeScroll');
        }
    });
});       


</script>
    </body>
</html>