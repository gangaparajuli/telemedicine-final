<?php

include('databaseconnection.php');
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

//close connection
//$connection->close();
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
           <a href="dasboard.php" class="logo"><img src="logo.png" height="75"></a>
    
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


            <!-- disease section start -->
            <section id="disease" class="disease">
                    <h1 class="heading">possible disease</h1>
            
                        <!-- start here  -->
                        <div class="box">
                            <?php 
                            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['symptoms'])){
                                $selected_symptoms = $_POST['symptoms'];
                                
                                //insert user_id and symptoms_id
                                $insert_query = $connection->prepare("INSERT INTO users_symptoms(user_id, symptoms_id)VALUES(?,?)");
                                foreach($selected_symptoms as $symptoms_id){
                                    $symptoms_id = intval($symptoms_id);
                                    $insert_query->bind_param("ii", $user_id, $symptoms_id);
                                    $insert_query->execute();
                                }
                                $insert_query->close();
                                
                                $symptom_ids = implode(",", array_map('intval', $selected_symptoms));
                                
                                $disease_query="SELECT d.diseases_id, d.diseases_name,
                                COUNT(ds.symptoms_id) AS matched_symptoms,
                                (COUNT(ds.symptoms_id) * 1.0 / (SELECT COUNT(symptoms_id) FROM diseases_symptoms WHERE diseases_id = d.diseases_id)) AS match_score
                                FROM
                                diseases d
                                JOIN 
                                diseases_symptoms ds ON d.diseases_id = ds.diseases_id
                                WHERE 
                                ds.symptoms_id IN($symptom_ids)
                                GROUP BY d.diseases_id, d.diseases_name
                                ORDER BY
                                match_score DESC LIMIT 1
                                ";
                                
                                $diseases_result = $connection->query($disease_query);
                                
                                if($diseases_result->num_rows > 0){
                                    $row = $diseases_result->fetch_assoc();
                                    $diseases_id = $row['diseases_id'];
                                
                                    echo '<div class="card" style="width:18rem;">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title"><strong>Diseases:</strong> ' .$row['diseases_name'] . '</h5>';
                                    echo '<ul class="list-group list-group-flush">';
                                    echo '<li class="list-group-item"><strong>Match score:</strong> ' . round($row['match_score'] * 100, 2) . '%</li>';

                                    //query to find medicine for the most likely disease
                                    $treatment_query = "SELECT t.treatment_name FROM diseases_treatments dt
                                    JOIN treatments t ON dt.treatment_id = t.treatment_id
                                    WHERE dt.diseases_id = $diseases_id";
                                
                                    $treatment_result = $connection->query($treatment_query);
                                
                                    if($treatment_result->num_rows > 0){
                                        echo '<li class="list-group-item"><strong>Recommended Medicines:</strong><ul>';
                                        while($treatment_row =  $treatment_result->fetch_assoc()){
                                            echo '<li>' . $treatment_row['treatment_name'] .'</li>';
                                        }
                                        echo '</ul><li>';
                                    }
                                    else{
                                        echo '<li class="list-group=item">No medicine recommendations available for this diseases.</li>';
                                    }

                                    echo '</ul>';
                                    echo '<div class="card-body">';
                                    echo '<a href="follow_up.php" class="card-link"><button type="button" class="btn btn-primary">Follow up</button></a>';
                                    echo '</div>'; // Close card-body
                                    echo '</div>'; // Close card
                                
                                
                                }
                                else{
                                    echo "<p>No matching diseases found for the selcted symptoms</p>";
                                }
                                }


?>
<!-- end here  -->
 </div>
 </section>
  
    <!-- disease section end -->


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
            <a href="symptoms_checker.php">symptoms</a>
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
