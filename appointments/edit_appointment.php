<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clinic_db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $patient_id = $_POST['patient_id'] ?? '';
    $doctor_id = $_POST['doctor_id'] ?? '';
    $date = $_POST['appointment_date'] ?? '';
    $time = $_POST['appointment_time'] ?? '';
    $reason = $_POST['reason'] ?? '';
    $status = $_POST['status'] ?? '';

    // Validate required fields
    if (empty($id) || empty($patient_id) || empty($doctor_id) || empty($date) || empty($time) || empty($reason) || empty($status)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: index.php");
        exit();
    }

    // Proceed with update
    $stmt = $conn->prepare("UPDATE appointments SET patient_id=?, doctor_id=?, appointment_date=?, appointment_time=?, reason=?, status=? WHERE id=?");
    $stmt->bind_param("iissssi", $patient_id, $doctor_id, $date, $time, $reason, $status, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Appointment updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update appointment: " . $stmt->error;
    }

    header("Location: index.php");
    exit();
}
?>