<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    
        <link rel="stylesheet" href="css/eventbrowser.css" type="text/css"/>

    <title>Event Browser</title>

</head>
<body>
    <style type="text/css">
        .poster-info h1{
            font-size: 25px;
        }

      .button-submit {
        background-color: white;
        border: none;
        color: black;
        padding: 10px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
      }  

      .button-submit:hover{
        background-color: blue;
        color: white;
      }
        
    </style>
    
  <?php
    include ('includes/header.php');
 ?>  
  <div class="container"></div>
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
          <form action="eventDetail.php" method="GET">
          <div id="sliderBackground" class="carousel-item active">
            <img src="clientImage/EventPicture/CompetitionProgrammingEvent.jpg" class="d-block w-100" alt="">
            <div class="carousel-caption d-none d-md-block">
              <h5 class="animated bounceInRight" style="animation-duration: 1s;">The Darkest Day Of My Life</h5>
            </div>
          </div>
          </form>
            
        <?php
         require_once './includes/database-connector.php';
         require_once('./admin/includes/getEventStatus.php');
         $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($con->connect_error);
         $query = "
             SELECT eventID, eventName, pricePerPax, eventStartDate, eventStartTime, eventEndDate, eventEndTime
             FROM nitro_event 
             WHERE categoryName = 'Competition' 
             LIMIT 10";
         $result = $conn->query($query);
         while($row = $result->fetch_object()){
             $eventStatus = getStatus($row->eventStartDate, $row->eventEndDate, $row->eventStartTime, $row->eventEndTime);
             $eventName = $row->eventName;
             $eventID = $row->eventID;
             $price = $row->pricePerPax;
             if($eventStatus == "Error" || $eventStatus == "Expired"){
                 continue;
             }
             printf('
               <form action="joinEvent.php" method="POST">
                <div id="sliderBackground" class="carousel-item">
                  <img src="clientImage/EventPicture/PublicSpeakingEvent.jpg" class="d-block w-100" alt="..." >
                  <div class="carousel-caption d-none d-md-block">
                    <h5 class="animated slideInDown" style="animation-duration: 2s;">%s</h5>
                    <p><a href="eventDetail.php">join</a></p>
                    <input type="hidden" name="eventID" value="%s">
                    <input type="hidden" name="eventName" value="%s">
                    <input type="hidden" name="eventPrice" value="%s">
                  </div>
                </div>
              </form>
                 ',$eventName, $eventID,$eventName,$price);
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

        <!-- Start Categories-->
            <?php
                //nitro_event / nitro_poster
                $query = "
                    SELECT E.eventID, E.eventName, E.eventDesc,P.posterURL, E.pricePerPax , E.categoryName, eventStartDate, eventStartTime, eventEndDate, eventEndTime
                    FROM nitro_event E, nitro_poster P
                    WHERE E.posterID = P.posterID AND is_deleted = 0 AND is_draft = 0 AND categoryName = 'Competition'
                    ";
                $competition_Result = $conn->query($query);
                
                if($competition_Result != NULL){ //if got data inside 
                    printf('
                        <div class="container mb-3 mt-3">

                          <div class="row eventSliderTitle1">
                            <h1 class="p-2">Competition</h1>
                          </div>

                          <div class="swiper event-Slider">

                            <div class="swiper-container p-4">
                              <div class="swiper-wrapper">                        
                        ');
                    
                    while($competition_row = $competition_Result->fetch_object()){
                        $eventStatus = getStatus($competition_row->eventStartDate, $competition_row->eventEndDate, $competition_row->eventStartTime, $competition_row->eventEndTime);
                         if($eventStatus == "Error" || $eventStatus == "Expired"){
                             continue;
                         }
                        $competition_eventID = $competition_row->eventID;
                        $competition_eventName= $competition_row->eventName;
                        $competition_eventDesc = $competition_row->eventDesc;
                        $competition_posterURL = $competition_row->posterURL;
                        $pricePerPax = $competition_row->pricePerPax;
                        printf('
                           <div class="swiper-slide event_Slide">
                            <div class="poster"><img src="%s">
                              <div class="poster-info">
                                <h1>%s</h1>
                                <p>%s</p>
                                <form action="joinEvent.php" method="POST">
                                  <div class="button-group row col-md-5 col-lg-5 col-xl-5 text-center">
                                    
                                    <input type="submit" class="button-submit" value="Join In">
                                    <input type="hidden" name="eventID" value="%s">
                                    <input type="hidden" name="eventName" value="%s">
                                    <input type="hidden" name="eventPrice" value="%s">
                                  </div>
                                </form>   
                                <div class="col">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                                <form action="eventDetail.php" method="GET">
                                  <div class="button-group row col-md-5 col-lg-5 col-xl-5 text-center">
                                    
                                    <input type="submit" class="button-submit" value="Learn">
                                    <input type="hidden" name="eventID" value="%s">
                                  </div>
                                </form> 
                              </div>
                            </div>
                          </div> 
                            ',$competition_posterURL,$competition_eventName, $competition_eventDesc, $competition_eventID,$competition_eventName,$pricePerPax,$competition_eventID);
                            
                    }
                    
                    printf('
                                </div>
                                <!-- Add Pagination-->
                                <div id="next-btn-slider" class="swiper-button-next"></div>
                                <div id="prev-btn-slider" class="swiper-button-prev"></div>
                              </div>
                            </div>

                          </div>                        
                        ');
                    
                }
                
                    
              $competition_Result->free();
            ?> 

        <!-- End Categories-->

            <?php
                //nitro_event / nitro_poster
                $query = "
                    SELECT E.eventID, E.eventName, E.eventDesc,P.posterURL, E.pricePerPax, E.categoryName, eventStartDate, eventStartTime, eventEndDate, eventEndTime
                    FROM nitro_event E, nitro_poster P
                    WHERE E.posterID = P.posterID AND is_deleted = 0 AND is_draft = 0 AND categoryName = 'Talk'
                    ";
                $talk_Result = $conn->query($query);
                
                if($talk_Result != NULL){ //if got data inside 
                    printf('
                        <div class="container mb-3 mt-3">

                          <div class="row eventSliderTitle1">
                            <h1 class="p-2">TALK</h1>
                          </div>

                          <div class="swiper event-Slider">

                            <div class="swiper-container p-4">
                              <div class="swiper-wrapper">                        
                        ');
                    
                    while($talk_row = $talk_Result->fetch_object()){
                        $eventStatus = getStatus($talk_row->eventStartDate, $talk_row->eventEndDate, $talk_row->eventStartTime, $talk_row->eventEndTime);
                         if($eventStatus == "Error" || $eventStatus == "Expired"){
                             continue;
                         }
                        $talk_eventID = $talk_row->eventID;
                        $talk_eventName= $talk_row->eventName;
                        $talk_eventDesc = $talk_row->eventDesc;
                        $talk_posterURL = $talk_row->posterURL;
                        $pricePerPax = $talk_row->pricePerPax;
                        printf('
                           <div class="swiper-slide event_Slide">
                            <div class="poster"><img src="%s">
                              <div class="poster-info">
                                <h1>%s</h1>
                                <p>%s</p>
                                <form action="joinEvent.php" method="POST">
                                  <div class="button-group row col-md-5 col-lg-5 col-xl-5 text-center">
                                  <input type="submit" class="button-submit" value="Join In">
                                    <input type="hidden" name="eventID" value="%s">
                                    <input type="hidden" name="eventName" value="%s">
                                    <input type="hidden" name="eventPrice" value="%s">
                                  </div>
                                </form>   
                                <div class="col">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                                <form action="eventDetail.php" method="GET">
                                  <div class="button-group row col-md-5 col-lg-5 col-xl-5 text-center">
                                  <input type="submit" class="button-submit" value="Learn">
                                    <input type="hidden" name="eventID" value="%s">
                                  </div>
                                </form>  
                              </div>
                            </div>
                          </div> 
                            ',$talk_posterURL,$talk_eventName, $talk_eventDesc, $talk_eventID,$talk_eventName,$pricePerPax,$talk_eventID);
                    }
                    
                    printf('
                                </div>
                                <!-- Add Pagination-->
                                <div id="next-btn-slider" class="swiper-button-next"></div>
                                <div id="prev-btn-slider" class="swiper-button-prev"></div>
                              </div>
                            </div>

                          </div>                        
                        ');
                    
                }
                
                    
              $talk_Result->free();
            ?>  
        <!-- End Categories-->
        
        <!-- Start Categories VOLUNTEER-->
            <?php
                //nitro_event / nitro_poster
                $query = "
                    SELECT E.eventID, E.eventName, E.eventDesc,P.posterURL, E.pricePerPax , E.categoryName, eventStartDate, eventStartTime, eventEndDate, eventEndTime
                    FROM nitro_event E, nitro_poster P
                    WHERE E.posterID = P.posterID AND is_deleted = 0 AND is_draft = 0 AND categoryName = 'Show'
                    ";
                $VOLUNTEER_Result = $conn->query($query);
                
                if($VOLUNTEER_Result != NULL){ //if got data inside 
                    printf('
                        <div class="container mb-3 mt-3">

                          <div class="row eventSliderTitle1">
                            <h1 class="p-2">Show</h1>
                          </div>

                          <div class="swiper event-Slider">

                            <div class="swiper-container p-4">
                              <div class="swiper-wrapper">                        
                        ');
                    
                    while($VOLUNTEER_row = $VOLUNTEER_Result->fetch_object()){
                        $eventStatus = getStatus($VOLUNTEER_row->eventStartDate, $VOLUNTEER_row->eventEndDate, $VOLUNTEER_row->eventStartTime, $VOLUNTEER_row->eventEndTime);
                         if($eventStatus == "Error" || $eventStatus == "Expired"){
                             continue;
                         }
                        $VOLUNTEER_eventID = $VOLUNTEER_row->eventID;
                        $VOLUNTEER_eventName= $VOLUNTEER_row->eventName;
                        $VOLUNTEER_eventDesc = $VOLUNTEER_row->eventDesc;
                        $VOLUNTEER_posterURL = $VOLUNTEER_row->posterURL;
                        $pricePerPax = $VOLUNTEER_row->pricePerPax;

                        printf('
                           <div class="swiper-slide event_Slide">
                            <div class="poster"><img src="%s">
                              <div class="poster-info">
                                <h1>%s</h1>
                                <p>%s</p>
                                <form action="joinEvent.php" method="POST">
                                  <div class="button-group row col-md-5 col-lg-5 col-xl-5 text-center">
                                  <input type="submit" class="button-submit" value="Join In">
                                    <input type="hidden" name="eventID" value="%s">
                                    <input type="hidden" name="eventName" value="%s">
                                    <input type="hidden" name="eventPrice" value="%s">
                                  </div>
                                </form>   
                                <div class="col">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                                <form action="eventDetail.php" method="GET">
                                  <div class="button-group row col-md-5 col-lg-5 col-xl-5 text-center">
                                  <input type="submit" class="button-submit" value="Learn">
                                    <input type="hidden" name="eventID" value="%s">
                                  </div>
                                </form>  
                              </div>
                            </div>
                          </div> 
                            ',$VOLUNTEER_posterURL,$VOLUNTEER_eventName, $VOLUNTEER_eventDesc, $VOLUNTEER_eventID,$VOLUNTEER_eventName,$pricePerPax,$VOLUNTEER_eventID);
                    }
                    
                    printf('
                                </div>
                                <!-- Add Pagination-->
                                <div id="next-btn-slider" class="swiper-button-next"></div>
                                <div id="prev-btn-slider" class="swiper-button-prev"></div>
                              </div>
                            </div>

                          </div>                        
                        ');
                    
                }
                
                    
              $VOLUNTEER_Result->free();
            ?> 

        <!-- End Categories-->

<div>
  <?php
    include ('includes/footer.php');
  ?>
</div> 




<!--Swiper JS-->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/homepage.js"></script>

<script type="text/javascript">
var swiper = new Swiper(".mySwiper", {
    scrollbar: {
        el: ".swiper-scrollbar",
        hide: true,
    },
});


var swiper = new Swiper(".swiper-container", {
  slidesPerView: 4,
  spaceBetween: 40,
  slidesPerGroup: 3,
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