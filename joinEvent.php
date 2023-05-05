<?php 
    session_start();
    require_once('./admin/includes/modal_msg.php');
    require_once('./admin/includes/sql_connection.php');
    require_once('./admin/includes/getEventStatus.php');
?>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="image/favicon.ico"> 
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
    
    <link rel="stylesheet"  href="css/joinEvent.css" type="text/css"/>
    <link rel="stylesheet"  href="css/homepage.css" type="text/css">
    </head>

    <body>
    <?php 
      require_once('./includes/header.php'); 

      if(!isset($_SESSION['username'])){
          modal_msg(array("Illegal Access, Please Login"), "Error", "signin.php");
          die();
      }elseif(!isset($_POST['eventID']) && !isset($_POST['eventName']) && !isset($_POST['eventPrice'])){
          modal_msg(array("Illegal Direct Access"), "Error", "index.php");
          die();
      }elseif(isset($_POST['eventID'])){
          $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          $query = "
                SELECT eventStartDate, eventStartTime, eventEndDate, eventEndTime
                FROM nitro_event
                WHERE eventID = {$_POST['eventID']}
          ";
          $result = $conn->query($query);
          $row = $result->fetch_object();
          //getStatus($eventStartDate, $eventEndDate, $eventStartTime, $eventEndTime){
          $eventStatus = getStatus($row->eventStartDate, $row->eventEndDate, $row->eventStartTime, $row->eventEndTime);
          if($eventStatus == "Error"){
              modal_msg(array("Event Date Time Error"), "Error", "index.php");
              die();
          }else if($eventStatus == "Expired"){
              modal_msg(array("You are not able to join expired event"), "Error", "index.php");
              die();
          }
      }

    ?>    
        
        <div class="container" id="joinInBox">
            <div class="form-box">
                <div class="left"></div>
                <div class="right">
                    <form action="payment.php" method="POST">
                        <h2>Please fill out your details before you join!</h2>
                        <?php 
                        printf('<h3>Event Selected : %s</h3>', $_POST['eventName']);
                        ?>
                        <br>
                        <h3>Your information:</h3>

                        <!-- Hidden Data For Payment -->
                        <input type="hidden" name="eventName" value=<?php echo "'{$_POST['eventName']}'"; ?> >
                        <input type="hidden" name="eventID" value=<?php echo "'{$_POST['eventID']}'"; ?> >
                        <input type="hidden" name="eventPrice" value=<?php echo "'{$_POST['eventPrice']}'"; ?> >
                        <input type="hidden" name="username" value=<?php echo "'{$_SESSION['username']}'"; ?> >

                        <input type="text" class="field" name="name" placeholder="Your Name" required>
                        <input type="email" class="field" name="email" placeholder="Your Email" required>
                        <input type="tel" class="field" name="phoneNo" placeholder="Phone" required>
                        <input type="text" class="field" name="studentID" placeholder="Student ID" required>
                        <input type="number" min=1 step=1 class="field" name="quantity" placeholder="Ticket Quantity" required>
                        <br>
                        <button class="button" type="submit" value="submit">Submit</button>
                        <button class="button" type="reset" value="reset">Reset</button>
                    </form>

                    
                </div>
            </div>
        </div>
        
     <!-- Footer -->
    <footer class="text-white pt-5 pb-4 ">
        <div class="container text-md-start">
          <div class="row text-center text-md-start"> <!--container text-center text-md-start mt-5-->


            <div class="col-md-3 col-lg-2 col-xl-3 mx-auto mt-3">

              <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Creative Event</h5>

              <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam beatae veritatis fuga iusto deleniti hic explicabo repellendus.</p>

            </div>

            <div class="col-md-3 col-lg-2 col-xl-3 mx-auto mt-3">
              <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Events</h5>
              <p>
                <a href="#" class="text-white" style="text-decoration: none;">Entertaiment</a>
              </p>
              <p>
                <a href="#" class="text-white" style="text-decoration: none;">Competition</a>
              </p>
              <p>
                <a href="#" class="text-white" style="text-decoration: none;">Speech Deliver</a>
              </p>
              <p>
                <a href="#" class="text-white" style="text-decoration: none;">Volunteer</a>
              </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-3 mx-auto mt-3">
              <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
              <p>
                <i class="fas fa-home mr-3"></i>&nbsp; &nbsp; &nbsp;77, Lorong Lembah Permai 3, 11200 Tanjung Bungah, Pulau Pinang
              </p>
              <p>
                <i class="fas far fa-envelope mr-3"></i>&nbsp; &nbsp; &nbsp;nitrosociety@gmail.com
              </p>
              <p>
                <i class="fas fa-phone mr-3"></i>&nbsp; &nbsp; &nbsp;+60 17-123 45678
              </p>
              <p>
                <i class="fas fa-print mr-3"></i>&nbsp; &nbsp; &nbsp;+04 788 1682
              </p>
            </div>

            
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
              <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact Us</h5>
              <form action="">

              <div id="contactus-form" class="form-row row">
                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon"><i class="fas fa-user"></i></span>
                </div>
                <div class="form-group col-md-5 col-lg-5 col-xl-5">
                  <input type="text" class="form-control" id="inputFirstName" placeholder="First Name">
                </div>

                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon"><i class="fas fa-user"></i></span>
                </div>

                <div class="form-group col-md-5 col-lg-5 col-xl-5">
                  <input type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                </div>

              </div>

              <div id="contactus-form" class="form-row row">
                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon"><i class="fa-regular fa-envelope"></i></span>
                </div>
                <div class="form-group col-md-11 col-lg-11 col-xl-11">
                  <input type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address">
                </div>
              </div>

              <div id="contactus-form" class="form-row row">
                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon" ><i class="fa-solid fa-phone"></i></span>
                </div>
                <div class="form-group col-md-11 col-lg-11 col-xl-11">
                  <input type="text " class="form-control" id="inputEmailAddress" placeholder="Phone Number">
                </div>
              </div>

              <div id="contactus-form" class="form-row row">
                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon"><i class="fas fa-edit"></i></span>
                </div>
                <div class="form-group col-md-11 col-lg-11 col-xl-11">
                  <input type="text " class="form-control" id="inputMessage" placeholder="Let us know how we can help...">
                </div>
              </div>

              <input type="button" class="submit-button-contactus" value="Submit">
              </form>
            </div>

          </div>

          <hr class="mb-4">
          <section class="d-flex justify-content-center justify-content-lg-between p-4">
          <div class="me-5 d-none d-lg-block"> <!--<section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom row align-item-center">-->
            <!-- <div class="me-5 d-none d-lg-block">-->
            <p>Copyrightⓒ All rights reserved by:
              <a href="#" style="text-decoration: none;">
                <strong class="text-warning">Dato Lim Jian Hui</strong>
              </a>
            </p>
          </div>

          <div class="footer-icon col-md-5 col-lg-4 ">
            <div class="text-center text-md-right">

              <ul class="list-unstyled list-inline">
                <li class="list-inline-item ">
                  <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                  <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                  <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-google-plus"></i></a>
                </li>
                <li class="list-inline-item">
                  <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-linkedin-in"></i></a>
                </li>
                <li class="list-inline-item">
                  <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fab fa-youtube"></i></a>
                </li>
              </ul>

            </div>
          </div>
        </section>
        </div>
    </footer>
    <!--Swiper JS-->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/homepage.js"></script> 
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
