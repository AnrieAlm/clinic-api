<?php
include 'config.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("INSERT INTO appointments (patient_id, patient_name, appointment_date, appointment_time, doctor, reason) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "isssss",
    $data['patientId'],
    $data['patientName'],
    $data['date'],
    $data['time'],
    $data['doctor'],
    $data['reason']
);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>