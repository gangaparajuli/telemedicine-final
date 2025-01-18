<?php

session_start();
include 'databaseconnection.php';

//initialize an empty array to store message
$message =[];

if(isset($_POST['submit'])){
    //get and sanitize user input form the form
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, ($_POST['password']));
    $confirm_password = mysqli_real_escape_string($connection, ($_POST['confirm-password']));

    //check if a user already exists with the provided username
    $select_users_name = mysqli_query($connection, "SELECT * FROM `users` WHERE name ='$name'");

    //if the username is already taken, add an error message
    if(mysqli_num_rows($select_users_name) > 0){
        $message[] = 'user with this username already exists!';
    }else{
        if($password != $confirm_password){
        $message[] = 'Confirm password does not match!';
    }
    else{
        //if everything is fine, insert the user into the database
        mysqli_query($connection, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$password')") or die('query failed');
        $message[] ='Signup successfully!';

        //redirect the user to the login page
        header('location:login.php');

    }
}
}

//if there are any messages, loop through them and display each one
if(!empty($message)){
    foreach($message as $msg){
        echo '
        <div class="message">
        <span>' .$msg. '</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    
      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

      <!--  css file link  -->
      <link rel="stylesheet" href="./css/style.css">
  
      <!-- link bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <!--  js file link  -->
    <script src="./js/main.js"></script>

    <!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</head>
<body>
   
    <!-- header navbar section start  -->

    <header>

        <!-- logo name  -->
       <!-- <a href="#" class="logo"><span>D</span>octors <span>C</span>ares.</a>-->
       <a href="home.php" class="logo"><img src="logo.png" height="75"></a>
       
        <!-- navbar link  -->
        <nav class="navbar">
            <ul>
                <li><a href="home.php">home</a></li>
                <li><a href="symptom.php">Symptoms</a></li>
                <li><a href="doctor.html">doctor</a></li>
                <li><a href="followup.html">follow up</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contactus.html">contact</a></li>
            </ul>
            <div class="btn">
                <a href="register.php" role="button"> <button class="button-34 me-3" role="button">sign up</button></a>
                    <a href="login.php" role="button"> <button class="button-34" role="button">Log In</button></a>
                
            </div>
        </nav>
    <!-- menu icon (responsiveness)  -->
        <div class="fas fa-bars"></div>
    </header>
    <!-- header navbar section end  -->


       
<!-- signup start -->
<section class="signup">
<div class="signup-container">

    <div class="alert">
        <?php
        if(isset($_SESSION['status'])){
            echo"<h4>".$_SESSION['status']."</h4>";
            unset($_SESSION['status']);
        }

        ?>
    </div>
    
    <h2>Sign-up</h2>
    <form action="code.php" method="POST">
        <div class="form-group">
            <label for="new-name">Name</label>
            <input type="text" id="new-name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="new-password">Password</label>
            <input type="password" id="new-password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Sign up</button>
            <p> Already Signup. <a href = "login.php">Login Now</a></p>
        </div>
    </form>
 </div>
</section>

<!-- signup end -->

       
 <!-- footer section start  -->

 <section class="footer">

    <div class="box">
        <h2 class="logo"><span>T</span>ele<span>C</span>are</h2>
        <!-- <h2 class="logo"><a href="#"><img src="/telecare-removebg-preview.png" height="40"></a></h2> -->
        <p>Empowering you to take control of your health. TeleCare uses your symptom inputs to provide reliable disease suggestions and personalized care recommendations.</p>
    </div>

    <div class="box">
        <h2 class="logo"><span>S</span>hare</h2>

        <a href="#">facebook</a>
        <a href="#">twitter</a>
        <a href="#">instagram</a>
    </div>

    <div class="box">
        <h2 class="logo"><span>L</span>inks</h2>

        <a href="home.php">home</a>
            <a href="symptom.php">symptoms</a>
            <a href="doctor.html">Doctor</a>
            <a href="followup.html">Follow Up</a>
            <a href="aboutus.html">about us</a>
            <a href="contactus.html">contact</a>
    </div>


    <span class="credit">All rights reserved.</span>
</section>


      







    <!-- footer section end  -->
</body>
</html>
