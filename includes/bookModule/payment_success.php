<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['id']) && isset($_POST['status']) && isset($_POST['amount']) && isset($_POST['username']) && isset($_POST['eventID']) && isset($_POST['studentID'])  && isset($_POST['quantity'])){
            $status = $_POST['status'];
            $id = $_POST['id']; //Refer To PaypalPaymentOrderID
            $amount = $_POST['amount']; //Paypal Paid Price
            if($status == "COMPLETED"){
                require_once("../../admin/includes/sql_connection.php");
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $date = date("Y-m-d");
                $time = date("H:i:s");

                $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

                //Insert Payment
                $query = "
                    INSERT INTO nitro_payment(payDate, payTime, paymentAmount, referCode) VALUES('{$date}', '{$time}', {$amount}, '{$id}')
                ";
                $conn->query($query);
                

                //Get PaymentID
                $paymentID;

                $query = "SELECT LAST_INSERT_ID() AS paymentID;";
                $result = $conn->query($query);

                while($row = $result->fetch_object()){
                    $paymentID = $row->paymentID;
                }

                //Insert Booking Details
                $username = $_POST['username'];
                $eventID = $_POST['eventID'];
                $studentID = $_POST['studentID'];
                $query = "
                    INSERT INTO nitro_booking(username, studentID, bookingDate, bookingTime, eventID, paymentID, is_delete)
                    VALUES('{$username}', '{$studentID}', '{$date}', '{$time}', {$eventID}, {$paymentID}, 0);
                ";
                $result = $conn->query($query);

                //Get BookingID
                $bookingID;
                $query = "SELECT LAST_INSERT_ID() AS bookingID;";
                $result = $conn->query($query);
                while($row = $result->fetch_object()){
                    $bookingID = $row->bookingID;
                }

                //Decrease Seat Available Based On Quantity
                $query = "UPDATE nitro_event SET seatAvailable = seatAvailable - {$_POST['quantity']} WHERE eventID = {$eventID}";
                $conn->query($query);

                //Generate Ticket
                $query = "
                    INSERT INTO nitro_ticket(bookingID, is_used) VALUES(?, 0)
                ";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $bookingID);

                //Generate How Many Ticket
                $quantity = $_POST['quantity'];
                while($quantity > 0){
                    $stmt->execute();
                    $quantity--;
                }
                
                //Send Email
                require_once('../../admin/includes/email-request.php');
                
                    //Find Last Name & Email
                    $query = "SELECT last_name, emailAddress FROM nitro_user WHERE username = '{$username}'";
                    $result = $conn->query($query);
                    $row = $result->fetch_object();
                    $last_name = $row->last_name;
                    $email = $row->emailAddress;

                $plain_html = "Successfully Make The Payment";
                sendMail($email, "Congrats, {$last_name}" , file_get_contents("../../admin/includes/email-template/booking.html") , $plain_html);
                
                $stmt->close();
                $result->free();
                $conn->close();
            }
        }
    }
?>