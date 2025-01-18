<?php
// Database connection
include('databaseconnection.php');
// Get form data
$doctor_id = $_POST['doctor_id'];
$patient_name = $_POST['patient_name'];
$patient_email = $_POST['patient_email'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];
$additional_info = $_POST['additional_info'];

// Insert appointment into the database
$sql = "INSERT INTO appointments (doctor_id, patient_name, patient_email, appointment_date, appointment_time, additional_info) 
        VALUES ('$doctor_id', '$patient_name', '$patient_email', '$appointment_date', '$appointment_time', '$additional_info')";

if ($connection->query($sql) === TRUE) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
?>