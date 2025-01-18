<?php
// Database connection

session_start();
 include('databaseconnection.php');

// Initialize variables
$name = isset($_GET['name']) ? $_GET['name'] : '';
$specialization = isset($_GET['specialization']) ? $_GET['specialization'] : '';

// Query to fetch distinct specializations for the filter
$specializationQuery = "SELECT DISTINCT specialization FROM doctors";
$specializationResult = $connection->query($specializationQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow-Up</title>
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
        /* Basic Styles */
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
        .search-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .home-btn, .search-btn {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }
        .home-btn:hover, .search-btn:hover {
            background-color: #0056b3;
        }
        .home-btn {
            margin-right: 15px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        select {
            padding: 10px;
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .doctor-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .doctor-card {
            width: 250px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
        }
        .doctor-card img {
            width: 100%;
            height: 150px;
            border-radius: 10px;
        }
        .doctor-card h2 {
            font-size: 18px;
            margin: 10px 0;
        }
        .doctor-card p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
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
        <a href="login.php" role="button"> <button class="button-34" role="button">Log Out </button></a>
        
    </div>
</nav>
<!-- menu icon (responsiveness)  -->
<div class="fas fa-bars"></div>
</header>
<!-- header navbar section end  -->
    
    <div class="container">
        <h1>Find Your Doctor</h1>

        <!-- Home Icon, Search Bar, and Filter -->
        <div class="search-container">
            <!-- Home Icon -->
            <a href="follow_up.php"><button class="home-btn"><i class="fas fa-home"></i></button></a>

            <!-- Search Form -->
            <form method="GET" action="follow_up.php" style="display: flex; align-items: center;">
                <input type="text" name="name" placeholder="Search by Doctor's Name" 
                       value="<?php echo htmlspecialchars($name); ?>">
                
                <!-- Specialization Filter -->
                <select name="specialization">
                    <option value="">Select Specialization</option>
                    <?php
                    if ($specializationResult->num_rows > 0) {
                        while ($row = $specializationResult->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['specialization']) . '"';
                            if ($row['specialization'] == $specialization) {
                                echo ' selected';
                            }
                            echo '>' . htmlspecialchars($row['specialization']) . '</option>';
                        }
                    }
                    ?>
                </select>

                <!-- Search Button -->
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="doctor-list">
    <?php
    // Query to fetch doctors
    $sql = "SELECT * FROM doctors WHERE 1=1";
    if (!empty($name)) {
        $sql .= " AND name LIKE '%" . $connection->real_escape_string($name) . "%'";
    }
    if (!empty($specialization)) {
        $sql .= " AND specialization = '" . $connection->real_escape_string($specialization) . "'";
    }
    $result = $connection->query($sql);

    // Check if doctors are found
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $doctor_id = $row['doctor_id']; // Store the doctor ID
            echo '<div class="doctor-card">';
            echo '<a href="book_appointment.php?doctor_id=' . $doctor_id . '"><img src="' . htmlspecialchars($row['image']) . '" alt="Doctor Image"></a>';
            echo '<a href="book_appointment.php?doctor_id=' . $doctor_id . '"><h2>' . htmlspecialchars($row['name']) . '</h2></a>';
            echo '<p><strong>Specialization:</strong> ' . htmlspecialchars($row['specialization']) . '</p>';
            echo '<p><strong>Experience:</strong> ' . htmlspecialchars($row['experience']) . ' years</p>';
            echo '<p><strong>Address:</strong> ' . htmlspecialchars($row['address']) . '</p>';
            echo '<p><strong>Phone:</strong> ' . htmlspecialchars($row['phone']) . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No doctors found.</p>';
    }
    
    ?>

    </div>
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