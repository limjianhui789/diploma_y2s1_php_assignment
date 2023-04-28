<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
    session_start();
 
                
    if(!isset($_SESSION['username'])){
         die("Illegal Access");
    } 
?>
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

    <link rel="stylesheet" href="css/homepage.css" type="text/css"/>
    <link rel="stylesheet" href="css/searchEvent.css" type="text/css"/>

    <title>Search Event</title>
</head>
<body>

<?php
    include_once('includes/header.php');
?>

<style>
@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Quicksand&display=swap');
@import url('https://www.googleapis.com/webfonts/v1/webfonts?key=YOUR-API-KEY');
@import url('https://fonts.googleapis.com/css?family=Montserrat');
:root{
    --background-color :#A58BFF;
    --sideBar-background:rgba(255, 255, 255, 0.1);
    --word-color: #fff;
    --colorBlack:black;
    --colorWhite:white;
    --colorSection1:#0C0032;
    --colorSection2:#190061;
    --colorSection3:#240090;
    --colorSection4:#3500D3;
    --colorSection5:#282828;
    --fontfamily1:'Alumni Sans Pinstripe', Courier, monospace;
    --fontfamily2:'Aboreto', Courier, monospace;
    --fontfamily3:'Silkscreen', Courier, monospace;
    --swiper-slider-color: #fff;
    
}

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    min-height: 100vh;
    font-family: 'Montserrat', Arial, sans-serif;
    background-size: cover;
    background-position: center;
    background-color: var(--colorSection1);
    overflow-x: hidden;
}

/* width */
::-webkit-scrollbar {
    width: 2px;
}
  
/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey; 
    border-radius: 10px;
}
   
  /* Handle */
::-webkit-scrollbar-thumb {
    background: white ; 
    border-radius: 10px;
}
  
/* Handle on hover */ 
::-webkit-scrollbar-thumb:hover {
    background: #b30000; 
}

/*  */
.searchEventInput:focus {
    box-shadow: none;
}
  
.searchEventInput {
    border-width: 0;
    border-bottom-width: 1px;
    border-radius: 0;
    padding-left: 0;
    background: #0C0032;
}
  
  
.searchEventInput::placeholder {
    font-size: 0.95rem;
    color: #fff;
    font-style: italic;
    background: #0C0032;
}

.searchEventInput:focus{
    background: #0C0032;
}

.websearch{
    background-color: #0C0032;
}

#inputSearch[type=text]{
    color: white;
}

#searchButton{
    color: white;
    border: 2px solid;
    border-radius: 10px;

}

.poster-button{
    padding: 0.6rem;
    outline: none;
    border: 2px solid white;
    border-radius: 3px;
    background: none;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.4s ease; 
    text-decoration: none;
    margin: 5px;
    transition: all .3s ease-in-out;
}

.poster-button:hover{
    border: 2px solid #0C0032;
    background: white;
    color: black;
}

.inputSearch input[type=text]{
    color: white;
}


@media (min-width: 1200px) {
    .search-result-container{
        max-width: 890px;
    }
}
</style>
<div class="row"></div>    
<div class="search-result-container container searchbar">
    <div class="row m-12 mt-5 justify-content-lg-between">
        <div class="col-lg-10 mx-auto">
          <div class="p-3 websearch">
            <!-- search us -->
            <form>
              <div class="row mb-2">
                <div class="form-group col-md-9 inputSearch">
                    <input id="inputSearch" autocomplete="off" type="text" placeholder="What're you searching for?" class="searchEventInput form-control form-control-underlined">
                </div>
              </div>
            </form>
            <!-- End search us -->
          </div>
        </div>
      </div>
</div>


<div id="searchResult"></div>
<?php
if(isset($_GET['searchbox'])){

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die($con->connect_error);
    
    $searchbox = $_GET['searchbox'];
    
    $query = "SELECT *
        FROM nitro_event E, nitro_poster P
        WHERE E.posterID = P.posterID 
        AND is_deleted = 0
        AND is_draft = 0
        AND (E.eventName LIKE '%{$searchbox}%' OR E.eventDesc LIKE '%{$searchbox}%')";
    
    $result = $conn->query($query);
    
    while($row = $result->fetch_object()){
        //print_r($row);
        $eventID = $row->eventID;
        $eventName = $row->eventName;
        $eventDesc = $row->eventDesc;
        $posterURL =$row->posterURL;
        $seatAvailable =$row->seatAvailable;

        $eventPrice= $row->pricePerPax;
        
        //print_r($row);

        printf('
                <div class="search-result-container container mt-3 ">
                    <div class="row col-12 border">
                        <div class="col-sm-2 col-md-3 col-lg-3 col-xl-3 d-flex flex-row-reverse p-3" style="width: 170px;">
                            <img src="%s" alt="" style="width: 140px; height: auto;">
                        </div>

                        <div class="col-sm-3 col-md-7 col-lg-7 col-xl-7 text-white p-3">
                          <div class="row">
                            <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
                             <h2><span>%s</span></h2>
                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 d-flex  align-self-center flex-row-reverse">
                             <h5><span>Seat Available :%s</span></h5>
                            </div>
                          </div>
                            <div class="row mt-4">
                                <p>%s</p>
                            </div>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 p-5" style="width: 190px;">
                            <div class="row">
                              <form action="joinEvent.php" method="POST">
                                <input type="submit" class="poster-button text-center mt-4" value="Join In">
                                <input type="hidden" name="eventID" value="%s">
                                <input type="hidden" name="eventName" value="%s">
                                <input type="hidden" name="eventPrice" value="%s">
                              </form>
                            </div>

                        </div>
                    </div>
                </div>
            ',$posterURL,$eventName,$seatAvailable,$eventDesc,$eventID,$eventName,$eventPrice);
    }
    
    $conn->close();
    $result->free();
}

?>




<div class="row mt-5"></div>  

    <!-- Footer -->
    <footer class="text-white pt-5 pb-4 ">
        <div class="container text-md-start">
          <div class="row text-center text-md-start"> <!--container text-center text-md-start mt-5-->


            <div class="col-md-3 col-lg-2 col-xl-3 mx-auto mt-3">

              <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Nitro Society</h5>

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
              <i class="fas fa-home mr-3"></i>&nbsp; &nbsp; &nbsp;nitrosociety@gmail.com
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
              <form action="" id="footer-contact-us-form">

              <div id="contactus-form" class="form-row row">
                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon"><i class="fas fa-user"></i></span>
                </div>
                <div class="form-group col-md-11 col-lg-11 col-xl-11">
                  <input type="text" class="form-control text-white" id="inputFirstName" placeholder="Name">
                </div>

              </div>

              <div id="contactus-form" class="form-row row">
                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon"><i class="fa-regular fa-envelope"></i></span>
                </div>
                <div class="form-group col-md-11 col-lg-11 col-xl-11">
                  <input type="text" class="form-control text-white" id="inputEmailAddress" placeholder="Email Address">
                </div>
              </div>

              <div id="contactus-form" class="form-row row">
                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon" ><i class="fa-solid fa-phone"></i></span>
                </div>
                <div class="form-group col-md-11 col-lg-11 col-xl-11">
                  <input type="text " class="form-control text-white" id="inputPhoneNumber" placeholder="Phone Number">
                </div>
              </div>

              <div id="contactus-form" class="form-row row">
                <div class="col-md-1 col-lg-1 col-xl-1">
                  <span class="contact-us-icon"><i class="fas fa-edit"></i></span>
                </div>
                <div class="form-group col-md-11 col-lg-11 col-xl-11">
                  <input type="text " class="form-control text-white" id="inputMessage" placeholder="Let us know how we can help...">
                </div>
              </div>

              <input type="button" onclick="sendSubmit()" class="submit-button-contactus" value="Submit">
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

<div class="modal fade" id="messageContainer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header d-flex justify-content-end border-0">

        <button type="button" class="close bg-dark" data-dismiss="modal" id="closePopUp" onclick="hidePopUp()" aria-label="Close" style="border: none;">
          <span aria-hidden="true"><i class="fa-sharp fa-solid fa-xmark text-white"></i></span>
        </button>
      </div>
      <div class="modal-body text-white d-flex justify-content-center">
        <h3 class="text-white">Message Send Successfully</h3>
      </div>
      <div class="modal-footer border-0 d-flex justify-content-end">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closePopUp" onclick="hidePopUp()" style="font-size: 15px; text-transform: uppercase; border: 3px solid white; background-color: black;" >Close</button>
      </div>
    </div>
  </div>
</div>

    <!--Swiper JS-->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/homepage.js"></script>
 <script>
    $(document).ready(function(){
        $("#inputSearch").keyup(function(){
           var input = $(this).val();
           //alert(input);

           if(input != ""){
                $.ajax({
                    url:"liveSearch_Result.php",
                    method:"POST",
                    data:{input:input},

                    success:function(data){
                        $("#searchResult").html(data);
                    }
                });
           }else{
            $("#searchResult").css("display","none");
           }
        });

    });  
     
 function sendSubmit() {
    var name = $("#inputFirstName");
    var email = $("#inputEmailAddress");
    var phoneNumber = $("#inputPhoneNumber");
    var body = $("#inputMessage");

    if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(phoneNumber) && isNotEmpty(body)) {
        $.ajax({
            url: 'mailerPlugin/sendEmail.php',
            method: 'POST',
            dataType: 'json',
            data: {
                name: name.val(),
                email: email.val(),
                phoneNumber: phoneNumber.val(),
                body: body.val()
            }, success: function (response) {
                 $('#footer-contact-us-form')[0].reset();
                 $('#messageContainer').modal('show');


            }
        });
    }else{
      $('.sent-message').text("Something went wrong.");
    }
}

function isNotEmpty(caller) {
    if (caller.val() == "") {
        caller.css('border', '1px solid red');
        return false;
    } else
        caller.css('border', '');

    return true;
}

function hidePopUp()
{
  $('#messageContainer').modal('hide');
}

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
