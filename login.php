<?php

include 'databaseconnection.php';

//start the session to use session variables
session_start();

//check if the 'submit'button is clicked in the form
if(isset($_POST['submit'])){

    //sanitize user inputs to prevent SQL injection
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    //query the database to check if the entered username and password exist in the 'users' table
    $select_users = mysqli_query($connection, "SELECT * FROM `users` WHERE name = '$name' AND password = '$password'");

    //if the user exists, set session variables for username and password , and redirect to the home page
    if(mysqli_num_rows($select_users) >0){

        $row = mysqli_fetch_assoc($select_users);


        //store user details in the session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['password'] = $row['password'];
        header('location:dashboard.php');
    }else{
        $message[] = 'user doesnot exist!';
    }
}
//check if there are any message to display(like an error)
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
    <title>Log in</title>
    
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


     <div class="login-container">
        <?php
        if(isset($_SESSION['status'])){
            ?>
            <div class="alter alter-success">
                <h5><?= $_SESSION['status']; ?></h5>
            </div>
            <?php 
            unset($_SESSION['status']);
        }
        ?>


        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Name</label>
                <input type="text" id="username" name="name" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Log In</button>
                <p>don't have a account? <a href ="register.php"> Signup Now </a></p>
            </div>
        </form>
     </div>


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
