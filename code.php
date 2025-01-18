<?php
session_start();
include('databaseconnection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token){
    $mail = new PHPMailer(true);
   
    try{
    //$mail ->SMTPDebug = 2; 
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username ="gp175443@gmail.com";
    $mail->Password = "nphd zpxu ptow qvzf";

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("gp175443@gmail.com",$name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Email Verification from TeleCare";

    $email_template ="
    <h2>You have Registered with TeleCare</h2>
    <h5>Verify your email address to Login with the below given link</h5>
    <br/><br/>
    <a href='http://localhost/testing/verify-email.php?token=$verify_token'>Click Me</a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    //echo'Message has been sent';
    }catch(Exception$e){
         // echo"message could no be sent.Mailer Error:{$mail->ErrorInfo}";
    }
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password =  $_POST['confirm-password'];
    $verify_token = md5(rand());

   // sendemail_verify("$name", "$email", "$verify_token");
    //echo "sent or not?";

    //email exists or not
   $check_email_query = "SELECT email FROM users WHERE email ='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($connection, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['status'] = "Email Id already Exists";
        header("Location: register.php");
    }
    else{
        //Insert user/ register User Data
        $query = "INSERT INTO users(name, email, password, verify_token) VALUES('$name', '$email', '$password', '$verify_token')";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            sendemail_verify("$name", "$email", "$verify_token");
            $_SESSION['status'] = "Registretion successful.! Please verify your email Address";
            header("Location:register.php");
        }
        else{
            $_SESSION['status'] = "Registration Failed";
            header("Location:register.php");
        }


    }

}
?>