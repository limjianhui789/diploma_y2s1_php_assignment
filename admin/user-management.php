<?php 
    require_once("./includes/permision_checker.php");
?>
<html lang="en">
    <head>
        <title>Nitro Society - User Management</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/x-icon" href="../image/favicon.ico">
        <link type="text/css" rel="stylesheet" href="css/search_bar.css">
        <style>
            table{
                border-collapse: separate;
                border-spacing: 0 15px;
            }
            tr{
                height: 80px;
            }
            .table>:not(caption)>*>* {
                padding: 1rem 1rem;
            }
            .rec{
                transition: linear 0.25s;
            }
            .rec:hover{
                z-index: 999;
                cursor: pointer;
                box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
            }
            .rec_head{
                height: auto;
            }
        </style>
    </head>
    <body style="background-color: #FAFAFC;">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>
                function searchEvent(id,content, type){
                    content = encodeURIComponent(content);
                    var xmlhttp;
                    if(window.XMLHttpRequest){
                        xmlhttp = new XMLHttpRequest();
                    }else{
                        xmlhttp = new ActiveXObject(Microsoft.XMLHttpRequest);
                    }
                    xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                            $(document).ready(function(){
                                if(xmlhttp.responseText == ""){
                                    document.getElementById(id).innerHTML = "<h2><span class='badge text-bg-info text-white'>Event Not Found</span></h2>";
                                }else{
                                    document.getElementById(id).innerHTML = xmlhttp.responseText;
                                }
                                
                                $("#search_div").fadeIn();
                            });
                            
                        }
                    };
                    xmlhttp.open("GET", `includes/searchUser.php?search=${content}&type=${type}`, true);
                    xmlhttp.send();
                }
            </script>
        <?php
            require_once("./includes/header.php");
            require_once('./includes/searchUser.php');
        ?>
        <!-- Navigate -->
        <div class="cotainer-fluid">
            <div class="row m-5">
                <div class="col">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb align-self-center">
                            <li><i class="bi bi-terminal-dash fs-5"></i>&nbsp;</li>
                            <li class="breadcrumb-item"><a href="./index.php">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-secondary" href="#active-user">Active</a>  / <a class="text-secondary" href="#inactive-user">Inactive</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navigate -->

        <div class="container-fluid" id="active-user">
            <?php
                echo '<script>searchEvent("active-user","@active")</script>';
            ?>
        </div>

        <div class="container-fluid" id="inactive-user">
            <?php
                echo '<script>searchEvent("inactive-user","@inactive")</script>';
            ?>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $("#search_bar_active").mouseleave(function(){
                    $("#search_bar_active").blur();
                });
                $("#search_bar_inactive").mouseleave(function(){
                    $("#search_bar_inactive").blur();
                });
            });
        </script>
    </body>
</html>