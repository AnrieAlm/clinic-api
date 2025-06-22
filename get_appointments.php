<?php
include 'config.php';

$sql = "SELECT id, patient_id, patient_name, appointment_date, appointment_time, doctor, reason, status FROM appointments";
$result = $conn->query($sql);

$appointments = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

echo json_encode($appointments);
?>