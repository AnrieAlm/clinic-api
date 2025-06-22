<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clinic_db");

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM appointments WHERE id=?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    $_SESSION['success'] = "Appointment deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete appointment.";
}

header("Location: index.php");
exit();
?>