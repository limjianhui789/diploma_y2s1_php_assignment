<?php
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">';
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            //Username Validation
            if(isset($_POST['username'])){
                $username = trim($_POST['username']);
                
            }else{
                echo "Username Cannot Be Empty.";
            }

        }
    }else{
        echo "Illegal Access ";
        die();
    }
?>