<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clinic_db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'] ?? '';
    $doctor_id = $_POST['doctor_id'] ?? '';
    $date = $_POST['appointment_date'] ?? '';
    $time = $_POST['appointment_time'] ?? '';
    $reason = $_POST['reason'] ?? '';
    $status = $_POST['status'] ?? '';

    // Basic validation
    if (empty($patient_id) || empty($doctor_id) || empty($date) || empty($time) || empty($reason) || empty($status)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, reason, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $patient_id, $doctor_id, $date, $time, $reason, $status);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Appointment scheduled successfully!";
        } else {
            $_SESSION['error'] = "Error scheduling appointment: " . $stmt->error;
        }
    }

    header("Location: index.php");
    exit();
}
?>