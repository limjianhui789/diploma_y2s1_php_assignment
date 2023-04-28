<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.min.js" integrity="sha512-8Y8eGK92dzouwpROIppwr+0kPauu0qqtnzZZNEF8Pat5tuRNJxJXCkbQfJ0HlUG3y1HB3z18CSKmUo7i2zcPpg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        
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

    <title>Document</title>
</head>
<body>

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
<script type="text/javascript">

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



</script>
</body>
</html>
