<?php
// Database connection

include('databaseconnection.php');

// Fetch doctor ID from URL
$doctor_id = isset($_GET['doctor_id']) ? intval($_GET['doctor_id']) : 0;

// Fetch doctor details securely
$stmt = $connection->prepare("SELECT * FROM doctors WHERE doctor_id = ?");
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$doctor_result = $stmt->get_result();
$doctor = $doctor_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css">

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


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }
        input, button {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .doctor-info {
            text-align: center;
        }
    </style>
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

    <div class="container">
        <h1>Book Appointment with <?php echo htmlspecialchars($doctor['name']); ?></h1>
        <div class="doctor-info">
            <img src="<?php echo htmlspecialchars($doctor['image']); ?>" alt="Doctor Image" style="width: 150px; height: 150px; border-radius: 50%;">
            <p><strong>Specialization:</strong> <?php echo htmlspecialchars($doctor['specialization']); ?></p>
            <p><strong>Experience:</strong> <?php echo htmlspecialchars($doctor['experience']); ?> years</p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($doctor['address']); ?></p>
        </div>
        <form method="POST" action="submit_appointment.php">
            <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor['doctor_id']); ?>">
            <label for="date">Choose a Date:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="time">Choose a Time:</label>
            <input type="time" id="time" name="time" required>
            
            <button type="submit">Book Appointment</button>
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

<?php
$stmt->close();
$connection->close();
?>