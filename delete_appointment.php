<?php
// Start session and include database connection
session_start();
 include('databaseconnection.php');



// Check if appointment_id is provided
if (isset($_POST['appointment_id'])) {
    $appointment_id = intval($_POST['appointment_id']);
    
    // Delete the appointment
    $sql = "DELETE FROM appointments WHERE appointment_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $appointment_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Appointment deleted successfully.'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting appointment.'); window.location.href='dashboard.php';</script>";
    }
    
    $stmt->close();
} else {
    echo "<script>alert('No appointment selected.'); window.location.href='dashboard.php';</script>";
}

$connection->close();
?>