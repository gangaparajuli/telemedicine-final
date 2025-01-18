<?php
// Start session and include database connection
session_start();
 include('databaseconnection.php');

// Ensure user_id is set in the session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; // Defaulting to 1 for now

// Fetch upcoming appointments for logged-in user
$sql = "SELECT a.appointment_date, a.appointment_time, d.name AS doctor_name, d.address 
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.doctor_id
        WHERE a.user_id = ? AND a.appointment_date >= CURDATE()
        ORDER BY a.appointment_date, a.appointment_time";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

      <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!--  css file link  -->
    <link rel="stylesheet" href="./css/style.css">

    <style>
        .notifications {
            position: relative;
            display: inline-block;
        }

        #notificationDropdown {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 250px;
            border: 1px solid #ccc;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            padding: 10px;
        }

        #notificationDropdown ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #notificationDropdown li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            position: relative;
        }

        #notificationDropdown li:last-child {
            border-bottom: none;
        }

        #notificationBtn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #notificationBtn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            position: absolute;
            right: 10px;
            top: 10px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .delete-btn img {
            width: 20px;
            height: 20px;
        }
    </style>

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

<!-- home section start  -->



<section id="home" class="home">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <!-- home images  -->
            <!-- <div class="images"> -->
                <img src="./images/home1.png" class="img-fluid"  alt="">
            <!-- </div> -->
        </div>
            <!-- home heading  -->
            <div class="col-md-5 ">
                 <!-- <h1><span>Stay</span> Safe,</h1> 
                <h1><span>Stay</span> Healthy.</h1>
                <br>
                <p> Connecting People with Care, Anytime, Anywhere  </p>  -->
                
                <!-- appointment Button  start-->
            <div class="notifications">
                <button id="notificationBtn">Appointments</button>
                <div id="notificationDropdown">
                    <?php if ($result->num_rows > 0): ?>
                        <ul>
                        <?php
// Assuming you're fetching the appointments and storing in $result
while ($row = $result->fetch_assoc()): 
    $appointment_date = new DateTime($row['appointment_date']);
?>
    <li>
        <strong><?php echo htmlspecialchars($row['doctor_name']); ?></strong><br>
        Date: <?php echo $appointment_date->format('Y-m-d'); ?><br>  <!-- Displaying only the date -->
        Time: <?php echo htmlspecialchars($row['appointment_time']); ?><br>
        Address: <?php echo htmlspecialchars($row['address']); ?>
        <form method ="POST" action="delete_appointment.php" style="display:inline;">
        <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($row['appointment_id'] ?? '');?>">
        <!-- <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this appointment?')">
        <img src="images/dustbin.webp" alt="Delete">
        </button> -->
        </form>
    </li>
<?php endwhile; ?>

                        </ul>
                    <?php else: ?>
                        <p>No upcoming appointments.</p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- appointment button end -->
            </div>

        </div>
    </div>
    </section>
    
    <!-- home section end  -->

            
    <script>
        document.getElementById('notificationBtn').addEventListener('click', function() {
            var dropdown = document.getElementById('notificationDropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });
    </script>

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