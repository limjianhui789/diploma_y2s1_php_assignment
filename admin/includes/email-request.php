<?php 
            use PHPMailer\PHPMailer\PHPMailer;
            //use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            function sendMail($to, $subject, $body, $altbody = ''){

                require_once('mailer/Exception.php');
                require_once('mailer/PHPMailer.php');
                require_once('mailer/SMTP.php');
                require_once('modal_msg.php');
                

                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'nitrogaming.service@gmail.com';                     //SMTP username
                    $mail->Password   = 'thequizsunaxrzyz';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    //$mail->SMTPSecure = false;
                    //$mail->SMTPAutoTLS = false;
                    //Recipients
                    $mail->setFrom('nitrogaming.service@gmail.com', 'Nitro Society');
                    //$mail->addAddress('limjianhui789@gmail.com', 'Jian Hui');     //Add a recipient
                    $mail->addAddress($to);               //Name is optional
                    $mail->addReplyTo('nitrogaming.service@gmail.com', 'Nitro Society');
                    //$mail->addCC('nitrogaming.service@gmail.com'); //For Same Level For a Copy
                    $mail->addBCC('blackpaper00001@gmail.com'); //Hidden Copy For Higher Level
    
                    //Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $body;
                    $mail->AltBody = $altbody;
    
                    $mail->send();
                    
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        ?>