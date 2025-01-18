<?php 

include 'databaseconnection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>

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
           <a href="dashboard.php" class="logo"><img src="logo.png" height="75"></a>
    
            <!-- navbar link  -->
            <nav class="navbar">
                <ul>
                    <li><a href="dashboard.php">home</a></li>
                    <li><a href="symptom_checker.php">Symptoms</a></li>
                    <li><a href="doctor.php">doctor</a></li>
                    <li><a href="follow_up.php">follow up</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contactus.php">contact</a></li>
                </ul>
                <div class="btn">
                    <a href="login.php" role="button"> <button class="button-34" role="button">Log Out</button></a>
                    
                </div>
            </nav>
        <!-- menu icon (responsiveness)  -->
            <div class="fas fa-bars"></div>
        </header>
        <!-- header navbar section end  -->


       <!-- doctor/ card section start  -->

    <section id="doctor" class="card">

        <div class="container">

            <h1 class="heading">our professional doctors</h1>
           
            <div class="box-container">

                <!-- start here  -->
                <div class="box">
                    <img src="./images/doctor-1.jpg" alt="">                
                    
                    <div class="content">
                        <a href="#">
                            <h2>Anil Kumar</h2>
                        </a>
                        <p>Dermatologist</p>

                        <!-- card icons  -->
                        <div class="icons">
                            <a href="#" class="fab fa-facebook-f"></a>
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-instagram"></a>
                        </div>
                    </div>
                </div>
                <!-- end here  -->

                 <!-- start here  -->
                 <div class="box">
                    <img src="./images/doctor-2.jpg" alt="">                
                    
                    <div class="content">
                        <a href="#">
                            <h2>Divya Mittal</h2>
                        </a>
                        <p>Urologist</p>

                        <!-- card icons  -->
                        <div class="icons">
                            <a href="#" class="fab fa-facebook-f"></a>
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-instagram"></a>
                        </div>
                    </div>
                </div>
                <!-- end here  -->

                 <!-- start here  -->
                 <div class="box">
                    <img src="./images/doctor-3.jpg" alt="">                
                    
                    <div class="content">
                        <a href="#">
                            <h2>Basant Pant</h2>
                        </a>
                        <p>Neurologist</p>

                        <!-- card icons  -->
                        <div class="icons">
                            <a href="#" class="fab fa-facebook-f"></a>
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-instagram"></a>
                        </div>
                    </div>
                </div>
                <!-- end here  -->

            </div>
        </div>
    </section>
    <!-- card section end  -->

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

            <a href="dashboard.php">home</a>
            <a href="symptom_checker.php">symptoms</a>
            <a href="doctor.php">Doctor</a>
            <a href="follow_up.php">Follow Up</a>
            <a href="aboutus.php">about us</a>
            <a href="contactus.php">contact</a>
        </div>


        <span class="credit">All rights reserved.</span>
    </section>








    <!-- footer section end  -->
    
</body>
</html>