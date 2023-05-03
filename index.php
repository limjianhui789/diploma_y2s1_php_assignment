<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NitroGaming</title>
    <link rel="icon" type="image/x-icon" href="image/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdel^vr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
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

    <link rel="stylesheet" href="css/homepage.css" type="text/css"/>
</head>
<body>
 <?php
    include 'includes/header.php';
 ?>

     <!-- Start Slider -->
     <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
        
      </div>
      <div class="carousel-inner">
       <form action="" method="POST">
        <div id="sliderBackground" class="carousel-item active" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.8)),url('clientImage/Background/competitionBackground.jpg');">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="animated bounceInRight" style="animation-duration: 1s;">The Darkest Day Of My Life</h5>
            <p class="animated bounceInLeft" style="animation-duration: 2s;">About the</p>
            <p class="animated bounceInRight" style="animation-duration: 3s;"><a href="eventbrowser.php">Discover More</a></p>
            <input type="hidden" name="eventID-target" value="34">
          </div>
        </div>
      </form>
          
        <?php
            require_once './includes/database-connector.php';
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($conn->connect_error);
                $query = "SELECT * FROM nitro_event LIMIT 5";
                $result = $conn->query($query);

                while($row = $result->fetch_object()){
                    printf('<form action="" method="POST">
                                <div id="sliderBackground" class="carousel-item" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.8)),url(\'clientImage/Background/singing.jpg\');">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 class="animated slideInDown" style="animation-duration: 2s;">%s</h5>
                                        <p>%s</p>
                                        <p><a href="eventbrowser.php">Discover More</a></p>
                                    </div>
                                 </div>
                             </form>
                        ',$row->eventName, $row->eventDesc, $row->eventID);
                };
                
                $result->free();
        ?>      
      
       
        </div>
      </div>
     


      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
     


    <!-- End Slider-->



<!-- About Us-->
<div id="aboutus"class="container">
  <div class="row m-3">
    <div class="col-lg-4 text-white">
      <h5 id="container-text" class="text-uppercase mb-3 font-weight-bold">OUR SOCIETY</h5>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad odit in quis dicta, fuga nostrum amet doloremque, commodi magnam quas sit fugit consectetur. Nisi saepe incidunt, corporis omnis sequi voluptate.</p>
        <hr class="breaking-line">

        <div class="row mt-5">
          <div class="col-lg-1">
            <div class="vertical-line"></div>
          </div>
          <div class="col-lg-10">
           <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Totam suscipit consectetur a placeat fugiat at laborum dignissimos, quisquam vitae recusandae! Veritatis in adipisci tempora, nemo doloribus voluptatibus vitae quibusdam illum.</p>
          </div>
        </div>

    </div>

    <div class="col-lg-3">
      <div class="col-lg-4 mt-3">
        <img src="clientImage/EventPicture/CompetitionProgrammingEvent.jpg" style="width: 280px;" alt="">
      </div>

      <div class="row mt-4">
        <img src="clientImage/EventPicture/PublicSpeakingEvent.jpg" style="width: 302px;" alt="">
      </div>
    </div>

    <div class="col-lg-4 mt-3">
      <img class="aboutus-img" src="clientImage/EventPicture/singingevent.jpg" alt="">
    </div>

    </div>

</div>



<!--Comitee Member-->
<div class="container mb-5">
  <div class="row"></div>
    <h2 id="commiteeMemberTitle" class="text-center justify-content-center p-1">Commitee Member</h2>
  <div class="swiper profile-card-slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="profile-container">
          <img class="round" src="clientImage/profilePicture/WongChunWing.jpg" alt="user" />
          <h3>Wong Chun Wing</h3>
          <h6>Penang</h6>
          <p>Event Coordinator and <br/> Co-Secretary</p>
          <div class="buttons">
            <button class="primary">
              Follow
            </button>
            <button class="primary ghost">
              Contact
            </button>
          </div>
          <div class="skills">
            <h6>Skills</h6>
            <ul>
              <li>Web Developer</li>
              <li>Speaker</li>
              <li>Coordination</li>
              <li>Mental Assistance</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="profile-container">
          <img class="round" src="clientImage/profilePicture/LimJianHui.jpg" alt="user" />
          <h3>Lim Jian Hui</h3>
          <h6>Kedah</h6>
          <p>Society Creator and <br/> Chairman</p>
          <div class="buttons">
            <button class="primary">
              Follow
            </button>
            <button class="primary ghost">
              Contact
            </button>
          </div>
          <div class="skills">
            <h6>Skills</h6>
            <ul>
              <li>Server Maintain</li>
              <li>Speaker</li>
              <li>Assistance</li>
              <li>Problem Solver</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="swiper-slide">
        <div class="profile-container">
          <img class="round" src="clientImage/profilePicture/YEOW YU ZHI.jpg" alt="user" />
          <h3>Yeow Yu Zhi</h3>
          <h6>Penang</h6>
          <p>Speaker and <br/> Secretary</p>
          <div class="buttons">
            <button class="primary">
              Follow
            </button>
            <button class="primary ghost">
              Contact
            </button>
          </div>
          <div class="skills">
            <h6>Skills</h6>
            <ul>
              <li>Public Speaking</li>
              <li>System Management</li>
              <li>Assistance</li>
              <li>Singing</li>
            </ul>
          </div>
        </div>
      </div>
  

  
    </div>
    <div id="swiperBtnNext" class="swiper-button-next"></div>
    <div id="swiperBtnPre" class="swiper-button-prev"></div>
  </div>
</div>

<!--End Comitee Member-->
<!-- Event Slider -->

<div class="container mb-3">
  <div class="row eventSliderTitle1">
    <h1 class="p-2">EVENT</h1>
  </div>
  
  <div class="swiper event-Slider">
    <div class="row eventSliderTitle2">
      <h2>Recommend</h2>
    </div>
    
    <div class="swiper-container">
      <div class="swiper-wrapper">
         
        <?php
            $table = 'nitro_poster';
            $result = $conn->query("SELECT * FROM $table")or die($conn->error);
            
            while($data = $result->fetch_assoc())
            {
                echo "<div class='swiper-slide event_Slide'>";
                echo "<img src='{$data['posterURL']}' alt='Event Poster'>";
                
                echo "</div>";
            }        
            
          $result->free();
          $conn->close();
                  
        ?>
          
            
      </div>
         
      <!-- Add Pagination-->
      <div id="next-btn-slider" class="swiper-button-next"></div>
      <div id="prev-btn-slider" class="swiper-button-prev"></div>
    </div>
  </div>

  
</div>
<!-- End Event Slider-->


    <?php
      include ('includes/footer.php');
    ?>

    <!--Swiper JS-->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/homepage.js"></script>

<script type="text/javascript">

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