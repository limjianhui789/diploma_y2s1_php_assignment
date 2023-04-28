<?php
    require_once("sql_connection.php");

    function validateRegister(){
        global $username, $password, $cfm_password, $email, $contact, $first_name, $last_name, $gender;

        $error = array();
        $username_pattern = "/^\w{4,20}$/";
        $password_pattern = "/^[^\s]{4,20}$/";
        $email_pattern = '/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/';
        $contact_pattern = "/^01\d-\d{7,8}$/";
        $name_pattern = "/^[a-zA-Z\s]+$/";
        $gender_pattern = "/[mMfFoO]/";

        //Get Database Info For Validation
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT username FROM nitro_user WHERE username = '{$username}'";
        $result = $conn->query($query);
        //Username Validation
        if($username == null)
            array_push($error, ucwords("Username cannot be empty"));
        else if(!preg_match($username_pattern, $username)){
            array_push($error, ucwords("Username Must Be 4-20 Character Without Special Character"));
        }elseif($result->num_rows > 0){
            array_push($error, ucwords("Username Already Exists, Please Change To Another Username"));
        }
        $result->free();

        //Password Validation
        if($password == null)
            array_push($error, ucwords("Password cannot be empty"));
        else if (!preg_match($password_pattern, $password))
            array_push($error, ucwords("password must be 4-20 character and spaces are not allowed"));

        //Confirm Password Validation
        if($cfm_password !== $password)
            array_push($error, ucwords("Password and Confirm Password Must Be Same"));
        
        //Email Validation
        $query = "SELECT username FROM nitro_user WHERE emailAddress = '{$email}'";
        $result = $conn->query($query);
        if($email == null)
            array_push($error, ucwords("Email cannot be empty"));
        else if(!preg_match($email_pattern, $email)){
            array_push($error, ucwords("Email Format Is Incorrect"));
        }elseif($result->num_rows > 0){
            array_push($error, ucwords("Email Already Exists, Please Change To Another Email"));
        }
        $result->free();
        
        //Phone Number Validation
        if($contact == null)
            array_push($error, ucwords("Contact Number Cannot Be Empty"));
        else if(!preg_match($contact_pattern, $contact)){
            array_push($error, ucwords("Format Must Be 019-9999999(9) Eg. 019-4732882"));
        }

        //First Name Validation
        if($first_name == null)
            array_push($error, ucwords("First Name Cannot Be Empty"));
        else if(!preg_match($name_pattern, $first_name)){
            array_push($error, ucwords("Number and Symbol Is Not Allow In First_Name"));
        }

        //Last Name Validation
        if($last_name == null)
            array_push($error, ucwords("Last Name Cannot Be Empty"));
        else if(!preg_match($name_pattern, $last_name)){
            array_push($error, ucwords("Number and Symbol Is Not Allow In Last_Name"));
        }

        //Gender Validation
        if($gender == null)
            array_push($error, ucwords("Please Select Gender"));
        else if(!preg_match($gender_pattern, $gender)){
            array_push($error, ucwords("Please Select The Correct Gender"));
        }
        $conn->close();
        return $error;
    }
?>