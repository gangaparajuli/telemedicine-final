<?php
include('databaseconnection.php');
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

//fetch symptoms from the database for selection
$symptoms_query = "SELECT symptoms_id, symptoms_name FROM symptoms";
$symptoms_result = $connection->query($symptoms_query);
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


            <!-- symptoms section start -->

    <section id="symptom" class="symptom">

        <h1 class="heading">Symptom </h1>
        <form action ="result1.php" method="POST">

            
<?php 
    if($symptoms_result->num_rows > 0){
        echo "<div style='display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;'>";
        while($row = $symptoms_result->fetch_assoc()){
            echo "<label style='margin-bottom: 10px; padding: 5px 0 0 30px; text-align: center; font-size: 16px; display: block;'>
            <input type='checkbox' name='symptoms[]' value='" . $row['symptoms_id'] . "'>" . $row['symptoms_name'] . "</label>";
        }
        echo "</div>";
    } else {
        echo "No Symptoms found.";
    }
?>

        <!-- <div class="button1" style="display: flex; justify-content:center; margin-bottom:20px">
                    <div class="submit"><a href="result1.php">
                    <btn type="submit"  action ="result1.php" class="btn btn-outline-primary">Find Disease</btn></a>
                    </div>
</div> -->

<div style="display: flex; justify-content:center; margin-bottom:20px">
             <input type="submit" name="submit" value="Find Disease" > 
            </div> 
                 </form>
        <div class="box-container">

            <!-- start here  -->
            <div class="box">
               
               
                
                <!-- about heading & text  -->
               <!-- <div class="container">
                    <div class="row">
                    <div class="col-md-4">
                    <ul>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                       
                    </ul>
                    </div>
                    <div class="col-md-4">
                    <ul>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        <li><input type="checkbox">1. symptom</li>
                        

                       
                    </ul>
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                            <li><input type="checkbox">1. symptom</li>
                        </ul>
                        </div>

                </div>
            </div> !-->
            
             <!--   <div class="button1">
                    <div class="submit"><a href="result1.php">
                    <btn type="button" class="btn btn-outline-primary">Find Disease</btn></a>
                    </div>
                </div> !-->
                
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

            <a href="dashboard/php">home</a>
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