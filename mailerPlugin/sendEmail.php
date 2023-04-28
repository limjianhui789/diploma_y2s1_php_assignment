<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $subject = "Contact Us Support";
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com"; //define smtp host
        $mail->SMTPAuth = true; //enable smtp authenticatino
        $mail->Username = "wongcw-pm21@student.tarc.edu.my"; //set gmail username
        $mail->Password = '030207020701'; //set gmail password
        $mail->Port = 465; //set port to connect smtp
        $mail->SMTPSecure = "ssl"; //set type of encryption

        //Email Settings
        $mail->isHTML(true);//enable HTML
        $mail->setFrom($email, $name);//set sender email
        $mail->addAddress("nitrogamingsociety23@gmail.com"); //set recipient

        $mail->Subject = ("$subject ($name)"); //set email subject
        $mail->Body = "Name : $name<br> Email : $email <br> Phone Number : $phoneNumber <br><br><br>$body<br>";//email body

        if ($mail->send()) { //send the email
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
