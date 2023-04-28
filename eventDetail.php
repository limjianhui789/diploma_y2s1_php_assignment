<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
    session_start();
    require_once('./admin/includes/modal_msg.php');

?>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <title>Event</title>
        <link rel="icon" type="image/x-icon" href="image/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <link rel="stylesheet"  href="css/event_design.css" type="text/css">
        <link rel="stylesheet" href="css/homepage.css" type="text/css"/>
    </head>
<div class="row">
    <div class="col"></div>
</div>
    <body>
<?php
    include 'includes/header.php';

    if(!isset($_SESSION['username'])){
        modal_msg(array("Illegal Access, Please Login"), "Error", "signin.php");
        die();
    }

?>    

<?php
require_once './includes/database-connector.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($con->connect_error);
$query = "
        SELECT *
        FROM nitro_event
        WHERE eventID = '{$_GET['eventID']}'
        ";

$result = $conn->query($query);

while($row = $result->fetch_object()){
    //print_r($row);

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


    printf('
    <div class="">
    <div class="row" id="eventTitle">
           <div class="event-name text-white">
               <h1 class="mt-5 pt-5">%s</h1>
               <hr id="breakingLine">
               <h2>%s</h2>
               <hr id="breakingLine">
           </div>
       </div>

       <div class="container event-detail-container">
           <div class="row1">
               <table class="event-content">
                   <tr>
                       <td>
                           <img src="clientImage/EventPicture/Pictures/event1.jpg" class="card-img-details " alt="Event 1">
                       </td>
       
                       <td>
                           <div class="words text-white">
                               <h1>%s</h1>
                               <p>%s</p> 
                           </div>
                          
                           <div class="button-detail">
                               <form action="joinEvent.php" method="POST">
                                   <input type="submit" class="btn btn-primary" value="Join In">
                                   <input type="hidden" name="eventID" value="%s">
                                   <input type="hidden" name="eventName" value="%s">
                                   <input type="hidden" name="eventPrice" value="%s">
                               </form>
                           </div>
                       </td>
                   </tr>
               </table>
           </div>
       </div>
</div>
    
    ',$eventName,$eventDesc,$eventName,$eventDesc,$eventID,$eventName,$pricePerPax);

}



?>
<?php
    include 'includes/footer.php';
?>  
<!--Swiper JS-->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>     
 <script>
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
