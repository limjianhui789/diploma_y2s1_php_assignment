<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <title>Payment</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
 
        <link rel="stylesheet"  href="css/payment.css" type="text/css"/>
        <link rel="stylesheet"  href="css/homepage.css" type="text/css">
    </head>

    <body>
        <?php 
            include'./includes/header.php'; 
            if(!isset($_SESSION['username'])){
                modal_msg(array("Illegal Access, Please Login"), "Error", "index.php");
                die();
            } else if(!isset($_POST['eventPrice']) && !isset($_POST['quantity']) && !isset($_POST['eventName'])){
                modal_msg(array("Illegal Direct Access"), "Error", "index.php");
                die();
            }
        ?>   
        <?php 
            
            require_once('./admin/includes/modal_msg.php');
            if(isset($_POST['eventPrice'])){
                if($_POST['eventPrice'] == 0){
                    $unitPrice = $_POST['eventPrice'];
                    $quantity = $_POST['quantity'];
                    $totalPrice = $unitPrice * $quantity;
                    $eventName = $_POST['eventName'];
                    $eventID = $_POST['eventID'];
                    $username = $_POST['username'];
                    $studentID =  $_POST['studentID'];
                    printf('
                        <script>
                            $.post("includes/bookModule/payment_success.php", {
                                id: "FREE",
                                status: "COMPLETED",
                                amount: 0,
                                eventID: %d, //Param 6
                                username: "%s", //Param 7
                                studentID: "%s", //Param 8
                                quantity: %d //Param 9
                            }, function(data,status){
                                //Debug Purpose
                                alert("Data: " + data + "\nStatus: " + status);
                            });
                        </script>
                    ',$eventID, $username,$studentID, $quantity);
                    modal_msg(array("Successfully Make the Booking."), "Success", "index.php");
                    exit();
                }
            
            }
        ?>
        <div class="container mt-5" id="payment-container">
            <div class="form-box mt-5">
                <div class="left"></div>
                <div class="right">
                        <h2 id="title">Please fill out your information before you finish your payment!</h2>
                        <h3 id="payment_accept">Payment Accepted:</h3>

                        <!-- ######## Paypal API ######## -->
                        <script src="https://www.paypal.com/sdk/js?client-id=AbB5AuRGtGBwppeN5JVcfX5-9uYa7_k0gjarWqFYbbQuJmOz10GAMABO_pN1UYx6ZEiHURHeaXkDX-_W&currency=MYR"></script>
                        <!-- Set up a container element for the button -->
                        <div id="paypal-button-container"></div>
                        <?php
                            $unitPrice = $_POST['eventPrice'];
                            $quantity = $_POST['quantity'];
                            $totalPrice = $unitPrice * $quantity;
                            $eventName = $_POST['eventName'];

                            printf('
                                <script>
                                    paypal.Buttons({
                                        // Sets up the transaction when a payment button is clicked
                                        createOrder: (data, actions) => {
                                        return actions.order.create({
                                            "purchase_units": [{
                                            "amount": {
                                            "currency_code": "MYR",
                                            "value": "%d", //Param 1
                                            "breakdown": {
                                                "item_total": {  /* Required when including the items array */
                                                "currency_code": "MYR",
                                                "value": "%d" //Param 2
                                                }
                                            }
                                            },
                                            "items": [
                                            {
                                                "name": "%s", //Param 3 /* Shows within upper-right dropdown during payment approval */
                                                "description": "Ticket", /* Item details will also be in the completed paypal.com transaction view */
                                                "unit_amount": {
                                                "currency_code": "MYR",
                                                "value": "%d" //Param 4
                                                },
                                                "quantity": "%d" //Param 5
                                            },
                                            ]
                                        }]
                                    });
                                    },
                                        // Finalize the transaction after payer approval
                                        onApprove: (data, actions) => {
                                        return actions.order.capture().then(function(orderData) {
                                            // Successful capture! For dev/demo purposes:
                                            const transaction = orderData.purchase_units[0].payments.captures[0];

                                            //Send Success To PHP and handle for database
                                            //Using Jquery to post 
                                            $.post("includes/bookModule/payment_success.php", {
                                                id: transaction.id,
                                                status: transaction.status,
                                                amount: transaction.amount.value,
                                                eventID: %d, //Param 6
                                                username: "%s", //Param 7
                                                studentID: "%s", //Param 8
                                                quantity: %d //Param 9
                                            }, function(data,status){
                                                //Debug Purpose
                                                //alert("Data: " + data + "\nStatus: " + status);
                                            });

                                            // ### DEBUG PURPOSE ###
                                            //console.log(\'Capture result\', orderData, JSON.stringify(orderData, null, 2));
                                            //console.log(transaction.status);
                                            //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);


                                            // Update Message On Screen
                                            const element = document.getElementById(\'paypal-button-container\');
                                            document.getElementById("payment_accept").innerText = "";
                                            document.getElementById("title").innerText = "";
                                            element.innerHTML = "<h2>Payment Successfully</h2><br><h3>Thank you for your payment!</h3><br><button type=\'button\' class=\'btn btn-primary\' onclick=\"location.href = \'index.php\'\">Back To Home Page</button>";
                                            //actions.redirect(\'thank_you.html\');
                                        });
                                        }
                                    }).render(\'#paypal-button-container\');
                            </script>
                            ', $totalPrice, $totalPrice, $eventName, $unitPrice, $quantity, $_POST['eventID'], $_POST['username'], $_POST['studentID'], $quantity);
                        ?>
                        <!-- ######## Paypal API ######## -->
                </div>
            </div>
        </div>
        
        
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
