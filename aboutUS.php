<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About US</title>

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
    <script src="js/sendMail.js" type="text/javascript"></script>
    <!-- Swiper JS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="css/aboutUs.css" type="text/css"/>

</head>
<body>
    <?php
        include ('includes/header.php');
    ?>
    
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div id="sliderBackground aboutusBackground" class="carousel-item active" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.8)),url('clientImage/Background/competitionBackground.jpg'); height: 70vh;">
          <!--<img src="images/test1.jpg" class="d-block w-100" alt="..." > -->
        <div class="carousel-caption d-none d-md-block">
            <div class="backgroundtitle1">
                <div class="container">
                    <div class="row justify-content-around">
                       <div class="col-lg-5">
                        <div id="backgroundTitle" class="row d-flex mt-2">
                            <h2 class="title d-flex">About Us</h2>
                            <h2 class="title d-flex">Construction</h2>
                        </div>
                        <div class="row d-inline-flex mt-3" id="backgroundDesc">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta sed nesciunt iusto quisquam totam obcaecati enim 
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-5">
                                <input type="button" class="contactUsButton" value="contact us">
                            </div>
                        </div>
                        </div> 
                        
                    </div>
                                        
                </div>
            </div>
        </div>
    </div>

  </div>
</div>

<div class="container-fluid section-second p-5">
    <div class="container">
       
        <div class="row justify-content-center d-flex section2">
            <h2 id=""> Nitro TAR UC Society</h2>
            <hr id="breakingLine">
        </div>

        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-5">
                    <p class="aboutUsContent">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos alias, error adipisci nesciunt nam laudantium quaerat fugit. Ipsum assumenda, qui, quaerat perferendis doloribus perspiciatis exercitationem, tempore cumque temporibus dolorum doloremque!
                    </p>
                </div>

                <div class="col-lg-5">
                    <p class="aboutUsContent">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quos eligendi quasi repellat eius beatae assumenda similique distinctio fuga accusantium libero vero, animi commodi ipsum, minus doloribus ut magnam praesentium. Odit.
                    </p>
                </div>
            </div>
        </div>
    </div> 
</div>

<div class="containerfluid section-third p-5">
    <div class="row justify-content-md-center">
        <div class="col-md-7">
            <div class="row p-4" id="speechContent">
                <p class="text-center font-weight-bold text-light">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita placeat tempore, laudantium nemo esse eum. Numquam, perferendis et voluptatibus qui consectetur excepturi doloribus voluptate itaque vel libero sapiente illum laudantium! "</p>
            </div>

            <div class="row p-4">
                <h2 class="text-center text-uppercase text-success">Dato Hui - TARUC Society Chairman</h2>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="formMethod">
    <div class="row" style="margin-left:50px;">
    <!--PhpMailer Form--->
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="row contact-us-form-title">
                <h2>Contact Us</h2>
                <hr>
            </div>
            <div class="row">
                <form action="" method="" class="d-flex justify-content-center" id="contact-us-form-input">

                    <div class="row input-container">
                        <div class="col-xs-12">
                            <div class="styled-input wide">
                                <input type="text" id="name" required />
                                <label>Name</label> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="styled-input">
                                <input type="text" id="email" required />
                                <label>Email</label> 
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="styled-input"  style="float:right;">
                                <input type="text" id="phoneNumber" required />
                                <label>Phone Number</label> 
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="styled-input wide">
                                <textarea id="body" required></textarea>
                                <label>Message</label>
                            </div>
                        </div>
                        <div class="col-xs-12 d-flex flex-row-reverse">
                            <div class="btn-lrg submit-button-sendMessage" onclick="sendEmail()">Send Message</div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
        <!--End PhpMailer Form--->

        
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


        <div class="col-md-6 col-lg-6 col-xl-6 left-contactus">
            <div class="row d-flex justify-content-center p-4" style="background: black;">
                <nav class="text-white d-flex justify-content-center" style="list-style-type: none;">
                    <li class="contact-us-list-icon p-5">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                        <i class="fa-brands fa-instagram "></i>
                    </li>
                </nav>
            </div>
            <div class="container mt-5 lower-detail-contactus d-flex">
                <div class="row text-white">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <p><i class="fa fa-map-marker align-self-center" aria-hidden="true"></i></p>
                        
                        <br>
                        <p><i class="fa-solid fa-phone align-self-center"></i></p>
                        
                        <br>
                        
                        <p><i class="fa-solid fa-envelope align-self-center"></i></p>
                    </div>

                    <div class="col-md-8 col-lg-8 col-xl-8 detail">
                        <p class="d-flex align-self-center">77, Lorong Lembah Permai 3, 11200 Tanjung Bungah, Pulau Pinang</p>
                        <p class="d-flex align-self-center">+60&nbsp;17&nbsp;123&nbsp;4567 </p>
                        <p class="d-flex align-self-center email">society@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    <?php
        include ('includes/footer.php');
    ?>

<!--Swiper JS-->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
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