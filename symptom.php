<?php 

// include 'databaseconnection.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//     header('location:login.php');
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom</title>

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


            <!-- symptoms section start -->

    <section id="symptom" class="symptom">

        <h1 class="heading">symptom </h1>
        

        <div class="box-container">

            <!-- start here  -->
            <div class="box">

            <?php
            $isLoggedIn = false;

            if($isLoggedIn){
                echo'<div class="container">
                <div class="row">
                <div class="col-md-4">
                <ul>
                <li>1.Runny or stuffy nose</li>
                <li>2. Sore throat </li>
                <!-- Rest of the symptoms here-->
                </ul>
                </div>
                <!-- Additional colums with symptoms -->
                </div>
                </div>';
            }else{
                echo '<style>
                .container{
                margin: 30px auto;
                padding:20px;
                text-align:center;
                border:1px solid #ccc;
                border-radius:10px;
            }
                h3{
                font-size: 4rem;

            }

                </style>';
                echo '<div class ="container">
                <h3> Login to see symptoms</h3>
                </div>';
            }

            ?>
                 
                <!-- about heading & text  -->
               <!--  <div class="container">
                    <div class="row">
                    <div class="col-md-4">
                    <ul>
                        <li>1. Runny or Stuffy nose</li>
                        <li>2. Sore throat</li>
                        <li>3. Sneezing</li>
                        <li>4. Coughing</li>
                        <li>5. Mild fever</li>
                        <li>6. High fever</li>
                        <li>7. Chills</li>
                        <li>8. Body aches</li>
                        <li>9. Fatigue</li>
                       
                    </ul>
                    </div>
                    <div class="col-md-4">
                    <ul>
                        <li>10. Blurred vision</li>
                        <li>11. Slow-healing wonds</li>
                        <li>12. Headache</li>
                        <li>13. Shortness of breath</li>
                        <li>14. Nosebleeds</li>
                        <li>15. Wheezing</li>
                        <li>16. Chest tightness</li>
                        <li>17. Persistent cough</li>
                        <li>18. Mucus production</li>
                       
                    </ul>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li>19. Chest discomfort</li>
                            <li>20. Difficulty breathing</li>
                            <li>21. Coughing up blood</li>
                            <li>22. Weight loss</li>
                            <li>23. Diarrhea</li>
                            <li>24. Abdominal cramps</li>
                            <li>25. Nausea</li>
                            <li>26. Vomiting</li>
                            <li>27. Burning sensation during urination</li>
                           
                        </ul>
                        </div>
                </div>
            </div> -->
            
               <!-- <div class="button1">
                    <div class="submit"><a href="/disease.html">
                    <btn type="button" class="btn btn-outline-primary">Find Disease</btn></a>
                    </div>
                </div> -->
                
            </div>
            <!-- end here  -->
           </div>
    </section>
    <!-- symptoms section end -->


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