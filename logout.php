<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
session_start();
session_destroy();
$_SESSION = array();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Logout</title>
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
    
    </head>
    <body ng-app="logoutApp" ng-controller="logoutController">
        
<style>
    @import url(https://fonts.googleapis.com/css?family=Lato);
 @import url(https://fonts.googleapis.com/css?family=Roboto);
 @import url('https://fonts.googleapis.com/css?family=Poiret+One');
 body {
	 font-family: 'Roboto', sans-serif;
}
 .background-photo {
	 height: 100vh;
	 width: 100%;
	 background-image: url('https://static.pexels.com/photos/173435/pexels-photo-173435.jpeg');
	 background-image: url('https://static.pexels.com/photos/221451/pexels-photo-221451.jpeg');
	 background-size: cover;
}
 .jumbotron {
	 height: 50vh;
	 border-bottom: 4px solid #2f1c36;
	 box-shadow: 0 0 2px rgba(0, 0, 0, 0.6);
}
 .jumbotron h1 {
	 padding: 5px 0;
	 font-size: 13vh;
	 color: #2f1c36;
	 font-family: 'Poiret One', sans-serif;
}
 @media (min-width: 1024px) {
	 .jumbotron h1 {
		 padding: 0.6em 0;
	}
}
 .middle-block {
	 width: 100%;
	 text-align: center;
	 position: absolute;
	 bottom: calc(50vh - 45px);
}
 .middle-block .round-class {
	 width: 80px;
	 height: 80px;
	 margin: 5px auto;
	 padding: 15px 10px;
}
 .middle-block .round-class:hover {
	 background: #9e8197;
	 color: white;
	 text-shadow: 0px 0px 1px rgba(0, 0, 0, 0.8);
}
 .round-class {
	 cursor: pointer;
	 width: 40px;
	 height: 40px;
	 border-radius: 100%;
	 background: #2f1c36;
	 box-shadow: 0 0 2px rgba(0, 0, 0, 0.6);
	 color: rgba(255, 255, 255, 0.95);
	 text-shadow: 0px 0px 1px rgba(0, 0, 0, 0.6);
	 padding: 8px 0;
	 text-align: center;
}
 .second {
	 padding-top: 15px;
}
 .second .row {
	 height: 60px;
}
 .second .row .round-class i.fa-mobile {
	 margin-top: -4px;
}
 .second .row .right-text {
	 width: calc(100% - 50px);
	 padding: 10px 0;
	 color: white;
	 text-shadow: 1px 1px 2px black;
}
 .second .row .ball {
	 margin-right: 10px;
}
 
</style>
        <?php
        // put your code here
        ?>
     <div class="background-photo">
		<div class="jumbotron">
			<div class="container">
				<h1>See you soon!</h1>
			</div>

		</div>
		<div class="middle-block">
      <div ng-if="!!loadingShowed">
        CLICK HERE TO 
        <a href="signin.php">GO BACK</a>';
      </div >
      <div ng-if="!loadingShowed">
       Please, click below.
      </div>
			<div class="round-class">
				<i ng-class="{'fa fa-3x':true, 'fa-spinner fa-pulse fa-fw':!!loadingShowed, 'fa-sign-in':!loadingShowed}" ></i>
				<span class="sr-only">Loading...</span>
			</div>
		</div>
		<div class="second">
			<div class="container">
				<div class="col-xs-12 col-sm-6">
                                            <div class="row">
                                            <div class="round-class ball">
                                            <i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i></div>
                                              <div class="right-text">
                                                                                  Thanks to use our web-site, We hope you liked it.
                                                                          </div>
                                            </div>
                                            <div class="row">
                                               <div class="round-class ball">
                                            <i class="fa fa-mobile fa-2x" aria-hidden="true"></i></div>
                                              <div class="right-text">
                                                                                  You could still in contact in our commitee
                                              </div>
				</div>
			</div>
		</div>
	</div>
	</div>   
    <!--Swiper JS-->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
var myApp = angular.module('logoutApp',[]);

myApp.controller('logoutController', ['$scope', '$interval', '$location', function($scope, $interval, $location) {
  $scope.seconds = 5;
  $scope.loadingShowed = true;
  $interval(function() {
    $scope.seconds--;
    if ($scope.seconds<=0) {
      $scope.loadingShowed = false;
       $scope.redirect();
    }
  }, 1000, 5);
  $scope.redirect = function(){
    $location.path('/full');
  }
}]);  
        
    </script>
    </body>
</html>
